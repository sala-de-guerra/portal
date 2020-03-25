@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col">
        <h1 class="m-0 text-dark">
            Controle Despachantes
        </h1>
    </div>

    <div class="col">
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"> <i class="fa fa-map-signs"></i> Fornecedores</li>
            <li class="breadcrumb-item active"><a href="/fornecedores/controle-despachantes"> Controle Despachantes</a> </li>
        </ol>
    </div>
</div>

@stop 


@section('content')



@section('footer')


@stop

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')
    
@stop
