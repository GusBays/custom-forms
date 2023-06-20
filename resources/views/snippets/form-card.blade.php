<div class="col-12 mb-5 col-md-6 col-lg">
    <div class="list-group shadow p-3 mb-0 bg-body-tertiary rounded">
        <a class="list-group-item list-group-item-action" href="/admin/formularios/{{ $form->getId() }}">
            <h5>{{ $form->getName() }}</h5>

            <h6>
                @if (1 == $form->getActive())
                    Ativo
                @else
                    Inativo
                @endif
            </h6>

            <h6>Criado em: {{ formatDate($form->getCreatedAt()) }}</h6>

            @if ($form->getAvailableUntil())
                <h6>Disponível até: {{ formatDate($form->getAvailableUntil()) }}</h6>
            @endif
        </a>

        <a href="/admin/formularios/{{ $form->getId() }}/respostas" type="button" class="list-group-item mt-3 list-group-item-action">
            <h6 class="text-center">Respostas</h6>
            <span class="position-absolute top-0 start-100 translate-middle p-2 border border-light rounded-circle theme-color">
                <span class="visually-hidden">unread messages</span>
            </span>
        </a>
    </div>
</div>