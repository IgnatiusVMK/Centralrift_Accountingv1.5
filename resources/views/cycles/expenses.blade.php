@extends('layouts.app')

@section('content')

<div class="col-sm-12">
  <div class="home-tab">
    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active ps-0" id="Expenditures-tab" data-bs-toggle="tab" href="#Expenditures" role="tab" aria-controls="Expenditures" aria-selected="true" onclick="openForm(event, 'Expenditures')">Wages</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="Salaries-tab" data-bs-toggle="tab" href="#Salaries" role="tab" aria-selected="false" onclick="openForm(event, 'Salaries')">Salaries</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="Advances-tab" data-bs-toggle="tab" href="#Advances" role="tab" aria-selected="false" onclick="openForm(event, 'Advances')">Advances</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="Transport-tab" data-bs-toggle="tab" href="#Transport" role="tab" aria-selected="false" onclick="openForm(event, 'Transport')">Transport</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="Chemicals-tab" data-bs-toggle="tab" href="#Chemicals" role="tab" aria-selected="false" onclick="openForm(event, 'Chemicals')">Chemicals</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="Seeds-tab" data-bs-toggle="tab" href="#Seeds" role="tab" aria-selected="false" onclick="openForm(event, 'Seeds')">Seeds</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="CapitalExpenses-tab" data-bs-toggle="tab" href="#CapitalExpenses" role="tab" aria-selected="false" onclick="openForm(event, 'CapitalExpenses')">CapitalExpenses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="Maintenance-tab" data-bs-toggle="tab" href="#Maintenance" role="tab" aria-selected="false" onclick="openForm(event, 'Maintenance')">Maintenance</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="Sales-tab" data-bs-toggle="tab" href="#Sales" role="tab" aria-selected="false" onclick="openForm(event, 'Sales')">Sales</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="CapitalWithdrawals-tab" data-bs-toggle="tab" href="#CapitalWithdrawals" role="tab" aria-selected="false" onclick="openForm(event, 'CapitalWithdrawals')">Capital Withdrawal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="Electricity-tab" data-bs-toggle="tab" href="#Electricity" role="tab" aria-selected="false" onclick="openForm(event, 'Electricity')">Electricity</a>
            </li>
            <li class="nav-item">
                <a class="nav-link border-0" id="Others-tab" data-bs-toggle="tab" href="#Others" role="tab" aria-selected="false" onclick="openForm(event, 'Others')">Others</a>
            </li>
        </ul>
      <div>
        <div class="btn-wrapper">
          <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i> Share</a>
          <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
          <a href="#" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div>
              <a href="{{ url('cycles') }}" class="btn btn-danger float-end"><i class="mdi mdi-close"></i></a>
            </div>
              <div class="tab-content">
                <div class="tab-pane fade show active" id="Expenditures" role="tabpanel" aria-labelledby="Expenditures-tab">
                  <!-- Expenditures form content here -->
                    <div class="card-body">
                      @if (session('status'))
                        <div class="alert alert-danger text-center">{{session('status')}}</div>
                      @endif
                      <div class="card-header">
                        <h4 class="card-title">Daily Expenditures
                          <a href="{{ url('cycles/'.$Cycle_Id.'/expenditures/create') }}" class="btn btn-primary float-end">+ Record New Expenditure</a>
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
                                Cycle
                              </th>
                              <th>
                                ID
                              </th>
                              <th>
                                Reason
                              </th>
                              <th>
                                Description
                              </th>
                              <th>
                                Amount
                              </th>
                              <th>
                                Date Created
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($wages->where('Cycle_Id', $Cycle_Id) as $wage)
                            <tr>
                              <td>{{$wage->id}}</td>
                              <td>{{$wage->Cycle_Id}}</td>
                              <td>{{$wage->Fin_Id_Id}}</td>
                              <td>{{$wage->Reason}}</td>
                              <td>{{$wage->Description}}</td>
                              <td>Ksh {{$wage->Amount}}</td>
                              <td>{{$wage->created_at}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                          <div class="pagination-container float-end">
                             {{ $wages->links() }}
                          </div>
                      </div> 
                    </div>
                </div>
                    
                <div class="tab-pane fade" id="Advances" role="tabpanel" aria-labelledby="Advances-tab">
                  <!-- Advances form content here -->
                  <div class="card-body">
                    @if (session('status'))
                      <div class="alert alert-danger text-center">{{session('status')}}</div>
                    @endif
                    <div class="card-header">
                      <h4 class="card-title">Salary Advances
                        <a href="{{ url('cycles/'.$Cycle_Id.'/advance/create') }}" class="btn btn-primary float-end">+ Record Salary Advances</a>
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
                              Cycle
                            </th>
                            <th>
                              ID
                            </th>
                            <th>
                              Payee Name
                            </th>
                            <th>
                              Month
                            </th>
                            <th>
                              Amount
                            </th>
                            <th>
                              Payment Date
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($advance->where('Cycle_Id', $Cycle_Id) as $adv)
                          <tr>
                            <td>{{$adv->id}}</td>
                            <td>{{$adv->Cycle_Id}}</td>
                            <td>{{$adv->Fin_Id_Id}}</td>
                            <td>{{$adv->Reason}}</td>
                            <td>{{$adv->Description}}</td>
                            <td>Ksh {{$adv->Amount}}</td>
                            <td>{{$adv->created_at}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                        <div class="pagination-container float-end">
                           {{ $advance->links() }}
                        </div>
                    </div> 
                  </div>
                </div>

                <div class="tab-pane fade" id="Salaries" role="tabpanel" aria-labelledby="Salaries-tab">
                  <!-- Salaries form content here -->
                  <div class="card-body">
                    @if (session('status'))
                      <div class="alert alert-danger text-center">{{session('status')}}</div>
                    @endif
                    <div class="card-header">
                      <h4 class="card-title">Monthly Salaries
                        <a href="{{ url('cycles/'.$Cycle_Id.'/salaries/create') }}" class="btn btn-primary float-end">+ Record Salaries</a>
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
                              Cycle
                            </th>
                            <th>
                              ID
                            </th>
                            <th>
                              Payee Name
                            </th>
                            <th>
                              Month
                            </th>
                            <th>
                              Amount
                            </th>
                            <th>
                              Payment Date
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($salaries->where('Cycle_Id', $Cycle_Id) as $sal)
                          <tr>
                            <td>{{$sal->id}}</td>
                            <td>{{$sal->Cycle_Id}}</td>
                            <td>{{$sal->Fin_Id_Id}}</td>
                            <td>{{$sal->Reason}}</td>
                            <td>{{$sal->Description}}</td>
                            <td>Ksh {{$sal->Amount}}</td>
                            <td>{{$sal->created_at}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      <tfoot>
                        <tr>
                          <td>
                            <div class="pagination-container float-end">
                              {{ $salaries->links() }}
                           </div>
                          </td>
                        </tr>
                      </tfoot>
                    </div> 
                  </div>
                </div>

                <div class="tab-pane fade" id="CapitalWithdrawals" role="tabpanel" aria-labelledby="CapitalWithdrawals-tab">
                  <!-- Capital Withdrawal form content here -->
                  <div class="card-body">
                    @if (session('status'))
                      <div class="alert alert-danger text-center">{{session('status')}}</div>
                    @endif
                    <div class="card-header">
                      <h4 class="card-title">Withdrawals
                        <a href="{{ url('cycles/'.$Cycle_Id.'/capital-withdrawal/create') }}" class="btn btn-primary float-end">+ New Withdrawal</a>
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
                              Withdrawal ID
                            </th>
                            <th>
                              Description
                            </th>
                            <th>
                              Amount
                            </th>
                            <th>
                              Date Created
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($withdrawal as $withd)
                          <tr>
                            <td>{{$withd->id}}</td>
                            <td>{{$withd->Capt_Withdraw_Id}}</td>
                            <td>{{$withd->Description}}</td>
                            <td>Ksh {{$withd->Amount}}</td>
                            <td>{{$withd->created_at}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                        <div class="pagination-container float-end">
                          {{ $withdrawal->links() }}
                        </div>
                    </div> 
                  </div>
                </div>

                <div class="tab-pane fade" id="Electricity" role="tabpanel" aria-labelledby="Electricity-tab">
                  <!-- Electricty form content here -->
                  <div class="card-body">
                    @if (session('status'))
                      <div class="alert alert-danger text-center">{{session('status')}}</div>
                    @endif
                    <div class="card-header">
                      <h4 class="card-title">Electricty
                        <a href="{{ url('cycles/'.$Cycle_Id.'/electricity/create') }}" class="btn btn-primary float-end">+ New Electricity Payments</a>
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
                              Payment ID
                            </th>
                            <th>
                              Reason
                            </th>
                            <th>
                              Description
                            </th>
                            <th>
                              Amount
                            </th>
                            <th>
                              Date Created
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($electricity as $elec)
                          <tr>
                            <td>{{$elec->Financial_Id}}</td>
                            <td>{{$elec->Fin_Id_Id}}</td>
                            <td>{{$elec->Reason}}</td>
                            <td>{{$elec->Description}}</td>
                            <td>Ksh {{$elec->Amount}}</td>
                            <td>{{$elec->created_at}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                        <div class="pagination-container float-end">
                          {{ $electricity->links() }}
                        </div>
                    </div> 
                  </div>
                </div>

                <div class="tab-pane fade" id="Maintenance" role="tabpanel" aria-labelledby="Maintenance-tab">
                  <!-- Maintenance form content here -->
                  <div class="card-body">
                    @if (session('status'))
                      <div class="alert alert-danger text-center">{{session('status')}}</div>
                    @endif
                    <div class="card-header">
                      <h4 class="card-title">Maintenance
                        <a href="{{ url('cycles/'.$Cycle_Id.'/maintenance/create') }}" class="btn btn-primary float-end">+ Record Maintenance</a>
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
                              Cycle
                            </th>
                            <th>
                              ID
                            </th>
                            <th>
                              Reason
                            </th>
                            <th>
                              Description
                            </th>
                            <th>
                              Amount
                            </th>
                            <th>
                              Date Created
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($maintenance->where('Cycle_Id', $Cycle_Id) as $maint)
                          <tr>
                            <td>{{$maint->Financial_Id}}</td>
                            <td>{{$maint->Cycle_Id}}</td>
                            <td>{{$maint->Fin_Id_Id}}</td>
                            <td>{{$maint->Reason}}</td>
                            <td>{{$maint->Description}}</td>
                            <td>Ksh {{$maint->Amount}}</td>
                            <td>{{$maint->created_at}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                        <div class="pagination-container float-end">
                           {{ $maintenance->links() }}
                        </div>
                    </div> 
                  </div>
                </div>

                <div class="tab-pane fade" id="Sales" role="tabpanel" aria-labelledby="Sales-tab">
                  <!-- Sales form content here -->
                  <div class="card-body">
                    @if (session('status'))
                      <div class="alert alert-danger text-center">{{session('status')}}</div>
                    @endif
                    <div class="card-header">
                      <h4 class="card-title">Product Sales
                        <a href="{{ url('cycles/'.$Cycle_Id.'/sales/create') }}" class="btn btn-primary float-end">+ Record Sales</a>
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
                              Cycle
                            </th>
                            <th>
                              Customer
                            </th>
                            <th>
                              LPO NUmber
                            </th>
                            <th>
                              Sales Date
                            </th>
                            <th>
                              Net Weight
                            </th>
                            <th>
                              Total Price
                            </th>
                           {{--  <th>
                              Payment Type
                            </th> --}}
                            <th>
                              Payment Status
                            </th>
                            <th>
                              Generate Invoice
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($sales->where('Cycle_Id', $Cycle_Id) as $sale)
                          <tr>
                            <td>{{$sale->id}}</td>
                            <td>{{$sale->Cycle_Id}}</td>
                            <td>{{$sale->customer->Customer_Name}}</td>
                            <td>
                              {{$sale->Lpo_No}}
                            </td>
                            <td>{{$sale->Sale_Date}}</td>
                            <td>{{$sale->Net_Weight}} Kg</td>
                            <td>Ksh {{$sale->Total_Price}}</td>
                            {{-- <td>{{$sale->Payment_Method}}</td> --}}
                            <td class="@if($sale->Payment_Status == 'Un-paid') text-danger @elseif($sale->Payment_Status == 'Paid') text-success @else text-warning @endif">
                              {{$sale->Payment_Status}}
                            </td>
                            <td>
                              <a href="{{ ('/sales'.'/'.$sale->Sales_Id.'/generate-invoice') }}" {{-- class="btn btn-otline-dark" --}}>
                                <button type="submit" class="btn btn-primary text-white me-0">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-pdf-fill" viewBox="0 0 16 16">
                                    <path d="M5.523 12.424q.21-.124.459-.238a8 8 0 0 1-.45.606c-.28.337-.498.516-.635.572l-.035.012a.3.3 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548m2.455-1.647q-.178.037-.356.078a21 21 0 0 0 .5-1.05 12 12 0 0 0 .51.858q-.326.048-.654.114m2.525.939a4 4 0 0 1-.435-.41q.344.007.612.054c.317.057.466.147.518.209a.1.1 0 0 1 .026.064.44.44 0 0 1-.06.2.3.3 0 0 1-.094.124.1.1 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256M8.278 6.97c-.04.244-.108.524-.2.829a5 5 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.5.5 0 0 1 .145-.04c.013.03.028.092.032.198q.008.183-.038.465z"/>
                                    <path fill-rule="evenodd" d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m5.5 1.5v2a1 1 0 0 0 1 1h2zM4.165 13.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.7 11.7 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.86.86 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.84.84 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.8 5.8 0 0 0-1.335-.05 11 11 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.24 1.24 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a20 20 0 0 1-1.062 2.227 7.7 7.7 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103"/>
                                  </svg>
                                  Invoice
                                </button>
                              </a>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                        <div class="pagination-container float-end">
                           {{ $sales->links() }}
                        </div>
                    </div> 
                  </div>
                </div>
                    
                <div class="tab-pane fade" id="Transport" role="tabpanel" aria-labelledby="Transport-tab">
                  <!-- Transport form content here -->
                  <div class="card-body">
                    @if (session('status'))
                      <div class="alert alert-danger text-center">{{session('status')}}</div>
                    @endif
                    <div class="card-header">
                      <h4 class="card-title">Transport
                        <a href="{{ url('cycles/'.$Cycle_Id.'/transport/create') }}" class="btn btn-primary float-end">+ Record Transport</a>
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
                              Cycle
                            </th>
                            <th>
                              ID
                            </th>
                            <th>
                              Reason
                            </th>
                            <th>
                              Description
                            </th>
                            <th>
                              Amount
                            </th>
                            <th>
                              Date Created
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($transport->where('Cycle_Id', $Cycle_Id) as $tran)
                          <tr>
                            <td>{{$tran->id}}</td>
                            <td>{{$tran->Cycle_Id}}</td>
                            <td>{{$tran->Fin_Id_Id}}</td>
                            <td>{{$tran->Reason}}</td>
                            <td>{{$tran->Description}}</td>
                            <td>Ksh {{$tran->Amount}}</td>
                            <td>{{$tran->created_at}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                        <div class="pagination-container float-end">
                           {{ $transport->links() }}
                        </div>
                    </div> 
                  </div>
                </div>

                <div class="tab-pane fade" id="Chemicals" role="tabpanel" aria-labelledby="Chemicals-tab">
                  <!-- Chemicals form content here -->
                  <p>Chemicals</p>
                </div>

                <div class="tab-pane fade" id="Seeds" role="tabpanel" aria-labelledby="Seeds-tab">
                    <!-- Seeds form content here -->
                    <p>Seeds</p>
                </div>

                <div class="tab-pane fade" id="CapitalExpenses" role="tabpanel" aria-labelledby="CapitalExpenses-tab">
                  <div class="card-body">
                    @if (session('status'))
                      <div class="alert alert-danger text-center">{{session('status')}}</div>
                    @endif
                    <div class="card-header">
                      <h4 class="card-title">Capital Expenses
                        <a href="{{ url('cycles/'.$Cycle_Id.'/capital-expenses/create') }}" class="btn btn-primary float-end">+ Record New Expenses</a>
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
                              Cycle
                            </th>
                            <th>
                              Payment ID
                            </th>
                            <th>
                              Reason
                            </th>
                            <th>
                              Description
                            </th>
                            <th>
                              Amount
                            </th>
                            <th>
                              Date Created
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($cpexpenses->where('Cycle_Id', $Cycle_Id) as $cpexpe)
                          <tr>
                            <td>{{$cpexpe->Financial_Id}}</td>
                            <td>{{$cpexpe->Cycle_Id}}</td>
                            <td>{{$cpexpe->Fin_Id_Id}}</td>
                            <td>{{$cpexpe->Reason}}</td>
                            <td>{{$cpexpe->Description}}</td>
                            <td>Ksh {{$cpexpe->Amount}}</td>
                            <td>{{$cpexpe->created_at}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                        <div class="pagination-container float-end">
                           {{ $cpexpenses->links() }}
                        </div>
                    </div> 
                  </div>
                </div>

                <div class="tab-pane fade" id="Others" role="tabpanel" aria-labelledby="Others-tab">
                    <!-- Others form content here -->
                    <p>Others</p>
                </div>

              </div>
            </div>
        </div>
        <script src="{{ asset('js/central-tabs.js') }}"></script>
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
@endsection
