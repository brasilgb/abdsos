@extends('layouts.app')

@section('content')

    <div class="card shadow-sm">
        <div class="card-header pb-0 border-bottom border-white">
            <div class="row">
                <div class="col">
                    <h4 class="text-left text-body mt-1"><i class="fa fa-tools"></i> Ordens</h4>
                </div>
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">
                                @if (isset($busca)) <a
                                    href="{{ route('ordens.index') }}">Ordens</a> / Busca @else Ordens
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
                    <button onclick="window.location='{{ route('ordens.create') }}'"
                        class="btn btn-primary shadow-sm border-white"><i class="fa fa-plus"></i> Adicionar</button>
                </div>
                @include('ordens/search')
            </div>
        </div>
        <div class="card-body p-2">
            <div class="table-responsive">
                @include("flash::message")
                <table id="tb-tarefas" class="table table-condensed table-striped mb-0">
                    <tr>
                        <th>#ID</th>
                        <th>Cliente</th>
                        <th>Data Entrada</th>
                        <th>Previsão Entrega</th>
                        <th>Status</th>
                        <th style="width: 153px;"></th>
                    </tr>
                    @forelse($ordens as $ordem)
                        <tr>
                            <td class="align-middle">{{ $ordem->id_ordem }}</td>
                            <td class="align-middle">{{ $ordem->clientes->cliente }}</td>
                            <td class="align-middle">{{ formatDateTime($ordem->created_at) }}</td>
                            <td class="align-middle">{{ formatDateTime($ordem->previsao) }}</td>
                            @php
                                $status = function ($func) {
                                    switch ($func) {
                                        case null:
                                            return 'Recebido';
                                            break;
                                        case 1:
                                            return 'Em avaliação';
                                            break;
                                        case 2:
                                            return 'Orçamento gerado';
                                            break;
                                        case 3:
                                            return 'Orçamento aprovado';
                                            break;
                                        case 4:
                                            return 'Na bancada';
                                            break;
                                        case 5:
                                            return 'Serviço concluído';
                                            break;
                                        case 6:
                                            return 'Serviço não efetuado';
                                            break;
                                        case 7:
                                            return 'Ordem fechada';
                                            break;
                                        case 8:
                                            return 'Equipamento entregue';
                                            break;
                                    }
                                };

                                $badges = function ($badge) {
                                    switch ($badge) {
                                        case 1:
                                            return 'bg-orange text-white shadow-sm border border-white d-block text-center rounded';
                                            break;
                                        case 2:
                                            return 'bg-teal text-white shadow-sm border border-white d-block text-center rounded';
                                            break;
                                        case 3:
                                            return 'bg-indigo text-white shadow-sm border border-white d-block text-center rounded';
                                            break;
                                        case 4:
                                            return 'bg-blue text-white shadow-sm border border-white d-block text-center rounded';
                                            break;
                                        case 5:
                                            return 'bg-cyan text-white shadow-sm border border-white d-block text-center rounded';
                                            break;
                                        case 6:
                                            return 'bg-red text-white shadow-sm border border-white d-block text-center rounded';
                                            break;
                                        case 7:
                                            return 'bg-purple text-white shadow-sm border border-white d-block text-center rounded';
                                            break;
                                        case 8:
                                            return 'bg-green text-white shadow-sm border border-white d-block text-center rounded';
                                            break;
                                    }
                                };
                            @endphp
                            <td class="align-middle"><span class="w-100 py-1 {{ $badges($ordem->status) }}">{{ $status($ordem->status) }}</span></td>
                            <td class="align-middle">
                                @php
                                    $linkname = $link_blank == true ? '_blank' : '_self';
                                @endphp
                                @if ($ordem->status == 8)
                                    <button
                                        onclick="window.open('{{ route('ordens.reciboentrega', ['orden' => $ordem->id_ordem]) }}', '{{ $linkname }}')"
                                        class="btn btn-success border border-white shadow" title="Emitir recibo de entrega"><i
                                            class="fas fa-receipt"></i></button>
                                @else
                                    <button
                                        onclick="window.open('{{ route('ordens.reciborecebe', ['orden' => $ordem->id_ordem]) }}', '{{ $linkname }}')"
                                        class="btn btn-secondary border border-white shadow"
                                        title="Emitir recibo de recebimento"><i class="fas fa-receipt"></i></button>
                                @endif

                                <button
                                    onclick="window.location.href='{{ route('ordens.show', ['orden' => $ordem->id_ordem]) }}'"
                                    class="btn btn-primary border border-white shadow"><i class="fas fa-edit"></i></button>
                                <button data-toggle="modal" onclick="deleteData({{ $ordem->id_ordem }})"
                                    data-target="#DeleteModal" class="btn btn-danger border border-white shadow"><i
                                        class="far fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            <i class="fa fa-exclamation-triangle"></i> Não há dados a carregar! <a
                                href="{{ route('ordens.index') }}" title="Listar ordens"><i
                                    class="fa fa-sync-alt"></i></a>
                        </div>
                    @endforelse
                </table>

                @if (count($ordens) > 1)
                    {{ $ordens->links() }}
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
                        <h4 class="modal-title"><i class="fa fa-check-circle"></i> Remover ordem</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('DELETE')
                        <p class=""><i class="fa fa-exclamation-triangle"></i> Tem certeza de que
                            deseja remover esta ordem?</p>
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
            var url = '{{ route('ordens.destroy', ':id') }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }

        $('#input-search').autocomplete({
            minLength: 1,
            autoFocus: true,
            delay: 300,
            source: function(request, response) {
                _token = $("input[name='_token']").val();
                $.ajax({
                    url: '{{ route('ordens.autocomplete') }}',
                    type: 'POST',
                    dataType: "json",
                    data: {
                        '_token': _token,
                        'term': request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                $('#input-search').val(ui.item.value);
                return false;
            }
        });
    </script>

@endsection
