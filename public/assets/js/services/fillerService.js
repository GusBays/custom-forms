import Api from "../utils/api.js";
import Toast from "../utils/toast.js";

const api = new Api('fillers')

const createButton = document.getElementById('create-filler')
if (createButton) registerCreateEventListener()

const updateButton = document.getElementById('update-filler')
if (updateButton) registerUpdateEventListener()

const idInput = document.getElementById('id')
const firstNameInput = document.getElementById('first_name')
const lastNameInput = document.getElementById('last_name')
const emailInput = document.getElementById('email')

const data = {}

if (idInput) data.id = idInput.value
firstNameInput.addEventListener('input', () => data.first_name = firstNameInput.value)
lastNameInput.addEventListener('input', () => data.last_name = lastNameInput.value)
emailInput.addEventListener('input', () => data.email = emailInput.value)

function registerCreateEventListener() {
    createButton.addEventListener('click', () => {
        api.post(data)
        .then((res) => {
            if (!res.ok) throw Error(res.statusText)
            else return res.json()
        })
        .then(data => {
            window.location = `${window.origin}/admin/preenchedores/${data.id}`
        })
        .catch((e) => {
            return new Toast()
                .show('Ocorreu um erro ao criar o registro, tente novamente.')
        })
    })
}

function registerUpdateEventListener() {
    updateButton.addEventListener('click', () => {
        api.put(data.id, data)
        .then((res) => {
            if (!res.ok) throw Error(res.statusText)
            else return res.json()
        })
        .then(response => {
            window.location = `${window.origin}/admin/preenchedores/${response.data.id}`
        })
        .catch((e) => {
            return new Toast()
                .show('Ocorreu um erro ao atualizar o registro, tente novamente.')
        })
    })
}