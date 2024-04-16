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
                      <h4 class="card-title">Cycles
                      {{-- <a href="{{ url('cycles/new') }}" class="btn btn-primary float-end">+ New Cycle</a> --}}
                      </h4>
                    </div>
                  
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          {{-- <th>
                            SN No.
                          </th> --}}
                          <th>
                            Cycle ID
                          </th>
                          <th>
                            Customer
                          </th>
                          <th>
                            Cycle Name
                          </th>
                          <th>
                            Crop
                          </th>
                          <th>
                            Block
                          </th>
                          <th>
                            Start of Cycle
                          </th>
                          <th>
                            End of Cycle
                          </th>
                          <th>
                            Actions
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($cycles as $cyc)
                        <tr>
                           <td>
                            <a href="{{ url('cycles/'.$cyc->Cycle_Id)}}" class=""><i class="mdi mdi-border-color"></i> {{$cyc->Cycle_Id}}</a>
                           </td>
                          <td>{{$cyc->Client_Name}}</td>
                          <td>{{$cyc->Cycle_Name}}</td>
                          <td>{{$cyc->Crop}}</td>
                          <td>{{$cyc->block->Block_Name}}</td>
                          <td>
                            <div>{{$cyc->Cycle_Start}}</div>
                          </td>
                          <td>
                            <div>{{$cyc->Cycle_End}}</div>
                          </td>
                          <td>
                            <a href="{{ url('cycles/'.$cyc->Cycle_Id)}}" class="btn btn-warning"><i class="mdi mdi-border-color"></i>Update</a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
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