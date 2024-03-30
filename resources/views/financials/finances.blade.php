@extends('layouts.app')

@section('content')

<div class="col-sm-12">
  <div class="home-tab">
    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active ps-0" id="Expenditures-tab" data-bs-toggle="tab" href="#Expenditures" role="tab" aria-controls="Expenditures" aria-selected="true" onclick="openForm(event, 'Expenditures')">Daily Expenditures</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="Advances-tab" data-bs-toggle="tab" href="#Advances" role="tab" aria-selected="false" onclick="openForm(event, 'Advances')">Advances</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="Salaries-tab" data-bs-toggle="tab" href="#Salaries" role="tab" aria-selected="false" onclick="openForm(event, 'Salaries')">Salaries</a>
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
    {{-- <div class="card">
        <div class="card-body">
          <div class="card-header">
                @if (session('status'))
                <div class="alert alert-success">{{session('status')}}</div>
                @endif
                <h4 class="card-title">FINANCES</h4>
          </div>
        </div>
    </div> --}}
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            {{-- <div class="card-body"> --}}

              <div class="tab-content">
                <div class="tab-pane fade show active" id="Expenditures" role="tabpanel" aria-labelledby="Expenditures-tab">
                    <div class="card-header">
                        @if (session('status'))
                        <div class="alert alert-success">{{session('status')}}</div>
                        @endif
                        <h4 class="card-title">Record Daily Expenditure</h4>
                    </div>
                    <form id="Expenditures" action="{{ url('financials/expenditures/create')}}" method="post">
                        @csrf
                        <div class="mb-3">
                          <label>Financial ID</label>
                          <input type="text" name="Fin_Id_Id" class="form-control" value="{{ $expuniqueCode }}" readonly/>
                          @error('Fin_Id_Id') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <label>Type</label>
                          <input type="text" name="type" class="form-control" value="expenditure" readonly/>
                          @error('type') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <label>Reason</label>
                          <input type="text" name="Reason" class="form-control" value="{{ old ('Reason') }}" />
                          @error('Reason') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
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
                <div class="tab-pane fade" id="Advances" role="tabpanel" aria-labelledby="Advances-tab">
                    <div class="card-header">
                        @if (session('status'))
                        <div class="alert alert-success">{{session('status')}}</div>
                        @endif
                        <h4 class="card-title">Record Salary Advances</h4>
                    </div>
                    <form id="Advances" action="{{ url('financials/advance/create')}}" method="post">
                        @csrf
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
                    <div class="card-header">
                        @if (session('status'))
                        <div class="alert alert-success">{{session('status')}}</div>
                        @endif
                        <h4 class="card-title">Record Salaries</h4>
                      </div>
                    <form id="Salaries" action="{{ url('financials/salaries/create')}}" method="post">
                        @csrf
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
                <div class="tab-pane fade" id="Others" role="tabpanel" aria-labelledby="Others-tab">
                    <!-- Others form content here -->
                </div>

            </div>
          </div>
        {{-- </div>
      </div>
    </div> --}}
        
        <script src="{{ asset('js/central-tabs.js') }}"></script>
        
        <!-- content-wrapper ends -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
@endsection
