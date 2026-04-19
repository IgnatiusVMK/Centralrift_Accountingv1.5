<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateInvoicesDelivery;
use App\Models\Account;
use App\Models\Customers;
use App\Models\Cycles;
use App\Models\Harvests;
use App\Models\ProductsSales;
use App\Models\Sales;
use Barryvdh\DomPDF\Facade\Pdf;  // Note the lowercase 'Pdf'use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->authorize('view-sales');

        $sales = Sales::where('Status', 'approved')->orderBy("Sale_Date","desc")->get();
        return view('financials.sales.sales', [
            'sales' => $sales,
        ]);
    }

    public function ajaxSearch(Request $request)
    {
        $search = $request->input('search');
        $month = $request->input('month', date('Y-m'));

        $query = Sales::with('customer');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('Sales_Id', 'like', "%$search%")
                ->orWhereHas('customer', function ($q2) use ($search) {
                    $q2->where('Customer_Name', 'like', "%$search%");
                });
            });
        }

        if ($month) {
            $query->whereYear('Sale_Date', substr($month, 0, 4))
                ->whereMonth('Sale_Date', substr($month, 5, 2));
        }

        $sales = $query->get();

        $html = view('financials.sales.partials.sales_rows', compact('sales'))->render();

        return response()->json(['html' => $html]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request){

        $Cycle_Id = $request->route('Cycle_Id');
        $cycle = Cycles::where('Cycle_Id', $Cycle_Id)->first();
        $Customers = Customers::get();
        $harvests = Harvests::with('customer')->get();
        $SaleuniqueCode = $this->generateUniqueCode('Sales');
        return view('financials.sales.create', [
            'Cycle_Id' => $Cycle_Id,
            'cycle' => $cycle,
            'harvests' => $harvests,
            'Customers' => $Customers,
            'SaleuniqueCode' => $SaleuniqueCode,
        ]);
    }

    public function store(Request $request)
{

    // Validate the request data
    $request->validate([
        'maker_id' => 'required|integer|exists:users,id',
        'Harvest_Id' => 'required|integer|exists:harvests,id',
        'Cycle_Id' => 'required|string|max:255',
        'Sales_Id' => 'required|string|max:255|unique:sales,Sales_Id',
        'Customer_Id' => 'required|integer|exists:customers,id',
        'Cust_Account_No' => 'required|numeric|min:256',
        /* 'Lpo_No' => 'required|string|max:255', */
        'Description' => 'required|string',
        'packaging_option' => 'required|string|max:255',
        'Quantity_of_packages' => 'required|numeric|min:0',
        'Currency' => 'required|string|max:255',
        'Unit_Price' => 'required|decimal:2|min:0',
        'Total_Price' => 'required|numeric|min:0',
        'Sale_Date' => 'required|date',
        'Payment_Status' => 'required|string|max:255',
        /* 'Net_Weight' => 'required_if:product_type,Herbs|numeric|min:0', */
    ]);

    // Begin transaction: Sales record
    try{
        DB::transaction(function() use ($request) {
            Sales::create([
                'maker_id' => $request->maker_id,
                'Sales_Id' => $request->Sales_Id,
                'Customer_Id' => $request->Customer_Id,
                'Cust_Account_No' => $request->Cust_Account_No,
                'Harvest_Id' => $request->Harvest_Id,
                'Cycle_Id' => $request->Cycle_Id,
                'Lpo_No' => $request->Lpo_No,
                'Sale_Date' => $request->Sale_Date,
                'Net_Weight' => $request->Net_Weight,
                'Currency' => $request->Currency,
                'Unit_Price' => $request->Unit_Price,
                'Total_Price' => $request->Total_Price,
                'Payment_Status' => $request->Payment_Status,
                'packaging_option' => $request->packaging_option,
                'Description' => $request->Description,
                'Quantity' => $request->Quantity,
            ]);

            // Call payIn method
            $this->payIn($request->Total_Price, $request->Cycle_Id, $request->Description.'-Sales-'.$request->Net_Weight, $request->maker_id, $request->Sales_Id);
        });
    } catch (\Exception $e) {
        // Handles general exceptions
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }

    // Redirect to the sales creation page with a success message
    return redirect()->route('cycle.sales.create', ['Cycle_Id' => $request->Cycle_Id])->with('success', 'Sale Recorded.');
}

    public function payIn($amount, $Cycle, $Description, $maker_id, $Fin_Id_Id)
    {
        $transactionId = $this->getNextTransactionId();
    
        $lastAccount = Account::latest()->first();
        $balance = $lastAccount ? $lastAccount->Bal : 0;
        $balance += $amount;
    
        Account::create([
            'Transaction_Id' => $transactionId,
            'Cycle_Id'=> $Cycle,
            'Financial_Id'=> $Fin_Id_Id,
            'Description' => $Description,
            'Crd_Amnt' => $amount,
            'Dbt_Amt' => 0,
            'maker_id' => $maker_id,
            'Bal' => $balance,
            'Crd_Dbt_Date' => now(),
            'Date_Created' => now(),
        ]);
    }

    public function generateInvoice(Request $request, string $Sales_Id, int $Customer_Id)
    {
        // Retrieve all sales records for the given Sales_Id
        $sales = Sales::where('Sales_Id', $Sales_Id)->get();

        $invoiceDetails = Sales::where('Sales_Id', $Sales_Id)->first();
        $CustomerInvoiceDetails = Customers::where('id', $Customer_Id)->first();

        $sale_date = Sales::where('Sales_Id', $Sales_Id)->first();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('defaultFont', 'Arial');
        $options->set('isFontSubsettingEnabled', true);
        $options->set('isRemoteEnabled', true); // To load remote resources like images

        $dompdf = new Dompdf($options);

        // $now = Carbon::now('Africa/Nairobi');
        $pdfName = 'Inv-' . $sale_date->Sale_Date . '.pdf';

        // Pass the sales collection to the view
        $data = compact('sales', 'invoiceDetails', 'CustomerInvoiceDetails');

        // Render the view to HTML
        $html = view('financials.sales.invoice', $data)->render();
        $dompdf->loadHtml($html);

        // Set paper size and margins using the correct method
        $dompdf->setPaper('A4', 'portrait');

        // If you need custom margins, use the following to set margins (not set_option):
        $dompdf->set_option('isRemoteEnabled', true);
        $dompdf->render();

        // Return the PDF as a download
        return response($dompdf->output())
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $pdfName . '"')
            ->header('Content-Length', strlen($dompdf->output()));
    }

    public function generateMultipleInvoices(Request $request)
{
    Log::info('Starting document generation', $request->all());

    try {
        // Validate request
        $validated = $request->validate([
            'selected_invoices' => 'required|string',
            'generate_invoice' => 'sometimes|accepted',
            'generate_delivery_note' => 'sometimes|accepted',
        ]);

        Log::debug('Validated data:', $validated);

        // Decode selected invoices
        $selectedInvoices = json_decode($request->selected_invoices, true);
        Log::debug('Decoded invoices:', $selectedInvoices);

        if (empty($selectedInvoices)) {
            throw new \Exception("No invoices selected");
        }

        // Get sales records
        $sales = Sales::whereIn('Sales_Id', $selectedInvoices)->get();
        Log::debug('Found sales records:', $sales->pluck('Sales_Id')->toArray());

        $documents = [];

        // Generate invoices if requested
        if ($request->has('generate_invoice')) {
            Log::info('Generating invoices...');
            foreach ($sales as $sale) {
                $pdf = Pdf::loadView('financials.sales.invoice', [
                    'sales' => [$sale],
                    'invoiceDetails' => $sale,
                    'CustomerInvoiceDetails' => $sale->customer
                ]);
                $documents['invoices'][$sale->Sales_Id] = $pdf->output();
                Log::debug("Generated invoice for {$sale->Sales_Id}");
            }
        }

        // Generate delivery notes if requested
        if ($request->has('generate_delivery_note')) {
            Log::info('Generating delivery notes...');
            foreach ($sales as $sale) {
                $pdf = Pdf::loadView('financials.sales.delivery-note', [
                    'sales' => [$sale],
                    'CustomerInvoiceDetails' => $sale->customer,
                    'invoiceDetails' => $sale
                ]);
                $documents['delivery_notes'][$sale->Sales_Id] = $pdf->output();
                Log::debug("Generated delivery note for {$sale->Sales_Id}");
            }
        }

        if (empty($documents)) {
            throw new \Exception("No documents generated - check options");
        }

        // Store in session
        session(['generated_documents' => $documents]);
        Log::info('Documents generated successfully', array_keys($documents));

        return redirect()->route('documents.selection')
            ->with('success', count($documents) . ' documents generated!');

    } catch (\Exception $e) {
        Log::error("Document generation failed: " . $e->getMessage());
        return redirect()->back()
            ->with('error', 'Failed to generate documents: ' . $e->getMessage());
    }
}

    public function documentsSelection()
    {
        // Log::info('Checking session for documents:', session()->all());
        
        if (!session()->has('generated_documents')) {
            // Log::warning('No generated_documents in session');
            return redirect()->back()->with('error', 'Document generation failed or no documents were created.');
        }
        
        $documents = session('generated_documents');
        
        if (empty($documents['invoices']) && empty($documents['delivery_notes'])) {
            // Log::warning('Empty documents array in session');
            return redirect()->back()->with('error', 'No documents were generated.');
        }
        
        return view('documents.selection', compact('documents'));
    }

    public function downloadDocuments($type, $id)
    {
        // Validate document type
        $validTypes = ['invoices', 'delivery_notes'];
        if (!in_array($type, $validTypes)) {
            abort(404, 'Invalid document type');
        }

        // Check session for document
        if (!session()->has("generated_documents.{$type}.{$id}")) {
            abort(404, 'Document not found');
        }

        $content = session("generated_documents.{$type}.{$id}");
        $filename = "{$type}_{$id}.pdf";
        $tempPath = tempnam(sys_get_temp_dir(), 'doc_');
        file_put_contents($tempPath, $content);

        return response()->download($tempPath, $filename)
            ->deleteFileAfterSend(true);
    }

public function downloadAllDocuments($type)
{
    // Validate type
    $validTypes = ['invoices', 'delivery_notes', 'all'];
    if (!in_array($type, $validTypes)) {
        abort(404, 'Invalid document type');
    }

    $zipFileName = "Invoice&DeliveryNote_{$type}.zip";
    $zipPath = storage_path("app/temp/{$zipFileName}");

    // Create temp directory if it doesn't exist
    if (!file_exists(dirname($zipPath))) {
        mkdir(dirname($zipPath), 0755, true);
    }

    $zip = new ZipArchive();
    if ($zip->open($zipPath, ZipArchive::CREATE) !== true) {
        abort(500, 'Cannot create zip file');
    }

    // Add files to zip based on type
    $documents = session('generated_documents', []);
    
    if ($type === 'all') {
        foreach (['invoices', 'delivery_notes'] as $docType) {
            $this->addDocumentsToZip($zip, $documents[$docType] ?? [], $docType);
        }
    } else {
        $this->addDocumentsToZip($zip, $documents[$type] ?? [], $type);
    }

    $zip->close();

    return response()->download($zipPath)
        ->deleteFileAfterSend(true);
}

    protected function addDocumentsToZip($zip, $documents, $type)
    {
        foreach ($documents as $id => $content) {
            $tempPath = tempnam(sys_get_temp_dir(), 'doc_');
            file_put_contents($tempPath, $content);
            $zip->addFile($tempPath, "{$type}/{$type}_{$id}.pdf");
        }
    }

    protected function getDocumentPath($type, $id)
    {
        return "documents/{$type}/{$id}.pdf";
    }

    public function getNextTransactionId()
    {
        $lastAccount = Account::latest()->first();
        $lastTransactionId = $lastAccount ? $lastAccount->Transaction_Id : 'Txd-' . date('nY') . '-0';
        $lastNumber = intval(substr(strrchr($lastTransactionId, "-"), 1));
        $newNumber = $lastNumber + 1;
    

        $newTransactionId = 'Txd-' . date('nY') . '-' . $newNumber;
    
        return $newTransactionId;
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function generateUniqueCode($type)
    {

        $lastCredit = Sales::latest()->first();
    
        $lastCode = $lastCredit ? $lastCredit->unique_code : '';
        $lastNumber = intval(substr(strrchr($lastCode, "-"), 1)); 
    
        $prefix = strtoupper(substr($type, 0, 4));
        $newNumber = $lastNumber + 1;
        $uniqueCode = $prefix . '-' . date('Ymd') . '-' . $newNumber;
    
        while (Sales::where('Sales_Id', $uniqueCode)->exists()) {
            $newNumber++;
            $uniqueCode = $prefix . '-' . date('Ymd') . '-' . $newNumber;
        }
    
        return $uniqueCode;
    }
}
