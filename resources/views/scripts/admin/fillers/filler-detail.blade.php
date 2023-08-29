<script type="module" defer>
    import Cookie from "../../../../assets/js/utils/cookie.js";
    import Toast from "../../../../assets/js/utils/toast.js";

    $(function() {
        $('#filler-detail').submit(function(event) {
            event.preventDefault()

            const data = $(this).serialize()

            const fillerCardDetail = $('body').find('#filler-detail')
            if (fillerCardDetail.length === 0) return

            const idInput = $('#id').val()

            let method = "post"
            let url = "/api{{ App\Contracts\ApiRoutesEnum::FILLERS }}"
            if (idInput) {
                method = "put"
                url += `/${idInput}`
            }

            $.ajax({
                url: url,
                type: method,
                data: data,
                dataType: 'json',
                beforeSend: xhr => xhr.setRequestHeader('Authorization', new Cookie().get('adm_token')),
                success: res => createTemplate(res, fillerCardDetail),
                error: res => new Toast().show('Ocorreu um erro ao salvar o preenchedor, tente novamente.')
            })
        })
    })

    function createTemplate(response, fillerCardDetail) {
        fillerCardDetail.empty()

        const res = response.data ? response.data : response
        
        let html = ''

        html += '<div class="col">'
            html += '<input type="text" id="id" value="' + res.id + '" hidden>'
            html += '<div class="mb-3">'
                html += '<label for="name" class="form-label">Nome completo</label>'
                html += '<input type="text" name="name" id="name" class="form-control" value="' + res.name + '" disabled readonly>'
            html += '</div>'
            html += '<div class="mb-3">'
                html += '<label for="first_name" class="form-label">Primeiro nome</label>'
                html += '<input type="text" name="first_name" id="first_name" class="form-control" value="' + res.first_name + '" id="first_name" placeholder="Ex.: Ana">'
            html += '</div>'
            html += '<div class="mb-3">'
                html += '<label for="last_name" class="form-label">Sobrenome</label>'
                html += '<input type="text" name="last_name" id="last_name" class="form-control" value="' + res.last_name + '" id="last_name" placeholder="Ex.: Flores">'
            html += '</div>'
            html += '<div class="mb-3">'
                html += '<label for="email" class="form-label">E-mail</label>'
                html += '<input type="text" name="email" id="email" class="form-control" value="' + res.email + '" id="email" placeholder="Ex.: email@exemplo.com.br">'
            html += '</div>'
        html += '</div>'
        html += '<div class="row">'
            html += '<div class="col-12 col-md-6">'
                html += '<button type="submit" class="btn btn-success border-0 w-100 theme-color">Salvar alterações</button>'
            html += '</div>'
            html += '<div class="col-12 col-md-6">'
                html += '<div class="mt-1 mt-md-0">'
                    html += '<a class="btn btn-secondary w-100" id="back-button" type="button">Voltar</a>'
                html += '</div>'
            html += '</div>'
            html += '<input id="delete-checkbox" type="checkbox" value="' + res.id + '" hidden>'
        html += '</div>'

        fillerCardDetail.append(html)
    }
</script>