@extends('admin')

@section('scripts')
    <script type="text/javascript" src="{{ env('APP_URL') }}/assets/js/validations/recaptcha.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
@endsection

@section('title')
    {{ $user->getName() }}
@endsection

@section('admin-content')
    <div class="row justify-content-beetwen align-items-center">

        <x-grid-side 
        title="Edição de usuário"
        iconUrl="{{ env('APP_URL') }}/assets/img/user-icon.svg"
        deleteButton="{{ true }}"
        buttonResource="usuário"
        pathResource="usuarios"
        apiResource="users"
        >
        </x-grid-side>

        <div class="col-12 col-lg-7">
            <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
                <div class="col">
                        <input type="text" id="id" value="{{ $user->getId() }}" hidden>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome completo</label>
                        <input class="form-control" type="text" value="{{ $user->getName() }}" disabled readonly>
                    </div>
                    <div class="mb-3">
                        <label for="first_name" class="form-label">Primeiro nome</label>
                        <input type="text" class="form-control" value="{{ $user->getFirstName() }}" id="first_name" placeholder="Ex.: Ana">
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Sobrenome</label>
                        <input type="text" class="form-control" value="{{ $user->getLastName() }}" id="last_name" placeholder="Ex.: Flores">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="text" class="form-control" value="{{ $user->getEmail() }}" id="email" placeholder="Ex.: email@exemplo.com.br">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha: </label>
                        <button type="button" class="btn btn-danger border-0 theme-color" data-bs-toggle="modal" data-bs-target="#exampleModal">Editar senha</button>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Tipo de cadastro</label>
                        <input type="text" class="form-control" id="type" value="{{ $user->getType() }}" hidden>
                        <input type="text" class="form-control" value="{{ 'owner' === $user->getType() ? 'Proprietário' : 'Integrante'}}" disabled readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <button type="submit" class="btn btn-success border-0 w-100 theme-color" id="update-user">Salvar alterações</button>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mt-1 mt-md-0">
                            <a class="btn btn-secondary w-100" href="/admin/usuarios?sort=id&limit=100&page=1" type="button">Voltar</a>
                        </div>
                    </div>
                    <input id="delete-checkbox" type="checkbox" value="{{ $user->getId() }}" hidden>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Redefinir senha</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form>
                <div class="mb-3">
                    <label for="password" class="col-form-label">Nova senha: </label>
                    <input type="password" class="form-control" id="password" placeholder="Ex.: 123@Abc">
                </div>
                <div class="mb-3">
                    <label for="password-repeat" class="col-form-label">Repita a nova senha: </label>
                    <input type="password" class="form-control" id="password-repeat" placeholder="Ex.: 123@Abc"></textarea>
                </div>

                @csrf
            </form>
        </div>
        <div class="modal-footer">
            <div class="col-12 mb-2" id="recaptcha"></div>
            <button type="button" class="btn btn-danger" id="confirm-button" disabled>Confirmar nova senha</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
      </div>
    </div>
  </div>
</div>

<script type="module" src="{{ env('APP_URL') }}/assets/js/services/userService.js"></script>
@endsection