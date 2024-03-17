<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view("products/products", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view("products/create", [
            "categories"=> $categories,
            "suppliers"=> $suppliers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Product_Name' => 'required|max:255|string',
            'Description' => 'required|max:255|string',
            'Price' => 'required|integer',
            'Category_Id' => 'required|integer',
            'Supplier_Id' => 'required|integer',
            'Created_Date' => 'required|date'
            ]);
    
        Product::create([
            'Product_Name' => $request->Product_Name,
            'Description' => $request->Description,
            'Price' => $request->Price,
            'Category_Id' => $request->Category_Id,
            'Supplier_Id' => $request->Supplier_Id,
            'Created_Date' => $request->Created_Date,
        ]);
    
        return redirect('products/create')->with('status','New Product Created');

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
