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
                              <td>{{$wage->Financial_Id}}</td>
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
                            <td>{{$adv->Financial_Id}}</td>
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
                            <td>{{$sal->Financial_Id}}</td>
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
                  <p>Sales</p>
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
                            <td>{{$tran->Financial_Id}}</td>
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
                    <!-- CapitalExpenses form content here -->
                    <p>CapitalExpenses</p>
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
