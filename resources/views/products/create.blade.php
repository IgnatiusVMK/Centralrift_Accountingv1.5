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
                  <h4 class="card-title">Create New Product
                    <a href="{{ url('products') }}" class="btn btn-danger float-end"><i class="mdi mdi-close"></i></a>
                  </h4>
                  </div>
                  <form action="{{ url('products/create')}}" method="post">
                    @csrf

                    <div class="mb-3">
                      <label>Product Name</label>
                      <input type="text" name="Product_Name" class="form-control" value="{{ old ('Product_Name') }}"/>
                      @error('Product_Name') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Description</label>
                      <input type="text" name="Description" class="form-control" value="{{ old ('Description') }}" />
                      @error('Description') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Price per KG</label>
                      <input type="number" name="Price" class="form-control" value="{{ old ('Price') }}" />
                      @error('Price') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Product Category</label>
                        <select name="Category_Id" class="form-control">
                          <option value="6" selected> -- SELECT PRODUCT CATEGORY --</option>
                          @foreach ($categories as $pcategory)
                            <option value="{{ $pcategory->Category_Id }}">{{ $pcategory->Category_Name }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                        <label>Product Supplier</label>
                        <select name="Supplier_Id" class="form-control">
                          <option value="6" selected> -- SELECT PRODUCT SUPPLIER --</option>
                          @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->Supplier_Id }}">{{ $supplier->Supplier_Name }}</option>
                          @endforeach
                      </select>
                    <div class="mb-3">
                      <label>Date</label>
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