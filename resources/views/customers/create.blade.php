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
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif
                        <h4 class="card-title">Create Customers
                            <a href="{{ url('customers') }}" class="btn btn-danger float-end"><i class="mdi mdi-close"></i></a>
                        </h4>
                    </div>
                    <form action="{{ url('customers/create') }}" method="post">
                      @csrf
                  
                      <!-- Customer Fields -->
                      <div class="mb-3">
                          <label>Full Name</label>
                          <input type="text" name="Customer_Name" class="form-control" value="{{ old('Customer_Name') }}" />
                          @error('Customer_Name') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>
                      <div class="mb-3">
                          <label>Account No.</label>
                          <input type="number" name="Cust_Account_No" class="form-control" value="{{ old('Cust_Account_No') }}" />
                          @error('Cust_Account_No') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>
                      <div class="mb-3">
                          <label>Email</label>
                          <input type="email" name="Email" class="form-control" value="{{ old('Email') }}" />
                          @error('Email') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>
                      <div class="mb-3">
                          <label>Contact</label>
                          <input type="text" name="Contact" class="form-control" value="{{ old('Contact') }}" />
                          @error('Contact') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>
                      <div class="mb-3">
                          <label>Address</label>
                          <input type="text" name="Address" class="form-control" value="{{ old('Address') }}" />
                          @error('Address') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>
                  
                      <!-- Salesperson Section -->
                      <div class="mb-3">
                          <label>Salesperson(s)</label>
                          <div id="salesperson-fields">
                              <!-- Single salesperson field group -->
                              <div class="salesperson-group mb-3">
                                  <input type="text" name="salespersons[0][first_name]" class="form-control mb-2" placeholder="First Name" required />
                                  <input type="text" name="salespersons[0][last_name]" class="form-control mb-2" placeholder="Last Name" required />
                                  <input type="email" name="salespersons[0][email]" class="form-control mb-2" placeholder="Email" required />
                                  <input type="text" name="salespersons[0][phone]" class="form-control mb-2" placeholder="Phone" />
                              </div>
                          </div>
                          <button type="button" class="btn btn-primary" id="add-salesperson">+ Add Salesperson</button>
                      </div>
                  
                      <!-- Save Button -->
                      <div class="mb-3">
                          <button type="submit" class="btn btn-success">Save</button>
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

  <!-- JavaScript for dynamically adding fields -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
      let salespersonIndex = 1;

      // Add Salesperson button
      document.getElementById('add-salesperson').addEventListener('click', function () {
          let salespersonFields = `
              <div class="salesperson-group mb-3">
                  <input type="text" name="salespersons[${salespersonIndex}][first_name]" class="form-control mb-2" placeholder="First Name" required />
                  <input type="text" name="salespersons[${salespersonIndex}][last_name]" class="form-control mb-2" placeholder="Last Name" required />
                  <input type="email" name="salespersons[${salespersonIndex}][email]" class="form-control mb-2" placeholder="Email" required />
                  <input type="text" name="salespersons[${salespersonIndex}][phone]" class="form-control mb-2" placeholder="Phone" />
                  <button type="button" class="btn btn-danger remove-salesperson">Remove</button>
              </div>`;

          document.getElementById('salesperson-fields').insertAdjacentHTML('beforeend', salespersonFields);
          salespersonIndex++;

          // Add event listener for remove button
          attachRemoveListener();
      });

      // Function to attach event listener to all remove buttons
      function attachRemoveListener() {
          document.querySelectorAll('.remove-salesperson').forEach(button => {
              button.addEventListener('click', function () {
                  this.parentElement.remove();
              });
          });
      }

      // Initial listener for remove button
      attachRemoveListener();
  });
</script>
@endsection