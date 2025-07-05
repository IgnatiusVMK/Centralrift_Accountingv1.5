@extends('layouts.app')

@section('content')
@include('layouts.export')
<div {{-- class="main-panel" --}}>
  <div class="content-wrapper">
    <div class="card">
        <div class="card-header">
            <h4>Existing Customers
                <a href="{{ url('customers/create') }}" class="btn btn-primary float-end">+ Add Customer</a>
            </h4>
        </div>
        <div class="card-body">
            <!-- Add a responsive wrapper around the table -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sn No.</th>
                            <th>Customer</th>
                            <th>Sales Person</th>
                            <th>Salesperson Contacts</th>
                            <th>Address Line1</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($customers as $customer)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href="{{ route('customers.showSales', $customer->id) }}">
                                        {{ $customer->Customer_Name }}
                                    </a>
                                    <br><br>
                                    <b>Acc No: </b>{{ $customer->Cust_Account_No }}
                                </td>
                                <td>
                                    <!-- Display all salespersons for this customer -->
                                    @foreach ($customer->salespersons as $salesperson)
                                      <b>{{ $salesperson->first_name }} {{ $salesperson->last_name }}:<br><br></b>
                                    @endforeach
                                </td>
                                <td>
                                    <!-- Display all salespersons details for this customer -->
                                    @foreach ($customer->salespersons as $salesperson)
                                        {{ $salesperson->email }}<br><br>
                                        {{ $salesperson->phone }}<br><br>
                                    @endforeach
                                </td>
                               <td>
                                    @if($customer->AttentionTo)
                                        {{ $customer->AttentionTo }}<br><br>
                                    @endif

                                    {{ $customer->AddressLine1 }}<br>

                                    @if($customer->AddressLine2)
                                        {{ $customer->AddressLine2 }}<br>
                                    @endif

                                    {{ $customer->City }}<br>

                                    @if($customer->Region_State)
                                        {{ $customer->Region_State }}<br>
                                    @endif

                                    @if($customer->PostalCode)
                                        {{ $customer->PostalCode }}<br>
                                    @endif

                                    {{ $customer->Country }}<br>
                                </td>
                                <td>
                                    <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning">Edit</a>
                                </td>
                                <td>
                                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No customers found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div> <!-- End of table-responsive -->
        </div>
    </div>
  </div>
<!-- content-wrapper ends -->
</div>
<!-- main-panel ends -->
@endsection
