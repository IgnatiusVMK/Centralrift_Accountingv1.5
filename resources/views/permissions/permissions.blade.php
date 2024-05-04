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
                      <h4 class="card-title">Users-Roles & Permissions 
                      <a href="{{-- {{ url('users/create') }} --}}" class="btn btn-primary float-end">+ New Permission</a>
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
                            Permission
                          </th>
                          {{-- <th>
                            Date Added
                          </th> --}}
                          {{-- <th>
                            Actions
                          </th> --}}
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($permissions as $permission)
                        
                        
                        <tr>
                          <td>{{$permission->id}}</td>
                          <td>{{$permission->Name}}</td>
                          {{-- <td>{{$permission->created_at}}</td> --}}
                          <td>
                            {{-- <a href="{{ url('permissions/'.$permission->id.'/edit')}}" class="btn btn-warning"><i class="mdi mdi-border-color"></i> Edit</a> --}}
                            {{-- <a href="{{ url('permissions/'.$role->id.'/delete')}}" class="btn btn-danger">Delete <i class="mdi mdi-shredder"></i></a> --}}
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