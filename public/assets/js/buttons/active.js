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
    
    fetch(uri, 
        { 
            method: 'PUT',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then((res) => {
            if (res.ok) window.location = window.location.search
            else {
                input.classList.add('bg-warning')
                const toastEl = document.querySelector('.toast')
                const toast = bootstrap.Toast.getOrCreateInstance(toastEl)
                toast.show()
            }
        })

    enableButtons()
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