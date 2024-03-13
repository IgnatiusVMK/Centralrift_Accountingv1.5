@extends('layouts.app')
@php
$currentDate= new DateTime();
@endphp
@section('content')
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Product Orders</h4>
        <p class="card-description">
          Basic form layout
        </p>
        <form class="forms-sample" action="" {{-- method="POST" --}}>
            {{-- @csrf --}}
          <div class="form-group">
            <label for="company_name">Company Name</label>
            <input type="text" class="form-control" id="company_name" placeholder="Company Name">
          </div>
          <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" class="form-control" id="product_name" placeholder="Product Name">
          </div>
          <div class="form-group">
            <label for="order_date">Order Date</label>
            <input type="date" class="form-control" id="order_date" placeholder="Order Date" {{-- value="{{$currentDate->format('Y-m-d')}}" --}}>
          </div>
          <div class="form-group">
            <label for="planting_date">Planting Date</label>
            <input type="date" class="form-control" id="planting_date" placeholder="Planting Date" {{-- value="{{$currentDate->format('Y-m-d')}}" --}}>
          </div>
          <div class="form-group">
            <label for="harvest_date">Expected Harvest Date</label>
            <input type="date" class="form-control" id="harvest_date" placeholder="Harvest Date" {{-- value="{{$currentDate->format('Y-m-d')}}" --}}>
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