<?php

namespace App\Http\Controllers;

use App\Models\Blocks;
use App\Models\Cycles;
use App\Models\HarvestOrder;
use App\Models\Product;
use Illuminate\Http\Request;

class CheckerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('access-approval');

        $pendingCycles = Cycles::where('Status', 'pending')->get();
        return view('checker.index', [
            'pendingCycles'=>$pendingCycles,
        ]);
    }

    public function viewDetails(int $id)
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
