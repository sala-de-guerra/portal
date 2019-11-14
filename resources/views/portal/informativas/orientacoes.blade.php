@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Orientações
        </h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/orientacoes"> Orientações</a> </li>
        </ol>
    </div>
</div>


@stop


@section('content')


<div class="row">

    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Orientações Sobre Venda Online</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
            </div>
            <!-- /.card-body -->

        </div>
        <!--/.direct-chat -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
                
    

<div class="row">

    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Orientações Sobre Venda Online</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <embed src="../pdf/ApresentacaoAgencias.pdf" width="100%" height="650px"/>
            </div>
            <!-- /.card-body -->

        </div>
        <!--/.direct-chat -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<br>


@section('footer')


@stop

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
        
@stop


@section('js')

@stop