<?php

namespace App\Http\Controllers;

use App\Models\CustomerContacts;
use App\Models\Customers;
use App\Models\Invoice;
use App\Models\Sales;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Dompdf\Options;

class CustomerSalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request, $customer)
    {
        // Fetch all customers with their salespersons
        $customers = Customers::with('salespersons')->get();
        $customers_details =  Customers::where('id', $customer)->first();

        $custom_sales = Sales::where('Customer_Id', $customer)->get();
        $dates = $custom_sales->pluck('Sale_Date');

        // Get the customer from the request
        $customer = $request->route('id');
        $Sales_Id = $request->route('Sales_Id');

        // Fetch the customer name based on the customer
        $Customer_Name = Customers::where('id', $customer)->value('Customer_Name');

        
        /* dd($custom_sales); */

        // Return the view with the data
        return view('customers.customer-sales', [
            'Customer_Name' => $Customer_Name,
            'customers' => $customers,
            'customers_details' => $customers_details,
            'dates' => $dates,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request){

        $Cycle_Id = $request->route('Cycle_Id');
        $SaleuniqueCode = $this->generateUniqueCode('Sales');
        return view('financials.sales.create', [
            'Cycle_Id' => $Cycle_Id,
            'SaleuniqueCode' => $SaleuniqueCode,
        ]);
    }

    public function viewAccount(Request $request)
    {
        $customers = Customers::all();


        return view('reports.account-summary.index', compact( 'customers'));
    }
    public function ajaxSearch(Request $request)
    {
        $customerId = $request->input('customer_id');
        $month = $request->input('month');

        /* $customers = Customers::all(); */

        if (!$customerId || !$month) {
            return response()->json(['error' => 'Customer and Month are required'], 422);
        }

        $customer = Customers::find($customerId);

        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }

        // Parse month to filter invoices
        $startDate = $month . '-01';
        $endDate   = date("Y-m-t", strtotime($startDate));

        $invoices = Invoice::where('customer_id', $customerId)
                    ->whereBetween('date', [$startDate, $endDate])
                    ->with('items.product.category')
                    ->get();


        if ($invoices->isEmpty()) {
            return response()->json(['message' => 'No invoices found'], 404);
        }

        $pdf = Pdf::loadView('reports.account-summary.statement', [
            'invoices' => $invoices,
            'customer' => $customer,
        ]);

        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf');
    }


    public function exportStatement(Request $request)
    {
        $customer = Customers::find($request->customer_id);

        if (!$customer) {
            return back()->with('error', 'Customer not found.');
        }

        $invoices = $customer->invoices()
            ->with('items.product.category')
            ->orderBy('invoice_number', 'asc')
            ->get();

        $pdf = Pdf::loadView('reports.account-summary.statement', [
            'invoices' => $invoices,
            'customer' => $customer,
        ])->setPaper('a4', 'portrait')
        ->setOption([
            'margin-left' => 20,
            'margin-right' => 20,
            'margin-top' => 20,
            'margin-bottom' => 20,
        ]);

        $pdfName = str_replace(' ', '_', $customer->Customer_Name) . '_Statement_of_Accounts.pdf';


        return $pdf->stream($pdfName);
    }

    public function downloadStatement(Request $request)
    {
        $customer = Customers::find($request->customer_id);

        if (!$customer) {
            return back()->with('error', 'Customer not found.');
        }

        $invoices = $customer->invoices()
            ->with('items.product.category')
            ->orderBy('invoice_number', 'asc')
            ->get();

        $pdf = Pdf::loadView('reports.account-summary.statement', [
            'invoices' => $invoices,
            'customer' => $customer,
        ])->setPaper('a4', 'portrait')
        ->setOption([
            'margin-left' => 20,
            'margin-right' => 20,
            'margin-top' => 20,
            'margin-bottom' => 20,
        ]);

        $pdfName = str_replace(' ', '_', $customer->Customer_Name) . '_Statement_of_Accounts.pdf';

        // 🔹 Force download
        return $pdf->download($pdfName);
    }





    public function generateGroupedInvoice(Request $request, string $Customer_Id )
    {

        $request->validate([
            'Sale_Date' => 'required|date',
        ]);

        $Sale_Date = $request->Sale_Date;

        // Retrieve all sales records for the given Sale_Date & Customer_Id
        $sales = Sales::where('Customer_Id', $Customer_Id)
                        ->where('Sale_Date', $Sale_Date)
                        ->get();

        $invoiceDetails = Sales::where('Sale_Date', $Sale_Date)->first();
        
        $CustomerInvoiceDetails = Customers::where('id', $Customer_Id)->first();
        $invoiceName = $CustomerInvoiceDetails->Customer_Name;

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('defaultFont', 'Arial');
        $options->set('isFontSubsettingEnabled', true);
        $options->set('isRemoteEnabled', true); // To load remote resources like images

        $dompdf = new Dompdf($options);

        $now = Carbon::now('Africa/Nairobi');
        $pdfName = 'Inv-' . $invoiceName .'-'. $Sale_Date . '.pdf';

        // Pass the sales collection to the view
        $data = compact('sales', 'invoiceDetails', 'CustomerInvoiceDetails');

        // Render the view to HTML
        $html = view('financials.sales.grouped-invoice', $data)->render();
        $dompdf->loadHtml($html);

        // Set paper size and margins using the correct method
        $dompdf->setPaper('A4', 'portrait');

        // If you need custom margins, use the following to set margins (not set_option):
        $dompdf->set_option('isRemoteEnabled', true); // Make sure remote content (like images) is allowed
        $dompdf->render();

        // Return the PDF as a download
        return response($dompdf->output())
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $pdfName . '"')
            ->header('Content-Length', strlen($dompdf->output()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
