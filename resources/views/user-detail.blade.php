@extends('admin')

@section('title')
    {{ $user->getName() }}
@endsection

@section('admin-content')
    <div class="row justify-content-center align-items-center">
        <div class="col-12 col-md-8 col-lg-6">
            <form action="/action/update-user" method="POST" class="shadow p-3 mb-5 bg-body-tertiary rounded">
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
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="password">
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
@endsection