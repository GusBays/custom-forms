import Api from "../utils/api.js";
import Cookie from "../utils/cookie.js";

const api = new Api('organizations')
const cookie = new Cookie();

const createButton = document.querySelector('[register]')
if (createButton) registerCreateEventListener()

const nameInput = document.getElementById('name')
const firstNameInput = document.getElementById('first_name')
const lastNameInput = document.getElementById('last_name')
const emailInput = document.getElementById('email')
const passwordInput = document.getElementById('password')
const passwordRepeatInput = document.getElementById('password-repeat')

const data = {}

nameInput.addEventListener('input', () => data.name = nameInput.value)
firstNameInput.addEventListener('input', () => data.first_name = firstNameInput.value)
lastNameInput.addEventListener('input', () => data.last_name = lastNameInput.value)
emailInput.addEventListener('input', () => data.email = emailInput.value)
passwordInput.addEventListener('input', () => data.password = passwordInput.value)
passwordRepeatInput.addEventListener('input', () => {
    if (passwordRepeatInput.value !== passwordInput.value) passwordRepeatInput.classList.add('is-invalid')
    else passwordRepeatInput.classList.remove('is-invalid')
})

function registerCreateEventListener() {
    createButton.addEventListener('click', () => {
        api.post(data)
        .then((res) => {
            if (!res.ok) throw Error(res.statusText)
            else return res.json()
        })
        .then(response => {
            const byType = (user) => 'owner' === user.type
            const owner = response.users.filter(byType)[0]

            window.localStorage.setItem('adm_token', owner.token)
            cookie.set('adm_token', owner.token, 1)

            window.location = `${window.origin}/admin`
        })
        .catch((e) => {
            const errorInput = document.getElementById('error-message')
            errorInput.hidden = false
            errorInput.innerHTML = 'Ocorreu um erro ao registrar sua organização, tente novamente.'
        }) 
    })
}