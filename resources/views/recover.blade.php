@extends('default')

@section('scripts')
    <script type="text/javascript" src="{{ env('APP_URL') }}/assets/js/validations/recaptcha.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
@endsection

@section('title')
    Recuperação de senha
@endsection

@section('content')
    <div class="container">
        <div class="row align-items-center justify-content-center vh-100">
            <div class="col-10 col-md-8 col-lg-6">
                <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-title mb-3">
                                <h3 class="text-center">Recuperação de senha</h3>
                            </div>
                        </div>
                        <div class="col-12">
                            <small class="text-body-secondary text-center">
                                Para recuperar sua senha, insira seu email abaixo e clique em confirmar.
                                Você receberá no seu email uma nova senha provisória para que possa fazer login e alterá-la depois.
                            </small>
                        </div>
                    </div>

                    <form id="recover-form">
                        @csrf
                        <div class="col mt-3">
                            <input id="email" name="email" type="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="col mt-3">
                            <div id="recaptcha"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-md-6">
                                <button type="submit" id="confirm-button" disabled class="btn btn-success w-100 border-0 theme-color">Enviar email</button>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mt-1 mt-md-0">
                                    <a class="btn btn-secondary border-0 w-100" id="back-button" type="button">Voltar</a>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection