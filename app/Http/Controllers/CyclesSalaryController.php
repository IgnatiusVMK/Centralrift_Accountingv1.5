<?php

namespace App\Http\Controllers;

use App\Models\Financial;
use Illuminate\Http\Request;

class CyclesSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $Cycle_Id = $request->route('Cycle_Id');
        $saluniqueCode = $this->generateUniqueCode('salaries');
        return view('financials.salaries.create', [
            'Cycle_Id'=> $Cycle_Id,
            'saluniqueCode' => $saluniqueCode,
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
        // Get the last row for the given type in the Expenditures table
        $lastExpenditure = Financial::where('type', $type)->latest()->first();

        // Extract the last unique code and incrementing number
        $lastCode = $lastExpenditure ? $lastExpenditure->unique_code : '';
        $lastNumber = intval(substr(strrchr($lastCode, "-"), 1)); // Extracts the number after the last dash

        // Generate a new unique code
        $prefix = strtoupper(substr($type, 0, 3)); // Get the first three letters of the type
        $newNumber = $lastNumber + 1;
        $uniqueCode = $prefix . '-' . date('Ymd') . '-' . $newNumber;

        // Check if the generated code already exists in the table, if so, increment the number until a unique code is found
        while (Financial::where('Fin_Id_Id', $uniqueCode)->exists()) {
            $newNumber++;
            $uniqueCode = $prefix . '-' . date('Ymd') . '-' . $newNumber;
        }

        return $uniqueCode;
    }
}
