<nav class="navbar mb-3">
    <div class="container">

    <a href="/admin" class="navbar-brand">
        <img src="{{ env('APP_URL') }}/assets/notebook-icon.svg" alt="notebook icon" width="30" height="24" class="d-inline-block align-text-top">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="modal" data-bs-target="#sidebar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="modal fade" id="sidebar" tabindex="-1" aria-hidden="true" style="width: 300px">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="width:300px">
                <div class="modal-header">
                    <img src="{{ env('APP_URL') }}/assets/notebook-icon.svg" alt="notebook icon" width="30" height="24" class="d-inline-block align-text-top">
                <button type="button" class="btn-close text-start" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="navbar-brand" href="/admin">Início</a>
                        </li>
                        <li class="nav-item">
                            <a class="navbar-brand" href="/formularios">Formulários</a>
                        </li>
                        <li class="nav-item">
                            <a class="navbar-brand" href="/formulários/respostas">Respostas</a>
                        </li>
                        <li class="nav-item">
                            <a class="navbar-brand" href="/preenchedores">Preenchedores</a>
                        </li>
                        <li class="nav-item">
                            <a class="navbar-brand" href="/relatorios">Relatórios</a>
                        </li>
                        <li class="nav-item">
                            <a class="navbar-brand" href="/usuarios">Usuários</a>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color:#7800D2;border:none;">Fechar</button>
                </div>
            </div>
        </div>
    </div>


    </div>
</nav>