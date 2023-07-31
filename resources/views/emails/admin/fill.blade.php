@extends('emails.mail-default')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-12 col-lg-8">
                <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
                    <h4 class="mb-3">Nova resposta registrada!</h4>
                    <p>
                        Identificamos uma nova resposta no {{ $form->getName() }}, preenchida por {{ $filler->getName() }}.
                    </p>
                    <div class="border-top">
                        <p class="mt-3">Acesse agora seu painel administrativo para conferir todos os detalhes!</p>
                    </div>
                    <a type="button" class="btn btn-success theme-color border-0" href="{{ env('APP_URL') }}/admin/respostas/{{ $answer->getId() }}" target="_blank">
                        Clique aqui
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection