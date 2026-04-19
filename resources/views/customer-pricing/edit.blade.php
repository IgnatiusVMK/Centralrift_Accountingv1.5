@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <div class="card-header">
                            <h4 class="card-title">Manage Pricing for: {{ $customer->Customer_Name }}
                                <a href="{{ route('customer-pricing.index') }}" class="btn btn-danger float-end">
                                    <i class="mdi mdi-arrow-left"></i> Back to List
                                </a>
                            </h4>
                            <p class="card-description">Set pricing for Commercial and Proforma invoices per product</p>
                        </div>

                        <form action="{{ route('customer-pricing.update', $customer->id) }}" method="POST" id="pricingForm">
                            @csrf
                            @method('PUT')

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Invoice Type</th>
                                            <th>Price</th>
                                            <th>Valid From</th>
                                            <th>Valid To (Optional)</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="pricingRows">
                                        @php
                                            $rowIndex = 0;
                                        @endphp
                                        @foreach ($products as $product)
                                            @foreach (['commercial', 'proforma'] as $type)
                                                @php
                                                    $key = $product->Product_Id . '_' . $type;
                                                    $currentPricing = $existingPricing[$key] ?? null;
                                                @endphp
                                                <tr data-product-id="{{ $product->Product_Id }}" data-type="{{ $type }}">
                                                    <td>
                                                        @if($loop->first)
                                                            <strong>{{ $product->Product_Name }}</strong>
                                                        @else
                                                            <span class="ml-3">{{ $product->Product_Name }}</span>
                                                        @endif
                                                        <input type="hidden" name="pricing[{{ $rowIndex }}][product_id]" value="{{ $product->Product_Id }}">
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-{{ $type === 'commercial' ? 'info' : 'warning' }}">
                                                            {{ ucfirst($type) }}
                                                        </span>
                                                        <input type="hidden" name="pricing[{{ $rowIndex }}][type]" value="{{ $type }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" 
                                                               step="0.01" 
                                                               min="0" 
                                                               name="pricing[{{ $rowIndex }}][price]" 
                                                               class="form-control price-input" 
                                                               value="{{ old('pricing.' . $rowIndex . '.price', $currentPricing->price ?? $product->Price ?? '0.00') }}" 
                                                               required>
                                                        @error('pricing.' . $rowIndex . '.price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="date" 
                                                               name="pricing[{{ $rowIndex }}][valid_from]" 
                                                               class="form-control" 
                                                               value="{{ old('pricing.' . $rowIndex . '.valid_from', $currentPricing->valid_from ?? date('Y-m-d')) }}" 
                                                               required>
                                                        @error('pricing.' . $rowIndex . '.valid_from')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="date" 
                                                               name="pricing[{{ $rowIndex }}][valid_to]" 
                                                               class="form-control" 
                                                               value="{{ old('pricing.' . $rowIndex . '.valid_to', $currentPricing ? ($currentPricing->valid_to ?? '') : '') }}">
                                                        @error('pricing.' . $rowIndex . '.valid_to')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        @if ($currentPricing)
                                                            <input type="hidden" name="pricing[{{ $rowIndex }}][id]" value="{{ $currentPricing->id }}">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($currentPricing)
                                                            <form action="{{ route('customer-pricing.destroy', $currentPricing->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                        class="btn btn-sm btn-danger"
                                                                        onclick="return confirm('Are you sure you want to remove this pricing?')">
                                                                    <i class="mdi mdi-delete"></i> Remove
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @php
                                                    $rowIndex++;
                                                @endphp
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-content-save"></i> Save All Pricing
                                </button>
                                <a href="{{ route('customer-pricing.index') }}" class="btn btn-secondary">
                                    <i class="mdi mdi-cancel"></i> Cancel
                                </a>
                            </div>
                        </form>

                        <!-- Existing Pricing Records (if any with different valid_from dates) -->
                        @php
                            $shownIds = collect($existingPricing)->pluck('id')->toArray();
                            $additionalPricing = $allPricing->whereNotIn('id', $shownIds);
                        @endphp
                        @if ($additionalPricing->count() > 0)
                        <div class="mt-4">
                            <h5>Additional Pricing Records (Historical)</h5>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Type</th>
                                            <th>Price</th>
                                            <th>Valid From</th>
                                            <th>Valid To</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($additionalPricing as $pricing)
                                            @php
                                                $product = $products->firstWhere('Product_Id', $pricing->product_id);
                                            @endphp
                                            <tr>
                                                <td>{{ $product->Product_Name ?? 'N/A' }}</td>
                                                <td><span class="badge badge-{{ $pricing->type === 'commercial' ? 'info' : 'warning' }}">{{ ucfirst($pricing->type) }}</span></td>
                                                <td>{{ number_format($pricing->price, 2) }}</td>
                                                <td>{{ $pricing->valid_from }}</td>
                                                <td>{{ $pricing->valid_to ?? 'N/A' }}</td>
                                                <td>
                                                    <form action="{{ route('customer-pricing.destroy', $pricing->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Are you sure you want to delete this pricing?')">
                                                            <i class="mdi mdi-delete"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Validate form before submit
        document.getElementById('pricingForm').addEventListener('submit', function(e) {
            const priceInputs = document.querySelectorAll('.price-input');
            let isValid = true;

            priceInputs.forEach(function(input) {
                if (!input.value || parseFloat(input.value) < 0) {
                    isValid = false;
                    input.classList.add('is-invalid');
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Please ensure all prices are valid (greater than or equal to 0).');
            }
        });

        // Validate date ranges
        const dateInputs = document.querySelectorAll('input[type="date"]');
        dateInputs.forEach(function(input) {
            if (input.name.includes('valid_to')) {
                input.addEventListener('change', function() {
                    const row = this.closest('tr');
                    const validFromInput = row.querySelector('input[name*="valid_from"]');
                    if (validFromInput.value && this.value && this.value < validFromInput.value) {
                        alert('Valid To date must be after or equal to Valid From date.');
                        this.value = '';
                    }
                });
            }
        });
    });
</script>
@endsection
