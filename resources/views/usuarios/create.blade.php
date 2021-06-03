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
                <a href="{{ route('usuarios.index') }}" class="btn btn-primary float-left"><i
                        class="fa fa-angle-left"></i>
                    Voltar</a>
            </div>
            <div class="col">
                @include('usuarios/search')
            </div>
        </div>
    </div>
    <div class="card-body px-4 py-2">
        @include("flash::message")
        <form action="{{ route('usuarios.store') }}" method="POST" autocomplete="off">
            @method('POST')
            @csrf
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Nome:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    @error('name')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> O campo peça deve ser
                        preenchido!</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Username:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                    @error('username')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    E-mail:</label>
                <div class="col-sm-7">
                    <input id="" type="text" class="form-control" name="email" value="{{ old('email') }}">
                    @error('email')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            @php
            $funcao = [
            '' => 'Selecione a função',
            '1' => 'Administrador',
            '2' => 'Operador',
            '3' => 'Técnico',
            ];
            @endphp
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Função:</label>
                <div class="col-sm-7">
                    <select class="custom-select my-1 mr-sm-2" name="funcao">
                        @foreach ($funcao as $key => $value)
                        <option value="{{ $key }}" {{ old('funcao') == $key ? 'selected' : '' }}>
                            {{ $value }}</option>
                        @endforeach
                    </select>
                    @error('funcao')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Senha:</label>
                <div class="col-sm-7">
                    <input type="password" class="form-control" name="password" value="{{ old('password') }}">
                    @error('password')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> O campo senha deve ser
                        preenchido!</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Repita e senha:</label>
                <div class="col-sm-7">
                    <input type="password" class="form-control" name="password_confirmation"
                        value="{{ old('password_confirmation') }}">
                    @error('password_confirmation')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Confirme a senha para
                        continuar!</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer">
                <div class="row">
                    <div class="col pt-2">
                        <span class="text-danger">*Obrigatório</span>
                    </div>
                    <div class="col text-right">
                        <button id="btngeraltarefa" type="submit"
                            class="btn btn-primary border border-white shadow mr-0"><i class="fa fa-save"></i>
                            Salvar</button>
                    </div>
                </div>
            </div>
        </form>
</div>
<script>
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
                //$('.usuario_id').val(ui.item.value);
                return false;
            }
        });

</script>

@endsection
