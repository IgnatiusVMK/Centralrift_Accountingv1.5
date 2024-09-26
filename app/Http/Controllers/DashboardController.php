<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\HarvestOrder;
use App\Models\Sales;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function index()
    {
        $countOrders =  $this->getOrderCount();
        $countSales = Sales::where('Status','approved')->count();
        $harvestOrders = HarvestOrder::where('Status','approved')->whereDate('harvest_date', '>', now())->get();
        $completedHarvestOrders = HarvestOrder::where('Status','approved')->whereDate('harvest_date', '<', now())->get();

        // $currentMonth = Carbon::now()->month;
        // $currentYear = Carbon::now()->year;

        // $dailyData = Account::selectRaw('DATE(Date_Created) as date, SUM(Crd_Amnt) as totalAccCredit, SUM(Dbt_Amt) as totalAccDebit')
        // ->whereMonth('Date_Created', $currentMonth)  // Filter by current month
        // ->whereYear('Date_Created', $currentYear)    // Filter by current year
        // ->groupBy('date')
        // ->orderBy('date')
        // ->get();
        $dailyData = Account::selectRaw('DATE(Date_Created) as date, SUM(Crd_Amnt) as totalAccCredit, SUM(Dbt_Amt) as totalAccDebit')
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        // Prepare arrays for the chart
        $dates = $dailyData->pluck('date');
        $totalAccCredit = $dailyData->pluck('totalAccCredit');
        $totalAccDebit = $dailyData->pluck('totalAccDebit');

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
            'totalAccCredit' => $totalAccCredit,
            'totalAccDebit' => $totalAccDebit,
            'dates' => $dates,
        ]);
    }

    public function getOrderCount(){
        $countOrders = HarvestOrder::where('Status','approved')->count();
        return $countOrders;
    }
    public function listCyclesByProduct()
{
    $cyclesByProduct = DB::table('harvest_orders')
        ->select('product_name', DB::raw('COUNT(DISTINCT cycle_id) as cycle_count'))
        ->where('Status','approved')
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
