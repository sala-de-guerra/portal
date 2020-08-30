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
.card-topo{
    height: 28%;
}
</style>

<div class="row mb-4">
    <div class="col-sm-2">
        <h1 class="m-0 text-dark">
            Equipe
        </h1>
    </div>

    <div class="col-sm-4">
        <select id="selectGILIE" class="form-control">
            <option value="" selected>Selecione a GILIE</option>
            <option value="7244">GILIE/BH</option>
            <option value="7242">GILIE/BU</option>
            <option value="7243">GILIE/BE</option>
            <option value="7109">GILIE/BR</option>
            <option value="7247">GILIE/CT</option>
            <option value="7248">GILIE/FO</option>
            <option value="7249">GILIE/GO</option>
            <option value="7251">GILIE/PO</option>
            <option value="7254">GILIE/RJ</option>
            <option value="7253">GILIE/RE</option>
            <option value="7255">GILIE/SA</option>
            <option value="7257">GILIE/SP</option>
        </select>
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

<div class="card">
    <div class="card-body">
        <span id="nomeGestor">Selecione a GILIE no botão acima e clique na equipe para expandir</span>
    </div>
  </div>

    <div id='mostraSP'>
        <div id="divPrincipalSP" >

        </div>
    </div>
    <div id='mostraPO'>
        <div id="divPrincipalPO" >

        </div>
    </div>
    <div id='mostraBH'>
        <div id="divPrincipalBH" >

        </div>
    </div>
    <div id='mostraBU'>
        <div id="divPrincipalBU" >

        </div>
    </div>
    <div id='mostraBE'>
        <div id="divPrincipalBE" >

        </div>
    </div>
    <div id='mostraBR'>
        <div id="divPrincipalBR" >

        </div>
    </div>
    <div id='mostraCT'>
        <div id="divPrincipalCT" >

        </div>
    </div>
    <div id='mostraFO'>
        <div id="divPrincipalFO" >

        </div>
    </div>
    <div id='mostraGO'>
        <div id="divPrincipalGO" >

        </div>
    </div>
    <div id='mostraRJ'>
        <div id="divPrincipalRJ" >

        </div>
    </div>
    <div id='mostraRE'>
        <div id="divPrincipalRE" >

        </div>
    </div>
    <div id='mostraSA'>
        <div id="divPrincipalSA" >

        </div>
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
