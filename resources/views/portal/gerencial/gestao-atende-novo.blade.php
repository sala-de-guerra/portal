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
            <li class="breadcrumb-item active"> <a href="/gerencial/gestao-equipes">Atende</a></li>
            <li class="breadcrumb-item active"> Gestão Atende</li>
        </ol>
    </div>
</div><br>

<div class="card">
    <div class="card-body">
        <a type="button" href="/gerencial/gestao-atende-porVencimento" class="btn btn-primary">Visão por dia de vencimento</a>  
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0">
                <ul class="nav nav-tabs d-flex justify-content-between" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item" id="custon-tabs-li-hoje">
                        <a class="nav-link" id="custom-tabs-one-hoje-tab" data-toggle="pill" href="#custom-tabs-one-hoje" role="tab" aria-controls="custom-tabs-one-hoje" aria-selected="true">
                            <h5>Aberto</h5>
                        </a>
                    </li>

                    
                    <li class="nav-item" id="custon-tabs-li-finalizado">
                        <a class="nav-link"  id="custom-tabs-one-finalizado-tab" data-toggle="pill" href="#custom-tabs-one-finalizado" role="tab" aria-controls="custom-tabs-one-finalizado" aria-selected="false">
                            <h5>Finalizado</h5>
                        </a>
                    </li>

                    <li class="nav-item" id="custon-tabs-li-hidden">
                        <a class="nav-link" style="display: none;" id="custom-tabs-one-hidden-tab" data-toggle="pill" href="#custom-tabs-one-hidden" role="tab" aria-controls="custom-tabs-one-hidden" aria-selected="false">
                            <h5>3 Dias +</h5>
                        </a>
                    </li>

                    <li class="nav-item" id="custon-tabs-li-none">
                        <a class="nav-link" style="display: none;" id="custom-tabs-one-none-tab" data-toggle="pill" href="#custom-tabs-one-none" role="tab" aria-controls="custom-tabs-one-none" aria-selected="false">
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
                            <table id="tblAtendeAberto" class="table table-bordered table-striped dataTable">
                                <thead>
                                    <tr>
                                        <th>Atende</th>
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


            <div class="tab-pane fade" id="custom-tabs-one-finalizado" role="tabpanel" aria-labelledby="custom-tabs-one-finalizado-tab">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="tblAtendeFinalizado" class="table table-bordered table-striped dataTable">
                                  <thead>
                                    <tr>
                                        <th>Atende</th>
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
<script src="{{ asset('js/portal/gerencial/gerenciamento-atende.js') }}"></script>

@stop
