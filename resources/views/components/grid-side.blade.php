<!-- Start grid-side component -->
<div class="col-12 col-lg-5">
    <div class="mb-2 mb-lg-0">
        <h2 class="text-center">
            @if ($iconUrl)
                <img src="{{ $iconUrl }}" class="me-1" width="30" height="30">
            @endif

            {{ $title }}
        </h2>

        @if ($extraImageUrl)
            <div class="d-none d-lg-block">
                <img src="{{ $extraImageUrl }}" class="img-fluid w-50">
            </div>
        @endif

        @if ($showButtons)
            <div class="mt-3">
                <div class="col-12 text-center mb-1">
                    <a href="/admin/{{ $pathResource }}/novo" type="button" class="btn btn-success w-50">
                        <img src="{{ env('APP_URL') }}/assets/img/add-icon.svg" alt="" width="25" height="25">
                        Adicionar novo {{ $buttonResource }}
                    </a>
                </div>
                <div class="col-12 text-center mb-1">
                    <a href="/action/{{ $pathResource }}/delete" type="button" class="btn btn-danger w-50">
                        <img src="{{ env('APP_URL') }}/assets/img/trash-icon.svg" alt="" width="25" height="25">
                        Deleter registros
                    </a>
                </div>
                <div class="col-12 text-center">
                    <a href="/action/{{ $pathResource }}/filter" type="button" class="btn btn-primary w-50">
                        Filtrar
                    </a>
                </div>
            </div>
        @endif

    </div>
</div>
<!-- End grid-side component -->