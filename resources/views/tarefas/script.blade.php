<script>
  // Valida form add semnas
    $("#formtarefas").validate({
        rules: {
            data_inicio: {
                required: true
            },
            hora_inicio: {
                required: true
            },
            data_previsao: {
                required: true
            },
            hora_previsao: {
                required: true
            },
            descritivo: {
                required: true
            },
           descricao: {
                required: true
            }
        },
        messages: {
            data_inicio: 'Selecione a data de início!',
            hora_inicio: 'Selecione a hora de início!',
            data_previsao: 'Selecione a data de previsão!',
            hora_previsao: 'Selecione a hora de previsão!',
            descritivo: {
                required: 'Digite um descritivo (título)!'
            },
            descricao: {
                required: 'Digite a descrição!'
            }
        }
    });
    jQuery.validator.addMethod("notEqual", function(value, element,
        param) { // Adding rules for Amount(Not equal to zero)
        return this.optional(element) || value != '0';
    });

    $(function() {
            $("#searchform,#data1,#data2").datepicker({
                locale: 'pt-BR'
            });
        });
</script>
