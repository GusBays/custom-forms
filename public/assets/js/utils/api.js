export default class Api
{
    constructor(
        uri
    ) {
        this.uri = `/api/${uri}`
        this.headers = {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        }
        this.token = window.localStorage.getItem('adm_token')
        if (this.token) this.headers.Authorization = `Bearer ${this.token}`
    }

    get() {
        return fetch(this.uri, {
            method: 'GET',
            headers: this.headers
        })
    }

    post(body) {
        return fetch(this.uri, {
            method: 'POST',
            headers: this.headers,
            body: JSON.stringify(body)
        })
    }

    put(id, body) {
        return fetch(`${this.uri}/${id}`, {
            method: 'PUT',
            headers: this.headers,
            body: JSON.stringify(body)
        })
    }

    delete(id) {
        return fetch(`${this.uri}/${id}`, {
            method: 'DELETE',
            headers: this.headers
        })
    }
}