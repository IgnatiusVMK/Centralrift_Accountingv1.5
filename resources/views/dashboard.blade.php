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
                            <p class="statistics-title">Total Customers</p>
                            <h3 class="rate-percentage">{{ number_format($totalCustomers) }}</h3>
                            <p class="text-success d-flex"><i class="mdi mdi-account"></i><span>Active</span></p>
                          </div>
                          <div>
                            <p class="statistics-title">Total Invoices</p>
                            <h3 class="rate-percentage">{{ number_format($totalInvoices) }}</h3>
                            <p class="text-success d-flex"><i class="mdi mdi-file-document"></i><span>All Time</span></p>
                          </div>
                          <div>
                            <p class="statistics-title">Total Revenue</p>
                            <h3 class="rate-percentage">${{ number_format($totalRevenue, 2) }}</h3>
                            <p class="text-success d-flex"><i class="mdi mdi-currency-usd"></i><span>Sales</span></p>
                          </div>
                          <div class="d-none d-md-block">
                            <p class="statistics-title">Total Purchases</p>
                            <h3 class="rate-percentage">${{ number_format($totalPurchases, 2) }}</h3>
                            <p class="text-danger d-flex"><i class="mdi mdi-cart"></i><span>Expenses</span></p>
                          </div>
                          <div class="d-none d-md-block">
                            <p class="statistics-title">Total Sales</p>
                            <h3 class="rate-percentage">{{ number_format($countSales) }}</h3>
                            <p class="text-success d-flex"><i class="mdi mdi-chart-line"></i><span>Approved</span></p>
                          </div>
                          <div class="d-none d-md-block">
                            <p class="statistics-title">Account Balance</p>
                            <h3 class="rate-percentage">${{ number_format($balance, 2) }}</h3>
                            <p class="text-{{ $balance >= 0 ? 'success' : 'danger' }} d-flex"><i class="mdi mdi-wallet"></i><span>Current</span></p>
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
                                <div class="chartjs-wrapper mt-5" style="position: relative;">
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
                                    <h4 class="card-title card-title-dash">Financial Summary</h4>
                                   <p class="card-subtitle card-subtitle-dash">Overview of your financial status</p>
                                  </div>
                                </div>
                                @can('view-financials')
                                <div class="row mt-4">
                                  <div class="col-md-4">
                                    <div class="card bg-primary text-white">
                                      <div class="card-body">
                                        <h6 class="card-title">Total Credit</h6>
                                        <h3 class="mb-0">${{ number_format($totalCredit, 2) }}</h3>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="card bg-danger text-white">
                                      <div class="card-body">
                                        <h6 class="card-title">Total Debit</h6>
                                        <h3 class="mb-0">${{ number_format($totalDebit, 2) }}</h3>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="card bg-{{ $balance >= 0 ? 'success' : 'warning' }} text-white">
                                      <div class="card-body">
                                        <h6 class="card-title">Account Balance</h6>
                                        <h3 class="mb-0">${{ number_format($balance, 2) }}</h3>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="row mt-3">
                                  <div class="col-md-6">
                                    <div class="card">
                                      <div class="card-body">
                                        <h6>Total Revenue</h6>
                                        <h4 class="text-success">${{ number_format($totalRevenue, 2) }}</h4>
                                        <small class="text-muted">From approved sales</small>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="card">
                                      <div class="card-body">
                                        <h6>Total Expenses</h6>
                                        <h4 class="text-danger">${{ number_format($totalPurchases, 2) }}</h4>
                                        <small class="text-muted">From approved purchases</small>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                @endcan
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
                                        <p class="mb-0 text-small text-muted">Cycle Start: {{$completed->planting_date}}</p>
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
                                  <h4 class="card-title card-title-dash">Recent Activities</h4>
                                  <p class="mb-0">{{ count($recentActivities) }} activities</p>
                                </div>
                                <ul class="bullet-line-list">
                                  @forelse($recentActivities as $activity)
                                    <li>
                                      <div class="d-flex justify-content-between">
                                        <div>
                                          <i class="mdi mdi-{{ $activity['type'] === 'invoice' ? 'file-document' : 'cash' }} mr-2"></i>
                                          <span class="text-light-green">{{ $activity['description'] }}</span>
                                        </div>
                                        <p>{{ $activity['time'] }}</p>
                                      </div>
                                    </li>
                                  @empty
                                    <li>
                                      <div class="d-flex justify-content-between">
                                        <div><span>No recent activities</span></div>
                                      </div>
                                    </li>
                                  @endforelse
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
                                        <h4 class="card-title card-title-dash">Sales vs Purchases ({{ $yearlySalesPurchases['year'] ?? date('Y') }})</h4>
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
              
              <!-- Performance Line Chart Script -->
              <script>
                $(document).ready(function() {
                    if ("#performaneLine" && $("#performaneLine").length) {
                        var performanceCanvasEl = document.getElementById("performaneLine");
                        var performanceLineCanvas = performanceCanvasEl.getContext('2d');

                        // Expect ISO date strings (YYYY-MM-DD) from controller
                        var salesLabels = {!! json_encode($monthlySalesData['labels']) !!} || [];
                        var salesData = {!! json_encode($monthlySalesData['data']) !!} || [];
                        var purchasesLabels = {!! json_encode($monthlyPurchasesData['labels']) !!} || [];
                        var purchasesData = {!! json_encode($monthlyPurchasesData['data']) !!} || [];

                        // Combine labels and sort chronologically
                        var allLabels = Array.from(new Set([...salesLabels, ...purchasesLabels]));
                        allLabels.sort(function(a, b) { return new Date(a) - new Date(b); });

                        // Map data to combined labels
                        var salesMapped = allLabels.map(function(label) {
                            var index = salesLabels.indexOf(label);
                            return index !== -1 ? salesData[index] : 0;
                        });

                        var purchasesMapped = allLabels.map(function(label) {
                            var index = purchasesLabels.indexOf(label);
                            return index !== -1 ? purchasesData[index] : 0;
                        });

                        // If no meaningful data, show a friendly message instead of an empty chart
                        var totalSales = salesMapped.reduce(function(a,b){return a+b;}, 0);
                        var totalPurchases = purchasesMapped.reduce(function(a,b){return a+b;}, 0);

                        if (totalSales === 0 && totalPurchases === 0) {
                            // create overlay message
                            var parent = performanceCanvasEl.parentNode;
                            if (!parent.querySelector('.no-data-overlay')) {
                                var msg = document.createElement('div');
                                msg.className = 'no-data-overlay';
                                msg.style.cssText = 'position:absolute;left:0;right:0;top:40px;bottom:0;display:flex;align-items:center;justify-content:center;color:#666;pointer-events:none;';
                                msg.innerText = 'No sales or purchases data for the selected period';
                                parent.appendChild(msg);
                            }
                            return; // don't draw empty chart
                        }

                        // Format labels for display (e.g., 'Dec 30')
                        var displayLabels = allLabels.map(function(d) {
                            var dt = new Date(d);
                            return dt.toLocaleDateString(undefined, { month: 'short', day: 'numeric' });
                        });

                        var performanceData = {
                            labels: displayLabels,
                            datasets: [
                                {
                                    label: 'Sales',
                                    data: salesMapped,
                                    borderColor: '#4CAF50',
                                    backgroundColor: 'rgba(76, 175, 80, 0.1)',
                                    borderWidth: 2,
                                    fill: true,
                                    tension: 0.4
                                },
                                {
                                    label: 'Purchases',
                                    data: purchasesMapped,
                                    borderColor: '#F44336',
                                    backgroundColor: 'rgba(244, 67, 54, 0.1)',
                                    borderWidth: 2,
                                    fill: true,
                                    tension: 0.4
                                }
                            ]
                        };

                        var maxVal = Math.max.apply(null, salesMapped.concat(purchasesMapped));
                        var suggestedMax = maxVal > 0 ? Math.ceil(maxVal * 1.1) : undefined;

                        var performanceLineChart = new Chart(performanceLineCanvas, {
                            type: 'line',
                            data: performanceData,
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top'
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        suggestedMax: suggestedMax,
                                        ticks: {
                                            callback: function(value) {
                                                return '$' + value.toLocaleString();
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
                if (document.getElementById('myChart')) {
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Total Credit Amount', 'Total Debit Amount', 'Balance'],
                            datasets: [{
                                label: 'Amount',
                                data: [{!! $totalCredit ?? 0 !!}, {!! $totalDebit ?? 0 !!}, {!! $balance ?? 0 !!}],
                                backgroundColor: [
                                  'rgba(0, 0, 255, 0.8)', 
                                  'rgba(255, 0, 0, 0.8)', 
                                  'rgba(0, 180, 0, 0.8)'
                                ]
                            }]
                        },
                        options: {
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'bottom',
                                    labels: {
                                        boxWidth: 20,
                                        font: { weight: 'bold' }
                                    }
                                }
                            }
                        }
                    });
                }
            </script>
            <script>
              // Data for yearly bar chart (leaveReport) — consumed by public/js/dashboard.js
              window.leaveReportLabels = {!! json_encode($yearlySalesPurchases['labels'] ?? []) !!};
              window.leaveReportSales = {!! json_encode($yearlySalesPurchases['sales'] ?? []) !!};
              window.leaveReportPurchases = {!! json_encode($yearlySalesPurchases['purchases'] ?? []) !!};
            </script>
            <script>
              // Pass raw ISO dates to JS; formatting will be done client-side
              window.labels = {!! json_encode($dates) !!};
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
            
                    // Format x-axis labels from ISO dates to short month-day
                    var creditData = Array.isArray(window.totalAccCredit) ? window.totalAccCredit.map(Number) : [];
                    var debitData = Array.isArray(window.totalAccDebit) ? window.totalAccDebit.map(Number) : [];

                    var statusData = {
                        labels: (window.labels || []).map(function(d) { 
                            var dt = new Date(d); 
                            return dt.toLocaleDateString(undefined, { month: 'short', day: 'numeric' });
                        }),
                        datasets: [
                            {
                                label: 'Credit Amount',
                                data: creditData,  // Use the global variable here
                                backgroundColor: creditGradient,  // Use gradient for fill
                                borderColor: '#4CAF50',
                                borderWidth: 1.5,
                                fill: true,  // Enable fill for the fading effect
                                pointRadius: 4,
                                pointHoverRadius: 6,
                            },
                            {
                                label: 'Debit Amount',
                                data: debitData,  // Use the global variable here
                                backgroundColor: debitGradient,  // Use gradient for fill
                                borderColor: '#F44336',
                                borderWidth: 1.5,
                                fill: true,  // Enable fill for the fading effect
                                pointRadius: 4,
                                pointHoverRadius: 6,
                            }
                        ]
                    };

                    // If no data available, show a friendly message instead of an empty chart
                    var totalCredit = creditData.reduce(function(a,b){return a+b;}, 0);
                    var totalDebit = debitData.reduce(function(a,b){return a+b;}, 0);
                    if (totalCredit === 0 && totalDebit === 0) {
                        var parent = statusSummaryChartCanvas.canvas.parentNode;
                        if (!parent.querySelector('.no-data-overlay')) {
                            var msg = document.createElement('div');
                            msg.className = 'no-data-overlay';
                            msg.style.cssText = 'position:absolute;left:0;right:0;top:40px;bottom:0;display:flex;align-items:center;justify-content:center;color:#666;pointer-events:none;';
                            msg.innerText = 'No account activity in the selected period';
                            parent.appendChild(msg);
                        }
                        return;
                    }

                    var maxVal = Math.max.apply(null, creditData.concat(debitData));
                    var suggestedMax = maxVal > 0 ? Math.ceil(maxVal * 1.1) : undefined;
            
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