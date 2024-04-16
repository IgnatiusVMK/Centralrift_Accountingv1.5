<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Financial;
use Illuminate\Http\Request;

class CapitalExpensesController extends Controller
{
    public function index()
    {
        $cpexpenses = Financial::where('type', 'Capital Expenses')->simplePaginate(10);
        return view('financials.capital-expenses.capital-expenses', compact('cpexpenses'))
        ->with('create', true);;
        
    }
    public function create(Request $request)
    {
        $Cycle_Id = $request->route('Cycle_Id');
        $cpexpeuniqueCode = $this->generateUniqueCode('CpExpenses');
        return view('financials.capital-expenses.create', [
            'Cycle_Id'=> $Cycle_Id,
            'cpexpeuniqueCode' => $cpexpeuniqueCode,
        ]);
    }
    private function generateUniqueCode($type)
    {
        $lastExpenditure = Financial::where('type', $type)->latest()->first();

        $lastCode = $lastExpenditure ? $lastExpenditure->unique_code : '';
        $lastNumber = intval(substr(strrchr($lastCode, "-"), 1));

        $prefix = strtoupper(substr($type, 0, 4));
        $newNumber = $lastNumber + 1;
        $uniqueCode = $prefix . '-' . date('Ymd') . '-' . $newNumber;

        while (Financial::where('Fin_Id_Id', $uniqueCode)->exists()) {
            $newNumber++;
            $uniqueCode = $prefix . '-' . date('Ymd') . '-' . $newNumber;
        }

        return $uniqueCode;
    }

    public function store(Request $request){
        
        $request->validate([
            'Fin_Id_Id' => 'required|max:255|string',
            'Reason' => 'required|max:255|string',
            'Description' => 'required|max:255|string',
            'Amount' => 'required|integer|max:1000000',
            'Cycle_Id' => 'required|max:255|string',
        ]);

        $data = $request->all();
        $data['type'] = 'Capital Expenses';

        Financial::create($data);

        $this->payOut($request->Amount, $request->Cycle_Id ,$request->Description);

        return redirect()->route('cycle.capital-expenses.create', ['Cycle_Id' => $request->Cycle_Id])->with('status', 'Record Created');
    }
    public function payOut($amount, $Cycle, $Description)
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
}
