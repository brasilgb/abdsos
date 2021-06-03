@extends('layouts.app')

@section('content')

<div class="card bg-light shadow-sm">
    <div class="card-header pb-0 border-bottom border-white">
        <div class="row">
            <div class="col">
                <h4 class="text-left text-body mt-1"><i class="fa fa-key" aria-hidden="true"></i> Licença</h4>
            </div>
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Licença</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card-body">
        @include("flash::message")
        <form action="{{ route('abrasil.update', ['abrasil' => $userlocal->chave]) }}" method="POST">
            @method('PUT')
            @csrf
            @if (!$licencas)
            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Seu software não está licenciado,
                solicite uma licença!</div>
            @endif

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for=""><span class="text-danger">*</span>
                    E-mail licenciado:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control email" name="email"
                        value="{{ old('email', $licencas == false ?'':$licencas->email) }}">
                    @error('email')
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="">
                    Chave de licença: <small><i class="text-danger">(Não alterável)</i></small></label>
                <div class="col-sm-7">
                    <input disabled type="text" class="form-control licenca" name="licenca"
                        value="{{ old('licenca', $licencas == false ?'':$licencas->chave) }}">
                    @error('licenca')
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
                <button id="btngeraltarefa" type="submit" class="btn btn-primary border border-white shadow mr-0"><i
                        class="fa fa-save"></i> Salvar</button>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection
