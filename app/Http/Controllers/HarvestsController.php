<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Cycles;
use App\Models\Harvests;
use Illuminate\Http\Request;

class HarvestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $harvests= Harvests::where('Status', 'approved')->get();
        return view('harvests.harvest', compact('harvests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cycles= Cycles::where('Status', 'approved')->get();
        $customers = Customers::get();
        return view('harvests.create', compact('cycles', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form input
        $request->validate([
            'maker_id' => 'required|exists:users,id',
            'Cycle_Id' => 'required|exists:cycles,Cycle_Id',
            'Product' => 'required|string|max:255',
            'Customer_Name' => 'required|string|max:255',
            'Harvest_Date' => 'required|date',
            'Quantity_Harvested' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/', // Decimal validation
            'Quantity_Spoilt' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/', // Decimal validation
            'Grade' => 'nullable|string|max:255',
            'Remarks' => 'nullable|string',
        ]);

        // Create a new Harvest record
        $harvest = new Harvests();
        $harvest->maker_id = $request->maker_id;
        $harvest->Cycle_Id = $request->Cycle_Id;
        $harvest->Product = $request->Product;
        $harvest->Customer_Name = $request->Customer_Name;
        $harvest->Harvest_Date = $request->Harvest_Date;
        $harvest->Quantity_Harvested = $request->Quantity_Harvested;
        $harvest->Quantity_Spoilt = $request->Quantity_Spoilt;
        $harvest->Quality_grade = $request->Quality_Grade;
        $harvest->Remarks = $request->Remarks;

        // Save the record to the database
        $harvest->save();

        // Redirect back with a success message
        return redirect()->route('harvests')->with('success', 'Harvest record created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Harvests $harvests)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Harvests $harvests)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Harvests $harvests)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Harvests $harvests)
    {
        //
    }
}
