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
                      <h4 class="card-title">Products
                      <a href="{{ url('products/create') }}" class="btn btn-primary float-end">+ New Product</a>
                      </h4>
                    </div>
                  
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Product ID
                          </th>
                          <th>
                            Product Name
                          </th>
                          <th>
                            Description
                          </th>
                          <th>
                            Price per KG
                          </th>
                          <th>
                            Product Category ID
                          </th>
                          <th>
                            Product Supplier ID
                          </th>
                          <th>
                            Created Date
                          </th>
                          <th>
                            Stock Availability
                          </th>
                          {{-- <th>
                            Actions
                          </th> --}}
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($products as $product)
                        
                        
                        <tr>
                          <td>{{$product->Product_Id}}</td>
                          <td>{{$product->Product_Name}}</td>
                          <td>
                            <div>{{$product->Description}}</div>
                          </td>
    
                          <td>Ksh. {{$product->Price}} /=</td>
                          <td>{{$product->Category_Id}}</td>
                          <td>{{$product->Supplier_Id}}</td>
                          <td>{{$product->Created_Date}}</td>
                          <td>
                            {{-- @if ($product->is_instock) --}}
                              {{-- <button class="btn btn-success">
                                Instock
                              </button>   --}}  
                            {{-- @else --}}
                              <button class="btn btn-danger">
                                Out-of-stock
                              </button>
                            {{-- @endif --}}
                          </td>
                          {{-- <td>
                            <a href="{{ url('products/'.$product->Product_Id.'/edit')}}" class="btn btn-warning"><i class="mdi mdi-border-color"></i> Edit</a>
                            <a href="{{ url('products/'.$product->Product_Id.'/delete')}}" class="btn btn-danger">Delete <i class="mdi mdi-shredder"></i></a>
                          </td> --}}
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
        <!-- content-wrapper ends -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>


@endsection