@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Sobre a GILIE/SP
        </h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/sobre"> Sobre a GILIE/SP</a> </li>
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
                                <i class="fas fa-bullhorn"></i>
                                Carousel 1
                            </h3>
                        </div>
                        <div class="card-body">
                            <img src="{{ asset('/img/CAROUSEL_FLOW_WIDE.jpg') }}" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-bullhorn"></i>
                                Carousel 2
                            </h3>
                        </div>
                        <div class="card-body">
                            <img src="{{ asset('/img/CAROUSEL_DEAL_WIDE.jpg') }}" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-bullhorn"></i>
                                Carousel 3
                            </h3>
                        </div>
                        <div class="card-body">
                            <img src="{{ asset('/img/CAROUSEL_CHARTS_WIDE.jpg') }}" class="d-block w-100" alt="...">
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
                <i class="fas fa-bullhorn"></i>
                Callouts
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="callout callout-danger">
                <h5>I am a danger callout!</h5>

                <p>There is a problem that we need to fix. A wonderful serenity has taken possession of my entire
                    soul,
                    like these sweet mornings of spring which I enjoy with my whole heart.</p>
                </div>
                <div class="callout callout-info">
                <h5>I am an info callout!</h5>

                <p>Follow the steps to continue to payment.</p>
                </div>
                <div class="callout callout-warning">
                <h5>I am a warning callout!</h5>

                <p>This is a yellow callout.</p>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->

</div>

<br>

<div class="row">
    <div class="col-md-6">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">
                <i class="fas fa-bullhorn"></i>
                Callouts
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="callout callout-danger">
                <h5>I am a danger callout!</h5>

                <p>There is a problem that we need to fix. A wonderful serenity has taken possession of my entire
                    soul,
                    like these sweet mornings of spring which I enjoy with my whole heart.</p>
                </div>
                <div class="callout callout-info">
                <h5>I am an info callout!</h5>

                <p>Follow the steps to continue to payment.</p>
                </div>
                <div class="callout callout-warning">
                <h5>I am a warning callout!</h5>

                <p>This is a yellow callout.</p>
                </div>
                <div class="callout callout-success">
                <h5>I am a success callout!</h5>

                <p>This is a green callout.</p>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-6">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">
                <i class="fas fa-bullhorn"></i>
                Callouts
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="callout callout-danger">
                <h5>I am a danger callout!</h5>

                <p>There is a problem that we need to fix. A wonderful serenity has taken possession of my entire
                    soul,
                    like these sweet mornings of spring which I enjoy with my whole heart.</p>
                </div>
                <div class="callout callout-info">
                <h5>I am an info callout!</h5>

                <p>Follow the steps to continue to payment.</p>
                </div>
                <div class="callout callout-warning">
                <h5>I am a warning callout!</h5>

                <p>This is a yellow callout.</p>
                </div>
                <div class="callout callout-success">
                <h5>I am a success callout!</h5>

                <p>This is a green callout.</p>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->


</div> <!-- /.row -->

@section('footer')

<b>Copyright © 2009 - 2019 - GILIE/SP - Gerência de Alienação de Bens Móveis e Imóveis</b>

@stop

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')

@stop