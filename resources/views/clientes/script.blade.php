<script>
    // Valida form
      $("#formcliente").validate({
          rules: {
              cliente: {
                  required: true
              },
              nascimento: {
                  required: true
              },
              email: {
                  required: true,
                  email: true
              },
              celular: {
                  required: true
              },
              logradouro: {
                  required: true
              },
              numero: {
                  required: true,
                  number: true
              },
              bairro: {
                  required: true
              },
              estado: {
                  required: true
              },
              cidade: {
                  required: true
              },
              cep: {
                  required: true
              },
              cpf: {
                  required: true
              }
          },
          messages: {
              cliente: 'Digite o nome do cliente!',
              nascimento: 'Digite a data de nascimento!',
              email: {
               required: 'Digite o e-mail do cliente!',
               email: 'Digite um e-mail válido!'
              },
              celular: 'Digite o celular!',
              logradouro: {
                  required: 'Digite o nome da rua!'
              },
              numero: {
                  required: 'Digite o número da residência!',
                  number: 'Somente números!'
              },
              bairro: {
                  required: 'Digite o bairro!'
              },
              estado: {
                  required: 'Digite o estado!'
              },
              cidade: {
                  required: 'Digite a cidade!'
              },
              cep: {
                  required: 'Digite o CEP!'
              },
              cpf: {
                  required: 'Digite o CPF!'
              }
          }
      });
      jQuery.validator.addMethod("notEqual", function(value, element,
          param) { // Adding rules for Amount(Not equal to zero)
          return this.optional(element) || value != '0';
      });

      $('#input-search').autocomplete({
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
                $('#input-search').val(ui.item.label);
                //$('#employeeid').val(ui.item.value);
                return false;
            }
        });
        $("#dateform, #searchform").datepicker({
            locale: 'pt-BR'
        });
</script>
