<?php

namespace App\Http\Controllers;

use App\Models\Financial;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class CycleDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $financials = Financial::where('type', 'expenditure')->simplePaginate(5);/* 
        return view('financials.expenditures.financials', compact('financials'))
        ->with('create', true); */
        $Cycle_Id = $request->route('Cycle_Id');
        $expuniqueCode = $this->generateUniqueCode('wages');
        $advuniqueCode = $this->generateUniqueCode('advance');
        $saluniqueCode = $this->generateUniqueCode('salaries');
        $elecuniqueCode = $this->generateUniqueCode('electricty');
        $tranuniqueCode = $this->generateUniqueCode('transport');
        $chemuniqueCode = $this->generateUniqueCode('chemicals');
        return view('cycles.expenses', [
            'financials'=> $financials,
            'Cycle_Id'=> $Cycle_Id,
            'expuniqueCode' => $expuniqueCode,
            'advuniqueCode' => $advuniqueCode,
            'saluniqueCode' => $saluniqueCode,
            'elecuniqueCode' => $elecuniqueCode,
            'tranuniqueCode' => $tranuniqueCode,
            'chemuniqueCode' => $chemuniqueCode,
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
        $prefix = strtoupper(substr($type, 0, 4)); // Get the first three letters of the type
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
