<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Financial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\throwException;

class ExpendituresController extends Controller
{
    public function index()
    {
        $financials = Financial::where('type', 'expenditure')->where('Status', 'approved')->simplePaginate(10);
        return view('financials.expenditures.financials', compact('financials'))
            ->with('create', true);;
    }
    public function store(Request $request)
    {

        $data = $request->validate([
            'maker_id' => 'required|max:255|integer',
            'Fin_Id_Id' => 'required|max:255|string',
            'Reason' => 'required|max:255|string',
            'Description' => 'required|max:255|string',
            'Amount' => 'required|integer|max:1000000',
            'Cycle_Id' => 'required|max:255|string',
        ]);


        // $data = $request->all();
        
        DB::transaction(function () use ($data, $request) {

            $data['type'] = 'expenditure';

            /* dd($data); */

            Financial::create($data);

            $this->payOut($request->Amount, $request->Cycle_Id, $request->Description, $request->maker_id);
        });
        
        return redirect()->route('cycle.wages.create', ['Cycle_Id' => $request->Cycle_Id])->with('status', 'Record Created');
    }
    public function payOut($amount, $Cycle, $Description, $maker_id)
    {
        $transactionId = $this->getNextTransactionId();

        $lastAccount = Account::latest()->first();
        $balance = $lastAccount ? $lastAccount->Bal : 0;
        $balance -= $amount;

        Account::create([
            'Transaction_Id' => $transactionId,
            'Cycle_Id' => $Cycle,
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
