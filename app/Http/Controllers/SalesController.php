<?php

namespace App\Http\Controllers;

use App\Models\ProductsSales;
use App\Models\Sales;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $validatedData = $request->validate([
            'Customer_Id' => 'required|exists:customers,Customer_Id',
            'Sale_Date' => 'required|date',
            'Quantity' => 'required|integer|min:1',
            'Total_Price' => 'required|numeric|min:0',
            'Payment_Method' => 'required|string',
            'Payment_Status' => 'required|string',
            'products' => 'required|array',
            'products.*.Product_Id' => 'required|exists:products,Product_Id',
            'products.*.Quantity' => 'required|integer|min:1',
            'products.*.Unit_Price' => 'required|numeric|min:0',
        ]);

        // Create the sale
        $sale = Sales::create([
            'Customer_Id' => $validatedData['Customer_Id'],
            'Sale_Date' => $validatedData['Sale_Date'],
            'Quantity' => $validatedData['Quantity'],
            'Total_Price' => $validatedData['Total_Price'],
            'Payment_Method' => $validatedData['Payment_Method'],
            'Payment_Status' => $validatedData['Payment_Status'],
        ]);

        // Update or create records in products_sales table
        foreach ($validatedData['products'] as $product) {
            ProductsSales::updateOrCreate(
                [
                    'Product_Id' => $product['Product_Id'],
                    'Sales_Id' => $sale->Sales_Id,
                ],
                [
                    'Quantity' => $product['Quantity'],
                    'Unit_Price' => $product['Unit_Price'],
                ]
            );
        }

        return redirect()->route('sales.index')->with('success', 'Sale created successfully.');
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
}
