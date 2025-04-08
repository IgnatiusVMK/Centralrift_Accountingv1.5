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
                  <h4 class="card-title">Credit/Creditors
                    <a href="{{ url('credit') }}" class="btn btn-danger float-end"><i class="mdi mdi-close"></i></a>
                  </h4>
                  </div>
                  <form action="{{ route('credit.store')}}" method="POST">
                    @csrf

                    <div class="mb-3">
                      {{-- <label>Maker ID</label> --}}
                      <input type="hidden" name="maker_id" class="form-control" value="{{Auth::user()->id}}" readonly/>
                      @error('maker_id') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Credit_Id</label>
                      <input type="text" name="Credit_Id" class="form-control" value="{{ $uniqueCode }}" readonly/>
                      @error('Credit_Id') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Source</label>
                      <input type="text" name="Source" class="form-control" value="{{ old ('Source') }}" />
                      @error('Source') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Description</label>
                      <input type="text" name="Description" class="form-control" value="{{ old ('Description') }}" />
                      @error('Description') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Amount</label>
                      <input type="number" name="Amount" step="0.01" class="form-control" value="{{ old ('Amount') }}" />
                      @error('Amount') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Cuurency</label>
                      <input type="text" name="Currency" class="form-control" value="{{ old ('Currency') }}" />
                      @error('Currency') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Remarks</label>
                      <input type="text" name="Remarks" class="form-control" value="{{ old ('Remarks') }}" />
                      @error('Remarks') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>

                    <div class="mb-3">
                      <label>Credit Date (mm/dd/yyyy)</label>
                      <input type="date" name="Credit_Date" class="form-control" value="{{ old('Credit_Date') }}" />
                      @error('Credit_Date') <span class="text-danger">{{ $message }}</span> @enderror
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