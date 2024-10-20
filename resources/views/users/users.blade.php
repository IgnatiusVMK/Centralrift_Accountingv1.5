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
                        @can('create-users')
                          <a href="{{ url('users/create') }}" class="btn btn-primary float-end">+ New User</a>
                        @endcan
                      </h4>
                    </div>
                  @can('view-users')
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            User ID
                          </th>
                          {{-- <th>
                            User
                          </th> --}}
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
                            {{-- Authentication --}}
                            User-Role
                          </th>
                          <th>
                            Date Added
                          </th>
                          <th>
                            Status
                          </th>
                          @can('modify-users')
                          <th>
                            Update
                          </th>
                          @endcan
                          @can('delete-users')
                          <th>
                            Delete
                          </th>
                          @endcan
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($users as $user)
                        
                        
                        <tr>
                          <td>{{$user->id}}</td>
                          {{-- <td class="py-1">
                            <img src="{{ asset('/images/marley.png')}}" alt="image"/>
                          </td> --}}
                          <td>{{$user->name}}</td>
                          <td>
                            <div>{{$user->email}}</div><br>
                            <div>712345678</div>
                          </td>
                          <td>
                            <div>
                            @foreach ($user->departments as $index => $dep)
                                <b>{{ $dep->department_name }}</b>
                                @if ($index < count($user->departments) - 1)
                                    <!-- Add a comma if there are more departments -->
                                @endif
                            @endforeach
                            </div>
                            <br>
                            <div><b>Auth: </b> {{$user->role }}</div>
                          </td>
                          <td>
                            @can('modify-users')
                              <a href="{{ url('users-roles-permissions/'.$user->id.'/create')}}"><i class="mdi mdi-border-color"></i>
                            @endcan
                              @foreach ($user->roles as $index => $u_role)
                                {{$u_role->Name}}
                              @endforeach
                              {{-- {{$user->roles}} --}}
                            </a>
                          </td>
                          <td>{{$user->created_at}}</td>
                          <td>
                            @if ($user->is_active)
                              <button class="btn btn-success">
                                Active
                              </button>    
                            @else
                              <button class="btn btn-danger">
                                In-active
                              </button>
                            @endif
                          </td>
                          @can('modify-users')
                          <td>
                              <a href="{{ url('users/'.$user->id.'/edit')}}" class="btn btn-warning"><i class="mdi mdi-border-color"></i> Edit</a>
                          </td>
                          @endcan
                          @can('delete-users')
                          <td>
                              <a href="{{ url('users/'.$user->id.'/delete')}}" class="btn btn-danger">Destroy<i class="mdi mdi-shredder"></i></a>
                          </td>
                          @endcan
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  @endcan
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