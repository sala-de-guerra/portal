@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


@if (session('tituloMensagem'))
<div id="fadeOut" class="card text-white bg-{{ session('corMensagem') }}">
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
    <div class="col">
        <h1 class="m-0 text-dark">
            Gestão Atende
        </h1>
    </div>

    <div class="col">
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i><a href="/gerencial/gestao-equipes">Atende</a></li>
            <li class="breadcrumb-item active"> Gestão Atende</li>
        </ol>
    </div>
</div><br>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0">
                <ul class="nav nav-tabs d-flex justify-content-between" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item" id="custon-tabs-li-hoje">
                        <a class="nav-link" id="custom-tabs-one-hoje-tab" data-toggle="pill" href="#custom-tabs-one-hoje" role="tab" aria-controls="custom-tabs-one-hoje" aria-selected="true">
                            <h5>Hoje</h5>
                        </a>
                    </li>

                    <li class="nav-item" id="custon-tabs-li-amanha">
                        <a class="nav-link" id="custom-tabs-one-amanha-tab" data-toggle="pill" href="#custom-tabs-one-amanha" role="tab" aria-controls="custom-tabs-one-amanha" aria-selected="false">
                            <h5>Amanhã</h5>
                        </a>
                    </li>
                    
                    <li class="nav-item" id="custon-tabs-li-doisDias">
                        <a class="nav-link" id="custom-tabs-one-doisDias-tab" data-toggle="pill" href="#custom-tabs-one-doisDias" role="tab" aria-controls="custom-tabs-one-doisDias" aria-selected="false">
                            <h5>2 dias</h5>
                        </a>
                    </li>

                    <li class="nav-item" id="custon-tabs-li-tresDias">
                        <a class="nav-link" id="custom-tabs-one-tresDias-tab" data-toggle="pill" href="#custom-tabs-one-tresDias" role="tab" aria-controls="custom-tabs-one-tresDias" aria-selected="false">
                            <h5>3 Dias +</h5>
                        </a>
                    </li>

                    <li class="nav-item" id="custon-tabs-li-vencidas">
                        <a class="nav-link" id="custom-tabs-one-vencidas-tab" data-toggle="pill" href="#custom-tabs-one-vencidas" role="tab" aria-controls="custom-tabs-one-vencidas" aria-selected="false">
                            <h5>Vencidas</h5>
                        </a>
                    </li>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">

            <div class="tab-pane fade show active" id="custom-tabs-one-hoje" role="tabpanel" aria-labelledby="custom-tabs-one-hoje-tab">

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="tblAtendeHoje" class="table table-bordered table-striped dataTable">
                                <thead>
                                    <tr>
                                        <th>Contrato</th>
                                        <th>Equipe</th>
                                        <th>Vencimento</th>
                                        <th>Atividade</th>
                                        <th>Assunto</th>
                                        <th>Responsavel</th>
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

            <div class="tab-pane fade" id="custom-tabs-one-amanha" role="tabpanel" aria-labelledby="custom-tabs-one-amanha-tab">
                        
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="tblAtendeAmanha" class="table table-bordered table-striped dataTable">
                                <thead>
                                    <tr>
                                        <th>Contrato</th>
                                        <th>Equipe</th>
                                        <th>Vencimento</th>
                                        <th>Atividade</th>
                                        <th>Assunto</th>
                                        <th>Responsavel</th>
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

            <div class="tab-pane fade" id="custom-tabs-one-doisDias" role="tabpanel" aria-labelledby="custom-tabs-one-doisDias-tab">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="tblAtendeDoisDias" class="table table-bordered table-striped dataTable">
                                  <thead>
                                    <tr>
                                        <th>Contrato</th>
                                        <th>Equipe</th>
                                        <th>Vencimento</th>
                                        <th>Atividade</th>
                                        <th>Assunto</th>
                                        <th>Responsavel</th>
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

            <div class="tab-pane fade" id="custom-tabs-one-tresDias" role="tabpanel" aria-labelledby="custom-tabs-one-tresDias-tab">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="tblAtendetresDias" class="table table-bordered table-striped dataTable">
                                <thead>
                                    <tr>
                                        <th>Contrato</th>
                                        <th>Equipe</th>
                                        <th>Vencimento</th>
                                        <th>Atividade</th>
                                        <th>Assunto</th>
                                        <th>Responsavel</th>
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

            <div class="tab-pane fade" id="custom-tabs-one-vencidas" role="tabpanel" aria-labelledby="custom-tabs-one-vencidas-tab">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="tblAtendevencidas" class="table table-bordered table-striped dataTable">
                                  <thead>
                                    <tr>
                                        <th>Contrato</th>
                                        <th>Equipe</th>
                                        <th>Vencimento</th>
                                        <th>Atividade</th>
                                        <th>Assunto</th>
                                        <th>Responsavel</th>
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


@section('content')


@section('footer')


@stop

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')
<script src="{{ asset('js/global/formata_data.js') }}"></script>
<script src="{{ asset('js/global/formata-datable-dataVencimento.js') }}"></script>
<script src="{{ asset('js/portal/atende/gestao-atende.js') }}"></script>
<script src="{{ asset('js/global/formata-data-datable.js') }}"></script>


@stop
