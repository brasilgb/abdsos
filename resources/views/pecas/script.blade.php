<script>
    // Valida form
      $("#formpecas").validate({
          rules: {
              peca: {
                  required: true
              },
              descricao: {
                  required: true
              },
              fabricante: {
                  required: true
              },
              quantidade: {
                  required: true,
                  number: true
              },
              valor: {
                  required: true,
                  number: true
              },
             situacao: {
                  required: true
              }
          },
          messages: {
              peca: 'Digite um descritivo!',
              descricao: 'Digite uma descrição!',
              fabricante: 'Digite um fabricante!',
              quantidade: {
                  required: 'Digite a quantidade!',
                  number: 'Somente números'
              },
              valor: {
                  required: 'Digite o valor!',
                  number: 'Somente números'
              },
              situacao: {
                  required: 'Selecione a situação!'
              }
          }
      });
      jQuery.validator.addMethod("notEqual", function(value, element,
          param) { // Adding rules for Amount(Not equal to zero)
          return this.optional(element) || value != '0';
      });

      $('.peca').autocomplete({
            minLength: 1,
            autoFocus: true,
            delay: 300,
            source: function(request, response) {
                _token = $("input[name='_token']").val();
                $.ajax({
                    url: '{{ route('pecas.autocomplete') }}',
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
                $('.peca').val(ui.item.label);
                //$('.peca_id').val(ui.item.value);
                return false;
            }
        });

</script>

