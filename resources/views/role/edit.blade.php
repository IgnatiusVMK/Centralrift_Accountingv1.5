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
                  <h4 class="card-title">Edit User
                    <a href="{{ url('role') }}" class="btn btn-danger float-end">{{-- Back --}} <i class="mdi mdi-close"></i></a>
                  </h4>
                  </div>
                  <form action="{{ url('role/'.$role->id.'/edit')}}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                      <label>Name</label>
                      <input type="text" name="name" class="form-control" value="{{ $role->name }}" />
                      @error('name') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Email</label>
                      <input type="email" name="email" class="form-control" value="{{ $role->email }}" />
                      @error('email') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Departments:</label><br>
                        <div class="form-group">
                            @foreach ($departments as $department)
                                <div class="form-check ps-4"> <!-- Add ps-3 class for left padding -->
                                    <input type="checkbox" class="form-check-input" id="department_{{ $department->id }}" name="departments[]" value="{{ $department->id }}" @if ($role->departments->contains($department->id)) checked @endif>
                                    <label class="form-check-label" for="department_{{ $department->id }}">{{ $department->department_name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                
                    <div class="mb-3">
                      <label>Role</label>
                      <input type="text" name="role" class="form-control" value="{{ $role->role }}" />
                      @error('role') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Default Password</label>
                      <input type="password" name="password" class="form-control" value="{{ old ('password') }}" />
                      @error('password') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Is Active</label>
                      <input type="checkbox" name="is_active" {{ $role->is_active  == true ? 'checked': '' }} />
                      @error('is_active') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <button type="submit"  class="btn btn-success text-center">Save</button>
                    </div>

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