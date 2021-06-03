<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recibo</title>
    <link rel="stylesheet" href="{{ asset('css/relatorios.css') }}">
</head>

<body>
    <div class="cabecalho">
        <!-- Ordem de entrega. -->
        <table>
            <tr>
                <td><img class="logo" src="{{ asset('img/' . $empresa['logo']) }}" title="{{ $empresa['empresa'] }}">
                </td>
                <td class="center cabecalho">
                    <span class="empresa">{{ $empresa['empresa'] }}</span><br>
                    {{ 'CNPJ: ' . $empresa['cnpj'] }} -
                    {{ $empresa['endereco'] }},
                    {{ $empresa['bairro'] }}<br>
                    {{ $empresa['cidade'] }} -
                    {{ $empresa['uf'] }} <br>
                    {{ $empresa['site'] }} -
                    {{ $empresa['email'] }}<br>
                    {{ $empresa['telefone'] }}
                </td>
            </tr>
        </table>
    </div>
    <div class="container" style="padding-bottom: 10px;margin-bottom: 10px;">
        <table>
            <tr>
                <td style="padding-top:5px;background-color: rgb(202, 202, 202)" colspan="2">Ordem de serviço n°:
                    {{ $ordens['id_ordem'] }}</td>
            </tr>
            <tr>
                <td style="width: 50%;padding-top:5px;">Cliente: {{ $ordens->clientes->cliente }}</td>
                <td>Entrada: {{ formatDateTime($ordens['created_at']) }} -
                    {{ formatDateTime($ordens['created_at'],"H:i") }}</td>
            </tr>
            <tr>
                <td>Tel/Cel: {{ $ordens->clientes->telefone }} / {{ $ordens->clientes->celular }}</td>
                <td>Endereço: {{ $ordens->clientes->logradouro }}, {{ $ordens->clientes->numero }}</td>
            </tr>
            <tr>
                <td>Bairro: {{ $ordens->clientes->bairro }}</td>
                <td>Cidade: {{ $ordens->clientes->cidade }}</td>
            </tr>
            <tr>
                <td>Equipamento: {{ $ordens['equipamento'] }}</td>
                <td>Modelo: {{ $ordens['modelo'] }}</td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 5px 0 5px 5px;background-color: rgb(202, 202, 202)">Serviços executados:</td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 5px 0 5px 0; border-bottom: 1px solid #444;">
                    {{ $ordens['servico'] }}
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 10px 0 10px 0;">
                    <p>{!! html_entity_decode($mensagem['entrega_recibo']) !!}</p>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 5px; font-weight: bold;">
                    @php
                        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                        $now = new Carbon\Carbon();
                    @endphp
                {{ $empresa['cidade'] }}, {{ $now->formatLocalized('%d de %B de %Y') }}.
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
                    ________________________________________<br>{{ $ordens->clientes->cliente }}</td>
                <td>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
