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
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Indicadores Atende
        </h1>
    </div>

    <div class="col">
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i><a href="/indicadores/rotinas-automaticas">Indicadores</a></li>
            <li class="breadcrumb-item active"> Indicadores Atende</li>
        </ol>
    </div>
</div><br>

@stop

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card card-default">
      <div class="card-body">
        <section class="content">
        <div class="container-fluid">
          <div class="spinner-border spinnerTblDistribuido text-primary" role="status">
              <span class="sr-only"></span>
          </div>
              <span class="spinnerTblDistribuido">Carregando Dados Aguarde...</span>
          <div class="row">
            <div class="col-lg-3 col-6">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3 id="totalNovos"> </h3>
                    <h5><strong>Novos</strong></h5>
                    <p>Cadastros de Atendes realizados hoje</p>
                </div>
                <div class="icon">
                  <i class="far fa-bookmark"></i>
                </div>
                <a data-toggle="collapse" aria-expanded="false" aria-controls="listaNovos" href="#listaNovos" class="small-box-footer" role="button" id="listagemNovos"onclick="mudaInfoNovos()">Mais informações</a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3 id="totalTratados"> </h3>
                  <h5><strong>Tratados</strong></h5>
                    <p>Atendes tratados hoje</p>
                </div>
                <div class="icon">
                  <i class="fas fa-check"></i>
                </div>
                <a data-toggle="collapse" aria-expanded="false" aria-controls="listaTratados" href="#listaTratados" class="small-box-footer" role="button" id="listagemTratados" onclick="mudaInfoTratados()">Mais informações</a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3 id="totalPendentes"> </h3>
                  <h5><strong>Pendentes</strong></h5>
                    <p>Quantidade de Atendes pendentes</p>
                </div>
                <div class="icon">
                  <i class="fas fa-exclamation"></i>
                </div>
                <a data-toggle="collapse" aria-expanded="false" aria-controls="listaPendentes" href="#listaPendentes" class="small-box-footer" role="button" id="listagemPendentes" onclick="mudaInfoPendentes()">Mais informações</a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3 id="totalVencidos"> </h3>
                  <h5><strong>Vencidos</strong></h5>
                    <p>Quantidade de Atendes vencidos</p>
                </div>
                <div class="icon">
                  <i class="fas fa-times"></i>
                </div>
                <a data-toggle="collapse" aria-expanded="false" aria-controls="listaVencidos" href="#listaVencidos" class="small-box-footer" role="button" id="listagemVencidos" onclick="mudaInfoVencidos()">Mais informações</a>
              </div>
            </div>
          </div>
        </div>
        <div class="collapse" id="listaNovos">
          <div class="card card-body card-outline card-info">
            <h2 class="card-title"><b>Novos</b></h2>&nbsp
            <table id="tblIndicadorAtendeNovos" class="table table-bordered table-striped">
              <thead>                   
                <tr>
                  <th style="text-align:center;">Usuário</th>
                  <th style="text-align:center;">Nº Atende</th>
                  <th style="text-align:center;">Contrato</th> 
                </tr>
              </thead>
              
              <tbody>

              </tbody>
            </table>
          </div>
        </div>

        <div class="collapse" id="listaTratados">
          <div class="card card-body card-outline card-success"> 
            <h2 class="card-title"><b>Tratados</b></h2>&nbsp
              <table id="tblIndicadorAtendeTratados" class="table table-bordered table-striped">
                <thead>                   
                  <tr>
                    <th style="text-align:center;">Usuário</th>
                    <th style="text-align:center;">Nº Atende</th>
                    <th style="text-align:center;">Contrato</th> 
                  </tr>
                </thead>
                
                <tbody>

                </tbody>
              </table>
          </div>
        </div>

        <div class="collapse" id="listaPendentes">
          <div class="card card-body card-outline card-warning">
            <h2 class="card-title"><b>Pendentes</b></h2>&nbsp
              <table id="tblIndicadorAtendePendentes" class="table table-bordered table-striped">
                <thead>                   
                  <tr>
                    <th style="text-align:center;">Usuário</th>
                    <th style="text-align:center;">Nº Atende</th>
                    <th style="text-align:center;">Contrato</th> 
                  </tr>
                </thead>
                
                <tbody>

                </tbody>

            </table>
          </div>
        </div>

        <div class="collapse" id="listaVencidos">
          <div class="card card-body card-outline card-danger">
            <h2 class="card-title"><b>Vencidos</b></h2>&nbsp
              <table id="tblIndicadorAtendeVencidos" class="table table-bordered table-striped">
                <thead>                   
                  <tr>
                    <th style="text-align:center;">Usuário</th>
                    <th style="text-align:center;">Nº Atende</th>
                    <th style="text-align:center;">Contrato</th> 
                    <th style="text-align:center;">Dias Vencidos</th>
                  </tr>
                </thead>
                
                <tbody>

                </tbody>

            </table>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="card" id="Grafico">
              <div class="card-body">
                <div class="container">
                  <div class="row">
                    <div class="col-xs align-middle">
                      <img class="card-img-left" id="imagemGrafico" src="/img/analytics.png">
                    </div>
                    <div class="col">
                      <h5 class="card-title"><strong>Gráfico dos Indicadores Atende Geral - Gilie/SP</strong></h5>
                        <p class="card-text">Gráfico com dados dos últimos 30 dias.</p>
                      <div class="float-right" id="botaoGrafico">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="card" id="Tabela">
              <div class="card-body">
                <div class="container">
                  <div class="row">
                    <div class="col-xs">
                      <img class="card-img-left" id="imagemTabela" src="/img/tabela.png">
                    </div>
                    <div class="col">
                      <h5 class="card-title"><strong>Tabela Geral de Indicadores por Usuário</strong></h5>
                      <p class="card-text">Indicador diário de Atende por Usuário</p>
                      <div class="float-right" id="botaoTabela">
                      </div>
                    </div> 
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div id="graficoGeral">
          <div class="spinner-border spinnerGrafico text-primary" role="status">
              <span class="sr-only"></span>
          </div>
              <span class="spinnerGrafico">Carregando Dados Aguarde...</span>
          <div class="card">
            <div class="card-header">
              <button type="button" class="close" id="fechaGrafico" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
              <h5 class="card-title"><b>Quantidade de Demandas Atende dos Últimos 30 Dias - Gilie/SP</b></h5>
            </div>
            <div class="card-body">
              <canvas id="myChart" width="400" height="100"> Gráfico</canvas>
            </div>
          </div>
        </div>


        <div id="listaGeral">
          <div class="card">
            <div class="card-header">
              <button type="button" class="close" id="fechaLista" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
              <h5 class="card-title"><b>Indicador Diário por Usuário - Gilie/SP</b></h5>
            </div>
            <div class="card-body">
              <table id="tblIndicadorAtende" class="table table-bordered table-striped">
                <thead>                   
                  <tr>
                    <th style="text-align:center;">Usuário</th>
                    <th style="text-align:center;">Novos</th>
                    <th style="text-align:center;">Tratados</th> 
                    <th style="text-align:center;">Pendentes</th> 
                    <th style="text-align:center;">Vencidos</th>
                    <th >Indicadores: &nbsp
                      <span class="badge bg-info">Novos</span>
                      <span class="badge bg-success">Tratados</span>
                      <span class="badge bg-warning">Pendentes</span>  
                      <span class="badge bg-danger">Vencidos</span>                   
                    </th>
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





<!--
<div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>

                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
-->



@stop

@section('footer')

@stop

 
@section('css')
<link rel="stylesheet" href="{{ asset('/css/main.css') }}">

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.css">

<style>

.trocaFundo {
  background-color: #CDCDCD;

}

</style>

@stop


@section('js')
<script src="{{ asset('js/portal/atende/insere_grafico_atende.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="{{ asset('js/portal/atende/atende_indicadores.js') }}"></script>






@stop
