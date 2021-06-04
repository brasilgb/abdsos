@extends('layouts.app')

@section('content')

<div class="card shadow-sm">
    <div class="card-header pb-0 border-bottom border-white">
        <div class="row">
            <div class="col">
                <h4 class="text-left text-body mt-1"><i class="fa fa-users"></i> Usuários</h4>
            </div>
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuários</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cadastrar</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card-header">
        <div class="row">
            <div class="col text-left">
                <a href="{{ route('usuarios.create') }}" class="btn btn-primary float-left"><i
                        class="fa fa-plus"></i>
                    Cadastrar</a>
            </div>
            <div class="col">
                @include('usuarios/search')
            </div>
        </div>
    </div>
    <div class="card-body px-4 py-2">
            @include("flash::message")

            <div class="table-responsive">
                <table id="tb-tarefas" class="table table-condensed table-striped mb-0">
                    <tr>
                        <th>#ID</th>
                        <th>Nome</th>
                        <th>Usuário</th>
                        <th>E-mail</th>
                        <th>Função</th>
                        <th>Cadastro</th>
                        <th style="width: 90px;"></th>
                    </tr>
                    @forelse($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->username }}</td>
                            <td>{{ $usuario->email }}</td>
                            @php
                                $funcao = function ($func) {
                                    switch ($func) {
                                        case '0':
                                            return 'Administrador';
                                            break;
                                        case '1':
                                            return 'Operador';
                                            break;
                                        case '2':
                                            return 'Técnico';
                                            break;
                                    }
                                };
                            @endphp
                            <td>{{ $funcao($usuario->funcao) }}</td>
                            <td>{{ date('d/m/Y', strtotime($usuario->created_at)) }}</td>
                            <td>
                                <button
                                    onclick="window.location.href='{{ route('usuarios.show', ['usuario' => $usuario->id]) }}'"
                                    class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                <button @if ($usuario->funcao == 0) {{ 'disabled' }} @endif
                                    data-toggle="modal" onclick="deleteData({{ $usuario->id }})" data-target="#DeleteModal"
                                    class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            <i class="fa fa-exclamation-triangle"></i> Não há dados a carregar! <a href="{{ route('usuarios.index') }}"
                                title="Listar usuarios"><i class="fa fa-sync-alt"></i></a>
                        </div>
                    @endforelse
                </table>
                @if (count($usuarios) > 1)
                    {{ $usuarios->links() }}
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
                        <h4 class="modal-title"><i class="fa fa-check-circle"></i> Remover usuário</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('DELETE')
                        <p class=""><i class="fa fa-exclamation-triangle"></i> Tem certeza de que
                            deseja remover este usuário?</p>
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
            var url = '{{ route('usuarios.destroy', ':id') }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }

        $('.usuario').autocomplete({
            minLength: 1,
            autoFocus: true,
            delay: 300,
            source: function(request, response) {
                _token = $("input[name='_token']").val();
                $.ajax({
                    url: '{{ route('usuarios.autocomplete') }}',
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
                $('.usuario').val(ui.item.label);
                //$('#employeeid').val(ui.item.value);
                return false;
            }
        });

    </script>

@endsection
