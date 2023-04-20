@extends('default')

@section('title')
    Home
@endsection

@section('content')

    <div class="container">
        <form class="row justify-content-center align-items-center form form-login mt-4" method="GET" action="/cadastro">
            <div class="col-6">
                <button type="submit" class="btn btn-secondary btn-block btn-lg">Criar conta</button>
            </div>
        </form>
        <form class="row justify-content-center align-items-center form form-login mt-4" method="GET" action="/entrar">
            <div class="col-6 text-center">
                <button type="submit" class="btn btn-secondary btn-block btn-lg">Entrar</button>
            </div>
        </form>
    </div>

@endsection