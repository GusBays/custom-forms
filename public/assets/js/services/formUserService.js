const formUsersIdInput = document.querySelectorAll('#form-user-id')
const formUsersTypeSelect = document.querySelectorAll('#form-user-type')

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

        formUsers.push(formUser)
    }

    return formUsers
}