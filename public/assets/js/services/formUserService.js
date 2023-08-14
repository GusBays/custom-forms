import Api from "../utils/api.js"
import Toast from "../utils/toast.js"

const api = new Api('form-users')

const formUsersIdInput = document.querySelectorAll('#form-user-id')
const formUsersTypeSelect = document.querySelectorAll('#form-user-type')
const formUsersEmail = document.querySelectorAll('#form-user-email')

const deleteButtons = document.querySelectorAll('#delete-user')
const addUserModalButton = document.getElementById('add-user-modal-button')
const addUserCreateButton = document.getElementById('create-form-users')

if (addUserModalButton) registerAddUserModalButtonEventListener()
if (addUserCreateButton) registerCreateUserButtonEventListener()

export function getFormUsers() {
    const formUsers = []

    for (let formUserInput of formUsersIdInput) {
        const formUser = {}

        if (formUserInput.value && formUserInput.value !== '') formUser.id = formUserInput.value

        const byId = (element) => element.dataset.formUserId === formUserInput.value
    
        const formUserTypeSelect = Array.from(formUsersTypeSelect).find(byId)
        formUserTypeSelect.addEventListener('change', () => {
            formUser.type = formUserTypeSelect.options[formUserTypeSelect.selectedIndex].value
        })

        const deleteButton = Array.from(deleteButtons).find(byId)
        deleteButton.addEventListener('click', () => {
            api.delete(deleteButton.dataset.formUserId)
            .then(res => {
                if (!res.ok) throw Error(res.statusText)
                else window.location.reload()
            })
            .catch(e => {
                return new Toast()
                    .show('Ocorreu um erro ao deletar usuário do formulário, tente novamente')
            })
        })

        formUsers.push(formUser)
    }

    return formUsers
}

function registerAddUserModalButtonEventListener() {
    addUserModalButton.addEventListener('click', () => {
        const userApi = new Api('users')
        userApi.get()
        .then(res => {
            if (!res.ok) throw Error(res.statusText)
            else return res.json()
        })
        .then(response => {
            loadTable(response.data)
        })
        .catch(e => {
            return new Toast()
                .show('Ocorreu um erro ao buscar os usuários cadastrados, tente novamente.')
        })
    })
}

const formUsersToCreate = []

function loadTable(data) {
    const tableBody = $('#users-list')
    tableBody.empty()

    var html = ''

    for (let user of data) {

        if (Array.from(formUsersEmail).find(element => element.innerText === user.email)) continue

        html += `
            <tr class="col">
                <td><input type="checkbox" value="${user.id}" id="create-user-checkbox"></td>
                <td>${user.email}</td>
                <td>
                    <select class="form-select" id="create-user-type" data-user-id=${user.id}>
                        <option value="editor">Editor</option>
                        <option value="viewer">Visualizador</option>
                    </select>
                </td>
            </tr>
        `
    }

    if ('' === html) html += '<div class="mt-3">Nenhum usuário encontrado</div>'

    tableBody.append(html)

    const formIdInput = document.getElementById('id')
    let formId = null;
    if (formIdInput) formId = formIdInput.value
    const createUserCheckbox = document.querySelectorAll('#create-user-checkbox')
    const createFormUserTypeSelect = document.querySelectorAll('#create-user-type')
    
    for (let checkbox of createUserCheckbox) {
        const newFormUserObj = {
            form_id: formId,
            user_id: checkbox.value
        }

        formUsersToCreate.push(newFormUserObj)

        const index = formUsersToCreate.indexOf(newFormUserObj)

        checkbox.addEventListener('change', () => {
            if (!checkbox.checked) formUsersToCreate.splice(index, 1)

            let selectFormUserType = Array.from(createFormUserTypeSelect).find(element => element.dataset.userId === checkbox.value)
            formUsersToCreate[index].type = selectFormUserType.options[selectFormUserType.selectedIndex].value
            selectFormUserType.addEventListener('change', () => {
                formUsersToCreate[index].type = selectFormUserType.options[selectFormUserType.selectedIndex].value
            })

        })
    }
}

function registerCreateUserButtonEventListener() {
    addUserCreateButton.addEventListener('click', () => {
        formUsersToCreate.forEach(formUser => {

            if (!formUser.type) return;

            api.post(formUser)
            .then(res => {
                if (!res.ok) throw Error(res.statusText)
            })
            .catch(e => {
                return new Toast()
                    .show('Ocorreu um erro ao adicionar usuario ao formulário, tente novamente.')
            })
        })

        window.location.reload()
    })
}