@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Acompanhar Contratação</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"> 
                    <i class="fa fa-map-signs"></i> 
                    <a href="/"> Home</a> 
                    / 
                    <a href="/estoque-imoveis/acompanha-contratacao"> Acompanhar Contratação</a>
                </li>
            </ol>
        </div>
    </div>
@stop

@section('content')

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

<div class="row">
    <div class="col-md-12">
        <div class="card collapsed-card card-primary">
            <div class="card-header cursor-pointer" data-card-widget="collapse">
                <h3 class="card-title">Monitora Pagamento Sinal (PP15)</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 table-responsive p-0">
                                        <table id="tblContratosSemPagamentoSinal" class="table table-bordered table-striped hover dataTable">
                                            <thead>
                                                <tr>
                                                    <th>CHB</th>
                                                    <th>Valor</th>
                                                    <th>Data de vencimento (PP15)</th>
                                                    <th>Status</th>
                                                    <th>Classificação do imóvel</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div> 
                        </div> 
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card collapsed-card card-primary">
            <div class="card-header cursor-pointer" data-card-widget="collapse">
                <h3 class="card-title">Acompanhar Contratação</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="tblContratosContratacaoUltimoSessentaDias" class="table table-bordered table-striped dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>CHB</th>
                                    <th>Classificação Imóvel</th>
                                    <th>Tipo de Venda</th>
                                    <th>Nome Proponente</th>
                                    <th>CPF/CNPJ Proponente</th>
                                    <th>Data Proposta</th>
                                    <th>Quantidade Dias Após Proposta</th>
                                    <th>Card Agrupamento Conformidade</th>
                                    <th>Status Conformidade</th>
                                    <th>Status Análise</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop

@section('js')
    <script src="{{ asset('js/global/formata_data.js') }}"></script>
    <script src="{{ asset('js/global/formata_datatable.js') }}"></script>
    <script src="{{ asset('js/portal/imoveis/contratacao/acompanha-contratacao.js') }}"></script>
@stop