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
                            @if($categoryId === 3)
                              
                            @elseif($categoryId ===2 || $categoryId ===1)
                                <div class="mb-3">
                                    <label>Harvest</label>
                                    <select id="harvest-select" name="Harvest_Id" class="form-control" required>
                                        <option value="" disabled selected>-- SELECT HARVEST --</option>
                                        @foreach($harvests as $harvest)
                                            <option 
                                                value="{{ $harvest->id }}"
                                                data-customer-name="{{ $harvest->Customer_Name }}"
                                                data-customer-id="{{ $harvest->customer->id ?? '' }}"
                                                data-account-number="{{ $harvest->customer->Cust_Account_No ?? '' }}"
                                                data-net-weight="{{ $harvest->quantity_harvested }}">
                                                {{ $harvest->Product . '. Date:' . $harvest->harvest_date }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Displayed customer name -->
                                <div class="mb-3">
                                    <label>Customer</label>
                                    <input type="text" id="customer_name" class="form-control" readonly />
                                </div>

                                <!-- Hidden field to store actual Customer_Id -->
                                <input type="hidden" name="Customer_Id" id="customer_id" />
                                @error('Customer_Id') <span class="text-danger">{{$message}}</span> @enderror

                                <div class="mb-3">
                                <label>Customer Account No.</label>
                                <input type="text" id="account-number" name="Cust_Account_No" class="form-control" readonly />
                                @error('Cust_Account_No') <span class="text-danger">{{$message}}</span> @enderror
                                </div>

                                <!-- Other fields common to all product types -->
                                <div class="mb-3">
                                    <label>LPO Number: </label>
                                    <input type="text" id="lpo-number" name="Lpo_No" class="form-control" value="{{ old('Lpo_No') }}" />
                                </div>
                            @endif

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
{{--   <script>
    document.addEventListener('DOMContentLoaded', function() {
        const harvestSelect = document.getElementById('harvest-select');
        const customerNameInput = document.getElementById('customer_name');
        const accountNumberInput = document.getElementById('account-number');
        const customerIdInput = document.getElementById('customer_id');
    
        if (harvestSelect) {
            harvestSelect.addEventListener('change', function() {
                const selectedOption = harvestSelect.options[harvestSelect.selectedIndex];
                const customerName = selectedOption.getAttribute('data-customer-name') || '';
                const accountNumber = selectedOption.getAttribute('data-account-number') || '';
                const customerId = selectedOption.getAttribute('data-customer-id') || '';
    
                customerNameInput.value = customerName;
                accountNumberInput.value = accountNumber;
                customerIdInput.value = customerId;
            });
        }
    });
    </script> --}}
  
<script>
document.addEventListener('DOMContentLoaded', function () {
    const harvestSelect = document.getElementById('harvest-select');
    const customerNameInput = document.getElementById('customer_name');
    const accountNumberInput = document.getElementById('account-number');
    const customerIdInput = document.getElementById('customer_id'); // Hidden input
    const netWeightInput = document.getElementById('netWeight-herbs');

    harvestSelect.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];

        // Populate fields
        customerNameInput.value = selectedOption.getAttribute('data-customer-name') || '';
        accountNumberInput.value = selectedOption.getAttribute('data-account-number') || '';
        customerIdInput.value = selectedOption.getAttribute('data-customer-id') || '';

        const netWeight = selectedOption.getAttribute('data-net-weight');
        if (netWeight) {
            netWeightInput.value = netWeight;
            calculateCartonsHerbs();    // Maintain your carton logic
            calculateTotalPrice();      // Maintain total price logic
        }
    });
});
</script>

  
@endsection
