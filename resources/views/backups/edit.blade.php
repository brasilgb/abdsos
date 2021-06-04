@extends('layouts.app')

@section('content')

<div class="card shadow-sm">
    <div class="card-header pb-0 border-bottom border-white">
        <div class="row">
            <div class="col">
                <h4 class="text-left text-body mt-1"><i class="fa fa-database"></i> Backup</h4>
            </div>
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Backup</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card-header">
        <div class="card-title">
            <i class="fas fa-sliders-h" aria-hidden="true"></i> Configurações de Backup
        </div>
    </div>

    <div class="card-body">
        @include("flash::message")
        <form id="formbackup" action="{{ route('backups.update', ['backup' => $backup->id_backup]) }}" method="POST" autocomplete="off">
            @method('PUT')
            @csrf

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Local:</label>
                <div class="col-sm-7">
                    <input id="local" type="text" class="form-control" name="local"
                        value="{{ old('local', $backup->local) }}" placeholder="G:\backup">
                    @error('local')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Agendamento <i>(Inserir hora)</i>:</label>
                <div class="col-sm-7">
                    <input id="agendamento" type="text" class="form-control" name="agendamento"
                        value="{{ old('agendamento', $backup->agendamento) }}">
                    @error('agendamento')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
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
    @include('backups/script')
    @endsection
