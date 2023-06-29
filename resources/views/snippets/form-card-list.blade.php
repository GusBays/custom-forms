<div class="list-group shadow p-3 mb-0 bg-body-tertiary rounded">
    <div class="d-inline-flex">
        <input id="delete-checkbox" class="me-2" type="checkbox" value="{{ $form->getId() }}">
        <a class="list-group-item list-group-item-action" href="/admin/formularios/{{ $form->getId() }}">
            <h5 class="text-center"> {{ $form->getName() }} 
                @if (true === $form->getActive())
                    <span class="badge ms-1 rounded-pill theme-color">Ativo</span>
                @else
                    <span class="badge ms-1 bg-secondary rounded-pill">Inativo</span>
                @endif
            </h5>
            @if ($form->getFillLimit())
                <h6>Limite de preenchimento: {{ $form->getFillLimit() }}</h6>
            @endif
            @if ($form->getAvailableUntil())
                <h6>Disponível até: {{ formatDate($form->getAvailableUntil()) }}</h6>
            @else
                <h6>Criado em: {{ formatDate($form->getCreatedAt()) }}</h6>
            @endif
        </a>
        <div class="form-check form-switch align-self-center ms-2">
            <input class="form-check-input active-switch" id="active-switch-{{$form->getId()}}" onclick="updateActive({{ json_encode('forms') }}, {{ $form->getId() }}, {{ json_encode($form->getActive()) }})" value="{{ $form->getActive() }}" type="checkbox" role="switch">
            <label class="form-check-label" for="flexSwitchCheckDefault">Ativo</label>
        </div>
    </div>
</div>