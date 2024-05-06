@extends('layouts.app')

@section('content')
@can('view-approval')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              @if (session('status'))
                  <div class="alert alert-success text-center">{{session('status')}}</div>
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
                        Cycle ID
                      </th>
                      <th>
                        Cycle Name
                      </th>
                      <th>
                        Block
                      </th>
                      <th>
                        Crop
                      </th>
                      <th>
                        Customer
                      </th>
                      <th>
                        Maker
                      </th>
                      @can('create-approval')
                      <th>
                        Edit
                      </th>
                      @endcan
                      <th>
                        Created On
                      </th>
                      @can('create-approval')
                      <th>
                        Validate
                      </th>
                      @endcan
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($pendingCycles as $pending )
                    <tr>
                        <td>{{$pending->Cycle_Id}}</td>
                        <td>{{$pending->Cycle_Name}}</td>
                        <td>{{$pending->block->Block_Name}}</td>
                        <td>{{$pending->Crop}}</td>
                        <td>{{$pending->Client_Name}}</td>
                        <td>
                            {{$pending->maker->name}}
                        </td>
                        @can('create-approval')
                        <td>
                            <a href="{{ url('checker/'.$pending->id.'/validate')}}">Modify<i class="mdi mdi-border-color"></i></a>
                        </td>
                        @endcan
                        <td>{{$pending->created_at}}</td>
                        <td>
                            <form action="{{ url('checker/'.$pending->id.'/validate')}}" method="POST">
                                @csrf
                                  <input type="hidden" name="checker_id" class="form-control" value="{{ Auth::user()->id}}" readonly/>
                                  <input type="hidden" name="Status" class="form-control" value="{{ ('approved')}}" readonly/>
                                <button type="submit" class="btn btn-danger">Approve</button>
                              </form>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                {{-- <div class="pagination-container float-end">
                  {{ $cashbook->links() }}
                </div> --}}
              </div>
            </div>
          </div>
        </div>
       
      </div>
    </div>
    <!-- content-wrapper ends -->
  </div>

@endcan
@endsection