@extends('admin')

@section('title')
    Usuários
@endsection

@section('admin-content')
    <table class="table table-striped shadow p-3 bg-body-tertiary rounded">
        <thead>
            <tr class="col">
                <th scope="col">
                   <a href="{{ getSelfRequestWithOppositeSortDirection() }}" class="text-center list-inline list-inline-item-action">
                        ID
                        @if (isDescSortDirection())
                            <img src="{{ env('APP_URL') }}/assets/down-arrow.svg" alt="down arrow" width="10" height="10">
                        @else
                            <img src="{{ env('APP_URL') }}/assets/up-arrow.svg" alt="down arrow" width="10" height="10">
                        @endif
                    </a>
                </th>
                <th scope="col">Nome</th>
                <th scope="col">E-mail</th>
                <th scope="col">Tipo</th>
                <th scope="col">Data de criação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user) 
                <tr>
                    <th scope="row">
                        <td>{{ $user->getId() }}</td>
                        <td>{{ $user->getName() }}</td>
                        <td>{{ $user->getEmail() }}</td>
                        <td>
                            @if ('owner' === $user->getType())
                                Proprietário
                            @else
                                Integrante
                            @endif
                        </td>
                        <td>{{ formatDate($user->getCreatedAt()) }}</td>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>

    @include('snippets/footer-pagination')
@endsection