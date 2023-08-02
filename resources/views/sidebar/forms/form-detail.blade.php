@extends('admin')

@section('title')
    {{ $form->getName() }}
@endsection

@section('admin-content')
    <div class="row justify-content-beetwen align-items-top">

        <x-grid-side 
        title="Edição de formulário"
        iconUrl="{{ env('APP_URL') }}/assets/img/form-icon.svg"
        deleteButton="{{ true }}"
        buttonResource="formulário"
        pathResource="formularios"
        apiResource="forms"
        >
        </x-grid-side>

        <div class="col-12 col-lg-7">
            <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
                <div class="d-flex justify-content-end">
                    <nav class="tabs">
                        <a type="button" class="btn active" data-tab-value="#form">Formulário</a>
                        <a type="button" class="btn" data-tab-value="#users">Usuários</a>
                        <a type="button" class="btn" data-tab-value="#fields">Campos</a>
                    </nav>
                    <a type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ env('APP_URL') }}/assets/img/down-arrow.svg" alt="" width="25" height="20">
                        Mais opções
                    </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="list-group-item list-group-item-action ms-2" target="_blank" href="{{ env('APP_URL') }}/responder/{{ $form->getSlug() }}">Pré visualizar</a></li>
                        </ul>
                </div>

                <div id="form" class="active-tab my-3" data-tab-info>
                    <div class="col">
                        <input type="text" id="id" value="{{ $form->getId() }}" hidden>
                        <div class="mb-3">
                            <label for="name" class="form-label">Título</label>
                            <input type="text" class="form-control" value="{{ $form->getName() }}" id="name" placeholder="Ex.: Formulário de cadastro">
                        </div>
                        <div class="mb-3">
                            <label for="available_until" class="form-label">Disponível até</label>
                            <input type="text" id="available-until" class="form-control" 
                                value="
                                    @if ($form->getAvailableUntil())
                                        {{ Carbon\Carbon::parse($form->getAvailableUntil())->format('Y-m-d H:i:s') }}
                                    @endif
                                "
                                name="available_until"
                                placeholder="Ex.: 2023-10-25 10:00"
                            >
                        </div>
                        <div class="form-check form-switch align-self-center mb-3">
                            <label for="active" class="form-label">Ativo</label>
                            <input class="form-check-input active-switch" id="active" value="{{ $form->getActive() }}" type="checkbox" role="switch"
                                @if($form->getActive())
                                    checked
                                @endif
                            >
                        </div>
                        <div class="mb-3">
                            <label for="fill_limit" class="form-label">Limite de preenchimento</label>
                            <input type="number" class="form-control" id="fill-limit" value="{{ $form->getFilllimit() }}" name="fill_limit" placeholder="Sem limite">
                        </div>
                        <div class="form-check form-switch align-self-center mb-3">
                            <label for="active" class="form-label">Notificar administradores a cada preenchimento</label>
                            <input class="form-check-input active-switch" id="should-notify-each-fill" value="{{ $form->getShouldNotifyEachFill() }}" type="checkbox" role="switch"
                                @if($form->getShouldNotifyEachFill())
                                    checked
                                @endif
                            >
                        </div>
                    </div>
                </div>

                @include('sidebar/formUsers/form-user-detail')

                @include('sidebar/formFields/form-field-detail')

                <div class="row">
                    <div class="col-12 col-md-6">
                        <button type="submit" id="update-form" class="btn btn-success border-0 w-100 theme-color">Salvar alterações</button>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mt-1 mt-md-0">
                            <a class="btn btn-secondary w-100" id="back-button" type="button">Voltar</a>
                        </div>
                    </div>
                    <input id="delete-checkbox" type="checkbox" value="{{ $form->getId() }}" hidden>
                </div>

            </div>
        </div>
    </div>

    <script src="{{ env('APP_URL') }}/assets/js/buttons/tabs.js"></script>
    <script type="module" src="{{ env('APP_URL') }}/assets/js/services/formService.js"></script>
@endsection
