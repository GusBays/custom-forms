<script type="module" defer>
    import Cookie from "../../../../assets/js/utils/cookie.js";
    import Toast from "../../../../assets/js/utils/toast.js";
    import { setPagination } from "../../../../assets/js/utils/pagination.js";

    $(function() {
        $(document).ready(getFillers())

        $('#previews-page').click(event => {
            event.preventDefault()

            const prevPageUrl = $('#previews-page').prop('href')

            window.history.pushState({path: prevPageUrl}, '', prevPageUrl)

            getFillers()
        })

        $('#next-page').click(event => {
            event.preventDefault()

            const nextPageButtonUrl = $('#next-page').prop('href')

            window.history.pushState({path: nextPageButtonUrl}, '', nextPageButtonUrl)

            getFillers()
        })
    })

    function getFillers() {
        const fillerCardList = $('body').find('#fillers-card-list')

        if (fillerCardList.length === 0) return;

        fillerCardList.empty()

        const params = new URLSearchParams(window.location.search).toString()

        $.ajax({
            url: "/api{{ App\Contracts\ApiRoutesEnum::FILLERS }}?" + params,
            type: "get",
            dataType: 'json',
            beforeSend: xhr => xhr.setRequestHeader('Authorization', new Cookie().get('adm_token')),
            success: res => createTemplate(res, fillerCardList),
            error: res => new Toast().show('Ocorreu um erro ao buscar a lista de preenchedores, tente novamente.')
        })
    }

    function createTemplate(res, fillerCardList) {
        let html = ''

        setPagination(res)

        for (let filler of res.data) {
            let createdAt = new Date(filler.created_at)
            html += '<div class="list-group shadow p-3 mb-0 bg-body-tertiary rounded mb-2">'
                html += '<div class="d-inline-flex">'
                    html += '<input id="delete-checkbox" class="me-2" type="checkbox" value="' + filler.id + '">'
                    html += '<a class="list-group-item list-group-item-action" href="/admin/preenchedores/' + filler.id + '">'
                        if (filler.name) html += '<h5 class="text-center">' + filler.name + '</h5>'
                        html += '<h6>Endereço de email: ' + filler.email + '</h6>'
                        html += '<h6>Cadastrado em: ' + createdAt.getDate() + '/' + createdAt.getMonth() + '/' + createdAt.getFullYear() + '</h6>'
                    html += '</a>'
                html += '</div>'
            html += '</div>'
        }

        fillerCardList.append(html)
    }
</script>