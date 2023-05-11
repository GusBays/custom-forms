@extends('default')

@section('title')
    Entrar
@endsection

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-10 mx-auto col-lg-5">
                <form method="POST" action="/login">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Endereço de e-mail</span>
                        <input id="email" name="email" type="text" class="form-control" placeholder="Email"/>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Senha</span>
                        <input id="password" name="password" type="password" class="form-control" placeholder="Senha"/>
                    </div>
                    <button type="submit" class="btn btn-success">Entrar</button>
                    @csrf
                </form>
                <form method="GET" action="/admin/cadastro">
                    <button type="submit" class="btn btn-secondary btn-block btn-lg">Cadastrar-se</button>
                </form>
            </div>
        </div>
    </div>
@endsection