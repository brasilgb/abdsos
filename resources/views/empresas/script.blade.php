<script>
    // Valida form empresa
    $("#formempresa").validate({
        rules: {
            empresa: {
                required: true
            },
            razao: {
                required: true
            },
            cnpj: {
                required: true
            },
            endereco: {
                required: true
            },
            numero: {
                required: true,
                number: true
            },
            bairro: {
                required: true
            },
            cidade: {
                required: true
            },
            uf: {
                required: true
            },
            cep: {
                required: true
            },
            celular: {
                required: true
            },
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            empresa: 'Digite o nome fantasia da empresa!',
            razao: 'Digite a razão social!',
            cnpj: 'Digite o cnpj!',
            endereco: 'Digite o endereço!',
            numero: {
                required: 'Digite o número!',
                number: 'Somente números!'
            },
            bairro: 'Digite o nbairro!',
            cidade: 'Digite a cidade!',
            uf: 'Selecione a UF - Estado!',
            cep: 'Digite o CEP!',
            celular: 'Digite o celuar!',
            email: {
                required: 'Digite o email!',
                email: 'Digite um e-amail válido'
            }
        }
    });
    jQuery.validator.addMethod("notEqual", function(value, element,
        param) { // Adding rules for Amount(Not equal to zero)
        return this.optional(element) || value != '0';
    });
</script>
