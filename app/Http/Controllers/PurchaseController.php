<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Stocks;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = Purchase::get();
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
        //
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

        $purchase = Purchase::create([
            'maker_id'=>$request->maker_id,
            'Item_Name'=>$request->Item_Name,
            'Supplier_Id'=>$request->Supplier_Id,
            'Category_Id'=>$request->Category_Id,
            'Quantity'=>$request->Quantity,
            'Unit_Cost'=>$request->Unit_Cost,
            'Total_Cost'=>$request->Total_Cost,
            'Purchase_Date'=>$request->Purchase_Date,
        ]);

        $this->newStock($purchase->id, $request->Item_Name,$request->Quantity,$request->maker_id,);

        return redirect()->back()->with('success','New Inventory Created');
    }
    public function newStock($purchaseId,$Stock_Name, $Total_Quantity,$maker_id){
        Stocks::create([
            'id' => $purchaseId,
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
}
