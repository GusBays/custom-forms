@extends('admin')

@section('title')
    Usuários
@endsection

@section('admin-content')
    <table class="table table-striped shadow p-3 bg-body-tertiary rounded">
        <thead>
            <tr>
                <th scope="col">Id</th>
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
                        <a href="/usuarios/{{ $user->getId() }}">
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
                        </a>
                    </th>
                </tr>

            @endforeach

        </tbody>
    </table>

    @include('snippets/footer-pagination')
@endsection