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
                  <h4 class="card-title">Edit Customers
                    <a href="{{ url('customers') }}" class="btn btn-primary float-end">Back</a>
                  </h4>
                  </div>
                  <form action="{{ url('customers/'.$customer->Customer_Id.'/edit') }}" method="POST">
                  @csrf
                  @method('PUT')

                    <div class="mb-3">
                      <label>Customer ID</label>
                      <input type="text" name="Customer_Id" class="form-control" value="{{ $customer->Customer_Id }}" readonly/>
                      @error('Customer_Id') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>First Name</label>
                      <input type="text" name="Customer_Fname" class="form-control" value="{{ $customer->Customer_Fname }}" />
                      @error('Customer_Fname') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Last Name</label>
                      <input type="text" name="Customer_Lname" class="form-control" value="{{$customer->Customer_Lname }}" />
                      @error('Customer_Lname') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Email</label>
                      <input type="email" name="Email" class="form-control" value="{{ $customer->Email }}" />
                      @error('Email') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Contact</label>
                      <input type="text" name="Contact" class="form-control" value="{{ $customer->Contact }}" />
                      @error('Contact') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Address</label>
                      <input type="text" name="Address" class="form-control" value="{{ $customer->Address }}" />
                      @error('Address') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Is Active</label>
                      <input type="checkbox" name="is_active" {{ $customer->is_active== true ? 'checked':''}} />
                    </div>
                    <div class="mb-3">
                      <button type="submit"  class="btn btn-primary">Update</button>
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