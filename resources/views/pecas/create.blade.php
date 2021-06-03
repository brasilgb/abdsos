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
                        <li class="breadcrumb-item"><a href="{{ route('pecas.index') }}"> Peças</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cadastrar</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card-header">
        <div class="row">
            <div class="col text-left">
                <button onclick="window.location='{{ route('pecas.index') }}'"
                    class="btn btn-primary shadow-sm border-white"><i class="fa fa-angle-left"></i>
                    Voltar</a></button>
            </div>
            <div class="col">
                @include('pecas/search')
            </div>
        </div>
    </div>
    <div class="card-body px-4 py-2">
        @include("flash::message")
        <form id="formpecas" action="{{ route('pecas.store') }}" method="POST" autocomplete="off">
            @method('POST')
            @csrf
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Peça:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="peca" value="{{ old('peca') }}">
                    @error('peca')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> O campo peça deve ser
                        preenchido!</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Descrição:</label>
                <div class="col-sm-7">
                    <textarea type="text" class="form-control" name="descricao">{{ old('descricao') }}</textarea>
                    @error('descricao')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Fabricante:</label>
                <div class="col-sm-7">
                    <input id="" type="text" class="form-control" name="fabricante" value="{{ old('fabricante') }}">
                    @error('fabricante')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Quantidade:</label>
                <div class="col-sm-7">
                    <input id="" type="text" class="form-control" name="quantidade" value="{{ old('quantidade') }}">
                    @error('quantidade')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Valor:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="valor" value="{{ old('valor') }}">
                    @error('valor')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            @php
            $situacao = [
            '' => 'Selecione o situacao',
            '1' => 'Nova',
            '2' => 'Usada',
            '3' => 'Remanufaturada',
            ];
            @endphp
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Situação:</label>
                <div class="col-sm-7">
                    <select class="custom-select my-1 mr-sm-2" name="situacao">
                        @foreach ($situacao as $key => $value)
                        <option value="{{ $key }}" {{ old('situacao') == $key ? 'selected' : '' }}>
                            {{ $value }}</option>
                        @endforeach
                    </select>
                    @error('situacao')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""> Observações:</label>
                <div class="col-sm-7">
                    <textarea type="text" class="form-control" name="observacaos">{{ old('fabricante') }}</textarea>
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
@include('pecas/script')
    @endsection
