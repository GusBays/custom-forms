import Api from "../utils/api.js";
import Toast from "../utils/toast.js";
import { createNewFields, getFormFields } from "./formFieldService.js";
import { getFormUsers } from "./formUserService.js";

const api = new Api('forms')

$('document').ready(function() {
    $('#available-until').mask('0000-00-00 00:00');
})

const createButton = document.getElementById('create-form')
if (createButton) registerCreateEventListener()

const updateButton = document.getElementById('update-form')
if (updateButton) registerUpdateEventListener()

const idInput = document.getElementById('id')
const nameInput = document.getElementById('name')
const availableUntilInput = document.getElementById('available-until')
const activeInput = document.getElementById('active')
const fillLimitInput = document.getElementById('fill-limit')
const shouldNotifyEachFillInput = document.getElementById('should-notify-each-fill')

const data = {
    form_fields: getFormFields(),
    form_users: getFormUsers()
}

if (idInput) data.id = idInput.value
nameInput.addEventListener('input', () => data.name = nameInput.value)
availableUntilInput.addEventListener('input', () => data.available_until = formatAvailableUntil())
activeInput.addEventListener('change', () => activeInput.checked ? data.active = true : data.active = false)
fillLimitInput.addEventListener('input', () => data.fill_limit = fillLimitInput.value)
shouldNotifyEachFillInput.addEventListener('change', () => shouldNotifyEachFillInput.checked ? data.should_notify_each_fill = true : data.should_notify_each_fill = false)

function registerCreateEventListener() {
    createButton.addEventListener('click', () => {
        api.post(data)
        .then((res) => {
            if (!res.ok) throw Error(res.statusText)
            else return res.json()
        })
        .then(data => {
            // criar os form users e fields aqui, antes de fazer o redirecionamento.
            window.location = `${window.origin}/admin/formularios/${data.id}`
        })
        .catch((e) => {
            return new Toast()
                .show('Ocorreu um erro ao criar o registro, tente novamente.')
        })
    })
}

function registerUpdateEventListener() {
    updateButton.addEventListener('click', () => {

        createNewFields()

        api.put(data.id, data)
        .then((res) => {
            if (!res.ok) throw Error(res.statusText)
            else return res.json()
        })
        .then(response => {
            // criar os form users e fields aqui, antes de fazer o redirecionamento.
            window.location = `${window.origin}/admin/formularios/${response.data.id}`
        })
        .catch((e) => {
            return new Toast()
                .show('Ocorreu um erro ao atualizar o seu registro, tente novamente.')
        })
    })
}

function formatAvailableUntil() {
    const availableValue = availableUntilInput.value
    if (!availableValue || '' == availableValue) return null

    const date = new Date(availableValue)

    if (!date.toJSON()) {
        availableUntilInput.classList.add('is-invalid')
        if (createButton) createButton.disabled = true
        if (updateButton) updateButton.disabled = true
        return null
    } else {
        if (createButton) createButton.disabled = false
        if (updateButton) updateButton.disabled = false
        availableUntilInput.classList.remove('is-invalid')
    }

    var year = date.getFullYear()
    var month = date.getMonth() + 1 // (0-11)
    var day = date.getDate()
    var hour = date.getHours() == 0 ? '00' : date.getHours()
    var minute = date.getMinutes() == 0 ? '00' : date.getMinutes()

    return `${year}-${month}-${day} ${hour}:${minute}:00`
}