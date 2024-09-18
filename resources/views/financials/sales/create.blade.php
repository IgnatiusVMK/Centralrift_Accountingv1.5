@extends('layouts.app')
@php
    $categoryId = $cycle->Category_Id;
@endphp

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            @if (session('status'))
                                <div class="alert alert-success">{{ session('status') }}</div>
                            @endif
                            <h4 class="card-title">Record Sales
                                <a href="{{ url('cycles/'.$Cycle_Id ) }}" class="btn btn-danger float-end"><i class="mdi mdi-close"></i></a>
                            </h4>
                        </div>
                        <form action="{{ url('sales/'.$Cycle_Id.'/create') }}" method="post">
                            @csrf
                            <!-- Existing Fields -->
                            <div class="mb-3">
                                <input type="hidden" name="maker_id" class="form-control" value="{{ Auth::user()->id }}" readonly/>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="Cycle_Id" class="form-control" value="{{ $Cycle_Id }}" readonly/>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="Sales_Id" class="form-control" value="{{ $SaleuniqueCode }}" readonly/>
                            </div>
                            <div class="mb-3">
                                <label>Customer</label>
                                <select id="customer-select" name="Customer_Id" class="form-control" required>
                                    <option value="0">-- SELECT CUSTOMER --</option>
                                    @foreach($Customers as $customer)
                                        <option value="{{ $customer->id }}" data-account-no="{{ $customer->Cust_Account_No }}">
                                            {{ $customer->Customer_Name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- @php
                              dd($categoryId);
                            @endphp --}}

                            <div class="mb-3">
                              <label>Customer Account No.</label>
                              <input type="text" id="account-number" name="Cust_Account_No" class="form-control" readonly />
                              @error('Cust_Account_No') <span class="text-danger">{{ $message }}</span> @enderror
                          </div>

                            <!-- Other fields common to all product types -->
                            <div class="mb-3">
                                <label>LPO Number: </label>
                                <input type="text" id="lpo-number" name="Lpo_No" class="form-control" value="{{ old('Lpo_No') }}" />
                            </div>

                            <!-- Conditionally include the sales partial based on Category_Id -->
                            
                            <!-- 3 for Animal Produce -->
                            @if($categoryId === 3)
                              @include('financials.sales.partials.animal_produce_form')

                            <!-- 1 for Herbs & Spices -->
                            @elseif($categoryId === 1) 
                              @include('financials.sales.partials.herbs_form')

                            <!-- 2 for Farm Crop Produce -->
                            @elseif($categoryId === 2)
                              @include('financials.sales.partials.farm_crop_form')
                            @endif

                            <div class="mb-3">
                                <button type="submit" class="btn btn-success text-center">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const customerSelect = document.getElementById('customer-select');
    const accountNumberInput = document.getElementById('account-number');

    // Autoload account number based on selected customer
    if (customerSelect) {
        customerSelect.addEventListener('change', function() {
            const selectedOption = customerSelect.options[customerSelect.selectedIndex];
            const accountNumber = selectedOption.getAttribute('data-account-no');
            accountNumberInput.value = accountNumber || '';
        });
    }
});

</script>
@endsection
