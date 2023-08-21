export function setPagination(res) {
    const windowQueryParams = new URLSearchParams(window.location.search)

    $('#pagination-info').text(res.meta.from + ' - ' + res.meta.to + ' de ' + res.meta.total)
    const prevPageButton = $('#previews-page')
    const nextPageButton = $('#next-page')

    const prevPageUrl = res.links.prev
    if (!prevPageUrl) {
        prevPageButton.prop('hidden', true)
    } else {
        prevPageButton.prop('hidden', false)
        const prevPageUrl = new URL(res.links.prev)
        const prevPageParams = new URLSearchParams(prevPageUrl.search)
        windowQueryParams.set('page', prevPageParams.get('page'))
        prevPageButton.prop('href', mountUrl(windowQueryParams.toString()))
    }

    const nextPageUrl = res.links.next
    if (!nextPageUrl) {
        nextPageButton.prop('hidden', true)
    } else {
        nextPageButton.prop('hidden', false)
        const nextPageUrl = new URL(res.links.next)
        const nextPageParams = new URLSearchParams(nextPageUrl.search)
        windowQueryParams.set('page', nextPageParams.get('page'))
        nextPageButton.prop('href', mountUrl(windowQueryParams.toString()))
    }
}

function mountUrl(params) {
    return window.location.origin + window.location.pathname + '?' + params
}