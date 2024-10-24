@extends('layouts.app')
@php
$currentDate= new DateTime();
@endphp

@section('content')
</nav>
            <div class="col-sm-12">
              <div class="home-tab">
                @can('create-reports')
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#audiences" role="tab" aria-selected="false">Audiences</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#demographics" role="tab" aria-selected="false">Demographics</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link border-0" id="more-tab" data-bs-toggle="tab" href="#more" role="tab" aria-selected="false">More</a>
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
                @endcan
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="statistics-details d-flex align-items-center justify-content-between">
                          <div>
                            <p class="statistics-title">Today's Date</p>
                            <h3 class="rate-percentage">{{$currentDate->format('Y-m-d')}}</h3>
                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>-0.5%</span></p>
                          </div>
                          <div>
                            <p class="statistics-title">Last Login</p>
                            <h3 class="rate-percentage">7,682</h3>
                            <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+0.1%</span></p>
                          </div>
                          <div>
                            <p class="statistics-title">New Sessions</p>
                            <h3 class="rate-percentage">68.8</h3>
                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p>
                          </div>
                          <div class="d-none d-md-block">
                            <p class="statistics-title">Avg. Time on Site</p>
                            <h3 class="rate-percentage">2m:35s</h3>
                            <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span></p>
                          </div>
                          <div class="d-none d-md-block">
                            <p class="statistics-title">New Sessions</p>
                            <h3 class="rate-percentage">68.8</h3>
                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p>
                          </div>
                          <div class="d-none d-md-block">
                            <p class="statistics-title">Avg. Time on Site</p>
                            <h3 class="rate-percentage">2m:35s</h3>
                            <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span></p>
                          </div>
                        </div>
                      </div>
                    </div> 
                    <div class="row">
                      <div class="col-lg-8 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                   <h4 class="card-title card-title-dash">Performance Line Chart</h4>
                                   <h5 class="card-subtitle card-subtitle-dash">Purchases and Sales made this Month.</h5>
                                  </div>
                                  <div id="performance-line-legend"></div>
                                </div>
                                <div class="chartjs-wrapper mt-5">
                                  <canvas id="performaneLine"></canvas>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                                <div class="card-body pb-0">
                                    <h4 class="card-title card-title-dash text-black mb-4">Account Balance Summary</h4>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="account-summary-chart-wrapper pb-4" style="position: relative;">
                                                <canvas id="account-summary"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                          <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="d-flex justify-content-between align-items-center mb-2 mb-sm-0">
                                      <div class="circle-progress-width">
                                        <div id="totalVisitors" class="progressbar-js-circle pr-2"></div>
                                      </div>
                                      <div>
                                        <p class="text-small mb-2">Total Sales</p>
                                        <h4 class="mb-0 fw-bold">{{$countSales}}</h4>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="d-flex justify-content-between align-items-center">
                                      <div class="circle-progress-width">
                                        <div id="visitperday" class="progressbar-js-circle pr-2"></div>
                                      </div>
                                      <div>
                                        <p class="text-small mb-2">Total Cycles</p>
                                        <h4 class="mb-0 fw-bold">{{$countOrders}}</h4>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-8 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Market Overview</h4>
                                   <p class="card-subtitle card-subtitle-dash">Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
                                  </div>
                                  @can('view-financials')
                                  <div>
                                    <div class="dropdown">
                                      <button class="btn btn-secondary dropdown-toggle toggle-dark btn-lg mb-0 me-0" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> This month </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                        <h6 class="dropdown-header">Settings</h6>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Separated link</a>
                                      </div>
                                    </div>
                                  </div>
                                  @endcan
                                </div>
                                @can('view-financials')
                                <div class="d-sm-flex align-items-center mt-1 justify-content-between">
                                  <div class="d-sm-flex align-items-center mt-4 justify-content-between"><h2 class="me-2 fw-bold">$36,2531.00</h2><h4 class="me-2">USD</h4><h4 class="text-success">(+1.37%)</h4></div>
                                  <div class="me-3"><div id="marketing-overview-legend"></div></div>
                                </div>
                                <div class="chartjs-bar-wrapper mt-3">
                                  <canvas id="marketingOverview"></canvas>
                                </div>
                                @endcan
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded table-darkBGImg">
                              <div class="card-body">
                                <div class="col-sm-8">
                                  <h3 class="text-white upgrade-info mb-0">
                                    Enhance your <span class="fw-bold">Campaign</span> for better outreach
                                  </h3>
                                  <a href="#" class="btn btn-info upgrade-btn">Market Your Business with Us!</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Pending Harvests</h4>
                                  </div>
                                </div>
                                <div class="table-responsive  mt-1">
                                  <table class="table select-table">
                                    <thead>
                                      <tr>
                                        <th>
                                          <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                                          </div>
                                        </th>
                                        <th>Customer</th>
                                        <th>Product</th>
                                        <th>Planting Date</th>
                                        <th>Harvest Date</th>
                                        <th>Progress</th>
                                        <th>Status</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        @foreach($harvestOrders as $harvest)
                                        <td>
                                          <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="d-flex ">
                                            {{-- <img src="images/faces/face1.jpg" alt=""> --}}
                                            <div>
                                              <h6>{{ $harvest->Cycle_Id }}</h6>
                                              <p>{{ $harvest->order_date }}</p>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <div>
                                            <h6>{{ $harvest->product_name}}</h6>
                                          </div>
                                        </td>
                                        <td>
                                          <div>
                                            <h6>{{ $harvest->planting_date }}</h6>
                                            <p class="text-success">Elapsed Days: {{ $harvest->progress['elapsed_days'] }}</p>
                                          </div>
                                        </td>
                                        <td>
                                          <h6>{{ $harvest->harvest_date }}</h6>
                                          <p class="text-danger">Remaining Days: {{ $harvest->progress['remaining_days'] }}</p>
                                        </td>
                                        <td>
                                          <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                            <p>Done:</p>
                                            <p>{{ $harvest->progress['percentage'] }} %</p>
                                          </div>
                                          <div class="progress">
                                            <div class="progress-bar
                                                @if ($harvest->progress['percentage'] == 0)
                                                    bg-danger
                                                @elseif ($harvest->progress['percentage'] < 100)
                                                    bg-warning
                                                @else
                                                    bg-success
                                                @endif"
                                                role="progressbar"
                                                style="width: {{ $harvest->progress['percentage'] }}%;"
                                                aria-valuenow="{{ $harvest->progress['percentage'] }}"
                                                aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          @if ($harvest->progress['percentage'] == 0)
                                            <div class="badge badge-opacity-danger">Pending</div>
                                          @elseif ($harvest->progress['percentage'] < 100)
                                            <div class="badge badge-opacity-warning">In Progress</div>
                                          @else
                                            <div class="badge badge-opacity-success">Completed</div>
                                          @endif
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
                        <div class="row flex-grow">
                          <div class="col-md-6 col-lg-6 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body card-rounded table-responsive">
                                <h4 class="card-title card-title-dash">Recent Harvests</h4>
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th>Company :</th>
                                      <th>Product:</th>
                                      <th>Status :</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($completedHarvestOrders as $completed)
                                    <tr>
                                      <td>
                                        {{$completed->company_name}}
                                        <br>
                                        <p class="mb-0 text-small text-muted">{{$completed->Cycle_Id}}</p>
                                      </td>
                                      <td>
                                        {{$completed->product_name}}
                                        <p class="mb-0 text-small text-muted">Harvested On: {{$completed->harvest_date}}</p>
                                      </td>
                                      <td>
                                        <div class="badge badge-opacity-success float-end">Completed</div>
                                      </td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>                              
                                {{-- <div class="list align-items-center pt-3">
                                  <div class="wrapper w-100">
                                    <p class="mb-0">
                                      <a href="#" class="fw-bold text-primary">Show all <i class="mdi mdi-arrow-right ms-2"></i></a>
                                    </p>
                                  </div>
                                </div> --}}
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-lg-6 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                  <h4 class="card-title card-title-dash">Activities</h4>
                                  <p class="mb-0">20 finished, 5 remaining</p>
                                </div>
                                <ul class="bullet-line-list">
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">Ben Tossell</span> assign you a task</div>
                                      <p>Just now</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">Oliver Noah</span> assign you a task</div>
                                      <p>1h</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">Jack William</span> assign you a task</div>
                                      <p>1h</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">Leo Lucas</span> assign you a task</div>
                                      <p>1h</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">Thomas Henry</span> assign you a task</div>
                                      <p>1h</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">Ben Tossell</span> assign you a task</div>
                                      <p>1h</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">Ben Tossell</span> assign you a task</div>
                                      <p>1h</p>
                                    </div>
                                  </li>
                                </ul>
                                <div class="list align-items-center pt-3">
                                  <div class="wrapper w-100">
                                    <p class="mb-0">
                                      <a href="#" class="fw-bold text-primary">Show all <i class="mdi mdi-arrow-right ms-2"></i></a>
                                    </p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                      <h4 class="card-title card-title-dash">Todo list</h4>
                                      <div class="add-items d-flex mb-0">
                                        <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?">
                                        <button class="add btn btn-icons btn-rounded btn-primary todo-list-add-btn text-white me-0 pl-12p"><i class="mdi mdi-plus"></i></button>
                                      </div>
                                    </div>
                                    <div class="list-wrapper">
                                      <ul class="todo-list todo-list-rounded">
                                        @foreach($harvestOrders as $harvest)
                                        <li class="d-block">
                                          <div class="form-check w-100">
                                            <label class="form-check-label">
                                              <input class="checkbox" type="checkbox"> Product Harvest for : <b>{{$harvest->company_name}} ( {{$harvest->Cycle_Id}} )</b> <i class="input-helper rounded"></i>
                                            </label>
                                            <div class="d-flex mt-2">
                                              <div class="ps-4 text-small me-3">Product: {{$harvest->product_name}}</div>
                                              <div class="badge badge-opacity-warning me-3">Due: {{ $harvest->harvest_date }}</div>
                                              <i class="mdi mdi-flag ms-2 flag-color"></i>
                                            </div>
                                          </div>
                                        </li>
                                        @endforeach
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        @can('view-financials')
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                      <h4 class="card-title card-title-dash">Money In/Money Out</h4>
                                    </div>
                                    <canvas id="myChart" width="400" height="400"></canvas>
                                    <div id="doughnut-chart-legend" class="mt-5 text-center"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        @endcan
                        @can('view-reports')
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                      <div>
                                        <h4 class="card-title card-title-dash">Leave Report</h4>
                                      </div>
                                      <div>
                                        <div class="dropdown">
                                          <button class="btn btn-secondary dropdown-toggle toggle-dark btn-lg mb-0 me-0" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Month Wise </button>
                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                            <h6 class="dropdown-header">week Wise</h6>
                                            <a class="dropdown-item" href="#">Year Wise</a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="mt-3">
                                      <canvas id="leaveReport"></canvas>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        @endcan
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                      <div>
                                        <h4 class="card-title card-title-dash">Top Product</h4><hr>
                                      </div>
                                    </div>
                                    <div class="mt-3">
                                      @foreach($cyclesByProduct as $cycle)
                                        <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                          <div class="d-flex">
                                            {{-- <img class="img-sm rounded-10" src="images/faces/face1.jpg" alt="profile"> --}}
                                            <div class="wrapper ms-3">
                                                <p class="ms-1 mb-1 fw-bold">Product/Crop: {{ $cycle->product_name }}</p>
                                                <small class="text-muted mb-0">Number of Cycles: {{ $cycle->cycle_count }}</small>
                                            </div>
                                          </div>
                                          <div class="text-muted text-small">
                                            1h ago
                                          </div>
                                        </div>
                                      @endforeach
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <script>
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Total Credit Amount', 'Total Debit Amount', 'Balance'],
                        datasets: [{
                            label: 'Amount',
                            data: [{!! $totalCredit !!}, {!! $totalDebit !!}, {!! $balance !!}],
                            backgroundColor: [
                              'rgba(0, 0, 255, 0.8)', 
                              'rgba(255, 0, 0, 0.8)', 
                              'rgba(0, 180, 0, 0.8)'
                            ]
                        }]
                    },
                    options: {
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                boxWidth: 20,
                                fontStyle: 'bold'
                            }
                        }
                    }
                });
            </script>
            <script>
              window.labels = {!! json_encode($dates->map(function($date) {
                  return (new DateTime($date))->format('M-d'); // Convert string to DateTime
              })) !!}; // Keep as Collection
              window.totalAccCredit = {!! json_encode($totalAccCredit) !!};
              window.totalAccDebit = {!! json_encode($totalAccDebit) !!};
          </script>
          
          <script>
            $(document).ready(function() {
                if ($("#account-summary").length) {
                    var statusSummaryChartCanvas = document.getElementById("account-summary").getContext('2d');
            
                    // Create gradient for Credit Amount
                    var creditGradient = statusSummaryChartCanvas.createLinearGradient(0, 0, 0, 400);
                    creditGradient.addColorStop(0, 'rgba(76, 175, 80, 0.3)');  // Starting shade (semi-transparent)
                    creditGradient.addColorStop(1, 'rgba(76, 175, 80, 0.01)'); // Fading to transparent
            
                    // Create gradient for Debit Amount
                    var debitGradient = statusSummaryChartCanvas.createLinearGradient(0, 0, 0, 400);
                    debitGradient.addColorStop(0, 'rgba(244, 67, 54, 0.4)');   // Starting shade (semi-transparent)
                    debitGradient.addColorStop(1, 'rgba(244, 67, 54, 0.02)'); // Fading to transparent
            
                    var statusData = {
                        labels: window.labels,  // Use the global variable for labels
                        datasets: [
                            {
                                label: 'Credit Amount',
                                data: window.totalAccCredit,  // Use the global variable here
                                backgroundColor: creditGradient,  // Use gradient for fill
                                borderColor: '#4CAF50',
                                borderWidth: 1.5,
                                fill: true,  // Enable fill for the fading effect
                                pointRadius: 4,
                                pointHoverRadius: 6,
                            },
                            {
                                label: 'Debit Amount',
                                data: window.totalAccDebit,  // Use the global variable here
                                backgroundColor: debitGradient,  // Use gradient for fill
                                borderColor: '#F44336',
                                borderWidth: 1.5,
                                fill: true,  // Enable fill for the fading effect
                                pointRadius: 4,
                                pointHoverRadius: 6,
                            }
                        ]
                    };
            
                    var statusSummaryChart = new Chart(statusSummaryChartCanvas, {
                        type: 'line',
                        data: statusData,
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                x: {
                                    display: true,
                                    title: {
                                        display: true,
                                        text: 'Date',
                                        color: '#333',
                                        font: {
                                            size: 14,
                                            weight: 'bold'
                                        }
                                    },
                                    grid: {
                                        display: false,  // No vertical grid lines
                                    },
                                    ticks: {
                                        color: '#333',
                                        font: {
                                            size: 12,
                                        },
                                    }
                                },
                                y: {
                                    title: {
                                        display: true,
                                        text: 'Amount',
                                        color: '#333',
                                        font: {
                                            size: 14,
                                            weight: 'bold'
                                        }
                                    },
                                    grid: {
                                        display: true,
                                        drawBorder: false,
                                        color: "#F0F0F0", // Light grid color for y-axis
                                        zeroLineColor: '#F0F0F0',
                                    },
                                    ticks: {
                                        color: '#333',
                                        font: {
                                            size: 12
                                        },
                                        beginAtZero: true,
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    labels: {
                                        color: '#333',
                                        font: {
                                            size: 14,
                                            weight: 'bold'
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            });
            </script>
            
        
        
         
            <script>
              console.log("Total Account Credit: ", totalAccCredit);
              console.log("Total Account Debit: ", totalAccDebit);
            </script>
                          
@endsection