@extends('layouts.app')
<style>
  select {
    width: auto;
    padding: 8px;
    font-size: 16px;
    color: black;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
</style>
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
                  <h4 class="card-title">New Planting Cycle
                    <a href="{{ url('cycles') }}" class="btn btn-danger float-end"><i class="mdi mdi-close"></i></a>
                  </h4>
                  </div>
                  <form action="{{ url('cycles/create')}}" method="post">
                    @csrf

                    <div class="mb-3">
                      <label>Block</label>
                        <select name="Block_Id" class="form-control">
                          <option value="1" selected> -- SELECT BLOCK --</option>
                          @foreach ($blocks as $block)
                              <option value="{{ $block->Block_Id}}">{{ $block->Block_Name }}</option>
                          @endforeach
                        </select>
                      @error('Block_Id') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Crop</label>
                        <select name="Crop" class="form-control">
                          <option value="" selected> -- SELECT BLOCK --</option>
                          @foreach ($crops as $crop)
                              <option value="{{ $crop->Product_Name}}">{{ $crop->Product_Name }}</option>
                          @endforeach
                        </select>
                      @error('Crop') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Cycle Name</label>
                      <input type="text" name="Cycle_Name" class="form-control" value="{{ old ('Cycle_Name') }}" />
                      @error('Cycle_Name') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Cycle Start</label>
                      <input type="date" name="Cycle_Start" class="form-control" value="{{ old ('Cycle_Start') }}" />
                      @error('Cycle_Start') <span class="text-danger">{{ $message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label>Cycle End</label>
                      <input type="date" name="Cycle_End" class="form-control" value="{{ old ('Cycle_End') }}" />
                      @error('Cycle_End') <span class="text-danger">{{ $message}}</span> @enderror
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
        <!-- content-wrapper ends -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
@endsection