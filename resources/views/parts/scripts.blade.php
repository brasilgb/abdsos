<script>
    $( "#dateform,#searchform").inputmask('99/99/9999');
    $( "#timeform").inputmask('99:99:99');
    $( "#hora1").inputmask('99:99');
    $( "#hora2").inputmask('99:99');
    $( ".telefone").inputmask('(99)9999-9999');
    $( ".celular").inputmask('(99)9999-99999');
    $( ".cep").inputmask('99999-999');
    $( ".cpf").inputmask('999999999/99');
    $( ".cnpj").inputmask('99.999.999/9999-99');
    $( ".rg").inputmask('9999999999');

    $(function(){
    setInterval(function(){
        $.ajax({
        url: "{{ route('configuracoes.executabackup') }}",
        type: "GET"
       })
     }, 1000);
});

</script>
