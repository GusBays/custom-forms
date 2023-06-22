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

        @if ($shouldShowButton)
            <div class="mt-3">
                @if ($addButton)
                    <div class="col-12 text-center mb-1">
                        <a href="/admin/{{ $pathResource }}/novo" type="button" class="btn btn-success w-50">
                            <img src="{{ env('APP_URL') }}/assets/img/add-icon.svg" alt="" width="25" height="25">
                            Adicionar {{ $buttonResource }}
                        </a>
                    </div>
                @endif
                @if ($deleteButton)
                    <div class="col-12 text-center mb-1">
                        <a href="/action/{{ $pathResource }}/delete" type="button" class="btn btn-danger w-50">
                            <img src="{{ env('APP_URL') }}/assets/img/trash-icon.svg" alt="" width="25" height="25">
                            Deletar
                        </a>
                    </div>
                @endif
                @if ($filterButton)
                    <div class="col-12 text-center mb-1">
                        <a href="/action/{{ $pathResource }}/filter" type="button" class="btn btn-primary w-50">
                            <img src="{{ env('APP_URL') }}/assets/img/filter-icon.svg" alt="" width="25" height="20">
                            Filtrar
                        </a>
                    </div>
                @endif
                @if ($sortButton)
                <div class="col-12 text-center">
                    <a href="/action/{{ $pathResource }}/sort" type="button" class="btn btn-warning w-50" style="color:white">
                        <img src="{{ env('APP_URL') }}/assets/img/sort-icon.svg" alt="" width="25" height="20">
                        Ordernar
                    </a>
                </div>
            @endif
            </div>
        @endif

    </div>
</div>
<!-- End grid-side component -->