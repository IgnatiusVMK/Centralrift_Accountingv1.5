<?php

namespace App\Http\Controllers;

use App\Models\CustomerContacts;
use App\Models\Customers;
use App\Models\Sales;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;

class CustomerSalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request, $Customer_Id)
    {
        // Fetch all customers with their salespersons
        $customers = Customers::with('salespersons')->get();
        $customers_details =  Customers::where('id', $Customer_Id)->first();

        $custom_sales = Sales::where('Customer_Id', $Customer_Id)->get();
        $dates = $custom_sales->pluck('Sale_Date');

        // Get the Customer_Id from the request
        $Customer_Id = $request->route('id');
        $Sales_Id = $request->route('Sales_Id');

        // Fetch the customer name based on the Customer_Id
        $Customer_Name = Customers::where('id', $Customer_Id)->value('Customer_Name');

        
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
        $pdfName = 'Inv-' . $invoiceName .'-'. $now ->format('Y-m-d-H-i-s') . '.pdf';

        // Pass the sales collection to the view
        $data = compact('sales', 'invoiceDetails');

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
