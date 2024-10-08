<?php

namespace App\Http\Controllers;

use App\Models\CycleAllocations;
use App\Models\Cycles;
use App\Models\Stocks;
use Illuminate\Http\Request;

class CycleAllocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = Stocks::with('purchase')->where('Status', 'approved')->get();
        $cycles = Cycles::all();
        return view ('cycle-allocations.view',
        [
            'stocks' => $stocks,
            'cycles' => $cycles
        ]);
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
    public function store(Request $request, int $stock_id, string $Cycle_Id)
    {
        $request->validate([
            'maker_id'=>'required|numeric',
            'stock_id'=>'required|numeric',
            'remaining_quantity'=>'required|numeric',
            'Cycle_Id' => 'required|string|max:255',
            'allocated_quantity' =>'required|numeric',
            'allocation_date' => 'required|date',
        ]);

        CycleAllocations::create([
            'Cycle_Id'=> $request->Cycle_Id,
            'stock_id'=> $request->stock_id,
            'allocated_quantity' => $request->allocated_quantity,
            'allocation_date'  => $request->allocation_date,
            'remaining_quantity' => $request->allocated_quantity,
            'maker_id' => $request->maker_id,
        ]);

        $upt_Remaining_Quantity = $request->remaining_quantity - $request->allocated_quantity;

        $this->allocateInventory($request->stock_id, $upt_Remaining_Quantity);

        return redirect()->back()->with('success','Inventory allocated');
    }

    public function allocateInventory($stock_id, $upt_Remaining_Quantity){
        $updateSocks = Stocks::findOrFail($stock_id);

        $updateSocks->update([
            'Remaining_Quantity'=>$upt_Remaining_Quantity,
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
