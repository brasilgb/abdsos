@extends('layouts.app')

@section('content')
<div class="card bg-light shadow-sm">
    <div class="card-header">
        <h5><i class="fa fa-file-invoice"></i> Relatório financeiro</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped rounded-top">
                    <thead>
                        <tr class="table-secondary">
                            <th colspan="4" class="text-center">Resumo de pagamentos</th>
                        </tr>
                        <tr class="table-active">
                            <th>Pagamento aberto</th>
                            <th>Somente serviços</th>
                            <th>Somente peças</th>
                            <th>Pagamento total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-light">
                            <td><a href="{{ route('ordens.pagamento', ['pagamento' => 1]) }}"
                                    title="Pagamento aberto">{{ $ordens->where('pagamento', 1)->count() }}</a></td>
                            <td><a href="{{ route('ordens.pagamento', ['pagamento' => 2]) }}"
                                    title="Somente serviços">{{ $ordens->where('pagamento', 2)->count() }}</a></td>
                            <td><a href="{{ route('ordens.pagamento', ['pagamento' => 3]) }}"
                                    title="Somente peças">{{ $ordens->where('pagamento', 3)->count() }}</a></td>
                            <td><a href="{{ route('ordens.pagamento', ['pagamento' => 4]) }}"
                                    title="Pagamento total">{{ $ordens->where('pagamento', 4)->count() }}</a></td>
                        </tr>
                        <tr class="table-light">
                            <td> R${{ number_format($ordens->where('pagamento', 1)->sum->valtotal, 2, ",", ".") }} </td>
                            <td> R${{ number_format($ordens->where('pagamento', 2)->sum->valservico, 2, ",", ".") }} </td>
                            <td> R${{ number_format($ordens->where('pagamento', 3)->sum->valtotal-$ordens->where('pagamento', 3)->sum->valservico, 2, ",", ".") }} </td>
                            <td> R${{ number_format($ordens->where('pagamento', 4)->sum->valtotal, 2, ",", ".") }} </td>
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
