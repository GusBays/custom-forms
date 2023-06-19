@extends('default')

@section('title')
    Cadastro
@endsection

@section('content')
    <div class="container">
        <div class="row align-items-center justify-content-center vh-100">
            <div class="col-12 col-md-10 col-lg-8">
                <form method="POST" action="/action/create-organization" class="shadow p-3 mb-5 bg-body-tertiary rounded">

                    <div class="row">
                        <div class="col-12">
                            <h3 class="text-center">Cadastre sua organização</h3>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-12 text-left">
                            <h6 class="form-text">Nome da organização</h6>
                        </div>
                        <div class="col-12">
                            <input id="name" name="name" type="text" required="required" minlength="2" class="form-control" placeholder="Ex.: Empresa de Carros & Cia"/>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-12 text-left">
                            <h6 class="form-text">Primeiro nome</h6>
                        </div>
                        <div class="col-12">
                            <input id="first_name" name="first_name" type="text" required="required" class="form-control" placeholder="Ex.: Pedro"/>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-12 text-left">
                            <h6 class="form-text">Sobrenome</h6>
                        </div>
                        <div class="col-12">
                            <input id="last_name" name="last_name" type="text" class="form-control" placeholder="Ex.: da Silva"/>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-12 text-left">
                            <h6 class="form-text">E-mail</h6>
                        </div>
                        <div class="col-12">
                            <input id="email" name="email" type="text" required="required" class="form-control" placeholder="Ex.: mail@sample.com.br"/>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 text-left">
                            <h6 class="form-text">Senha</h6>
                        </div>
                        <div class="col-12">
                            <input id="password" name="password" type="password" class="form-control" placeholder="Ex.: 123@Abc"/>
                        </div>
                    </div>

                
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <button type="submit"  class="btn btn-success w-100" style="background-color:#7800D2;border:none;">Cadastrar-se</button>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mt-1 mt-md-0">
                                <a href="/admin/entrar" type="button" class="btn btn-secondary border-0 w-100">Voltar</a>
                            </div>
                            
                        </div>
                    </div>

                @csrf
            </form>
            </div>

        </div>
    </div>
@endsection