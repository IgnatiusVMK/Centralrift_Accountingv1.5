<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Customers;
use App\Models\ProductsSales;
use App\Models\Sales;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->authorize('view-sales');

        $sales = Sales::orderBy("Sale_Date","desc")->paginate(15);
        return view('financials.sales.sales', [
            'sales' => $sales,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request){

        $Cycle_Id = $request->route('Cycle_Id');
        $Customers = Customers::get();
        $SaleuniqueCode = $this->generateUniqueCode('Sales');
        return view('financials.sales.create', [
            'Cycle_Id' => $Cycle_Id,
            'Customers' => $Customers,
            'SaleuniqueCode' => $SaleuniqueCode,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'maker_id' => 'required|max:255|integer',
            'Sales_Id' => 'required|max:255|string',
            'Customer_Id' => 'required|max:255|string',
            'Cycle_Id' => 'required|max:255|string',
            'Sale_Date' => 'required|date',
            'Quantity' => 'required|integer|max:1000000',
            'Total_Price' => 'required|integer|max:1000000',
            /* 'Payment_Method' => 'required|max:255|string', */
            'Payment_Status' => 'required|max:255|string',
        ]);

        Sales::create([
            'maker_id' => $request->maker_id,
            'Sales_Id' => $request->Sales_Id,
            'Customer_Id' => $request->Customer_Id,
            'Cycle_Id' => $request->Cycle_Id,
            'Sale_Date' => $request->Sale_Date,
            'Quantity' => $request->Quantity,
            'Total_Price' => $request->Total_Price,
            /* 'Payment_Method' => $request->Payment_Method, */
            'Payment_Status' => $request->Payment_Status,
        ]);

        $this->payIn($request->Total_Price, $request->Cycle_Id, $request->Customer_Id, $request->maker_id, $request->Sales_Id);

        // Update or create records in products_sales table
        /* foreach ($request->products'] as $product) {
            ProductsSales::updateOrCreate(
                [
                    'Product_Id' => $product['Product_Id'],
                    'Sales_Id' => $sale->Sales_Id,
                ],
                [
                    'Quantity' => $product['Quantity'],
                    'Unit_Price' => $product['Unit_Price'],
                ]
            );
        } */

        $Cycle_Id = $request->route('Cycle_Id');
        return redirect()->route('cycle.sales.create', ['Cycle_Id' => $Cycle_Id])->with('status', 'Sale Recorded.');
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
