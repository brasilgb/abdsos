@extends('layouts.app')

@section('content')
<div class="card bg-light shadow-sm">
    <div class="card-header">
        <h5><i class="fa fa-file-invoice"></i> Relatório de peças</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped rounded-top">
                    <thead>
                        <tr class="table-secondary">
                            <th colspan="8" class="text-center">Resumo de peças</th>
                        </tr>
                        <tr class="table-active">
                            <th>Novas</th>
                            <th>Usadas</th>
                            <th>Remanufaturadas</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <tr class="table-light">
                            <td><a href="{{ route('pecas.situacao', ['situacao' => 1]) }}" title="Peças novas">{{ $pecas->where('situacao', 1)->count() }}</a></td>
                            <td><a href="{{ route('pecas.situacao', ['situacao' => 2]) }}" title="Peças usadas">{{ $pecas->where('situacao', 2)->count() }}</a></td>
                            <td><a href="{{ route('pecas.situacao', ['situacao' => 3]) }}" title="Peças remanufaturadas">{{ $pecas->where('situacao', 3)->count() }}</a></td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>

</script>

@endsection
