@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Principal
        </h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/"> Principal</a> </li>
        </ol>
    </div>
</div>


@stop


@section('content')


<div class="row">
    <div class="col-md-6 d-flex justify-content-center">
        <div class="card card-default">
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-lg fa-users "></i>
                                Sobre a GILIE
                            </h3>
                        </div>
                        <div class="card-body">
                            <a href="/sobre">
                                <img src="{{ asset('/img/equipe.png') }}" class="d-block" width="600px" height="300px" alt="...">
                            </a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-lg fa-question-circle "></i>
                                Dúvidas Frequentes
                            </h3>
                        </div>
                        <div class="card-body">
                            <a href="/faq">
                                <img src="{{ asset('/img/faq.png') }}" class="d-block" width="600px" height="300px" alt="...">
                            </a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-lg fa-directions "></i>
                                Orientações
                            </h3>
                        </div>
                        <div class="card-body">
                            <a href="/orientacoes">
                                <img src="{{ asset('/img/orientacoes.png') }}" class="d-block" width="600px" height="300px" alt="...">
                            </a>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">
                    Vitrine
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <p class="text-justify">
                    Fundada em 01 de outubro de 1998, a Gerência de Alienar Bens Móveis e Imóveis de São Paulo é responsável pela guarda 
                    e desfazimento de bens retomados, oriundos principalmente de contratos descumpridos, como imóveis e jóias.
                </p>
                <p class="text-justify">
                    Sob a gestão do gerente de filial Marcelo Barboza Fernandes e dos coordenadores Fernanda Pereira Mendonça, 
                    João Marcel Quintiliano e Vladimir Pereira de Lemos, a filial conta com um quadro atual de aproximadamente 60 
                    funcionários, divididos entre suas áreas de atuação.
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->

</div>

<br>

<div class="row">
    <div class="col-md-12">
        <div class="card card-default">

            <div class="card-header">
                <h3 class="card-title">Área de atuação</h3>
            </div> <!-- /.card-header -->
            
            <div class="card-body">

                <div class="row">
                    <div class="col-md-8">
                        <p class="text-justify">A área de atuação da GILIE/SP acompanha a distribuição das cidades conforme a SR de vinculação. 
                        Estão vinculadas a GILIE/SP todas as SR da capital (Sé, Santana, Santo Amaro, Penha, Paulista) e ABC, 
                        Osasco e Baixada Santista. As demais cidades do estado de São Paulo estão vinculadas a GILIE/BU.</p>
                    </div>

                    <div class="col-md-4">
                        <img src="{{ asset('/img/area_atuacao_giliesp.jpg') }}" class="img-fluid" alt="Área de atuação da GILIE SP.">
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-md-12">
                        <table id="tbl_area_atuacao" class="table table-bordered table-striped dataTable">
                            <thead>
                                <tr>
                                    <th>GILIE</th>
                                    <th>MUNICÍPIO</th>
                                    <th>PV</th>
                                    <th>SR</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->


</div> <!-- /.row -->

@section('footer')


@stop

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')

    <script src="{{ asset('js/portal/index.js') }}"></script>

@stop