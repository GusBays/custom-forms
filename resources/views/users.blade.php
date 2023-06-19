@extends('admin')

@section('title')
    Usuários
@endsection

@section('admin-content')

    <div class="row justify-content-center align-items-center">
        @foreach($users as $user) 
            @include('snippets/user-card-list')
        @endforeach
    </div>

@endsection

@section('footer')
    @include('snippets/footer')
@endsection