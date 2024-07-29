@extends('layouts.app')

@section('content')
<h1 class="welcome-text">
    <span id="greeting"></span>
    <span class="text-black fw-bold">{{ Auth::user()->name }}</span>
  </h1>
@endsection