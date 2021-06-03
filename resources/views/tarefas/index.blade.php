@extends('layouts.app')

@section('content')

    <div class="card shadow-sm">
        <div class="card-header pb-0 border-bottom border-white">
            <div class="row">
                <div class="col">
                    <h4 class="text-left text-body mt-1"><i class="fas fa-fw fa-tasks"></i> Tarefas</h4>
                </div>
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">
                                @if (isset($busca)) <a
                                    href="{{ route('tarefas.index') }}">Tarefas gerais</a> / Busca @else
                                    Tarefas gerais
                                @endif
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col text-left">
                    <button onclick="window.location='{{ route('tarefas.create') }}'"
                        class="btn btn-primary shadow-sm border-white"><i class="fa fa-plus"></i> Adicionar</button>
                </div>
                @include('tarefas/search')
            </div>
        </div>
        <div class="card-body p-2">
            <div class="table-responsive">
                @include("flash::message")
                <table id="tb-tarefas" class="table table-condensed table-striped mb-0">
                    <thead>
                        <tr class="text-left">
                            <th>Descritivo</th>
                            <th>Início</th>
                            <th>Previsão</th>
                            <th>Término</th>
                            <th>Situação</th>
                            <th style="width: 110px; min-width: 110px;"><i class="fa fa-level-down-alt"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tarefas as $tarefa)
                            <tr class="text-left">
                                <td class="align-middle">{{ $tarefa->descritivo }}</td>
                                <td class="align-middle">{{ date('d/m/Y', strtotime($tarefa->data_inicio)) }}
                                    {{ date('H:i', strtotime($tarefa->hora_inicio)) }}</td>
                                <td class="align-middle">{{ date('d/m/Y', strtotime($tarefa->data_previsao)) }}
                                    {{ date('H:i', strtotime($tarefa->hora_previsao)) }}</td>
                                <td class="align-middle">
                                    @if ($tarefa->data_termino)
                                        {{ date('d/m/Y', strtotime($tarefa->data_termino)) }}
                                        {{ date('H:i', strtotime($tarefa->hora_termino)) }}@endif
                                </td>
                                @php
                                    $status = function ($stat) {
                                        switch ($stat) {
                                            case 1: return 'Aberta';
                                                break;
                                            case 2: return 'Execução';
                                                break;
                                            case 3: return 'Fechada';
                                                break;
                                            case 4: return 'Cancelada';
                                                break;
                                        }
                                    };
                                    $badges = function ($badge) {
                                        switch ($badge) {
                                            case 1: return 'bg-orange text-white shadow-sm border border-white d-block text-center rounded';
                                                break;
                                            case 2: return 'bg-blue text-white shadow-sm border border-white d-block text-center rounded';
                                                break;
                                            case 3: return 'bg-green text-white shadow-sm border border-white d-block text-center rounded';
                                                break;
                                            case 4: return 'bg-red text-white shadow-sm border border-white d-block text-center rounded';
                                                break;
                                        }
                                    };
                                @endphp
                                <td class="align-middle"><span class="w-75 py-1 {{ $badges($tarefa->status)}}">
                                        {{ $status($tarefa->status) }}
                                    </span>
                                </td>
                                <td class="align-middle">

                                    <button
                                        onclick="window.location='{{ route('tarefas.edit', ['tarefa' => $tarefa->id_tarefa]) }}'"
                                        id="status" class="btn btn-primary border border-white shadow"><i
                                            class="fa fa-edit"></i></button>

                                    <button class="btn btn-danger border border-white shadow" data-toggle="modal"
                                        onclick="deleteData({{ $tarefa->id_tarefa }})" data-target="#DeleteModal"><i
                                            class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                    </tbody>
                    @empty
                        <div class="alert alert-danger">
                            <i class="fa fa-exclamation-triangle"></i> Não há dados a carregar! <a
                                href="{{ route('tarefas.index') }}" title="Listar pecas"><i class="fa fa-sync-alt"></i></a>
                        </div>
                        @endforelse
                    </table>
                </div>
            </div>
            @if ($tarefas->hasPages())
                <div class="card-footer pb-0">
                    {{ $tarefas->links() }}
                </div>
            @endif
        </div>

        <div id="DeleteModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <form action="" id="deleteForm" method="post">
                    <div class="modal-content">
                        <div class="modal-header bg-gradient-danger">
                            <h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i> Confirmar exclusão</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            @method('DELETE')
                            <p class="text-center">Tem certeza de que deseja excluir esta tarefa?
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary border border-white shadow" data-dismiss="modal"><i
                                    class="fa fa-sign-out-alt"></i> Sair</button>
                            <button type="submit" name="" class="btn btn-danger border border-white shadow" data-dismiss="modal"
                                onclick="formSubmit()"><i class="fa fa-trash"></i> Excluir</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script>
            function deleteData(id) {
                var id = id;
                var url = '{{ route('tarefas.destroy', ':id') }}';
                url = url.replace(':id', id);
                $("#deleteForm").attr('action', url);
            }

            function formSubmit() {
                $("#deleteForm").submit();
            }

        </script>
        @include('tarefas/script')
    @endsection
