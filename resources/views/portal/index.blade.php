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
                                <img src="{{ asset('/img/equipe.png') }}" class="d-block img-fluid" width="600px" height="300px" alt="...">
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
                                <img src="{{ asset('/img/faq.png') }}" class="d-block img-fluid" width="600px" height="300px" alt="...">
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
                                <img src="{{ asset('/img/orientacoes.png') }}" class="d-block img-fluid" width="600px" height="300px" alt="...">
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

    

</div> <!-- /.row -->

<br>

@stop

@section('footer')


@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')


@stop