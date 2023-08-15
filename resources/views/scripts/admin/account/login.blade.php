<script type="module" defer>
    import Cookie from "../../../../assets/js/utils/cookie.js";
    import Toast from "../../../../assets/js/utils/toast.js";

    $(function() {
        $('#login-form').submit(function (event) {
            event.preventDefault()

            $.ajax({
                url: "/api{{ App\Contracts\ApiRoutesEnum::USERS_LOGIN }}",
                type: "post",
                data: $(this).serialize(),
                dataType: 'json',
                success: res => addCookieAndRedirectUser(res),
                error: res => new Toast().show('Usuário ou senha inválidos, tente novamente.')
            });
        })
    })

    function addCookieAndRedirectUser(res) {
        const days = $('#keep-connected').is(':checked') ? 7 : 1

        new Cookie().set('adm_token', res.data.token, days)

        window.location = "{{ App\Contracts\RedirectEnum::ADMIN }}"
    }
</script>