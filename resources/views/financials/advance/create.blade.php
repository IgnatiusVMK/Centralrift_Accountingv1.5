@extends('layouts.app')

@section('content')
{{-- @php
    dd([ 
      "Cycle" => $Cycle_Id,
      "Advance ID" => $advuniqueCode,

    ])->toArray()
@endphp --}}
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
                  <h4 class="card-title">Record Advances
                    <a href="{{ url('cycles/'.$Cycle_Id) }}" class="btn btn-danger float-end"><i class="mdi mdi-close"></i></a>
                  </h4>
                  </div>
                  <form action="{{ url('financials/advance/create')}}" method="post">
                    @csrf
                      <div class="mb-3">
                        <label>Cycle</label>
                        <input type="hidden" name="Cycle_Id" class="form-control" value="{{ $Cycle_Id }}" readonly/>
                        @error('Cycle_Id') <span class="text-danger">{{ $message}}</span> @enderror
                      </div>
                      <div class="mb-3">
                        <label>Financial ID</label>
                        <input type="text" name="Fin_Id_Id" class="form-control" value="{{ $advuniqueCode }}" readonly/>
                        @error('Fin_Id_Id') <span class="text-danger">{{ $message}}</span> @enderror
                      </div>
                      <div class="mb-3">
                        <label>Type</label>
                        <input type="text" name="type" class="form-control" value="advance" readonly/>
                        @error('type') <span class="text-danger">{{ $message}}</span> @enderror
                      </div>
                      <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="Reason" class="form-control" value="{{ old ('Reason') }}" />
                        @error('Reason') <span class="text-danger">{{ $message}}</span> @enderror
                      </div>
                      <div class="mb-3">
                        <label>Description</label>
                        <select id="Description" name="Description" class="form-control" required>
                          <option value="NULL" selected>-- SELECT MONTH --
                            @foreach(range(1, 12) as $month)
                                <option value="{{ \Carbon\Carbon::create(null, $month, 1)->format('F Y') }}">
                                    {{ \Carbon\Carbon::create(null, $month, 1)->format('F Y') }}
                                </option>
                            @endforeach
                        </select>
                        @error('Description') <span class="text-danger">{{ $message}}</span> @enderror
                      </div>
                      <div class="mb-3">
                        <label>Amount</label>
                        <input type="number" name="Amount" class="form-control" value="{{ old ('Amount') }}" />
                        @error('Amount') <span class="text-danger">{{ $message}}</span> @enderror
                      </div>
                      <div class="mb-3">
                        <label>Date</label>
                        <input type="date" name="Date" class="form-control" value="{{ old ('Date') }}" />
                        @error('Date') <span class="text-danger">{{ $message}}</span> @enderror
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