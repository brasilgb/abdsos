@extends('layouts.app')

@section('content')

<div class="card shadow-sm">
    <div class="card-header pb-0 border-bottom border-white">
        <div class="row">
            <div class="col">
                <h4 class="text-left text-body mt-1"><i class="fa fa-building"></i> Empresa</h4>
            </div>
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Empresa</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card-header">
        <div class="card-title">
            <i class="fas fa-sliders-h" aria-hidden="true"></i> Configurações da Empresa
        </div>
    </div>

    <div class="card-body">
        @include("flash::message")
        <form id="formempresa" action="{{ route('empresas.update', ['empresa' => $empresa->id_empresa]) }}" method="POST"
            enctype="multipart/form-data" autocomplete="off">
            @method('PUT')
            @csrf
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Nome fantasia:</label>
                <div class="col-sm-7">
                    <input id="" type="text" class="form-control" name="empresa"
                        value="{{ old('empresa', $empresa->empresa) }}">
                    @error('empresa')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> O campo cliente deve
                        ser
                        preenchido!</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span> Razão
                    Social:</label>
                <div class="col-sm-7">
                    <input id="" type="text" class="form-control" name="razao"
                        value="{{ old('razao', $empresa->razao) }}">
                    @error('razao')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    CNPJ:</label>
                <div class="col-sm-7">
                    <input id="" type="text" class="cnpj form-control" name="cnpj"
                        value="{{ old('cnpj', $empresa->cnpj) }}">
                    @error('cnpj')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="">
                    Logo:</label>
                <div class="col-sm-7">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="logo" id="validatedCustomFile"
                            value="{{ old('logo') }}">
                        <label class="custom-file-label" for="validatedCustomFile">Selecione a imagem...</label>
                    </div>
                    <input type="hidden" name="dblogo" value="{{ $empresa->logo }}">
                    @error('logo')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Endereço:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="endereco"
                        value="{{ old('endereco', $empresa->endereco) }}">
                    @error('endereco')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Número:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="numero"
                        value="{{ old('numero', $empresa->numero) }}">
                    @error('numero')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Bairro:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="bairro" value="{{ old('bairro', $empresa->bairro) }}">
                    @error('bairro')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Cidade:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="cidade" value="{{ old('cidade', $empresa->cidade) }}">
                    @error('cidade')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    UF: <small><i class="text-black50">(Estado)</i></small></label>
                    <div class="col-sm-7">
                        <select class="custom-select my-1 mr-sm-2" name="uf" id="uf">
                            <option value="">Selecione a UF - Estado</option>
                            @foreach ($estados as $key => $value)
                            <option value="{{ $key }}" @if($key == $empresa->uf) selected @endif>{{ $value }}</option>
                            @endforeach
                        </select>
                        @error('uf')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    CEP:</label>
                <div class="col-sm-7">
                    <input id="" type="text" class="cep form-control" name="cep"
                        value="{{ old('cep', $empresa->cep) }}">
                    @error('cep')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="">
                    Telefone:</label>
                <div class="col-sm-7">
                    <input id="" type="text" class="telefone form-control" name="telefone"
                        value="{{ old('telefone', $empresa->telefone) }}">
                    @error('telefone')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    Celular:</label>
                <div class="col-sm-7">
                    <input id="" type="text" class="celular form-control" name="celular"
                        value="{{ old('celular', $empresa->celular) }}">
                    @error('celular')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="">Site:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="site" placeholder="http://dominio.com"
                        value="{{ old('site', $empresa->site) }}">
                    @error('site')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    E-mail:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="email" value="{{ old('email', $empresa->email) }}">
                    @error('email')
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
    <script>
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

    </script>
 @include('empresas/script')
    @endsection
