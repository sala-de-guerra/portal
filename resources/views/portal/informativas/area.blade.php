@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Área de Atuação
        </h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/"> Principal</a> </li>
            <li class="breadcrumb-item active"> Área de Atuação</a> </li>
        </ol>
    </div>
</div>


@stop


@section('content')


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
                        <p class="text-justify">Pesquise uma agência ou município na tabela abaixo para saber qual é a GILIE de vinculação.</p>
                    </div>

                    <div class="col-md-4">
                        <img src="{{ asset('/img/area_atuacao_giliesp.jpg') }}" class="img-fluid" alt="Mapa do estado de São Paulo com a área de atuação da GILIE SP grifada.">
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


@stop

@section('footer')

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')

<script src="{{ asset('js/portal/informativas/sobre.js') }}"></script>


@stop
