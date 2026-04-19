@foreach ($invoices as $index => $invoice)
    @php
        $groupedItems = $invoice->items->groupBy('type');
    @endphp

    @foreach ($groupedItems as $type => $itemsGroup)
    <tr>
        <td>
            <input type="checkbox" name="selected_invoices[]" value="{{ $invoice->id }}" class="invoice-checkbox">
        </td>
        <td>
            {{ $invoice->invoice_number }}
        </td>
        <td>{{ $invoice->order_number }}</td>
        <td>{{ $invoice->customer->Customer_Name ?? 'N/A' }}</td>
        <td>
            <strong>
                {{ ucfirst($type) }} Invoice:</strong>
            <ul>
                @foreach ($itemsGroup as $item)
                    <li>
                        {{ $item->product->Product_Name ?? 'Unknown Product' }} -
                        {{ $item->description }} -
                        {{ $item->weight }} kg @ {{ $item->unit_price }}
                    </li>
                @endforeach
            </ul>
        </td>
        <td>{{ $itemsGroup->sum('weight') }} Kg</td>
        <td>{{ $itemsGroup->sum('total') }}</td>
        <td>{{ $invoice->date }}</td>
    </tr>
    @endforeach
@endforeach

<script>
    // Submit the form automatically to load PDF via POST
    document.getElementById('pdfForm').submit();
</script>
