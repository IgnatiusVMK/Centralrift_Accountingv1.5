@extends('layouts.app')
@php
$currentDate= new DateTime();
@endphp
@section('content')
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="card-header">
          @if (session('status'))
            <div class="alert alert-success">{{session('status')}}</div>
          @endif
          <h4 class="card-title">Product Orders
            <a href="{{ url('dashboard') }}" class="btn btn-danger float-end">{{-- Back --}} <i class="mdi mdi-close"></i></a>
          </h4>
        </div>
        <p class="card-description">
          Register Product Orders
        </p>
        <form class="forms-sample" action="{{ url('/add-order/create')}}" method="POST">
            @csrf
          <div class="form-group">
            <label for="company_name">Company Name</label>
            <input type="text" class="form-control" name="company_name" placeholder="Company Name" value="{{ old('company_name') }}">
          </div>
          <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" class="form-control" name="product_name" placeholder="Product Name" value="{{ old('product_name') }}">
          </div>
          <div class="form-group">
            <label for="order_date">Order Date</label>
            <input type="date" class="form-control" name="order_date" placeholder="Order Date" value="{{ old('order_date') }}">
          </div>
          <div class="form-group">
            <label for="planting_date">Planting Date</label>
            <input type="date" class="form-control" name="planting_date" placeholder="Planting Date" value="{{ old('planting_date') }}">
          </div>
          <div class="form-group">
            <label for="harvest_date">Expected Harvest Date</label>
            <input type="date" class="form-control" name="harvest_date" placeholder="Harvest Date" value="{{ old('harvest_date') }}">
          </div>
          <button type="submit" class="btn btn-primary me-2">Submit</button>
          <button class="btn btn-danger" type="button" onclick="window.location='{{ route('dashboard') }}'">
            Cancel
          </button>
        </form>
      </div>
    </div>
  </div>
@endsection