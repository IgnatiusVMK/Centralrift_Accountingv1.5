<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Cycles;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfitLossController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cycles = Cycles::all();

        return view('finance.profit-loss', ['cycles' => $cycles]);
    }

    public function compare(Request $request)
    {
        $cycleIds = $request->input('cycles');
        $data = [];

        $cycles = [];

        if ($cycles != null) {
        foreach ($cycleIds as $cycleId) {
            $revenue = Account::where('Cycle_Id', $cycleId)->sum('Crd_Amnt');
            $expenses = Account::where('Cycle_Id', $cycleId)->sum('Dbt_Amt');
            $profitOrLoss = $revenue - $expenses;

            $data[] = [
                'cycleId' => $cycleId,
                'revenue' => $revenue,
                'expenses' => $expenses,
                'profitOrLoss' => $profitOrLoss,
            ];
        }
    }

        return response()->json($data);
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
    public function show($cycleId)
    {
        $revenue = 0;
        $expenses = 0;
        $profitOrLoss = 0;

        $revenue = Account::where('Cycle_Id', $cycleId)->sum('Crd_Amnt');
        $expenses = Account::where('Cycle_Id', $cycleId)->sum('Dbt_Amt');
        $profitOrLoss = $revenue - $expenses;

        return response()->json([
            'revenue' => $revenue,
            'expenses' => $expenses,
            'profitOrLoss' => $profitOrLoss,
        ]);
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
