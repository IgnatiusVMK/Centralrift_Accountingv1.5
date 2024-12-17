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
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($permissions->chunk(3) as $chunk)
                            <tr>
                                @foreach ($chunk as $permission)
                                    <td>
                                            <p><strong>ID:</strong> {{ $permission->id }}</p>
                                            <p><strong>Name:</strong> {{ $permission->Name }}</p>
                                            <p>
                                                {{-- Optional action buttons --}}
                                                {{-- <a href="{{ url('permissions/'.$permission->id.'/edit') }}" class="btn btn-warning"><i class="mdi mdi-border-color"></i> Edit</a> --}}
                                                {{-- <a href="{{ url('permissions/'.$permission->id.'/delete') }}" class="btn btn-danger">Delete <i class="mdi mdi-shredder"></i></a> --}}
                                            </p>
                                    </td>
                                @endforeach
                                @for ($i = $chunk->count(); $i < 3; $i++)
                                    <td></td> <!-- Empty cells to fill out the row if fewer than 3 items -->
                                @endfor
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