<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Etiquetas</title>
    <link rel="stylesheet" href="{{ asset('css/etiquetas.css') }}">
</head>

<body>

    @for ($i = $inicial; $i <= $final; $i++)
        <div class="etiqueta" style="float:left; width: 31mm; height: 16mm;margin-left: 1mm;margin-bottom: 1mm;">
            <div class="nomempresa">{{ $empresa->empresa }}</div>
            <div class="numordem">{{ $i }}</div>
            <div class="telempresa">{{ !empty($empresa->telefone) ? $empresa->telefone : $empresa->celular }}</div>
        </div>
    @endfor
</body>

</html>
