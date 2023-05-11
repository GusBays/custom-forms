@extends('default')

@section('title')
    Cadastro
@endsection

@section('content')
    <div class="container">
        <form class="row justify-content-center align-items-center form form-login mt-4" method="POST" action="/create/organization">
            @csrf
                <div class="col-12 text-center">
                    <p class="form-text">Nome da organização</p>
                </div>
                <div class="form-group">
                    <input id="name" name="name" type="text" required="required" data-error="name_required_field name_field" minlength="2" value=""/>
                </div>
                <div class="col-12 text-center">
                    <p class="form-text">Nome</p>
                </div>
                <div class="form-group">
                    <input id="first_name" name="first_name" type="text"/>
                </div>
                <div class="col-12 text-center">
                    <p class="form-text">Sobrenome</p>
                </div>
                <div class="form-group">
                    <input id="last_name" name="last_name" type="text"/>
                </div>
                <div class="col-12 text-center">
                    <p class="form-text">E-mail</p>
                </div>
                <div class="form-group">
                    <input id="email" name="email" type="text" required="required" data-error="email_required_field email_field"/>
                </div>
                <div class="col-12 text-center">
                    <p class="form-text">Senha</p>
                </div>
                <div class="form-group">
                    <input id="password" name="password" type="password"/>
                </div>
            <button type="submit" class="btn btn-secondary btn-block btn-lg">Cadastrar-se</button>
        </form>
    </div>
@endsection