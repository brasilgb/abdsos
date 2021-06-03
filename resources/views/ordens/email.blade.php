<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $ordem->servico }}</title>
</head>

<body>
    <table style="border-collapse: collapse;margin-top:10px;">
        <tr>
            <td colspan="2" style="font: 12px, verdana, sans-serif;color: #555;padding-bottom:20px;">
                {{ $mensagem->mensagem_servico_concluido }}</td>
        </tr>
        <tr>
            <td colspan="2">Cliente: {{ $cliente->cliente }}</td>
        </tr>
        <tr>
            <td colspan="2">Ordem de serviço n°: {{ $ordem->id_ordem }}</td>
        </tr>
        <tr>
            <td colspan="2">Status: <strong>Serviço concluído</strong></td>
        </tr>
        <tr>
            <td colspan="2">Data de entrada: {{ formatDateTime($ordem->created_at) }}</td>
        </tr>
        <tr>
            <td colspan="2">Hora de entrada: {{ formatDateTime($ordem->created_at, 'H:i') }}</td>
        </tr>
        <tr>
            <td colspan="2">Defeito: {{ $ordem->defeito }}</td>
        </tr>
        <tr>
            <td colspan="2">Serviço: {{ $ordem->servico }}</td>
        </tr>
        <tr>
            <td colspan="2">Técnico responsável: {{ $ordem->users->name }}</td>
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
