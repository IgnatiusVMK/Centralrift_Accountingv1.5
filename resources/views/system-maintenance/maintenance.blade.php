@extends('layouts.app')


@section('content')
<form method="POST" action="{{ route('schedule-maintenance.down') }}">
    @csrf
    <div class="mb-3">
      {{-- <label>Maker ID</label> --}}
      <input type="hidden" name="maker_id" class="form-control" value="{{Auth::user()->id}}" readonly/>
      @error('maker_id') <span class="text-danger">{{ $message}}</span> @enderror
    </div>
    <label for="scheduled_at">Schedule Maintenance:</label>
    <input type="datetime-local" id="scheduled_at" name="scheduled_at" required>
    <button  class="btn-success" type="submit">Schedule Maintenance</button>
</form>

@endsection