@extends('layouts.app')

@section('content')
<div class="col-sm-12">
    <div class="home-tab">
        <div class="d-sm-flex align-items-center justify-content-between border-bottom">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success text-center">{{ session('status') }}</div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success text-center">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger text-center">{{ session('error') }}</div>
                    @endif

                    <div class="card-header">
                        <h4 class="card-title">Customer Product Pricing</h4>
                        <p class="card-description">Manage pricing for customers per product (Commercial & Proforma invoices)</p>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sn No.</th>
                                    <th>Customer Name</th>
                                    <th>Account Number</th>
                                    <th>Products with Pricing</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customers as $index => $customer)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><strong>{{ $customer->Customer_Name }}</strong></td>
                                        <td>{{ $customer->Cust_Account_No ?? 'N/A' }}</td>
                                        <td>
                                            @php
                                                $pricingCount = $customer->pricing->count();
                                                $pricingGroups = $customer->pricing->groupBy('product_id');
                                            @endphp
                                            @if ($pricingCount > 0)
                                                <span class="badge badge-success">{{ $pricingCount }} product(s)</span>
                                                <br><br>
                                                <div style="max-height: 200px; overflow-y: auto;">
                                                    @foreach ($pricingGroups as $productId => $prices)
                                                        @php
                                                            $product = $products->firstWhere('Product_Id', $productId);
                                                            $commercialCount = $prices->where('type', 'commercial')->count();
                                                            $proformaCount = $prices->where('type', 'proforma')->count();
                                                        @endphp
                                                        @if ($product)
                                                            <div class="mb-2">
                                                                <strong>{{ $product->Product_Name }}</strong>
                                                                <span class="badge badge-info">{{ $commercialCount }} Comm</span>
                                                                <span class="badge badge-warning">{{ $proformaCount }} Prof</span>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="badge badge-warning">No pricing set</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('customer-pricing.edit', $customer->id) }}" class="btn btn-primary">
                                                <i class="mdi mdi-pencil"></i> Manage Pricing
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No customers found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
