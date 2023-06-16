@extends('default')

@section('title')
    Entrar
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-end align-items-center vh-100">

            <div class="col-6">
                <div class="d-none d-md-block">
                    <img src="{{ env('APP_URL') }}/assets/login-notebook.svg" class="img-fluid" alt="caderno-aberto">
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <form method="POST" action="/login" class="shadow p-3 mb-5 bg-body-tertiary rounded">

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
                            <input id="email" name="email" type="email" class="form-control" placeholder="Email"/>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <input id="password" name="password" type="password" class="form-control" placeholder="Senha"/>
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
                        <div class="col-12 mb-1 col-md-6">
                            <button type="submit" class="btn btn-success w-100 main-color">Entrar</button>
                        </div>
                        <div class="col-12 col-md-6">
                            <a type="button" href="/admin/cadastro" class="btn btn-secondary  w-100">Cadastrar</a>
                        </div>
                    </div>

                    @csrf
                </form>
            </div>
        </div>
    </div>
@endsection