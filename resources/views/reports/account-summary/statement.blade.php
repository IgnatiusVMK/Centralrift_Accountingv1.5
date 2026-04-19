<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statement of Accounts</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #333;
            line-height: 1.4;
            display: flex;
            flex-direction: column;
        }
        .company-header {
            text-align: center;
            margin-bottom: 15px;
        }
        .company-name {
            font-size: 16px;
            font-weight: bold;
        }
        .company-tagline {
            font-style: italic;
            margin-bottom: 10px;
            color: #555;
        }
        .statement-title {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 20px;
            text-decoration: underline;
        }
        .address-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .address-box {
            width: 48%;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }
        .address-title {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .bank-details {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }
        .bank-title {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .bank-info {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 5px 15px;
        }
        .bank-label {
            font-weight: bold;
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

        /* PDF Container */
        .pdf-container {
            width: 90%;
            margin: 0 auto;
            padding-left: 20px;
            padding-right: 20px;
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }

    </style>
</head>
<body>
    <div class="pdf-container">
        <div class="company-header">
            <div class="company-name">Centralrift Fresh Produce Kenya Limited</div>
            <div class="company-tagline">growing for you</div>
        </div>

        <div class="statement-title">Statement of Account</div>

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

        <table border="1" cellpadding="5" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>S/No.</th>
                    <th>DATE</th>
                    <th>INVOICE NO.</th>
                    <th>AMOUNT ({{$invoices->first()->currency ?? 'KSH'}})</th>
                    {{-- <th>FREIGHT</th> --}}
                    <th>PRODUCT</th>
                </tr>
            </thead>
            <tbody>
                @php
                    // Prepare grouped lists: vegetables first, then herbs & basil combined
                    $vegetables = [];
                    $others = []; // herbs others + basil & thai

                    foreach ($invoices as $invoice) {
                        $assigned = false;
                        foreach ($invoice->items as $item) {
                            $categoryId = $item->product?->Category_Id ?? null;
                            $productName = trim($item->product?->Product_Name ?? '');

                            if ($categoryId == 2) {
                                $vegetables[$invoice->id] = ['invoice' => $invoice, 'product' => $productName ?: 'Vegetable'];
                                $assigned = true;
                                break;
                            }

                            if ($categoryId == 1 && in_array($productName, ['Basil', 'Thai Basil'])) {
                                $others[$invoice->id] = ['invoice' => $invoice, 'product' => 'Basil & Thai'];
                                $assigned = true;
                                break;
                            }

                            if ($categoryId == 1) {
                                $others[$invoice->id] = ['invoice' => $invoice, 'product' => 'Herbs Others'];
                                $assigned = true;
                                break;
                            }
                        }

                        // if no matching item/category, put into others as uncategorized (optional)
                        if (!$assigned) {
                            $others[$invoice->id] = ['invoice' => $invoice, 'product' => 'Uncategorized'];
                        }
                    }

                    // Totals
                    $vegAmount = 0; $vegFreight = 0;
                    foreach ($vegetables as $row) {
                        $inv = $row['invoice'];
                        $amt = $inv->invoice_amount ?? $inv->total ?? 0;
                        $fr = $inv->freight ?? 0;
                        $vegAmount += (float)$amt;
                        $vegFreight += (float)$fr;
                    }

                    $othAmount = 0; $othFreight = 0;
                    foreach ($others as $row) {
                        $inv = $row['invoice'];
                        $amt = $inv->invoice_amount ?? $inv->total ?? 0;
                        $fr = $inv->freight ?? 0;
                        $othAmount += (float)$amt;
                        $othFreight += (float)$fr;
                    }

                    $grandAmount = $vegAmount + $othAmount;
                    /* $grandFreight = $vegFreight + $othFreight; */

                    // serial number continues across sections
                    $sn = 1;
                @endphp

                {{-- Vegetables Section --}}
                @if(count($vegetables))
                    @foreach($vegetables as $row)
                        @php $inv = $row['invoice']; $productLabel = $row['product']; @endphp
                        <tr>
                            <td style="text-align:center;">{{ $sn++ }}</td>
                            <td style="text-align:center;">{{ \Carbon\Carbon::parse($inv->date)->format('d/m/Y') }}</td>
                            <td style="text-align:center;">{{ $inv->invoice_number }}</td>
                            <td style="text-align:right;">{{ number_format($inv->invoice_amount ?? $inv->total ?? 0, 2) }}</td>
                            {{-- <td style="text-align:right;">{{ number_format($inv->freight ?? 0, 2) }}</td> --}}
                            <td style="text-align:left;">{{ $productLabel }}</td>
                        </tr>
                    @endforeach

                    {{-- Vegetables subtotal --}}
                    <tr>
                        <td colspan="3" style="text-align:right;"><strong>SUBTOTAL (Vegetables)</strong></td>
                        <td style="text-align:right;"><strong>{{ number_format($vegAmount, 2) }}</strong></td>
                        {{-- <td style="text-align:right;"><strong>{{ number_format($vegFreight, 2) }}</strong></td> --}}
                        <td></td>
                    </tr>

                    {{-- blank separator line --}}
                    <tr><td colspan="5">&nbsp;</td></tr>
                @endif

                {{-- Herbs & Basil Section (together) --}}
                @if(count($others))
                    @foreach($others as $row)
                        @php $inv = $row['invoice']; $productLabel = $row['product']; @endphp
                        <tr>
                            <td style="text-align:center;">{{ $sn++ }}</td>
                            <td style="text-align:center;">{{ \Carbon\Carbon::parse($inv->date)->format('d/m/Y') }}</td>
                            <td style="text-align:center;">{{ $inv->invoice_number }}</td>
                            <td style="text-align:right;">{{ number_format($inv->invoice_amount ?? $inv->total ?? 0, 2) }}</td>
                            {{-- <td style="text-align:right;">{{ number_format($inv->freight ?? 0, 2) }}</td> --}}
                            <td style="text-align:left;">{{ $productLabel }}</td>
                        </tr>
                    @endforeach

                    {{-- Herbs subtotal --}}
                    <tr>
                        <td colspan="3" style="text-align:right;"><strong>SUBTOTAL (Herbs & Basil)</strong></td>
                        <td style="text-align:right;"><strong>{{ number_format($othAmount, 2) }}</strong></td>
                        {{-- <td style="text-align:right;"><strong>{{ number_format($othFreight, 2) }}</strong></td> --}}
                        <td></td>
                    </tr>
                @endif

                {{-- Grand Total --}}
                <tr>
                    <td colspan="3" style="text-align:right;"><strong>TOTAL</strong></td>
                    <td style="text-align:right;"><strong>{{ number_format($grandAmount, 2) }}</strong></td>
                    {{-- <td style="text-align:right;"><strong>{{ number_format($grandFreight, 2) }}</strong></td> --}}
                    <td></td>
                </tr>
            </tbody>
        </table>

        <div class="bank-details" style="position: relative; padding: 20px; border: 1px solid #ddd; width: 500px;">
            <!-- Bank Details -->
            <div class="bank-info" style="line-height: 1.5;">
                <span class="bank-label" style="font-weight: bold;">Account Name:</span>
                <span>Centralrift Fresh Produce (K) Limited</span><br>

                <span class="bank-label" style="font-weight: bold;">Bank Name:</span>
                <span>Diamond Trust Bank K Limited</span><br>

                <span class="bank-label" style="font-weight: bold;">Branch:</span>
                <span>DTB Centre</span><br>

                <span class="bank-label" style="font-weight: bold;">Account No:</span>
                <span>0264200003</span><br>

                <span class="bank-label" style="font-weight: bold;">Bank Swift Code:</span>
                <span>DTKEKENA</span>
            </div>

            <!-- Stamp overlay -->
            <img 
                src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/cfpkl_invoice_e-stamp.png'))) }}" 
                alt="Company Stamp"
                style="
                    position: absolute;
                    top: 10px;       /* Adjust vertical position */
                    right: 10px;     /* Adjust horizontal position */
                    max-width: 250px;
                    opacity: 0.9;    /* Optional: make it semi-transparent */
                    transform: rotate(-10deg); /* Optional: slight rotation for realism */
                "
            >
        </div>

        <!-- Stamp overlay -->
            <img 
                src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/cfpkl_invoice_e-stamp.png'))) }}" 
                alt="Company Stamp"
                style="
                    position: absolute;
                    top: 150px;       /* Adjust vertical position */
                    right: 150px;     /* Adjust horizontal position */
                    max-width: 275px;
                    opacity: 1;    /* Optional: make it semi-transparent */
                    transform: rotate(-5deg); /* Optional: slight rotation for realism */
                "
            >



        <div class="footer">
            <div class="contact-info">
                Email: info@centralriftfpkl.com | marketing@centralriftfpkl.com<br>
                Website: www.centralriftfpkl.com | WhatsApp: +254722491615
            </div>
            
            <div class="social-media">
                <span class="social-icon">Twitter(X): @CentralrifftFPKL</span>
                <span class="social-icon">Instagram: @centralrifft.fpkl</span>
                <span class="social-icon">Tiktok: @centralrifft.fpkl</span>
                <span class="social-icon">Facebook: @Centralrifft FPKL</span>
            </div>
        </div>

        <div class="confidential-footer">
            © {{ date('Y') }} Centralrift Fresh Produce Kenya LTD. Confidential Report<br>
            Generated by: {{ Auth::user()->name }} on: {{ now()->format('d M Y, h:i A') }}
        </div>
    </div>

</body>
</html>