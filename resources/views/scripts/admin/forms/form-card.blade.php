<script type="module" defer>
    import Cookie from "../../../../assets/js/utils/cookie.js";
    import Toast from "../../../../assets/js/utils/toast.js";
    import { setPagination } from "../../../../assets/js/utils/pagination.js";

    $(function() {
        $(document).ready(getForms())

        $('#previews-page').click(event => {
            event.preventDefault()

            const prevPageUrl = $('#previews-page').prop('href')

            window.history.pushState({path: prevPageUrl}, '', prevPageUrl)

            getForms()
        })

        $('#next-page').click(event => {
            event.preventDefault()

            const nextPageButtonUrl = $('#next-page').prop('href')

            window.history.pushState({path: nextPageButtonUrl}, '', nextPageButtonUrl)

            getForms()
        })
    })

    function getForms() {
        const formsCardList = $('body').find('#forms-card-list')

        if (formsCardList.length === 0) return;

        formsCardList.empty()

        const params = new URLSearchParams(window.location.search).toString()

        $.ajax({
            url: "/api{{ App\Contracts\ApiRoutesEnum::FORMS }}?" + params,
            type: "get",
            dataType: 'json',
            beforeSend: xhr => xhr.setRequestHeader('Authorization', new Cookie().get('adm_token')),
            success: res => createTemplate(res, formsCardList),
            error: res => new Toast().show('Ocorreu um erro ao buscar a lista de usuários, tente novamente.')
        })
    }

    function createTemplate(res, formsCardList) {
        let html = ''

        setPagination(res)

        for (let form of res.data) {
            const availableUntil = new Date(form.available_until)
            const createdAt = new Date(form.created_at)

            html += '<div class="list-group shadow p-3 mb-0 bg-body-tertiary rounded mb-2">'
                html += '<div class="d-inline-flex">'
                    html += '<input id="delete-checkbox" class="me-2" type="checkbox" value="' + form.id + '">'
                    html += '<a class="list-group-item list-group-item-action" href="/admin/formularios/' + form.id + '>'
                        html += '<h5 class="text-center">' + form.name
                            if (form.active) html += '<span class="badge ms-1 rounded-pill theme-color">Ativo</span>'
                            else html += '<span class="badge ms-1 bg-secondary rounded-pill">Inativo</span>'
                        html += '</h5>'
                        if (form.fill_limit) html += '<h6>Limite de preenchimento: ' + form.fill_limit + '</h6>'
                        if (form.available_until) html += '<h6>Disponível até: ' + `${availableUntil.getDay()}/${availableUntil.getMonth()}/${availableUntil.getFullYear()} ${availableUntil.getHours()}:${availableUntil.getMinutes()}` + '</h6>'
                        else html += '<h6>Criado em: ' + createdAt.getDay() + '/' + createdAt.getMonth() + '/' + createdAt.getFullYear() + '</h6>'
                    html += '</a>'
                    html += '<div class="form-check form-switch align-self-center ms-2">'
                        if (form.active) {
                            html += '<input class="form-check-input bg-success" id="active-switch" "value="' + form.active + '" type="checkbox" role="switch" checked>'
                            html += '<label class="d-none d-md-block form-check-label" for="flexSwitchCheckDefault">Ativo</label>'
                        } else {
                            html += '<input class="form-check-input bg-danger" id="active-switch" "value="' + form.active + '" type="checkbox" role="switch">'
                            html += '<label class="d-none d-md-block form-check-label" for="flexSwitchCheckDefault">inativo</label>'
                        }
                    html += '</div>'
                html += '</div>'
            html += '</div>'
        }

        formsCardList.append(html)
    }
</script>