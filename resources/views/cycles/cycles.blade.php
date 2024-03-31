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
                      <a href="{{ url('cycles/create') }}" class="btn btn-primary float-end">+ New Cycle</a>
                      </h4>
                    </div>
                  
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            SN No.
                          </th>
                          <th>
                            Cycle ID
                          </th>
                          <th>
                            Cycle Name
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
                          <td>{{$cyc->id}}</td>
                          <td class="py-1">
                            <img src="{{ asset('/images/marley.png')}}" alt="image"/>
                          </td>
                          <td>{{$cyc->name}}</td>
                          <td>
                            <div>{{$cyc->email}}</div><br>
                            <div>712345678</div>
                          </td>
                          <td>
                            {{-- @foreach ($cyc->departments as $index => $dep)
                                {{ $dep->department_name }}
                                @if ($index < count($cyc->departments) - 1)
                                    , <!-- Add a comma if there are more departments -->
                                @endif
                            @endforeach --}}
                        </td>
                          <td>{{$cyc->role}}</td>
                          <td>{{$cyc->created_at}}</td>
                          <td>
                            @if ($cyc->is_active)
                              <button class="btn btn-success">
                                Active
                              </button>    
                            @else
                              <button class="btn btn-danger">
                                In-active
                              </button>
                            @endif
                          </td>
                          <td>
                            <a href="{{ url('cycles/'.$cyc->Cycle_Id.'/edit')}}" class="btn btn-warning"><i class="mdi mdi-border-color"></i> Edit</a>
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