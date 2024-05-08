<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Financial;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $maintenance = Financial::where('type', 'maintenance')->simplePaginate(15);
        return view('financials.maintenance.maintenance', compact('maintenance'))
        ->with('create', true);;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        
        $request->validate([
            'Fin_Id_Id' => 'required|max:255|string',
            'Reason' => 'required|max:255|string',
            'Description' => 'required|max:255|string',
            'Amount' => 'required|integer|max:1000000',
            'Cycle_Id' => 'required|max:255|string',
        ]);

        $data = $request->all();
        $data['type'] = 'maintenance';

        Financial::create($data);

        $this->payOut($request->Amount, $request->Cycle_Id ,$request->Description, $request->maker_id);

        return redirect()->route('cycle.maintenance.create', ['Cycle_Id' => $request->Cycle_Id])->with('status', 'Record Created');
    }
    public function payOut($amount, $Cycle, $Description, $maker_id)
    {
        $transactionId = $this->getNextTransactionId();
    
        $lastAccount = Account::latest()->first();
        $balance = $lastAccount ? $lastAccount->Bal : 0;
        $balance -= $amount;
    
        Account::create([
            'Transaction_Id' => $transactionId,
            'Cycle_Id'=> $Cycle,
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
}
