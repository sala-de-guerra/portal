@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">

    <div class="col-sm-6">

        <h1 class="m-0 text-dark">
            Controle de Conformidade
        </h1>

    </div>

    <div class="col-sm-6">

        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/controle-conformidade"> Controle de Conformidade</a> </li>
        </ol>

    </div>


</div>

      

@stop


@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card collapsed-card card-primary">
            <div class="card-header cursor-pointer" data-card-widget="collapse">
                <h3 class="card-title">Conformidade Fluxo Agência</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="tblConformidadeFluxoAgencia" class="table table-bordered table-striped dataTable">
                            <thead>
                                <tr>
                                    <th>CHB</th>
                                    <th>Agência</th>
                                    <th>Tipo de Venda</th>
                                    <th>Tipo de Proposta</th>
                                    <th>Valor de Entrada</th>
                                    <th>Valor Recebido</th>
                                    <th>Status</th>
                                    <th>Proposta</th>
                                    <th>Data Entrada</th>
                                    <th>Copiar Link do Servidor</th>
                                    <th>Observações</th>
                                </tr>
                            </thead>
                            <tbody>
  
                            </tbody>
                        </table>
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
                <h3 class="card-title">Conformidade Fluxo CCA</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="tblConformidadeFluxoCca" class="table table-bordered table-striped dataTable">
                            <thead>
                                <tr>
                                    <th>CHB</th>
                                    <th>Agência</th>
                                    <th>Tipo de Venda</th>
                                    <th>Tipo de Proposta</th>
                                    <th>Recursos Próprios</th>
                                    <th>Total Recebido</th>
                                    <th>Status CIOPE</th>
                                    <th>Card Agrupamento</th>
                                    <th>Data Entrada</th>
                                    <th>Copiar Link do Servidor</th>
                                    <th>Observações</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
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
                <h3 class="card-title">Card Agrupamento Agência</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="tblCardAgrupamentoAgencia" class="table table-bordered table-striped dataTable">
                            <thead>
                                <tr>
                                    <th>CHB</th>
                                    <th>Agência</th>
                                    <th>Tipo de Venda</th>
                                    <th>Tipo de Proposta</th>
                                    <th>Recursos Próprios</th>
                                    <th>Total Recebido</th>
                                    <th>Status CIOPE</th>
                                    <th>Card Agrupamento</th>
                                    <th>Data Entrada</th>
                                    <th>Copiar Link do Servidor</th>
                                    <th>Observações</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
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
    <script src="{{ asset('js/portal/imoveis/contratacao/controle-conformidade.js') }}"></script>
@stop