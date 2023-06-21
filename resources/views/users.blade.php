@extends('admin')

@section('title')
    Usuários
@endsection

@section('admin-content')

    <div class="row justify-content-between align-items-center">

        <x-grid-side 
            title="Lista de usuários"
            iconUrl="{{ env('APP_URL') }}/assets/img/user-icon.svg"
            showButtons="{{ true }}"
            resource="user"
            registro="usuário"
        >
        </x-grid-side>

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