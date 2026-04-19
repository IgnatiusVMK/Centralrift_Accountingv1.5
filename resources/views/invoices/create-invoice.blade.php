@extends('layouts.app')

@section('content')
<!-- Bootstrap Select CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

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

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <h4 class="card-title">Invoice Details
                                {{-- <a href="{{ url('cycles/'.$Cycle_Id ) }}" class="btn btn-danger float-end"><i class="mdi mdi-close"></i></a> --}}
                            </h4>
                        </div>
                        <form action="{{ url(route('invoice.store')) }}" method="post">
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="mb-3">
                                <input type="hidden" name="maker_id" class="form-control" value="{{ Auth::user()->id }}" readonly/>
                            </div>

                            <div class="mb-3">
                                <label>Customer Name</label>
                                <select name="customer_id" class="form-control selectpicker" data-live-search="true">
                                    <option value="" selected> -- CUSTOMER --</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->Customer_Name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                            <label>Currency</label>
                                <div class="d-flex flex-wrap gap-4">
                                    <div class="form-check">
                                    <input type="radio" id="option1-currency" name="currency" value="KES" class="form-check-input" />
                                    <label for="option1-currency" class="form-check-label">KES</label>
                                    </div>
                                    <div class="form-check">
                                    <input type="radio" id="option2-currency" name="currency" value="EUR" class="form-check-input" />
                                    <label for="option2-currency" class="form-check-label">EUR</label>
                                    </div>
                                    <div class="form-check">
                                    <input type="radio" id="option3-currency" name="currency" value="USD" class="form-check-input" />
                                    <label for="option3-currency" class="form-check-label">USD</label>
                                    </div>
                                    <div class="form-check">
                                    <input type="radio" id="option4-currency" name="currency" value="GBP" class="form-check-input" />
                                    <label for="option4-currency" class="form-check-label">GBP</label>
                                    </div>
                                </div>
                                @error('currency')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label>Invoice Number</label>
                                <input type="number" id="invoice_number" name="invoice_number" class="form-control"/>
                                @error('invoice_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label>Order Number</label>
                                <input type="number" id="order_number" name="order_number" class="form-control" />
                                @error('order_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label>Date (mm/dd/yyyy)</label>
                                <input type="date" name="date" class="form-control" value="{{ old('date') }}" />
                                @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                             <!-- Produce Section -->
                            <div class="mb-3">
                                <label>Produce</label>
                                <div id="produce-fields">
                                    <div class="produce-group mb-3">

                                        <select name="produce[0][product_id]" class="form-control selectpicker" data-live-search="true">
                                            <option value="" selected>-- Select Produce --</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->Product_Id}}">{{ $product->Product_Name}}</option>
                                            @endforeach
                                        </select><br>

                                        <input type="text" name="produce[0][description]" class="form-control mb-2" placeholder="Item Description" autocomplete="off" required />
                                        <input type="number" name="produce[0][weight]" class="form-control mb-2" placeholder="Quantity" required />
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" id="add-produce">+ Add Produce</button>
                            </div>

                            <!-- Save Button -->
                            <div class="mb-3">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      let produceIndex = 1;

      // Add Produce button
      document.getElementById('add-produce').addEventListener('click', function () {
          let produceFields = `
              <div class="produce-group mb-3">
                  <select name="produce[${produceIndex}][product_id]" class="form-control">
                        <option value="" selected>-- Select Produce --</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->Product_Id}}">{{ $product->Product_Name}}</option>
                            @endforeach
                    </select><br>

                  <input type="text" name="produce[${produceIndex}][description]" class="form-control mb-2" placeholder="Item Description" autocomplete="off" required />
                  <input type="number" name="produce[${produceIndex}][weight]" class="form-control mb-2" placeholder="Weight" required />
                  <button type="button" class="btn btn-danger remove-produce">Remove</button>
              </div>`;

          document.getElementById('produce-fields').insertAdjacentHTML('beforeend', produceFields);
          produceIndex++;

          // Add event listener for remove button
          attachRemoveListener();
      });

      // Function to attach event listener to all remove buttons
      function attachRemoveListener() {
          document.querySelectorAll('.remove-produce').forEach(button => {
              button.addEventListener('click', function () {
                  this.parentElement.remove();
              });
          });
      }

      // Initial listener for remove button
      attachRemoveListener();
  });
</script>

{{-- <script>
    $(document).ready(function() {
        $('.customer-select').select2({
            placeholder: "-- CUSTOMER --",
            allowClear: true
        });
    });
</script> --}}

<script>
    $('.selectpicker').selectpicker();
</script>

@endsection
