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
        <h3 class="m-0 text-dark">
            Seja bem vindo!
        </h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/"> Portal Gilie</a> </li>
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
                    <a href="#tipoVariavel">
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

@stop

@section('footer')


@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')


@stop