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
              <button type="submit" class="btn btn-primary text-white me-0">Email</button>
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
