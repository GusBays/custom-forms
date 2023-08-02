<div id="users" class="my-3" data-tab-info>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Tipo</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($form->getFormUsers() as $formUser)
                <tr class="col">
                    <input type="text" id="form-user-id" value="{{ $formUser->getId() }}" hidden>
                    <td>{{ $formUser->getUser()->getName() }}</td>
                    <td id="form-user-email">{{ $formUser->getUser()->getEmail() }}</td>
                    <td>
                        <select id="form-user-type" class="form-select" data-form-user-id="{{ $formUser->getId() }}">
                            <option 
                                @if ('creator' === $formUser->getType()) 
                                    selected 
                                @else
                                    disabled
                                @endif 
                            value="creator">Criador</option>
                            <option
                                @if ('editor' === $formUser->getType())
                                    selected
                                @endif
                            value="editor">Editor</option>
                            <option
                                @if ('viewer' === $formUser->getType())
                                    selected
                                @endif
                                value="viewer">Visualizador</option>
                        </select>
                    </td>
                    <td><button class="btn btn-danger" id="delete-user" data-form-user-id="{{ $formUser->getId() }}"
                        @if ('creator' === $formUser->getType())
                            disabled
                        @endif
                        >Remover usuário</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button  type="button" class="btn btn-success" id="add-user-modal-button" data-bs-toggle="modal" data-bs-target="#addUserModal">Adicionar novo usuário ao formulário</button>
</div>

<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar usuário ao formulário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Adicionar</th>
                            <th scope="col">Email</th>
                            <th scope="col">Tipo</th>
                        </tr>
                    </thead>
                    <tbody id="users-list">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary border-0" data-bs-dismiss="modal">Voltar</button>
                <button type="button" class="btn btn-success border-0 theme-color" id="create-form-users">Adicionar usuários</button>
            </div>
        </div>
    </div>
</div>