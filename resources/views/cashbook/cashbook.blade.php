@extends('layouts.app')

@section('content')

<div class="col-sm-12">
  <div class="home-tab">
    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
        </li>
      </ul>
      <div>
        <div class="btn-wrapper">
          <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i> Share</a>
          <a href="{{ ('/cashbook/export-pdf') }}" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
          {{-- <a href="{{ ('/cashbook/send-email') }}" class="btn btn-primary text-white me-0"><i class="icon-download"></i>Mail --}}
          <form action="{{url('cashbook/send-email')}}" method="post">
              @csrf
              {{-- Mail_to --}}
                <input type="hidden" class="form-control" value="{{ Auth::user()->email}}" 
                  id="mail_to" type="email" name="mail_to"
                readonly/>
                @error('mail_to')<small class="text-red-600 font-medium">{{$message}}</small>@enderror
              <button type="submit" class="btn btn-primary text-white me-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-check" viewBox="0 0 16 16">
                  <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2zm3.708 6.208L1 11.105V5.383zM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2z"/>
                  <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686"/>
                </svg>
                Email
              </button>
          </form>
          {{-- </a> --}}
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
                <div class="card-body">
                  @if (session('status'))
                      <div class="alert alert-danger text-center">{{session('status')}}</div>
                    @endif
                  <div class="card-header">
                  <h4 class="card-title text-center">CashBook
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
                            Transaction ID
                          </th>
                          <th>
                            Cycle ID
                          </th>
                          {{-- <th>
                            Reason
                          </th> --}}
                          <th>
                            Description
                          </th>
                          <th>
                            Credit Amount
                          </th>
                          <th>
                            Debit Amount
                          </th>
                          <th>
                            Balance Estimate
                          </th>
                          <th>
                            Recorded On
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($cashbook as $cbk )
                        <tr>
                          <td>{{$cbk->id}}</td>
                          <td>{{$cbk->Transaction_Id}}</td>
                          <td>{{$cbk->Cycle_Id}}</td>
                          <td>{{$cbk->Description}}</td>
                          <td>Ksh {{$cbk->Crd_Amnt}}</td>
                          <td>Ksh {{$cbk->Dbt_Amt}}</td>
                          <td>Ksh {{$cbk->Bal}}</td>
                          <td>{{$cbk->created_at}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="pagination-container float-end">
                      {{ $cashbook->links() }}
                    </div>
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
