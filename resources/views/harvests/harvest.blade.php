@extends('layouts.app')


@section('content')
      <div {{-- class="main-panel" --}}>
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    @if (session('status'))
                      <div class="alert alert-danger text-center">{{session('status')}}</div>
                    @endif
                    <div class="card-header">
                        <h4 class="card-title">Harvests
                          @can('create-users')
                            <a href="{{ url('new/harvest') }}" class="btn btn-primary float-end">+ Harvest</a>
                          @endcan
                        </h4>
                    </div>
                  
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>
                            Sn No.
                          </th>
                          <th>
                            Cycle Name
                          </th>
                          <th>
                            Product
                          </th>
                          <th>
                            Customer
                          </th>
                          <th>
                            Harvest Date
                          </th>
                          <th>
                            Quantity Harvested (KGS)
                          </th>
                          <th>
                            Quantity Spoilt (KGS)
                          </th>
                          <th>
                            Remarks
                          </th>
                          {{-- @can('view-cycles')
                          <th>
                            Actions
                          </th>
                          @endcan --}}
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($harvests as $harvest)
                        <tr>
                          <td>
                            {{$harvest->id}}
                           </td>
                           <td>
                            {{$harvest->cycle->Cycle_Name}}
                           </td>
                           <td>
                            {{$harvest->cycle->Product}}
                           </td>
                           <td>
                            {{$harvest->Customer_Name}}
                           </td>
                           <td>
                            {{$harvest->harvest_date}}
                           </td>
                          <td>{{$harvest->quantity_harvested}} Kgs</td>
                          <td>{{$harvest->quantity_spoilt}} Kgs</td>
                          <td>
                            <div>{{$harvest->remarks}}</div>
                          </td>
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