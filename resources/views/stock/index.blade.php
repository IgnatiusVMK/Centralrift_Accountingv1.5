@extends('layouts.app')
@section('content')
<div class="container">
    <div class="float-lg-right;" style="width: 1000px;">
        <h2>Inventory Levels: Total, Allocated, and Remaining</h2>
        <canvas id="stockChart" width="400" height="200"></canvas>
    </div><br>
    <div id="stockandInventory">
        <div>
            <h3>Stock and Inventory Statement</h3>
            <table class="table">
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
                          <td style="font-size: 18px">{{$stock->Stock_Name}}</td>
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
                backgroundColor: 'rgba(135,206,250,0.5)',
                data: @json($totalQuantities), // Dynamic total quantities
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
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Quantity',
                    font: {
                        size: 18 
                    }
                },
                ticks: {
                    font: {
                        size: 14
                    }
                }
            },
            x: {
                ticks: {
                    font: {
                        size: 14 // Font size for X-axis labels (stock names)
                    }
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
