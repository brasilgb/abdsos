@extends('layouts.app')

@section('content')
<div class="card bg-light shadow-sm">
    <div class="card-header">
        <h5><i class="fa fa-file-invoice"></i> Relatório de agendamentos</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped rounded-top">
                    <thead>
                        <tr class="table-secondary">
                            <th colspan="8" class="text-center">Resumo de agendamentos</th>
                        </tr>
                        <tr class="table-active text-center">
                            <th>Aguardando atend.</th>
                            <th>Em atendimento</th>
                            <th>Cancelado</th>
                            <th>Concluído</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-light text-center">
                            <td><a href="{{ route('agendas.status', ['status' => 1]) }}" title="Aguardando atendimento">{{ $agendas->where('status', 1)->count() }}</a></td>
                            <td><a href="{{ route('agendas.status', ['status' => 2]) }}" title="Em atendimento">{{ $agendas->where('status', 2)->count() }}</a></td>
                            <td><a href="{{ route('agendas.status', ['status' => 3]) }}" title="Cancelado">{{ $agendas->where('status', 3)->count() }}</a></td>
                            <td><a href="{{ route('agendas.status', ['status' => 4]) }}" title="Concluído">{{ $agendas->where('status', 4)->count() }}</a></td>
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
