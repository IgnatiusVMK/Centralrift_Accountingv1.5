<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\HarvestOrder;
use App\Models\Sales;
use App\Models\Customers;
use App\Models\Invoice;
use App\Models\Purchase;
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
        // Upcoming harvests within the next 30 days
        $harvestOrders = HarvestOrder::where('Status','approved')
            ->whereBetween('harvest_date', [now()->toDateString(), now()->addDays(30)->toDateString()])
            ->orderBy('harvest_date')
            ->get();

        // Completed harvests within the past 30 days
        $completedHarvestOrders = HarvestOrder::where('Status','approved')
            ->whereBetween('harvest_date', [now()->subDays(30)->toDateString(), now()->toDateString()])
            ->orderByDesc('harvest_date')
            ->get();

        // $currentMonth = Carbon::now()->month;
        // $currentYear = Carbon::now()->year;

        // $dailyData = Account::selectRaw('DATE(Date_Created) as date, SUM(Crd_Amnt) as totalAccCredit, SUM(Dbt_Amt) as totalAccDebit')
        // ->whereMonth('Date_Created', $currentMonth)  // Filter by current month
        // ->whereYear('Date_Created', $currentYear)    // Filter by current year
        // ->groupBy('date')
        // ->orderBy('date')
        // ->get();
        // Account daily data limited to the last 30 days to keep charts responsive
        $dailyData = Account::selectRaw('DATE(Date_Created) as date, SUM(Crd_Amnt) as totalAccCredit, SUM(Dbt_Amt) as totalAccDebit')
            ->where('Date_Created', '>=', now()->subDays(30))
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

        // Statistics
        $totalCustomers = Customers::count();
        $totalInvoices = Invoice::count();
        $totalRevenue = Sales::where('Status', 'approved')->sum('Total_Price');
        $totalPurchases = Purchase::where('Status', 'approved')->sum('Total_Cost');
        $lastLogin = auth()->user()->updated_at ?? now();

        // Current month data for performance chart
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $monthlySalesData = $this->getMonthlySalesData($currentMonth, $currentYear);
        $monthlyPurchasesData = $this->getMonthlyPurchasesData($currentMonth, $currentYear);

        // Year (monthly) totals for bar chart
        $yearlySalesPurchases = $this->getYearlySalesPurchasesData($currentYear);

        // Recent activities
        $recentActivities = $this->getRecentActivities();

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
            'totalCustomers' => $totalCustomers,
            'totalInvoices' => $totalInvoices,
            'totalRevenue' => $totalRevenue,
            'totalPurchases' => $totalPurchases,
            'lastLogin' => $lastLogin,
            'monthlySalesData' => $monthlySalesData,
            'monthlyPurchasesData' => $monthlyPurchasesData,
            'yearlySalesPurchases' => $yearlySalesPurchases,
            'recentActivities' => $recentActivities,
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

    private function getMonthlySalesData($month, $year)
    {
        $sales = Sales::where('Status', 'approved')
            ->whereMonth('Sale_Date', $month)
            ->whereYear('Sale_Date', $year)
            ->selectRaw('DATE(Sale_Date) as date, SUM(Total_Price) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // If there's no data for the requested month, fallback to the last 30 days
        if ($sales->isEmpty()) {
            $start = Carbon::now()->subDays(29)->startOfDay();
            $end = Carbon::now()->startOfDay();

            $sales = Sales::where('Status', 'approved')
                ->whereBetween('Sale_Date', [$start->toDateString(), $end->toDateString()])
                ->selectRaw('DATE(Sale_Date) as date, SUM(Total_Price) as total')
                ->groupBy('date')
                ->orderBy('date')
                ->get();

            // Build continuous labels for last 30 days
            $map = [];
            foreach ($sales as $sale) {
                $map[Carbon::parse($sale->date)->format('Y-m-d')] = (float) $sale->total;
            }

            $labels = [];
            $data = [];
            for ($d = $start; $d->lte($end); $d->addDay()) {
                $label = $d->format('Y-m-d');
                $labels[] = $label;
                $data[] = $map[$label] ?? 0;
            }

            return [
                'labels' => $labels,
                'data' => $data,
            ];
        }

        $dates = [];
        $totals = [];
        foreach ($sales as $sale) {
            // return ISO date strings for reliable sorting/formatting in JS
            $dates[] = Carbon::parse($sale->date)->format('Y-m-d');
            $totals[] = (float) $sale->total;
        }

        return [
            'labels' => $dates,
            'data' => $totals
        ];
    }

    private function getMonthlyPurchasesData($month, $year)
    {
        $purchases = Purchase::where('Status', 'approved')
            ->whereMonth('Purchase_Date', $month)
            ->whereYear('Purchase_Date', $year)
            ->selectRaw('DATE(Purchase_Date) as date, SUM(Total_Cost) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Fallback to last 30 days if no data for the month
        if ($purchases->isEmpty()) {
            $start = Carbon::now()->subDays(29)->startOfDay();
            $end = Carbon::now()->startOfDay();

            $purchases = Purchase::where('Status', 'approved')
                ->whereBetween('Purchase_Date', [$start->toDateString(), $end->toDateString()])
                ->selectRaw('DATE(Purchase_Date) as date, SUM(Total_Cost) as total')
                ->groupBy('date')
                ->orderBy('date')
                ->get();

            $map = [];
            foreach ($purchases as $p) {
                $map[Carbon::parse($p->date)->format('Y-m-d')] = (float) $p->total;
            }

            $labels = [];
            $data = [];
            for ($d = $start; $d->lte($end); $d->addDay()) {
                $label = $d->format('Y-m-d');
                $labels[] = $label;
                $data[] = $map[$label] ?? 0;
            }

            return [
                'labels' => $labels,
                'data' => $data,
            ];
        }

        $dates = [];
        $totals = [];
        foreach ($purchases as $purchase) {
            // return ISO date strings for reliable sorting/formatting in JS
            $dates[] = Carbon::parse($purchase->date)->format('Y-m-d');
            $totals[] = (float) $purchase->total;
        }

        return [
            'labels' => $dates,
            'data' => $totals
        ];
    }

    private function getYearlySalesPurchasesData(int $year): array
    {
        $months = collect(range(1, 12));

        $salesByMonth = Sales::where('Status', 'approved')
            ->whereYear('Sale_Date', $year)
            ->selectRaw('MONTH(Sale_Date) as month, SUM(Total_Price) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        $purchasesByMonth = Purchase::where('Status', 'approved')
            ->whereYear('Purchase_Date', $year)
            ->selectRaw('MONTH(Purchase_Date) as month, SUM(Total_Cost) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        $labels = $months->map(fn ($m) => Carbon::create($year, $m, 1)->format('M'))->values()->all();
        $sales = $months->map(fn ($m) => (float) ($salesByMonth[$m] ?? 0))->values()->all();
        $purchases = $months->map(fn ($m) => (float) ($purchasesByMonth[$m] ?? 0))->values()->all();

        return [
            'year' => $year,
            'labels' => $labels,
            'sales' => $sales,
            'purchases' => $purchases,
        ];
    }

    private function getRecentActivities()
    {
        // Recent invoices
        // Limit recent invoices to last 30 days
        $recentInvoices = Invoice::with('customer')
            ->whereDate('date', '>=', now()->subDays(30))
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($invoice) {
                return [
                    'type' => 'invoice',
                    'description' => 'Invoice ' . $invoice->invoice_number . ' created for ' . ($invoice->customer?->Customer_Name ?? 'Unknown'),
                    'time' => Carbon::parse($invoice->date)->diffForHumans(),
                    'created_at' => Carbon::parse($invoice->date),
                ];
            });

        // Recent sales
        // Limit recent sales to last 30 days
        $recentSales = Sales::where('Status', 'approved')
            ->with('customer')
            ->whereDate('Sale_Date', '>=', now()->subDays(30))
            ->orderBy('Sale_Date', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($sale) {
                return [
                    'type' => 'sale',
                    'description' => 'Sale completed for ' . ($sale->customer?->Customer_Name ?? 'Unknown') . ' - $' . number_format($sale->Total_Price, 2),
                    'time' => Carbon::parse($sale->Sale_Date)->diffForHumans(),
                    'created_at' => Carbon::parse($sale->Sale_Date),
                ];
            });

        // Merge and sort by date
        $activities = $recentInvoices->merge($recentSales)
            ->sortByDesc('created_at')
            ->take(7)
            ->values();

        return $activities;
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

        return redirect('add-order')->with('success','Order Created');
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
