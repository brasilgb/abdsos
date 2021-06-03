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
                            <li class="breadcrumb-item"><a href="{{ route('clientes.index') }}">Clientes</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col text-left">
                        <button onclick="window.location='{{ route('clientes.index') }}'"
                            class="btn btn-primary shadow-sm border-white"><i class="fa fa-angle-left"></i>
                            Voltar</a></button>
                </div>

                <div class="col">
                    @include('clientes/search')
                </div>
            </div>
        </div>
        <div class="card-body px-4 py-2">
            @include("flash::message")
            <form id="formcliente" action="{{ route('clientes.update', [$cliente->id_cliente]) }}" method="POST" autocomplete="off">
                @method('PUT')
                @csrf
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span> Nome do
                        cliente:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="cliente" value="{{ old('cliente', $cliente->cliente) }}">
                        @error('cliente')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                        Nascimento:</label>
                    <div class="col-sm-7">
                        <input id="dateform" type="text" class="form-control" name="nascimento"
                            value="{{ old('nascimento', date('d/m/Y', strtotime($cliente->nascimento))) }}">
                        @error('nascimento')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                        E-mail:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="email" value="{{ old('email', $cliente->email) }}">
                        @error('email')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="">Telefone:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control telefone" name="telefone"
                            value="{{ old('telefone', $cliente->telefone) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                        Celular:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control celular" name="celular" value="{{ old('celular', $cliente->celular) }}">
                        @error('celular')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                        Logradouro:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="logradouro" value="{{ old('logradouro', $cliente->logradouro) }}">
                        @error('logradouro')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                        Número:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="numero" value="{{ old('numero', $cliente->numero) }}">
                        @error('numero')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                        Complemento:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="complemento" value="{{ old('complemento', $cliente->complemento) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                        Bairro:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="bairro" value="{{ old('bairro', $cliente->bairro) }}">
                        @error('bairro')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                        UF:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="estado" value="RS" value="{{ old('estado', $cliente->estado) }}">
                        @error('estado')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> UF</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                        Cidade:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="cidade" value="{{ old('cidade', $cliente->cidade) }}">
                        @error('cidade')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                        CEP:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control cep" name="cep" value="{{ old('cep', $cliente->cep) }}">
                        @error('cep')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                        CPF:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control cpf" name="cpf" value="{{ old('cpf', $cliente->cpf) }}">
                        @error('cpf')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="">RG:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control rg" name="rg" value="{{ old('rg', $cliente->rg) }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="">Contato:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="contato" value="{{ old('contato', $cliente->contato) }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="">Telefone do contato:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control telefone" name="telefone_contato"
                            value="{{ old('telefone_contato', $cliente->telefone_contato) }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="">Celular do contato:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control celular" name="celular_contato"
                            value="{{ old('celular_contato', $cliente->celular_contato) }}">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col pt-2">
                        <span class="text-danger">*Obrigatório</span>
                    </div>
                    <div class="col text-right">
                        <button id="btngeraltarefa" type="submit" class="btn btn-primary border border-white shadow mr-0"><i
                                class="fa fa-save"></i> Salvar</button>
                    </div>
                </div>
            </div>
            </form>
    </div>
@include('clientes/script')
@endsection
