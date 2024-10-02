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
                      <h4 class="card-title">Purchases
                      <a href="{{ url('purchase/create') }}" class="btn btn-primary float-end">+ New Item Purchase</a>
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
                            Item Name
                          </th>
                          <th>
                            Supplier
                          </th>
                          <th>
                            Quantity
                          </th>
                          <th>
                            Unit Cost
                          </th>
                          <th>
                            Total Cost
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($purchases as $purchase)
                        <tr>
                          <td>{{$purchase->id}}</td>
                          <td>{{$purchase->Item_Name}}</td>
                          <td>
                            <div>{{$purchase->supplier->Supplier_Name}}</div>
                          </td>
                          @if ($purchase->Category_Id == 1)
                            <td>{{$purchase->Quantity}} Ltrs.</td>
                          @elseif ($purchase->Category_Id == 2)
                            <td>{{$purchase->Quantity}} gms/Kgs</td>
                          @elseif ($purchase->Category_Id == 3)
                            <td>{{$purchase->Quantity}} Boxes/Kgs</td>
                          @endif
                          <td>Ksh {{$purchase->Unit_Cost}}</td>
                          <td>Ksh {{$purchase->Total_Cost}}</td>
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