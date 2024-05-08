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
                  <h4 class="card-title">Record Sales
                    <a href="{{ url('cycles/'.$Cycle_Id ) }}" class="btn btn-danger float-end"><i class="mdi mdi-close"></i></a>
                  </h4>
                  </div>
                  <form action="{{ url('sales/'.$Cycle_Id.'/create') }}" method="post">
                    @csrf

                    <div class="mb-3">
                      {{-- <label>Maker ID</label> --}}
                      <input type="hidden" name="maker_id" class="form-control" value="{{Auth::user()->id}}" readonly/>
                      @error('maker_id') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                        <div class="mb-3">
                          <label>Cycle</label>
                          <input type="text" name="Cycle_Id" class="form-control" value="{{ $Cycle_Id }}" readonly/>
                          @error('Cycle_Id') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          {{-- <label>Sale ID</label> --}}
                          <input type="hidden" name="Sales_Id" class="form-control" value="{{ $SaleuniqueCode }}" readonly/>
                          @error('Sales_Id') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <label>Customer</label>
                          <select id="Customer_Id" name="Customer_Id" class="form-control" required>
                            <option value="0">-- SELECT CUSTOMER --</option>
                              @foreach($Customers as $customer)
                                  <option value="{{$customer->Customer_Id}}">{{$customer->Customer_Fname}}
                                  </option>
                              @endforeach
                          </select>
                          @error('Customer_Id') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <label>Quantity</label>
                          <input type="number" name="Quantity" class="form-control" value="{{ old ('Quantity') }}" />
                          @error('Quantity') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <label>Payment Status</label>
                          <select id="Payment_Status" name="Payment_Status" class="form-control" required>
                            <option value="Paid" class="text-success" >Paid</option>
                            <option value="Un-Paid" class="text-danger" selected>Un-Paid</option>
                            <option value="Pending" class="text-warning">Pending</option>
                          </select>
                          @error('Payment_Status') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <label>Total Amount</label>
                          <input type="number" name="Total_Price" class="form-control" value="{{ old ('Total_Price') }}" />
                          @error('Total_Price') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <label>Date</label>
                          <input type="date" name="Sale_Date" class="form-control" value="{{ old ('Sale_Date') }}" />
                          @error('Sale_Date') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <button type="submit" class="btn btn-success text-center">Save</button>
                        </div>
                  </form>
                </div>
              </div>
            </div>
           
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
@endsection