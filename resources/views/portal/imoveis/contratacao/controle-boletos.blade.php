@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Controle de Boletos</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/estoque-imoveis/acompanha-contratacao"> Contratação</a> </li>
                <li class="breadcrumb-item active">Controle de Boletos</li>
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

{{-- <div class="row">
    <div class="col-md-12">
        <div class="card card-primary">

            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="notice notice-success">
                            <strong>Controle de Boletos: </strong> 
                        </div><br>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0">
                <ul class="nav nav-tabs d-flex justify-content-between" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item" id="custon-tabs-li-Avista">
                        <a class="nav-link" id="custom-tabs-one-Avista-tab" data-toggle="pill" href="#custom-tabs-one-Avista" role="tab" aria-controls="custom-tabs-one-Avista" aria-selected="true">
                            <h5>À vista</h5>
                        </a>
                    </li>

                    <li class="nav-item" id="custon-tabs-li-Financiado">
                        <a class="nav-link" id="custom-tabs-one-Financiado-tab" data-toggle="pill" href="#custom-tabs-one-Financiado" role="tab" aria-controls="custom-tabs-one-Financiado" aria-selected="false">
                            <h5>Financiado</h5>
                        </a>
                    </li>


                    <li class="nav-item" id="custon-tabs-li-novos">
                        <a class="nav-link" id="custom-tabs-one-novos-tab" data-toggle="pill" href="#custom-tabs-one-novos" role="tab" aria-controls="custom-tabs-one-novos" aria-selected="false">
                            <h5>Novos</h5>
                        </a>
                    </li>

                    <li class="nav-item" id="">
                        <a class="nav-link" style="display: none;" id="" data-toggle="pill" href="" role="tab" aria-controls="" aria-selected="false">
                            <h5>Exemplo</h5>
                        </a>
                    </li>
                    
            </div>

            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">

            <div class="tab-pane fade show active" id="custom-tabs-one-Avista" role="tabpanel" aria-labelledby="custom-tabs-one-Avista-tab">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="notice notice-success">
                                <strong>Controle de Boletos: </strong>Contratações à vista. <a href="/contratacao/controle-boletos/baixar-planilha-boletos"><button style="float: right" type="button" class="btn btn-success">Baixar a Planilha de Boletos &nbsp &nbsp<i class="fas fa-file-excel"></i></button></a>
                            </div><br>
                            <div id="displayAberto">
                                <div class="col">
                                    <table id="tblControleDeBoletosAvista" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Contrato</th>
                                            <th>Proponente</th>
                                            <th>Vencimento</th>
                                            <th>Status</th>
                                            <th>Valor Pagamento</th>
                                            <th>Data Pagamento</th>
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
          

        <div class="tab-pane fade" id="custom-tabs-one-Financiado" role="tabpanel" aria-labelledby="custom-tabs-one-Financiado-tab">
                
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="notice notice-success"> 
                            <strong>Controle de Boletos: </strong> Contratações com financiamento.<a href="/contratacao/controle-boletos/baixar-planilha-boletos"><button style="float: right" type="button" class="btn btn-success">Baixar a Planilha de Boletos &nbsp &nbsp<i class="fas fa-file-excel"></i></button></a>
                        </div><br>
                        <div class="col">
                            <table id="tblControleDeBoletosFinanciado" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Contrato</th>
                                    <th>Proponente</th>
                                    <th>Vencimento</th>
                                    <th>Status</th>
                                    <th>Valor Pagamento</th>
                                    <th>Data Pagamento</th>
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


                <div class="tab-pane fade" id="custom-tabs-one-novos" role="tabpanel" aria-labelledby="custom-tabs-one-novos-tab">
                        
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="notice notice-success"> 
                                    <strong>Controle de Boletos: </strong> Pagos no último dia útil anterior.
                                </div><br>
                                <div class="col">
                                  <table id="tblControleDeBoletosNovos" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Contrato</th>
                                            <th>Proponente</th>
                                            <th>Valor Pagamento</th>
                                            <th>Tipo</th>
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
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop

@section('js')
<script src="{{ asset('js/global/formata-data-datable.js') }}"></script>
<script src="{{ asset('js/portal/imoveis/contratacao/controle-boletos.js') }}"></script>
@stop