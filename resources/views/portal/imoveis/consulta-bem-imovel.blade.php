@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Consultar Bem Imóvel
        </h1>
        <!-- <div>
            <input class="typeahead" type="text" placeholder="States of USA">
        </div> -->
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"> <i class="fa fa-map-signs"></i> <a href="/pesquisar"> Pesquisar Bem Imóvel</a> </li>
            <li class="breadcrumb-item active"> <a href="/index"> Consultar Bem Imóvel</a> </li>
        </ol>
    </div>
</div>


@stop


@section('content')


@include('portal.imoveis.componentes.tabs-dados-imovel')


@section('footer')


@stop

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')
    <script>
        var numeroContrato = '{{ $numeroContrato }}';
    </script> 
    <!-- <script src="{{ asset('js/global/anima_input_file.js') }}"></script> -->
    <!-- <script src="{{ asset('plugins/numeral/numeral.min.js') }}"></script>
    <script src="{{ asset('plugins/numeral/locales/pt-br.min.js') }}"></script> -->
    <script src="{{ asset('plugins/moment/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('js/global/formata_data.js') }}"></script>   <!--Função global que formata a data para valor humano br.-->
    <!-- <script src="{{ asset('js/global/formata_tabela_documentos.js') }}"></script> -->
    <!-- <script src="{{ asset('js/global/formata_tabela_laudos.js') }}"></script> -->
    <script src="{{ asset('js/global/formata_progress_bar.js') }}"></script>
    <script src="{{ asset('js/global/formata_tabela_historico.js') }}"></script>
    <script src="{{ asset('js/global/formata_tabela_mensagens_enviadas.js') }}"></script>
    <script src="{{ asset('js/portal/consulta-bem-imovel.js') }}"></script>
@stop