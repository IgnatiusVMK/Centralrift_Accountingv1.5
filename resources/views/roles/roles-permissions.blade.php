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
                  <h4 class="card-title">Edit Role permissions</b>
                    <a href="{{ url('roles') }}" class="btn btn-danger float-end"><i class="mdi mdi-close"></i></a>
                  </h4>
                  </div>
                  <form action="{{ url('roles/'.$role->id.'/permissions')}}" method="post">
                    @csrf

                      <div class="mb-3">
                        <label>Role ID</label>
                        <input type="text" name="roles_id" class="form-control" value="{{ $role->id }}" readonly />
                        @error('roles_id') <span class="text-danger">{{ $message}}</span> @enderror
                      </div>

                      @foreach ($permissions as $permission)
                          <div class="form-check ps-4">
                              <input type="checkbox" class="form-check-input" id="permission_{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}" @if ($role->permissions->contains('id', $permission->id)) checked @endif>
                              <label class="form-check-label" for="permission_{{ $permission->id }}">{{ $permission->Name }}</label>
                          </div>
                      @endforeach

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