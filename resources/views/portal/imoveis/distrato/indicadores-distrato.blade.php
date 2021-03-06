@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')

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

    <div class="row mb-2">
        <div class="col">
            <h1 class="m-0 text-dark">
                Indicadores de Distratos
            </h1>
        </div>

        <div class="col">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/indicadores/distrato"> Indicadores de Distrato</a> </li>
            </ol>
        </div>
    </div>

   
@stop


@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 table-responsive p-0">

                             <table id="tblIndicadoresDistrato" class="table table-bordered table-striped hover dataTable">
                                <thead>
                                    <tr>
                                        {{-- <th style="background-color: #FF4500; color: white;">Não Iniciadas</th> --}}
                                        <th style="background-color: RoyalBlue; color: white;">Em tratamento GILIE</th>
                                        <th style="background-color: DeepSkyBlue; color: white;">Em tratamento Agência</th>
                                        <th style="background-color: seagreen; color: white;">Pendente Jurir / EMGEA</th>
                                        {{-- <th style="background-color: LimeGreen; color: white;">Concluídas</th>
                                        <th style="background-color: CornflowerBlue; color: white;">Tempo Médio de Atendimento</th> --}}
                                    </tr>
                                </thead>

                                <tbody>
                                    
                                </tbody>
                                
                            </table> 
                            <canvas id="myChart"></canvas>
                        </div> <!-- /.col-sm-12 -->










                    </div> <!-- /.row -->
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /.col -->
    </div> <!-- /.row -->
    
    
    
    
@stop

@section('footer')


@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.css">
@stop


@section('js')

<script src="{{ asset('js/global/insere_grafico.js') }}"></script>
<script src="{{ asset('js/portal/atende/atende_indicadores.js') }}"></script>
<Script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></Script>
<script src="{{ asset('js/global/formata_data.js') }}"></script>
<script src="{{ asset('js/portal/imoveis/distrato/indicadores-distrato.js') }}"></script>

@stop

