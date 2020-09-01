@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')

<div class="row mb-2">

    <div class="col-sm-6">

        <h1 class="m-0 text-dark">
            Controle de Laudos
        </h1>
    </div>

    <div class="col-sm-6">

        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><a href="/controle-laudos">Preparar e Ofertar</a> </li>
            <li class="breadcrumb-item active"> Controle de Laudos</li>
        </ol>

    </div>


</div>
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

@stop


@section('content')
<div class="card">
    <div class="card-body">
        <a type="button" href="controle-laudos/controle-baixa" class="btn btn-outline-success">Baixar</a>
        <a type="button" href="controle-laudos/controle-correcao" class="btn btn-outline-warning">Cobrança Engenharia</a>
    </div>
  </div>
  
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0">
                <ul class="nav nav-tabs d-flex justify-content-between" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item nav-card" id="custon-tabs-li-emDia">
                        <a class="nav-link active" id="custom-tabs-one-emDia-tab" data-toggle="pill" href="#custom-tabs-one-emDia" role="tab" aria-controls="custom-tabs-one-emDia" aria-selected="false">
                            <h5>À Vencer</h5>
                        </a>
                    </li>

                    <li class="nav-item nav-card" id="custon-tabs-li-vencido">
                        <a class="nav-link vencidotbl" id="custom-tabs-one-vencido-tab" data-toggle="pill" href="#custom-tabs-one-vencido" role="tab" aria-controls="custom-tabs-one-vencido" aria-selected="false">
                            <h5>Vencido</h5>
                        </a>
                    </li>
                    
                    <li class="nav-item nav-card" id="custon-tabs-li-Reavaliacao">
                        <a id="reavaliacaotbl" class="nav-link" id="custom-tabs-one-Reavaliacao-tab" data-toggle="pill" href="#custom-tabs-one-Reavaliacao" role="tab" aria-controls="custom-tabs-one-Reavaliacao" aria-selected="false">
                            <h5>Reavaliação</h5>
                        </a>
                    </li>

                    <li class="nav-item nav-card" id="custon-tabs-li-emReavaliacao">
                        <a id="pendenciatbl" class="nav-link" id="custom-tabs-one-emReavaliacao-tab" data-toggle="pill" href="#custom-tabs-one-emReavaliacao" role="tab" aria-controls="custom-tabs-one-emReavaliacao" aria-selected="false">
                            <h5>Pendência</h5>
                        </a>
                    </li>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">

            <div class="tab-pane fade show active" id="custom-tabs-one-emDia" role="tabpanel" aria-labelledby="custom-tabs-one-emDia-tab">

                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="tblLaudoEmDia" class="table table-bordered table-striped dataTable">
                                <div class="notice notice-warning">
                                    <strong>À vencer: </strong> Laudos que irão vencer em até 70 dias.<a href="controle-laudos/download-excel"><button style="float: right" type="button" class="btn btn-success pb-2">Baixar a Planilha Completa &nbsp &nbsp<i class="fas fa-file-excel"></i></button></a>
                                </div>
                                <div class="spinner-border spinnerTbl text-primary" role="status">
                                    <span class="sr-only"></span>
                                  </div>
                                  <span class="spinnerTbl">Carregando Tabela Aguarde...</span>

                                <thead>
                                    <tr>
                                        <th>Contrato</th>
                                        <th>Classificação</th>
                                        <th>Status</th>
                                        <th>Dias p/ vencimento</th>
                                        <th>O.S</th>
                                        <th>Status SIOPI</th>
                                        <th>Observação</th>
                                        <th></th>
               
                                    </tr>
                                </thead>
                                <tbody>
      
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="custom-tabs-one-vencido" role="tabpanel" aria-labelledby="custom-tabs-one-vencido-tab">
                        
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="tblLaudoVencido" class="table table-bordered table-striped dtableVencido">
                                <div class="notice notice-danger">
                                    <strong>Vencido: </strong> Laudos vencidos que precisam ser demandados no <a href="http://siopi.caixa/siopi-web/" target="_blank">SIOPI</a><a href="controle-laudos/download-excel"><button style="float: right" type="button" class="btn btn-success pb-2">Baixar a Planilha Completa &nbsp &nbsp<i class="fas fa-file-excel"></i></button></a>
                                </div>
                                <div class="spinner-border spinnerTblVencido text-primary" role="status">
                                    <span class="sr-only"></span>
                                  </div>
                                  <span class="spinnerTblVencido">Carregando Tabela Aguarde...</span>
                                <thead>
                                    <tr>
                                        <th>Contrato</th>
                                        <th>Classificação</th>
                                        <th>Status</th>
                                        <th>Dias p/ vencimento</th>
                                        <th>O.S</th>
                                        <th>Status SIOPI</th>
                                        <th>Observação</th>
                                        <th></th>
               
                                    </tr>
                                </thead>
                                <tbody>
    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="custom-tabs-one-Reavaliacao" role="tabpanel" aria-labelledby="custom-tabs-one-Reavaliacao-tab">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="tblReavaliacao" class="table table table-bordered table-striped table2 dtableReavaliacao">
                                <div class="notice notice-success">
                                    <strong>Reavaliação: </strong> Laudo já solicitado <a href="controle-laudos/download-excel"><button style="float: right" type="button" class="btn btn-success pb-2">Baixar a Planilha Completa &nbsp &nbsp<i class="fas fa-file-excel"></i></button></a>
                                </div>
                                <div class="spinner-border spinnerTblReavaliacao text-primary" role="status">
                                    <span class="sr-only"></span>
                                  </div>
                                  <span class="spinnerTblReavaliacao">Carregando Tabela Aguarde...</span>
                                  <thead>
                                    <tr>
                                        <th>Contrato</th>
                                        <th>Classificação</th>
                                        <th>Status</th>
                                        <th>qtd dias da solicitação</th>
                                        <th>O.S</th>
                                        <th>Status SIOPI</th>
                                        <th>Observação</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="custom-tabs-one-emReavaliacao" role="tabpanel" aria-labelledby="custom-tabs-one-emReavaliacao-tab">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="tblEmPendencia" class="table table table-bordered table-striped dtablePendencia">
                                <div class="notice notice-danger">
                                    <strong>Em Pendência: </strong> <a href="controle-laudos/download-excel"><button style="float: right" type="button" class="btn btn-success pb-2">Baixar a Planilha Completa &nbsp &nbsp<i class="fas fa-file-excel"></i></button></a>
                                </div>
                                <div class="spinner-border spinnerTblPendencia text-primary" role="status">
                                    <span class="sr-only"></span>
                                  </div>
                                  <span class="spinnerTblPendencia">Carregando Tabela Aguarde...</span> 
                                <thead>
                                    <tr>
                                        <th>Contrato</th>
                                        <th>Classificação</th>
                                        <th>Status</th>
                                        <th>Dias p/ vencimento</th>
                                        <th>O.S</th>
                                        <th>Status SIOPI</th>
                                        <th>Observação</th>
                                        <th></th>
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

@section('footer')


@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')
<script src="{{ asset('js/portal/laudo/controle-laudo.js') }}"></script>
<script src="{{ asset('js/portal/laudo/laudo-vencido.js') }}"></script>
<script src="{{ asset('js/portal/laudo/laudo-reavaliacao.js') }}"></script>
<script src="{{ asset('js/portal/laudo/laudo-em-pendencia.js') }}"></script>
<script>
setTimeout(function(){
    $('.bg-danger').fadeOut("slow");
    $('.bg-success').fadeOut("slow");
    }, 2000);    
</script>

@stop
