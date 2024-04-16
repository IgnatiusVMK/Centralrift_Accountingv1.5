@extends('layouts.app')
@section('content')
@include('layouts.export')
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  @if (session('status'))
                      <div class="alert alert-danger text-center">{{session('status')}}</div>
                    @endif
                  <div class="card-header">
                  <h4 class="card-title">Daily Expenditures
                    {{-- <a href="{{ url('financials/expenditures/create') }}" class="btn btn-primary float-end">+ Record New Expenditure</a> --}}
                  </h4>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Sn No.
                          </th>
                          <th>
                            Cycle
                          </th>
                          <th>
                            ID
                          </th>
                          <th>
                            Reason
                          </th>
                          <th>
                            Description
                          </th>
                          <th>
                            Amount
                          </th>
                          <th>
                            Date Created
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($financials as $fin )
                        <tr>
                          <td>{{$fin->Financial_Id}}</td>
                          <td>{{$fin->Cycle_Id}}</td>
                          <td>{{$fin->Fin_Id_Id}}</td>
                          <td>{{$fin->Reason}}</td>
                          <td>{{$fin->Description}}</td>
                          <td>Ksh {{$fin->Amount}}</td>
                          <td>{{$fin->created_at}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="pagination-container float-end">
                      {{ $financials->links() }}
                    </div>
                  </div>
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
