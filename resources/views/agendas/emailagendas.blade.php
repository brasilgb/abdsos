
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

</head>
<body>
    $mensagens['mensagem_agendamento'] .
    '<br>Número do agendamento: ' . $idagendamento['id_agenda'] .
    '<br>Data - Hora: ' . formatDateTime($idagendamento['data']) . ' - ' . $idagendamento['hora'] .
    '<br>Serviço: ' . $idagendamento['servico'] .
    '<br>Detalhes: ' . $idagendamento['detalhes'] .
    '<br>Responsável: ' . $tecnicos['name'] .
    '<br>Cliente: ' . $clientes['cliente'];
</body>
</html>
