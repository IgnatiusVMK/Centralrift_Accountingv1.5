@extends('layouts.app')

@section('content')
@include('layouts.export')
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
                  <h4 class="card-title">Existing Customers
                    <a href="{{ url('customers/create') }}" class="btn btn-primary float-end">+ Add Customer</a>
                  </h4>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Sn No.
                          </th>
                          <th>
                            Customer
                          </th>
                          <th>
                            First Name
                          </th>
                          <th>
                            Contact
                          </th>
                          <th>
                            Email
                          </th>
                          <th>
                            Address
                          </th>
                          <th>
                            Is Active
                          </th>
                          <th>
                            Actions
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($customers as $cust )
                        <tr>
                          <td>{{$cust->Customer_Id}}</td>
                          <td class="py-1">
                            <img src="{{ asset('/images/marley.png')}}" alt="image"/>
                          </td>
                          <td>{{$cust->Customer_Fname}}</td>
                          <td>{{$cust->Contact}}</td>
                          <td>{{$cust->Email}}</td>
                          <td>{{$cust->Address}}</td>
                          <td>
                            @if ($cust->is_active)
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
                            <a href="{{ url('customers/'.$cust->Customer_Id.'/edit')}}" class="btn btn-warning"><i class="mdi mdi-border-color"></i> Edit</a>
                            <a href="{{ url('customers/'.$cust->Customer_Id.'/delete')}}" class="btn btn-danger">Delete <i class="mdi mdi-shredder"></i></a>
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