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
                  <h4 class="card-title">Electricty
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
                            Payment ID
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
                            Date
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($electricity as $elec )
                        <tr>
                          <td>{{$elec->Financial_Id}}</td>
                          <td>{{$elec->Fin_Id_Id}}</td>
                          <td>{{$elec->Reason}}</td>
                          <td>{{$elec->Description}}</td>
                          <td>Ksh {{$elec->Amount}}</td>
                          <td>{{$elec->created_at}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="pagination-container">
                      {{ $electricity->links() }}
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
