@extends('default')

@section('title')
    Home
@endsection

@section('content')

    <div class="container text-center">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-12">
                <img src="{{ env('APP_URL') }}/assets/img/notebook-icon.svg" alt="notebook icon" width="30" height="28" class="d-inline-block align-text-bottom"> 
                <h3 class="d-inline ms-2">Formulando</h3>
                <h5 class="mt-5 text-muted">Crie formulários personalizados e consulte todas as <br> respostas e relatórios em nossa plataforma!</h5>
            </div>

            <div class="row">
                <div class="col-12">
                    <a type="button" href="/admin/entrar" class="btn btn-secondary border-0 w-25 theme-color">Entrar em uma conta existente</a>
                </div>
                <div class="col-12 mt-1">
                    <a type="button" href="/admin/cadastro" class="btn btn-secondary border-0 w-25">Cadastrar uma nova organização</a>
                </div>
            </div>

        </div>
    </div>

@endsection