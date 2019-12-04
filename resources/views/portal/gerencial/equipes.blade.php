@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Alteração de Equipes
        </h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/"> Alteração de Equipes</a> </li>
        </ol>
    </div>
</div>


@stop


@section('content')



<div class="row">
    <!-- <form> -->

        <div class="col-md-3">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        Célula Administrar PAR / ADJ
                        <br>
                        Gestor: Joao Marcel Quintiliano
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <ul id="sortable1" class="connectedSortable list-unstyled" id="listaCelulaAdministrar">
                        <li>
                            <div class="callout callout-danger row padding0">
                                <div class="col-md-3">
                                    <img src="http://www.sr2576.sp.caixa/2017/foto.asp?matricula=c142765" class="img-circle elevation-2 user-image-resize-50px" alt="User Image" onerror="this.src='{{ asset('/img/question-mark.png') }}';">
                                </div>
                                <div class="col-md-9">
                                    <h5 class="card-title">Carlos Alberto Dalcin David</h5>
                                    <p class="card-text"><small class="text-muted">Assist. Júnior</small></p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->

        <div class="col-md-3">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        Célula Gerência
                        <br>
                        Gestor: Marcelo Barboza Fernandes
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <ul id="sortable2" class="connectedSortable list-unstyled" id="listaCelulaGerencia">
                        <li>
                            <div class="callout callout-info">
                                <h5>I am a danger callout!</h5>
                                <p>
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->

        <div class="col-md-3">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        Célula Preparar e Ofertar
                        <br>
                        Gestor: Fernanda Pereira Mendonça
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <ul id="sortable3" class="connectedSortable list-unstyled" id="listaCelulaPreparar">
                        <li>
                            <div class="callout callout-warning">
                                <h5>I am a danger callout!</h5>
                                <p>
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->

        <div class="col-md-3">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        Célula Contratação e Inovação
                        <br>
                        Gestor: Vladimir Pereira de Lemos
                    </h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <ul id="sortable4" class="connectedSortable list-unstyled" id="listaCelulaContratacao">
                        <li>
                            <div class="callout callout-success">
                                <h5>I am a danger callout!</h5>
                                <p>
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    
    
    <!-- </form> -->
    <!-- /.form -->
</div> 
<!-- /.row -->

@section('footer')


@stop

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/jquery-ui/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')
@section('js')
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.js') }}"></script>

    <script>
        
        $( function() {
            $( "#sortable1, #sortable2, #sortable3, #sortable4" ).sortable({
            connectWith: ".connectedSortable"
            }).disableSelection();
        } );
    </script>

@stop
@stop