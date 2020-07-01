@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')
<style>
.notice {
padding: 15px;
background-color: #fafafa;
border-left: 6px solid #7f7f84;
margin-bottom: 10px;
-webkit-box-shadow: 0 5px 8px -6px rgba(0,0,0,.2);
-moz-box-shadow: 0 5px 8px -6px rgba(0,0,0,.2);
box-shadow: 0 5px 8px -6px rgba(0,0,0,.2);
}
.notice-warning {
border-color: #FEAF20;
}
.notice-danger {
border-color: #d73814;
}
.notice-success {
border-color: #80D651;
}
</style>
<div class="row mb-2">

    <div class="col-sm-6">

        <h1 class="m-0 text-dark">
            Controle de Laudos
        </h1>
        <div class="spinner-border spinnerTbl text-primary" role="status">
            <span class="sr-only"></span>
          </div>
          <span class="spinnerTbl">Carregando Tabela Aguarde...</span>

    </div>

    <div class="col-sm-6">

        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/controle-laudos">Preparar e Ofertar</a> </li>
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


<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0">
                <ul class="nav nav-tabs d-flex justify-content-between" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item" id="custon-tabs-li-emDia">
                        <a class="nav-link" id="custom-tabs-one-emDia-tab" data-toggle="pill" href="#custom-tabs-one-emDia" role="tab" aria-controls="custom-tabs-one-emDia" aria-selected="true">
                            <h5>À Vencer</h5>
                        </a>
                    </li>

                    <li class="nav-item" id="custon-tabs-li-vencido">
                        <a class="nav-link" id="custom-tabs-one-vencido-tab" data-toggle="pill" href="#custom-tabs-one-vencido" role="tab" aria-controls="custom-tabs-one-vencido" aria-selected="false">
                            <h5>Vencido</h5>
                        </a>
                    </li>
                    
                    <li class="nav-item" id="custon-tabs-li-Reavaliacao">
                        <a class="nav-link" id="custom-tabs-one-Reavaliacao-tab" data-toggle="pill" href="#custom-tabs-one-Reavaliacao" role="tab" aria-controls="custom-tabs-one-Reavaliacao" aria-selected="false">
                            <h5>Reavaliação</h5>
                        </a>
                    </li>

                    <li class="nav-item" id="custon-tabs-li-emReavaliacao">
                        <a class="nav-link" id="custom-tabs-one-emReavaliacao-tab" data-toggle="pill" href="#custom-tabs-one-emReavaliacao" role="tab" aria-controls="custom-tabs-one-emReavaliacao" aria-selected="false">
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
                                    <strong>À vencer: </strong> Laudos que irão vencer em até 70 dias.
                                </div>

                                <thead>
                                    <tr>
                                        <th>Contrato</th>
                                        <th>Classificação</th>
                                        <th>Status</th>
                                        <th>Vencimento Laudo</th>
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
                            <table id="tblLaudoVencido" class="table table-bordered table-striped dataTable">
                                <div class="notice notice-danger">
                                    <strong>Vencido: </strong> Laudos vencidos que precisam ser demandados no <a href="http://siopi.caixa/siopi-web/" target="_blank">SIOPI</a>
                                </div>
                                <thead>
                                    <tr>
                                        <th>Contrato</th>
                                        <th>Classificação</th>
                                        <th>Status</th>
                                        <th>Vencimento Laudo</th>
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
                            <table id="tblReavaliacao" class="table table table-bordered table-striped dataTable">
                                <div class="notice notice-success">
                                    <strong>Reavaliação: </strong> Laudo já solicitado
                                </div>
                                  <thead>
                                    <tr>
                                        <th>Contrato</th>
                                        <th>Classificação</th>
                                        <th>Status</th>
                                        <th>Vencimento Laudo</th>
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

            <div class="tab-pane fade" id="custom-tabs-one-emReavaliacao" role="tabpanel" aria-labelledby="custom-tabs-one-emReavaliacao-tab">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="tblEmPendencia" class="table table table-bordered table-striped dataTables">
                                <thead>
                                    <tr>
                                        <th>Contrato</th>
                                        <th>Classificação</th>
                                        <th>Status</th>
                                        <th>Vencimento Laudo</th>
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
@stop
