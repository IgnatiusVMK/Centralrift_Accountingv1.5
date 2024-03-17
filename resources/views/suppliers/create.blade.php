@extends('layouts.app')
@php
$currentDate= new DateTime();
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
                      <div class="alert alert-success">{{session('status')}}</div>
                    @endif
                  <h4 class="card-title">New Product Suppliers
                    <a href="{{ url('/suppliers') }}" class="btn btn-danger float-end"><i class="mdi mdi-close"></i></a>
                  </h4>
                  </div>
                  <form action="{{ url('suppliers/create')}}" method="post">
                    @csrf

                    <div class="mb-3">
                      <label>Supplier Name</label>
                      <input type="text" name="Supplier_Name" class="form-control" value="{{ old ('Supplier_Name') }}" />
                      @error('Supplier_Name') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Contact Name</label>
                      <input type="text" name="Contact_Name" class="form-control" value="{{ old ('Contact_Name') }}" />
                      @error('Contact_Name') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Address</label>
                      <input type="text" name="Address" class="form-control" value="{{ old ('Address') }}" />
                      @error('Address') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Phone</label>
                      <input type="number" name="Phone" class="form-control" value="{{ old ('Phone') }}" />
                      @error('Phone') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Email</label>
                      <input type="email" name="Email" class="form-control" value="{{ old ('Email') }}" />
                      @error('Email') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Registered On:</label>
                      <input type="date" name="Created_Date" class="form-control" value="{{$currentDate->format('Y-m-d')}}" readonly/>
                      @error('Created_Date') <span class="text-danger">{{ $message}}</span> @enderror
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
        <!-- content-wrapper ends -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
@endsection