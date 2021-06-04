<script>
    // Valida form backup
    $("#formemail").validate({
        rules: {
            servidor: {
                required: true
            },
            porta: {
                required: true,
                number: true
            },
            seguranca: {
                required: true
            },
            usuario: {
                required: true,
                email: true
            },
            senha: {
                required: true
            }
        },
        messages: {
            servidor: 'Digite o endereco do servidor!',
            porta: {
                require: 'Digite o número da porta do servidor!',
                number: 'Somente números!'
            },
            seguranca: 'Digite o tipo de seguranca do servidor!',
            usuario: {
                required: 'Digite o usuario (e-mail) do servidor',
                email: 'Digite um e-mail válido!'
            },
            senha: 'Digite a senha do servidor!'
        }
    });
    jQuery.validator.addMethod("notEqual", function(value, element,
        param) { // Adding rules for Amount(Not equal to zero)
        return this.optional(element) || value != '0';
    });
</script>

