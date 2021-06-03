<script>
    // Valida form
    $("#formordem").validate({
          rules: {
              cliente: {
                  required: true
              },
              equipamento: {
                  required: true
              },
              modelo: {
                  required: true
              },
              senha: {
                  required: true
              },
              defeito: {
                  required: true
              },
              estado: {
                  required: true
              }
          },
          messages: {
              cliente: 'Digite o nome do cliente!',
              equipamento: 'Digite o tipo de equipamento!',
              modelo: 'Digite o modelo do equipamento!',
              senha: 'Digite a senha do equipamento ou zero!',
              defeito: 'Digite o defeito do equipamento!',
              estado: 'Digite o estado de conservação do equipamento!',
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
                    url: '{{ route('ordens.autocomplete') }}',
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
                $('#input-search').val(ui.item.value);
                return false;
            }
        });

        $('#cliente').autocomplete({
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
                $('#cliente').val(ui.item.label);
                $('#cliente_id').val(ui.item.value);
                return false;
            }
        });
        $("#dateform, #searchform").datepicker({
            locale: 'pt-BR'
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
                $('#pecaid').val(ui.item.value);
                return false;
            }
        });
        $("#dateform, #searchform").datepicker({
            locale: 'pt-BR'
        });

        $(function() {
            $("#addpeca").click(function(e) {
                e.preventDefault();
                pecaid = $("#pecaid").val();
                ordemid = $("#ordemid").val();
                _token = $("input[name='_token']").val();
                //console.log('Peça:' + pecaid +'Ordem:' + ordemid + 'Token:' + _token);
                if (this) {
                    $.ajax({
                        url: '{{ route('pecas.pecasordens') }}',
                        type: 'POST',
                        data: {
                            '_token': _token,
                            'pecaid': pecaid,
                            'ordemid': ordemid
                        },
                        success: function(response) {
                            $.each(response, function(key, value) {
                                $(".titlelist").show();
                                $(".listpecas").show().html(value);
                            });

                        }
                    });
                }
            });
        });

        $(function() {
            $(".totalgeral").keyup(function() {
                var valtotal = 0;
                $(".totalgeral").each(function(index, element) {
                    if ($(element).val()) {
                        valtotal += parseFloat($(element).val());
                    }
                });
                $(".valtotal").val(valtotal).addClass('bg-gray-light');
            });
        });

</script>
