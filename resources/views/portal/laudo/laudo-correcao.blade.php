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
            <li class="breadcrumb-item active"> <a href="/controle-laudos">Preparar e Ofertar</a> </li>
            <li class="breadcrumb-item active"><a href="/controle-laudos">Controle de Laudos</a></li>
            <li class="breadcrumb-item active"> Correção de Laudos</li>
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
        <a type="button" href="controle-baixa" class="btn btn-outline-success">Baixar</a>
    </div>
  </div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-default">

            <div class="card-header">
                <h3 class="card-title">Correção de Laudos</h3>
            </div> <!-- /.card-header -->
            
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="tblCorrecao" class="table table-bordered table-striped dataTable">
                            <div class="notice notice-warning">
                                <strong>Cobrança: </strong> Laudos ainda não finalizados no SIOPI ou com pedido de correção
                            </div><br>
                            <div class="spinner-border spinnerTbl text-primary" role="status">
                                <span class="sr-only"></span>
                              </div>
                              <span class="spinnerTbl">Carregando Tabela Aguarde...</span>
                            <thead>
                                <tr>
                                    <th>Contrato</th>
                                    <th>qtd dias solicitação</th>
                                    <th>O.S</th>
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

              
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->
</div> <!-- /.row -->




@stop

@section('footer')


@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')
<script src="{{ asset('js/portal/laudo/laudo-correcao.js') }}"></script>

@stop
