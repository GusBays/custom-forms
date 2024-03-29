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
            paginationButton="{{ true }}"
        >
        </x-grid-side>

        <div class="col-12 col-lg-7" id="forms-card-list">

        </div>
    </div>

@endsection