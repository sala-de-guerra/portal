@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Gestão de Equipes
        </h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"> <i class="fa fa-map-signs"></i> Gerencial</li>
            <li class="breadcrumb-item active"><a href="/"> Gestão de Equipes</a> </li>
        </ol>
    </div>
</div>


@stop


@section('content')

<div class="row">
    <div class="col-md-3">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">
                    Célula Administrar PAR / ADJ
                    <br>
                    Gestor: Joao Marcel Quintiliano
                </h3>
            </div>
            <div class="card-body">
                <ul id="listaCelulaAdministrar" class="connectedSortable list-unstyled">

                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">
                    Célula Gerência
                    <br>
                    Gestor: Marcelo Barboza Fernandes
                </h3>
            </div>
            <div class="card-body">
                <ul id="listaCelulaGerencia" class="connectedSortable list-unstyled">

                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">
                    Célula Preparar e Ofertar
                    <br>
                    Gestor: Fernanda Pereira Mendonça
                </h3>
            </div>
            <div class="card-body">
                <ul id="listaCelulaPreparar" class="connectedSortable list-unstyled">
                    
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">
                    Célula Contratação e Inovação
                    <br>
                    Gestor: Vladimir Pereira de Lemos
                </h3>

            </div>
            <div class="card-body">
                <ul id="listaCelulaContratacao" class="connectedSortable list-unstyled">
                    
                </ul>
            </div>
        </div>
    </div>

</div> 


@section('footer')


@stop

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/jquery-ui/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')
    <script src="{{ asset('js/portal/gerencial/equipes.js') }}"></script>
@stop
