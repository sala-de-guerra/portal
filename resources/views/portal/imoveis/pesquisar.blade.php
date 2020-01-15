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
                        <input class="form-control typeahead tt-responsive" type="text" name="" placeholder="Carregando..." disabled>
                        <div class="input-group-append">
                            <button class="btn btn-primary search-button" type="submit"> <i class="fas fa-search"></i> </button>
                            <img class="Typeahead-spinner" src="{{ asset('/img/spinner.gif') }}" style="display: none;">
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
    <script src="{{ asset('plugins/typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('plugins/typeahead/handlebars.js') }}"></script>
    <script src="{{ asset('js/global/configura_typeahead.js') }}"></script>
@stop
