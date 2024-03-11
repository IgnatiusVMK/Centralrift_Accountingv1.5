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
                      <a href="{{ url('role/create') }}" class="btn btn-primary float-end">+ New User</a>
                      </h4>
                    </div>
                  
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            User ID
                          </th>
                          <th>
                            User
                          </th>
                          <th>
                            Name
                          </th>
                          <th>
                            Contact
                          </th>
                          <th>
                            Department
                          </th>
                          <th>
                            Role
                          </th>
                          <th>
                            Status
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
                        @foreach ($role as $role)
                        
                        
                        <tr>
                          <td>{{$role->id}}</td>
                          <td class="py-1">
                            <img src="{{ asset('/images/marley.png')}}" alt="image"/>
                          </td>
                          <td>{{$role->name}}</td>
                          <td>
                            <div>{{$role->email}}</div><br>
                            <div>712345678</div>
                          </td>
                          <td>
                            @foreach ($role->departments as $index => $dep)
                                {{ $dep->department_name }}
                                @if ($index < count($role->departments) - 1)
                                    , <!-- Add a comma if there are more departments -->
                                @endif
                            @endforeach
                        </td>
                          {{-- @foreach ($role->departments as $dep)
                          <td>{{$dep->department_name}}</td>
                          @endforeach --}}
                          <td>{{$role->role}}</td>
                          <td>{{$role->created_at}}</td>
                          <td>
                            @if ($role->is_active)
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
                            <a href="{{ url('role/'.$role->id.'/edit')}}" class="btn btn-warning"><i class="mdi mdi-border-color"></i> Edit</a>
                            <a href="{{ url('role/'.$role->id.'/delete')}}" class="btn btn-danger">Delete <i class="mdi mdi-shredder"></i></a>
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