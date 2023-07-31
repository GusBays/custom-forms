@extends('emails.mail-default')

@section('content')
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container top-0 end-0 p-3">
            <div class="toast align-items-center text-bg-dark border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div id="toast-message" class="toast-body">Senha copiada com sucesso!</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-12 col-lg-8">
                <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
                    <h4 class="mb-3">Olá {{ $user->getName() }}!</h4>
                    <p>
                        Recebemos uma solicitação para troca de senha do seu usuário, portanto segue abaixo sua nova senha para acesso à plataforma:
                    </p>
                    <div class="input-group mb-3">
                        <button class="input-group-text btn" id="show-password"><img src="{{ env('APP_URL') }}/assets/img/show-icon.svg" width="25" height="25" alt="show"></button>
                        <button class="input-group-text btn" id="hide-password" hidden><img src="{{ env('APP_URL') }}/assets/img/hide-icon.svg" width="25" height="25" alt="show"></button>
                        <input class="form-control" type="text" id="new-password" disabled>
                        <button class="input-group-text btn" id="copy" hidden><img src="{{ env('APP_URL') }}/assets/img/copy-icon.svg" alt="copy" width="25" height="25"></button>
                    </div>
                    <div class="border-top">
                        <p class="mt-3">Acesse agora seu painel administrativo!</p>
                    </div>
                    <a type="button" class="btn btn-success theme-color border-0" href="{{ env('APP_URL') }}/admin/entrar" target="_blank">
                        Clique aqui
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        const showButton = document.getElementById('show-password')
        const hideButton = document.getElementById('hide-password')
        const passwordInput = document.getElementById('new-password')
        const copyButton = document.getElementById('copy')

        showButton.addEventListener('click', () => {
            showButton.hidden = true
            hideButton.hidden = false
            passwordInput.value = '{{ $password }}'
            copyButton.hidden = false
        })

        hideButton.addEventListener('click', () => {
            hideButton.hidden = true
            showButton.hidden = false
            passwordInput.value = ''
            copyButton.hidden = true
        })

        copyButton.addEventListener('click', () => {
            navigator.clipboard.writeText(passwordInput.value);
            const toastEl = document.querySelector('.toast')
            const bootstrapToast = bootstrap.Toast.getOrCreateInstance(toastEl)
            bootstrapToast.show();
        })
    </script>
@endsection