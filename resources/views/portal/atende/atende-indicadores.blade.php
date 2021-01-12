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
          <div class="row">
            <div class="col-lg-3 col-6">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3 id="totalNovos"> </h3>
                    <p>Novos</p>
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
                  <p>Tratados</p>
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
                  <p>Pendentes</p>
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
                  <p>Vencidos</p>
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
            <h2 class="card-title"><b>Novos</b></h2><br>
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
            <h2 class="card-title"><b>Tratados</b></h2><br>
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
            <h2 class="card-title"><b>Pendentes</b></h2><br>
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
            <h2 class="card-title"><b>Vencidos</b></h2><br>
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
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title"><b>Quantidade de Atendes Cadastrados e Respondidos pela Gilie/SP</b></h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>

                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <p class="text-center">
                      Meses de x a x de 2021
                    </p>

                    <div class="chart">
                      <!-- Sales Chart Canvas -->
                      <canvas id="myChart"></canvas>
                    </div>
                    <!-- /.chart-responsive -->
                  
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->




        <div class="col-md-12">
        <table id="tblIndicadorAtende" class="table table-bordered table-striped">
          <thead>                   
            <tr>
              <th>Usuário</th>
              <th>Novos</th>
              <th>Tratados</th> 
              <th>Pendentes</th> 
              <th>Vencidos</th>
              <th>Indicadores</th>
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


@stop

@section('footer')

@stop

 
@section('css')
<link rel="stylesheet" href="{{ asset('/css/main.css') }}">

@stop


@section('js')
    <script src="{{ asset('js/portal/atende/atende_indicadores.js') }}"></script>
    
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script> -->

@stop
