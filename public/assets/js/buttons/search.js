function insertValue() {
    const search = getUrlParams().get('q');

    if (null === search) return;

    document.getElementById('search-input').value = search;
}

function search() {
    const search = document.getElementById('search-input').value

    const urlParams = getUrlParams();

    if ('' === search) {
        urlParams.delete('q');

        window.location.search = urlParams
    } else {
        urlParams.set('q', search);

        window.location.search = urlParams
    }
}

function getUrlParams() {
    return new URLSearchParams(window.location.search);
}