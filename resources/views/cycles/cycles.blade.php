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
                          <th>
                            Cycle ID
                          </th>
                          <th>
                            Cycle Name
                          </th>
                          <th>
                            Customer
                          </th>
                          <th>
                            Product
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
                          @can('view-cycles')
                          <th>
                            Actions
                          </th>
                          @endcan
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($cycles as $cyc)
                        <tr>
                          <td>
                            {{$cyc->Cycle_Id}}
                           </td>
                          <td>
                            @can('view-cycles')
                              <a href="{{ url('cycles/'.$cyc->Cycle_Id)}}" class="">
                                <i class="mdi mdi-border-color"></i> 
                            @endcan
                            {{$cyc->Cycle_Name}}</a>
                          </td>
                           <td>
                            {{$cyc->Client_Name}}
                           </td>
                          <td>{{$cyc->Product}}</td>
                          <td>{{$cyc->block->Block_Name}}</td>
                          <td>
                            <div>{{$cyc->Cycle_Start}}</div>
                          </td>
                          <td>
                            <div>{{$cyc->Cycle_End}}</div>
                          </td>
                          <td>
                            @can('view-cycles')
                              <a href="{{-- {{ url('cycles/'.$cyc->Cycle_Id)}} --}}" class="btn btn-warning"><i class="mdi mdi-border-color"></i>Update</a>
                            @endcan
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