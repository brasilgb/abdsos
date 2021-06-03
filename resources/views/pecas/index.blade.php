@extends('layouts.app')

@section('content')

    <div class="card shadow-sm">
        <div class="card-header pb-0 border-bottom border-white">
            <div class="row">
                <div class="col">
                    <h4 class="text-left text-body mt-1"><i class="fa fa-memory"></i> Peças</h4>
                </div>
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">
                                @if (isset($busca)) <a
                                    href="{{ route('pecas.index') }}">Clientes</a> / Busca @else Peças
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
                        <button onclick="window.location='{{ route('pecas.create') }}'"
                            class="btn btn-primary shadow-sm border-white"><i class="fa fa-plus"></i> Adicionar</button>
                </div>

                <div class="col">
                    @include('pecas/search')
                </div>
            </div>
        </div>
        <div class="card-body px-2">
            <div class="table-responsive">
                @include("flash::message")
                <table id="tb-tarefas" class="table table-condensed table-striped mb-0">
                    <th>#ID</th>
                    <th>Peça</th>
                    <th>Qtde inicial / Estoque</th>
                    <th>Valor un.</th>
                    <th>Situação</th>
                    <th style="width: 109px;"></th>
                    </tr>
                    @forelse($pecas as $peca)
                        <tr>
                            <td class="align-middle">{{ $peca->id_peca }}</td>
                            <td class="align-middle">{{ $peca->peca }}</td>
                            <td class="align-middle">{{ $peca->quantidade }} / {{ $estoque->where('id_peca', $peca->id_peca)->sum->quantidade }}</td>
                            <td class="align-middle">{{ 'R$ ' . number_format($peca->valor, 2, ',', '.') }}</td>
                            @php
                            $situacao = function($sit){
                            switch ($sit) {
                            case 1: return 'Nova';
                            break;
                            case 2: return 'Usada';
                            break;
                            case 3: return 'Remanufaturada';
                            break;
                            }
                            }
                            @endphp
                            <td class="align-middle">{{ $situacao($peca->situacao) }}</td>
                            <td class="align-middle">
                                <button onclick="window.location.href='{{ route('pecas.show', ['peca' => $peca->id_peca]) }}'"
                                    class="btn btn-primary border border-white shadow"><i class="fas fa-edit"></i></button>
                                <button data-toggle="modal" onclick="deleteData({{ $peca->id_peca }})"
                                    data-target="#DeleteModal" class="btn btn-danger border border-white shadow"><i
                                        class="far fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            <i class="fa fa-exclamation-triangle"></i> Não há dados a carregar! <a href="{{ route('pecas.index') }}"
                                title="Listar pecas"><i class="fa fa-sync-alt"></i></a>
                        </div>
                    @endforelse
                </table>
                @if (count($pecas) > 1)
                    {{ $pecas->links() }}
                @endif
            </div>
        </div>
    </div>

    <div id="DeleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <!-- Modal content-->
            <form action="" id="deleteForm" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title text-light"><i class="fa fa-check-circle"></i> Remover peça</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('DELETE')
                        <p class="text-center text-danger"><i class="fa fa-exclamation-triangle"></i> Tem certeza de que
                            deseja remover esta Peça?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-times"></i>
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
            var url = '{{ route('pecas.destroy', ':id') }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }

        $('.peca').autocomplete({
            minLength: 1,
            autoFocus: true,
            delay: 300,
            source: function(request, response) {
                _token = $("input[name='_token']").val();
                $.ajax({
                    url: '{{ route('pecas.autocomplete') }}',
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
                $('.peca').val(ui.item.label);
                //$('#employeeid').val(ui.item.value);
                return false;
            }
        });

    </script>

@endsection
