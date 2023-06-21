<!-- Start grid-side component -->
<div class="col-12 col-lg-5">
    <div class="mb-2 mb-lg-0">
        <h2 class="text-center">
            @if ($hasIcon)
                <img src="{{ $iconUrl }}" class="me-1" width="30" height="30">
            @endif
            {{ $title }}
        </h2>
        @if ($hasExtraImage)
            <div class="d-none d-lg-block">
                <img src="{{ $extraImageUrl }}" class="img-fluid w-50">
            </div>
        @endif
    </div>
</div>
<!-- End grid-side component -->