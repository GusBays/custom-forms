<script type="module" defer>
    import Cookie from "../../../../assets/js/utils/cookie.js";
    import Toast from "../../../../assets/js/utils/toast.js";

    $(function() {
        $('#form-detail').submit(function (event) {
            event.preventDefault()

            const data = $(this).serialize()

            const formCardDetail = $('body').find('#form-detail')
            if (formCardDetail.length === 0) return

            const formFieldsHtml = $('body').find('#form-field')
            const formFields = []
            formFieldsHtml.foreach(element => formFields.push(element.serialize()))

            const formUsersHtml = $('body').find('#form-user')
            const formUsers = []
            formUsersHtml.foreach(element => formUsers.push(element.serialize()))

            data.form_fields = formFields
            data.form_users = formUsers

            const idInput = $(this).find('#id').val()

            let method = "post"
            let url = "/api{{ App\Contracts\ApiRoutesEnum::FORMS }}"
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
                success: res => createTemplate(res, formCardDetail),
                error: res => new Toast().show('Ocorreu um erro ao salvar o formulário, tente novamente.')
            })
        })
    })

    function createTemplate(response, formCardDetail) {
        formCardDetail.empty()

        const res = response.data ? response.data : response

        const availableUntil = new Date(form.available_until)

        let html = ''

        html += '<div class="col">'
            html += '<input type="text" name="id" id="id" value="' + res.id + '" hidden>'
            html += '<div class="mb-3">'
                html += '<label for="name" class="form-label">Título</label>'
                html += '<input type="text" name="name" id="name" class="form-control" value="' + res.name +'" placeholder="Ex.: Formulário de cadastro">'
            html += '/div>'
            html += '<div class="mb-3">'
                html += '<label for="available_until" class="form-label">Disponível até</label>'
                html += '<input type="text" name="available_until" id="available-until" class="form-control" value="'
                    if (res.available_until) html += `${availableUntil.getFullYear()}-${availableUntil.getMonth()}/${availableUntil.getDay()} ${availableUntil.getHours()}/${availableUntil.getMinutes()}`
                html += '" name="available_until" placeholder="Ex.: 2023-10-25 10:00"'
            html += '</div>'
            html += '<div class="form-check form-switch align-self-center mb-3">'
                html += '<label for="active" class="form-label">Ativo</label>'
                html += '<input class="form-check-input active-switch" name="active" id="active" value="' + res.active +'" type="checkbox" role="switch"'
                if (res.active) html += ' checked'
                html += '>'
            html += '</div>'
            html += '<div class="mb-3">'
                html += '<label for="fill_limit" class="form-label">Limite de preenchimento</label>'
                html += '<input type="number" name="fill_limit" id="fill-limit" class="form-control" value="' + res.fill_limit + '" name="fill_limit" placeholder="Sem limite">'
            htlm += '</div>'
            html += '<div class="form-check form-switch align-self-center mb-3">'
                html += '<label for="active" class="form-label">Notificar administradores a cada preenchimento</label>'
                html += '<input class="form-check-input active-switch" name="should_notify_each_fill" id="should-notify-each-fill" value="' + res.should_notify_each_fill + '" type="checkbox" role="switch"'
                if (res.should_notify_each_fill) html += ' checked'
                html += '>'
            html += '</div>'
        html += '</div>'

        const fieldsCardDetail = $('body').find('#form-field-detail')
        fieldsCardDetail.empty()
        let fieldsHtml = ''

        fieldsHtml += '<div class="text-muted my-3 border-bottom" id="count-fields">Você tem um total de ' + res.form_fields.length + ' campos cadastrados neste formulário.</div>'
        for (let field of res.form_fields) {
            fieldsHtml += '<form id="form-field">'
                fieldsHtml += '<div class="border-bottom mb-3">'
                    fieldsHtml += '<input type="text" name="id" id="field-id" value="' + field.id + '" hidden>'
                    fieldsHtml += '<div class="mb-3">'
                        fieldsHtml += '<label for="name" class="form-label">Nome do campo</label>'
                        fieldsHtml += '<input type="text" name="name" class="form-control" id="field-name" value="' + field.name + '">'
                    fieldsHtml += '</div>'
                    fieldsHtml += '<div class="mb-3">'
                        fieldsHtml += '<label for="description" class="form-label">Descrição do campo</label>'
                        fieldsHtml += '<textarea name="description" class="form-control text-top description-input" id="field-description">' + field.description +'</textarea>'
                    fieldsHtml += '</div>'
                    fieldsHtml += '<div class="mb-3">'
                        fieldsHtml += '<label for="type" class="form-label">Tipo</label>'
                        fieldsHtml += '<select id="field-type" name="type" class="form-select">'
                            fieldsHtml += '<option value="text"'
                            if ('text' === field.type) fieldsHtml += ' selected'
                            fieldsHtml += '>Texto</option>'
                            fieldsHtml += '<option value="checkbox"'
                            if ('checkbox' === field.type) fieldsHtml += ' selected'
                            fieldsHtml += '>Checkbox</option'
                            fieldsHtml += '<option value="select"'
                            if ('select' === field.type) fieldsHtml += ' selected'
                            fieldsHtml += '>Seletor</option'
                            fieldsHtml += '<option value="blocked"'
                            if ('blocked' === field.type) fieldsHtml += ' selected'
                            fieldsHtml += '>Bloqueado</option>'
                        fieldsHtml += '</select>'
                    fieldsHtml += '</div>'
                    fieldsHtml += '<div class="form-check form-switch align-self-center mb-3">'
                        fieldsHtml += '<label for="active" class="form-label">Obrigatório</label>'
                        fieldsHtml += '<input class="form-check-input active-switch" name="required" id="field-required" value="' + field.required + '" type="checkbox" role="switch"'
                        if ('blocked' === field.type) fieldsHtml += 'disabled'
                        else if (field.required) fieldsHtml += 'checked'
                        fieldsHtml += '>'
                    fieldsHtml += '</div>'
                    fieldsHtml += '<div class="mb-3 p-2 rounded" style="background-color: #e9ecef;" id="group-field-content">'
                        fieldsHtml += '<label for="content" class="form-label">Opções</label>'
                        for (let option of field.content) {
                            fieldsHtml += '<div class="input-group mb-1">'
                                fieldsHtml += '<input type="text" name="content" class="form-control" id="field-content" value="' + option + '">'
                                fieldsHtml += '<button class="input-group-text btn btn-danger" id="delete-option"><img src="{{ env('APP_URL') }}/assets/img/trash-icon.svg" alt="" width="25" height="32"></button>'
                            fieldsHtml += '</div>'
                        }
                        fieldsHtml += '<button class="btn btn-success" id="add-option" data-field-id="{{ $field->getId() }}"><img src="{{ env('APP_URL') }}/assets/img/add-icon.svg" width="25" height="25" alt="add-icon"></button>'
                    fieldsHtml += '</div>'
                    fieldsHtml += '<div class="mb-3">'
                        fieldsHtml += '<button class="btn btn-danger" id="delete-field">Deletar campo</button>'
                    fieldsHtml += '</div>'
                    fieldsHtml += '<button id="add-field" type="button" class="btn btn-success mb-3">Adicionar novo campo</button>'
                fieldsHtml += '</div>'
            fieldsHtml += '</form>'
        }

        fieldsCardDetail.append(fieldsHtml)

        const usersCardDetail = $('body').find('#form-user-detail')
        let usersHtml = ''

        formCardDetail.append(html)
    }
</script>