<?php

namespace App\Http\Controllers;

use App\Models\Financial;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index()
    {

        $expuniqueCode = $this->generateUniqueCode('expenditure');
        $advuniqueCode = $this->generateUniqueCode('advance');
        $saluniqueCode = $this->generateUniqueCode('salaries');
        return view('financials.finances', [
            'expuniqueCode' => $expuniqueCode,
            'advuniqueCode' => $advuniqueCode,
            'saluniqueCode' => $saluniqueCode,
        ]);
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