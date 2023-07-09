import Api from "../utils/api.js";
import Toast from "../utils/toast.js";

const api = new Api('users')

const createButton = document.getElementById('create-user')
if (createButton) registerCreateEventListener()

const updateButton = document.getElementById('update-user')
if (updateButton) registerUpdateEventListener()

const idInput = document.getElementById('id')
const firstNameInput = document.getElementById('first_name')
const lastNameInput = document.getElementById('last_name')
const emailInput = document.getElementById('email')
const passwordInput = document.getElementById('password')
const passwordRepeatInput = document.getElementById('password-repeat')
const typeInput = document.getElementById('type')

const data = {}

if (idInput) data.id = idInput.value
firstNameInput.addEventListener('input', () => data.first_name = firstNameInput.value)
lastNameInput.addEventListener('input', () => data.last_name = lastNameInput.value)
emailInput.addEventListener('input', () => data.email = emailInput.value)
passwordInput.addEventListener('input', () => data.password = passwordInput.value)
passwordRepeatInput.addEventListener('input', () => {
    if (passwordRepeatInput.value !== passwordInput.value) passwordRepeatInput.classList.add('is-invalid')
    else passwordRepeatInput.classList.remove('is-invalid')
})
if (typeInput) data.type = typeInput.value

function registerCreateEventListener() {
    createButton.addEventListener('click', function () {
        api.post(data)
        .then((res) => {
            if (!res.ok) throw Error(res.statusText)
            else return res.json()
        })
        .then(data => {
            window.location = window.origin + `/admin/usuarios/${data.id}`
        })
        .catch((e) => {
            return new Toast()
                .show('Ocorreu um erro ao criar o registro, tente novamente')
        })
    })
}

function registerUpdateEventListener() {
    updateButton.addEventListener('click', function () {
        api.put(data.id, data)
        .then((res) => {
            if (!res.ok) throw Error(res.statusText)
            else return res.json
        })
        .then(data => {
            window.location.reload()
        })
        .catch((e) => {
            return new Toast()
                .show('Ocorreu um erro ao atualizar o registro, tente novamente.')
        })
    })
}