<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\CapitalWithdrawal;
use Illuminate\Http\Request;

class CapitalWithdrawalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Withdrawals = CapitalWithdrawal::get();
        return view('financials.capital-withdrawal.capitalwithdrawal', compact('Withdrawals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $Cycle_Id = $request->route('Cycle_Id');
        $CpWuniqueCode = $this->generateUniqueCode('CptWithdrawal');
        return view('financials.capital-withdrawal.create', [
            'Cycle_Id' => $Cycle_Id,
            'CpWuniqueCode' => $CpWuniqueCode,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $request->validate([
            'Capt_Withdraw_Id' => 'required|max:255|string',
            'Description' => 'required|max:255|string',
            'Amount' => 'required|integer|max:1000000'
        ]);


        $data = $request->all();
        
        CapitalWithdrawal::create($data);

        $this->payOut($request->Amount, $request->Description, $request->maker_id, $request->Capt_Withdraw_Id);

        $Cycle_Id = $request->route('Cycle_Id');
        return redirect()->route('cycle.capital-withdrawal.create', ['Cycle_Id' => $Cycle_Id])->with('status', 'Withdrawal Recorded');

    }

    public function payOut($amount, $Description, $maker_id, $Capt_Withdraw_Id)
    {
        $transactionId = $this->getNextTransactionId();
    
        $lastAccount = Account::latest()->first();
        $balance = $lastAccount ? $lastAccount->Bal : 0;
        $balance -= $amount;
    
        Account::create([
            'Transaction_Id' => $transactionId,
            'Financial_Id'=> $Capt_Withdraw_Id,
            'Description' => $Description,
            'Crd_Amnt' => 0,
            'Dbt_Amt' => $amount,
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

        $lastCredit = CapitalWithdrawal::latest()->first();
    
        $lastCode = $lastCredit ? $lastCredit->unique_code : '';
        $lastNumber = intval(substr(strrchr($lastCode, "-"), 1)); 
    
        $prefix = strtoupper(substr($type, 0, 4));
        $newNumber = $lastNumber + 1;
        $uniqueCode = $prefix . '-' . date('Ymd') . '-' . $newNumber;
    
        while (CapitalWithdrawal::where('Capt_Withdraw_Id', $uniqueCode)->exists()) {
            $newNumber++;
            $uniqueCode = $prefix . '-' . date('Ymd') . '-' . $newNumber;
        }
    
        return $uniqueCode;
    }
}
