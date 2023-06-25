@extends('default')

@section('content')

@include('snippets/sidebar')

<div class="container">

    @yield('admin-content')

</div>

@endsection

<footer>
    <div class="container">

        @include('snippets/footer')

    </div>
</footer>
