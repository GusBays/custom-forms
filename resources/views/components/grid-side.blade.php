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
                @if ($searchField)
                    <div class="col-12 text-center mb-1">
                        <div class="d-inline-flex w-50">
                            <input class="form-control" type="text" id="search-input" placeholder="Buscar">
                            <button class="btn" onclick="search()">
                                <img src="{{ env('APP_URL') }}/assets/img/search-icon.svg" width="30" height="30" alt="">
                            </button>
                        </div>
                    </div>
                    <script onload="insertValue()" src="{{ env('APP_URL') }}/assets/js/buttons/search.js"></script>
                @endif 
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
                        <div class="dropdown">
                            <button class="btn btn-warning dropdown-toggle w-50" type="button" style="color:white" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ env('APP_URL') }}/assets/img/sort-icon.svg" alt="" width="25" height="20">
                              Ordenar
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <div class="form-check">
                                    <li>
                                        <input class="form-check-input" onclick="sortByAsc()" type="radio" name="flexRadioDefault" id="older-first">
                                        <label class="form-check-label ms-1" for="flexRadioDefault1">
                                          Criados em: (antigos primeiro)
                                        </label>
                                    </li>
                                </div>
                                <div class="form-check">
                                    <li>
                                        <input class="form-check-input" onclick="sortByDesc()" type="radio" name="flexRadioDefault" id="newer-first">
                                        <label class="form-check-label ms-1" for="flexRadioDefault1">
                                          Criados em: (novos primeiro)
                                        </label>
                                    </li>
                                </div>
                            </ul>
                          </div>
                    </div>
                    <script onload="checkButtons()" src="{{ env('APP_URL') }}/assets/js/buttons/order.js"></script>
                @endif
            </div>
        @endif

    </div>
</div>
<!-- End grid-side component -->