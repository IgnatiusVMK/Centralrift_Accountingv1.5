@extends('layouts.app')

@section('content')
<div class="container">
    <div class="float-lg-right;" style="width: 1000px;">
        <h2>Inventory Levels: Total, Allocated, and Remaining</h2>
        <canvas id="stockChart" width="400" height="200"></canvas>
    </div><br>
    <div id="stockandInventory">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            Stock and Inventory Statement
                        </h3>
                    </div>
                
                    <div class="card-body">
                        <!-- Add a responsive wrapper around the table -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="font-size: 22px">Description</th>
                                        <th style="font-size: 22px">Quantity</th>
                                        <th style="font-size: 22px">Remaining Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stock_act_vals as $stock)
                                        <tr>
                                        <td style="font-size: 18px"><b>{{$stock->Stock_Name}}</b></td>
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
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div> <!-- End of table-responsive -->
                    </div>
                </div>
            </div>
        </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('stockChart').getContext('2d');

    var stockData = {
        labels: @json($stockNames), // Dynamic stock names
        datasets: [
            {
                label: 'Total Stock',
                backgroundColor: 'rgba(135,206,250,0.7)', // Slightly more opaque
                data: @json($totalQuantities),
                barPercentage: 0.7, 
                categoryPercentage: 0.6 // Adjust the spacing between groups
            },
            {
                label: 'Allocated Stock',
                backgroundColor: 'rgba(255,165,0,0.5)',
                data: @json($allocatedQuantities), // Dynamic allocated quantities
            },
            {
                label: 'Remaining Stock',
                backgroundColor: 'rgba(34,139,34,0.5)',
                data: @json($remainingQuantities), // Dynamic remaining quantities
            }
        ]
    };

    var stockChart = new Chart(ctx, {
    type: 'bar',
    data: stockData,
    options: {
        responsive: true,
    scales: {
        y: {
            type: 'logarithmic', // Change the y-axis type to logarithmic
            beginAtZero: true,
            title: {
                display: true,
                text: 'Quantity (Logarithmic Scale)',
                font: {
                    size: 18
                }
            },
            ticks: {
                callback: function (value, index, values) {
                    if (value === 0) return 0;
                    const logValue = Math.log10(value);
                    if (Number.isInteger(logValue)) {
                        return value; // Show powers of 10 as integers
                    }
                    return ''; // Hide other fractional log values
                }
            }
        },
        x: {
            ticks: {
                font: {
                    size: 12 // Adjust as needed
                },
                autoSkip: true, // Prevent labels from overlapping
                maxRotation: 90, // Rotate labels up to 90 degrees
                minRotation: 45, // Start rotating if needed
                align: 'right' // Adjust alignment after rotation
            }
        }
    },
        plugins: {
            legend: {
                labels: {
                    font: {
                        size: 14
                    }
                }
            },
            title: {
                display: true,
                text: 'Inventory Levels Overview',
                font: {
                    size: 20
                }
            }
        }
    }
});
</script>
@endsection
