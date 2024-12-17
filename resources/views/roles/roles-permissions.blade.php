@extends('layouts.app')
<style>
  select {
    width: auto;
    padding: 8px;
    font-size: 16px;
    color: black;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
</style>
@section('content')
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">

            
              <div class="card">
                <div class="card-body">
                  <div class="card-header">
                    @if (session('status'))
                      <div class="alert alert-success">{{session('status')}}</div>
                    @endif
                  <h4 class="card-title">Edit Role permissions</b><br>
                    <a href="{{ url('roles') }}" class="btn btn-danger float-end"><i class="mdi mdi-close"></i></a><br><!-- Button to Trigger Modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#assignPermissionsModal">
                        + Assign New Permissions
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="assignPermissionsModal" tabindex="-1" aria-labelledby="assignPermissionsModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="assignPermissionsModalLabel">+ Assign Permissions</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="assignPermissionsForm" method="POST" action="{{ route('permissions.assign', $role->id) }}">
                                        @csrf
                                        <div class="row">
                                            @foreach ($permissions as $permission)
                                                @if (!$role->permissions->contains('id', $permission->id))
                                                    <div class="col-md-6">
                                                        <div class="form-check ps-4">
                                                            <input type="checkbox" class="form-check-input" id="new_permission_{{ $permission->id }}" name="new_permissions[]" value="{{ $permission->id }}">
                                                            <label class="form-check-label" for="new_permission_{{ $permission->id }}">{{ $permission->Name }}</label>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" form="assignPermissionsForm" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- <a href="" class="btn btn-primary float-center">+ Assign Permission</a> --}}
                  </h4>
                  </div>
                  <form action="{{ url('roles/'.$role->id.'/permissions')}}" method="post">
                    @csrf

                      <div class="mb-3">
                        <label><b>Role ID</b></label><br><br>
                        <input type="text" name="roles_id" class="form-control" value="{{ $role->Name }}" readonly />
                        @error('roles_id') <span class="text-danger">{{ $message}}</span> @enderror
                      </div>

                      <div class="row">
                        <div class="row">
                          @foreach ($permissions as $index => $permission)
                              @if ($role->permissions->contains('id', $permission->id))
                                  <div class="col-md-4">
                                      <div class="form-check ps-4">
                                          <input type="checkbox" class="form-check-input" id="permission_{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}" checked {{-- disabled --}}>
                                          <label class="form-check-label" for="permission_{{ $permission->id }}">{{ $permission->Name }}</label>
                                      </div>
                                  </div>
                              @endif
                          @endforeach
                      </div>
                      
                    </div>
                    
                      {{-- @foreach ($permissions as $permission)
                          <div class="form-check ps-4">
                              <input type="checkbox" class="form-check-input" id="permission_{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}" @if ($role->permissions->contains('id', $permission->id)) checked @endif>
                              <label class="form-check-label" for="permission_{{ $permission->id }}">{{ $permission->Name }}</label>
                          </div>
                      @endforeach --}}

                    <div class="mb-3">
                      <button type="submit"  class="btn btn-success text-center">Save</button>
                    </div>

                  </form>
                  <form action="{{ route('roles-permissions.delete', ['role' => $role->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete All Permissions</button>
                  </form>
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