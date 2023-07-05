@extends('default')

@section('title')
    Entrar
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-center vh-100">

            <x-grid-side 
                title="Formulando"
                iconUrl="{{ env('APP_URL') }}/assets/img/notebook-icon.svg"
                extraImageUrl="{{ env('APP_URL') }}/assets/img/login-notebook.svg"
            >
            </x-grid-side>

            <div class="col-12 col-md-5 col-lg-4">
                <div class="shadow p-3 mb-5 bg-body-tertiary rounded">

                    <div class="col alert alert-danger" id="error-message" hidden></div>

                    <div class="row">
                        <div class="col">
                            <h3>Que bom te ver novamente!</h3>
                        </div>
                        <div class="col-12">
                            <small class="text-body-secondary">Faça seu login abaixo:</small>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <input id="email" name="email" type="email" class="form-control" placeholder="Email" required/>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <input id="password" name="password" type="password" class="form-control" placeholder="Senha" required/>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <div class="form-check">
                                <input id="keep_connected" name="keep_connected" type="checkbox" class="form-check-input"/>
                                <label for="keep_connected" class="form-check-label">Mantenha-me conectado</label>
                            </div>
                        </div>
                    </div>

                    <div class="row my-3 justify-content-end">
                        <div class="col-auto">
                            <a href="/recuperar-senha" class="link-underline link-underline-opacity-0 link-opacity-50-hover">Esqueci minha senha</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <button type="submit" id="login" class="btn btn-success border-0 w-100 theme-color">Entrar</button>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mt-1 mt-md-0">
                                <a type="button" href="/admin/cadastro" class="btn btn-secondary border-0 w-100">Cadastrar</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script type="module" src="{{ env('APP_URL') }}/assets/js/services/loginService.js"></script>
@endsection