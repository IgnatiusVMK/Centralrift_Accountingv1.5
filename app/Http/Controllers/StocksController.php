<?php

namespace App\Http\Controllers;

use App\Models\Stocks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = DB::table('stocks')
                ->select('Stock_Name', 'Total_Quantity', 'Remaining_Quantity')
                ->get();

        $stock_act_vals = Stocks::with('purchase')->get();
        // Prepare data for Chart.js
        $stockNames = $stocks->pluck('Stock_Name')->toArray(); // Array of stock names
        $totalQuantities = $stocks->pluck('Total_Quantity')->toArray(); // Total quantities
        $remainingQuantities = $stocks->pluck('Remaining_Quantity')->toArray(); // Remaining quantities

        // Allocated stock is the difference between total and remaining
        $allocatedQuantities = array_map(function($total, $remaining) {
            return $total - $remaining;
        }, $totalQuantities, $remainingQuantities);

        // dd($stockNames, $totalQuantities, $allocatedQuantities, $remainingQuantities);

        return view('stock.index', [
            'stock_act_vals' => $stock_act_vals,
            'stockNames' => $stockNames,
            'totalQuantities' => $totalQuantities,
            'allocatedQuantities' => $allocatedQuantities,
            'remainingQuantities' => $remainingQuantities
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
}
