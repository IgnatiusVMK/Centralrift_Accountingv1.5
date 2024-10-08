<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Purchase;
use App\Models\Stocks;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = Purchase::where('Status', 'approved')->get();
        return view('purchase.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $suppliers= Supplier::all();
        return view('purchase.create', [
            'suppliers'=> $suppliers,  
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $PurchaseuniqueCode = $this->generateUniqueCode('Purchase');

        $request->validate([
            'maker_id' => 'required|numeric',
            'Item_Name' => 'required|max:255|string',
            'Supplier_Id' => 'required|numeric',
            'Category_Id' => 'required|numeric',
            'Quantity' => 'required|numeric|min:0',
            'Unit_Cost' => 'required|numeric|min:0',
            'Total_Cost' => 'required|numeric|min:0',
            'Purchase_Date' => 'required|date',
        ]);

        DB::transaction(function() use ($request) {
            // Create a purchase entry

            $PurchaseuniqueCode = $this->generateUniqueCode('Purchase');

            $purchase = Purchase::create([
                'Purchase_Id' => $PurchaseuniqueCode,
                'maker_id' => $request->maker_id,
                'Item_Name' => $request->Item_Name,
                'Supplier_Id' => $request->Supplier_Id,
                'Category_Id' => $request->Category_Id,
                'Quantity' => $request->Quantity,
                'Unit_Cost' => $request->Unit_Cost,
                'Total_Cost' => $request->Total_Cost,
                'Purchase_Date' => $request->Purchase_Date,
            ]);
            // dd($PurchaseuniqueCode);

            // Ensure the purchase was created before inserting into stocks
            if ($purchase) {
                // Create a new stock entry (ensure foreign key is correctly linked)
                $this->newStock($PurchaseuniqueCode, $request->Item_Name, $request->Quantity, $request->maker_id);
            
                // Register a payout for the purchase
                $this->payOut($request->Total_Cost, 'Purchase-' . $request->Item_Name . '-' . $request->Quantity, $request->maker_id, $PurchaseuniqueCode);
            }
        });

        return redirect()->back()->with('success','New Inventory Created');
    }
    public function payOut($amount, $Description, $maker_id, $Fin_Id_Id)
    {
        $transactionId = $this->getNextTransactionId();

        $lastAccount = Account::latest()->first();
        $balance = $lastAccount ? $lastAccount->Bal : 0;
        $balance -= $amount;

        Account::create([
            'Transaction_Id' => $transactionId,
            'Financial_Id'=> $Fin_Id_Id,
            'Description' => $Description,
            'Crd_Amnt' => 0,
            'Dbt_Amt' => $amount,
            'maker_id' => $maker_id,
            'Bal' => $balance,
            'Crd_Dbt_Date' => now(),
            'Date_Created' => now(),
        ]);
    }
    public function newStock($Purchase_Id, $Stock_Name, $Total_Quantity, $maker_id){

        // dd($purchase_Id);
        Stocks::create([
            'Purchase_Id' => $Purchase_Id,
            'Stock_Name' => $Stock_Name,
            'Total_Quantity' => $Total_Quantity,
            'Remaining_Quantity' => $Total_Quantity,
            'maker_id' => $maker_id,
        ]);
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

        $lastPurchase = Purchase::latest()->first();
    
        $lastCode = $lastPurchase ? $lastPurchase->unique_code : '';
        $lastNumber = intval(substr(strrchr($lastCode, "-"), 1)); 
    
        $prefix = strtoupper(substr($type, 0, 4));
        $newNumber = $lastNumber + 1;
        $uniqueCode = $prefix . '-' . date('Ymd') . '-' . $newNumber;
    
        while (Purchase::where('Purchase_Id', $uniqueCode)->exists()) {
            $newNumber++;
            $uniqueCode = $prefix . '-' . date('Ymd') . '-' . $newNumber;
        }
    
        return $uniqueCode;
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
