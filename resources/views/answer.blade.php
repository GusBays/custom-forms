@extends('default')

@section('scripts')
    <script type="text/javascript" src="{{ env('APP_URL') }}/assets/js/validations/recaptcha.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
@endsection


@section('title')
    {{ $form->getName() }}
@endsection

@section('content')
<div class="container">
    <div class="row align-items-center justify-content-center vh-100">
        <div class="col-10 col-md-8 col-lg-6">
            <div class="shadow p-3 mb-5 bg-body-tertiary rounded">

                <div class="row" id="filler-email">
                    <div class="col-12">
                        <div class="form-title mb-3">
                            <h3 class="text-center">Preenchimento de formulário {{ $form->getName() }}</h3>
                        </div>
                    </div>
                    <div class="col-12">
                        <small class="text-body-secondary text-center">
                            Para começar, preencha seu email no campo abaixo:
                        </small>
                    </div>

                     <div class="col">
                        <input id="email" name="email" type="email" class="form-control" placeholder="Email"/>
                    </div>
    
                    <div id="recaptcha"></div>
                    <div class="col-12 mt-2">
                        <button type="submit" id="confirm-button" class="btn btn-success border-0 w-100" style="background-color:#7800D2" recover disabled>Confirmar</button>
                    </div>
                </div>

                <div class="row" id="fields-to-answer" hidden>
                    <h3>{{ $form->getName() }}</h3>
                    <div class="col">
                        <input type="text" id="form-id" value="{{ $form->getId() }}" hidden>
                        @foreach ($form->getFormFields() as $field)
                            <input type="text" id="field-id" value="{{ $field->getId() }}" hidden>
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ $field->getName() }}</label>
                                <br>
                                <small class="text-muted">{{ $field->getDescription() }}</small>
                                @if ('text' === $field->getType())
                                    <input class="form-control" type="text" dataset-field-id="{{ $field->getId() }}">
                                @elseif ('blocked' === $field->getType())
                                    <input class="form-control" type="text" disabled dataset-field-id="{{ $field->getId() }}">
                                @elseif ('checkbox' === $field->getType())
                                    @foreach ($field->getContent() as $option)
                                        <input class="form-control" type="checkbox" value="{{ $option }}" dataset-field-id="{{ $field->getId() }}">
                                    @endforeach
                                @elseif ('select' === $field->getType())
                                    <select class="form-select" dataset-field-id="{{ $field->getId() }}">
                                        @foreach ($field->getContent() as $option)
                                            <option value="{{ $option }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="col-12 mt-2">
                        <button type="submit" id="confirm-button" class="btn btn-success border-0 w-100" style="background-color:#7800D2">Enviar resposta</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="module" src="{{ env('APP_URL') }}/assets/js/services/answerService.js"></script>
@endsection