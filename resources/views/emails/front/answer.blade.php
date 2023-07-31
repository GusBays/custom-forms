@extends('emails.mail-default')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-12 col-lg-8">
                <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
                    <h4 class="mb-3">Olá {{ $filler->getName() }}!</h4>
                    <p>
                        Recebemos sua resposta no {{ $form->getName() }} e já informamos os admininstradores sobre o seu preenchimento.
                        Abaixo você pode fazer download de um arquivo PDF com a cópia das suas respostas ou então visualizá-las através deste link: 
                        <a href="{{ env('APP_URL') }}/responder/{{ $form->getSlug() }}?email={{ $filler->getEmail() }}" class="link-theme-color" target="_blank"><span class="font-bold">Acessar respostas na web</span></a>
                    </p>
                    <div class="border-top">
                        <p class="mt-3">Faça download do arquivo através do botão abaixo:</p>
                    </div>
                    <a type="button" class="btn btn-success theme-color border-0" href="{{ $file }}" download="{{ $form->getName() }}.pdf">
                        Clique aqui
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection