<script type="module" defer>
    import Cookie from "../../../../assets/js/utils/cookie.js";

    $(function() {
        $('#logoff').click(event => {
            new Cookie().remove('adm_token')
            window.location = "{{ App\Contracts\RedirectEnum::ENTRAR }}"
        })
    })
</script>