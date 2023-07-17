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

                <div id="users" class="my-3" data-tab-info>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Email</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Deletar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($form->getFormUsers() as $formUser)
                                <tr class="col">
                                    <input type="text" id="form-user-id" value="{{ $formUser->getId() }}" hidden>
                                    <td>{{ $formUser->getUser()->getName() }}</td>
                                    <td>{{ $formUser->getUser()->getEmail() }}</td>
                                    <td>
                                        <select id="form-user-type" class="form-select" data-form-user-id="{{ $formUser->getId() }}">
                                            <option 
                                                @if ('creator' === $formUser->getType()) 
                                                    selected 
                                                @else
                                                    disabled
                                                @endif 
                                            value="creator">Criador</option>
                                            <option
                                                @if ('editor' === $formUser->getType())
                                                    selected
                                                @endif
                                            value="editor">Editor</option>
                                            <option
                                                @if ('viewer' === $formUser->getType())
                                                    selected
                                                @endif
                                                value="viewer">Visualizador</option>
                                        </select>
                                    </td>
                                    <td><button class="btn btn-danger">Deletar</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div id="fields" data-tab-info>
                    <div class="text-muted my-3 border-bottom " id="count-fields">Você tem um total de {{ count($form->getFormFields()) }} campos cadastrados neste formulário.</div>
                    @foreach ($form->getFormFields() as $field)
                        <div class="border-bottom mb-3">
                            <input type="text" id="field-id" value="{{ $field->getId() }}" hidden>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome do campo</label>
                                <input type="text" class="form-control" id="field-name" value="{{ $field->getName() }}" data-field-id={{ $field->getId() }}>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Descrição do campo</label>
                                <textarea class="form-control text-top description-input" id="field-description" data-field-id={{ $field->getId() }}>{{ $field->getDescription() }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Tipo</label>
                                <select id="field-type" class="form-select" data-field-id="{{ $field->getId() }}">
                                    <option 
                                        @if ('text' === $field->getType()) 
                                            selected 
                                        @endif
                                    value="text">Texto</option>
                                    <option
                                        @if ('checkbox' === $field->getType())
                                            selected
                                        @endif
                                    value="checkbox">Checkbox</option>
                                    <option
                                        @if ('select' === $field->getType())
                                            selected
                                        @endif
                                        value="select">Seletor</option>
                                    <option
                                        @if ('blocked' === $field->getType())
                                            selected
                                        @endif
                                        value="blocked">Bloqueado</option>
                                </select>
                            </div>
                            <div class="form-check form-switch align-self-center mb-3">
                                <label for="active" class="form-label">Obrigatório</label>
                                <input class="form-check-input active-switch" id="field-required" value="{{ $field->getRequired() }}" type="checkbox" role="switch"
                                    @if('blocked' === $field->getType())
                                        disabled
                                    @elseif ($field->getRequired())
                                        checked
                                    @endif
                                data-field-id={{ $field->getId() }}>
                            </div>
                            <div class="mb-3 p-2 rounded" style="background-color: #e9ecef;" id="group-field-content" data-field-id="{{ $field->getId() }}">
                                <label for="content" class="form-label">Opções</label>
                                @foreach ($field->getContent() as $option)
                                    <div class="input-group mb-1">
                                        <input type="text" class="form-control" id="field-content" value="{{ $option }}" aria-describedby="basic-addon1" data-field-id="{{ $field->getId() }}">
                                        <button class="input-group-text btn btn-danger" id="basic-addon1"><img src="{{ env('APP_URL') }}/assets/img/trash-icon.svg" alt="" width="25" height="32"></button>
                                    </div>
                                @endforeach
                                <div class="col-12">
                                    <button class="btn btn-success"><img src="{{ env('APP_URL') }}/assets/img/add-icon.svg" width="25" height="25" alt="add-icon"></button>
                                 </div>
                            </div>
                        </div>
                    @endforeach
                    <button id="add-field" type="button" class="btn btn-success mb-3">Adicionar novo campo</button>
                </div>

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
