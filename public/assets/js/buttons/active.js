// import createToast from "../notifications/toast.js";

onload=checkActive();

function checkActive() {
    const inputs = getActiveSwitchs();

    inputs.forEach((input) => {
        if (true == input.value) {
            input.checked = true;
            input.classList.add('bg-success');
        } else {
            input.checked = false;
            input.classList.add('bg-danger');
        }
    })
}

function updateActive(resource, id, active) {
    disableButtons()

    const input = document.getElementById(`active-switch-${id}`)

    const uri = `/api/${resource}/${id}`;

    if (true == active) active = false;
    else active = true;

    const data = {
        active: active
    }
    
    try {
        fetch(uri, 
            { 
                method: 'PUT',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
    } catch (e) {
        return alert(e)
    }

    window.location = window.location.search
}

function disableButtons() {
    const inputs = getActiveSwitchs();

    inputs.forEach((input) => {
        input.disabled = true
    })
}

function enableButtons() {
    const inputs = getActiveSwitchs();

    inputs.forEach((input) => {
        input.disabled = false;
    })
}

function getActiveSwitchs() {
    return document.querySelectorAll('.active-switch');
}