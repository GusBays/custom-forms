<nav class="navbar mb-3">
    <div class="container">

    <a href="/admin" class="navbar-brand">
        <img src="{{ env('APP_URL') }}/assets/img/notebook-icon.svg" alt="notebook icon" width="30" height="24" class="d-inline-block align-text-top">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="modal" data-bs-target="#sidebar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="modal fade" id="sidebar" tabindex="-1" aria-hidden="true" style="width: 300px">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="width:300px">
                <div class="modal-header">
                    <img src="{{ env('APP_URL') }}/assets/img/notebook-icon.svg" alt="notebook icon" width="30" height="24" class="d-inline-block align-text-top">
                <button type="button" class="btn-close text-start" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="navbar-nav">
                        <li class="nav-item list-group list-group-item-action mb-1">
                            <a class="navbar-brand" href="/admin">
                                <img src="{{ env('APP_URL') }}/assets/img/home-icon.svg" alt="home icon" width="30" height="24">
                                Início
                            </a>
                        </li>
                        <li class="nav-item list-group list-group-item-action mb-1">
                            <a class="navbar-brand" href="/admin/formularios">
                                <img src="{{ env('APP_URL') }}/assets/img/form-icon.svg" alt="form icon" width="30" height="30">
                                Formulários
                            </a>
                        </li>
                        <li class="nav-item list-group list-group-item-action mb-1">
                            <a class="navbar-brand" href="/admin/formulários/respostas">
                                <img src="{{ env('APP_URL') }}/assets/img/pencil-icon.svg" alt="pencil icon" width="30" height="30">
                                Respostas
                            </a>
                        </li>
                        <li class="nav-item list-group list-group-item-action mb-1">
                            <a class="navbar-brand" href="/admin/preenchedores?sort=-id&limit=25&page=1">
                                <img src="{{ env('APP_URL') }}/assets/img/filler-icon.svg" alt="filler icon" width="29" height="28">
                                Preenchedores
                            </a>
                        </li>
                        <li class="nav-item list-group list-group-item-action mb-1">
                            <a class="navbar-brand" href="/admin/relatorios">
                                <img src="{{ env('APP_URL') }}/assets/img/report-icon.svg" alt="report icon" width="28" height="32">
                                Relatórios
                            </a>
                        </li>
                        <li class="nav-item list-group list-group-item-action mb-1">
                            <a class="navbar-brand" href="/admin/usuarios?sort=id&limit=100&page=1">
                                <img src="{{ env('APP_URL') }}/assets/img/user-icon.svg" alt="user icon" width="30" height="30">
                                Usuários
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#logoff">
                        Sair
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Fechar
                    </button>
                </div>
            </div>
        </div>
    </div>

  <div class="modal fade" id="logoff" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Deseja realmente sair?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Não esqueça de salvar todos os dados antes de fazer logoff.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <a class="btn btn-danger" id="logoff" type="button" >Sair</a>
        </div>
      </div>
    </div>
  </div>
</nav>

<script type="module" src="{{ env('APP_URL') }}/assets/js/services/loginService.js"></script>