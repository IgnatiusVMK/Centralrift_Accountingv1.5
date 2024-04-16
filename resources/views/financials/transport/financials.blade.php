@extends('layouts.app')

@section('content')
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
                  <h4 class="card-title">Monthly Salaries
                    {{-- <a href="{{ url('financials/salaries/create') }}" class="btn btn-primary float-end">+ Record Salaries</a> --}}
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
                            ID
                          </th>
                          <th>
                            Name
                          </th>
                          <th>
                            Description
                          </th>
                          <th>
                            Amount
                          </th>
                          <th>
                            Date
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($transport as $tran )
                        <tr>
                          <td>{{$tran->Financial_Id}}</td>
                          <td>{{$tran->Fin_Id_Id}}</td>
                          <td>{{$tran->Reason}}</td>
                          <td>{{$tran->Description}}</td>
                          <td>Ksh {{$tran->Amount}}</td>
                          <td>{{$tran->created_at}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="pagination-container float-end">
                      {{ $transport->links() }}
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
