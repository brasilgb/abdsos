<nav class="navbar navbar-expand-lg navbar-dark bg-blue-nav border-bottom border-white shadow-sm mx-auto">
    <div class="container">

        <a height="30" class="navbar-brand" href="{{ route('home') }}">
            <img height="30" class="rounded" src="@if(empty($empresa->logo)) {{ asset('images/logo_padrao.jpg') }} @else {{ asset('thumbnail/'.$empresa->logo) }} @endif" alt="Logo">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a title="Home" class="{{ (request()->is('/')) ? 'active' : '' }} nav-link" href="{{ route('home') }}">
                        <i class="fa fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a title="Clientes" class="{{ (request()->is('clientes*')) ? 'active' : '' }} nav-link"
                        href="{{route('clientes.index')}}"><i class="fa fa-users"></i> Clientes</a>
                </li>
                <li class="nav-item">
                    <a title="Ordens" class="{{ (request()->is('ordens*')) ? 'active' : '' }} nav-link"
                        href="{{route('ordens.index')}}"><i class="fa fa-tools"></i> Ordens de serviço</a>
                </li>
                <li class="nav-item">
                    <a class="{{ (request()->is('agendas*')) ? 'active' : '' }} nav-link"
                        href="{{route('agendas.index')}}"><i class="fa fa-calendar"></i> Agendamentos</a>
                </li>
                <li class="nav-item">
                    <a class="{{ (request()->is('tarefas*')) ? 'active' : '' }} nav-link"
                        href="{{route('tarefas.index')}}"><i class="fa fa-check-square"></i> Tarefas internas</a>
                </li>
                <li class="nav-item">
                    <a title="Peças" class="{{ (request()->is('pecas*')) ? 'active' : '' }} nav-link"
                        href="{{route('pecas.index')}}"><i class="fa fa-microchip"></i> Peças</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="{{ (request()->is('configuracoes*', 'usuarios*')) ? 'active' : '' }} nav-link dropdown-toggle"
                        href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"><i class="fa fa-sliders-h"></i> Configurações</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="{{route('backups.index')}}"><i class="fa fa-database"></i>
                            Backup</a>
                        <a class="dropdown-item" href="{{route('empresas.index')}}"><i
                                class="fa fa-building"></i> Empresa</a>
                        <a class="dropdown-item" href="{{route('emails.index')}}"><i class="fa fa-at"></i>
                            E-mail</a>
                        <a class="dropdown-item" href="{{route('ferramentas.index')}}"><i
                                class="fa fa-wrench"></i> Ferramentas</a>
                        <a class="dropdown-item" href="{{route('mensagens.index')}}"><i
                                class="fa fa-comment-alt"></i> Mensagens do sistema</a>
                        <a class="dropdown-item" href="{{route('usuarios.index')}}"><i
                                class="fa fa-user"></i> Usuários</a>
                                <a class="dropdown-item" href="{{ route('abrasil.index') }}"><i
                                    class="fa fa-key"></i>
                                Licença</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="{{ (request()->is('relatorios*')) ? 'active' : '' }} nav-link dropdown-toggle" href="http://example.com" id="dropdown01"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-clipboard"></i> Relatórios</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="{{ route('relatorios.ordens') }}"><i
                                class="fa fa-tools"></i>
                            Ordens</a>
                        <a class="dropdown-item" href="{{ route('relatorios.agendas') }}"><i
                                class="fa fa-calendar"></i>
                            Agendamentos</a>
                        <a class="dropdown-item" href="{{ route('relatorios.pecas') }}"><i
                                class="fa fa-microchip"></i>
                            Peças</a>
                        <a class="dropdown-item" href="{{ route('relatorios.financeiro') }}"><i
                                class="fa fa-coins"></i>
                            Financeiro</a>
                    </div>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item mr-4">

                    <a class="nav-link" title="Tarefas pendentes" href="{{route('tarefas.aberta', ['tarefa' => 1 ])}}" onclick="event.preventDefault();
                        document.getElementById('tarefa-form').submit();">
                        <i class="fa fa-check-square text-white"></i>

                        <span class="badge @if(App\Models\Tarefa::where('status', 1)->count()> 0) badge-danger @else badge-light @endif position-absolute t-0">
                            {{ App\Models\Tarefa::where('status', 1)->count()}}
                        </span>
                    </a>
                    <form id="tarefa-form" action="{{route('tarefas.aberta', ['tarefa' => 1 ])}}" method="POST">
                        @csrf
                        @method('get')
                    </form>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01"
                        data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"><i class="fa fa-user"></i></a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item"
                            href="{{ route('usuarios.edit', ['usuario' => Auth::user()->id]) }}"><i class="fa fa-user"></i> {{ Auth::user()->name }}</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                             <i class="fa fa-sign-out-alt"></i> Sair</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
>
            </ul>
        </div>
    </div>
</nav>
