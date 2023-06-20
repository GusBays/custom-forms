<div class="col-12 mb-2 col-sm-10 col-md-8">
    <div class="list-group shadow p-3 mb-0 bg-body-tertiary rounded">
        <a class="list-group-item list-group-item-action" href="/admin/usuarios/{{ $user->getId() }}">
            <h5 class="text-center"> {{ $user->getName() }} 
                @if ('owner' === $user->getType())
                    <span class="badge ms-1 rounded-pill" style="background-color:#7800D2">Proprietário</span>
                @else
                    <span class="badge ms-1 bg-secondary rounded-pill">Integrante</span>
                @endif
            </h5>      
            <h6>Endereço de email: {{ $user->getEmail() }}</h6>
            <h6>Cadastrado em: {{ formatDate($user->getCreatedAt()) }}</h6>
        </a>
    </div>
</div>