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
                        <li class="breadcrumb-item"><a href="{{ route('agendas.index') }}">Agendamentos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cadastrar</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card-header">
        <div class="row">
            <div class="col text-left">
                <button onclick="window.location='{{ route('agendas.index') }}'"
                    class="btn btn-primary shadow-sm border-white"><i class="fa fa-angle-left"></i>
                    Voltar</a></button>
            </div>
                @include('agendas/search')
        </div>
    </div>
    <div class="card-body px-4 py-2">
        @include("flash::message")
        <form id="formagenda" action="{{ route('agendas.store') }}" method="POST" autocomplete="off">
            @method('POST')
            @csrf
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Cliente:</label>
                <div class="col-sm-7">
                    <input type="text" class="cliente form-control" name="cliente" value="{{ old('cliente') }}">
                    <input type="hidden" class="cliente_id form-control" name="cliente_id"
                        value="{{ old('cliente_id') }}">
                    @error('cliente_id')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> O campo cliente deve ser
                        preenchido!</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Data:</label>
                <div class="col-sm-7">
                    <input id="dateform" type="text" class="form-control" name="data" value="{{ old('data') }}">
                    @error('data')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Hora:</label>
                <div class="col-sm-7">
                    <input id="timeform" type="text" class="form-control" name="hora" value="{{ old('hora') }}">
                    @error('hora')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Serviço:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="servico" value="{{ old('servico') }}">
                    @error('servico')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Detalhes:</label>
                <div class="col-sm-7">
                    <textarea type="text" class="form-control" name="detalhes">{{ old('detalhes') }}</textarea>
                    @error('detalhes')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Técnico:</label>
                <div class="col-sm-7">
                    <select class="custom-select my-1 mr-sm-2" name="tecnico_id">
                        <option value="">Selecione o Técnico</option>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}" @if(old('tecnico_id')==$user->id) selected
                            @endif>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('tecnico_id')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>
                        {{ __('O técnico deve ser selecionado!') }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""> Enviar e-mail:</label>
                <div class="col-sm-7">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="getemail" name="getemail" value="1"
                            {{ old('getemail') ? 'checked' : null }} @if(!$email) disabled @endif>
                        <label class="custom-control-label @if(!$email) text-danger @endif"
                            for="getemail">{{ !$email ? 'Para selecionar este campo configure o envio de email!' : 'Selecione para enviar email ao cliente' }}
                            @if(!$email) <a href="{{ route('emails.create') }}">aqui</a> @endif</label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""> Observações:</label>
                <div class="col-sm-7">
                    <textarea type="text" class="form-control" name="observacoes"></textarea>
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
    @include('agendas/script')
    @endsection
