<?php

namespace App\Http\Controllers;

use App\Models\CustomerContacts;
use App\Models\Customers;
use App\Models\SalesPerson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customers::with('salespersons')->get();
        return view('customers.customers', [
            'customers'=> $customers,
        ]);
    }
    public function create(){
        return view('customers.create');
    }

    public function store(Request $request)
{
    // Validate the customer and salesperson data
    $request->validate([
        'Customer_Name' => 'required|string|max:255',
        'Cust_Account_No' => 'required|string|max:255',
        'Address' => 'required|string|max:255',
        'salespersons' => 'required|array', // Expecting multiple salespersons
        'salespersons.*.first_name' => 'required|string|max:255',
        'salespersons.*.last_name' => 'required|string|max:255',
        'salespersons.*.email' => 'required|email|unique:salespersons,email',
    ]);

    // Create the customer
    $customer = Customers::create([
        'Customer_Name' => $request->Customer_Name,
        'Cust_Account_No' => $request->Cust_Account_No,
        'Address'=> $request->Address,
        'Status' => 'pending', // or any other status
    ]);

    // Loop through each salesperson entry
    foreach ($request->salespersons as $salespersonData) {
        // Check if salesperson already exists by email
        $salesperson = SalesPerson::where('email', $salespersonData['email'])->first();

        if (!$salesperson) {
            // If the salesperson does not exist, create a new one
            $salesperson = SalesPerson::create([
                'first_name' => $salespersonData['first_name'],
                'last_name' => $salespersonData['last_name'],
                'email' => $salespersonData['email'],
                'phone' => $salespersonData['phone'] ?? null,
            ]);
        }

        // Attach the salesperson to the customer
        $customer->salespersons()->attach($salesperson->id);
    }

    return redirect()->route('customers.create')->with('success', 'Customer and salespersons added successfully.');
}


    public function edit(int $id){

        $customer = Customers::findOrFail($id);
        $salespersons = $customer->salespersons; // Assuming a relationship exists
        return view('customers.edit', compact('customer', 'salespersons'));

    }
    // Update the specified customer in storage
    /* public function update(Request $request, int $id)
{
    // Log incoming request
    Log::info('Update Request Data:', $request->all());

    // Validate the request
    $validated = $request->validate([
        'Customer_Name' => 'required|max:255|string',
        'Cust_Account_No' => 'required|numeric',
        'Address' => 'required|string|max:255',
        'salespersons.*.first_name' => 'required|string|max:255',
        'salespersons.*.last_name' => 'required|string|max:255',
        'salespersons.*.email' => 'required|email',
        'salespersons.*.phone' => 'nullable|string|max:15',
    ]);

    // Find the customer
    $customer = Customers::findOrFail($id);

    // Update customer details
    $customer->update([
        'Customer_Name' => $validated['Customer_Name'],
        'Cust_Account_No' => $validated['Cust_Account_No'],
        'Address' => $validated['Address'],
        'is_active' => $request->has('is_active') ? 1 : 0,
    ]);

    // Prepare salesperson data
    $salespersonIds = [];
    foreach ($validated['salespersons'] as $salespersonData) {
        // Update or create salesperson
        $salesperson = SalesPerson::updateOrCreate(
            ['email' => $salespersonData['email']], // Unique identifier
            [
                'first_name' => $salespersonData['first_name'],
                'last_name' => $salespersonData['last_name'],
                'phone' => $salespersonData['phone'],
            ]
        );

        // Collect salesperson IDs
        $salespersonIds[] = $salesperson->id;
    }

    try {
        $customer->update([
            'Customer_Name' => $validated['Customer_Name'],
            'Cust_Account_No' => $validated['Cust_Account_No'],
            'Address' => $validated['Address'],
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);
    
        $salespersonIds = [];
        foreach ($validated['salespersons'] as $salespersonData) {
            $salesperson = SalesPerson::updateOrCreate(
                ['email' => $salespersonData['email']],
                [
                    'first_name' => $salespersonData['first_name'],
                    'last_name' => $salespersonData['last_name'],
                    'phone' => $salespersonData['phone'],
                ]
            );
            $salespersonIds[] = $salesperson->id;
        }
    
        $customer->salespersons()->sync($salespersonIds);
    } catch (\Exception $e) {
        Log::error('Update Error:', ['exception' => $e->getMessage()]);
        return redirect()->back()->withErrors('An error occurred while updating.');
    }
    // Sync salespersons to customer
    $customer->salespersons()->sync($salespersonIds);

    // Redirect with success message
    return redirect()->back()->with('status', 'Customer and Salesperson details updated successfully!');
} */


public function update(Request $request, int $id)
{
    // Validate the request
    $validated = $request->validate([
        'Customer_Name' => 'required|max:255|string',
        'Cust_Account_No' => 'required|numeric',
        'Address' => 'required|string|max:255',
        'salespersons.*.first_name' => 'required|string|max:255',
        'salespersons.*.last_name' => 'required|string|max:255',
        'salespersons.*.email' => 'required|email',
        'salespersons.*.phone' => 'nullable|string|max:15',
    ]);

    // Find the customer
    $customer = Customers::findOrFail($id);

    // Update customer details
    $customer->update([
        'Customer_Name' => $validated['Customer_Name'],
        'Cust_Account_No' => $validated['Cust_Account_No'],
        'Address' => $validated['Address'],
        'is_active' => $request->has('is_active') ? 1 : 0,
    ]);

    // Prepare salesperson data
    $salespersonIds = [];
    foreach ($validated['salespersons'] as $salespersonData) {
        // Update or create salesperson
        $salesperson = SalesPerson::updateOrCreate(
            ['email' => $salespersonData['email']], // Unique identifier
            [
                'first_name' => $salespersonData['first_name'],
                'last_name' => $salespersonData['last_name'],
                'phone' => $salespersonData['phone'],
            ]
        );

        // Collect salesperson IDs
        $salespersonIds[] = $salesperson->id;
    }

    // Sync salespersons to customer
    $customer->salespersons()->sync($salespersonIds);

    // Redirect with success message
    return redirect()->back()->with('status', 'Customer and Salesperson details updated successfully!');
}

    public function destroy(int $id){
        $customer= Customers::findOrFail($id);
        $customer->delete();

        return redirect()->back()->with('warning','Customer Deleted');
    }
}
