<?php

namespace App\Http\Controllers;

use App\Models\CustomerContacts;
use App\Models\Customers;
use App\Models\SalesPerson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        Log::debug('Raw input:', $request->all());

        $validated = $request->validate([
            'Customer_Name' => 'required|string|max:255',
            'AttentionTo' => 'nullable|string|max:255',
            'Cust_Account_No' => 'required|numeric|digits_between:5,10',
            'email' => 'required|email|max:255',  // Changed to match form field name
            'Contact' => 'nullable|string',
            'AddressLine1' => 'required|string|max:255',
            'AddressLine2' => 'nullable|string|max:255',
            'City' => 'nullable|string|max:100',
            'Region_State' => 'required|string|max:100',
            'PostalCode' => 'required|string|max:20',
            'Country' => 'required|string|max:100',
            
            'salespersons' => 'required|array',
            'salespersons.*.first_name' => 'required|string|max:255',
            'salespersons.*.last_name' => 'required|string|max:255',
            'salespersons.*.email' => 'required|email|unique:salespersons,email',
            'salespersons.*.phone' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // Create customer - field names match validated data
            $customer = Customers::create([
                'Customer_Name' => $validated['Customer_Name'],
                'AttentionTo' => $validated['AttentionTo'],
                'Cust_Account_No' => $validated['Cust_Account_No'],
                'email' => $validated['email'],  // Matches form field
                'Contact' => $validated['Contact'],
                'AddressLine1' => $validated['AddressLine1'],
                'AddressLine2' => $validated['AddressLine2'],
                'City' => $validated['City'],
                'Region_State' => $validated['Region_State'],
                'PostalCode' => $validated['PostalCode'],
                'Country' => $validated['Country'],
                'Status' => 'pending',
            ]);

            // Handle salespersons
            foreach ($validated['salespersons'] as $salespersonData) {
                $salesperson = SalesPerson::firstOrCreate(
                    ['email' => $salespersonData['email']],
                    [
                        'first_name' => $salespersonData['first_name'],
                        'last_name' => $salespersonData['last_name'],
                        'phone' => $salespersonData['phone'] ?? null,
                    ]
                );

                $customer->salespersons()->syncWithoutDetaching([$salesperson->id]);
            }

            DB::commit();

            return redirect()->route('customers.create')
                ->with('success', 'Customer created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating customer: '.$e->getMessage());
            
            return back()
                ->withInput()
                ->with('error', 'Error: '.$e->getMessage());
        }
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
        'email' => 'required|string|max:255',
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
        'email' => $validated['email'],
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
            'email' => $validated['email'],
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
        'AttentionTo' => 'nullable|string|max:255',
        'Cust_Account_No' => 'numeric',
        'email' => 'required|string|max:255',
        'AddressLine1' => 'nullable|string|max:255',
        'AddressLine2' => 'nullable|string|max:255',
        'City' => 'nullable|string|max:100',
        'Region_State' => 'nullable|string|max:100',
        'PostalCode' => 'nullable|string|max:20',
        'Country' => 'nullable|string|max:100',
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
        'AttentionTo' => $validated['AttentionTo'],
        'Cust_Account_No' => $validated['Cust_Account_No'],
        'email' => $validated['email'],
        'AddressLine1' => $validated['AddressLine1'],
        'AddressLine2' => $validated['AddressLine2'],
        'City' => $validated['City'],
        'Region_State' => $validated['Region_State'],
        'PostalCode' => $validated['PostalCode'],
        'Country' => $validated['Country'],
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
    return redirect()->back()->with('success', 'Customer and Salesperson details updated successfully!');
}

    public function destroy(int $id){
        $customer= Customers::findOrFail($id);
        $customer->delete();

        return redirect()->back()->with('warning','Customer Deleted');
    }
}
