@extends('default')

@section('content')

@include('snippets/sidebar')

<div class="container">
    <div class="row align-items-center">

        @yield('admin-content')

    </div>

@endsection