<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\HarvestOrder;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function index()
    {
        $countOrders =  HarvestOrder::count();
        $countSales = Sales::count();
        $harvestOrders = HarvestOrder::whereDate('harvest_date', '>', now())->get();
        $completedHarvestOrders = HarvestOrder::whereDate('harvest_date', '<', now())->get();

        $accountController = new AccountController();
        $summary = $accountController->summary();

        $cyclesByProduct = $this->listCyclesByProduct();

        return view('dashboard', [
            'cyclesByProduct'=> $cyclesByProduct,
            'countOrders'=> $countOrders,
            'countSales'=> $countSales,
            'harvestOrders' => $harvestOrders,
            'completedHarvestOrders' => $completedHarvestOrders,
            'summary' => $summary,
            'totalCredit' => $summary['totalCredit'],
            'totalDebit' => $summary['totalDebit'],
            'balance' => $summary['balance'],
        ]);
    }

    public function getOrderCount(){
        $countOrders = HarvestOrder::count();
        return $countOrders;
    }
    public function listCyclesByProduct()
{
    $cyclesByProduct = DB::table('harvest_orders')
        ->select('product_name', DB::raw('COUNT(DISTINCT cycle_id) as cycle_count'))
        ->groupBy('product_name')
        ->orderByDesc('cycle_count')
        ->get();

    return $cyclesByProduct;
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('add-order');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|max:255|string',	
            'order_date' => 'required|date',
            'planting_date' => 'required|date',
            'harvest_date' => 'required|date',
            'product_name' => 'required|max:255|string',
        ]);

        HarvestOrder::create([
            'company_name' => $request->company_name,	
            'order_date' => $request->order_date,
            'planting_date' => $request->planting_date,	
            'harvest_date' => $request->harvest_date,
            'product_name' => $request->product_name,
        ]);

        return redirect('add-order')->with('status','Order Created');
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
