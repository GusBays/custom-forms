<div id="users" class="my-3" data-tab-info>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Tipo</th>
            </tr>
        </thead>
        <tbody>
            <tr class="col">
                <td>{{ $user->getName() }}</td>
                <td id="form-user-email">{{ $user->getEmail() }}</td>
                <td>
                    <select id="form-user-type" class="form-select">
                        <option value="creator" selected disabled>Criador</option>
                    </select>
                </td>
        </tbody>
    </table>

    <button  type="button" class="btn btn-success" id="add-user-modal-button" data-bs-toggle="modal" data-bs-target="#addUserModal">Adicionar novo usuário ao formulário</button>

    @include('sidebar/formUsers/form-user-modal')
</div>