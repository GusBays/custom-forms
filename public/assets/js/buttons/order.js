onload=checkButtons();

function checkButtons() {
    const sort = getUrlParams().get('sort');

    if (null === sort) return;

    if (sort == 'id') {
        document.getElementById('older-first').checked = true;
    } else {
        document.getElementById('newer-first').checked = true;
    }
}

function sortByAsc() {
    const urlParams = getUrlParams();

    urlParams.set('sort', 'id');

    window.location.search = urlParams;
}

function sortByDesc() {
    const urlParams = getUrlParams();

    urlParams.set('sort', '-id');

    window.location.search = urlParams;
}

function getUrlParams() {
    return new URLSearchParams(window.location.search);
}