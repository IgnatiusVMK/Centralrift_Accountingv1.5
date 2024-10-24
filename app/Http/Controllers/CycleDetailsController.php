<?php

namespace App\Http\Controllers;

use App\Models\CapitalWithdrawal;
use App\Models\Financial;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use App\Models\CycleAllocations;

class CycleDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $Cycle_Id = $request->route('Cycle_Id');

        $wages = Financial::where('type', 'expenditure')->where('Status', 'approved')->simplePaginate(15);
        $salaries = Financial::where('type', 'salary')->where('Status', 'approved')->simplePaginate(15);
        $advance = Financial::where('type', 'advance')->where('Status', 'approved')->simplePaginate(15);
        $transport = Financial::where('type', 'transport')->where('Status', 'approved')->simplePaginate(15);
        $electricity = Financial::where('type', 'electricity')->where('Status', 'approved')->simplePaginate(15);
        $maintenance = Financial::where('type', 'maintenance')->where('Status', 'approved')->simplePaginate(15);
        $cpexpenses = Financial::where('type', 'Capital Expenses')->where('Status', 'approved')->simplePaginate(15);
        $withdrawals = CapitalWithdrawal::where('Status', 'approved')->simplePaginate(15);
        $sales = Sales::where('Status', 'approved')->simplePaginate(15);
        // $stocks = DB::table('cycle_allocations')
        //         ->where('Cycle_Id', $Cycle_Id)
        //         ->where('Status', 'approved')
        //         // ->select('Stock_Name', 'Total_Quantity', 'Remaining_Quantity')
        //         ->get();

        $stocks = CycleAllocations::with('stock') // Eager load the stock relationship
        ->where('Cycle_Id', $Cycle_Id)
        ->where('Status', 'approved')
        ->get();

        $inventoryCount = CycleAllocations::with('stock') // Eager load the stock relationship
        ->where('Cycle_Id', $Cycle_Id)
        ->where('Status', 'approved')
        ->count();

        // Prepare data for Chart.js
        // $stockNames = $stocks->pluck('Stock_Name')->toArray(); // Array of stock names
        $inventoryNames = $stocks->pluck('stock.Stock_Name')->toArray();
        $allocatedQuantities = $stocks->pluck('allocated_quantity')->toArray(); // Total quantities
        $remainingQuantities = $stocks->pluck('remaining_quantity')->toArray(); // Remaining quantities

        $usedQuantities = array_map(function($allocated, $remaining) {
            return $allocated - $remaining;
        }, $allocatedQuantities, $remainingQuantities);

        // dd($inventoryNames, $allocatedQuantities, $remainingQuantities);
        $expuniqueCode = $this->generateUniqueCode('wages');
        $advuniqueCode = $this->generateUniqueCode('advance');
        $saluniqueCode = $this->generateUniqueCode('salary');
        $elecuniqueCode = $this->generateUniqueCode('electricity');
        $tranuniqueCode = $this->generateUniqueCode('transport');
        $chemuniqueCode = $this->generateUniqueCode('chemicals');
        $maintuniqueCode = $this->generateUniqueCode('maintenance');
        $cpexpeuniqueCode = $this->generateUniqueCode('maintenance');
        $saleuniqueCode = $this->generateUniqueCode('sales');
        return view('cycles.expenses', [
            'wages'=> $wages,
            'salaries'=> $salaries,
            'advance'=> $advance,
            'transport'=> $transport,
            'electricity'=> $electricity,
            'withdrawal'=> $withdrawals,
            'cpexpenses'=> $cpexpenses,
            'maintenance'=> $maintenance,
            'sales'=> $sales,
            'Cycle_Id'=> $Cycle_Id,
            'expuniqueCode' => $expuniqueCode,
            'advuniqueCode' => $advuniqueCode,
            'saluniqueCode' => $saluniqueCode,
            'elecuniqueCode' => $elecuniqueCode,
            'tranuniqueCode' => $tranuniqueCode,
            'chemuniqueCode' => $chemuniqueCode,
            'maintuniqueCode' => $maintuniqueCode,
            'cpexpeuniqueCode' => $cpexpeuniqueCode,
            'saleuniqueCode' => $saleuniqueCode,
            'inventoryNames' => $inventoryNames,
            'allocatedQuantities' => $allocatedQuantities,
            'remainingQuantities' => $remainingQuantities,
            'usedQuantities' => $usedQuantities,
            'inventoryCount' => $inventoryCount
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
    public function store(Request $request)
    {
        //
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
        // Get the last row for the given type in the Expenditures table
        $lastExpenditure = Financial::where('type', $type)->latest()->first();

        // Extract the last unique code and incrementing number
        $lastCode = $lastExpenditure ? $lastExpenditure->unique_code : '';
        $lastNumber = intval(substr(strrchr($lastCode, "-"), 1)); // Extracts the number after the last dash

        // Generate a new unique code
        $prefix = strtoupper(substr($type, 0, 4)); // Get the first three letters of the type
        $newNumber = $lastNumber + 1;
        $uniqueCode = $prefix . '-' . date('Ymd') . '-' . $newNumber;

        // Check if the generated code already exists in the table, if so, increment the number until a unique code is found
        while (Financial::where('Fin_Id_Id', $uniqueCode)->exists()) {
            $newNumber++;
            $uniqueCode = $prefix . '-' . date('Ymd') . '-' . $newNumber;
        }

        return $uniqueCode;
    }
}
