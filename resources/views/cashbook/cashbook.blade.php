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
                  <h4 class="card-title text-center">CashBook
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
                            Reason
                          </th>
                          <th>
                            Description
                          </th>
                          <th>
                            Amount
                          </th>
                          <th>
                            Balance Estimate
                          </th>
                          <th>
                            Recorded On
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($cashbook as $cbk )
                        <tr>
                          <td>{{$cbk->id}}</td>
                          <td>{{$cbk->Transaction_Id}}</td>
                          <td>{{$cbk->Description}}</td>
                          <td>Ksh {{$cbk->Crd_Amnt}}</td>
                          <td>Ksh {{$cbk->Dbt_Amt}}</td>
                          <td>Ksh {{$cbk->Bal}}</td>
                          <td>{{$cbk->created_at}}</td>
                          {{-- <td> --}}
                            {{-- <a href="{{ url('financials/salaries/'.$cbk->id.'/edit')}}" class="btn btn-warning"><i class="mdi mdi-border-color"></i> Edit</a> --}}
                            {{-- <a href="{{ url('financials/salaries/'.$cbk->id.'/delete')}}" class="btn btn-danger">Delete <i class="mdi mdi-shredder"></i></a> --}}
                          {{-- </td> --}}
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="pagination-container float-end">
                      {{ $cashbook->links() }}
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
