@extends('layouts.app')
@section('content')
@include('layouts.export')
<div {{-- class="main-panel" --}}>
    <div {{-- class="content-wrapper" --}}>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-danger text-center">{{session('status')}}</div>
                        @endif
                        <div class="card-header">
                            <h4 class="card-title">Monthly Sales</h4>
                        </div>
                        @can('view-sales')
                        <form id="invoiceForm">
                            @csrf
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" id="selectAll">
                                            </th>
                                            <th>
                                                Sn No.
                                            </th>
                                            <th>
                                                Sales ID
                                            </th>
                                            <th>
                                                Customer
                                            </th>
                                            <th>
                                                Details
                                            </th>
                                            <th>
                                                Net Weight
                                            </th>
                                            <th>
                                                Total Price
                                            </th>
                                            <th>
                                                Payment Status
                                            </th>
                                            <th>
                                                Delivery Date
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3">
                                <button type="button" class="btn btn-primary" id="generateInvoicesBtn" disabled data-toggle="modal" data-target="#generateOptionsModal">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Generate Selected Invoices
                                </button>
                                <span id="selectedCount" class="ml-2">0 selected</span>
                            </div>
                        </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Generate Options Modal -->
<div class="modal fade" id="generateOptionsModal" tabindex="-1" role="dialog" aria-labelledby="generateOptionsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="generateOptionsModalLabel">Generate Documents</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="documentOptionsForm" action="{{ route('generate.multiple.invoices') }}" method="POST">
                    @csrf
                    <input type="hidden" name="selected_invoices" id="selectedInvoicesInput">
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="generateInvoice" name="generate_invoice" value="1" checked>
                            <label class="form-check-label" for="generateInvoice">Generate Sales Invoice</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="generateDeliveryNote" name="generate_delivery_note" value="1" checked>
                            <label class="form-check-label" for="generateDeliveryNote">Generate Delivery Note</label>
                        </div>
                    </div>
                    <!-- Other form fields if any -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitDocuments">Generate</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
    // Initialize select all functionality
    $('#selectAll').change(function() {
        $('.invoice-checkbox').prop('checked', this.checked);
        updateSelectedCount();
    });

    // Handle individual checkbox changes
    $(document).on('change', '.invoice-checkbox', function() {
        if (!this.checked) {
            $('#selectAll').prop('checked', false);
        }
        updateSelectedCount();
    });

    // Update selected count display
    function updateSelectedCount() {
        const selectedCount = $('.invoice-checkbox:checked').length;
        $('#selectedCount').text(selectedCount + ' selected');
        $('#generateInvoicesBtn').prop('disabled', selectedCount === 0);
    }

    // Handle modal submission
    $('#submitDocuments').click(function() {
        const selectedIds = $('.invoice-checkbox:checked').map(function() {
            return $(this).val();
        }).get();
        
        if (selectedIds.length === 0) {
            alert('Please select at least one invoice');
            return;
        }

        $('#selectedInvoicesInput').val(JSON.stringify(selectedIds));
        $('#documentOptionsForm').submit();
    });
});
</script>
@endsection