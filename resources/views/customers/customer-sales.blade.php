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
                    <h4 class="card-title">
                        @foreach ($customers->where('Customer_Fname', $Customer_Fname) as $cust )
                            {{$cust->Customer_Fname .' ' . $cust->Customer_Lname }}
                        @endforeach
                        <a href="{{ url('/customers') }}" class="btn btn-danger float-end"><i class="mdi mdi-close"></i></a>
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
                            Sales ID
                          </th>
                          <th>
                            Cycle
                          </th>
                          <th>
                            Quantity
                          </th>
                          <th>
                            Sale Amount (Ksh)
                          </th>
                          <th>
                            Payment Status
                          </th>
                          <th>
                            Sale Date
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($customers->where('Customer_Fname', $Customer_Fname) as $cust )
                            @foreach ($cust->sales as $sale)
                                <tr>
                                    <td>
                                        {{$sale->id}}
                                    </td>
                                    <td>{{$sale->Sales_Id}}</td>
                                    <td>{{$sale->Cycle_Id}}</td>
                                    <td>{{$sale->Quantity}} KG</td>
                                    <td>Ksh. {{$sale->Total_Price}}</td>
                                    <td>{{$sale->Payment_Status}}</td>
                                    <td>{{$sale->Sale_Date}}</td>
                                </tr>
                            @endforeach
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