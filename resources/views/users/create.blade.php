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
                  <h4 class="card-title">Create New User
                    <a href="{{ url('role') }}" class="btn btn-danger float-end">{{-- Back --}} <i class="mdi mdi-close"></i></a>
                  </h4>
                  </div>
                  <form action="{{ url('role/create')}}" method="post">
                    @csrf

                    <div class="mb-3">
                      <label>Name</label>
                      <input type="text" name="name" class="form-control" value="{{ old ('name') }}" />
                      @error('name') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Email</label>
                      <input type="email" name="email" class="form-control" value="{{ old ('email') }}" />
                      @error('email') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Department</label>
                      <select name="department_id" class="form-control">
                        <option value="7" selected> -- SELECT DEPARTMENT --</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                        @endforeach
                    </select>
                      @error('department_name') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Role</label>
                      <input type="text" name="role" class="form-control" value="{{ old ('role') }}" />
                      @error('role') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Default Password</label>
                      <input type="password" name="password" class="form-control" value="{{ old ('password') }}" />
                      @error('password') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Is Active</label>
                      <input type="checkbox" name="is_active" {{ old ('is_active') == true ? 'checked': '' }} />
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