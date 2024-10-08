@extends('layouts.app')


@section('content')
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    @if (session('status'))
                      <div class="alert alert-danger text-center">{{session('status')}}</div>
                    @endif
                    <div class="card-header">
                      <h4 class="card-title">Stock Pool
                      </h4>
                    </div>
                  
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Sn No.
                          </th>
                          <th>
                            Item Name
                          </th>
                          <th>
                            Quantity
                          </th>
                          <th>
                            In Inventory
                          </th>
                          <th>
                            Allocate
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($stocks as $stock)
                        <tr>
                          <td>{{$stock->id}}</td>
                          <td>{{$stock->Stock_Name}}</td>
                          @if ($stock->purchase->Category_Id == 1)
                            <td>{{$stock->Total_Quantity}} Ltrs.</td>
                          @elseif ($stock->purchase->Category_Id == 2)
                            <td>{{$stock->Total_Quantity}} gms/Kgs</td>
                          @elseif ($stock->purchase->Category_Id == 3)
                            <td>{{$stock->Total_Quantity}} Boxes/Kgs</td>
                          @endif
                          @if ($stock->purchase->Category_Id == 1)
                            <td>{{$stock->Remaining_Quantity}} Ltrs.</td>
                          @elseif ($stock->purchase->Category_Id == 2)
                            <td>{{$stock->Remaining_Quantity}} gms/Kgs</td>
                          @elseif ($stock->purchase->Category_Id == 3)
                            <td>{{$stock->Remaining_Quantity}} Boxes/Kgs</td>
                          @endif
                          <td>
                            <a href="#" 
                               class="btn btn-warning allocate-btn" 
                               data-toggle="modal" 
                               data-target="#allocationModal"
                               data-id="{{ $stock->id }}"
                               data-quantity="{{ $stock->Remaining_Quantity }}">
                              <i></i>+ Allocate
                            </a>
                          </td>                          
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
           
          </div>
        </div>
        <div class="modal fade" id="allocationModal" tabindex="-1" role="dialog" aria-labelledby="allocationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="allocationModalLabel">Allocate Stock</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form id="allocationForm" action="#" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <input type="hidden" name="maker_id" class="form-control" value="{{Auth::user()->id}}" readonly/>
                                @error('maker_id') <span class="text-danger">{{ $message}}</span> @enderror
                            </div>
                            <div class="mb-3">
                                {{-- <label for="stock-id">Stock ID</label> --}}
                                <input type="hidden" type="text" class="form-control" name="stock_id" id="stock-id" readonly>
                            </div>
                            <div class="mb-3">
                                {{-- <label for="previous-quantity">Previous Quantity</label> --}}
                                <input type="hidden" name="remaining_quantity" class="form-control" id="stock-quantity" readonly>
                            </div>
                            <div class="mb-3">
                                <label>Cycle</label>
                                <select name="Cycle_Id" class="form-control">
                                  <option value="0" selected> -- Cycle --</option>
                                  @foreach ($cycles as $cycle)
                                    <option value="{{ $cycle->Cycle_Id }}">{{ $cycle->Cycle_Name }}</option>
                                  @endforeach
                              </select>
                            </div>
                            <div class="mb-3">
                                <label>Allocation Quantity</label>
                                <input type="number" name="allocated_quantity" class="form-control" value="{{ old('allocated_quantity') }}" />
                            </div>
                            <div class="form-group">
                                <label for="allocation_date">Allocation Date</label>
                                <input type="date" class="form-control" id="allocation_date" name="allocation_date" value="{{ old('allocation_date') }}" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="submitAllocationForm">Submit</button>
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

<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.getElementById('submitAllocationForm').addEventListener('click', function() {
      document.getElementById('allocationForm').submit();
  });
</script>
<script>
$(document).ready(function() {
  // Populate modal fields when button is clicked
  $('.allocate-btn').on('click', function() {
    var stockId = $(this).data('id');
    var stockQuantity = $(this).data('quantity');
    
    // Populate modal form fields with data
    $('#stock-id').val(stockId);
    $('#stock-quantity').val(stockQuantity);

    // Set the stock ID in the form action
    var formAction = "{{ url('allocate/') }}/" + stockId + "/"; 
    $('#allocationForm').attr('action', formAction); // Set the base form action
  });

  // Update the form action based on the selected cycle before submitting
  $('#submitAllocationForm').on('click', function(e) {
    e.preventDefault(); // Prevent default form submission

    var selectedCycleId = $('select[name="Cycle_Id"]').val(); // Get the selected cycle
    var formAction = $('#allocationForm').attr('action'); // Get the current form action (with stock ID)

    // Update the form action to include the selected Cycle_Id
    formAction = formAction + selectedCycleId; 
    $('#allocationForm').attr('action', formAction); // Set the new form action

    $('#allocationForm').submit(); // Submit the form
  });
});
</script>
@endsection