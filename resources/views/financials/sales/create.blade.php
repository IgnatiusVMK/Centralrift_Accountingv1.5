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
                  <h4 class="card-title">Record Sales
                    <a href="{{ url('cycles/'.$Cycle_Id ) }}" class="btn btn-danger float-end"><i class="mdi mdi-close"></i></a>
                  </h4>
                  </div>
                  <form action="{{ url('sales/'.$Cycle_Id.'/create') }}" method="post">
                    @csrf

                    <div class="mb-3">
                      {{-- <label>Maker ID</label> --}}
                      <input type="hidden" name="maker_id" class="form-control" value="{{Auth::user()->id}}" readonly/>
                      @error('maker_id') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      {{-- <label>Cycle</label> --}}
                        <input type="hidden" name="Cycle_Id" class="form-control" value="{{ $Cycle_Id }}" readonly/>
                        @error('Cycle_Id') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      {{-- <label>Sale ID</label> --}}
                        <input type="hidden" name="Sales_Id" class="form-control" value="{{ $SaleuniqueCode }}" readonly/>
                        @error('Sales_Id') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Customer</label>
                        <select id="customer-select" name="Customer_Id" class="form-control" required>
                          <option value="0">-- SELECT CUSTOMER --</option>
                            @foreach($Customers as $customer)
                              <option value="{{ $customer->id }}" data-account-no="{{ $customer->Cust_Account_No }}">
                                {{ $customer->Customer_Name }}
                              </option>
                            @endforeach
                        </select>
                        @error('Customer_Id') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>
                      
                      <div class="mb-3">
                          <label>Customer Account No.</label>
                          <input type="text" id="account-number" name="Cust_Account_No" class="form-control" readonly />
                          @error('Cust_Account_No') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>

                      <div class="mb-3">
                        <label>LPO Number: </label>
                        <input type="text" id="netWeight" name="Lpo_No" class="form-control" value="{{ old('Lpo_No') }}" />
                        @error('Lpo_No') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                      <div class="mb-3">
                        <label>Description</label>
                        <textarea id="Description" name="Description" class="form-control" style="height: 200px;">{{ old('Description') }}</textarea>
                        <input type="hidden" name="hiddenDescription" id="hiddenDescription" value="{{ old('Description') }}" />
                        @error('Description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                    
                      <div class="mb-3">
                        <label>Packaging Options</label>
                        <div class="form-check">
                            <input type="radio" id="option1" name="packaging_option" value="3Kg" class="form-check-input" required />
                            <label for="option1" class="form-check-label">3Kg (30gms x 100)</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" id="option2" name="packaging_option" value="1Kg" class="form-check-input" />
                            <label for="option2" class="form-check-label">1Kg (100gms x 10)</label>
                        </div>
                        @error('packaging_option') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>
                    
                    <div class="mb-3">
                        <label>Net Weight (Kg)</label>
                        <input type="number" id="netWeight" name="Net_Weight" class="form-control" value="{{ old('Net_Weight') }}" />
                        @error('Net_Weight') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label>No. of Cartons</label>
                        <input type="number" id="numCartons" name="No_of_boxes" class="form-control" value="{{ old('No_of_boxes') }}" readonly />
                        @error('No_of_boxes') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    

                        <div class="mb-3">
                          <label>Payment Status</label>
                          <select id="Payment_Status" name="Payment_Status" class="form-control" required>
                            <option value="Paid" class="text-success" >Paid</option>
                            <option value="Un-Paid" class="text-danger" selected>Un-Paid</option>
                            <option value="Pending" class="text-warning">Pending</option>
                          </select>
                          @error('Payment_Status') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <label>Amount</label>
                          <input type="number" name="Total_Price" class="form-control" value="{{ old ('Total_Price') }}" />
                          @error('Total_Price') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <label>Deliver Date (mm/dd/yyyy)</label>
                          <input type="date" name="Sale_Date" class="form-control" value="{{ old ('Sale_Date') }}" />
                          @error('Sale_Date') <span class="text-danger">{{ $message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <button type="submit" class="btn btn-success text-center">Save</button>
                        </div>
                  </form>
                </div>
              </div>
            </div>
           
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const customerSelect = document.getElementById('customer-select');
        const accountNumberInput = document.getElementById('account-number');
        
        customerSelect.addEventListener('change', function() {
            const selectedOption = customerSelect.options[customerSelect.selectedIndex];
            const accountNumber = selectedOption.getAttribute('data-account-no');
            
            // Set the account number in the readonly input field
            accountNumberInput.value = accountNumber;
        });
    });
</script>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>


<script>
  var quill = new Quill('#Description', {
      theme: 'snow',
      modules: {
          toolbar: [
              [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
              ['bold', 'italic', 'underline'],
              [{ 'list': 'ordered'}, { 'list': 'bullet' }],
              ['link', 'image'],
              [{ 'align': [] }],
              ['clean']
          ]
      }
  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const descriptionTextarea = document.getElementById('Description');
    const hiddenDescriptionInput = document.getElementById('hiddenDescription');

    descriptionTextarea.addEventListener('input', function() {
        hiddenDescriptionInput.value = descriptionTextarea.value;
    });
  });
</script>


<script>
  document.addEventListener('DOMContentLoaded', function() {
      const netWeightInput = document.getElementById('netWeight');
      const numCartonsInput = document.getElementById('numCartons');
      const packagingOptions = document.querySelectorAll('input[name="packaging_option"]');

      function updateCartons() {
          const netWeight = parseFloat(netWeightInput.value);
          const selectedOption = document.querySelector('input[name="packaging_option"]:checked');
          if (selectedOption) {
              const packagingSize = parseFloat(selectedOption.value);
              if (packagingSize) {
                  const numCartons = netWeight / packagingSize;
                  numCartonsInput.value = Math.ceil(numCartons); // Use Math.ceil to ensure full cartons
              }
          }
      }

      // Event listeners for changes
      netWeightInput.addEventListener('input', updateCartons);
      packagingOptions.forEach(option => option.addEventListener('change', updateCartons));

      // Initialize on page load
      updateCartons();
  });
</script>


@endsection