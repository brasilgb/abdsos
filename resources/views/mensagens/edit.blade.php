@extends('layouts.app')

@section('content')

<div class="card shadow-sm">
    <div class="card-header pb-0 border-bottom border-white">
        <div class="row">
            <div class="col">
                <h4 class="text-left text-body mt-1"><i class="fa fa-comments"></i> Mensagens</h4>
            </div>
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Mensagens</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card-header">
        <div class="card-title">
            <i class="fas fa-sliders-h" aria-hidden="true"></i> Configurações de mensagens de sistema
        </div>
    </div>

    <div class="card-body">
        @include("flash::message")
        <form id="formmensagem" action="{{ route('mensagens.update', ['mensagem' => $mensagem->id_mensagem]) }}" method="POST"
            autocomplete="off">
            @method('PUT')
            @csrf

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>Recibo entrada:</label>
                <div class="col-sm-7">
                    <textarea rows="4" type="text" class="form-control"
                        name="recebimento_recibo">{{ old('recebimento_recibo', $mensagem->recebimento_recibo) }}</textarea>
                    @error('recebimento_recibo')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>Recibo entrega:</label>
                <div class="col-sm-7">
                    <textarea rows="4" type="text" class="form-control"
                        name="entrega_recibo">{{ old('entrega_recibo', $mensagem->entrega_recibo) }}</textarea>
                    @error('entrega_recibo')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>E-mail agendamento:</label>
                <div class="col-sm-7">
                    <textarea rows="4" type="text" class="form-control"
                        name="mensagem_agendamento">{{ old('mensagem_agendamento', $mensagem->mensagem_agendamento) }}</textarea>
                    @error('mensagem_agendamento')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>E-mail serviço concluído:</label>
                <div class="col-sm-7">
                    <textarea rows="4" type="text" class="form-control"
                        name="mensagem_servico_concluido">{{ old('mensagem_servico_concluido', $mensagem->mensagem_servico_concluido) }}</textarea>
                    @error('mensagem_servico_concluido')
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
    @include('mensagens/script')
    @endsection
