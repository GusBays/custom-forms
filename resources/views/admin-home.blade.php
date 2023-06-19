@extends('admin')

@section('title')
    Admin
@endsection

@section('admin-content')
    <div class="col-12 mb-3">
        <h3>Olá {{ $user->getName() }}!</h3>
        <h4 class="text-muted">Você tem {{ count($forms) }} formulários criados em {{ $organization->getName() }}, aqui estão os mais recentes:</h4>
    </div>

    <div class="row">
        @foreach ($forms as $form)
            @include('snippets/form-card')
        @endforeach
    </div>

    @include('snippets/footer')
@endsection