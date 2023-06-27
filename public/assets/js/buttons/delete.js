function deleteRegisters(resource, pagePath) {
    const selectedRegisters = document.querySelectorAll('#delete-checkbox');

    selectedRegisters.forEach(input => {
        if (false === input.checked && false === isSingleRegister()) return;

        else deleteResource(resource, input.value)
    });

    if (isSingleRegister()) window.location.replace('/admin/' + pagePath);
    else window.location.href = window.location.href
}

function getIdFromPath() {
    const path = window.location.pathname.split('/');

    return parseInt(path[3]);
}

function isSingleRegister() {
    const id = getIdFromPath();

    if (false === Number.isInteger(id)) return false;
    else return true;
}

function deleteResource(resource, id) {
    fetch('/api/' + resource + '/' + id, 
        { method: 'DELETE'}
    )
}