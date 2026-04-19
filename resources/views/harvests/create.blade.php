@extends('layouts.app')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">
                                @if (session('status'))
                                    <div class="alert alert-success">{{session('status')}}</div>
                                @endif
                                <h4 class="card-title">New Cycle Harvest
                                    <a href="{{ url('harvests') }}" class="btn btn-danger float-end"><i class="mdi mdi-close"></i></a>
                                </h4>
                            </div>
                            <form action="{{ url('harvest/create')}}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <input type="hidden" name="maker_id" class="form-control" value="{{Auth::user()->id}}" readonly/>
                                    @error('maker_id') <span class="text-danger">{{ $message}}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Cycle</label>
                                    <select name="Cycle_Id" class="form-control">
                                        <option value="" selected> -- SELECT CYCLE --</option>
                                        @foreach ($cycles as $cycle)
                                            <option value="{{ $cycle->Cycle_Id}}">{{ $cycle->Cycle_Name }}</option>
                                        @endforeach
                                    </select>
                                    @error('Block_Id') <span class="text-danger">{{ $message}}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Product</label>
                                    <input type="text" name="Product" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Customer Name</label>
                                    <select name="Customer_Name" class="form-control">
                                        <option value="" selected> -- CUSTOMER --</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->Customer_Name}}">{{ $customer->Customer_Name}}</option>
                                        @endforeach
                                    </select>
                                    @error('Customer_Name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label>Harvest Date</label>
                                    <input type="date" name="Harvest_Date" class="form-control" value="{{ old ('Harvest_Date') }}" />
                                    @error('Harvest_Date') <span class="text-danger">{{ $message}}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Quantity Harvested</label>
                                    <input type="number" step="0.01" name="Quantity_Harvested" class="form-control" value="{{ old ('Quantity_Harvested') }}" />
                                    @error('Quantity_Harvested') <span class="text-danger">{{ $message}}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Quantity Spoilt</label>
                                    <input type="number" step="0.01" name="Quantity_Spoilt" class="form-control" value="{{ old ('Quantity_Spoilt') }}" />
                                    @error('Quantity_Spoilt') <span class="text-danger">{{ $message}}</span> @enderror
                                <div class="mb-3">
                                    <label>Grade</label>
                                    <input type="text" name="Grade" class="form-control" value="{{ old ('Grade') }}" />
                                    @error('Grade') <span class="text-danger">{{ $message}}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Remarks</label>
                                    <textarea id="description-remarks" name="Remarks" class="form-control" style="height: 200px;">{{ old('Remarks') }}</textarea>
                                    <input type="hidden" name="hiddenDescription" id="hiddenDescription-remarks" value="{{ old('Description') }}" />
                                    @error('Remarks') <span class="text-danger">{{ $message}}</span> @enderror                        
                                </div>
                                <div class="mb-3">
                                    <button type="submit"  class="btn btn-success text-center">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Quill editor for Description
        var quillHerbs = new Quill('#description-remarks', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': '1' }, { 'header': '2' }],
                    ['bold', 'italic', 'underline'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['link', 'image'],
                    [{ 'align': [] }],
                    ['clean']
                ]
            }
        });

        // Sync Quill editor content with hidden input
        const descriptionTextareaHerbs = document.getElementById('description-remarks');
        const hiddenDescriptionInputHerbs = document.getElementById('hiddenDescription-remarks');
        descriptionTextareaHerbs.addEventListener('input', function() {
            hiddenDescriptionInputHerbs.value = descriptionTextareaHerbs.value;
        });

        

        
    });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cycleSelect = document.querySelector('select[name="Cycle_Id"]');
            const productInput = document.querySelector('input[name="Product"]');
    
            // Convert your PHP $cycles collection to a JavaScript object keyed by Cycle_Id
            const cyclesData = @json($cycles->keyBy('Cycle_Id'));
    
            cycleSelect.addEventListener('change', function() {
                const selectedCycleId = this.value;
    
                if (selectedCycleId) {
                    productInput.readOnly = true;
    
                    if (cyclesData.hasOwnProperty(selectedCycleId)) {
                        productInput.value = cyclesData[selectedCycleId].Product; // Assuming your $cycle object has a 'Product' property
                    } else {
                        productInput.value = '';
                    }
                } else {
                    productInput.readOnly = false;
                    productInput.value = '';
                }
            });
        });
    </script>
  
@endsection
