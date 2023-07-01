@extends('admin')

@section('title')
    {{ $form->getName() }}
@endsection

@section('admin-content')
    <div class="row justify-content-beetwen align-items-center">

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
                    <nav>
                        <a class="btn active">Formulário</a>
                        <a type="button" class="btn" data-bs-toggle="modal" data-bs-target="#formUsersModal">Usuários</a>
                        <a class="btn" href="#fields">Campos</a>
                        <a class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ env('APP_URL') }}/assets/img/down-arrow.svg" alt="" width="25" height="20">
                            Mais opções
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="list-group-item list-group-item-action ms-2" target="_blank" href="{{ env('APP_URL') }}/responder/{{ $form->getSlug() }}">Pré visualizar</a></li>
                        </ul>
                    </nav>
                </div>
                <form action="/action/form/update" method="POST" id="form" class="tab">
                    <div class="col">
                        <div class="mb-3">
                            <label for="name" class="form-label">Título</label>
                            <input type="text" class="form-control" value="{{ $form->getName() }}" id="name" placeholder="Ex.: Formulário de cadastro">
                        </div>
                        <div class="mb-3">
                            <label for="available_until" class="form-label">Disponível até</label>
                            <input type="datetime-local" class="form-control" value="{{ $form->getAvailableUntil() }}" name="available_until">
                        </div>
                        <div class="form-check form-switch align-self-center mb-3">
                            <label for="active" class="form-label">Ativo</label>
                            <input class="form-check-input active-switch" value="{{ $form->getActive() }}" type="checkbox" role="switch"
                                @if($form->getActive())
                                    checked
                                @endif
                            >
                        </div>
                        <div class="mb-3">
                            <label for="fill_limit" class="form-label">Limite de preenchimento</label>
                            <input type="number" class="form-control" value="{{ $form->getFilllimit() }}" name="fill_limit" placeholder="Sem limite">
                        </div>
                        <div class="form-check form-switch align-self-center mb-3">
                            <label for="active" class="form-label">Notificar administradores a cada preenchimento</label>
                            <input class="form-check-input active-switch" value="{{ $form->getShouldNotifyEachFill() }}" type="checkbox" role="switch"
                                @if($form->getShouldNotifyEachFill())
                                    checked
                                @endif
                            >
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <button type="submit" class="btn btn-success border-0 w-100 theme-color">Salvar alterações</button>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mt-1 mt-md-0">
                                    <a class="btn btn-secondary w-100" href="/admin/formularios?sort=-id&limit=25&page=1" type="button">Voltar</a>
                                </div>
                            </div>
                            <input id="delete-checkbox" type="checkbox" value="{{ $form->getId() }}" hidden>
                        </div>

                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formUsersModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Editar usuários</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                                <td>{{ $formUser->getUser()->getName() }}</td>
                                <td>{{ $formUser->getUser()->getEmail() }}</td>
                                <td>
                                    <select class="form-select">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-success border-0 theme-color" id="confirm-button">Atualizar</button>
                <button type="button" class="btn btn-secondary border-0" data-bs-dismiss="modal">Voltar</button>
            </div>
        </div>
      </div>
    </div>

@endsection
