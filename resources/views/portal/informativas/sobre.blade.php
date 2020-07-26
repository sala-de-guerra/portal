@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Sobre a GILIE
        </h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <a href="/sobre"> Sobre a GILIE</a> </li>
        </ol>
    </div>
</div>


@stop


@section('content')





@stop

@section('footer')

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')

<script src="{{ asset('js/portal/informativas/sobre.js') }}"></script>


@stop