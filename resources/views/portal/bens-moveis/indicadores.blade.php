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
            Indicadores Doaçoes Bens Móveis
        </h1>
    </div>

    <div class="col">
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i><a href="/indicadores">Indicadores</a></li>
            <li class="breadcrumb-item active"> Indicadores Doações</li>
        </ol>
    </div>
</div><br>

@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card card-default">

            <div class="card-header">
                <h3 class="card-title">Gráfico de Doações de Bens Móveis</h3>
            </div> <!-- /.card-header -->
            
            <div class="card-body">
                <h3>Insira os dados para o Gráfico</h3>
                <form action="" id="formGrafico">
                    <div class="form-inline">
                        <div class="form-group">
                            <input type="number" id='cidade1' class="form-control" placeholder="Belém" required>
                        </div>&nbsp&nbsp
                        <div class="form-group">    
                            <input type="number" id='cidade2' class="form-control" placeholder="BH" required>   
                        </div>&nbsp&nbsp
                        <div class="form-group">
                            <input type="number" id='cidade3' class="form-control" placeholder="Brasilia" required>
                        </div>&nbsp&nbsp
                        <div class="form-group">    
                            <input type="number" id='cidade4' class="form-control" placeholder="Curitiba" required>   
                        </div>&nbsp&nbsp
                        <div class="form-group">
                            <input type="number" id='cidade5' class="form-control" placeholder="Fortaleza" required>
                        </div>&nbsp&nbsp
                        <div class="form-group">    
                            <input type="number" id='cidade6' class="form-control" placeholder="Goiania" required>   
                        </div><br><br>
                        <div class="form-group">
                            <input type="number" id='cidade7' class="form-control" placeholder="Manaus" required>
                        </div>&nbsp&nbsp
                        <div class="form-group">    
                            <input type="number" id='cidade8' class="form-control" placeholder="Porto Alegre" required>   
                        </div>&nbsp&nbsp
                        <div class="form-group">
                            <input type="number" id='cidade9' class="form-control" placeholder="Recife" required>
                        </div>&nbsp&nbsp
                        <div class="form-group">    
                            <input type="number" id='cidade10' class="form-control" placeholder="Rio de Janeiro" required>   
                        </div>&nbsp&nbsp
                        <div class="form-group">
                            <input type="number" id='cidade11' class="form-control" placeholder="Salvador" required>
                        </div>&nbsp&nbsp
                        <div class="form-group">    
                            <input type="number" id='cidade12' class="form-control" placeholder="São Paulo" required>   
                        </div> &nbsp&nbsp
                    </div><br>
                    <button type="submit" class="btn btn-success float-right mr-4">Montar Gráfico</button>
                </form>


                <canvas id="myChart"></canvas>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>

$('#formGrafico').submit( function(e) {
e.preventDefault();
dadosGrafico = []
dadosGrafico.push($('#cidade1').val())
dadosGrafico.push($('#cidade2').val())
dadosGrafico.push($('#cidade3').val())
dadosGrafico.push($('#cidade4').val())
dadosGrafico.push($('#cidade5').val())
dadosGrafico.push($('#cidade6').val())
dadosGrafico.push($('#cidade7').val())
dadosGrafico.push($('#cidade8').val())
dadosGrafico.push($('#cidade9').val())
dadosGrafico.push($('#cidade10').val())
dadosGrafico.push($('#cidade11').val())
dadosGrafico.push($('#cidade12').val())
console.log(dadosGrafico)

var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: ['BELÉM', 'BH', 'BRASÍLIA', 'CURITIBA', 'FORTALEZA', 'GOIANIA', 'MANAUS', 'PORTO ALEGRE', 'RECIFE', 'RIO DE JANEIRO', 'SALVADOR', 'SÃO PAULO' ],
            datasets: [{
                label: 'Total',
                data: dadosGrafico,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

})

 
</script>


@stop
