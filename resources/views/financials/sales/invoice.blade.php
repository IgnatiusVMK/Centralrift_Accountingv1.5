<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .invoice-container {
            width: 100%;
            margin: 10px auto;
            background-color: white;
            padding: 10px;
            border-radius: 4px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header img {
            width: 150px;
            margin-right: 5px; 
            padding-right: 5px;
            border-right: 2px solid #ddd;
        }

        .header h6 {
            font-size: 18px;
            margin: 0;
            padding-left: 5px; 
            white-space: nowrap;
        }
        .header .unpaid {
            color: white;
            background-color: red;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .invoice-details {
            margin-top: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }
        .invoice-details h2 {
            margin: 0;
        }
        .details {
            margin-top: 10px;
        }
        .details table {
            width: 100%;
            margin-top: 20px;
        }
        .details th, .details td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        .details th {
            background-color: #f9f9f9;
        }
        .totals {
            margin-top: 20px;
        }
        .totals table {
            width: 100%;
        }
        .totals th, .totals td {
            padding: 8px;
        }
        .totals .sub-total, .totals .vat, .totals .total {
            text-align: right;
        }
        .transactions {
            margin-top: 20px;
        }
        .transactions table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }
        .transactions th, .transactions td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>

<div class="invoice-container">
    <!-- Header Section -->
    <div class="header">
        <div>
            {{-- <img src="{{ url('/images/marley.png') }}" alt="Company Logo"> --}}
            <h6>Centralrift Fresh Produce Kenya LTD</h6>
        </div>
        <div class="unpaid">UNPAID</div>
    </div>

    <!-- Invoice Details -->
    <div class="invoice-details">
        <h2>Invoice # {{-- {{}} --}}</h2>
        <p>Invoice Date: {{-- {{}} --}}</p>
        <p>Due Date: {{-- {{}} --}}</p>

        <div class="to">
            <strong>Invoiced To:</strong>
            <p>
                {{-- {{}} --}}<br>
                {{-- {{}} --}}<br>
                {{-- 67891-00200<br> --}}
                Nairobi, Kenya
            </p>
        </div>
    </div>

    <!-- Item Details -->
    <div class="details">
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{-- TrueHost Silver SSD Hosting - vimak-infotech-labs.co.ke (03/09/2024 - 02/09/2025) --}}</td>
                    <td>Ksh {{-- {{}} --}}</td>
                </tr>
                <tr>
                    <td>{{-- {{}} --}}</td>
                    <td>{{-- {{}} --}}</td>
                </tr>
               {{--  <tr>
                    <td>AutoPay Discount</td>
                    <td>-Ksh 175.00</td>
                </tr> --}}
            </tbody>
        </table>
    </div>

    <!-- Totals -->
    <div class="totals">
        <table>
            <tbody>
                <tr>
                    <td></td>
                    <td class="sub-total">Sub Total:</td>
                    <td>Ksh {{--  --}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="vat">16.00% Kenyan VAT:</td>
                    <td>Ksh {{--  --}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="total">Total:</td>
                    <td><strong>Ksh {{--  --}}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Transactions -->
    <div class="transactions">
        <h3>Transactions</h3>
        <table>
            <thead>
                <tr>
                    <th>Transaction Date</th>
                    <th>Gateway</th>
                    <th>Transaction ID</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4">No Related Transactions Found</td>
                </tr>
            </tbody>
        </table>
        <p>Balance: Ksh {{--  --}}</p>
    </div>
    @php
        $dateTimeZone = new DateTimeZone('Africa/Nairobi');
    @endphp
    <p>PDF Generated on {{ now($dateTimeZone)->format('jS M, Y | h:i A T') }}</p>
</div>

</body>
</html>
