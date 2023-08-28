@extends('admin')

@section('title')
    Preenchedores
@endsection

@section('admin-content')

    <div class="row justify-content-between align-items-top">
        <x-grid-side 
            title="Lista de preenchedores"
            iconUrl="{{ env('APP_URL') }}/assets/img/filler-icon.svg"
            searchField="{{ true }}"
            addButton="{{ true }}"
            deleteButton="{{ true }}"
            filterButton="{{ true }}"
            sortButton="{{ true }}"
            buttonResource="preenchedor"
            pathResource="preenchedores"
            apiResource="fillers"
            paginationButton="{{ true }}"
        >
        </x-grid-side>

        <div class="col-12 col-lg-7" id="fillers-card-list">
            
        </div>
    </div>
@endsection