@extends('default')

@section('title')
    Cadastro
@endsection

@section('content')
    <div class="container">
        <form class="row justify-content-center align-items-center form form-login mt-4" method="POST" action="/users">
            <div class="col-12 text-center">
                <p class="form-text">Nome</p>
            </div>
            <div class="form-group">
                <input id="first_name" type="text" required="required" data-error="first_name_required_field first_name_field" minlength="2" value="" class="form-control form-control-lg text-center"></input>
            </div>
            <div class="col-12 text-center">
                <p class="form-text">Sobrenome</p>
            </div>
            <div class="form-group">
                <input id="last_name" type="text" class="form-control form-control-lg text-center"></input>
            </div>
            <div class="col-12 text-center">
                <p class="form-text">Data de nascimento</p>
            </div>
            <div class="form-group">
                <input id="birthday" type="text" data-mask="00/00/0000" data-error="birthday_date_field" value="" required="required" autocomplete="off" maxlength="10" class="form-control form-control-lg text-center"></input>
            </div>
            <div class="col-12 text-center">
                <p class="form-text">E-mail</p>
            </div>
            <div class="form-group">
                <input id="email" type="text" required="required" data-error="email_required_field email_field" class="form-control form-control-lg text-center"></input>
            </div>
            <div class="col-12 text-center">
                <p class="form-text">Senha</p>
            </div>
            <div class="form-group">
                <input id="password" type="password" class="form-control form-control-lg text-center"></input>
            </div>
            <button type="submit" class="btn btn-secondary btn-block btn-lg">Cadastrar-se</button>
        </form>
    </div>
@endsection