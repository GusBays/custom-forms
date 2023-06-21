@extends('admin')

@section('title')
    Usuários
@endsection

@section('admin-content')

    <div class="row justify-content-between align-items-center">

        <div class="col-12 col-lg-5">
            <div class="mb-2 mb-lg-0">
                <h3 class="text-center align-text-top">
                    <img src="{{ env('APP_URL') }}/assets/img/user-icon.svg" alt="" width="30" height="30">
                    Lista de usuários
                </h3>
            </div>
        </div>

        <div class="col-12 col-lg-7">
            @foreach($users as $user) 
                <div class="mb-2">
                    @include('snippets/user-card-list')
                </div>
            @endforeach
        </div>

@endsection

@section('footer')
    @include('snippets/footer')
@endsection