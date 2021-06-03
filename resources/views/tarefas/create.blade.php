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
                            <li class="breadcrumb-item active">Adicionar</a></li>
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
        <form id="formtarefas" action="{{ route('tarefas.store') }}" method="post" autocomplete="off">
            <div class="card-body px-4">
                @include("flash::message")

                @method('POST')
                @csrf

                <div class="form-group row">
                    <label for="data_inicio" class="col-sm-3 col-form-label text-left">Início tarefa (data/hora) <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7 d-flex justify-content-init">
                        <div class="mr-2 flex-fill">
                            <input id="data1" type="text" class="form-control" name="data_inicio"
                                value="{{ old('data_inicio', date('d/m/Y', strtotime(now()))) }}">
                        </div>
                        <div class="flex-fill">
                            <input id="hora1" type="text" class="form-control" name="hora_inicio"
                                value="{{ old('hora_inicio', date('H:i', strtotime(now()))) }}">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="data_previsao" class="col-sm-3 col-form-label text-left">Previsão tarefa (data/hora) <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7 d-flex justify-content-init">
                        <div class="mr-2 flex-fill">
                            <input id="data2" type="text" class="form-control" name="data_previsao"
                                value="{{ old('data_previsao', date('d/m/Y', strtotime(now()))) }}">
                        </div>
                        <div class="flex-fill">
                            <input id="hora2" type="text" class="form-control" name="hora_previsao"
                                value="{{ old('hora_previsao', date('H:i', strtotime(now()))) }}">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="dataform" class="col-sm-3 col-form-label text-left">Descritivo (título)<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="descritivo" type="text" class="form-control" name="descritivo"
                            value="{{ old('descritivo') }}">
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
                            name="descricao">{{ old('descricao') }}</textarea>
                        @error('descricao')
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
                        <button id="btngeraltarefa" type="submit" class="btn btn-primary border border-white shadow mr-0"><i
                                class="fa fa-save"></i> Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @include('tarefas/script')
@endsection
