@extends('layouts.app')

@section('content')

    <div class="card shadow-sm">
        <div class="card-header pb-0 border-bottom border-white">
            <div class="row">
                <div class="col">
                    <h4 class="text-left text-body mt-1"><i class="fa fa-users"></i> Clientes</h4>
                </div>
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">
                                @if (isset($busca)) <a
                                    href="{{ route('clientes.index') }}">Clientes</a> / Busca @else Clientes
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
                        <button onclick="window.location='{{ route('clientes.create') }}'"
                            class="btn btn-primary shadow-sm border-white"><i class="fa fa-plus"></i> Adicionar</button>
                </div>

                <div class="col">
                    @include('clientes/search')
                </div>
            </div>
        </div>
        <div class="card-body p-2">
            <div class="table-responsive">
                @include("flash::message")
                <table id="tb-tarefas" class="table table-condensed table-striped mb-0">
                    <tr>
                        <th>#ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th style="width: 153px;"></th>
                    </tr>
                    @forelse($clientes as $cliente)
                        <tr>
                            <td class="align-middle">{{ $cliente->id_cliente }}</td>
                            <td class="align-middle">{{ $cliente->cliente }}</td>
                            <td class="align-middle">{{ $cliente->email }}</td>
                            <td class="align-middle">{{ $cliente->telefone }}</td>
                            <td class="align-middle">
                                <button title="Ordens de serviço do cliente"
                                    onclick="window.location.href='{{ route('ordens.ordemcliente', ['cliente' => $cliente->id_cliente]) }}'"
                                    class="btn btn-secondary border border-white shadow"><i class="fas fa-tools"></i></button>
                                <button
                                    onclick="window.location.href='{{ route('clientes.show', ['cliente' => $cliente->id_cliente]) }}'"
                                    class="btn btn-primary border border-white shadow"><i class="fas fa-edit"></i></button>
                                <button data-toggle="modal" onclick="deleteData({{ $cliente->id_cliente }})"
                                    data-target="#DeleteModal" class="btn btn-danger border border-white shadow"><i
                                        class="far fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            <i class="fa fa-exclamation-triangle"></i> Não há dados a carregar! <a href="{{ route('clientes.index') }}"
                                title="Listar clientes"><i class="fa fa-sync-alt"></i></a>
                        </div>
                    @endforelse
                </table>
                @if ($clientes->hasPages())
                    {{ $clientes->links() }}
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
                        <h4 class="modal-title"><i class="fa fa-check-circle"></i> Remover cliente</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('DELETE')
                        <p class=""><i class="fa fa-exclamation-triangle"></i> Tem certeza de que
                            deseja remover este Cliente?</p>
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
            var url = '{{ route('clientes.destroy', ':id') }}';
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
                    url: '{{ route('clientes.autocomplete') }}',
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
                $('#input-search').val(ui.item.label);
                //$('#employeeid').val(ui.item.value);
                return false;
            }
        });

    </script>

@endsection
