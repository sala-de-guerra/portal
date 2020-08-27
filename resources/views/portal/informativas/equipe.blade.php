@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')
<style>
    .bg-size{
        width: 100%;
    }
    p {
    margin: 0;
    padding: 0;
}
</style>

<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Equipe
        </h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <a href="/"> Principal</a> </li>
            <li class="breadcrumb-item active"> Equipe</a> </li>
        </ol>
    </div>
</div>


@stop


@section('content')
<div id="divPrincipal">

</div>

@stop

@section('footer')

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')
<script src="{{ asset('js/portal/informativas/equipe.js') }}"></script>

@stop
