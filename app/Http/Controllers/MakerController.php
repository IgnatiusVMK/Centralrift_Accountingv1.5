<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Blocks;
use App\Models\CapitalWithdrawal;
use App\Models\Cycles;
use App\Models\Financial;
use App\Models\HarvestOrder;
use App\Models\Product;
use App\Models\Sales;
use Illuminate\Http\Request;


class MakerController extends Controller
{
    //
    public function index(Request $request)
    {
        $this->authorize('access-maker');

        $pendingCycles = Cycles::where('Status', 'pending')->get();
        $pendingCyclesCount = Cycles::where('Status', 'pending')->get()->count();

        $wages = Financial::where('type', 'expenditure')->where('Status', 'pending')->get();

        //
        
        $salaries = Financial::where('type', 'salary')->where('Status', 'pending')->get();
        $advance = Financial::where('type', 'advance')->where('Status', 'pending')->get();
        $transport = Financial::where('type', 'transport')->where('Status', 'pending')->get();
        $electricity = Financial::where('type', 'electricity')->where('Status', 'pending')->get();
        $maintenance = Financial::where('type', 'maintenance')->where('Status', 'pending')->get();
        $cpexpenses = Financial::where('type', 'Capital Expenses')->where('Status', 'pending')->get();
        $chemicals = Financial::where('type', 'chemicals')->where('Status', 'pending')->get();
        $seeds = Financial::where('type', 'seeds')->where('Status', 'pending')->get();
        $withdrawals = CapitalWithdrawal::where('Status', 'pending')->get();
        $sales = Sales::where('Status', 'pending')->get();

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

        $Cycle_Id = $request->route('Cycle_Id');

        
        //
        return view('maker.index', [
            'pendingCycles'=>$pendingCycles,
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
}
