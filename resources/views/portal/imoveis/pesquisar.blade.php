@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Pesquisar Bem Imóvel
        </h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/consultar"> Pesquisar Bem Imóvel</a> </li>
        </ol>
    </div>
</div>


@stop


@section('content')


<div class="row">

    <div class="col-md-12">
        <div class="card card-default">

            <div class="card-header">
                <h3 class="card-title">
                    Pesquisa por CHB ou Endereço
                </h3>
            </div><!-- /.card-header -->

            <div class="card-body">
                <form class="form-inline tt-responsive" id="formPesquisa">
                    <div class="input-group">
                        <input class="form-control form-control-navbar typeahead tt-responsive" type="text" name="" placeholder="Pesquise um imóvel pelo CHB, endereço, dados do proponente ou do ex-mutuário.">
                        <div class="input-group-append">
                            <button class="btn" type="submit"> <i class="fas fa-search"></i> </button>
                        </div>
                    </div>
                </form> 
            </div><!-- /.card-body -->

        </div><!-- /.card -->
    </div><!-- /.col -->
</div> <!-- /.row -->



@stop

@section('footer')

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')

<script src="{{ asset('js/portal/sobre.js') }}"></script>


@stop