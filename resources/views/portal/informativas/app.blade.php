@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
           PROJETO APP MOBILIE
        </h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/sobre"> PROJETO APP MOBILE</a> </li>
        </ol>
    </div>
</div>


@stop


@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card card-default">

            <div class="card-header">
                <h3 class="card-title">Sobre o app</h3>
            </div> <!-- /.card-header -->
            
            <div class="card-body">

                <div class="row">
                    <div class="col-md-8">
                        <p class="text-justify">O projeto APP Mobile é um protótipo dentro do app Habitação Caixa.<br>
                          agora além de administrar seu financiamento, você também poderá localizar imóveis caixa para aquisição.
                          com o aplicativo será possível localizar imóveis caixa, guardar os imóveis favoritos, efetuar lances, simular financiamento
                          e tirar todas as dúvidas sobre aquisição de imóveis caixa.
                        </p>
                        <p class="text-justify">Clique em uma foto para ver como ficará no celular.</p>
                    </div>

                </div>
                <br>
                <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal"
                   data-image="{{ asset('/img/app_mobile/A1.jpg') }}"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="{{ asset('/img/app_mobile/1.jpg') }}"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal"
                   data-image="{{ asset('/img/app_mobile/A2.jpg') }}"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="{{ asset('/img/app_mobile/2.jpg') }}"
                         alt="Another alt text">
                </a>
            </div>

            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal"
                   data-image="{{ asset('/img/app_mobile/A3.jpg') }}"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="{{ asset('/img/app_mobile/3.jpg') }}"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal"
                   data-image="{{ asset('/img/app_mobile/A4.jpg') }}"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="{{ asset('/img/app_mobile/4.jpg') }}"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb pt-2">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal"
                   data-image="{{ asset('/img/app_mobile/A5.jpg') }}"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="{{ asset('/img/app_mobile/5.jpg') }}"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb pt-2">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal"
                   data-image="{{ asset('/img/app_mobile/A6.jpg') }}"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="{{ asset('/img/app_mobile/6.jpg') }}"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb pt-2">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal"
                   data-image="{{ asset('/img/app_mobile/A7.jpg') }}"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="{{ asset('/img/app_mobile/7.jpg') }}"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb pt-2">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal"
                   data-image="{{ asset('/img/app_mobile/A8.jpg') }}"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="{{ asset('/img/app_mobile/8.jpg') }}"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb pt-2">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal"
                   data-image="{{ asset('/img/app_mobile/A9.jpg') }}"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="{{ asset('/img/app_mobile/9.jpg') }}"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb pt-2">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal"
                   data-image="{{ asset('/img/app_mobile/A10.jpg') }}"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="{{ asset('/img/app_mobile/10.jpg') }}"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb pt-2">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal"
                   data-image="{{ asset('/img/app_mobile/A11.jpg') }}"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="{{ asset('/img/app_mobile/11.jpg') }}"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb pt-2">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal"
                   data-image="{{ asset('/img/app_mobile/A12.jpg') }}"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="{{ asset('/img/app_mobile/12.jpg') }}"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb pt-2">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal"
                   data-image="{{ asset('/img/app_mobile/A13.jpg') }}"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="{{ asset('/img/app_mobile/13.jpg') }}"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb pt-2">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal"
                   data-image="{{ asset('/img/app_mobile/A14.jpg') }}"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="{{ asset('/img/app_mobile/14.jpg') }}"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb pt-2">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal"
                   data-image="{{ asset('/img/app_mobile/A15.jpg') }}"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="{{ asset('/img/app_mobile/15.jpg') }}"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb pt-2">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal"
                   data-image="{{ asset('/img/app_mobile/A16.jpg') }}"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="{{ asset('/img/app_mobile/16.jpg') }}"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb pt-2">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal"
                   data-image="{{ asset('/img/app_mobile/A17.jpg') }}"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="{{ asset('/img/app_mobile/17.jpg') }}"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb pt-2">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal"
                   data-image="{{ asset('/img/app_mobile/A18.jpg') }}"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="{{ asset('/img/app_mobile/18.jpg') }}"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb pt-2">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal"
                   data-image="{{ asset('/img/app_mobile/A19.jpg') }}"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="{{ asset('/img/app_mobile/19.jpg') }}"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb pt-2">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal"
                   data-image="{{ asset('/img/app_mobile/A20.jpg') }}"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="{{ asset('/img/app_mobile/20.jpg') }}"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb pt-2">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal"
                   data-image="{{ asset('/img/app_mobile/A21.jpg') }}"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="{{ asset('/img/app_mobile/21.jpg') }}"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb pt-2">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal"
                   data-image="{{ asset('/img/app_mobile/A22.jpg') }}"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="{{ asset('/img/app_mobile/22.jpg') }}"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb pt-2">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal"
                   data-image="{{ asset('/img/app_mobile/A23.jpg') }}"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="{{ asset('/img/app_mobile/23.jpg') }}"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb pt-2">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal"
                   data-image="{{ asset('/img/app_mobile/A25.jpg') }}"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="{{ asset('/img/app_mobile/25.jpg') }}"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb pt-2">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal"
                   data-image="{{ asset('/img/app_mobile/A26.jpg') }}"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="{{ asset('/img/app_mobile/26.jpg') }}"
                         alt="Another alt text">
                </a>
            </div>            
        </div>


        <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="image-gallery-title"></h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="image-gallery-image" class="img-responsive col-md-12" src="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                        </button>

                        <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
</div>
</div>
                

            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->


</div> <!-- /.row -->


@stop

@section('footer')

@stop

@section('css')
    
@stop


@section('js')
<script src="{{ asset('js/portal/galeria-app-mobile.js') }}"></script>

@stop