<?php

namespace App\Http\Controllers;

use App\Models\CustomerContacts;
use App\Models\Customers;
use App\Models\Sales;
use Illuminate\Http\Request;

class CustomerSalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request, $Customer_Id)
    {
        // Fetch all customers with their salespersons
        $customers = Customers::with('salespersons')->get();

        // Get the Customer_Id from the request
        $Customer_Id = $request->route('id');
        $Sales_Id = $request->route('Sales_Id');

        // Fetch the customer name based on the Customer_Id
        $Customer_Name = Customers::where('id', $Customer_Id)->value('Customer_Name');

        


        // Return the view with the data
        return view('customers.customer-sales', [
            'Customer_Name' => $Customer_Name,
            'customers' => $customers,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request){

        $Cycle_Id = $request->route('Cycle_Id');
        $SaleuniqueCode = $this->generateUniqueCode('Sales');
        return view('financials.sales.create', [
            'Cycle_Id' => $Cycle_Id,
            'SaleuniqueCode' => $SaleuniqueCode,
        ]);
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

        $lastCredit = Sales::latest()->first();
    
        $lastCode = $lastCredit ? $lastCredit->unique_code : '';
        $lastNumber = intval(substr(strrchr($lastCode, "-"), 1)); 
    
        $prefix = strtoupper(substr($type, 0, 4));
        $newNumber = $lastNumber + 1;
        $uniqueCode = $prefix . '-' . date('Ymd') . '-' . $newNumber;
    
        while (Sales::where('Sales_Id', $uniqueCode)->exists()) {
            $newNumber++;
            $uniqueCode = $prefix . '-' . date('Ymd') . '-' . $newNumber;
        }
    
        return $uniqueCode;
    }
}
