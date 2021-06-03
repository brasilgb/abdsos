<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $agenda->servico }}</title>
</head>

<body>
    <table style="border-collapse: collapse;margin-top:10px;">
        <tr>
            <td colspan="2" style="font: 12px, verdana, sans-serif;color: #555;padding-bottom:20px;">
                {{ $mensagem->mensagem_agendamento }}</td>
        </tr>
        <tr>
            <td colspan="2">Cliente: {{ $cliente->cliente }}</td>
        </tr>
        <tr>
            <td colspan="2">Agendamento n°: {{ $agenda->id_agenda }}</td>
        </tr>
        <tr>
            <td colspan="2">Status: <strong>{{ $status($agenda->status) }}</strong></td>
        </tr>
        <tr>
            <td colspan="2">Data: {{ formatDateTime($agenda->data) }}</td>
        </tr>
        <tr>
            <td colspan="2">Hora: {{ formatDateTime($agenda->hora, 'H:i') }}</td>
        </tr>
        <tr>
            <td colspan="2">Serviço: {{ $agenda->servico }}</td>
        </tr>
        <tr>
            <td colspan="2">Detalhes: {{ $agenda->detalhes }}</td>
        </tr>
        <tr>
            <td colspan="2">Técnico responsável: {{ $tecnico->name }}</td>
        </tr>

        <tr>
            <td style="width:105px; border-right:1px solid #375B7E;border-top:1px solid #375B7E;">
                <img src="cid:logoimg">
            </td>
            <td style="border-top:1px solid #375B7E;padding-left:10px;">
                <h3 style="font: 14px, verdana, sans-serif;color: #555;padding: 2px;">{{ $empresa->empresa }}</h3>
                <p style="font: 12px, verdana, sans-serif;color: #555;padding: 2px;">{{ $empresa->endereco }},
                    {{ $empresa->bairro }}<br>
                    {{ $empresa->cidade }} - {{ $empresa->uf }}<br>
                    {{ $empresa->telefone }}</p>
            </td>
        </tr>
    </table>
</body>

</html>
