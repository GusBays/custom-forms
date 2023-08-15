<script type="module" defer>
    import Cookie from "../../../../assets/js/utils/cookie.js";
    import Toast from "../../../../assets/js/utils/toast.js";

    $(function() {
        $(document).ready(function() {
            const formCardsList = $('body').find('#forms-card-list')

            if (formCardsList.length === 0) return;

            formCardsList.empty();

            $.ajax({
                url: "/api{{ App\Contracts\ApiRoutesEnum::FORMS }}?sort=-id&limit=15",
                type: "get",
                beforeSend: xhr => xhr.setRequestHeader('Authorization', `Bearer ${new Cookie().get('adm_token')}`),
                dataType: 'json',
                success: res => createTemplate(res, formCardsList),
                error: res => new Toast().show('Ocorreu um erro ao buscar seus últimos formulários, tente novamente.')
            })
        })
    })

    function createTemplate(res, formCardsListDiv) {
        let html = ''
        
        for (let form of res.data) {
            let createdAt = new Date(form.created_at)

            let availableUntil = null
            if (form.available_until) availableUntil = new Date(form.available_until)

            html += '<div class="col-12 my-2 col-md-6">'
                html += '<div class="list-group shadow p-3 mb-0 bg-body-tertiary rounded">'
                    html += '<a class="list-group-item list-group-item-action" href="/admin/formularios/' + form.id + '">'
                        html += '<h5>' + form.name + '</h5>'
                        html += '<h6>' + form.active === true ? 'Ativo' : 'Inativo' + '</h6>'
                        html += '<h6>Criado em: ' + createdAt.getDate() + '/' + createdAt.getMonth() + '/' + createdAt.getFullYear() + '</h6>'
                        if (availableUntil) html+= '<h6>Disponível até: ' + availableUntil.getDate() + '/' + availableUntil.getMonth() + '/' + availableUntil.getFullYear() + '</h6>'
                    html += '</a>'

                    html += '<a href="/admin/formularios/respostas?form_id=' + form.id + '" type="button" class="list-group-item mt-3 list-group-item-action">'
                        html += '<h6 class="text-center">Respostas</h6>'
                        html += '<span class="position-absolute top-0 start-100 translate-middle p-2 border border-light rounded-circle theme-color">'
                            html += '<span class="visually-hidden">unread messages</span>'
                        html += '</span>'
                    html+= '</a>'
                html += '</div>'
            html += '</div>'
        }

        formCardsListDiv.append(html)
    }
</script>