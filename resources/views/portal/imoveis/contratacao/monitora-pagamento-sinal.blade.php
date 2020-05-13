@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')

@if (session('tituloMensagem'))
    <div class="card text-white bg-{{ session('corMensagem') }}">
        <div class="card-header">
            <div class="card-body">
                <h5 class="card-title"><strong>{{ session('tituloMensagem') }}</strong></h5>
                <br>
                <p class="card-text">{{ session('corpoMensagem') }}</p>
            </div>
        </div>
    </div>
@endif

<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Controle de pagamento de sinal
        </h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/estoque-imoveis/monitora-pagamento-sinal">Titulo da página</a> </li>
        </ol>
    </div>
</div>


@stop


@section('content')


@section('content')

    {{-- <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 table-responsive p-0">
                            <table id="tblContratosSemPagamentoSinal" class="table table-bordered table-striped hover dataTable">
                                <thead>
                                    <tr>
                                        <th>CHB</th>
                                        <th>Data da proposta</th>
                                        <th>Data de vencimento (PP15)</th>
                                        <th>Status</th>
                                        <th>Classificação do imóvel</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div> <!-- /.col-sm-12 -->
                    </div> <!-- /.row -->
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /.col -->
    </div> <!-- /.row --> --}}

@stop

@section('footer')

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')
    <script src="{{ asset('js/global/formata_datatable.js') }}"></script>
    <script src="{{ asset('js/global/formata_data.js') }}"></script>
    <script src="{{ asset('js/portal/imoveis/contratacao/monitora-pagamento-sinal.js') }}"></script>
@stop
