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
                          {{-- <th>
                            First Name
                          </th> --}}
                          <th>
                            Contact
                          </th>
                          <th>
                            Email
                          </th>
                          <th>
                            Address
                          </th>
                          @can('modify-master')
                          <th>
                            Update
                          </th>
                          @endcan
                          @can('delete-master')
                          <th>
                            Delete
                          </th>
                          @endcan
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($customers as $cust )
                        <tr>
                          <td>{{$cust->Customer_Id}}</td>
                          {{-- <td class="py-1">
                            <img src="{{ asset('/images/marley.png')}}" alt="image"/>
                          </td> --}}
                          <td>
                            <a href="{{ url('customers/'.$cust->Customer_Fname)}}">
                              {{$cust->Customer_Fname .' ' . $cust->Customer_Lname }}
                            </a>
                          </td>
                          @foreach($customercontacts->where('id', $cust->Customer_Id) as $contact)
                            <td>{{ $contact->Contact }}</td>
                            <td>{{ $contact->Email }}</td>
                            <td>{{ $contact->Address }}</td>
                          @endforeach
                          @can('modify-master')
                          <td>
                              <a href="{{ url('customers/'.$cust->Customer_Id.'/edit')}}" class="btn btn-warning"><i class="mdi mdi-border-color"></i> Edit</a>
                          </td>
                          @endcan
                          @can('delete-master')
                          <td>
                            <a href="{{ url('customers/'.$cust->Customer_Id.'/delete')}}" class="btn btn-danger">Delete <i class="mdi mdi-shredder"></i></a>
                          </td>
                          @endcan
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