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
                  <h4 class="card-title">Capital Withdrawal
                    <a href="{{ url('cycles/'.$Cycle_Id) }}" class="btn btn-danger float-end"><i class="mdi mdi-close"></i></a>
                  </h4>
                  </div>
                  <form action="{{ url('capital-withdrawal/'.$Cycle_Id.'/create')}}" method="POST">
                    @csrf

                    <div class="mb-3">
                      {{-- <label>Maker ID</label> --}}
                      <input type="hidden" name="maker_id" class="form-control" value="{{Auth::user()->id}}" readonly/>
                      @error('maker_id') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <input type="hidden" name="Cycle_Id" class="form-control" value="{{ $Cycle_Id }}" readonly/>
                    </div>
                    <div class="mb-3">
                      <label>Withdrawal Id</label>
                      <input type="text" name="Capt_Withdraw_Id" class="form-control" value="{{ $CpWuniqueCode }}" readonly/>
                      @error('Capt_Withdraw_Id') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Description</label>
                      <input type="text" name="Description" class="form-control" value="{{ old ('Description') }}" />
                      @error('Description') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Amount</label>
                      <input type="number" name="Amount" class="form-control" value="{{ old ('Amount') }}" />
                      @error('Amount') <span class="text-danger">{{ $message}}</span> @enderror
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