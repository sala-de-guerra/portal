<?php
    $Date = date('d/m/Y');
?>
@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')
<style>
@media (min-width: 768px) {
  .modal-xl {
    width: 90%;
   max-width:1200px;
  }
}
</style>
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
    <div class="col-sm-4">
        <h1 class="m-0 text-dark">
            Gestão Siouv
        </h1>
    </div>
    <div class="col-sm-4">
       
        <h4>{{$numeroCE}}</h4>
      
       
    </div>
    <div class="col-sm-4">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <a href="/"> Principal</a> </li>
            <li class="breadcrumb-item active"> Gestão Siouv</a> </li>
        </ol>
    </div>
</div>


@stop


@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Atender.Caixa</h3>
    </div> <!-- /.card-header -->
    <div class="notice notice-warning">
        <strong>Gestão SIOUV: </strong> clique em &nbsp<i class="fas fa-headset"></i>&nbsp para gerar um atende
        ou clique em &nbsp<i class="fas fa-edit"></i>&nbsp para responder/baixar modelos
    </div>
    <div class="card-body">
        <div class="spinner-border spinnerTbl text-primary" role="status">
            <span class="sr-only"></span>
        </div>
            <span class="spinnerTbl">Carregando Tabela Aguarde...</span>
        <table id="tblSiouv" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Tipo</th>
                <th>Nº Siouv</th>
                <th>Contrato</th>
                <th>Responsável</th>
                <th>Prazo</th>
                <th>Processo</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
        <h3 class="card-title">Tratados</h3>
    </div> <!-- /.card-header -->
    <div class="notice notice-warning">
        <strong>Tratados: </strong> SIOUV que foi distribuido Atende ou respondido em <?php echo $Date ?>
    </div>
    <div class="card-body">
        <div class="spinner-border spinnerTbl text-primary" role="status">
            <span class="sr-only"></span>
        </div>
            <span class="spinnerTbl">Carregando Tabela Aguarde...</span>
        <table id="tblSiouvTratados" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Tipo</th>
                <th>Nº Siouv</th>
                <th>Status</th>
                <th>Contrato</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
    </div>
  </div>
@stop

@section('footer')

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')
<script src="{{ asset('js/portal/siouv/populaSiouv.js') }}"></script>
@stop
