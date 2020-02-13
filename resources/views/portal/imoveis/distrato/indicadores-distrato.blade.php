<style>@import url('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css');</style>

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
                        <div class="col-sm-12 table-responsive p-0">
                        <canvas id="myChart" height="80pt"></canvas>
                            <!-- <table id="tblIndicadoresDistrato" class="table table-bordered table-striped hover dataTable">
                                <thead>
                                    <tr>
                                        <th>Não Iniciadas</th>
                                        <th>Em tratamento GILIE</th>
                                        <th>Em tratamento Agência</th>
                                        <th>Pendente Jurir / EMGEA</th>
                                        <th>Concluídas</th>
                                        <th>Tempo Médio de Atendimento</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    
                                </tbody>
                                
                            </table> -->
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
@stop


@section('js')

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<Script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></Script>

<script>$('document').ready(function() {

$.ajax({
type: "GET",
url: '/estoque-imoveis/distrato/indicadores-distrato ',
dataType: "json",
success: function (data) {
   console.log(data.quantidadeDemandasNaoIniciadas)

   var nomearray = [];
   var quantidadearray = [];

   for (var i in data){

    nomearray.push(data[i]);
    quantidadearray.push(data[i])

   }
   grafico(nomearray, quantidadearray);
}
});
});</script>

<script> 
function grafico(nome, quantidade){
     var ctx = document.getElementById('myChart').getContext('2d');
   
   var chart = new Chart(ctx, {
   
    type: 'horizontalBar',

   
    data: {
        labels: ['Não Iniciadas', 'GILIE', 'Agência', 'JURIR/EMGEA'],
        datasets: [{
            backgroundColor: ['CornflowerBlue', 'CornflowerBlue', 'CornflowerBlue', 'CornflowerBlue'],
            borderColor: 'white',
            data: quantidade,
            label: 'Grafico'
          
        }]
    },

    // Configuration options go here
    options: {}
});
}
</script>

    <script src="{{ asset('js/global/formata_data.js') }}"></script>
    <script src="{{ asset('js/portal/distrato/indicadores-distrato.js') }}"></script>

@stop