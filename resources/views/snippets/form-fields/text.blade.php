<div class="col">
    <div class="mb-3">
        <label for="name" class="form-label">Nome do campo</label>
        <input type="text" class="form-control" value="{{ $field->getName() }}">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Descrição do campo</label>
        <input type="text" class="form-control" value="{{ $field->getDescription() }}">
    </div>
    <div class="form-check form-switch align-self-center  mb-3">
        <label for="active" class="form-label">Obrigatório</label>
        <input class="form-check-input active-switch" value="{{ $field->getRequired() }}" type="checkbox" role="switch"
            @if($field->getRequired())
                checked
            @endif
        >
    </div>
</div>
