<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Credit;
use Illuminate\Http\Request;

class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $credits = Credit::get();
        return view('credit.credit', compact('credits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $uniqueCode = $this->generateUniqueCode('Credit');
        return view('credit.create', ['uniqueCode' => $uniqueCode]);
    }

    public function store(Request $request){
        $request->validate([
            'Credit_Id' => 'required|max:255|string',
            'Source' => 'required|max:255|string',
            'Description' => 'required|max:255|string',
            'Amount' => 'required|integer|max:1000000'
        ]);


        $data = $request->all();
        
        Credit::create($data);

        $this->payIn($request->Amount, $request->Description);

        return redirect('credit/create')->with('status','Credit Recorded');
    }

    public function payIn($amount, $Source)
    {
        $transactionId = $this->getNextTransactionId();
    
        $lastAccount = Account::latest()->first();
        $balance = $lastAccount ? $lastAccount->Bal : 0;
        $balance += $amount;
    
        Account::create([
            'Transaction_Id' => $transactionId,
            'Description' => $Source,
            'Crd_Amnt' => $amount,
            'Dbt_Amt' => 0,
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

        $lastCredit = Credit::latest()->first();
    
        $lastCode = $lastCredit ? $lastCredit->unique_code : '';
        $lastNumber = intval(substr(strrchr($lastCode, "-"), 1)); 
    
        $prefix = strtoupper(substr($type, 0, 4));
        $newNumber = $lastNumber + 1;
        $uniqueCode = $prefix . '-' . date('Ymd') . '-' . $newNumber;
    
        while (Credit::where('Credit_Id', $uniqueCode)->exists()) {
            $newNumber++;
            $uniqueCode = $prefix . '-' . date('Ymd') . '-' . $newNumber;
        }
    
        return $uniqueCode;
    }
}
