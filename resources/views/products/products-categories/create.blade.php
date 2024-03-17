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
                  <h4 class="card-title">Create New Category
                    <a href="{{ url('/products-categories') }}" class="btn btn-danger float-end"><i class="mdi mdi-close"></i></a>
                  </h4>
                  </div>
                  <form action="{{ url('/products-categories/create')}}" method="post">
                    @csrf

                    <div class="mb-3">
                      <label>Category Name</label>
                      <input type="text" name="Category_Name" class="form-control" value="{{ old ('Category_Name') }}"/>
                      @error('Category_Name') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Description</label>
                      <input type="text" name="Description" class="form-control" value="{{ old ('Description') }}" />
                      @error('Description') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
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