@extends('emails.mail-default')

@section('content')
    <h1>Olá</h1>
    <h4>Você recebeu uma nova resposta no formulário {{ $form->getName() }}!</h4>
    <h4>Acesse agora seu painel para conferir</h4>
    <a href="{{ env('APP_URL') }}/admin" target="_blank">Clique aqui</a>
@endsection