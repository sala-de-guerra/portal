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

    </div>
    <!-- /.col -->

</div>
<!-- /.row -->

<br>


@section('footer')

<b>Copyright © 2009 - 2019 - GILIE/SP - Gerência de Alienação de Bens Móveis e Imóveis</b>

@stop

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
        
@stop


@section('js')

@stop