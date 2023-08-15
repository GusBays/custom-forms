<script type="module" defer>
    import Cookie from "../../../../assets/js/utils/cookie.js";
    import Toast from "../../../../assets/js/utils/toast.js";

    $(function() {
        $(document).ready(function () {
            const usersCardList = $('body').find('#users-card-list')

            if (usersCardList.lenth === 0) return;

            usersCardList.empty()

            params = new URLSearchParams(window.location)

            $.ajax({
                url: "/api{{ App\Contracts\ApiRoutesEnum::USERS}}",
                type: "get",
                dataType: 'json',
                beforeSend: xhr => xhr.setRequestHeader('Authorization', new Cookie().get('adm_token')),
                success: res => createTemplate(res, usersCardList),
                error: res => new Toast().show('Ocorreu um erro ao buscar a lista de usuários, tente novamente.')
            })
        })
    })

    function createTemplate(res, userCardListDiv) {
        let html = ''

        for (let user of res.data) {
            let createdAt = new Date(user.created_at)
            html += '<div class="list-group shadow p-3 mb-0 bg-body-tertiary rounded mb-2">'
                html += '<div class="d-inline-flex">'
                    html += '<input id="delete-checkbox" class="me-2" type="checkbox" value="' + user.id + '">'
                    html += '<a class="list-group-item list-group-item-action" href="/admin/usuarios/' + user.id + '">'
                        html += '<h5 class="text-center">' + user.name
                            if ('owner' === user.type) html += '<span class="badge ms-1 rounded-pill theme-color">Proprietário</span>'
                            else html += '<span class="badge ms-1 bg-secondary rounded-pill">Integrante</span>'
                        html += '</h5>'
                        html += '<h6>Endereço de email: ' + user.email + '</h6>'
                        html += '<h6>Cadastrado em: ' + createdAt.getDate() + '/' + createdAt.getMonth() + '/' + createdAt.getFullYear() + '</h6>'
                    html += '</a>'
                html += '</div>'
            html += '</div>'
        }

        userCardListDiv.append(html)
    }
</script>