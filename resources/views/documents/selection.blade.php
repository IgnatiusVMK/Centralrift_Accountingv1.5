@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Download Generated Documents</div>

                <div class="card-body">
                    @if(session('generated_documents'))
                    
                    <div class="mb-4">
                        <h5>Generated Documents</h5>
                        <p class="text-muted">Select which documents you want to download</p>
                    </div>

                    @if(isset($documents['invoices']))
                    <div class="mb-4">
                        <h6>Invoices</h6>
                        <div class="list-group">
                            @foreach($documents['invoices'] as $id => $invoice)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                Invoice #{{ $id }}
                                <a href="{{ route('documents.download', ['type' => 'invoices', 'id' => $id]) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    Download
                                </a>
                            </div>
                            @endforeach
                            <div class="list-group-item bg-light">
                                <a href="{{ route('documents.download.all', ['type' => 'invoices']) }}" 
                                   class="btn btn-primary">
                                    Download All Invoices (ZIP)
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(isset($documents['delivery_notes']))
                    <div class="mb-4">
                        <h6>Delivery Notes</h6>
                        <div class="list-group">
                            @foreach($documents['delivery_notes'] as $id => $note)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                Delivery Note #{{ $id }}
                                <a href="{{ route('documents.download', ['type' => 'delivery_notes', 'id' => $id]) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    Download
                                </a>
                            </div>
                            @endforeach
                            <div class="list-group-item bg-light">
                                <a href="{{ route('documents.download.all', ['type' => 'delivery_notes']) }}" 
                                   class="btn btn-primary">
                                    Download All Delivery Notes (ZIP)
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(isset($documents['invoices']) && isset($documents['delivery_notes']))
                    <div class="mt-4">
                        <a href="{{ route('documents.download.all', ['type' => 'all']) }}" 
                           class="btn btn-success btn-lg btn-block">
                            Download All Documents (ZIP)
                        </a>
                    </div>
                    @endif

                    @else
                    <div class="alert alert-warning">
                        No documents found. Please generate documents first.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection