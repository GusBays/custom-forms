<script type="module" defer>
    import Toast from "../../../../assets/js/utils/toast.js";

    $(function() {
        $('#recover-form').submit(function() {
            event.preventDefault()

            $.ajax({
                url: "/api{{ App\Contracts\ApiRoutesEnum::USERS_RECOVER_PASSWORD }}",
                type: "post",
                data: $(this).serialize(),
                dataType: 'json',
                success: res => new Toast().show('Email enviado com sucesso!'),
                error: res => new Toast().show('Ocorreu um erro ao enviar sua recuperação de senha, tente novamente.')
            })
        })
    })
</script>