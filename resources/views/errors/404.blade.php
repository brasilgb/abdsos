@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="card w-50 shadow-sm p-4 text-center border border-gray-500"
                style="margin-top: 20%;">
                <div class="row">
                    <div class="col">
                        <div class="" style="margin-top: 10%">
                            OPS, a página que está procurando não foi encontrada!
                        </div>
                        <div class="text-center" style="margin-top: 10%">
                            <a class="btn btn-primary rounded border border-white shadow" href="{{ route('home') }}">
                                Prosseguir <i class="fa fa-angle-double-right"></i></a></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
