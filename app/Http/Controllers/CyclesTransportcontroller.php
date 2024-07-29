<?php

namespace App\Http\Controllers;

use App\Models\Financial;
use Illuminate\Http\Request;

class CyclesTransportcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $Cycle_Id = $request->route('Cycle_Id');
        $tranuniqueCode = $this->generateUniqueCode('transport');
        return view('financials.transport.create', [
            'Cycle_Id'=> $Cycle_Id,
            'tranuniqueCode' => $tranuniqueCode,
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
    private function generateUniqueCode($type)
    {
        $lastExpenditure = Financial::where('type', $type)->latest()->first();

        $lastCode = $lastExpenditure ? $lastExpenditure->unique_code : '';
        $lastNumber = intval(substr(strrchr($lastCode, "-"), 1));

        $prefix = strtoupper(substr($type, 0, 3));
        $newNumber = $lastNumber + 1;
        $uniqueCode = $prefix . '-' . date('Ymd') . '-' . $newNumber;

        while (Financial::where('Fin_Id_Id', $uniqueCode)->exists()) {
            $newNumber++;
            $uniqueCode = $prefix . '-' . date('Ymd') . '-' . $newNumber;
        }

        return $uniqueCode;
    }
}
