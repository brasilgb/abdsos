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
                        <li class="breadcrumb-item active" aria-current="page">Editar</li>
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
        <form id="formordem" action="{{ route('ordens.update', ['orden' => $orden->id_ordem]) }}" method="POST" autocomplete="off">
            @method('PUT')
            @csrf
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""> Ordem n°:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="" value="{{ $orden->id_ordem }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span> Nome do
                    cliente:</label>
                <div class="col-sm-7">
                    <input id="cliente" type="text" class="form-control" name="cliente"
                        value="{{ old('cliente', $orden->clientes->cliente) }}" readonly>
                    <input id="cliente_id" type="hidden" class="form-control" name="cliente_id"
                        value="{{ old('cliente_id', $orden->cliente_id) }}">
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
                    <input type="text" class="form-control" name="equipamento"
                        value="{{ old('equipamento', $orden->equipamento) }}">
                    @error('equipamento')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Modelo:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="modelo" value="{{ old('modelo', $orden->modelo) }}">
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
                    <input type="text" class="form-control" name="senha" value="{{ old('senha', $orden->senha) }}">
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
                    <input type="text" class="form-control" name="defeito"
                        value="{{ old('defeito', $orden->defeito) }}">
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
                    <input type="text" class="form-control" name="estado" value="{{ old('estado', $orden->estado) }}">
                    @error('estado')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""> Acessórios:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="acessorios"
                        value="{{ old('acessorios', $orden->acessorios) }}">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="bg-gray-200 px-2 pb-1 pt-2 mb-4 shadow-sm rounded-top border border-gray-900">
                        <h3 class="text-black-50 text-header-ordem font-weight-bold">Orçamento</h3>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""> Orçamento:</label>
                <div class="col-sm-7">
                    <textarea type="text" class="form-control"
                        name="orcamento">{{ old('orcamento', $orden->orcamento) }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""> Valor Orçamento:</label>
                <div class="col-sm-7">
                    <input type="text" class="totalgeral form-control" name="valorcamento"
                        value="{{ old('valorcamento', $orden->valorcamento) }}">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="bg-gray-200 px-2 pb-1 pt-2 mb-4 shadow-sm rounded-top border border-gray-900">
                        <h3 class="text-black-50 text-header-ordem font-weight-bold">Peças</h3>
                    </div>
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""> Adicionar peças:</label>
                <div class="col-sm-7">
                    <div class="input-group">
                        <div class="input-group-append">
                            <button id="addpeca" class="rounded-left btn btn-info text-white"
                                title="Adiciona peça a ordem de serviço"><i class="fa fa-plus"></i></button>
                        </div>
                        <input type="text" class="peca form-control rounded-right" name="term"
                            placeholder="Buscar por peça">
                    </div>
                </div>
                <input id="pecaid" type="hidden" name="id_peca">
                <input id="ordemid" type="hidden" name="id_ordem" value="{{ $orden->id_ordem }}">
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">
                    <span class="titlelist"
                        style="display:@if ($ordens->count() > 0) {{ '' }}@else{{ 'none' }} @endif;">Peças
                        adicionadas</span>
                </label>
                <div class="col-sm-7">
                    @if ($ordens->count() > 0)
                    <ul id="linkpecas" class="list-group list-group-flush listpecas">
                        @php $sum = 0; @endphp
                        @foreach ($ordens as $ordem)
                        @foreach (App\Models\Peca::where('id_peca', $ordem->id_peca)->get() as $pecas)
                        <input class="totalgeral" type="hidden" value="{{ $pecas->valor }}">
                        <li class="list-group-item"><i class="fa fa-caret-right text-default"></i>
                            {{ $pecas->peca }}
                            <span style="margin-left:10%;">{{ 'R$' . number_format($pecas->valor, 2, ',', '.') }}</span>
                            <a title="Remover peça da lista"
                                href="{{ route('pecas.delpecord', ['peca' => $ordem->id_peca]) }}"><i
                                    class="fa fa-times text-danger float-right"></i></a>
                        </li>
                        @php
                        $sum += $pecas->valor;
                        @endphp
                        @endforeach
                        @endforeach
                        <li class="list-group-item list-group-item-action list-group-item-info"><i
                                class="fa fa-check text-success"></i>

                            Total em peças: {{ 'R$' . number_format($sum, 2, ',', '.') }}

                        </li>
                    </ul>
                    @else
                    <ul class="list-group list-group-flush listpecas" style="display: none">
                    </ul>
                    @endif
                </div>
            </div>


            <div class="row">
                <div class="col">
                    <div class="bg-gray-200 px-2 pb-1 pt-2 mb-4 shadow-sm rounded-top border border-gray-900">
                        <h3 class="text-black-50 text-header-ordem font-weight-bold">Serviço</h3>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="">Serviço:</label>
                <div class="col-sm-7">
                    <textarea type="text" class="form-control"
                        name="servico">{{ old('servico', $orden->servico) }}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""> Valor Serviço:</label>
                <div class="col-sm-7">
                    <input type="text" class="totalgeral form-control" name="valservico"
                        value="{{ old('valservico', $orden->valservico) }}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="">Valor Total:</label>
                <div class="col-sm-7">
                    <input type="text" class="valtotal form-control" name="valtotal" @php if (empty($sum)): $sum=0;
                        else: $sum=$sum; endif; @endphp
                        value="{{ old('valtotal', $sum + $orden->valorcamento + $orden->valservico) }}" readonly>
                </div>
            </div>
            @php
            $status = [
            '1' => 'Em avaliação',
            '2' => 'Orçamento gerado',
            '3' => 'Orçamento aprovado',
            '4' => 'Na bancada',
            '5' => 'Serviço concluído',
            '6' => 'Serviço não efetuado',
            '7' => 'Ordem fechada',
            '8' => 'Equipamento entregue',
            ];
            @endphp
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="">Status:</label>
                <div class="col-sm-7">
                    <select class="custom-select my-1 mr-sm-2" name="status">
                        @foreach ($status as $key => $value)
                        <option value="{{ $key }}" {{ old('status', $orden->status) == $key ? 'selected' : '' }}>
                            {{ $value }}</option>
                        @endforeach
                    </select>
                    @error('status')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            @php
            $pagamento = [
            '1' => 'Pagamento aberto',
            '2' => 'Somente serviços',
            '3' => 'Somente peças',
            '4' => 'Pagamento total',
            ];
            @endphp
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="">Pagamento:</label>
                <div class="col-sm-7">
                    <select class="custom-select my-1 mr-sm-2" name="pagamento">
                        @foreach ($pagamento as $key => $value)
                        <option value="{{ $key }}" {{ old('pagamento', $orden->pagamento) == $key ? 'selected' : '' }}>
                            {{ $value }}</option>
                        @endforeach
                    </select>
                    @error('pagamento')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="">
                    Técnico:</label>
                <div class="col-sm-7">
                    <select class="custom-select my-1 mr-sm-2" name="tecnico">
                        <option value="">Selecione o Técnico</option>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}" @if( old('tecnico', $orden->tecnico)==$user->id) selected
                            @endif>{{ $user->name }}</option>
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
                <label class="col-sm-3 col-form-label" for="">Observações:</label>
                <div class="col-sm-7">
                    <textarea type="text" class="form-control" name="observacoes"
                        rows="3">{{ old('observacoes', $orden->observacoes) }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="">Previsão:</label>
                <div class="col-sm-7">
                    <input id="dateform" type="text" class="form-control" name="previsao"
                        value="{{ old('previsao', date('d/m/Y', strtotime($orden->previsao))) }}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""> Enviar e-mail:</label>
                <div class="col-sm-7">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="getemail" name="getemail" value="1"
                            {{ old('getemail') ? 'checked' : null }} @if(!$email) disabled @endif>
                        <label class="custom-control-label @if(!$email) text-danger @endif"
                            for="getemail">{{ !$email? 'Para enviar mensagem ao cliente, configure o envio de email!' : 'Selecione para enviar e-mail ao cliente o serviço foi concluído!' }}
                            @if(!$email) <a href="{{ route('emails.create') }}">conigurar envio de e-mail</a> @endif</label>
                    </div>
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
                        class="fa fa-save"></i>
                    Salvar</button>
            </div>
        </div>
    </div>
    </form>
</div>
@include('ordens/script')
@endsection
