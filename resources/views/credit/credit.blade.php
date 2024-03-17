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
                  <h4 class="card-title">Creditors/Credit
                    <a href="{{ url('credit/create') }}" class="btn btn-primary float-end">+ Record New Credit</a>
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
                            Credit ID
                          </th>
                          <th>
                            Source
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
                        @foreach ($credits as $cred )
                        <tr>
                          <td>{{$cred->id}}</td>
                          <td>{{$cred->Credit_Id}}</td>
                          <td>{{$cred->Source}}</td>
                          <td>{{$cred->Description}}</td>
                          <td>Ksh {{$cred->Amount}}</td>
                          <td>{{$cred->created_at}}</td>
                          <td>
                            {{-- <a href="{{ url('credit/credit/'.$cred->id.'/edit')}}" class="btn btn-warning"><i class="mdi mdi-border-color"></i> Edit</a> --}}
                            {{-- <a href="{{ url('credancials/expenditures/'.$cred->id.'/delete')}}" class="btn btn-danger">Delete <i class="mdi mdi-shredder"></i></a> --}}
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    {{-- <div class="pagination-container">
                      {{ $financials->links() }}
                    </div> --}}
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
