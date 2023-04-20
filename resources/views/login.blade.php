@extends('default')

@section('title')
    Entrar
@endsection

@section('content')
    <div class="container">
        <form class="row justify-content-center align-items-center form form-login mt-4" method="POST" action="/users/login">
            <div class="col-12 text-center">
                <p class="form-text">Insira seu e-mail</p>
            </div>
            <div class="form-group">
                <input id="email" type="text" class="form-control form-control-lg text-center"></input>
            </div>
            <div class="col-12 text-center">
                <p class="form-text">Insira sua senha</p>
            </div>
            <div class="form-group">
                <input id="password" type="password" class="form-control form-control-lg text-center"></input>
            </div>
            <div class="col-6">
                <button type="submit" class="btn btn-secondary btn-block btn-lg">Entrar</button>
            </div>
        </form>
        <form class="row justify-content-center align-items-center form form-login mt-4" method="GET" action="/cadastro">
            <button type="submit" class="btn btn-secondary btn-block btn-lg">Cadastrar-se</button>
        </form>
    </div>
@endsection