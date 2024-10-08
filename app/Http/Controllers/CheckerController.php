<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Blocks;
use App\Models\CapitalWithdrawal;
use App\Models\Credit;
use App\Models\CycleAllocations;
use App\Models\Cycles;
use App\Models\Financial;
use App\Models\HarvestOrder;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sales;
use App\Models\Stocks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CheckerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('access-approval');

        $pendingCycles = Cycles::where('Status', 'pending')->get();
        $pendingCyclesCount = Cycles::where('Status', 'pending')->get()->count();

        $wages = Financial::where('type', 'expenditure')->where('Status', 'pending')->get();

        $salaries = Financial::where('type', 'salary')->where('Status', 'pending')->get();
        $credits = Credit::where('Status','pending')->get();
        $advance = Financial::where('type', 'advance')->where('Status', 'pending')->get();
        $transport = Financial::where('type', 'transport')->where('Status', 'pending')->get();
        $electricity = Financial::where('type', 'electricity')->where('Status', 'pending')->get();
        $maintenance = Financial::where('type', 'maintenance')->where('Status', 'pending')->get();
        $cpexpenses = Financial::where('type', 'Capital Expenses')->where('Status', 'pending')->get();
        $chemicals = Financial::where('type', 'chemicals')->where('Status', 'pending')->get();
        $seeds = Financial::where('type', 'seeds')->where('Status', 'pending')->get();
        $withdrawals = CapitalWithdrawal::where('Status', 'pending')->get();
        $sales = Sales::where('Status', 'pending')->get();
        $purchases = Purchase::where('Status', 'pending')->get();
        $stocks = Stocks::with('purchase')->where('Status', 'pending')->get();
        $cycAllocates = CycleAllocations::where('Status', 'pending')->get();
        // Stocks::with('purchase')->where('Status', 'approved')->get();

        $creditCount = Credit::where('Status', 'pending')->count();
        $wagesCount = Financial::where('type', 'expenditure')->where('Status', 'pending')->count();
        $salariesCount = Financial::where('type', 'salary')->where('Status', 'pending')->count();
        $advanceCount = Financial::where('type', 'advance')->where('Status', 'pending')->count();
        $transportCount = Financial::where('type', 'transport')->where('Status', 'pending')->count();
        $electricityCount = Financial::where('type', 'electricity')->where('Status', 'pending')->count();
        $maintenanceCount = Financial::where('type', 'maintenance')->where('Status', 'pending')->count();
        $chemicalsCount = Financial::where('type', 'chemicals')->where('Status', 'pending')->count();
        $seedsCount = Financial::where('type', 'seeds')->where('Status', 'pending')->count();
        $cpexpensesCount = Financial::where('type', 'Capital Expenses')->where('Status', 'pending')->count();
        $withdrawalCount = CapitalWithdrawal::where('Status', 'pending')->count();
        $salesCount = Sales::where('Status', 'pending')->count();
        $purchaseCount = Purchase::where('Status', 'pending')->count();
        $stocksCount = Stocks::where('Status', 'pending')->count();
        $cycAllocateCount = CycleAllocations::where('Status', 'pending')->count();

        $Cycle_Id = $request->route('Cycle_Id');

        
        //
        return view('checker.index', [
            'pendingCycles'=>$pendingCycles,
            'credits'=>$credits,
            'creditCount'=>$creditCount,
            'pendingCyclesCount'=>$pendingCyclesCount,
            'wages'=> $wages,
            'salaries'=> $salaries,
            'advance'=> $advance,
            'transport'=> $transport,
            'electricity'=> $electricity,
            'withdrawal'=> $withdrawals,
            'cpexpenses'=> $cpexpenses,
            'chemicals'=> $chemicals,
            'seeds'=> $seeds,
            'chemicalsCount'=> $chemicalsCount,
            'seedsCount'=> $seedsCount,
            'maintenance'=> $maintenance,
            'sales'=> $sales,
            'purchases'=> $purchases,
            'stocks'=> $stocks,
            'cycAllocates'=> $cycAllocates,
            'wagesCount'=> $wagesCount,
            'salariesCount'=> $salariesCount,
            'advanceCount'=> $advanceCount,
            'transportCount'=> $transportCount,
            'electricityCount'=> $electricityCount,
            'withdrawalCount'=> $withdrawalCount,
            'cpexpensesCount'=> $cpexpensesCount,
            'maintenanceCount'=> $maintenanceCount,
            'salesCount'=> $salesCount,
            'purchaseCount'=>$purchaseCount,
            'stocksCount'=>$stocksCount,
            'cycAllocateCount'=>$cycAllocateCount,
            'Cycle_Id'=>$Cycle_Id,
        ]);
    }

    public function viewCycleDetails(int $id)
    {
        $this->authorize('view-approval');

        $pendingCycles= Cycles::findOrFail($id);

        /* dd($pendingCycles); */
        
        $blocks  = Blocks::get();
        $crops = Product::get();
        return view('checker.details', [
            'pendingCycles'=> $pendingCycles,
            'blocks'=> $blocks,
            'crops'=> $crops
        ]);

    }
    public function approveCycle(Request $request, string $Cycle_Id)
    {
        $this->authorize('create-approval');

        $request->validate([
            'checker_id'=> 'required|max:255|integer',
            'Status' => 'required|max:255|string',
        ]);
        Cycles::where('Cycle_Id', $Cycle_Id)->update([
            'checker_id'=> $request->checker_id,
            'Status'=> $request->Status,
        ]);
        HarvestOrder::where('Cycle_Id', $Cycle_Id)->update([
            'checker_id'=> $request->checker_id,
            'Status'=> $request->Status,
        ]);

        return redirect()->back()->with('success','Cycle Entry Approved');
    }
    public function approveFinancial(Request $request, string $Cycle_Id, string $Fin_Id_Id, int $id,)
    {
        $this->authorize('create-approval');

        $request->validate([
            'checker_id'=> 'required|max:255|integer',
            'Status' => 'required|max:255|string',
        ]);
        Financial::where('Fin_Id_Id', $Fin_Id_Id)->update([
            'checker_id'=> $request->checker_id,
            'Status'=> $request->Status,
        ]);
        Account::where('Financial_Id', $Fin_Id_Id)->update([
            'checker_id'=> $request->checker_id,
            'Status'=> $request->Status,
        ]);

        return redirect()->back()->with('success','Finanacial Entry Approved');
    }

    public function approveSale(Request $request, string $Sales_Id, int $id, )
    {

        $this->authorize('create-approval');

        $request->validate([
            'checker_id'=> 'required|max:255|integer',
            'Status' => 'required|max:255|string',
        ]);
        
        $sale = Sales::where('id', $id)->update([
            'checker_id'=> $request->checker_id,
            'Status'=> $request->Status,
        ]);

        if (!$sale) {
            return redirect()->back()->with('error', 'Sale not found.');
        }

        Account::where('Financial_Id', $Sales_Id)->update([
            'checker_id'=> $request->checker_id,
            'Status'=> $request->Status,
        ]);

        return redirect()->back()->with('success','Sale Entry approved.');
    }

    public function approveCaptWithdrawal(Request $request, string $Capt_Withdraw_Id /* , int $id, */){

        $this->authorize('create-approval');

        $request->validate([
            'checker_id'=> 'required|max:255|integer',
            'Status'=> 'required|max:255|string',        
        ]);

        CapitalWithdrawal::where('Capt_Withdraw_Id', $Capt_Withdraw_Id)->update([
            'checker_id'=> $request->checker_id,
            'Status'=> $request->Status,
        ]);
        Account::where('Financial_Id', $Capt_Withdraw_Id)->update([
            'checker_id'=> $request->checker_id,
            'Status'=> $request->Status,
        ]);

        return redirect()->back()->with('success','Withdrawal Entry approved.');
    }

    public function approveCredit(Request $request, string $Credit_Id ){
        $this->authorize('create-approval');

        $request->validate([
            'checker_id'=> 'required|max:255|integer',
            'Status'=> 'required|max:255|string',        
        ]);

        Credit::where('Credit_Id', $Credit_Id)->update([
            'checker_id'=> $request->checker_id,
            'Status'=> $request->Status,
        ]);
        Account::where('Financial_Id', $Credit_Id)->update([
            'checker_id'=> $request->checker_id,
            'Status'=> $request->Status,
        ]);

        return redirect()->back()->with('success','Credit Entry approved.');
    }
    public function approvePurchases(Request $request, int $id, string $Purchase_Id ){
        $this->authorize('create-approval');

        $request->validate([
            'checker_id'=> 'required|max:255|integer',
            'Status'=> 'required|max:255|string',        
        ]);

        Purchase::where('id', $id)->update([
            'checker_id'=> $request->checker_id,
            'Status'=> $request->Status,
        ]);

        Account::where('Financial_Id', $Purchase_Id)->update([
            'checker_id'=> $request->checker_id,
            'Status'=> $request->Status,
        ]);

        return redirect()->back()->with('success','Purchase approved.');
    }
    public function approveNewStock(Request $request, int $id ){
        $this->authorize('create-approval');

        $request->validate([
            'checker_id'=> 'required|max:255|integer',
            'Status'=> 'required|max:255|string',        
        ]);

        Stocks::where('id', $id)->update([
            'checker_id'=> $request->checker_id,
            'Status'=> $request->Status,
        ]);

        return redirect()->back()->with('success','New Inventory approved.');
    }
    public function approveCycAllocation(Request $request, int $id ){
        $this->authorize('create-approval');

        $request->validate([
            'checker_id'=> 'required|max:255|integer',
            'Status'=> 'required|max:255|string',        
        ]);

        CycleAllocations::where('id', $id)->update([
            'checker_id'=> $request->checker_id,
            'Status'=> $request->Status,
        ]);

        return redirect()->back()->with('success','Allocation approved.');
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
    /* public function show(string $id)
    {
        //
    } */

    /**
     * Show the form for editing the specified resource.
     */
    /* public function edit(string $id)
    {
        //
    } */

    /**
     * Update the specified resource in storage.
     */
    /* public function update(Request $request, string $id)
    {
        //
    } */

    /**
     * Remove the specified resource from storage.
     */
    /* public function destroy(string $id)
    {
        //
    } */
}
