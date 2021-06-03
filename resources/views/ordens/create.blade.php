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
                        <li class="breadcrumb-item"><a href="{{ route('ordens.index') }}">Ordens</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cadastrar</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card-header">
        <div class="row">
            <div class="col text-left">
                <button onclick="window.location='{{ route('ordens.index') }}'"
                    class="btn btn-primary shadow-sm border-white"><i class="fa fa-angle-left"></i>
                    Voltar</a></button>
            </div>

            @include('ordens/search')
        </div>
    </div>
    <div class="card-body px-4 py-2">
        @include("flash::message")
        <form id="formordem" action="{{ route('ordens.store') }}" method="POST" autocomplete="off">
            @method('POST')
            @csrf
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""> Ordem n°:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="" value="{{ $proxordem }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Cliente:</label>
                <div class="col-sm-7">
                    <input id="cliente" type="text" class="form-control" name="cliente" value="{{ old('cliente') }}">
                    <input id="cliente_id" type="hidden" class="form-control" name="cliente_id"
                        value="{{ old('cliente_id') }}">
                    @error('cliente_id')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> O campo cliente deve ser
                        preenchido!</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Equipamento:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="equipamento" value="{{ old('equipamento') }}">
                    @error('equipamento')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Modelo:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="modelo" value="{{ old('modelo') }}">
                    @error('modelo')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Senha:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="senha" value="{{ old('senha') }}" placeholder="Senha ou zero">
                    @error('senha')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Defeito:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="defeito" value="{{ old('defeito') }}">
                    @error('defeito')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Estado do equipamento:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="estado" value="{{ old('estado') }}">
                    @error('estado')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""> Acessórios:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="acessorios" value="{{ old('acessorios') }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="">Observações:</label>
                <div class="col-sm-7">
                    <textarea type="text" class="form-control" name="observacoes">{{ old('observacoes') }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="">Previsão:</label>
                <div class="col-sm-7">
                    <input id="dateform" type="text" class="form-control" name="previsao" value="{{ old('previsao') }}">
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
    @include('ordens/script')
    @endsection
