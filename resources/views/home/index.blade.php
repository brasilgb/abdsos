@extends('layouts.app')

@section('content')
<script>
    jQuery(window).on('load', function($){
        atualizaRelogio();
    });
</script>
@include("parts/flash-message")
<div class="bg-gray-200 mb-3 mt-0 p-2 shadow-sm border border-white rounded">
    <div class="row">
        <div class="col">
            <h3 style="font: bold 1rem Sans-serif; text-shadow: 1px 1px #ffffff;"
                class="text-black-50 text-uppercase pt-2 text-left"><i class="fa fa-tools"></i> SOS - Sistema de
                Ordens de serviço
            </h3>
        </div>
        <div class="col-2 border-left text-center">
            <a @if($backups->count() == 0) disabled @endif href="{{ route('configuracoes.gerabackup') }}" style="border-color: rgb(196, 196, 196);" class="btn btn-light rounded shadow-sm"><i class="fa fa-database"></i> Gerar Backup</a>
        </div>
        <div class="col-2 border-left">
            <div style="font: bold 1rem Sans-serif; text-shadow: 1px 1px #ffffff;" class="text-black-50 text-uppercase pt-2 text-left">
                <span id="data"></span>
                <span id="hora"></span>
            </div>

        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue shadow-sm border border-white rounded">
                <div class="inner">
                    <h3>{{ $ordens->count()}}</h3>

                    <p>Ordens de Serviço</p>
                </div>
                <div class="icon">
                    <i class="fa fa-tools"></i>
                </div>
                <a href="{{ route('ordens.index') }}" class="small-box-footer">
                    Acessar ordens <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-orange shadow-sm border border-white rounded">
                <div class="inner">
                    <h3>{{ $clientes->count() }}</h3>

                    <p>Clientes</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="{{ route('clientes.index') }}" class="small-box-footer">
                    Acessar clientes <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green shadow-sm border border-white rounded">
                <div class="inner">
                    <h3>{{ $pecas->count() }}</h3>

                    <p>Peças</p>
                </div>
                <div class="icon">
                    <i class="fa fa-memory"></i>
                </div>
                <a href="{{ route('pecas.index') }}" class="small-box-footer">
                    Acessar peças <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red shadow-sm border border-white rounded">
                <div class="inner">
                    <h3>{{ $agendas->count() }}</h3>

                    <p>Agendamentos</p>
                </div>
                <div class="icon">
                    <i class="fa fa-calendar"></i>
                </div>
                <a href="{{ route('agendas.index') }}" class="small-box-footer">
                    Acessar agendamentos <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
    </div>

<div class="row">
    <div class="col-lg-6 col-xs-12">
        <div class="card bg-light mt-0 shadow-sm">
            <div class="card-header pb-0">
                <h5><i class="fa fa-calendar"></i> Agendamentos aguardando atendimento</h5>
            </div>
            <div
                class="card-body pb-0 @if($agendas->where('status', 1)->count() > 3) table-overflow @else table-fixa @endif">
                <table class="table table-striped table-hover table-condensed">
                    <thead>
                        <tr class="bg-gray-300 text-black-50">
                            <td style="width: 70px;">#</td>
                            <td style="width: 250px;">Cliente</td>
                            <td>Data/Hora</td>
                            <th style="width: 50px;"></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agendas->where('status', 1)->orderby('id_agenda', 'DESC')->get() as $agenda)
                        <tr>
                            <td>{{ $agenda->id_agenda }}</td>
                            <td>{{ $agenda->clientes->cliente }}</td>
                            <td>{{ formatDateTime( $agenda->data) }}</td>
                            <td><button
                                    onclick="window.location.href='{{ route('agendas.show', ['agenda' => $agenda->id_agenda]) }}'"
                                    class="btn btn-sm btn-default"><i class="fas fa-eye"></i></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-xs-12">
        <div class="card bg-light mt-0 shadow-sm">
            <div class="card-header pb-0">
                <h5><i class="fa fa-calendar"></i> Agendamentos em atendimento</h5>
            </div>
            <div
                class="card-body pb-0 @if($agendas->where('status', 2)->count() > 3) table-overflow @else table-fixa @endif">
                <table class="table table-striped table-hover table-condensed">
                    <thead>
                        <tr class="bg-gray-300 text-black-50">
                            <td style="width: 70px;">#</td>
                            <td style="width: 250px;">Cliente</td>
                            <td>Data/Hora</td>
                            <th style="width: 50px;"></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agendas->where('status', 2)->orderby('id_agenda', 'DESC')->get() as $agenda)
                        <tr>
                            <td>{{ $agenda->id_agenda }}</td>
                            <td>{{ $agenda->clientes->cliente }}</td>
                            <td>{{ formatDateTime( $agenda->data) }}</td>
                            <td><button
                                    onclick="window.location.href='{{ route('agendas.show', ['agenda' => $agenda->id_agenda]) }}'"
                                    class="btn btn-sm btn-default"><i class="fas fa-eye"></i></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-6 col-xs-12">
        <div class="card bg-light mt-3 shadow-sm">
            <div class="card-header pb-0">
                <h5><i class="fa fa-tools"></i> Orçamentos aprovados</h5>
            </div>
            <div
                class="card-body pb-0 @if($ordens->where('status', 3)->count() > 3) table-overflow @else table-fixa @endif">
                <table class="table table-striped table-hover table-condensed">
                    <thead>
                        <tr class="bg-gray-300 text-black-50">
                            <td style="width: 70px;">#</td>
                            <td style="width: 250px;">Cliente</td>
                            <td>Previsão</td>
                            <th style="width: 50px;"></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ordens->where('status', 3)->orderby('id_ordem', 'DESC')->get() as $ordem)
                        <tr>
                            <td>{{ $ordem->id_ordem }}</td>
                            <td>{{ $ordem->clientes->cliente }}</td>
                            <td>{{ formatDateTime( $ordem->previsao) }}</td>
                            <td><button
                                    onclick="window.location.href='{{ route('ordens.show', ['orden' => $ordem->id_ordem]) }}'"
                                    class="btn btn-sm btn-success"><i class="fas fa-eye"></i></button></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xs-12">
        <div class="card bg-light mt-3 shadow-sm">
            <div class="card-header pb-0">
                <h5><i class="fa fa-tools"></i> Ordens concluídas <small>( serviço concluído avisar cliente)</small>
                </h5>
            </div>
            <div
                class="card-body pb-0 @if($ordens->where('status', 5)->count() > 3) table-overflow @else table-fixa @endif">
                <table class="table table-striped table-hover table-condensed">
                    <thead>
                        <tr class="bg-gray-300 text-black-50">
                            <td style="width: 70px;">#</td>
                            <td style="width: 250px;">Cliente</td>
                            <td>Previsão</td>
                            <th style="width: 50px;"></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ordens->where('status', 5)->orderby('id_ordem', 'DESC')->get() as $ordem)
                        <tr>
                            <td>{{ $ordem->id_ordem }}</td>
                            <td>{{ $ordem->clientes->cliente }}</td>
                            <td>{{ formatDateTime( $ordem->previsao) }}</td>
                            <td><button
                                    onclick="window.location.href='{{ route('ordens.show', ['orden' => $ordem->id_ordem]) }}'"
                                    class="btn btn-sm btn-default"><i class="fas fa-eye"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('home/scripts')
@endsection
