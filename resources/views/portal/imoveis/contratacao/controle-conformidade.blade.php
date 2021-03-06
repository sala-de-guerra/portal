@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">

    <div class="col-sm-6">

        <h1 class="m-0 text-dark">
            Fila Única
        </h1>

    </div>

    <div class="col-sm-6">

        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/estoque-imoveis/conformidade-contratacao">Contratação</a> </li>
            <li class="breadcrumb-item active"> Fila Única</li>
        </ol>

    </div>


</div>

      

@stop


@section('content')

@if (session('tituloMensagem'))
    <div id="fadeOut" class="card text-white bg-{{ session('corMensagem') }} hidden" >
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
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0">
                <ul class="nav nav-tabs d-flex justify-content-between" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item nav-card" id="custon-tabs-li-fluxoAgencia">
                        <a class="nav-link active" id="custom-tabs-one-fluxoAgencia-tab" data-toggle="pill" href="#custom-tabs-one-fluxoAgencia" role="tab" aria-controls="custom-tabs-one-fluxoAgencia" aria-selected="true">
                            <h5>Fluxo Agência</h5>
                        </a>
                    </li>

                    <li class="nav-item nav-card" id="custon-tabs-li-fluxoCCA">
                        <a class="nav-link" id="custom-tabs-one-fluxoCCA-tab" data-toggle="pill" href="#custom-tabs-one-fluxoCCA" role="tab" aria-controls="custom-tabs-one-fluxoCCA" aria-selected="false">
                            <h5>Fluxo CCA</h5>
                        </a>
                    </li>
                    
                    <li class="nav-item nav-card" id="custon-tabs-li-agrupAgencia">
                        <a class="nav-link" id="custom-tabs-one-agrupAgencia-tab" data-toggle="pill" href="#custom-tabs-one-agrupAgencia" role="tab" aria-controls="custom-tabs-one-agrupAgencia" aria-selected="false">
                            <h5>Agrupamento Agência</h5>
                        </a>
                    </li>

                    <li class="nav-item nav-card" id="custon-tabs-li-semPagamento">
                        <a class="nav-link" id="custom-tabs-one-semPagamento-tab" data-toggle="pill" href="#custom-tabs-one-semPagamento" role="tab" aria-controls="custom-tabs-one-semPagamento" aria-selected="false">
                            <h5>Aguardando Pagamento</h5>
                        </a>
                    </li>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">

            <div class="tab-pane fade show active" id="custom-tabs-one-fluxoAgencia" role="tabpanel" aria-labelledby="custom-tabs-one-fluxoAgencia-tab">

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="tblConformidadeFluxoAgencia" class="table table-bordered table-striped dataTable">
                                <div class="notice notice-success">
                                    <strong>Fluxo Agência: </strong> Lista de contratos para envio de documentos de conformidade para CIOPE/RE em <a href="http://retaguarda.caixa/digitalizar/#/" target="_blank" class="alert-link">digitalizar.caixa</a>.<br>
                                    *Antes de efetuar o tratamento, leia a cartilha <b>FILA ÚNICA</b> -> <a href="/download/Cartilha_filaUnica.pdf" class="alert-link"> Clique aqui para baixar</a>
                                </div><br>

                                <thead>
                                    <tr>
                                        <th>CHB</th>
                                        <th>Classificação</th>
                                        <th>Data Entrada</th>
                                        <th>Tipo de Proposta</th>
                                        <th>Status CIOPE</th>
                                        <th>Ações</th>
                                        <th>Último Tratamento</th>
                                        <th>Vencimento</th>
                                    </tr>
                                </thead>
                                <tbody>
      
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="custom-tabs-one-fluxoCCA" role="tabpanel" aria-labelledby="custom-tabs-one-fluxoCCA-tab">
                        
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="tblConformidadeFluxoCca" class="table table-bordered table-striped dataTable">
                                <div class="notice notice-success">
                                    <strong>Fluxo CCA: </strong> Lista de contratos para acerto de laudo e isenção de taxa em <a href="http://siopi.caixa" target="_blank" class="alert-link"> siopi.caixa</a>.<br>
                                    *Antes de efetuar o tratamento, leia a cartilha <b>FILA ÚNICA</b> -> <a href="/download/Cartilha_filaUnica.pdf" class="alert-link"> Clique aqui para baixar</a>
                                </div><br> 

                                <thead>
                                    <tr>
                                        <th>CHB</th>
                                        <th>Classificação</th>
                                        <th>Data Entrada</th>
                                        <th>Tipo de Proposta</th>
                                        <th>Status CIOPE</th>
                                        <th>Ações</th>
                                        <th>Último Tratamento</th>
                                        <th>Vencimento</th>
                                    </tr>
                                </thead>
                                <tbody>
    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="custom-tabs-one-agrupAgencia" role="tabpanel" aria-labelledby="custom-tabs-one-agrupAgencia-tab">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="tblCardAgrupamentoAgencia" class="table table-bordered table-striped dataTable">
                                <div class="notice notice-success">
                                    <strong>Agrupamento Agência: </strong>  Lista de contratos conforme (rotina GILIE) aguardando finalização da agência.  <br>
                                    *Antes de efetuar o tratamento, leia a cartilha <b>FILA ÚNICA</b> -> <a href="/download/Cartilha_filaUnica.pdf" class="alert-link"> Clique aqui para baixar</a>
                                </div><br> 
                                  <thead>
                                    <tr>
                                        <th>CHB</th>
                                        <th>Classificação</th>
                                        <th>Data Entrada</th>
                                        <th>Tipo de Proposta</th>
                                        <th>Status CIOPE</th>
                                        <th>Ações</th>
                                        <th>Último Tratamento</th>
                                        <th>Vencimento</th>
                                    </tr>
                                </thead>
                                <tbody>
    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="custom-tabs-one-semPagamento" role="tabpanel" aria-labelledby="custom-tabs-one-semPagamento-tab">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="tblContratosSemPagamentoSinal" class="table table-bordered table-striped">
                                <div class="notice notice-success">
                                    <strong>Aguardando Pagamento: </strong>   Lista de contratos aguardando pagamento da entrada pelo proponente. <br>
                                    *Antes de efetuar o tratamento, leia a cartilha <b>FILA ÚNICA</b> -> <a href="/download/Cartilha_filaUnica.pdf" class="alert-link"> Clique aqui para baixar</a>
                                </div><br>  
                                <div class="spinner-border spinnerTbl text-primary" role="status">
                                    <span class="sr-only"></span>
                                  </div>
                                  <span class="spinnerTbl">Carregando Tabela Aguarde...</span>
                                <thead>
                                    <tr>
                                        <th>CHB</th>
                                        <th>Valor</th>
                                        <th>vencimento(PP15)</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                        <th>Último Tratamento</th>
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

@stop


@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')
    <script src="{{ asset('js/global/formata_data.js') }}"></script>
    <script src="{{ asset('js/portal/imoveis/contratacao/controle-conformidade.js') }}"></script>
    <script src="{{ asset('js/portal/imoveis/contratacao/fila-unica-fluxo-agencia.js') }}"></script>
    <script src="{{ asset('js/global/formata-datable-dataVencimento.js') }}"></script>
    <script src="{{ asset('js/global/formata-data-datable.js') }}"></script>
    <script>
        setTimeout(function(){
        $('#fadeOut').fadeOut("slow");
        }, 4000);
    </script>
@stop