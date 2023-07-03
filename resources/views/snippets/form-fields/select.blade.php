<div class="col">
    <div class="mb-3">
        <label for="name" class="form-label">Nome do campo</label>
        <input type="text" class="form-control" value="{{ $field->getName() }}">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Descrição do campo</label>
        <input type="text" class="form-control" value="{{ $field->getDescription() }}">
    </div>
    <div class="mb-3">
        <label for="type" class="form-label">Tipo</label>
        <input type="text" class="form-control" value="Select" disabled>
    </div>
    <div class="form-check form-switch align-self-center mb-3">
        <label for="active" class="form-label">Obrigatório</label>
        <input class="form-check-input active-switch" value="{{ $field->getRequired() }}" type="checkbox" role="switch"
            @if($field->getRequired())
                checked
            @endif
        >
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Opções</label>
        @foreach ($field->getContent() as $option)
            <input class="col-12 form-control mb-1" type="select" value="{{ $option }}">
        @endforeach
    </div>
</div>
