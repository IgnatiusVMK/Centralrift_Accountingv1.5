<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commercial Invoice</title>
    <style>
        @page {
            margin: 15px;
            font-size: 10px;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 15px;
            background-color: rgb(255, 255, 255);
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
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/marley.png'))) }}" alt="Centralrift">
            </div>
            <div class="header-text">
                <h4>CENTRALRIFT FRESH PRODUCE KENYA LTD</h4>
                <p>P.O. Box 67891, 00200</p>
                <p>Nairobi, Kenya.</p>
                <p>Tel: +254 712 345678</p>
            </div>
        </div>
        <div style="text-align: center; text-decoration: underline;">
            <h3>COMMERCIAL INVOICE</h3>
        </div>        
        <div>
            <p><strong>Consignee:</strong></p>
            <p>[CONSIGNEE DETAILS]</p>
        </div>
        
        <div class="invoice-details">
            <div>
                <p><b>CUSTOMER INVOICE NO:</b> INV-09-09-2024</p>
                <p><b>LPO NUMBER:</b> {{ $invoiceDetails['Lpo_No'] }}</p>
                <p><b>DELIVERY DATE: </b>{{ $invoiceDetails['Sale_Date'] }} </p>
                <p>MAWB: [NUMBER]</p>
                <p>Flight No.: [NUMBER]</p>
                <p>EURO 1: [NUMBER]</p>
                <p>Agent: [NAME]</p>
            </div>
        </div>
        
        <table style="text-align: right">
            <thead>
                <tr>
                    <th>Ref</th>
                    <th>No.of cartons</th>
                    <th>Packaging</th>
                    <th>Description of Goods</th>
                    <th>Net Weight (kgs)</th>
                    {{-- <th>Gross Weight (kgs)</th> --}}
                    <th>Unit Price Euros</th>
                    <th>Total price Euros CIF</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: right;">1</td>
                    <td style="text-align: right;">{{ $sales['No_of_Boxes'] }}</td>
                    <td style="text-align: right;">
                        @if($sales['packaging_option'] == '3Kg')
                            30gms * 100
                        @elseif($sales['packaging_option'] == '1Kg')
                            100gms * 10
                        @else
                            {{ $sales['packaging_option'] }}
                        @endif
                    </td>                                      
                    <td style="text-align: right;">{{ $sales['Description'] }}</td>
                    <td style="text-align: right;">{{ $sales['Net_Weight'] }} Kg</td>
                    {{-- <td>1575.00</td> --}}
                    <td style="text-align: right;">22.00</td>
                    <td style="text-align: right;">{{ $sales['Total_Price'] }}</td>
                </tr>
                <tr>
                    <td colspan="4">Total</td>
                    <td style="text-align: right;">{{ $sales['Net_Weight'] }} Kg</td>
                    <td></td>
                    {{-- <td>1,575.00</td> --}}
                    <td style="text-align: right;">{{ $sales['Total_Price'] }}</td>
                </tr>
            </tbody>
        </table>
        
        <div class="declaration">
            <p>The exporter of the product covered by this document declares that, except where otherwise clearly indicated, these products are of Kenyan preferential origin according to the rules of origin of the European Community</p>
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

    <div class="bank-details-container" style="text-align: center; margin-top: 20px;">
        <div class="bank-details" style="display: inline-block; text-align: left; width: 400px; border: 1px solid black; padding: 10px; font-size: 0.9em;">
            <p><b>PIN NO: [NUMBER]</b></p>
            <table style="width: 100%; border-collapse: collapse;">
                <tr><td style="font-weight: bold; width: 40%; padding: 2px 4px; border: 1px solid #ddd;">Account Name</td><td style="padding: 2px 4px; border: 1px solid #ddd;">Centralrift Fresh Produce Kenya</td></tr>
                <tr><td style="font-weight: bold; width: 40%; padding: 2px 4px; border: 1px solid #ddd;">Bank</td><td style="padding: 2px 4px; border: 1px solid #ddd;">[BANK NAME]</td></tr>
                <tr><td style="font-weight: bold; width: 40%; padding: 2px 4px; border: 1px solid #ddd;">Currency</td><td style="padding: 2px 4px; border: 1px solid #ddd;">[CURRENCY]</td></tr>
                <tr><td style="font-weight: bold; width: 40%; padding: 2px 4px; border: 1px solid #ddd;">Account Number</td><td style="padding: 2px 4px; border: 1px solid #ddd;">[NUMBER]</td></tr>
                <tr><td style="font-weight: bold; width: 40%; padding: 2px 4px; border: 1px solid #ddd;">Branch</td><td style="padding: 2px 4px; border: 1px solid #ddd;">[BRANCH NAME]</td></tr>
                <tr><td style="font-weight: bold; width: 40%; padding: 2px 4px; border: 1px solid #ddd;">Bank Code</td><td style="padding: 2px 4px; border: 1px solid #ddd;">[CODE]</td></tr>
                <tr><td style="font-weight: bold; width: 40%; padding: 2px 4px; border: 1px solid #ddd;">Branch Code</td><td style="padding: 2px 4px; border: 1px solid #ddd;">[CODE]</td></tr>
                <tr><td style="font-weight: bold; width: 40%; padding: 2px 4px; border: 1px solid #ddd;">Swift Code</td><td style="padding: 2px 4px; border: 1px solid #ddd;">[CODE]</td></tr>
            </table>
        </div>
    </div>
</body>
</html>
