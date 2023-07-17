import Api from "../utils/api.js"
import Toast from "../utils/toast.js"

const api = new Api('form-users')

const formUsersIdInput = document.querySelectorAll('#form-user-id')
const formUsersTypeSelect = document.querySelectorAll('#form-user-type')

const deleteButtons = document.querySelectorAll('#delete-user')

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