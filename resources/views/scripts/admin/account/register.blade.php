<script type="module" defer>
    import Cookie from "../../../../assets/js/utils/cookie.js";
    import Toast from "../../../../assets/js/utils/toast.js";

    $(function() {
        $('#register-form').submit(function(event) {
            event.preventDefault()

            $.ajax({
                url: "/api{{ App\Contracts\ApiRoutesEnum::ORGANIZATIONS }}",
                type: "post",
                data: $(this).serialize(),
                dataType: 'json',
                success: res => addCookieAndRedirectUser(res),
                error: res => new Toast().show('Ocorreu um erro ao cadastrar sua organização, tente novamente.')
            })
        })
    })

    function addCookieAndRedirectUser(res) {
        const byType = (user) => 'owner' === user.type
        const owner = res.users.find(byType)

        new Cookie().set('adm_token', owner.token, 1)

        window.location = "{{ App\Contracts\RedirectEnum::ADMIN }}"
    }
</script>