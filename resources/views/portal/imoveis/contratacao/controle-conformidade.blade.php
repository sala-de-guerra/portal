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

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0">
                <ul class="nav nav-tabs d-flex justify-content-between" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item" id="custon-tabs-li-fluxoAgencia">
                        <a class="nav-link" id="custom-tabs-one-fluxoAgencia-tab" data-toggle="pill" href="#custom-tabs-one-fluxoAgencia" role="tab" aria-controls="custom-tabs-one-fluxoAgencia" aria-selected="true">
                            <h5>Fluxo Agência</h5>
                        </a>
                    </li>

                    <li class="nav-item" id="custon-tabs-li-fluxoCCA">
                        <a class="nav-link" id="custom-tabs-one-fluxoCCA-tab" data-toggle="pill" href="#custom-tabs-one-fluxoCCA" role="tab" aria-controls="custom-tabs-one-fluxoCCA" aria-selected="false">
                            <h5>Fluxo CCA</h5>
                        </a>
                    </li>
                    
                    <li class="nav-item" id="custon-tabs-li-agrupAgencia">
                        <a class="nav-link" id="custom-tabs-one-agrupAgencia-tab" data-toggle="pill" href="#custom-tabs-one-agrupAgencia" role="tab" aria-controls="custom-tabs-one-agrupAgencia" aria-selected="false">
                            <h5>Agrupamento Agência</h5>
                        </a>
                    </li>

                    <li class="nav-item" id="custon-tabs-li-semPagamento">
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
                                  <div style="background-color: #c9eff0; border-color: #c9eff0; color: #035f3f;" class="alert alert-info alert-dismissible fade show" role="alert">
                                    Lista de contratos para envio de documentos de conformidade para CIOPE/RE em &nbsp&nbsp<a href="http://retaguarda.caixa/digitalizar/#/" target="_blank" class="alert-link"> digitalizar.caixa</a>. 
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>                                    

                                <thead>
                                    <tr>
                                        <th>CHB</th>
                                        <th>Classificação</th>
                                        <th>Data Entrada</th>
                                        <th>Tipo de Proposta</th>
                                        <th>Status CIOPE</th>
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

            <div class="tab-pane fade" id="custom-tabs-one-fluxoCCA" role="tabpanel" aria-labelledby="custom-tabs-one-fluxoCCA-tab">
                        
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="tblConformidadeFluxoCca" class="table table-bordered table-striped dataTable">

                                  <div style="background-color: #c9eff0; border-color: #c9eff0; color: #035f3f;" class="alert alert-info alert-dismissible fade show" role="alert">
                                    Lista de contratos para acerto de laudo e isenção de taxa em <a href="http://siopi.caixa" target="_blank" class="alert-link"> siopi.caixa</a>. 
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>   

                                <thead>
                                    <tr>
                                        <th>CHB</th>
                                        <th>Classificação</th>
                                        <th>Data Entrada</th>
                                        <th>Tipo de Proposta</th>
                                        <th>Status CIOPE</th>
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

            <div class="tab-pane fade" id="custom-tabs-one-agrupAgencia" role="tabpanel" aria-labelledby="custom-tabs-one-agrupAgencia-tab">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="tblCardAgrupamentoAgencia" class="table table-bordered table-striped dataTable">
                                  <div style="background-color: #c9eff0; border-color: #c9eff0; color: #035f3f;" class="alert alert-info alert-dismissible fade show" role="alert">
                                    Lista de contratos conforme (rotina GILIE) aguardando finalização da agência.  
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  <thead>
                                    <tr>
                                        <th>CHB</th>
                                        <th>Classificação</th>
                                        <th>Data Entrada</th>
                                        <th>Tipo de Proposta</th>
                                        <th>Status CIOPE</th>
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

            <div class="tab-pane fade" id="custom-tabs-one-semPagamento" role="tabpanel" aria-labelledby="custom-tabs-one-semPagamento-tab">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="tblContratosSemPagamentoSinal" class="table table-bordered table-striped">

                                  <div style="background-color: #c9eff0; border-color: #c9eff0; color: #035f3f;" class="alert alert-info alert-dismissible fade show" role="alert">
                                    Lista de contratos aguardando pagamento da entrada pelo proponente. 
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>  
                                </div>
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
    <script src="{{ asset('js/global/formata-datable-dataVencimento.js') }}"></script>
    <script src="{{ asset('js/global/formata-data-datable.js') }}"></script>
@stop