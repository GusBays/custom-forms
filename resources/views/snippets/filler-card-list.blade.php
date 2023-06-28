<div class="list-group shadow p-3 mb-0 bg-body-tertiary rounded">
    <div class="d-inline-flex">
        <a class="list-group-item list-group-item-action" href="/admin/preenchedores/{{ $filler->getId() }}">
            <h5 class="text-center"> {{ $filler->getName() }}</h5>      
            <h6>Endereço de email: {{ $filler->getEmail() }}</h6>
            <h6>Cadastrado em: {{ formatDate($filler->getCreatedAt()) }}</h6>
        </a>
    </div>
</div>