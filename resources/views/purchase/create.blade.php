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
                  <h4 class="card-title">Create New Record
                    <a href="{{ url('purchases/view') }}" class="btn btn-danger float-end"><i class="mdi mdi-close"></i></a>
                  </h4>
                  </div>
                  <form action="{{ url('purchase/create')}}" method="post">
                    @csrf

                    <div class="mb-3">
                        <input type="hidden" name="maker_id" class="form-control" value="{{Auth::user()->id}}" readonly/>
                        @error('maker_id') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Item Name</label>
                      <input type="text" name="Item_Name" class="form-control" value="{{ old ('Item_Name') }}"/>
                      @error('Item_Name') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Supplier</label>
                      <select name="Supplier_Id" class="form-control">
                        <option value="0" selected> -- SUPPLIER --</option>
                        @foreach ($suppliers as $supplier)
                          <option value="{{ $supplier->Supplier_Id }}">{{ $supplier->Supplier_Name }}</option>
                        @endforeach
                    </select>
                      @error('Supplier_Id') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Item Category</label>
                        <select name="Category_Id" class="form-control">
                            <option value="0" selected> -- ITEM CATEGORY --</option>
                            <option value="1">Chemicals</option>
                            <option value="2">Seeds</option>
                            <option value="3">Packaging</option>
                      </select>
                    </div>
                    <div class="mb-3">
                        <label>Quantity</label>
                        <input type="number" name="Quantity" class="form-control" value="{{ old ('Quantity') }}" />
                        @error('Quantity') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Unit Cost</label>
                        <input type="number" name="Unit_Cost" class="form-control" value="{{ old ('Unit_Cost') }}" />
                        @error('Unit_Cost') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Total_Cost</label>
                        <input type="number" name="Total_Cost" class="form-control" value="{{ old ('Total_Cost') }}" />
                        @error('Total_Cost') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Purchase Date</label>
                      <input type="date" name="Purchase_Date" class="form-control" value="{{old('Purchase_Date')}}"/>
                      @error('Purchase_Date') <span class="text-danger">{{ $message}}</span> @enderror
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