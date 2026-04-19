@foreach ($sales as $sale)
<tr>
    <td>
        <input type="checkbox" name="selected_invoices[]" value="{{ $sale->Sales_Id }}" class="invoice-checkbox">
    </td>
    <td>{{$sale->id}}</td>
    <td>
        <b>Cycle:</b> {{$sale->Cycle_Id}} <br><br>
        {{$sale->Sales_Id}}
    </td>
    <td>{{$sale->customer->Customer_Name}}</td>
    <td>{{$sale->Description}}</td>
    <td>{{$sale->Net_Weight}} Kg</td>
    <td>{{$sale->Currency}} {{$sale->Total_Price}}</td>
    <td class="@if($sale->Payment_Status == 'Un-paid') text-danger @elseif($sale->Payment_Status == 'Paid') text-success @else text-warning @endif">
        {{$sale->Payment_Status}}
    </td>
    <td>{{$sale->Sale_Date}}</td>
</tr>
@endforeach
