<script>
    // Valida form
    $("#formagenda").validate({
          rules: {
              cliente: {
                  required: true
              },
              data: {
                  required: true
              },
              hora: {
                  required: true
              },
              servico: {
                  required: true
              },
              detalhes: {
                  required: true
              },
              tecnico_id: {
                  required: true
              }
          },
          messages: {
              cliente: 'Digite o nome do cliente!',
              data: 'Selecione ou digite a data!',
              hora: 'Digite a hora!',
              servico: 'Digite o serviço a ser executado!',
              detalhes: 'Digite os detalhes do serviço!',
              tecnico_id: 'Selecione o técnico!',
          }
      });
      jQuery.validator.addMethod("notEqual", function(value, element,
          param) { // Adding rules for Amount(Not equal to zero)
          return this.optional(element) || value != '0';
      });

      $('.cliente').autocomplete({
            minLength: 1,
            autoFocus: true,
            delay: 300,
            source: function(request, response) {
                _token = $("input[name='_token']").val();
                $.ajax({
                    url: '{{ route('clientes.autocomplete') }}',
                    type: 'POST',
                    dataType: "json",
                    data: {
                        '_token': _token,
                        'term': request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                $('.cliente').val(ui.item.label);
                $('.cliente_id').val(ui.item.value);
                return false;
            }
        });

        $("#dateform, #searchform").datepicker({
            locale: 'pt-BR'
        });

        $('#ativaemail').click(function() {

            if ($(this).is(':checked')) {
                $(".alterbtn").removeClass("btn-default").addClass("btn-info");
            } else {
                $(".alterbtn").removeClass("btn-info").addClass("btn-default");
            }
        });

</script>

