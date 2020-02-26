@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Acompanhamento Contratação</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"> 
                    <i class="fa fa-map-signs"></i> 
                    <a href="/"> Home</a> 
                    / 
                    <a href="/estoque-imoveis/acompanha-contratacao"> Acompanhamento Contratação</a>
                </li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <table id="tblContratosContratacaoUltimoSessentaDias" class="table table-bordered table-striped dataTable">
                <thead>
                    <tr>
                        <th>CHB</th>
                        <th>Classificação Imóvel</th>
                        <th>Tipo de Venda</th>
                        <th>Nome Proponente</th>
                        <th>CPF/CNPJ Proponente</th>
                        <th>Data Proposta</th>
                        <th>Quantidade Dias Após Proposta</th>
                        <th>Card Agrupamento Conformidade</th>
                        <th>Status Conformidade</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>


@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop

@section('js')
    <script src="{{ asset('js/global/formata_data.js') }}"></script>
    <script src="{{ asset('js/global/formata_datatable.js') }}"></script>
    <script src="{{ asset('js/portal/contratacao/acompanha-contratacao.js') }}"></script>
@stop