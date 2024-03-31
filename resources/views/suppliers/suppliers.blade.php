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
                      <h4 class="card-title">Product Suppliers
                      <a href="{{ url('suppliers/create') }}" class="btn btn-primary float-end">+ Register New Supplier</a>
                      </h4>
                    </div>
                  
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Supplier ID
                          </th>
                          <th>
                            Supplier Name
                          </th>
                          <th>
                            Supplier Contact Name
                          </th>
                          <th>
                            Phone
                          </th>
                          <th>
                            Contact Email
                          </th>
                          <th>
                            Address
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
                        @foreach ($suppliers as $supplier)
                        
                        
                        <tr>
                          <td>{{$supplier->Supplier_Id}}</td>
                          <td>{{$supplier->Supplier_Name}}</td>
                          @foreach($suppliercontacts->where('Supplier_Id', $supplier->Supplier_Id) as $contact)
                            <td>{{ $contact->Contact_Name }}</td>
                            <td>{{ $contact->Phone }}</td>
                            <td>{{ $contact->Email }}</td>
                            <td>{{ $contact->Address }}</td>
                            <td>{{ $contact->Created_Date }}</td>
                          @endforeach
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