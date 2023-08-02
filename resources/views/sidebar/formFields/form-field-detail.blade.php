<div id="fields" data-tab-info>
    <div class="text-muted my-3 border-bottom " id="count-fields">Você tem um total de {{ count($form->getFormFields()) }} campos cadastrados neste formulário.</div>
    @foreach ($form->getFormFields() as $field)
        <div class="border-bottom mb-3">
            <input type="text" id="field-id" value="{{ $field->getId() }}" hidden>
            <div class="mb-3">
                <label for="name" class="form-label">Nome do campo</label>
                <input type="text" class="form-control" id="field-name" value="{{ $field->getName() }}" data-field-id={{ $field->getId() }}>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrição do campo</label>
                <textarea class="form-control text-top description-input" id="field-description" data-field-id={{ $field->getId() }}>{{ $field->getDescription() }}</textarea>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Tipo</label>
                <select id="field-type" class="form-select" data-field-id="{{ $field->getId() }}">
                    <option 
                        @if ('text' === $field->getType()) 
                            selected 
                        @endif
                    value="text">Texto</option>
                    <option
                        @if ('checkbox' === $field->getType())
                            selected
                        @endif
                    value="checkbox">Checkbox</option>
                    <option
                        @if ('select' === $field->getType())
                            selected
                        @endif
                        value="select">Seletor</option>
                    <option
                        @if ('blocked' === $field->getType())
                            selected
                        @endif
                        value="blocked">Bloqueado</option>
                </select>
            </div>
            <div class="form-check form-switch align-self-center mb-3">
                <label for="active" class="form-label">Obrigatório</label>
                <input class="form-check-input active-switch" id="field-required" value="{{ $field->getRequired() }}" type="checkbox" role="switch"
                    @if('blocked' === $field->getType())
                        disabled
                    @elseif ($field->getRequired())
                        checked
                    @endif
                data-field-id={{ $field->getId() }}>
            </div>
            <div class="mb-3 p-2 rounded" style="background-color: #e9ecef;" id="group-field-content" data-field-id="{{ $field->getId() }}">
                <label for="content" class="form-label">Opções</label>
                @foreach ($field->getContent() as $option)
                    <div class="input-group mb-1">
                        <input type="text" class="form-control" id="field-content" value="{{ $option }}" data-field-id="{{ $field->getId() }}">
                        <button class="input-group-text btn btn-danger" id="delete-option" data-field-id="{{ $field->getId() }}"><img src="{{ env('APP_URL') }}/assets/img/trash-icon.svg" alt="" width="25" height="32"></button>
                    </div>
                @endforeach
                <button class="btn btn-success" id="add-option" data-field-id="{{ $field->getId() }}"><img src="{{ env('APP_URL') }}/assets/img/add-icon.svg" width="25" height="25" alt="add-icon"></button>
            </div>
            <div class="mb-3">
                <button class="btn btn-danger" id="delete-field" data-field-id="{{ $field->getId() }}">Deletar campo</button>
            </div>
        </div>
    @endforeach
    <button id="add-field" type="button" class="btn btn-success mb-3">Adicionar novo campo</button>
</div>