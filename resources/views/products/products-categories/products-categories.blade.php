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
                      <h4 class="card-title">Products Categories
                      <a href="{{ url('products-categories/create') }}" class="btn btn-primary float-end">+ New Category</a>
                      </h4>
                    </div>
                  
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Category ID
                          </th>
                          <th>
                            Category Name
                          </th>
                          <th>
                            Description
                          </th>
                          <th>
                            Created Date
                          </th>
                          {{-- <th>
                            Actions
                          </th> --}}
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($categories as $category)
                        
                        
                        <tr>
                          <td>{{$category->Category_Id}}</td>
                          <td>{{$category->Category_Name}}</td>
                          <td>
                            <div>{{$category->Description}}</div>
                          </td>
                          <td>
                            <div>{{$category->Created_Date}}</div>
                          </td>
                         {{--  <td>
                            <a href="#" class="btn btn-warning"><i class="mdi mdi-border-color"></i> Edit</a>
                            <a href="#" class="btn btn-danger">Delete <i class="mdi mdi-shredder"></i></a>
                          </td> --}}
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