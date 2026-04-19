<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Note-{{$CustomerInvoiceDetails->Customer_Name}} Inv-{{$invoiceDetails->Sale_Date}}</title>
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
            <h3>DELIVERY NOTE</h3>
        </div>        
        
        <div>
            <p><strong>Consignee:</strong></p>
            @if($CustomerInvoiceDetails->Customer_Name)
                <p><b>{{ trim($CustomerInvoiceDetails->Customer_Name) }}</b></p>
            @endif

            @if($CustomerInvoiceDetails->AttentionTo)
                <p><b>{{ trim($CustomerInvoiceDetails->AttentionTo) }},</b></p>
            @endif

            @if($CustomerInvoiceDetails->AddressLine1)
                <p><b>{{ trim($CustomerInvoiceDetails->AddressLine1) }},</b></p>
            @endif

            @if($CustomerInvoiceDetails->AddressLine2)
                <p><b>{{ trim($CustomerInvoiceDetails->AddressLine2) }},</b></p>
            @endif

            @if($CustomerInvoiceDetails->City)
                <p><b>{{ trim($CustomerInvoiceDetails->City) }},</b></p>
            @endif

            @if($CustomerInvoiceDetails->PostalCode)
                <p><b>{{ trim($CustomerInvoiceDetails->PostalCode) }},</b></p>
            @endif

            @if($CustomerInvoiceDetails->Region_State)
                <p><b>{{ trim($CustomerInvoiceDetails->Region_State) }},</b></p>
            @endif

            @if($CustomerInvoiceDetails->Country)
                <p><b>{{ trim($CustomerInvoiceDetails->Country) }}</b></p>
            @endif
        </div>
        
        <div class="invoice-details">
            <div>
                <p><b>DELIVERY DATE: </b>{{ $invoiceDetails->Sale_Date }}</p>
            </div>
        </div>
        
        <table style="text-align: right">
            <thead>
                <tr>
                    <th>Ref</th>
                    @foreach($sales as $sale)
                        @if ($sale->packaging_option === '30 * 1 Tray')
                            <th>Quantity</th>
                    @elseif ($sale->packaging_option === '1Kg (100gms x 10)' || $sale->packaging_option === '3Kg (30gms x 100)' || $sale->packaging_option === '2Kg (150gms x 14)' || $sale->packaging_option === '1Kg (75gms x 14)' || $sale->packaging_option === '1.5Kg (150gms x 10)' || $sale->packaging_option === 'Crates')
                            <th>No.of Boxes</th>
                        @endif
                        <th>Packaging</th>
                        <th>Description of Goods</th>
                        @if ($sale->packaging_option === '30 * 1 Tray')
                            <th>Net Tray(s)</th>
                        @elseif ($sale->packaging_option === '1Kg (100gms x 10)' || $sale->packaging_option === '3Kg (30gms x 100)' || $sale->packaging_option === '2Kg (150gms x 14)' || $sale->packaging_option === '1Kg (75gms x 14)' || $sale->packaging_option === '1.5Kg (150gms x 10)' || $sale->packaging_option === 'Crates')
                            <th>Net Weight (kgs)</th>
                        @endif
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($sales as $sale)
                <tr>
                    <td style="text-align: right;">1</td>
                    <td style="text-align: right;">{{ $sale->Quantity_of_packages }}</td>
                    <td style="text-align: right;">
                        @switch($sale->packaging_option)
                            @case('1Kg (100gms x 10)')
                                100gms * 10
                                @break
                            @case('1.5Kg (150gms x 10)')
                                150gms * 10
                                @break
                            @case('1Kg (75gms x 14)')
                                75gms * 14
                                @break
                            @case('2.1Kg (150gms x 14)')
                                150gms * 14
                                @break
                            @default
                                {{ $sale->packaging_option }}
                        @endswitch
                    </td>
                    <td style="text-align: right;">{{ $sale->Description }}</td>
                    @if ($sale->packaging_option === '30 * 1 Tray')
                        <td style="text-align: right;">{{ $sale->Quantity }} Trays</td>
                    @else
                        <td style="text-align: right;">{{ $sale->Net_Weight }} Kg</td>
                    @endif
                </tr>
                @endforeach
                <tr>
                    <td colspan="4">Total</td>
                    @foreach($sales as $sale)
                        @if ($sale->packaging_option === '30 * 1 Tray')
                            <td style="text-align: right;">{{ $sale->Quantity }} Trays</td>
                        @else
                            <td style="text-align: right;">{{ $sale->Net_Weight }} Kg</td>
                        @endif
                    @endforeach
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
</body>
</html>