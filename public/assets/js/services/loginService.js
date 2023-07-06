import Api from "../utils/api.js";
import Cookie from "../utils/cookie.js";

const api = new Api('users/login')
const cookie = new Cookie()

const loginButton = document.getElementById('login')
if (loginButton) registerLoginEvent()

const logoffButton = document.getElementById('logoff')
if (logoffButton) registerLogoffEvent()

const recoverButton = document.querySelector('[recover]')
if (recoverButton) registerRecoverpasswordEvent()

const emailInput = document.getElementById('email')
const passwordInput = document.getElementById('password')

if (emailInput) emailInput.addEventListener('input', () => data.email = emailInput.value)
if (passwordInput) passwordInput.addEventListener('input', () => data.password = passwordInput.value)

const data = {
    email: null,
    password: null
}

function registerLoginEvent() {
    loginButton.addEventListener('click', () => {
        api.post(data)
        .then((res) => {
            if (!res.ok) throw Error(res.status)
            else return res.json()
        })
        .then((response) => {
            window.localStorage.setItem('adm_token', response.data.token)
            
            let days = 1
            if (document.getElementById('keep_connected').checked) days = 7

            cookie.set('adm_token', response.data.token, days)

            window.location = `${window.origin}/admin`
        })
        .catch((e) => {
            const errorInput = document.getElementById('error-message')
            errorInput.hidden = false
            errorInput.innerHTML = 'Usuário ou senha inválidos, tente novamente.'
        })
    })
}

function registerLogoffEvent() {
    logoffButton.addEventListener('click', () => {
        window.localStorage.removeItem('adm_token')
        cookie.remove('adm_token')
        window.location = `${window.origin}/admin/entrar`
    })
}

function registerRecoverpasswordEvent() {
    recoverButton.addEventListener('click', () => {
        const recoverRequest = new Api('users/recover-password')
        recoverRequest.post(data)
        .then((res) => {
            if (!res.ok) throw Error(res.statusText)
            else return res.status
        })
        .then(status => {
            const alert = document.getElementById('alert')
            alert.hidden = false
            alert.classList.add('alert-success')
            alert.innerHTML = 'Email enviado com sucesso, confira sua caixa de entrada!'
        })
        .catch((e) => {
            const alert = document.getElementById('alert')
            alert.hidden = false
            alert.classList.add('alert-danger')
            alert.innerHTML = 'Verifique o email digitado e tente novamente.'
        })
    })
}