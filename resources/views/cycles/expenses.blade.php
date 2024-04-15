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
                <a class="nav-link" id="CapitalWithdrawals-tab" data-bs-toggle="tab" href="#CapitalWithdrawals" role="tab" aria-selected="false" onclick="openForm(event, 'CapitalWithdrawals')">Capital Withdrawal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="Electricity-tab" data-bs-toggle="tab" href="#Electricity" role="tab" aria-selected="false" onclick="openForm(event, 'Electricity')">Electricity</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="Maintenance-tab" data-bs-toggle="tab" href="#Maintenance" role="tab" aria-selected="false" onclick="openForm(event, 'Maintenance')">Maintenance</a>
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
            <a href="{{ url('cycles') }}" class="btn btn-danger"><i class="mdi mdi-close"></i></a>
              <div class="tab-content">

                <div class="tab-pane fade show active" id="Expenditures" role="tabpanel" aria-labelledby="Expenditures-tab">
                    <div class="card-body">
                      @if (session('status'))
                        <div class="alert alert-danger text-center">{{session('status')}}</div>
                      @endif
                      <div class="card-header">
                        {{-- <a href="{{ url('cycles') }}" class="btn btn-danger float-end"><i class="mdi mdi-close"></i></a> --}}
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
                            @foreach ($financials->where('Cycle_Id', $Cycle_Id) as $fin)
                            <tr>
                              <td>{{$fin->Financial_Id}}</td>
                              <td>{{$fin->Cycle_Id}}</td>
                              <td>{{$fin->Fin_Id_Id}}</td>
                              <td>{{$fin->Reason}}</td>
                              <td>{{$fin->Description}}</td>
                              <td>Ksh {{$fin->Amount}}</td>
                              <td>{{$fin->created_at}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                          <div class="pagination-container float-end">
                            {{--  {{ $financials->links() }} --}}
                          </div>
                      </div> 
                    </div>
                </div>
                    
                <div class="tab-pane fade" id="Advances" role="tabpanel" aria-labelledby="Advances-tab">
                  <a href="{{ url('cycles') }}" class="btn btn-danger float-end">{{-- Back --}} <i class="mdi mdi-close"></i></a>
                    <div class="card-header">
                        @if (session('status'))
                        <div class="alert alert-success">{{session('status')}}</div>
                        @endif
                        <h4 class="card-title">Salary Advances</h4>
                    </div>
                    <form id="Advances" action="{{ url('financials/advance/create')}}" method="post">
                        @csrf
                        <div class="mb-3">
                          <label>Cycle</label>
                          <input type="text" name="Cycle_Id" class="form-control {{-- text-center --}}" value="{{ $Cycle_Id }}" readonly/>
                          @error('Cycle_Id') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <label>Financial ID</label>
                          <input type="text" name="Fin_Id_Id" class="form-control" value="{{ $advuniqueCode }}" readonly/>
                          @error('Fin_Id_Id') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <label>Type</label>
                          <input type="text" name="type" class="form-control" value="advance" readonly/>
                          @error('type') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <label>Name</label>
                          <input type="text" name="Reason" class="form-control" value="{{ old ('Reason') }}" />
                          @error('Reason') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <label>Description</label>
                          <select id="Description" name="Description" class="form-control" required>
                            <option value="NULL" selected>-- SELECT MONTH --
                              @foreach(range(1, 12) as $month)
                                  <option value="{{ \Carbon\Carbon::create(null, $month, 1)->format('F Y') }}">
                                      {{ \Carbon\Carbon::create(null, $month, 1)->format('F Y') }}
                                  </option>
                              @endforeach
                          </select>
                          @error('Description') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <label>Amount</label>
                          <input type="number" name="Amount" class="form-control" value="{{ old ('Amount') }}" />
                          @error('Amount') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <label>Date</label>
                          <input type="date" name="Date" class="form-control" value="{{ old ('Date') }}" />
                          @error('Date') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <button type="submit"  class="btn btn-success text-center">Save</button>
                        </div>
        
                      </form>
                </div>
                <div class="tab-pane fade" id="Salaries" role="tabpanel" aria-labelledby="Salaries-tab">
                  <a href="{{ url('cycles') }}" class="btn btn-danger float-end">{{-- Back --}} <i class="mdi mdi-close"></i></a>
                    <div class="card-header">
                        @if (session('status'))
                        <div class="alert alert-success">{{session('status')}}</div>
                        @endif
                        <h4 class="card-title">Salaries</h4>
                      </div>
                    <form id="Salaries" action="{{ url('financials/salaries/create')}}" method="post">
                        @csrf
                            <div class="mb-3">
                              <label>Cycle</label>
                              <input type="text" name="Cycle_Id" class="form-control {{-- text-center --}}" value="{{ $Cycle_Id }}" readonly/>
                              @error('Cycle_Id') <span class="text-danger">{{ $message}}</span> @enderror
                            </div>
                            <div class="mb-3">
                              <label>Financial ID</label>
                              <input type="text" name="Fin_Id_Id" class="form-control" value="{{ $saluniqueCode }}" readonly/>
                              @error('Fin_Id_Id') <span class="text-danger">{{ $message}}</span> @enderror
                            </div>
                            <div class="mb-3">
                              <label>Type</label>
                              <input type="text" name="type" class="form-control" value="salaries" readonly/>
                              @error('type') <span class="text-danger">{{ $message}}</span> @enderror
                            </div>
                            <div class="mb-3">
                              <label>Payee</label>
                              <input type="text" name="Reason" class="form-control" value="{{ old ('Reason') }}" />
                              @error('Reason') <span class="text-danger">{{ $message}}</span> @enderror
                            </div>
                            <div class="mb-3">
                              <label>Description</label>
                              <select id="Description" name="Description" class="form-control" required>
                                <option value="NULL" selected>-- SELECT MONTH --
                                  @foreach(range(1, 12) as $month)
                                      <option value="{{ \Carbon\Carbon::create(null, $month, 1)->format('F Y') }}">
                                          {{ \Carbon\Carbon::create(null, $month, 1)->format('F Y') }}
                                      </option>
                                  @endforeach
                              </select>
                              @error('Description') <span class="text-danger">{{ $message}}</span> @enderror
                            </div>
                            <div class="mb-3">
                              <label>Amount</label>
                              <input type="number" name="Amount" class="form-control" value="{{ old ('Amount') }}" />
                              @error('Amount') <span class="text-danger">{{ $message}}</span> @enderror
                            </div>
                            <div class="mb-3">
                              <label>Date</label>
                              <input type="date" name="Date" class="form-control" value="{{ old ('Date') }}" />
                              @error('Date') <span class="text-danger">{{ $message}}</span> @enderror
                            </div>
                            <div class="mb-3">
                              <button type="submit"  class="btn btn-success text-center">Save</button>
                            </div>
        
                          </form>
                    </div>
                    <div class="tab-pane fade" id="CapitalWithdrawals" role="tabpanel" aria-labelledby="CapitalWithdrawals-tab">
                      <a href="{{ url('cycles') }}" class="btn btn-danger float-end">{{-- Back --}} <i class="mdi mdi-close"></i></a>
                        <div class="card-header">
                            @if (session('status'))
                            <div class="alert alert-success">{{session('status')}}</div>
                            @endif
                            <h4 class="card-title">Capital Withdrawal</h4>
                        </div>
                        <form id="CapitalWithdrawals" action="{{ url('financials/advance/create')}}" method="post">
                            @csrf
                            <div class="mb-3">
                              <label>Cycle</label>
                              <input type="text" name="Cycle_Id" class="form-control {{-- text-center --}}" value="{{ $Cycle_Id }}" readonly/>
                              @error('Cycle_Id') <span class="text-danger">{{ $message}}</span> @enderror
                            </div>
                            <div class="mb-3">
                              <label>Financial ID</label>
                              <input type="text" name="Fin_Id_Id" class="form-control" value="{{ $advuniqueCode }}" readonly/>
                              @error('Fin_Id_Id') <span class="text-danger">{{ $message}}</span> @enderror
                            </div>
                            <div class="mb-3">
                              <label>Type</label>
                              <input type="text" name="type" class="form-control" value="advance" readonly/>
                              @error('type') <span class="text-danger">{{ $message}}</span> @enderror
                            </div>
                            <div class="mb-3">
                              <label>Name</label>
                              <input type="text" name="Reason" class="form-control" value="{{ old ('Reason') }}" />
                              @error('Reason') <span class="text-danger">{{ $message}}</span> @enderror
                            </div>
                            <div class="mb-3">
                              <label>Description</label>
                              <select id="Description" name="Description" class="form-control" required>
                                <option value="NULL" selected>-- SELECT MONTH --
                                  @foreach(range(1, 12) as $month)
                                      <option value="{{ \Carbon\Carbon::create(null, $month, 1)->format('F Y') }}">
                                          {{ \Carbon\Carbon::create(null, $month, 1)->format('F Y') }}
                                      </option>
                                  @endforeach
                              </select>
                              @error('Description') <span class="text-danger">{{ $message}}</span> @enderror
                            </div>
                            <div class="mb-3">
                              <label>Amount</label>
                              <input type="number" name="Amount" class="form-control" value="{{ old ('Amount') }}" />
                              @error('Amount') <span class="text-danger">{{ $message}}</span> @enderror
                            </div>
                            <div class="mb-3">
                              <label>Date</label>
                              <input type="date" name="Date" class="form-control" value="{{ old ('Date') }}" />
                              @error('Date') <span class="text-danger">{{ $message}}</span> @enderror
                            </div>
                            <div class="mb-3">
                              <button type="submit"  class="btn btn-success text-center">Save</button>
                            </div>
            
                          </form>
                    </div>
                    <div class="tab-pane fade" id="Electricity" role="tabpanel" aria-labelledby="Electricity-tab">
                      <a href="{{ url('cycles') }}" class="btn btn-danger float-end">{{-- Back --}} <i class="mdi mdi-close"></i></a>
                      <div class="card-header">
                          @if (session('status'))
                          <div class="alert alert-success">{{session('status')}}</div>
                          @endif
                          <h4 class="card-title">Electricity</h4>
                      </div>
                      <form id="Electricty" action="{{ url('financials/expenditures/create')}}" method="post">
                          @csrf
                          <div class="mb-3">
                            <label>Cycle</label>
                            <input type="text" name="Cycle_Id" class="form-control {{-- text-center --}}" value="{{ $Cycle_Id }}" readonly/>
                            @error('Cycle_Id') <span class="text-danger">{{ $message}}</span> @enderror
                          </div>
                          <div class="mb-3">
                            <label>Financial ID</label>
                            <input type="text" name="Fin_Id_Id" class="form-control" value="{{ $elecuniqueCode }}" readonly/>
                            @error('Fin_Id_Id') <span class="text-danger">{{ $message}}</span> @enderror
                          </div>
                          <div class="mb-3">
                            <label>Type</label>
                            <input type="text" name="type" class="form-control" value="Electricity" readonly/>
                            @error('type') <span class="text-danger">{{ $message}}</span> @enderror
                          </div>
                          {{-- <div class="mb-3">
                            <label>Reason</label>
                            <input type="text" name="Reason" class="form-control" value="{{ old ('Reason') }}" />
                            @error('Reason') <span class="text-danger">{{ $message}}</span> @enderror
                          </div> --}}
                          <div class="mb-3">
                            <label>Description</label>
                            <input type="text" name="Description" class="form-control" value="{{ old ('Description') }}" />
                            @error('Description') <span class="text-danger">{{ $message}}</span> @enderror
                          </div>
                          <div class="mb-3">
                            <label>Amount</label>
                            <input type="number" name="Amount" class="form-control" value="{{ old ('Amount') }}" />
                            @error('Amount') <span class="text-danger">{{ $message}}</span> @enderror
                          </div>
                          <div class="mb-3">
                            <label>Date</label>
                            <input type="date" name="Date" class="form-control" value="{{ old ('Date') }}" />
                            @error('Date') <span class="text-danger">{{ $message}}</span> @enderror
                          </div>
                          <div class="mb-3">
                            <button type="submit"  class="btn btn-success text-center">Save</button>
                          </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="Maintenance" role="tabpanel" aria-labelledby="Maintenance-tab">
                      <a href="{{ url('cycles') }}" class="btn btn-danger float-end">{{-- Back --}} <i class="mdi mdi-close"></i></a>
                        <!-- Maintenance form content here -->
                    </div>
                    
                    <div class="tab-pane fade" id="Transport" role="tabpanel" aria-labelledby="Transport-tab">
                      <a href="{{ url('cycles') }}" class="btn btn-danger float-end">{{-- Back --}} <i class="mdi mdi-close"></i></a>
                      <div class="card-header">
                        @if (session('status'))
                        <div class="alert alert-success">{{session('status')}}</div>
                        @endif
                        <h4 class="card-title">Transport</h4>
                    </div>
                    <form id="Transport" action="{{ url('financials/expenditures/create')}}" method="post">
                        @csrf
                        <div class="mb-3">
                          <label>Cycle</label>
                          <input type="text" name="Cycle_Id" class="form-control {{-- text-center --}}" value="{{ $Cycle_Id }}" readonly/>
                          @error('Cycle_Id') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <label>Financial ID</label>
                          <input type="text" name="Fin_Id_Id" class="form-control" value="{{ $tranuniqueCode }}" readonly/>
                          @error('Fin_Id_Id') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <label>Type</label>
                          <input type="text" name="type" class="form-control" value="Transport" readonly/>
                          @error('type') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        {{-- <div class="mb-3">
                          <label>Reason</label>
                          <input type="text" name="Reason" class="form-control" value="{{ old ('Reason') }}" />
                          @error('Reason') <span class="text-danger">{{ $message}}</span> @enderror
                        </div> --}}
                        <div class="mb-3">
                          <label>Description</label>
                          <input type="text" name="Description" class="form-control" value="{{ old ('Description') }}" />
                          @error('Description') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <label>Amount</label>
                          <input type="number" name="Amount" class="form-control" value="{{ old ('Amount') }}" />
                          @error('Amount') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <label>Date</label>
                          <input type="date" name="Date" class="form-control" value="{{ old ('Date') }}" />
                          @error('Date') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <button type="submit"  class="btn btn-success text-center">Save</button>
                        </div>
                      </form>
                    </div>

                    <div class="tab-pane fade" id="Chemicals" role="tabpanel" aria-labelledby="Chemicals-tab">
                      <a href="{{ url('cycles') }}" class="btn btn-danger float-end">{{-- Back --}} <i class="mdi mdi-close"></i></a>
                      <div class="card-header">
                        @if (session('status'))
                        <div class="alert alert-success">{{session('status')}}</div>
                        @endif
                        <h4 class="card-title">Electricity</h4>
                    </div>
                    <form id="Chemicals" action="{{ url('financials/expenditures/create')}}" method="post">
                        @csrf
                        <div class="mb-3">
                          <label>Cycle</label>
                          <input type="text" name="Cycle_Id" class="form-control {{-- text-center --}}" value="{{ $Cycle_Id }}" readonly/>
                          @error('Cycle_Id') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <label>Financial ID</label>
                          <input type="text" name="Fin_Id_Id" class="form-control" value="{{ $chemuniqueCode }}" readonly/>
                          @error('Fin_Id_Id') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <label>Type</label>
                          <input type="text" name="type" class="form-control" value="Chemicals" readonly/>
                          @error('type') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        {{-- <div class="mb-3">
                          <label>Reason</label>
                          <input type="text" name="Reason" class="form-control" value="{{ old ('Reason') }}" />
                          @error('Reason') <span class="text-danger">{{ $message}}</span> @enderror
                        </div> --}}
                        <div class="mb-3">
                          <label>Description</label>
                          <input type="text" name="Description" class="form-control" value="{{ old ('Description') }}" />
                          @error('Description') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <label>Amount</label>
                          <input type="number" name="Amount" class="form-control" value="{{ old ('Amount') }}" />
                          @error('Amount') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <label>Date</label>
                          <input type="date" name="Date" class="form-control" value="{{ old ('Date') }}" />
                          @error('Date') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <button type="submit"  class="btn btn-success text-center">Save</button>
                        </div>
                      </form>
                    </div>

                    <div class="tab-pane fade" id="Seeds" role="tabpanel" aria-labelledby="Seeds-tab">
                      <a href="{{ url('cycles') }}" class="btn btn-danger float-end">{{-- Back --}} <i class="mdi mdi-close"></i></a>
                        <!-- Seeds form content here -->
                    </div>

                    <div class="tab-pane fade" id="CapitalExpenses" role="tabpanel" aria-labelledby="CapitalExpenses-tab">
                      <a href="{{ url('cycles') }}" class="btn btn-danger float-end">{{-- Back --}} <i class="mdi mdi-close"></i></a>
                        <!-- CapitalExpenses form content here -->
                    </div>

                    <div class="tab-pane fade" id="Others" role="tabpanel" aria-labelledby="Others-tab">
                      <a href="{{ url('cycles') }}" class="btn btn-danger float-end">{{-- Back --}} <i class="mdi mdi-close"></i></a>
                        <!-- Others form content here -->
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
