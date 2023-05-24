@extends('default')

@section('title')
    Admin
@endsection

@section('content')
    <div class="container">
        @include('sidebar')

        <h3>Olá {{ $user->getName() }}!</h3>

        <div class="container-fluid">
            <h4>Você tem {{ count($forms) }} formulários criados em {{ $organization->getName() }}, aqui estão os mais recentes:</h4>
            <div class="row">
                @php $count = 1 @endphp
                @foreach ($forms as $form)
                    <div class="col">
                        <h5>{{ $form->getName() }}</h5>
                        <p>Criado em: {{ formatDate($form->getCreatedAt()) }}</p>
                    </div>
                    @php $count ++ @endphp
                    @if ($count > 6) @break @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection