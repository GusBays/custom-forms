import Api from "../utils/api.js";

const api = new Api('/users')

const createButton = document.getElementById('create-user');
if (createButton) registerCreateEventListener()

function registerCreateEventListener() {
    createButton.addEventListener('click', function () {
        api.post({
            first_name: getValue('first_name'),
            last_name: getValue('last_name'),
            email: getValue('email'),
            password: getValue('password'),
            type: getValue('type')
        })
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