@extends('layouts.app')

@section('content')

    <div class="card shadow-sm">
        <div class="card-header pb-0 border-bottom border-white">
            <div class="row">
                <div class="col">
                    <h4 class="text-left text-body mt-1"><i class="fas fa-fw fa-tasks"></i> Tarefas</h4>
                </div>
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"> <a href="{{ route('tarefas.index') }}">Tarefas</a></li>
                            <li class="breadcrumb-item active">Editar</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col text-left">
                    <button onclick="window.location='{{ route('tarefas.index') }}'"
                        class="btn btn-primary shadow-sm border-white"><i class="fa fa-angle-left"></i> Voltar</button>
                </div>
                @include('tarefas/search')
            </div>
        </div>
        <form id="formtarefas" action="{{ route('tarefas.update', ['tarefa' => $tarefa->id_tarefa]) }}" method="post"
            autocomplete="off">
            <div class="card-body px-4">
                @include("flash::message")

                @method('PUT')
                @csrf

                <div class="form-group row">
                    <label for="data_inicio" class="col-sm-3 col-form-label text-left">Início tarefa (data/hora) <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7 d-flex justify-content-init">
                        <div class="mr-2 flex-fill">
                            <input id="data1" type="text" class="form-control" name="data_inicio"
                                value="{{ old('data_inicio', date('d/m/Y', strtotime($tarefa->data_inicio))) }}">
                        </div>
                        <div class="flex-fill">
                            <input id="hora1" type="text" class="form-control" name="hora_inicio"
                                value="{{ old('hora_inicio', date('H:i', strtotime($tarefa->hora_inicio))) }}">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="data_previsao" class="col-sm-3 col-form-label text-left">Previsão tarefa (data/hora) <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7 d-flex justify-content-init">
                        <div class="mr-2 flex-fill">
                            <input id="data1" type="text" class="form-control" name="data_previsao"
                                value="{{ old('data_previsao', date('d/m/Y', strtotime($tarefa->data_previsao))) }}">
                        </div>
                        <div class="flex-fill">
                            <input id="hora1" type="text" class="form-control" name="hora_previsao"
                                value="{{ old('hora_previsao', date('H:i', strtotime($tarefa->hora_previsao))) }}">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="dataform" class="col-sm-3 col-form-label text-left">Descritivo (título)<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="descritivo" type="text" class="form-control" name="descritivo"
                            value="{{ old('descritivo', $tarefa->descritivo) }}">
                        @error('descritivo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="descricao" class="col-sm-3 col-form-label text-left">Descrição <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <textarea rows="3" id="descricao" type="text" class="form-control"
                            name="descricao">{{ old('descricao', $tarefa->descricao) }}</textarea>
                        @error('descricao')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                @php
                    $status = [
                        '1' => 'Aberta',
                        '2' => 'Execução',
                        '3' => 'Fechada',
                        '4' => 'Cancelada',
                    ];
                @endphp

                <div class="form-group row">
                    <label for="status" class="col-sm-3 col-form-label text-left">Status <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <select class="custom-select" name="status" id="status">
                            @foreach ($status as $key => $value)
                                <option value="{{ $key }}" @if ($key == $tarefa->status) selected @endif>{{ $value }}</option>
                            @endforeach
                        </select>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                        Técnico:</label>
                    <div class="col-sm-7">
                        <select class="custom-select my-1 mr-sm-2" name="tecnico">
                            <option value="">Selecione o Técnico</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @if ($tarefa->tecnico == $user->id) selected @endif>
                                    {{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('tecnico')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>
                                {{ __('O técnico deve ser selecionado!') }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="observacao" class="col-sm-3 col-form-label text-left">Observação </label>
                    <div class="col-sm-7">
                        <textarea rows="3" id="observacao" type="text" class="form-control" name="observacao"
                            placeholder="Especifique aqui quais dificuldades em executar a tarefa ou motivos para cancelar ou falta de material...">{{ old('observacao', $tarefa->observacao) }}</textarea>
                        @error('observacao')
                            <div class="alert alert-danger">{{ $message }}</div>
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
                        <button id="btntarefa" type="submit" class="btn btn-primary border border-white shadow mr-0"><i
                                class="fa fa-save"></i> Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @include('tarefas/script')
@endsection
