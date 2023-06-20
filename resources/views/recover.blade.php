@extends('default')

@section('title')
    Recuperação de senha
@endsection

@section('content')
    <div class="container">
        <div class="row align-items-center justify-content-center vh-100">
            <div class="col-10 col-md-8 col-lg-6">
                <form method="POST" action="/action/recover-password" class="shadow p-3 mb-5 bg-body-tertiary rounded">

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

                    <div class="row my-3">
                        <div class="col">
                            <input id="email" name="email" type="email" class="form-control" placeholder="Email"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <button type="submit" class="btn btn-success border-0 w-100 theme-color">Confirmar</button>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mt-1 mt-md-0">
                                <a type="button" href="/admin/entrar" class="btn btn-secondary border-0 w-100">Voltar</a>
                            </div>
                        </div>
                    </div>

                    @csrf
                </form>
            </div>
        </div>
    </div>
@endsection