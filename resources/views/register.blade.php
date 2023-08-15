@extends('default')

@section('scripts')
    <script type="text/javascript" src="{{ env('APP_URL') }}/assets/js/validations/recaptcha.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
@endsection

@section('title')
    Cadastro
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-center vh-100">

            <x-grid-side 
                title="Cadastre sua organização"
                iconUrl="{{ env('APP_URL') }}/assets/img/notebook-icon.svg"
                extraImageUrl="{{ env('APP_URL') }}/assets/img/login-notebook.svg"
            >
            </x-grid-side>

            <div class="col-12 col-md-9 col-lg-5">
                <div class="shadow my-5 p-3 bg-body-tertiary rounded">

                    <form id="register-form">
                        <div class="col">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome da organização</label>
                                <input id="name" name="name" type="text" required minlength="2" class="form-control" placeholder="Ex.: Empresa de Carros & Cia"/>
                            </div>
                            <div class="mb-3">
                                <label for="first_name" class="form-label">Nome do proprietário</label>
                                <input id="first_name" name="first_name" type="text" required class="form-control" placeholder="Ex.: Pedro"/>
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Sobrenome do proprietário</label>
                                <input id="last_name" name="last_name" type="text" class="form-control" placeholder="Ex.: da Silva"/>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input id="email" name="email" type="text" required class="form-control" placeholder="Ex.: email@exemplo.com.br"/>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input id="password" name="password" type="password" required class="form-control" placeholder="Ex.: 123@Abc"/>
                            </div>
                            <div class="mb-3">
                                <label for="password-repeat" class="form-label">Repita sua senha</label>
                                <input id="password-repeat" name="password-repeat" type="password" class="form-control" placeholder="Ex.: 123@Abc"/>
                            </div>
    
                            <div class="mb-3" id="recaptcha"></div>
                        
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <button id="confirm-button" type="submit" class="btn btn-success w-100 border-0 theme-color" disabled>Cadastrar-se</button>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mt-1 mt-md-0">
                                        <a class="btn btn-secondary border-0 w-100" id="back-button" type="button">Voltar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection