@extends('layouts.app')

@section('content')

    <div class="card bg-light shadow-sm">
        <div class="card-header pb-0 border-bottom border-white">
            <div class="row">
                <div class="col">
                    <h4 class="text-left text-body mt-1"><i class="fa fa-toolbox" aria-hidden="true"></i> Ferramentas</h4>
                </div>
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Ferramentas</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card-header clearfix">
            <div class="card-title">
                <i class="fas fa-tags" aria-hidden="true"></i> Etiquetas
            </div>
        </div>
        <div class="card-body">
            @include("flash::message")
            <form action="{{ route('ferramentas.gretiquetas') }}" method="POST" target="_blank">
                @method('POST')
                @csrf
                <div class="alert alert-info">
                    <p><i class="fa fa-hand-point-right"></i> As etiquetas impressas referem-se ao padrão A4048 - A4 6x16.
                        <a href="http://textolivre.org/aplicacoes/linhadotexto/modulos/ajuda/etiquetas.php?op=abrir&cod_etiqueta=12"
                            target="_blank" title="Etiquetas">Veja sobre etiquetas</a>.
                    </p>
                    <p><i class="fa fa-lightbulb"></i> Você poderá imprimir valores e quantidades diferentes, por padrão
                        será gerada página com 96 etiquetas a partir da próxima ordem de serviço.</p>
                </div>
                @if (!$empresa)
                    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>
                        Preencha os dados da empresa para poder gerar etiquetas. <a
                            href="{{ route('empresas.index') }}">Preencher dados da empresa</a>
                    </div>
                @endif
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label" for="">
                        Gerar etiquetas:</label>
                    <div class="col-sm-7">
                        <div class="input-group">
                            <span class="input-group-text">N° de páginas</span>
                            <input id="numpaginas" type="text" name="numpaginas" class="numpaginas form-control col-xs-4"
                                min="1" value="1">

                            <span class="input-group-text">Ordens de</span>
                            <input id="inicial" type="text" name="valinicial"
                                class="valinicial form-control rounded-0 col-xs-4" value="@if ($etiquetainicial) {{ $etiquetainicial->id_ordem + 1 }} @else 1 @endif">

                            <span class="input-group-text bg-gray" style="border-radius: 0!important;">Até</span>
                            <input id="final" type="text" name="valfinal" class="valfinal form-control  rounded-0 col-xs-4"
                                value="@if ($etiquetainicial) {{ $etiquetainicial->id_ordem + 96 }} @else 96 @endif">

                            <div class="input-group-append">
                                <button @if (!$empresa) disabled @endif
                                    class="geraetiqueta rounded-right btn btn-primary" type="submit"><i
                                        class="fa fa-tag"></i>
                                    Gerar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <form class="border-top" action="{{ route('configuracoes.gerabackup') }}" method="GET">
                @csrf
                @method('GET')
                <div class="form-group row mt-4">
                    <label class="col-sm-3 col-form-label" for="">
                        Gerar backup</label>
                    <div class="col-sm-7">
                        <button @if($backups->count() == 0) disabled @endif class="btn btn-primary" name="usuario"><i class="fa fa-download"></i> Gerar</button>
                    </div>
                </div>
            </form>

            <form class="border-top" action="{{ route('configuracoes.restaurabackup') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="form-row align-items-center">
                    <div class="col-12">
                        <div class="form-group row mt-4">
                            <label class="col-3 col-form-label" for="">
                                Restaurar Backup:</label>
                            <div class="col-7">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="backup" id="validatedCustomFile" required>
                                    <label class="custom-file-label" for="validatedCustomFile">Selecione o arquivo sql...</label>
                                </div>

                            </div>
                            <div class="col-2">
                                <button id="" class="btn btn-primary" name="usuario"><i class="fa fa-upload"></i> Restaurar</button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </div>
    <script>
        $(function() {
            $("#numpaginas").keyup(function(e) {
                e.preventDefault();
                $(this).val(this.value.replace(/\D/g, ''));
                var paginas = parseInt($(this).val());
                var inicial = parseInt($("#inicial").val());
                var final = (inicial + (paginas * 96)) - 1;
                $("#final").val(final);
            });
        });


    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

</script>
@endsection
