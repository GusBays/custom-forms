@extends('admin')

@section('title')
    {{ $filler->getName() }}
@endsection

@section('admin-content')
    <div class="row justify-content-beetwen align-items-center">

        <x-grid-side 
            title="Edição de preenchedor"
            iconUrl="{{ env('APP_URL') }}/assets/img/filler-icon.svg"
            buttonResource="preenchedor"
            pathResource="preenchedores"
            apiResource="fillers"
        >
        </x-grid-side>

        <div class="col-12 col-lg-7">
            <form action="/action/filler/update" method="POST" class="shadow p-3 mb-5 bg-body-tertiary rounded">
                <div class="col">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome completo</label>
                        <input class="form-control" type="text" value="{{ $filler->getName() }}" disabled readonly>
                    </div>
                    <div class="mb-3">
                        <label for="first_name" class="form-label">Primeiro nome</label>
                        <input type="text" class="form-control" value="{{ $filler->getFirstName() }}" id="first_name" placeholder="Ex.: Ana">
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Sobrenome</label>
                        <input type="text" class="form-control" value="{{ $filler->getLastName() }}" id="last_name" placeholder="Ex.: Flores">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="text" class="form-control" value="{{ $filler->getEmail() }}" id="email" placeholder="Ex.: email@exemplo.com.br">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <button type="submit" class="btn btn-success border-0 w-100 theme-color">Salvar alterações</button>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mt-1 mt-md-0">
                            <a class="btn btn-secondary w-100" href="/admin/preenchedores?sort=-id&limit=25&page=1" type="button">Voltar</a>
                        </div>
                    </div>
                </div>

                @csrf
            </form>
        </div>
    </div>
@endsection