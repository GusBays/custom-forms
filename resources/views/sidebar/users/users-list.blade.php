@extends('admin')

@section('title')
    Usuários
@endsection

@section('admin-content')

    <div class="row justify-content-between align-items-top">

        <x-grid-side 
            title="Lista de usuários"
            iconUrl="{{ env('APP_URL') }}/assets/img/user-icon.svg"
            searchField="{{ true }}"
            addButton="{{ true }}"
            deleteButton="{{ true }}"
            filterButton="{{ true }}"
            sortButton="{{ true }}"
            buttonResource="usuário"
            pathResource="usuarios"
            apiResource="users"
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