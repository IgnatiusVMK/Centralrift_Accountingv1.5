@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Invoice Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Card and tabs */
        .card {
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
            border-radius: 10px;
            margin-top: 20px;
        }
        .home-tab { padding: 20px 0; }
        .nav-tabs .nav-link {
            border: none;
            border-bottom: 3px solid transparent;
            color: #6c757d;
            font-weight: 500;
            padding: 10px 15px;
        }
        .nav-tabs .nav-link.active {
            color: #0d6efd;
            border-bottom: 3px solid #0d6efd;
            background: transparent;
        }

        /* Buttons */
        .btn-wrapper { display: flex; gap: 10px; }
        .btn-primary { background-color: #0d6efd; border: none; }
        .btn-outline-dark { border: 1px solid #6c757d; color: #6c757d; }
        .btn-outline-dark:hover { background-color: #6c757d; color: white; }

        /* Filter section */
        .filter-section {
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
            margin-bottom: 20px;
        }

        /* PDF iframe container */
        .iframe-container {
            height: 80vh;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f8f9fa;
            position: relative;
            overflow: hidden;
        }
        .iframe-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: #6c757d;
        }
        .iframe-placeholder i { font-size: 32px; margin-bottom: 15px; }
        iframe { border: none; width: 100%; height: 100%; }

        /* Loading spinner overlay */
        .loading-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: rgba(255,255,255,0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            display: none;
        }
        .spinner-border { width: 3rem; height: 3rem; }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="col-sm-12">
            <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">
                                Overview
                            </a>
                        </li>
                    </ul>

                    <div class="btn-wrapper">
                        <form id="printForm" action="{{-- {{ route('customerstatement.downloadPdf') }} --}}" method="POST" target="_blank" class="d-inline">
                            @csrf
                            <input type="hidden" name="customer_id" id="printCustomerId"> 
                            <button type="submit" class="btn btn-outline-dark">
                                <i class="fas fa-print"></i> Print
                            </button>
                        </form>

                        <button type="button" class="btn btn-primary text-white me-0">
                            <i class="fas fa-envelope"></i> Email
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- PDF Preview -->
        <div class="iframe-container" style="position: relative;">
            <div class="loading-overlay" id="loadingOverlay" 
                style="position: absolute; top:0; left:0; right:0; bottom:0; 
                        display: flex; justify-content:center; align-items:center; 
                        background: rgba(255,255,255,0.8); z-index: 10;">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

            <iframe name="pdfIframe" width="100%" height="600px" style="border:none;"
                    onload="document.getElementById('loadingOverlay').style.display='none'"></iframe>

            <form id="pdfForm" action="{{ route('invoice.review') }}" method="POST" target="pdfIframe">
                @csrf
                <input type="hidden" name="invoice_number" value="{{ $invoice->invoice_number }}">
                <input type="hidden" name="id" value="{{ $invoice->id }}">
            </form>

        </div>

    </div>
</body>
<script>
    // Submit the form automatically to load PDF via POST
    document.getElementById('pdfForm').submit();
</script>
@endsection
