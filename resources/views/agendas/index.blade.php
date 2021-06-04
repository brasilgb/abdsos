@extends('layouts.app')

@section('content')

    <div class="card shadow-sm">
        <div class="card-header pb-0 border-bottom border-white">
            <div class="row">
                <div class="col">
                    <h4 class="text-left text-body mt-1"><i class="fa fa-calendar"></i> Agendamentos</h4>
                </div>
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">
                                @if (isset($busca)) <a
                                    href="{{ route('agendas.index') }}">Agendamentos</a> / Busca @else Agendamentos
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
                        <button onclick="window.location='{{ route('agendas.create') }}'"
                            class="btn btn-primary shadow-sm border-white"><i class="fa fa-plus"></i> Adicionar</button>
                </div>
                    @include('agendas/search')
            </div>
        </div>
        <div class="card-body p-2">
            <div class="table-responsive">
                @include("flash::message")
                <table id="tb-tarefas" class="table table-condensed table-striped mb-0">
                    <tr>
                        <th>#ID</th>
                        <th>Cliente</th>
                        <th>Técnico</th>
                        <th>Data</th>
                        <th>Hora</th>
                        <th style="width: 190px;">Status</th>
                        <th style="width: 109px;"></th>
                    </tr>
                    @forelse($agendas as $agenda)
                        <tr>
                            <td class="align-middle">{{ $agenda->id_agenda }}</td>
                            <td class="align-middle">{{ $agenda->clientes->cliente }}</td>
                            <td class="align-middle">{{ $agenda->users->name }}</td>
                            <td class="align-middle">{{ date('d/m/Y', strtotime($agenda->data)) }}</td>
                            <td class="align-middle">{{ date('H:i', strtotime($agenda->hora)) }}</td>
                            @php
                                $status = function ($stat) {
                                    switch ($stat) {
                                        case '1':
                                            return 'Aguardando Atend.';
                                            break;
                                        case '2':
                                            return 'Em Atendimento';
                                            break;
                                        case '3':
                                            return 'Cancelado';
                                            break;
                                        case '4':
                                            return 'Concluído';
                                            break;
                                    }
                                };
                                $bgcolor = function ($bg) {
                                    switch ($bg) {
                                        case '1':
                                            return 'bg-orange';
                                            break;
                                        case '2':
                                            return 'bg-blue';
                                            break;
                                        case '3':
                                            return 'bg-red';
                                            break;
                                        case '4':
                                            return 'bg-green';
                                            break;
                                    }
                                };
                            @endphp
                            <td  class="align-middle"><span  class="{{ $bgcolor($agenda->status) }} w-100 py-1 text-white shadow-sm border border-white d-block text-center rounded">{{ $status($agenda->status) }}</span></td>
                            <td class="align-middle">
                                <button
                                    onclick="window.location.href='{{ route('agendas.show', ['agenda' => $agenda->id_agenda]) }}'"
                                    class="btn btn-primary border border-white shadow"><i class="fas fa-edit"></i></button>
                                <button data-toggle="modal" onclick="deleteData({{ $agenda->id_agenda }})"
                                    data-target="#DeleteModal" class="btn btn-danger border border-white shadow"><i
                                        class="far fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            <i class="fa fa-exclamation-triangle"></i> Não há dados a carregar! <a href="{{ route('agendas.index') }}"
                                title="Listar agendas"><i class="fa fa-sync-alt"></i></a>
                        </div>
                    @endforelse
                </table>
                @if (count($agendas) > 1)
                    {{ $agendas->links() }}
                @endif
            </div>
        </div>
    </div>

    <div id="DeleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <!-- Modal content-->
            <form action="" id="deleteForm" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-check-circle"></i> Remover agendamento</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('DELETE')
                        <p class=""><i class="fa fa-exclamation-triangle"></i> Tem certeza de que
                            deseja remover este Agendamento?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>
                            Cancelar</button>
                        <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()"><i
                                class="fa fa-check"></i> Excluir</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        function deleteData(id) {
            var id = id;
            var url = '{{ route('agendas.destroy', ':id') }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }

        $(function() {
            $("#dateform, #searchform").datepicker({
                locale: 'pt-BR'
            });
        });

    </script>

@endsection
