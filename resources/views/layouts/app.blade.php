@php
$empresa = App\Models\Empresa::first();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ABSOS - @if(empty($empresa->empresa)) ABSOS @else {{ $empresa->empresa }} @endif</title>
    <link rel="shortcut icon"
        href="@if(empty($empresa->logo)) {{ asset('storage/images/logo_padrao.jpg') }} @else {{ asset('storage/thumbnail/'.$empresa->logo) }} @endif">

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/local.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/local.css') }}">
    <link rel="stylesheet" href="{{ asset('jquery-ui/jquery-ui.min.css') }}">
</head>

<body class="d-flex flex-column h-100">
    @guest

    <div class="container">
        @yield('content')
    </div>

    @else

    <header>
        @include('parts/nav-bar')
    </header>

    <div id="main" class="flex-shrink-0">
        <div class="container fadeIn">
            @yield('content')
        </div>
    </div><!-- /.container -->

    @include('parts/footer')

    @endguest
    @include('parts/scripts')
</body>


</html>
