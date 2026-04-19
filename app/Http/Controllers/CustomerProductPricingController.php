<?php

namespace App\Http\Controllers;

use App\Models\CustomerProductPricing;
use App\Models\Customers;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CustomerProductPricingController extends Controller
{
    /**
     * Display a listing of customers with their pricing.
     */
    public function index()
    {
        $customers = Customers::with(['pricing.product'])->get();
        $products = Product::all();

        return view('customer-pricing.index', [
            'customers' => $customers,
            'products' => $products,
        ]);
    }

    /**
     * Show the form for editing pricing for a specific customer.
     */
    public function edit($customerId)
    {
        $customer = Customers::findOrFail($customerId);
        $products = Product::all();
        
        // Get existing pricing for this customer - get the most recent for each product/type combination
        $allPricing = CustomerProductPricing::where('customer_id', $customerId)
            ->orderBy('valid_from', 'desc')
            ->get();
        
        // Group by product_id and type, taking the first (most recent) for each combination
        $existingPricing = [];
        foreach ($allPricing as $pricing) {
            $key = $pricing->product_id . '_' . $pricing->type;
            if (!isset($existingPricing[$key])) {
                $existingPricing[$key] = $pricing;
            }
        }

        return view('customer-pricing.edit', [
            'customer' => $customer,
            'products' => $products,
            'existingPricing' => $existingPricing,
            'allPricing' => $allPricing,
        ]);
    }

    /**
     * Update pricing for a customer.
     */
    public function update(Request $request, $customerId)
    {
        $request->validate([
            'pricing' => 'required|array',
            'pricing.*.product_id' => 'required|exists:products,Product_Id',
            'pricing.*.type' => 'required|in:proforma,commercial',
            'pricing.*.price' => 'required|numeric|min:0',
            'pricing.*.valid_from' => 'required|date',
            'pricing.*.valid_to' => 'nullable|date|after_or_equal:pricing.*.valid_from',
        ]);

        $customer = Customers::findOrFail($customerId);

        foreach ($request->pricing as $pricingData) {
            // Check if pricing already exists for this customer, product, type, and valid_from
            $existing = CustomerProductPricing::where('customer_id', $customerId)
                ->where('product_id', $pricingData['product_id'])
                ->where('type', $pricingData['type'])
                ->where('valid_from', $pricingData['valid_from'])
                ->first();

            if ($existing) {
                // Update existing pricing
                $existing->update([
                    'price' => $pricingData['price'],
                    'valid_to' => $pricingData['valid_to'] ?? null,
                ]);
            } else {
                // Create new pricing
                CustomerProductPricing::create([
                    'customer_id' => $customerId,
                    'product_id' => $pricingData['product_id'],
                    'type' => $pricingData['type'],
                    'price' => $pricingData['price'],
                    'valid_from' => $pricingData['valid_from'],
                    'valid_to' => $pricingData['valid_to'] ?? null,
                ]);
            }
        }

        return redirect()->route('customer-pricing.index')
            ->with('success', 'Customer pricing updated successfully.');
    }

    /**
     * Store a single pricing record (via AJAX or form).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,Product_Id',
            'type' => 'required|in:proforma,commercial',
            'price' => 'required|numeric|min:0',
            'valid_from' => 'required|date',
            'valid_to' => 'nullable|date|after_or_equal:valid_from',
        ]);

        CustomerProductPricing::create($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Pricing added successfully.']);
        }

        return redirect()->route('customer-pricing.edit', $validated['customer_id'])
            ->with('success', 'Pricing added successfully.');
    }

    /**
     * Remove a pricing record.
     */
    public function destroy($id)
    {
        $pricing = CustomerProductPricing::findOrFail($id);
        $customerId = $pricing->customer_id;
        $pricing->delete();

        return redirect()->route('customer-pricing.edit', $customerId)
            ->with('success', 'Pricing removed successfully.');
    }
}

