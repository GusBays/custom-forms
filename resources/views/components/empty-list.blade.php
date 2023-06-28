<!-- Start empty-list component -->
<div class="col-12">
    <h3 class="text-center">
        Você ainda não possui nenhum {{ $resource }} cadastrado.
    </h3>

    <h4 class="text-center text-muted mt-1">
        Adicione novos pelo botão abaixo:
    </h4>

    <div class="col-12 text-center mt-1">
        <a href="/admin/{{ $pathResource }}/novo" type="button" class="btn btn-success w-50">
            <img src="{{ env('APP_URL') }}/assets/img/add-icon.svg" alt="" width="25" height="25">
            Adicionar {{ $resource }}
        </a>
    </div>
</div>
<!-- End empty-list component -->