<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{-- Centralrift {{$CustomerInvoiceDetails->Customer_Name}} Inv-{{$invoiceDetails->Sale_Date}} --}}</title>
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
        .footer {
            margin-top: 30px;
            font-size: 11px;
            color: #555;
            text-align: center;
            padding: 10px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
        .contact-info {
            margin-bottom: 5px;
        }
        .social-media {
            margin-top: 10px;
        }
        .social-icon {
            margin: 0 5px;
            font-size: 14px;
        }
        .confidential-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            padding: 10px;
            border-top: 1px solid #ccc;
            font-size: 12px;
            background: #fff; /* ensures it’s readable over any table */
        }


        hr {
            margin: 20px auto;
            width: 80%;
            border: 0;
            border-top: 1px solid #aaa;
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
            <h3>INVOICE</h3>
        </div>        
        <div class="address-container">
            @if($customer->invoicable && $customer->invoiceAddress)
                <div class="address-box">
                    <div class="address-title">Invoice To:</div>

                    <b>{{ $customer->Customer_Name }}</b><br>

                    @if(!empty($customer->invoiceAddress->ship_AddressLine1))
                        <b>{{ $customer->invoiceAddress->ship_AddressLine1 }}</b><br>
                    @endif

                    @if(!empty($customer->invoiceAddress->ship_AddressLine2))
                        <b>{{ $customer->invoiceAddress->ship_AddressLine2 }}</b><br>
                    @endif

                    @if(!empty($customer->invoiceAddress->ship_City))
                        <b>{{ $customer->invoiceAddress->ship_City }}</b><br>
                    @endif

                    @if(!empty($customer->invoiceAddress->ship_Region_State) || !empty($customer->invoiceAddress->ship_PostalCode))
                        <b>{{ $customer->invoiceAddress->ship_Region_State ?? '' }}</b>{{ !empty($customer->invoiceAddress->ship_Region_State) && !empty($customer->invoiceAddress->ship_PostalCode) ? ', ' : '' }}<b>{{ $customer->invoiceAddress->ship_PostalCode ?? '' }}</b><br>
                    @endif

                    @if(!empty($customer->invoiceAddress->ship_Country))
                        <b>{{ $customer->invoiceAddress->ship_Country }}</b>
                    @endif
                </div><br>
            @endif

            
            <div class="address-box">
                <div class="address-title">Ship To:</div>
                <b>{{ $customer->Customer_Name }}</b><br>

                @if(!empty($customer->AddressLine1))
                    <b>{{ $customer->AddressLine1 }}</b><br>
                @endif

                @if(!empty($customer->AddressLine2))
                    <b>{{ $customer->AddressLine2 }}</b><br>
                @endif

                @if(!empty($customer->City))
                    <b>{{ $customer->City }}</b><br>
                @endif

                @if(!empty($customer->Region_State) || !empty($customer->PostalCode))
                    <b>{{ $customer->Region_State ?? '' }}</b>{{ !empty($customer->Region_State) && !empty($customer->PostalCode) ? ', ' : '' }}<b>{{ $customer->PostalCode ?? '' }}</b><br>
                @endif

                @if(!empty($customer->Country))
                    <b>{{ $customer->Country }}</b>
                @endif

            </div>
        </div>

       <div class="invoice-details">
            <div>
                <p><b>Invoice No:</b> {{$invoice->invoice_number}}</p>
                <p><b>Date:</b> {{$invoice->date}}</p>
                <p><b>Order No:</b> {{$invoice->order_number}}</p>
                <p><b>Delivery No:</b> {{-- {{$invoice->date}} --}}</p>
                <p><b>Product:</b>{{--  {{$invoice->items>produ}} --}}</p>
            </div>
        </div>
        
        <table style="text-align: right">
            <thead>
                <tr>
                    <th>Ref</th>
                    <th>Packaging</th>
                    <th>Description of Goods</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
    @foreach($invoice->items->where('type', 'commercial') as $item)
        <tr>
            <td style="text-align: right;">{{ $item->id }}</td>
            <td style="text-align: right;">{{ $item->quantity ?? '' }}</td>
            <td style="text-align: right;">{{ $item->description }}</td>                                      
            <td style="text-align: right;">{{ $item->unit_price }}</td>
            <td style="text-align: right;">{{ $item->total }}</td>
        </tr>
    @endforeach

    <tr>
        <td colspan="4" style="text-align: right;"><strong>Total</strong></td>
        <td style="text-align: right;">
            {{ number_format($invoice->items->sum('total'), 2, '.', ',') }}
        </td>
    </tr>
</tbody>

        </table>

        <img 
                src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/cfpkl_invoice_e-stamp.png'))) }}" 
                alt="Company Stamp"
                style="
                    position: absolute;
                    bottom: 250px;       /* Adjust vertical position */
                    right: 10px;     /* Adjust horizontal position */
                    max-width: 250px;
                    opacity: 1.0;    /* Optional: make it semi-transparent */
                    transform: rotate(-10deg); /* Optional: slight rotation for realism */
                "
            >
        
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
    
    <div class="footer">
            <div class="contact-info">
                Email: info@centralriftfpkl.com | marketing@centralriftfpkl.com<br>
                Website: www.centralriftfpkl.com | WhatsApp: +254722491615
            </div>
        </div>

        <div class="confidential-footer">
            © {{ date('Y') }} Centralrift Fresh Produce Kenya LTD.<br>
            Generated by: {{ Auth::user()->name }} on: {{ now()->format('d M Y, h:i A') }}
        </div>
</body>
</html>
