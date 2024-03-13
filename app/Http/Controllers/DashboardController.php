<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\HarvestOrder;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function index()
    {
        $harvestOrders = HarvestOrder::whereDate('harvest_date', '>', now())->get();
        $completedHarvestOrders = HarvestOrder::whereDate('harvest_date', '<', now())->get();

        $accountController = new AccountController();
        $summary = $accountController->summary();

        return view('dashboard', [
            'harvestOrders' => $harvestOrders,
            'completedHarvestOrders' => $completedHarvestOrders,
            'summary' => $summary,
            'totalCredit' => $summary['totalCredit'],
            'totalDebit' => $summary['totalDebit'],
            'balance' => $summary['balance'],
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
