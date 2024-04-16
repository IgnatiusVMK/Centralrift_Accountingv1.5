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
                        @foreach ($maintenance as $maint )
                        <tr>
                          <td>{{$maint->Financial_Id}}</td>
                          <td>{{$maint->Cycle_Id}}</td>
                          <td>{{$maint->Fin_Id_Id}}</td>
                          <td>{{$maint->Reason}}</td>
                          <td>{{$maint->Description}}</td>
                          <td>Ksh {{$maint->Amount}}</td>
                          <td>{{$maint->created_at}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="pagination-container float-end">
                      {{ $maintenance->links() }}
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
