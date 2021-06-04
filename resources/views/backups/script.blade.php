<script>
    // Valida form backup
    $("#formbackup").validate({
        rules: {
            local: {
                required: true
            },
            agendamento: {
                required: true
            }
        },
        messages: {
            local: 'Digite o local para salvar o backup!',
            agendamento: 'Digite a hora para salvar o backup!'
        }
    });
    jQuery.validator.addMethod("notEqual", function(value, element,
        param) { // Adding rules for Amount(Not equal to zero)
        return this.optional(element) || value != '0';
    });
</script>

