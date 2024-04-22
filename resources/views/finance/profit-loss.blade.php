<!-- profit-loss.blade.php -->
@extends('layouts.app')

@section('content')
<div class="float-lg-right" style="width: 400px;">
    <select id="cycleSelect" class="form-select btn-sm">
        <option value="" selected>-- SELECT CYCLE --</option>
        @foreach($cycles as $cycle)
            <option value="{{ $cycle->Cycle_Id }}">{{ '('.$cycle->Cycle_Id.') '.$cycle->Cycle_Name }}</option>
        @endforeach
    </select>
</div>


<div id="profitAndLossData">
    <div>
        <h3>Profit and Loss Statement</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Total Revenue</td>
                    <td id="revenue"></td>
                </tr>
                <tr>
                    <td>Total Expenses</td>
                    <td id="expenses"></td>
                </tr>
                <tr>
                    <td>Profit or Loss</td>
                    <td id="profitOrLoss"></td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- <form action="{{ route('profit-loss.compare') }}" method="POST">
        @csrf
        <label for="cycle1">Cycle 1:</label>
        <select name="cycle1" id="cycle1">
            @foreach($cycles as $cycle)
                <option value="{{ $cycle->Cycle_Id }}">{{ $cycle->Cycle_Name }}</option>
            @endforeach
        </select>
        
        <label for="cycle2">Cycle 2:</label>
        <select name="cycle2" id="cycle2">
            @foreach($cycles as $cycle)
                <option value="{{ $cycle->Cycle_Id }}">{{ $cycle->Cycle_Name }}</option>
            @endforeach
        </select>
        
        <button type="submit">Compare</button>
    </form> --}}
    

    <div style="width: 400px; height: 400px;">
        <canvas id="profitLossChart"></canvas>
    </div>
    <!-- Add a div to render the chart -->
    <div id="comparisonChart"></div>

    
</div>

<script>
    var ctx = document.getElementById('profitLossChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Revenue', 'Expenses', 'Profit/Loss'],
            datasets: [{
                label: 'Amount',
                data: [0, 0, 0],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    $(document).ready(function() {
        $('#cycleSelect').change(function() {
            var cycleId = $(this).val();
            $.ajax({
                url: '/profit-loss/' + cycleId,
                type: 'GET',
                success: function(response) {
                    $('#revenue').text(response.revenue);
                    $('#expenses').text(response.expenses);
                    $('#profitOrLoss').text(response.profitOrLoss);

                    // Update the chart
                    myChart.data.datasets[0].data = [response.revenue, response.expenses, response.profitOrLoss];
                    myChart.update();
                }
            });
        });
    });

</script>
<script>
    document.getElementById('compareForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const form = this;
        const formData = new FormData(form);
        fetch('/compare', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Render the comparison chart using a charting library like Chart.js
            // Example:
            // renderComparisonChart(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
</script>
@endsection
