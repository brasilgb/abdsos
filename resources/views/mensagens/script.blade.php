<script>
    // Valida form backup
    $("#formmensagem").validate({
        rules: {
            recebimento_recibo: {
                required: true
            },
            entrega_recibo: {
                required: true
            },
            mensagem_agendamento: {
                required: true
            },
            mensagem_servico_concluido: {
                required: true
            }
        },
        messages: {
            recebimento_recibo: 'Digite a mensagem do recibo de entrada do equipamento!',
            entrega_recibo: 'Digite a mensagem do recibo de entrega do equipamento!',
            mensagem_agendamento: 'Digite a mensagem ao cliente de atualização de status!',
            mensagem_servico_concluido: 'Digite a mensagem ao cliente de término de manutenção!'
        }
    });
    jQuery.validator.addMethod("notEqual", function(value, element,
        param) { // Adding rules for Amount(Not equal to zero)
        return this.optional(element) || value != '0';
    });
</script>

