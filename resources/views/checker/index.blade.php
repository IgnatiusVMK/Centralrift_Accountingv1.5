@extends('layouts.app')

@section('content')
@can('view-approval')
  <div class="col-sm-12">
    <div class="home-tab">
      <div class="d-sm-flex align-items-center justify-content-between border-bottom">
          <ul class="nav nav-tabs" role="tablist">
              @if ($pendingCyclesCount >= 1)
              <li class="nav-item">
                  <a class="nav-link active ps-0" id="Cycles-tab" data-bs-toggle="tab" href="#Cycles" role="tab" aria-controls="Cycles" aria-selected="true" onclick="openForm(event, 'Cycles')">Cycles</a>
              </li>
              @endif
              @if ($creditCount >= 1)
              <li class="nav-item">
                  <a class="nav-link active ps-0" id="Credits-tab" data-bs-toggle="tab" href="#Credits" role="tab" aria-controls="Credits" aria-selected="true" onclick="openForm(event, 'Credits')">Credits</a>
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
              @if ($chemicalsCount >= 1)
              <li class="nav-item">
                <a class="nav-link" id="Chemicals-tab" data-bs-toggle="tab" href="#Chemicals" role="tab" aria-selected="false" onclick="openForm(event, 'Chemicals')">Chemicals</a>
              </li>
              @endif
              @if ($seedsCount >= 1)
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
              @if ($purchaseCount >= 1)
              <li class="nav-item">
                <a class="nav-link" id="Purchases-tab" data-bs-toggle="tab" href="#Purchases" role="tab" aria-selected="false" onclick="openForm(event, 'Purchases')">Purchases</a>
              </li>
              @endif
              @if ($stocksCount >= 1)
              <li class="nav-item">
                <a class="nav-link" id="Stocks-tab" data-bs-toggle="tab" href="#Stocks" role="tab" aria-selected="false" onclick="openForm(event, 'Stocks')">Stocks</a>
              </li>
              @endif
              @if ($cycAllocateCount >= 1)
              <li class="nav-item">
                <a class="nav-link" id="cycAllocate-tab" data-bs-toggle="tab" href="#cycAllocate" role="tab" aria-selected="false" onclick="openForm(event, 'cycAllocate')">Cycle Allocations</a>
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
    @if ($pendingCyclesCount >= 1 || $creditCount >=1 ||  $wagesCount >= 1 || $salariesCount >= 1 || $advanceCount >= 1 || $chemicalsCount >= 1 ||  $seedsCount >= 1 || $cpexpensesCount >= 1 || $maintenanceCount >= 1 || $salesCount >=1 || $purchaseCount >=1 || $stocksCount >= 1 || $cycAllocateCount >= 1 || $withdrawalCount >= 1 || $electricityCount >= 1)
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
                          <h4 class="card-title text-center">Cycles
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
                                  Product
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
                                  <td>{{$pending->Product}}</td>
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
                                  @can('create-approval')
                                  <td>
                                      <form action="{{ url('checker/'.$pending->Cycle_Id.'/validate')}}" method="POST">
                                          @csrf
                                            <input type="hidden" name="checker_id" class="form-control" value="{{ Auth::user()->id}}" readonly/>
                                            <input type="hidden" name="Status" class="form-control" value="{{ ('approved')}}" readonly/>
                                          <button type="submit" class="btn btn-danger">Approve</button>
                                        </form>
                                  </td>
                                  @endcan
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                  </div>
                  @endif


                  @if ($creditCount >= 1)
                  <div class="tab-pane fade show active" id="Credits" role="tabpanel" aria-labelledby="Credits-tab">
                    <!-- Credits form content here -->
                      <div class="card-body">
                        @if (session('status'))
                          <div class="alert alert-danger text-center">{{session('status')}}</div>
                        @endif
                        <div class="card-header">
                          <h4 class="card-title text-center">Credits
                          </h4>
                        </div>
                        <div class="table-responsive">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>
                                  Credit ID
                                </th>
                                <th>
                                  Source
                                </th>
                                <th>
                                  Description
                                </th>
                                <th>
                                  Amount
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
                              @foreach ($credits as $credit )
                              <tr>
                                  <td>{{$credit->Credit_Id}}</td>
                                  <td>{{$credit->Source}}</td>
                                  <td>{{$credit->Description}}</td>
                                  <td>{{$credit->Amount}}</td>
                                  <td>
                                      {{$credit->maker->name}}
                                  </td>
                                  @can('create-approval')
                                  <td>
                                      <a href="{{-- {{ url('checker/credit'.$credit->id.'/validate')}} --}}">Modify<i class="mdi mdi-border-color"></i></a>
                                  </td>
                                  @endcan
                                  <td>{{$credit->created_at}}</td>
                                  @can('create-approval')
                                  <td>
                                      <form action="{{ url('checker/credit/'.$credit->Credit_Id.'/approve')}}" method="POST">
                                          @csrf
                                            <input type="hidden" name="checker_id" class="form-control" value="{{ Auth::user()->id}}" readonly/>
                                            <input type="hidden" name="Status" class="form-control" value="{{ ('approved')}}" readonly/>
                                          <button type="submit" class="btn btn-danger">Approve</button>
                                        </form>
                                  </td>
                                  @endcan
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
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
                          <h4 class="card-title text-center">Wages
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
                                {{-- <th>
                                  ID
                                </th> --}}
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
                                  Maker
                                </th>
                                @can('create-approval')
                                <th>
                                  Date Created
                                </th>
                                <th>
                                  Edit
                                </th>
                                @endcan
                                @can('create-approval')
                                <th>
                                  Validate
                                </th>
                                @endcan
                                
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($wages as $wage)
                              <tr>
                                <td>{{$wage->id}}</td>
                                <td>{{$wage->Cycle_Id}}</td>
                                {{-- <td>{{$wage->Fin_Id_Id}}</td> --}}
                                <td>{{$wage->Reason}}</td>
                                <td>{{$wage->Description}}</td>
                                <td>Ksh {{$wage->Amount}}</td>
                                <td>
                                  {{$wage->maker?->name}}
                                </td>
                                <td>{{$wage->created_at}}</td>
                                @can('create-approval')
                                  <td>
                                      <a href="{{ url('checker/'.$wage->id.'/validate')}}">Modify<i class="mdi mdi-border-color"></i></a>
                                  </td>
                                @endcan
                                @can('create-approval')
                                  <td>
                                      <form action="{{ url('checker/'.$wage->Cycle_Id.'/'.$wage->Fin_Id_Id.'/'.$wage->id.'/validate')}}" method="POST">
                                          @csrf
                                            <input type="hidden" name="checker_id" class="form-control" value="{{ Auth::user()->id}}" readonly/>
                                            <input type="hidden" name="Status" class="form-control" value="{{ ('approved')}}" readonly/>
                                          <button type="submit" class="btn btn-danger">Approve</button>
                                        </form>
                                  </td>
                                @endcan
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
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
                        <h4 class="card-title text-center">Salary Advances
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
                              {{-- <th>
                                ID
                              </th> --}}
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
                                Maker
                              </th>
                              <th>
                                Payment Date
                              </th>
                              @can('create-approval')
                              <th>
                                Edit
                              </th>
                              @endcan
                              @can('create-approval')
                              <th>
                                Validate
                              </th>
                              @endcan
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($advance as $adv)
                            <tr>
                              <td>{{$adv->id}}</td>
                              <td>{{$adv->Cycle_Id}}</td>
                              {{-- <td>{{$adv->Fin_Id_Id}}</td> --}}
                              <td>{{$adv->Reason}}</td>
                              <td>{{$adv->Description}}</td>
                              <td>Ksh {{$adv->Amount}}</td>

                              <td>{{$adv->created_at}}</td>
                              <td>
                                {{$adv->maker?->name}}
                              </td>
                              @can('create-approval')
                                <td>
                                    <a href="{{-- {{ url('checker/advances/'.$adv->Cycle_Id.'/'.$adv->Fin_Id_Id.'/'.$adv->id.'/validate')}} --}}">Modify<i class="mdi mdi-border-color"></i></a>
                                </td>
                              @endcan
                              @can('create-approval')
                                <td>
                                    <form action="{{ url('checker/advances/'.$adv->Cycle_Id.'/'.$adv->Fin_Id_Id.'/'.$adv->id.'/approve')}}" method="POST">
                                        @csrf
                                          <input type="hidden" name="checker_id" class="form-control" value="{{ Auth::user()->id}}" readonly/>
                                          <input type="hidden" name="Status" class="form-control" value="{{ ('approved')}}" readonly/>
                                        <button type="submit" class="btn btn-danger">Approve</button>
                                      </form>
                                </td>
                              @endcan
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
                        <h4 class="card-title text-center">Monthly Salaries
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
                              @can('create-approval')
                              <th>
                                Edit
                              </th>
                              @endcan
                              @can('create-approval')
                              <th>
                                Validate
                              </th>
                              @endcan
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($salaries as $sal)
                            <tr>
                              <td>{{$sal->id}}</td>
                              <td>{{$sal->Cycle_Id}}</td>
                              <td>{{$sal->Fin_Id_Id}}</td>
                              <td>{{$sal->Reason}}</td>
                              <td>{{$sal->Description}}</td>
                              <td>Ksh {{$sal->Amount}}</td>
                              <td>{{$sal->created_at}}</td>
                                @can('create-approval')
                                  <td>
                                      <a href="{{-- {{ url('checker/salary/'.$sal->id.'/validate')}} --}}">Modify<i class="mdi mdi-border-color"></i></a>
                                  </td>
                                @endcan
                                @can('create-approval')
                                  <td>
                                      <form action="{{ url('checker/salaries/'.$sal->Cycle_Id.'/'.$sal->Fin_Id_Id.'/'.$sal->id.'/approve')}}" method="POST">
                                          @csrf
                                            <input type="hidden" name="checker_id" class="form-control" value="{{ Auth::user()->id}}" readonly/>
                                            <input type="hidden" name="Status" class="form-control" value="{{ ('approved')}}" readonly/>
                                          <button type="submit" class="btn btn-danger">Approve</button>
                                        </form>
                                  </td>
                                @endcan
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                        <tfoot>
                          <tr>
                            <td>
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
                        <h4 class="card-title text-center">Withdrawals
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
                              <th>Maker</th>
                              <th>Edit</th>
                              <th>Validate</th>
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
                              <td>
                                {{$withd->maker->name}}
                            </td>
                            @can('create-approval')
                            <td>
                                <a href="{{ url('checker/withdrawals/'.$withd->Capt_Withdraw_Id.'/modify')}}">Modify<i class="mdi mdi-border-color"></i></a>
                            </td>
                            @endcan
                            @can('create-approval')
                            <td>
                                <form action="{{ url('checker/withdrawals/'.$withd->Capt_Withdraw_Id.'/approve')}}" method="POST">
                                    @csrf
                                      <input type="hidden" name="checker_id" class="form-control" value="{{ Auth::user()->id}}" readonly/>
                                      <input type="hidden" name="Status" class="form-control" value="{{ ('approved')}}" readonly/>
                                    <button type="submit" class="btn btn-danger">Approve</button>
                                </form>
                            </td>
                            @endcan
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
                        <h4 class="card-title text-center">Electricty
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
                                Maker
                              </th>
                              <th>
                                Date Created
                              </th>
                              @can('create-approval')
                              <th>
                                Edit
                              </th>
                              @endcan
                              @can('create-approval')
                              <th>
                                Validate
                              </th>
                              @endcan
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
                              <td>
                                {{$elec->maker?->name}}
                              </td>
                              <td>{{$elec->created_at}}</td>
                              @can('create-approval')
                                  <td>
                                      <a href="{{-- {{ url('checker/electricity/'.$sal->id.'/validate')}} --}}">Modify<i class="mdi mdi-border-color"></i></a>
                                  </td>
                                @endcan
                                @can('create-approval')
                                  <td>
                                      <form action="{{ url('checker/electricity/'.$elec->Cycle_Id.'/'.$elec->Fin_Id_Id.'/'.$elec->id.'/approve')}}" method="POST">
                                          @csrf
                                            <input type="hidden" name="checker_id" class="form-control" value="{{ Auth::user()->id}}" readonly/>
                                            <input type="hidden" name="Status" class="form-control" value="{{ ('approved')}}" readonly/>
                                          <button type="submit" class="btn btn-danger">Approve</button>
                                        </form>
                                  </td>
                                @endcan
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
                        <h4 class="card-title text-center">Maintenance
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
                                Reason
                              </th>
                              <th>
                                Description
                              </th>
                              <th>
                                Amount
                              </th>
                              <th>
                                Maker
                              </th>
                              <th>
                                Date Created
                              </th>
                              @can('create-approval')
                              <th>
                                Edit
                              </th>
                              @endcan
                              @can('create-approval')
                              <th>
                                Validate
                              </th>
                              @endcan
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($maintenance as $maint)
                            <tr>
                              <td>{{-- {{$maint->id}} --}}</td>
                              <td>{{$maint->Cycle_Id}}</td>
                              <td>{{$maint->Reason}}</td>
                              <td>{{$maint->Description}}</td>
                              <td>Ksh {{$maint->Amount}}</td>
                              <td>
                                {{$maint->maker?->name}}
                              </td>
                              <td>{{$maint->created_at}}</td>
                              @can('create-approval')
                                  <td>
                                    <a href="{{-- {{ url('checker/'.$maint->Sales_Id.'/validate')}} --}}">Modify<i class="mdi mdi-border-color"></i></a>
                                  </td>
                                @endcan
                              @can('create-approval')
                                  <td>
                                      <form action="{{ url('checker/maintenance/'.$maint->Cycle_Id.'/'.$maint->Fin_Id_Id.'/'.$maint->id.'/approve')}}" method="POST">
                                          @csrf
                                            <input type="hidden" name="checker_id" class="form-control" value="{{ Auth::user()->id}}" readonly/>
                                            <input type="hidden" name="Status" class="form-control" value="{{ ('approved')}}" readonly/>
                                          <button type="submit" class="btn btn-danger">Approve</button>
                                        </form>
                                  </td>
                                @endcan
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
                        <h4 class="card-title text-center">Product Sales
                        </h4>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              {{-- <th>
                                Sn No.
                              </th> --}}
                              <th>
                                Cycle
                              </th>
                              {{-- <th>
                                Sale
                              </th> --}}
                              <th>
                                Customer
                              </th>
                              <th>
                                LPO Number
                              </th>
                              <th>
                                Sales Date
                              </th>
                              <th>
                                Maker
                              </th>
                              <th>
                                Quantity
                              </th>
                              <th>
                                Total Price
                              </th>
                              {{-- <th>
                                Payment Type
                              </th> --}}
                              <th>
                                Payment Status
                              </th>
                              @can('create-approval')
                              <th>
                                Edit
                              </th>
                              @endcan
                              @can('create-approval')
                              <th>
                                Validate
                              </th>
                              @endcan
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($sales as $sale)
                              <tr>
                                <td>{{$sale->Cycle_Id}}</td>
                                <td>{{$sale->customer->Customer_Name}}</td>
                                <td>{{$sale->Lpo_No}}</td>
                                <td>{{$sale->Sale_Date}}</td>
                                <td>
                                  {{$sale->maker?->name}}
                                </td>
                                <td>{{$sale->Quantity}} Kg</td>
                                <td>Ksh {{$sale->Total_Price}}</td>
                                <td class="@if($sale->Payment_Status == 'Un-paid') text-danger @elseif($sale->Payment_Status == 'Paid') text-success @else text-warning @endif">
                                  {{$sale->Payment_Status}}
                                </td>
                                @can('create-approval')
                                  <td>
                                    <a href="">Modify<i class="mdi mdi-border-color"></i></a>
                                  </td>
                                @endcan
                                @can('create-approval')
                                  <td>
                                    <form action="{{ url('checker/'.$sale->Sales_Id.'/'.$sale->id.'/validate') }}" method="POST">
                                      @csrf
                                      <input type="hidden" name="checker_id" class="form-control" value="{{ Auth::user()->id}}" readonly/>
                                      <input type="hidden" name="Status" class="form-control" value="{{ ('approved')}}" readonly/>
                                      <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to approve this sale?');">Approve Sale</button>
                                  </form>                                  
                                  </td>
                                @endcan
                              </tr>
                            @endforeach{{-- {{ url('checker/'.$sale->Sales_Id.'/validate')}} --}}
                          </tbody>
                        </table>
                          {{-- <div class="pagination-container float-end">
                             {{ $sales->links() }}
                          </div> --}}
                      </div> 
                    </div>
                  </div>
                  @endif

                  @if ($purchaseCount >= 1)
                  <div class="tab-pane fade" id="Purchases" role="tabpanel" aria-labelledby="Purchases-tab">
                    <!-- Purchases form content here -->
                    <div class="card-body">
                      @if (session('status'))
                        <div class="alert alert-danger text-center">{{session('status')}}</div>
                      @endif
                      <div class="card-header">
                        <h4 class="card-title text-center">Purchases
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
                              <th>
                                Maker
                              </th>
                              @can('create-approval')
                              <th>
                                Edit
                              </th>
                              @endcan
                              @can('create-approval')
                              <th>
                                Validate
                              </th>
                              @endcan
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($purchases as $purchase)
                              <tr>
                                <td>{{$purchase->id}}</td>
                                <td>{{$purchase->Item_Name}}</td>
                                <td>{{$purchase->supplier->Supplier_Name}}</td>
                                @if ($purchase->Category_Id == 1)
                                  <td>{{$purchase->Quantity}} Ltrs.</td>
                                @elseif ($purchase->Category_Id == 2)
                                  <td>{{$purchase->Quantity}} gms/Kgs</td>
                                @elseif ($purchase->Category_Id == 3)
                                  <td>{{$purchase->Quantity}} Boxes/Kgs</td>
                                @endif
                                <td>Ksh {{$purchase->Unit_Cost}}</td>
                                <td>Ksh {{$purchase->Total_Cost}}</td>
                                <td>{{$purchase->maker->name}}</td>
                                @can('create-approval')
                                  <td>
                                    <a href={{-- "" --}}>Modify<i class="mdi mdi-border-color"></i></a>
                                  </td>
                                @endcan
                                @can('create-approval')
                                  <td>
                                    <form action="{{ url('checker/purchases/'.$purchase->id.'/'.$purchase->Purchase_Id.'/approve') }}" method="POST">
                                      {{-- {{ url('checker/'.$sale->Sales_Id.'/'.$sale->id.'/validate') }} --}}
                                      {{-- /checker/purchases/{Purchase_Id}/validate --}}
                                      @csrf

                                      <input type="hidden" name="checker_id" class="form-control" value="{{ Auth::user()->id}}" readonly/>
                                      <input type="hidden" name="Status" class="form-control" value="{{ ('approved')}}" readonly/>
                                      <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to approve this Purchase?');">Approve Purchase</button>
                                  </form>                                  
                                  </td>
                                @endcan
                              </tr>
                            @endforeach{{-- {{ url('checker/'.$purchase->Sales_Id.'/validate')}} --}}
                          </tbody>
                        </table>
                          {{-- <div class="pagination-container float-end">
                             {{ $purchases->links() }}
                          </div> --}}
                      </div> 
                    </div>
                  </div>
                  @endif
                      
                  @if ($stocksCount >= 1)
                  <div class="tab-pane fade" id="Stocks" role="tabpanel" aria-labelledby="Stocks-tab">
                    <!-- Stocks form content here -->
                    <div class="card-body">
                      @if (session('status'))
                        <div class="alert alert-danger text-center">{{session('status')}}</div>
                      @endif
                      <div class="card-header">
                        <h4 class="card-title text-center">Stocks
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
                                Inventory Name
                              </th>
                              <th>
                                Quantity
                              </th>
                              <th>
                                Quantity in Stock
                              </th>
                              <th>
                                Maker
                              </th>
                              @can('create-approval')
                              <th>
                                Edit
                              </th>
                              @endcan
                              @can('create-approval')
                              <th>
                                Validate
                              </th>
                              @endcan
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($stocks as $stock)
                              <tr>
                                <td>{{$stock->id}}</td>
                                <td>{{$stock->Stock_Name}}</td>
                                @if ($stock->purchase->Category_Id == 1)
                                  <td style="font-size: 18px">{{$stock->Total_Quantity}} (Ltrs.)</td>
                                @elseif ($stock->purchase->Category_Id == 2)
                                  <td style="font-size: 18px">{{$stock->Total_Quantity}} (gms/Kgs)</td>
                                @elseif ($stock->purchase->Category_Id == 3)
                                  <td style="font-size: 18px">{{$stock->Total_Quantity}} (Boxes/Kgs)</td>
                                @endif
                                @if ($stock->purchase->Category_Id == 1)
                                  <td style="font-size: 18px">{{$stock->Remaining_Quantity}} (Ltrs.)</td>
                                @elseif ($stock->purchase->Category_Id == 2)
                                  <td style="font-size: 18px">{{$stock->Remaining_Quantity}} (gms/Kgs)</td>
                                @elseif ($stock->purchase->Category_Id == 3)
                                  <td style="font-size: 18px">{{$stock->Remaining_Quantity}} (Boxes/Kgs)</td>
                                @endif
                                <td>{{$stock->maker->name}}</td>
                                @can('create-approval')
                                  <td>
                                    <a href={{-- "" --}}>Modify<i class="mdi mdi-border-color"></i></a>
                                  </td>
                                @endcan
                                @can('create-approval')
                                  <td>
                                    <form action="{{ url('/checker/stock/'.$stock->id.'/approve') }}" method="POST">
                                      {{-- {{ url('checker/'.$sale->Sales_Id.'/'.$sale->id.'/validate') }} --}}
                                      {{-- /checker/purchases/{Purchase_Id}/validate --}}
                                      @csrf

                                      <input type="hidden" name="checker_id" class="form-control" value="{{ Auth::user()->id}}" readonly/>
                                      <input type="hidden" name="Status" class="form-control" value="{{ ('approved')}}" readonly/>
                                      <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to approve this Stock Record?');">Approve Stock Record</button>
                                  </form>                                  
                                  </td>
                                @endcan
                              </tr>
                            @endforeach{{-- {{ url('checker/'.$stock->Sales_Id.'/validate')}} --}}
                          </tbody>
                        </table>
                          {{-- <div class="pagination-container float-end">
                             {{ $stocks->links() }}
                          </div> --}}
                      </div> 
                    </div>
                  </div>
                  @endif

                  @if ($cycAllocateCount >= 1)
                  <div class="tab-pane fade" id="cycAllocate" role="tabpanel" aria-labelledby="cycAllocate-tab">
                    <!-- cycAllocate form content here -->
                    <div class="card-body">
                      @if (session('status'))
                        <div class="alert alert-danger text-center">{{session('status')}}</div>
                      @endif
                      <div class="card-header">
                        <h4 class="card-title text-center">Cycles Inventory Allocations
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
                                Inventory Name
                              </th>
                              <th>
                                Allocated Quantity
                              </th>
                              <th>
                                Maker
                              </th>
                              @can('create-approval')
                              <th>
                                Edit
                              </th>
                              @endcan
                              @can('create-approval')
                              <th>
                                Validate
                              </th>
                              @endcan
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($cycAllocates as $cycAllocate)
                              <tr>
                                <td style="font-size: 18px">{{$cycAllocate->id}}</td>
                                <td style="font-size: 18px">{{$cycAllocate->cyc_alloc->Cycle_Name}}</td>
                                @if ($cycAllocate->category ==1)
                                  <td style="font-size: 18px">{{$cycAllocate->allocated_quantity}} (Ltrs.)</td>
                                @elseif ($cycAllocate->category ==2)
                                  <td style="font-size: 18px">{{$cycAllocate->allocated_quantity}} (gms/Kgs)</td>
                                @elseif ($cycAllocate->category ==3)
                                  <td style="font-size: 18px">{{$cycAllocate->allocated_quantity}} (Boxes/Kgs)</td>
                                @endif
                                <td style="font-size: 18px">{{$cycAllocate->maker->name}}</td>
                                @can('create-approval')
                                  <td>
                                    <a href={{-- "" --}}>Modify<i class="mdi mdi-border-color"></i></a>
                                  </td>
                                @endcan
                                @can('create-approval')
                                  <td>
                                    <form action="{{ url('/checker/cycle-allocations/'.$cycAllocate->id.'/approve') }}" method="POST">
                                      @csrf

                                      <input type="hidden" name="checker_id" class="form-control" value="{{ Auth::user()->id}}" readonly/>
                                      <input type="hidden" name="Status" class="form-control" value="{{ ('approved')}}" readonly/>
                                      <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to approve this Allocation?');">Approve Allocation</button>
                                  </form>                                  
                                  </td>
                                @endcan
                              </tr>
                            @endforeach{{-- {{ url('checker/'.$cycAllocate->Sales_Id.'/validate')}} --}}
                          </tbody>
                        </table>
                          {{-- <div class="pagination-container float-end">
                             {{ $cycAllocates->links() }}
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
                        <h4 class="card-title text-center">Transport
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
                              @can('create-approval')
                              <th>
                                Edit
                              </th>
                              @endcan
                              @can('create-approval')
                              <th>
                                Validate
                              </th>
                              @endcan
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($transport as $tran)
                            <tr>
                              <td>{{$tran->id}}</td>
                              <td>{{$tran->Cycle_Id}}</td>
                              <td>{{$tran->Fin_Id_Id}}</td>
                              <td>{{$tran->Reason}}</td>
                              <td>{{$tran->Description}}</td>
                              <td>Ksh {{$tran->Amount}}</td>
                              <td>{{$tran->created_at}}</td>
                              @can('create-approval')
                                  <td>
                                      <a href="{{-- {{ url('checker/transport/'.$tran->Cycle_Id.'/'.$tran->Fin_Id_Id.'/'.$tran->id.'/validate')}} --}}">Modify<i class="mdi mdi-border-color"></i></a>
                                  </td>
                                @endcan
                                @can('create-approval')
                                  <td>
                                      <form action="{{ url('checker/transport/'.$tran->Cycle_Id.'/'.$tran->Fin_Id_Id.'/'.$tran->id.'/approve')}}" method="POST">
                                          @csrf
                                            <input type="hidden" name="checker_id" class="form-control" value="{{ Auth::user()->id}}" readonly/>
                                            <input type="hidden" name="Status" class="form-control" value="{{ ('approved')}}" readonly/>
                                          <button type="submit" class="btn btn-danger">Approve</button>
                                        </form>
                                  </td>
                                @endcan
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
  
                  @if ($chemicalsCount >= 1)
                  <div class="tab-pane fade" id="Chemicals" role="tabpanel" aria-labelledby="Chemicals-tab">
                    <!-- Chemicals form content here -->
                    <p>Chemicals</p>
                  </div>
                  @endif
  
                  @if ($seedsCount >= 1)
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
                        <h4 class="card-title text-center">Capital Expenses
                        </h4>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              {{-- <th>
                                Sn No.
                              </th> --}}
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
                                Maker
                              </th>
                              <th>
                                Date Created
                              </th>
                              @can('create-approval')
                              <th>
                                Edit
                              </th>
                              @endcan
                              @can('create-approval')
                              <th>
                                Validate
                              </th>
                              @endcan
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($cpexpenses as $cpexpe)
                            <tr>
                              {{-- <td>{{$cpexpe->id}}</td> --}}
                              <td>{{$cpexpe->Cycle_Id}}</td>
                              <td>{{$cpexpe->Fin_Id_Id}}</td>
                              <td>{{$cpexpe->Reason}}</td>
                              <td>{{$cpexpe->Description}}</td>
                              <td>Ksh {{$cpexpe->Amount}}</td>
                              <td>
                                {{$cpexpe->maker?->name}}
                              </td>
                              <td>{{$cpexpe->created_at}}</td>
                              @can('create-approval')
                                  <td>
                                      <a href="{{-- {{ url('checker/capital-expenses/'.$tran->Cycle_Id.'/'.$tran->Fin_Id_Id.'/'.$tran->id.'/validate')}} --}}">Modify<i class="mdi mdi-border-color"></i></a>
                                  </td>
                                @endcan
                                @can('create-approval')
                                  <td>
                                      <form action="{{ url('checker/capital-expenses/'.$cpexpe->Cycle_Id.'/'.$cpexpe->Fin_Id_Id.'/'.$cpexpe->id.'/approve')}}" method="POST">
                                          @csrf
                                            <input type="hidden" name="checker_id" class="form-control" value="{{ Auth::user()->id}}" readonly/>
                                            <input type="hidden" name="Status" class="form-control" value="{{ ('approved')}}" readonly/>
                                          <button type="submit" class="btn btn-danger">Approve</button>
                                        </form>
                                  </td>
                                @endcan
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
          <script src="{{ asset('js/checker-central-tabs.js') }}"></script>
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
                There are no new pending Requests.
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