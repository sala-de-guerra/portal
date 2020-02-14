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
                    <!-- <li data-target="#carouselExampleCaptions" data-slide-to="2"></li> -->
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="card-header">
                            <h3 class="card-title">
                                Orientações
                            </h3>
                        </div>
                        <div class="card-body">
                            <a href="/orientacoes">
                                <img src="{{ asset('/img/orientacoes.png') }}" class="d-block img-fluid" width="600px" height="300px" alt="...">
                            </a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="card-header">
                            <h3 class="card-title">
                                Dúvidas Frequentes
                            </h3>
                        </div>
                        <div class="card-body">
                            <a href="/faq">
                                <img src="{{ asset('/img/faq.png') }}" class="d-block img-fluid" width="600px" height="300px" alt="...">
                            </a>
                        </div>
                    </div>
                    <!-- <div class="carousel-item">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-lg fa-users "></i>
                                Sobre a GILIE
                            </h3>
                        </div>
                        <div class="card-body">
                            <a href="/sobre">
                                <img src="{{ asset('/img/equipe.png') }}" class="d-block img-fluid" width="600px" height="300px" alt="...">
                            </a>
                        </div>
                    </div> -->
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

    <div class="col-md-6 d-flex justify-content-center">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">
                    Funcionalidades
                </h3>
            </div>
            <div class="card-body">
                <h4> 
                    <a href="#valorVariavel">
                        <i class="fa fa-search m-2"></i> Pesquisar Bem Imóvel
                    </a>
                    <br>
                    <small>Pesquise os imóveis administrados pelas filiais por número de contrato, endereço, nome e CPF do proponente ou ex-mutuário. </small>
                </h4>
                
                <hr class="pontilhado">

                <h4> 
                    <a href="/area">
                        <i class="fa fa-map-marked-alt m-2"></i> Pesquisar Área de Atuação
                    </a>
                    <br>
                    <small>Pesquise a região de atendimento das GILIE São Paulo e Bauru. </small>
                </h4>

                <hr class="pontilhado">

                <h4> 
                    <a href="/orientacoes">
                        <i class="fas fa-directions m-2"></i> Orientações
                    </a>
                    <br>
                    <small>Consulte cartilhas sobre venda de Imóveis Caixa e links úteis. </small>
                </h4>

            </div>
        </div>
    </div>

</div>

<!-- <div class="row">

    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">
                    Vitrine
                </h3>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-8">
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
                    
                    <div class="col-md-4">
                        <img src="{{ asset('/img/edificio_eluma.jpg') }}" class="d-block img-fluid" alt="Foto do Edifício Eluma, na Av. Paulista.">
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div> -->
@stop

@section('footer')


@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')


@stop