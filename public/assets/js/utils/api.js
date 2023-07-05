export default class Api
{
    constructor(
        uri
    ) {
        this.uri = `/api/${uri}`
    }

    get() {
        return fetch(this.uri, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${window.localStorage.getItem('adm_token')}`
            }
        })
    }

    post(body) {
        return fetch(this.uri, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${window.localStorage.getItem('adm_token')}`
            },
            body: JSON.stringify(body)
        })
    }

    put(id, body) {
        return fetch(`${this.uri}/${id}`, {
            method: 'PUT',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${window.localStorage.getItem('adm_token')}`
            },
            body: JSON.stringify(body)
        })
    }

    delete(id) {
        return fetch(`${this.uri}/${id}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${window.localStorage.getItem('adm_token')}`
            }
        })
    }
}