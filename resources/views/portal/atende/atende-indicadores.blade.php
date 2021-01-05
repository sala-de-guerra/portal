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
                  <h3>150</h3>
                    <p>Novos</p>
                </div>
                <div class="icon">
                  <i class="far fa-bookmark"></i>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>53<sup style="font-size: 20px">%</sup></h3>
                  <p>Tratados</p>
                </div>
                <div class="icon">
                  <i class="fas fa-check"></i>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>44</h3>
                  <p>Pendentes</p>
                </div>
                <div class="icon">
                  <i class="fas fa-exclamation"></i>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>65</h3>
                  <p>Vencidos</p>
                </div>
                <div class="icon">
                  <i class="fas fa-times"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <section class="content">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <table id="tblIndicadorAtende" class="table table-bordered table-striped">
                <thead>                   
                  <tr>
                    <th>Usuário</th>
                    <th>Novos</th>
                    <th>Tratados</th> 
                    <th>Pendentes</th> 
                    <th>Vencidos</th>
                    <th> </th>
                  </tr>
                </thead>
                
                <tboby>

                </tbody>

              </table>
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
    <script src="{{ asset('js/portal/atende/atende_indicadores.js') }}"></script>

@stop
