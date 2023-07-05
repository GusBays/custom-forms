import Api from "../utils/api.js";

const api = new Api('users')

const createButton = document.getElementById('create-user')
if (createButton) registerCreateEventListener()

const firstNameInput = document.getElementById('first_name')
const lastNameInput = document.getElementById('last_name')
const emailInput = document.getElementById('email')
const passwordInput = document.getElementById('password')
const passwordRepeatInput = document.getElementById('password-repeat')
const typeInput = document.getElementById('type')

firstNameInput.addEventListener('input', () => data.first_name = firstNameInput.value)
lastNameInput.addEventListener('input', () => data.last_name = lastNameInput.value)
emailInput.addEventListener('input', () => data.email = emailInput.value)
passwordInput.addEventListener('input', () => data.password = passwordInput.value)
passwordRepeatInput.addEventListener('input', () => {
    if (passwordRepeatInput.value !== passwordInput.value) passwordRepeatInput.classList.add('is-invalid')
    else passwordRepeatInput.classList.remove('is-invalid')
})
// typeInput.addEventListener('input', () => data.type = typeInput.value)

const data = {
    first_name: null,
    last_name: null,
    email: null,
    password: null,
    type: typeInput.value
}

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
            const toastEl = document.querySelector('.toast')
            const toast = bootstrap.Toast.getOrCreateInstance(toastEl)
            toast.show()
        })
    })
}

function getValue(inputId) {
    return document.getElementById(inputId).value
}

function getUpdateData() {
    return {
        first_name: getValue('first_name'),
        last_name: getValue('last_name'),
        email: getValue('email'),
        password: getValue('password'),
        type: getValue('type')
    }
}