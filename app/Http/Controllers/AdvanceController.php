<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Financial;
use Illuminate\Http\Request;

class AdvanceController extends Controller
{
    public function index(){
        $financials = Financial::where('type', 'advance')->simplePaginate(5);
        return view('financials.advance.financials', compact('financials'))
        ->with('create', true);;
    }
    public function create(){
        $uniqueCode = $this->generateUniqueCode('advance');
        return view('financials.advance.create', ['uniqueCode' => $uniqueCode]);
    }
    public function store(Request $request){
        $request->validate([
            'Fin_Id_Id' => 'required|max:255|string',
            'Reason' => 'required|max:255|string',
            'Description' => 'required|max:255|string',
            'Amount' => 'required|integer|max:1000000',
            'Date' => 'required|date'
        ]);

        $data = $request->all();
        $data['type'] = 'advance';

        Financial::create($data);

        $this->payOut($request->Amount, $request->Description);

        return redirect('financials/advance/create')->with('status','Record Created');
    }
    public function payOut($amount, $Description)
    {
        $transactionId = $this->getNextTransactionId();
    
        $lastAccount = Account::latest()->first();
        $balance = $lastAccount ? $lastAccount->Bal : 0;
        $balance -= $amount;
    
        Account::create([
            'Transaction_Id' => $transactionId,
            'Description' => $Description,
            'Crd_Amnt' => 0,
            'Dbt_Amt' => $amount,
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
    // Get the last row for the given type in the advance table
    $lastAdvance = Financial::where('type', $type)->latest()->first();

    // Extract the last unique code and incrementing number
    $lastCode = $lastAdvance ? $lastAdvance->unique_code : '';
    $lastNumber = intval(substr(strrchr($lastCode, "-"), 1)); // Extracts the number after the last dash

    // Generate a new unique code
    $prefix = strtoupper(substr($type, 0, 3)); // Get the first three letters of the type
    $newNumber = $lastNumber + 1;
    $uniqueCode = $prefix . '-' . date('Ymd') . '-' . $newNumber;

    // Check if the generated code already exists in the table, if so, increment the number until a unique code is found
    while (Financial::where('Fin_Id_Id', $uniqueCode)->exists()) {
        $newNumber++;
        $uniqueCode = $prefix . '-' . date('Ymd') . '-' . $newNumber;
    }

    return $uniqueCode;
}

}
