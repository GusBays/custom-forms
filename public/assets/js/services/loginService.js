import Api from "../utils/api.js";
import Cookie from "../utils/cookie.js";

const api = new Api('users/login')
const cookie = new Cookie()

const loginButton = document.getElementById('login');
if (loginButton) registerLoginEvent()

const emailInput = document.getElementById('email')
const passwordInput = document.getElementById('password')

emailInput.addEventListener('input', () => {
    data.email = emailInput.value
})

passwordInput.addEventListener('input', () => {
    data.password = passwordInput.value
})

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

