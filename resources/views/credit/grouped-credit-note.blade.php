<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credit Note</title>
    <style>
        @page {
            margin: 15px;
            font-size: 10px;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 15px;
            background-color: rgb(255, 231, 245);
        }
        .invoice-container {
            border: 1px solid black;
            padding: 10px;
            box-sizing: border-box;
            width: auto;
            height: auto;
        }
        .header-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .header-logo {
            flex-shrink: 0;
            margin-right: 10px;
        }
        .header-logo img {
            max-height: 60px;
            vertical-align: middle;
        }
        .header-text {
            flex: 1;
            text-align: left;
            color: #297233;
        }
        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            padding-right: 5px;
            text-align: right;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            text-align: right;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }
        .declaration, .notes {
            margin-top: 20px;
        }
        .signatures {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }
        .signature-item {
            flex: 1;
            text-align: center;
        }
        .signature-line {
            display: inline-block;
            width: 80%;
            border-bottom: 1px solid black;
            margin-top: 5px;
        }
        .bank-details-container {
            display: flex;
            justify-content: center; /* Center horizontally */
            margin-top: 20px;
            width: 100%; /* Ensure it takes full width */
        }
        .bank-details {
            width: 400px;
            border: 1px solid black;
            padding: 10px;
            font-size: 0.9em;
        }
        .bank-details p {
            margin: 0 0 5px 0;
        }
        .bank-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .bank-details td {
            padding: 2px 4px;
            border: 1px solid #ddd;
        }
        .bank-details td:first-child {
            font-weight: bold;
            width: 40%;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="header-container">
            <div class="header-logo">
                {{-- <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/marley.png'))) }}" alt="Centralrift"> --}}
            </div>
            <div class="header-text">
                <h4>CENTRALRIFT FRESH PRODUCE (K) LIMITED</h4>
                <p>P.O. Box 67891, 00200</p>
                <p>Nairobi, Kenya.</p>
                <p>Tel: +254 733 506881</p>
            </div>
        </div>
        <div style="text-align: center; text-decoration: underline;">
            <h3>CREDIT NOTE</h3>
        </div>        
        <div>
            <p><strong>COMPANY NAME:</strong></p>
            <p>{{$creditDetails->Source}}</p>
        </div>
        
        <div class="invoice-details">
            <div>
                <p><b>CREDIT DATE:</b> {{$creditDetails->created_at}}</p>
            </div>
        </div>
        
        <table style="text-align: right">
            <thead>
                <tr>
                    <th>Ref</th>
                    <th>DEDUCTIONS</th>
                    <th>Credit Amount</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalCredit = 0; // Initialize total price variable
                @endphp
                @foreach($credits as $credit)
                    <tr>
                        <td style="text-align: right;">{{ $loop->iteration }}</td>
                        <td style="text-align: right;">{{ $credit->Description }}</td>
                        <td style="text-align: right;">Ksh {{ number_format($credit->Amount, 0, '.', ',') }}</td>
                        @php
                            $totalCredit += $credit->Amount; // Accumulate total Credit
                        @endphp
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2"><b>Total Credit</b></td>
                    <td style="text-align: right;">Ksh {{ number_format($totalCredit, 0, '.', ',') }}</td>
                </tr>
            </tbody>
        </table>
        
        
        <div class="remarks-container" style="margin-top: 20px; border: 1px solid black; padding: 10px;">
            <h4 style="margin: 0; text-decoration: underline;">Remarks</h4>
            <p>{{$creditDetails->Remarks}}</p>
        </div>
        
        <div class="signatures" style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; width: 100%; box-sizing: border-box;">
            <div class="signature-item" style="flex: 1; padding: 0 10px; text-align: left;">
                <p style="margin: 0;">Place & Date:</p>
                <p style="margin: 0;">Nairobi/Kenya</p>
            </div>
            <div class="signature-item" style="flex: 1; padding: 0 10px; text-align: center;">
                <p style="margin: 0;">Signature & Name:</p><br>
                <span style="display: inline-block; width: 30%; border-bottom: 1px solid black; margin-top: 5px;"></span>
            </div>
            <div class="signature-item" style="flex: 1; padding: 0 10px; text-align: right;">
                <p style="margin: 0;">Company Stamp:</p><br>
                <span style="display: inline-block; width: 30%; border-bottom: 1px solid black; margin-top: 5px;"></span>
            </div>
        </div>
        <div class="notes">
            <p>Please note that any claims should be made within 48 hours of receiving the produce.</p>
            <p>Any claims raised after 48 hours will not be honoured</p>
        </div>
    </div>

    
</body>
</html>
