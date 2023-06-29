@extends('admin')

@section('title')
    Formulários
@endsection

@section('admin-content')

    <div class="row justify-content-between align-items-top">

        <x-grid-side 
            title="Lista de formulários"
            iconUrl="{{ env('APP_URL') }}/assets/img/form-icon.svg"
            searchField="{{ true }}"
            addButton="{{ true }}"
            deleteButton="{{ true }}"
            filterButton="{{ true }}"
            sortButton="{{ true }}"
            buttonResource="formulário"
            pathResource="formularios"
            apiResource="forms"
        >
        </x-grid-side>

        <div class="col-12 col-lg-7">
            @foreach($forms as $form) 
                <div class="mb-2">
                    @include('snippets/form-card-list')
                </div>
            @endforeach
        </div>

        <script src="{{ env('APP_URL') }}/assets/js/buttons/active.js"></script>

@endsection