<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\SupplierContacts;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        $suppliercontacts = SupplierContacts::all();
        return view('suppliers.suppliers', [
            'suppliers'=> $suppliers,
            'suppliercontacts'=> $suppliercontacts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Supplier_Name' => 'required|max:255|string',
            'Contact_Name' => 'required|max:255|string',
            'Address' => 'required|max:255|string',
            'Phone' => 'required|max:255|string',
            'Email' => 'required|max:255|string',
            'Created_Date' => 'required|date'
            ]);
    
            Supplier::create([
                'Supplier_Name' => $request->Supplier_Name,
                'Contact_Name' => $request->Contact_Name,
                'Address' => $request->Address,
                'Phone' => $request->Phone,
                'Email' => $request->Email,
                'Created_Date' => $request->Created_Date,
            ]);
    
            return redirect('suppliers/create')->with('status','New Supplier Registered');
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
