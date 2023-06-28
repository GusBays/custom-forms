@extends('admin')

@section('title')
    Preenchedores
@endsection

@section('admin-content')

    @if ($fillers)
        <div class="row justify-content-between align-items-top">
            <x-grid-side 
                title="Lista de preenchedores"
                iconUrl="{{ env('APP_URL') }}/assets/img/filler-icon.svg"
                searchField="{{ true }}"
                addButton="{{ true }}"
                filterButton="{{ true }}"
                sortButton="{{ true }}"
                buttonResource="preenchedor"
                pathResource="preenchedores"
                apiResource="fillers"
            >
            </x-grid-side>

            <div class="col-12 col-lg-7">
                @foreach ($fillers as $filler)
                    @include('snippets/filler-card-list')
                @endforeach
            </div>
        </div>
    @else
        <div class="row justify-content-center align-items-center">
            <x-empty-list
                resource="Preenchedor"
                pathResource="preenchedores"
            >
            </x-empty-list>
        </div>
    @endif
@endsection