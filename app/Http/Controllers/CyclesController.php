<?php

namespace App\Http\Controllers;

use App\Models\Blocks;
use App\Models\Cycles;
use App\Models\HarvestOrder;
use App\Models\Product;
use Illuminate\Http\Request;

class CyclesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cycles = Cycles::where('Status', 'approved')->get();
        return view('cycles.cycles', [
            'cycles'=> $cycles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $this->authorize('create-cycles');

        $blocks  = Blocks::get();
        $crops = Product::get();
        return view('cycles.create', [
            'blocks'=> $blocks,
            'crops'=> $crops
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $CycleCode = $this->generateCycCode($request);

        $request->validate([
            'Block_Id' => 'required|max:255|integer',
            'Crop' => 'required|max:255|string',
            'Client_Name' => 'required|max:255|string',
            'Cycle_Name' => 'required|max:255|string',
            'Cycle_Start' => 'required|date',
            'Cycle_End' => 'required|date',
            'maker_id' => 'required|max:255|integer',
            ]);
    
        Cycles::create([
            'Cycle_Id'=> $CycleCode,
            'Block_Id' => $request->Block_Id,
            'Crop' => $request->Crop,
            'Client_Name' => $request->Client_Name,
            'Cycle_Name' => $request->Cycle_Name,
            'Cycle_Start' => $request->Cycle_Start,
            'Cycle_End' => $request->Cycle_End,
            'maker_id' => $request->maker_id,
        ]);

        HarvestOrder::create([
            'Cycle_Id' => $CycleCode,
            'company_name' => $request->Client_Name,
            'order_date' => now(),
            'planting_date' => $request->Cycle_Start,
            'harvest_date' => $request->Cycle_End,
            'product_name' => $request->Crop,
            'maker_id' => $request->maker_id,
        ]);
    
        return redirect('new/cycle')->with('status','New Cycle Created');
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

    public function generateCycCode(Request $request)
    {
        $startDate = $request->input('Cycle_Start');
        $endDate = $request->input('Cycle_End');
    
        $startMonth = strtoupper(date('M', strtotime($startDate))); // Capitalize and get the month abbreviation from the start date
        $endMonth = strtoupper(date('M', strtotime($endDate))); // Capitalize and get the month abbreviation from the end date
        $year = date('y', strtotime($startDate)); // Get the last two digits of the year from the start date
    
        // Construct the code with the fixed month range and year
        $Cyclecode = "CYC-$startMonth-$endMonth-$year-";
    
        // Find the last cycle ID in the database for the specific month range and year
        $lastCycleId = Cycles::where('Cycle_Id', 'like', "CYC-$startMonth-$endMonth-$year-%")->max('Cycle_Id');
        $lastSerialNumber = intval(substr($lastCycleId, -3)); // Get the last 3 digits of the last cycle ID
    
        $serialNumber = str_pad($lastSerialNumber + 1, 3, '0', STR_PAD_LEFT); // Increment and pad with zeros
    
        // Append the incremented serial number to the code
        $Cyclecode .= $serialNumber;
    
        return $Cyclecode;
    }
    

    

}
