@extends('admin')

@section('scripts')
    <script type="text/javascript" src="{{ env('APP_URL') }}/js/validations/recaptcha.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
@endsection

@section('title')
    {{ $user->getName() }}
@endsection

@section('admin-content')
    <div class="row justify-content-center align-items-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
            <form action="/action/update-user/{{ $user->getId() }}" method="PUT" class="shadow p-3 mb-5 bg-body-tertiary rounded">
                <div class="col">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome completo</label>
                        <input class="form-control" type="text" value="{{ $user->getName() }}" disabled readonly>
                    </div>
                    <div class="mb-3">
                        <label for="first_name" class="form-label">Primeiro nome</label>
                        <input type="text" class="form-control" value="{{ $user->getFirstName() }}" id="first_name">
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Sobrenome</label>
                        <input type="text" class="form-control" value="{{ $user->getLastName() }}" id="last_name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="text" class="form-control" value="{{ $user->getEmail() }}" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha: </label>
                        <button type="button" class="btn btn-danger border-0" style="background-color:#7800D2" data-bs-toggle="modal" data-bs-target="#exampleModal">Editar senha</button>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Tipo de cadastro</label>
                        <input type="text" class="form-control" id="type" value="{{ 'owner' === $user->getType() ? 'Proprietário' : 'Integrante'}}" disabled readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <button type="submit" class="border-0 btn btn-success w-100" style="background-color:#7800D2;">Salvar alterações</button>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mt-1 mt-md-0">
                            <a class="btn btn-secondary w-100" href="/admin/usuarios" type="button">Voltar</a>
                        </div>
                    </div>
                </div>
            </form>
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
                <label for="new-password" class="col-form-label">Nova senha: </label>
                <input type="password" class="form-control" id="new-password">
            </div>
            <div class="mb-3">
                <label for="new-password-repeat" class="col-form-label">Repita a nova senha: </label>
                <input type="password" class="form-control" id="new-password-repeat"></textarea>
            </div>
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
@endsection