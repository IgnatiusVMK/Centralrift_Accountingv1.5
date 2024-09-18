@extends('layouts.app')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">
                                @if (session('status'))
                                    <div class="alert alert-success">{{session('status')}}</div>
                                @endif
                                <h4 class="card-title">New Planting Cycle
                                    <a href="{{ url('cycles') }}" class="btn btn-danger float-end"><i class="mdi mdi-close"></i></a>
                                </h4>
                            </div>
                            <form action="{{ url('cycles/create')}}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <input type="hidden" name="maker_id" class="form-control" value="{{Auth::user()->id}}" readonly/>
                                    @error('maker_id') <span class="text-danger">{{ $message}}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Block</label>
                                    <select name="Block_Id" class="form-control">
                                        <option value="11" selected> -- SELECT BLOCK --</option>
                                        @foreach ($blocks as $block)
                                            <option value="{{ $block->Block_Id}}">{{ $block->Block_Name }}</option>
                                        @endforeach
                                    </select>
                                    @error('Block_Id') <span class="text-danger">{{ $message}}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Product</label>
                                    <select name="Product" class="form-control">
                                        <option value="" selected> -- SELECT PRODUCT --</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->Product_Name}}">{{ $product->Product_Name }}</option>
                                        @endforeach
                                    </select>
                                    @error('Product') <span class="text-danger">{{ $message}}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Customer Name</label>
                                    <select name="Client_Name" class="form-control">
                                        <option value="" selected> -- CUSTOMER --</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->Customer_Name}}">{{ $customer->Customer_Name}}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="text" id="client-name" name="Client_Name" class="form-control" value="{{ old('Client_Name') }}" />
                                    <input type="hidden" id="selected-customer-id" name="Customer_Id" value="{{ old('Customer_Id') }}"> --}}
                                    @error('Client_Name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Cycle Name</label>
                                    <input type="text" name="Cycle_Name" class="form-control" value="{{ old ('Cycle_Name') }}" />
                                    @error('Cycle_Name') <span class="text-danger">{{ $message}}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Cycle Start</label>
                                    <input type="date" name="Cycle_Start" class="form-control" value="{{ old ('Cycle_Start') }}" />
                                    @error('Cycle_Start') <span class="text-danger">{{ $message}}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Cycle End</label>
                                    <input type="date" name="Cycle_End" class="form-control" value="{{ old ('Cycle_End') }}" />
                                    @error('Cycle_End') <span class="text-danger">{{ $message}}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit"  class="btn btn-success text-center">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <script>
      $(document).ready(function() {
          var customers = @json($customers);  // Pass the customers data to JavaScript
          console.log(customers);  // Check if customers data is correctly logged
  
          $("#client-name").autocomplete({
              source: function(request, response) {
                  var filtered = customers.filter(function(customer) {
                      return customer.name.toLowerCase().includes(request.term.toLowerCase());
                  }).map(function(customer) {
                      return { label: customer.name, value: customer.id };
                  });
                  response(filtered);
              },
              select: function(event, ui) {
                  // When a customer is selected, populate the hidden Customer_Id field
                  $("#client-name").val(ui.item.label);  // Set the name field
                  $("#selected-customer-id").val(ui.item.value);  // Set the hidden customer ID field
                  return false;  // Prevent the default behavior
              }
          });
      });
  </script> --}}
  
@endsection
