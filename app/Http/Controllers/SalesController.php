<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Customers;
use App\Models\Cycles;
use App\Models\ProductsSales;
use App\Models\Sales;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->authorize('view-sales');

        $sales = Sales::where('Status', 'approved')->orderBy("Sale_Date","desc")->paginate(15);
        return view('financials.sales.sales', [
            'sales' => $sales,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request){

        $Cycle_Id = $request->route('Cycle_Id');
        $cycle = Cycles::where('Cycle_Id', $Cycle_Id)->first();
        $Customers = Customers::get();
        $SaleuniqueCode = $this->generateUniqueCode('Sales');
        return view('financials.sales.create', [
            'Cycle_Id' => $Cycle_Id,
            'cycle' => $cycle,
            'Customers' => $Customers,
            'SaleuniqueCode' => $SaleuniqueCode,
        ]);
    }

    public function store(Request $request)
{

    // Validate the request data
    $request->validate([
        'maker_id' => 'required|integer|exists:users,id',
        'Cycle_Id' => 'required|string|max:255',
        'Sales_Id' => 'required|string|max:255|unique:sales,Sales_Id',
        'Customer_Id' => 'required|integer|exists:customers,id',
        'Cust_Account_No' => 'required|numeric|min:256',
        /* 'Lpo_No' => 'required|string|max:255', */
        'Description' => 'required|string',
        'packaging_option' => 'required|string|max:255',
        'Quantity' => 'required|numeric|min:0',
        'Unit_Price' => 'required|numeric|min:0',
        'Total_Price' => 'required|numeric|min:0',
        'Sale_Date' => 'required|date',
        'Payment_Status' => 'required|string|max:255',
        /* 'Net_Weight' => 'required_if:product_type,Herbs|numeric|min:0', */
    ]);

    /* Log::info('Sale data:', [
        'maker_id' => $request->maker_id,
        'Cycle_Id' => $request->Cycle_Id,
        'Sales_Id' => $request->Sales_Id,
        'Customer_Id' => $request->Customer_Id,
        'Cust_Account_No'=> $request->Cust_Account_No,
        'Lpo_No' => $request->Lpo_No,
        'Description' => $request->Description,
        'packaging_option' => $request->packaging_option,
        'Quantity' => $request->Quantity,
        'Unit_Price' => $request->Unit_Price,
        'Total_Price' => $request->Total_Price,
        'Payment_Status' => $request->Payment_Status,
        'Sale_Date' => $request->Sale_Date,
        'Net_Weight' => $request->Net_Weight,
    ]); */

    // Create the Sales record
    Sales::create([
        'maker_id' => $request->maker_id,
        'Sales_Id' => $request->Sales_Id,
        'Customer_Id' => $request->Customer_Id,
        'Cust_Account_No' => $request->Cust_Account_No,
        'Cycle_Id' => $request->Cycle_Id,
        'Lpo_No' => $request->Lpo_No,
        'Sale_Date' => $request->Sale_Date,
        'Net_Weight' => $request->Net_Weight,
        'Unit_Price' => $request->Unit_Price,
        'Total_Price' => $request->Total_Price,
        'Payment_Status' => $request->Payment_Status,
        'packaging_option' => $request->packaging_option,
        'Description' => $request->Description,
        'Quantity' => $request->Quantity,
    ]);

    // Call your payIn method (if needed)
    $this->payIn($request->Total_Price, $request->Cycle_Id, $request->Description.'-Sales-'.$request->Net_Weight, $request->maker_id, $request->Sales_Id);

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

    public function generateInvoice(Request $request, string $Sales_Id)
    {
        // Retrieve all sales records for the given Sales_Id
        $sales = Sales::where('Sales_Id', $Sales_Id)->get();

        $invoiceDetails = Sales::where('Sales_Id', $Sales_Id)->first();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('defaultFont', 'Arial');
        $options->set('isFontSubsettingEnabled', true);
        $options->set('isRemoteEnabled', true); // To load remote resources like images

        $dompdf = new Dompdf($options);

        $now = Carbon::now('Africa/Nairobi');
        $pdfName = 'Inv-' . $Sales_Id . '.pdf';

        // Pass the sales collection to the view
        $data = compact('sales', 'invoiceDetails');

        // Render the view to HTML
        $html = view('financials.sales.invoice', $data)->render();
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
