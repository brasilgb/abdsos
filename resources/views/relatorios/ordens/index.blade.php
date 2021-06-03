@extends('layouts.app')

@section('content')
<div class="card bg-light shadow-sm">
    <div class="card-header">
        <h5><i class="fa fa-file-invoice"></i> Relatório de ordens</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped rounded-top">
                    <thead>
                        <tr class="table-secondary">
                            <th colspan="8" class="text-center">Resumo de Ordens de Serviço</th>
                        </tr>
                        <tr class="table-active">
                            <th>Avaliação</th>
                            <th>Orç. gerados</th>
                            <th>Orç. aprovados</th>
                            <th>Na bancada</th>
                            <th>Serv.Concluído</th>
                            <th>Serv. não efetuado</th>
                            <th>Fechadas</th>
                            <th>Entregues</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-light">
                            <td><a class="" href="{{ route('ordens.status', ['status' => 1]) }}" title="Ordens de serviço em avaliação">{{ $ordens->where('status', 1)->count() }}</a></td>
                            <td><a href="{{ route('ordens.status', ['status' => 2]) }}" title="Ordens de serviço em avaliação">{{ $ordens->where('status', 2)->count() }}</a></td>
                            <td><a href="{{ route('ordens.status', ['status' => 3]) }}" title="Ordens de serviço em avaliação">{{ $ordens->where('status', 3)->count() }}</a></td>
                            <td><a href="{{ route('ordens.status', ['status' => 4]) }}" title="Ordens de serviço em avaliação">{{ $ordens->where('status', 4)->count() }}</a></td>
                            <td><a href="{{ route('ordens.status', ['status' => 5]) }}" title="Ordens de serviço em avaliação">{{ $ordens->where('status', 5)->count() }}</a></td>
                            <td><a href="{{ route('ordens.status', ['status' => 6]) }}" title="Ordens de serviço em avaliação">{{ $ordens->where('status', 6)->count() }}</a></td>
                            <td><a href="{{ route('ordens.status', ['status' => 7]) }}" title="Ordens de serviço em avaliação">{{ $ordens->where('status', 7)->count() }}</a></td>
                            <td><a href="{{ route('ordens.status', ['status' => 8]) }}" title="Ordens de serviço em avaliação">{{ $ordens->where('status', 8)->count() }}</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>

</script>

@endsection
