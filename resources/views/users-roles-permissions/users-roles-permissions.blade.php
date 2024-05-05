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
                  <h4 class="card-title">Edit User-Roles for  <b>{{ $user->name }}</b>:
                    <a href="{{ url('users') }}" class="btn btn-danger float-end"><i class="mdi mdi-close"></i></a>
                  </h4>
                  </div>
                  <form action="{{ url('users-roles-permissions/'.$user->id.'/create')}}" method="post">
                    @csrf
                
                    <div class="mb-3">
                        <input type="hidden" name="user_id" class="form-control" value="{{ $user->id }}" readonly />
                        @error('user_id') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                
                    @foreach ($roles as $role)
                    <div class="form-check ps-4">
                        <input type="checkbox" class="form-check-input" id="role_{{ $role->id }}" name="roles[]" value="{{ $user->id.'-'.$role->id }}" @if ($user->roles->contains('id', $role->id)) checked @endif>
                        <label class="form-check-label" for="role_{{ $role->id }}">{{ $role->Name }}</label>
                    </div>
                    @endforeach
                
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success text-center">Save</button>
                    </div>
                  </form>
                  <form action="{{ route('users-roles-permissions.delete', ['user' => $user->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete All Roles</button>
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