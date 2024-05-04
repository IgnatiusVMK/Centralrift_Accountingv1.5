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
                  <h4 class="card-title">Daily Expenditures
                  </h4>
                  </div>
                  @can('view-sales')
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
                            Customer
                          </th>
                          <th>
                            Sales Date
                          </th>
                          <th>
                            Quantity
                          </th>
                          <th>
                            Total Price
                          </th>
                          <th>
                            Payment Type
                          </th>
                          <th>
                            Payment Status
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($sales as $sale)
                        <tr>
                          <td>{{$sale->id}}</td>
                          <td>{{$sale->Sales_Id}}</td>
                          <td>{{$sale->Cycle_Id}}</td>
                          <td>{{$sale->customer->Customer_Fname}}</td>
                          <td>{{$sale->Sale_Date}}</td>
                          <td>{{$sale->Quantity}} Kg</td>
                          <td>Ksh {{$sale->Total_Price}}</td>
                          <td>{{$sale->Payment_Method}}</td>
                          <td class="@if($sale->Payment_Status == 'Un-paid') text-danger @elseif($sale->Payment_Status == 'Paid') text-success @else text-warning @endif">
                            {{$sale->Payment_Status}}
                          </td> 
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                      <div class="pagination-container float-end">
                         {{ $sales->links() }}
                      </div>
                  </div>
                  @endcan
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
