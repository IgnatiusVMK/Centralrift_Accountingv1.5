@extends('layouts.app')

@section('content')
@can('view-approval')
  <div class="col-sm-12">
    <div class="home-tab">
      <div class="d-sm-flex align-items-center justify-content-between border-bottom">
          <ul class="nav nav-tabs" role="tablist">

            {{-- @if ($wagesCount >= 1)
                <!-- Display your form for wages -->
            @endif --}}
              @if ($pendingCyclesCount >= 1)
              <li class="nav-item">
                  <a class="nav-link active ps-0" id="Cycles-tab" data-bs-toggle="tab" href="#Cycles" role="tab" aria-controls="Cycles" aria-selected="true" onclick="openForm(event, 'Cycles')">Cycles</a>
              </li>
              @endif
              @if ($wagesCount >= 1)
              <li class="nav-item">
                  <a class="nav-link" id="Expenditures-tab" data-bs-toggle="tab" href="#Expenditures" role="tab" aria-controls="Expenditures" aria-selected="false" onclick="openForm(event, 'Expenditures')">Wages</a>
              </li>
              @endif
              @if ($salariesCount >= 1)
              <li class="nav-item">
                  <a class="nav-link" id="Salaries-tab" data-bs-toggle="tab" href="#Salaries" role="tab" aria-selected="false" onclick="openForm(event, 'Salaries')">Salaries</a>
              </li>
              @endif
              @if ($advanceCount >= 1)
              <li class="nav-item">
                <a class="nav-link" id="Advances-tab" data-bs-toggle="tab" href="#Advances" role="tab" aria-selected="false" onclick="openForm(event, 'Advances')">Advances</a>
              </li>
              @endif
              @if ($transportCount >= 1)
              <li class="nav-item">
                <a class="nav-link" id="Transport-tab" data-bs-toggle="tab" href="#Transport" role="tab" aria-selected="false" onclick="openForm(event, 'Transport')">Transport</a>
              </li>
              @endif
              @if ($wagesCount >= 1)
              <li class="nav-item">
                <a class="nav-link" id="Chemicals-tab" data-bs-toggle="tab" href="#Chemicals" role="tab" aria-selected="false" onclick="openForm(event, 'Chemicals')">Chemicals</a>
              </li>
              @endif
              @if ($wagesCount >= 1)
              <li class="nav-item">
                <a class="nav-link" id="Seeds-tab" data-bs-toggle="tab" href="#Seeds" role="tab" aria-selected="false" onclick="openForm(event, 'Seeds')">Seeds</a>
              </li>
              @endif
              @if ($cpexpensesCount >= 1)
              <li class="nav-item">
                <a class="nav-link" id="CapitalExpenses-tab" data-bs-toggle="tab" href="#CapitalExpenses" role="tab" aria-selected="false" onclick="openForm(event, 'CapitalExpenses')">CapitalExpenses</a>
              </li>
              @endif
              @if ($maintenanceCount >= 1)
              <li class="nav-item">
                  <a class="nav-link" id="Maintenance-tab" data-bs-toggle="tab" href="#Maintenance" role="tab" aria-selected="false" onclick="openForm(event, 'Maintenance')">Maintenance</a>
              </li>
              @endif
              @if ($salesCount >= 1)
              <li class="nav-item">
                <a class="nav-link" id="Sales-tab" data-bs-toggle="tab" href="#Sales" role="tab" aria-selected="false" onclick="openForm(event, 'Sales')">Sales</a>
              </li>
              @endif
              @if ($withdrawalCount >= 1)
              <li class="nav-item">
                <a class="nav-link" id="CapitalWithdrawals-tab" data-bs-toggle="tab" href="#CapitalWithdrawals" role="tab" aria-selected="false" onclick="openForm(event, 'CapitalWithdrawals')">Capital Withdrawal</a>
              </li>
              @endif
              @if ($electricityCount >= 1)
              <li class="nav-item">
                  <a class="nav-link" id="Electricity-tab" data-bs-toggle="tab" href="#Electricity" role="tab" aria-selected="false" onclick="openForm(event, 'Electricity')">Electricity</a>
              </li>
              @endif
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
    @if ($pendingCyclesCount >= 1)
      <div class="content-wrapper">
        <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div>
                <a href="{{ url('cycles') }}" class="btn btn-danger float-end"><i class="mdi mdi-close"></i></a>
              </div>
                <div class="tab-content">
                  @if ($pendingCyclesCount >= 1)
                  <div class="tab-pane fade show active" id="Cycles" role="tabpanel" aria-labelledby="Cycles-tab">
                    <!-- Cycles form content here -->
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
                                  Cycle ID
                                </th>
                                <th>
                                  Cycle Name
                                </th>
                                <th>
                                  Block
                                </th>
                                <th>
                                  Crop
                                </th>
                                <th>
                                  Customer
                                </th>
                                <th>
                                  Maker
                                </th>
                                @can('create-approval')
                                <th>
                                  Edit
                                </th>
                                @endcan
                                <th>
                                  Created On
                                </th>
                                @can('create-approval')
                                <th>
                                  Validate
                                </th>
                                @endcan
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($pendingCycles as $pending )
                              <tr>
                                  <td>{{$pending->Cycle_Id}}</td>
                                  <td>{{$pending->Cycle_Name}}</td>
                                  <td>{{$pending->block->Block_Name}}</td>
                                  <td>{{$pending->Crop}}</td>
                                  <td>{{$pending->Client_Name}}</td>
                                  <td>
                                      {{$pending->maker->name}}
                                  </td>
                                  @can('create-approval')
                                  <td>
                                      <a href="{{ url('checker/'.$pending->id.'/validate')}}">Modify<i class="mdi mdi-border-color"></i></a>
                                  </td>
                                  @endcan
                                  <td>{{$pending->created_at}}</td>
                                  <td>
                                      <form action="{{ url('checker/'.$pending->id.'/validate')}}" method="POST">
                                          @csrf
                                            <input type="hidden" name="checker_id" class="form-control" value="{{ Auth::user()->id}}" readonly/>
                                            <input type="hidden" name="Status" class="form-control" value="{{ ('approved')}}" readonly/>
                                          <button type="submit" class="btn btn-danger">Approve</button>
                                        </form>
                                  </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                          {{-- <div class="pagination-container float-end">
                            {{ $cashbook->links() }}
                          </div> --}}
                        </div>
                      </div>
                  </div>
                  @endif

                  @if ($wagesCount >= 1)
                  <div class="tab-pane fade" id="Expenditures" role="tabpanel" aria-labelledby="Expenditures-tab">
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
                            {{-- <div class="pagination-container float-end">
                               {{ $wages->links() }}
                            </div> --}}
                        </div> 
                      </div>
                  </div>
                  @endif
                      
                  @if ($advanceCount >= 1)
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
                          {{-- <div class="pagination-container float-end">
                             {{ $advance->links() }}
                          </div> --}}
                      </div> 
                    </div>
                  </div>
                  @endif
  
                  @if ($salariesCount >= 1)
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
                              {{-- <div class="pagination-container float-end">
                                {{ $salaries->links() }}
                             </div> --}}
                            </td>
                          </tr>
                        </tfoot>
                      </div> 
                    </div>
                  </div>
                  @endif
  
                  @if ($withdrawalCount >= 1)
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
                          {{-- <div class="pagination-container float-end">
                            {{ $withdrawal->links() }}
                          </div> --}}
                      </div> 
                    </div>
                  </div>
                  @endif
  
                  @if ($electricityCount >= 1)
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
                          {{-- <div class="pagination-container float-end">
                            {{ $electricity->links() }}
                          </div> --}}
                      </div> 
                    </div>
                  </div>
                  @endif
  
                  @if ($maintenanceCount >= 1)
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
                          {{-- <div class="pagination-container float-end">
                             {{ $maintenance->links() }}
                          </div> --}}
                      </div> 
                    </div>
                  </div>
                  @endif
  
                  @if ($salesCount >= 1)
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
                            @foreach ($sales->where('Cycle_Id', $Cycle_Id) as $sale)
                            <tr>
                              <td>{{$sale->id}}</td>
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
                          {{-- <div class="pagination-container float-end">
                             {{ $sales->links() }}
                          </div> --}}
                      </div> 
                    </div>
                  </div>
                  @endif
                      
                  @if ($transportCount >= 1)
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
                          {{-- <div class="pagination-container float-end">
                             {{ $transport->links() }}
                          </div> --}}
                      </div> 
                    </div>
                  </div>
                  @endif
  
                  @if ($wagesCount >= 1)
                  <div class="tab-pane fade" id="Chemicals" role="tabpanel" aria-labelledby="Chemicals-tab">
                    <!-- Chemicals form content here -->
                    <p>Chemicals</p>
                  </div>
                  @endif
  
                  @if ($wagesCount >= 1)
                  <div class="tab-pane fade" id="Seeds" role="tabpanel" aria-labelledby="Seeds-tab">
                      <!-- Seeds form content here -->
                      <p>Seeds</p>
                  </div>
                  @endif
  
                  @if ($cpexpensesCount >= 1)
                  <div class="tab-pane fade" id="CapitalExpenses" role="tabpanel" aria-labelledby="CapitalExpenses-tab">
                    <!-- CapitalExpenses form content here -->
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
                          {{-- <div class="pagination-container float-end">
                             {{ $cpexpenses->links() }}
                          </div> --}}
                      </div> 
                    </div>
                  </div>
                  @endif
                </div>
              </div>
          </div>
          <script src="{{ asset('js/central-tabs.js') }}"></script>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    @else
    <div class="content-wrapper">
      <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                  <div>
                      <a href="{{ url('/dashboard') }}" class="btn btn-danger float-end"><i class="mdi mdi-close"></i> Close</a>
                  </div>
                  <div class="card-title">
                    <h4 class="text-center">
                      There are no new Entries
                      <i class="mdi mdi-check-all"></i>
                    </h4>
                  </div>
              </div>
          </div>
      </div>
  </div>
  
    @endif

@endcan
@endsection