onload=insertValue();

function insertValue() {
    const search = getUrlParams().get('q');

    if (null === search) return;

    document.getElementById('search-input').value = search;
}

function search() {
    const search = document.getElementById('search-input').value

    const urlParams = getUrlParams();

    if (search) {
        urlParams.set('q', search);

        window.location.search = urlParams
    } else if ('' === search && urlParams.get('q')) {
        urlParams.delete('q');

        window.location.search = urlParams
    } else {
        return;
    }
}

function getUrlParams() {
    return new URLSearchParams(window.location.search);
}