<?php

namespace App\Http\Controllers;

use App\Models\Cycles;
use App\Models\HarvestOrder;
use Illuminate\Http\Request;

class HarvestOrderController extends Controller
{
    public function index()
    {
        $harvestOrders = Cycles::where('Status', 'approved')->all();

        return view('dashboard', compact('harvestOrders'));
    }

    public function create()
    {
        return view('harvest_orders.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'company_name' => 'required',
            'order_date' => 'required|date',
            'planting_date' => 'required|date',
            'harvest_date' => 'required|date',
        ]);

        HarvestOrder::create($validatedData);

        return redirect()->route('harvest_orders.index');
    }

    public function show(HarvestOrder $harvest_order)
    {
        return view('harvest_orders.show', compact('harvest_order'));
    }

    public function edit(HarvestOrder $harvest_order)
    {
        return view('harvest_orders.edit', compact('harvest_order'));
    }

    public function update(Request $request, HarvestOrder $harvest_order)
    {
        $validatedData = $request->validate([
            'company_name' => 'required',
            'order_date' => 'required|date',
            'planting_date' => 'required|date',
            'harvest_date' => 'required|date',
        ]);

        $harvest_order->update($validatedData);

        return redirect()->route('harvest_orders.index');
    }

    public function destroy(HarvestOrder $harvest_order)
    {
        $harvest_order->delete();

        return redirect()->route('harvest_orders.index');
    }
}
