@extends('admin')

@section('title')
    Novo preenchedor
@endsection

@section('admin-content')
    <div class="row justify-content-beetwen align-items-center">

        <x-grid-side 
        title="Novo preenchedor"
        iconUrl="{{ env('APP_URL') }}/assets/img/filler-icon.svg"
        >
        </x-grid-side>

        <div class="col-12 col-lg-7">
            <form action="/action/filler/new" method="POST" class="shadow p-3 mb-5 bg-body-tertiary rounded">
                <div class="col">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">Primeiro nome</label>
                        <input type="text" name="first_name" class="form-control" value="" id="first_name" placeholder="Ex.: Ana" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Sobrenome</label>
                        <input type="text" name="last_name" class="form-control" value="" id="last_name" placeholder="Ex.: Flores">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" name="email" class="form-control" value="" id="email" placeholder="Ex.: email@exemplo.com.br" required>
                    </div>
                    <div>
                        <input type="text" name="type" value="employee" hidden>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <button type="submit" class="btn btn-success border-0 w-100 theme-color">Criar</button>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mt-1 mt-md-0">
                            <a class="btn btn-secondary w-100" id="back-button" type="button">Voltar</a>
                        </div>
                    </div>
                </div>

                @csrf
            </form>
        </div>
    </div>
@endsection