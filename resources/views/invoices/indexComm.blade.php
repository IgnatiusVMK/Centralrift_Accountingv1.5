@extends('layouts.app')
@section('content')

<div class="col-sm-12">
    <div class="home-tab">
        <div class="d-sm-flex align-items-center justify-content-between border-bottom">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                </li>
            </ul>
            <div>
                <div class="btn-wrapper">
                    <form id="filterForm" method="GET" action="{{ route('invoice.indexComm') }}">
                        <div class="row mb-3">
                            <div class="col-md-6">
                            <input 
                                type="text" 
                                name="search" 
                                id="searchInput" 
                                class="form-control" 
                                placeholder="Search invoices or customers..." 
                                value="{{ request('search') }}"
                            >
                            </div>
                            <div class="col-md-5">
                            <input 
                                type="month" 
                                name="month" 
                                id="monthInput" 
                                class="form-control" 
                                value="{{ request('month', date('Y-m')) }}" 
                            >
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    <div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success text-center">{{ session('status') }}</div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger text-center">{{ session('error') }}</div>
                        @endif

                        <div class="card-header">
                            <h4 class="card-title">Monthly Invoices</h4>
                        </div>

                        <form id="invoiceForm">
                            @csrf
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="selectAll"></th>
                                            {{-- <th>Sn No.</th> --}}
                                            <th>Invoice Number</th>
                                            <th>Order Number</th>
                                            <th>Customer</th>
                                            <th>Details</th>
                                            <th>Net Weight</th>
                                            <th>Total Price</th>
                                            <th>Invoice Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoices as $index => $invoice)
                                            @php
                                                $groupedItems = $invoice->items->groupBy('type');
                                            @endphp

                                            @foreach ($groupedItems as $type => $itemsGroup)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="selected_invoices[]" value="{{ $invoice->id }}" class="invoice-checkbox">
                                                </td>
                                                {{-- <td>{{ $index + 1 }}</td> --}}
                                                <td>
                                                <a href="{{ route('invoice.show', ['customer_id' => $invoice->customer_id, 'invoice_number' => $invoice->invoice_number]) }}">
                                                    {{ $invoice->invoice_number }}
                                                    <i class="mdi mdi-border-color"></i>
                                                </a>
                                                </td>
                                                <td>{{ $invoice->order_number }}</td>
                                                <td>{{ $invoice->customer->Customer_Name ?? 'N/A' }}</td>
                                                <td>
                                                    <strong>{{ ucfirst($type) }} Invoice:</strong>
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
                                                <td>{{ $itemsGroup->first()->currency ?? 'N/A' }} {{ $itemsGroup->sum('total') }}</td>
                                                <td>{{ $invoice->date }}</td>
                                            </tr>
                                            @endforeach
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
                <form id="documentOptionsForm" action="{{ route('generate.commercialinvoices.multiple') }}" method="POST">
                    @csrf
                    <input type="hidden" name="selected_invoices" id="selectedInvoicesInput">
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="generateInvoice" name="generate_invoice" value="1" checked>
                            <label class="form-check-label" for="generateInvoice">Generate Commercial Invoice</label>
                        </div>
                        {{-- <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="generateDeliveryNote" name="generate_delivery_note" value="0">
                            <label class="form-check-label" for="generateDeliveryNote">Generate Delivery Note</label>
                        </div> --}}
                    </div>
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
    $(document).ready(function () {
        $('#selectAll').change(function () {
            $('.invoice-checkbox').prop('checked', this.checked);
            updateSelectedCount();
        });

        $(document).on('change', '.invoice-checkbox', function () {
            if (!this.checked) {
                $('#selectAll').prop('checked', false);
            }
            updateSelectedCount();
        });

        function updateSelectedCount() {
            const selectedCount = $('.invoice-checkbox:checked').length;
            $('#selectedCount').text(selectedCount + ' selected');
            $('#generateInvoicesBtn').prop('disabled', selectedCount === 0);
        }

        $('#submitDocuments').click(function () {
            const selectedIds = $('.invoice-checkbox:checked').map(function () {
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

<script>
$(document).ready(function() {
    let debounceTimer;

    function fetchInvoices() {
        const search = $('#searchInput').val();
        const month = $('#monthInput').val();

        $.ajax({
            url: "{{ route('invoices.ajaxSearchComm') }}",
            method: 'GET',
            data: { search: search, month: month },
            success: function(response) {
                $('tbody').html(response.html);
                updateSelectedCount();
            },
            error: function() {
                alert('Error fetching invoices.');
            }
        });
    }

    $('#searchInput').on('keyup', function() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(fetchInvoices, 500);
    });

    $('#monthInput').on('change', function() {
        fetchInvoices();
    });

    // Keep your checkbox & selectAll logic here or refactor to support dynamically loaded rows
    function updateSelectedCount() {
        const selectedCount = $('.invoice-checkbox:checked').length;
        $('#selectedCount').text(selectedCount + ' selected');
        $('#generateInvoicesBtn').prop('disabled', selectedCount === 0);
    }

    $('#selectAll').change(function () {
        $('.invoice-checkbox').prop('checked', this.checked);
        updateSelectedCount();
    });

    $(document).on('change', '.invoice-checkbox', function () {
        if (!this.checked) {
            $('#selectAll').prop('checked', false);
        }
        updateSelectedCount();
    });

    // Initialize counts on page load
    updateSelectedCount();
});
</script>


@endsection
