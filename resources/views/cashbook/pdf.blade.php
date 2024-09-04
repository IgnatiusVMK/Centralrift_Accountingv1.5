<?php

use Carbon\Carbon;
// Get current date and time
$days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

$timezone = Carbon::now('Africa/Nairobi');
$currentDate = new DateTime($timezone);

$day = $days[$currentDate->format('w')];
$date = $currentDate->format('d');
$month = $currentDate->format('m');
$year = $currentDate->format('Y');
$hours = $currentDate->format('H');
$minutes = $currentDate->format('i');
$seconds = $currentDate->format('s');

$currentDateTime = $day . ', ' . $date . '/' . $month . '/' . $year . '<br>' . $hours . ':' . $minutes . ':' . $seconds;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Centralrift-Kenya-LTD</title>
    <style>
        /* Custom inline styles */
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        .max-w-7xl {
            max-width: 80rem; /* 1280px */
            margin-right: auto;
            margin-left: auto;
            padding-right: 1rem;
            padding-left: 1rem;
        }

        .p-6 {
            padding: 1.5rem;
        }

        .lg\:p-8 {
            padding: 2rem;
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .items-right {
        display: flex;
        justify-content: flex-end;
        align-items: flex-start;
        text-align: right; 
        }


        .border-l-2 {
            border-left-width: 2px;
        }

        .border-gray-400 {
            border-color: #CBD5E0;
        }

        .text-xl {
            font-size: 1.25rem;
        }

        .font-bold {
            font-weight: 700;
        }

        .text-gray-800 {
            color: #2D3748;
        }

        .main-panel {
            margin-top: 2rem;
        }

        .content-wrapper {
            padding: 1rem;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -0.5rem;
            margin-left: -0.5rem;
        }

        .col {
            flex: 1;
            padding-right: 0.5rem;
            padding-left: 0.5rem;
        }

        .col-lg-12 {
            flex-basis: 100%;
            max-width: 100%;
        }

        .grid-margin {
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        .stretch-card {
            width: 100%;
        }

        .summary-card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            max-width: 450px;
            word-wrap: break-word;
            background-color: #b4b4b4;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
        }
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #FFFFFF;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
        }

        .summary-card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: #b4b4b4;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }
        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: #FFFFFF;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }

        .text-success {
            color: #4CAF50;
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1.25rem;
        }

        .card-title {
            margin-bottom: 0.5rem;
            font-size: 1.25rem; /* 20px */
        }

        .text-center {
            text-align: center;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #2D3748;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #E2E8F0;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #E2E8F0;
        }

        .table tbody + tbody {
            border-top: 2px solid #E2E8F0;
        }

        .table .table {
            background-color: #F7FAFC;
        }

        .table-sm th,
        .table-sm td {
            padding: 0.3rem;
        }

        .table-bordered {
            border: 1px solid #E2E8F0;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #E2E8F0;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body>
    <div class="main-panel">
      <div class="row">
        <div class="col text-end">
            <h1 class="items-right">Centralrift-Kenya-LTD</h1>
            <h2 class="items-right">Kajiado, Kenya.</h2>
            <h2 style="text-align: right;" id="datetime"><?php echo $currentDateTime; ?></h2>
        </div>
      </div>

      <div class="summary-card w-50">
        <h1 class="summary-card-header text-success" style="color: brown">Summary of Accounts</h1>
        <div class="card-body">
          <p>Total Credited Amount: Ksh {{ $totalCredit }}</p>
          <p>Total Debited Amount: Ksh {{ $totalDebit }}</p>
          <p>Available Balance: Ksh {{ $balance }}</p>
        </div>
    </div>
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">                      
                        <div class="card-body">
                            <div class="card-header">
                                <h4 class="card-title text-center">CashBook Monthly Reports</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sn No.</th>
                                            <th>Transaction ID</th>
                                            <th>Cycle</th>
                                            <th>Description</th>
                                            <th>Credit Amount</th>
                                            <th>Debit Amount</th>
                                            <th>Balance Estimate</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cashbook as $cbk)
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
