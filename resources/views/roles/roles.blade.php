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
                      <h4 class="card-title">Users & Roles
                      <a href="{{ url('users/create') }}" class="btn btn-primary float-end">+ New Role</a>
                      </h4>
                    </div>
                  
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Role ID
                          </th>
                          <th>
                            Role
                          </th>
                          <th>
                            Date Added
                          </th>
                          <th>
                            Actions
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($roles as $role)
                        
                        
                        <tr>
                          <td>{{$role->id}}</td>
                          <td>
                            <a href="{{ url('roles/'.$role->id.'/permissions')}}"><i class="mdi mdi-border-color"></i>
                              {{$role->Name}}
                            </a>
                          </td>
                          <td>{{$role->created_at}}</td>
                          <td>
                            <a href="{{-- {{ url('roles/'.$role->id.'/edit')}} --}}" class="btn btn-warning"><i class="mdi mdi-border-color"></i> Edit</a>
                            {{-- <a href="{{ url('roles/'.$role->id.'/delete')}}" class="btn btn-danger">Delete <i class="mdi mdi-shredder"></i></a> --}}
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