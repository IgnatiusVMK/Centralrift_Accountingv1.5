<?php

namespace App\Http\Controllers;

use App\Models\Blocks;
use App\Models\CapitalWithdrawal;
use App\Models\Cycles;
use App\Models\Financial;
use App\Models\HarvestOrder;
use App\Models\Product;
use App\Models\Sales;
use Illuminate\Http\Request;

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

        //
        $wages = Financial::where('type', 'expenditure')->where('status', 'pending');
        $salaries = Financial::where('type', 'salary')->where('status', 'pending');
        $advance = Financial::where('type', 'advance')->where('status', 'pending');
        $transport = Financial::where('type', 'transport')->where('status', 'pending');
        $electricity = Financial::where('type', 'electricity')->where('status', 'pending');
        $maintenance = Financial::where('type', 'maintenance')->where('status', 'pending');
        $cpexpenses = Financial::where('type', 'Capital Expenses')->where('status', 'pending');
        $withdrawals = CapitalWithdrawal::where('status', 'pending');
        $sales = Sales::where('status', 'pending');

        $wagesCount = Financial::where('type', 'expenditure')->where('status', 'pending')->count();
        $salariesCount = Financial::where('type', 'salary')->where('status', 'pending')->count();
        $advanceCount = Financial::where('type', 'advance')->where('status', 'pending')->count();
        $transportCount = Financial::where('type', 'transport')->where('status', 'pending')->count();
        $electricityCount = Financial::where('type', 'electricity')->where('status', 'pending')->count();
        $maintenanceCount = Financial::where('type', 'maintenance')->where('status', 'pending')->count();
        $cpexpensesCount = Financial::where('type', 'Capital Expenses')->where('status', 'pending')->count();
        $withdrawalCount = CapitalWithdrawal::where('status', 'pending')->count();
        $salesCount = Sales::where('status', 'pending')->count();

        $Cycle_Id = $request->route('Cycle_Id');

        
        //
        return view('checker.index', [
            'pendingCycles'=>$pendingCycles,
            'pendingCyclesCount'=>$pendingCyclesCount,
            'wages'=> $wages,
            'salaries'=> $salaries,
            'advance'=> $advance,
            'transport'=> $transport,
            'electricity'=> $electricity,
            'withdrawal'=> $withdrawals,
            'cpexpenses'=> $cpexpenses,
            'maintenance'=> $maintenance,
            'sales'=> $sales,
            'wagesCount'=> $wagesCount,
            'salariesCount'=> $salariesCount,
            'advanceCount'=> $advanceCount,
            'transportCount'=> $transportCount,
            'electricityCount'=> $electricityCount,
            'withdrawalCount'=> $withdrawalCount,
            'cpexpensesCount'=> $cpexpensesCount,
            'maintenanceCount'=> $maintenanceCount,
            'salesCount'=> $salesCount,
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
    public function approveCycle(Request $request,int $id)
    {
        $this->authorize('create-approval');

        $request->validate([
            'checker_id'=> 'required|max:255|integer',
            'Status' => 'required|max:255|string',
        ]);
        Cycles::where('id', $id)->update([
            'checker_id'=> $request->checker_id,
            'Status'=> $request->Status,
        ]);
        HarvestOrder::where('id', $id)->update([
            'checker_id'=> $request->checker_id,
            'Status'=> $request->Status,
        ]);

        return redirect()->back()->with('status','Cycle Approved');
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
