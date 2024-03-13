<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Credit;
use App\Models\Financial;
use App\Models\Purchase;
use App\Models\Sales;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $request->validate([
            'Crd_Amnt' => 'required|numeric',
            'Dbt_Amt' => 'required|numeric',
            'Bal' => 'required|numeric',
            'Crd_Dbt_Date' => 'required|date',
            'Date_Created' => 'required|date',
        ]);
    
        $data = $request->all();
        $data['Description'] = $request->Fin_Id_Id; 
    

        $account = Account::createWithTransactionId($data);

        /* // Create corresponding records in associated tables
        Financial::create([
            'Transaction_Id' => $account->Description,
            // Add other necessary fields
        ]);

        Sales::create([
            'Transaction_Id' => $account->Description,
            // Add other necessary fields
        ]);

        Purchase::create([
            'Transaction_Id' => $account->Description,
            // Add other necessary fields
        ]);

        Credit::create([
            'Transaction_Id' => $account->Description,
            // Add other necessary fields
        ]); */

        $this->updateBalance($account->id);
    }

    public static function getNextTransactionId()
    {
        
        $lastAccount = Account::latest()->first();

        $lastTransactionId = $lastAccount ? $lastAccount->Transaction_Id : 0;
        $lastNumber = intval(substr(strrchr($lastTransactionId, "-"), 1));
        $newNumber = $lastNumber + 1;

        $prefix = 'Txd-' . date('nY');
        $newTransactionId = $prefix . '-' . $newNumber;

        return $newTransactionId;
    }
    public static function createWithTransactionId($data)
    {
  
        $data['Transaction_Id'] = self::getNextTransactionId();
        $account = Account::create($data);

        $accountController = new AccountController();
        $accountController->updateBalance($account->id);

        return $account;
    }
    public function updateBalance($id)
    {
        $account = Account::findOrFail($id);

        $balance = $account->Bal + $account->Crd_Amnt - $account->Dbt_Amt;

        $account->update(['Bal' => $balance]);

        return redirect()->back()->with('success', 'Balance updated successfully.');
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

    public function payOut($amount, $Fin_Id_Id)
{
    // Calculate the balance
    $lastAccount = Account::latest()->first();
    $balance = $lastAccount ? $lastAccount->Bal : 0;
    $balance -= $amount;

    // Create a new record in the accounts table
    Account::create([
        'Description' => $Fin_Id_Id,
        'Crd_Amnt' => 0,
        'Dbt_Amt' => $amount,
        'Bal' => $balance,
        'Crd_Dbt_Date' => now(),
        'Date_Created' => now(),
    ]);
}

/* public function payOut($amount, $Fin_Id_Id)
{
    // Calculate the balance
    $lastAccount = Account::latest()->first();
    $balance = $lastAccount ? $lastAccount->Bal : 0;
    $balance -= $amount;

    // Create a new record in the accounts table
    Account::create([
        'Description' => $Fin_Id_Id,,
        'Crd_Amnt' => 0,
        'Dbt_Amt' => $amount,
        'Bal' => $balance,
        'Crd_Dbt_Date' => now(),
        'Date_Created' => now(),
    ]);
}

 */


/* public function summary()
{
    $totalCredit = Account::sum('Crd_Amnt');
    $totalDebit = Account::sum('Dbt_Amt');
    
    
      // Get the value of the Bal column from the last row
      $balance = Account::latest('id')->value('Bal');

    return view('dashboard', [
        'totalCredit' => $totalCredit,
        'totalDebit' => $totalDebit,
        'balance' => $balance
    ]);
}
 */


 public function summary()
    {
        $totalCredit = Account::sum('Crd_Amnt');
        $totalDebit = Account::sum('Dbt_Amt');
        $balance = Account::latest('id')->value('Bal');

        return [
            'totalCredit' => $totalCredit,
            'totalDebit' => $totalDebit,
            'balance' => $balance
        ];
    }


}
