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
    <div class="col">
        <h1 class="m-0 text-dark">Operacional Leilões - CHB <p class="d-inline" id="numeroBem"></p></h1>
    </div>
    <div class="col">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/"> Principal</a> </li>
            <li class="breadcrumb-item"> <i class="fa fa-map-signs"></i> <a href="/estoque-imoveis/leiloes-negativos"> Controle de Leilões Negativos</a> </li>
            <li class="breadcrumb-item active"><i class="fa fa-map-signs"></i> Operacional Leilões</li>
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
    <link rel="stylesheet" href="{{ asset('/css/tooltip.css') }}">
@stop


@section('js')
    <script>
        var numeroContrato = '{{ $contratoFormatado }}';
    </script>

    <script src="{{ asset('js/global/formata_progress_bar.js') }}"></script>
    <script src="{{ asset('js/global/formata_tabela_historico.js') }}"></script>
    <script src="{{ asset('js/global/formata_tabela_mensagens_enviadas.js') }}"></script>
    <script src="{{ asset('js/global/formata_lista_distrato.js') }}"></script>
    <script src="{{ asset('js/global/formata_tabela_despesas_distrato.js') }}"></script>
    <script src="{{ asset('js/global/formata_data.js') }}"></script>   <!--Função global que formata a data para valor humano br.-->
    <script src="{{ asset('js/portal/imoveis/consulta-bem-imovel.js') }}"></script>
    <script src="{{ asset('js/portal/imoveis/leiloes/operacional-leiloes.js') }}"></script>
    <script src="{{ asset('js/portal/imoveis/leiloes/lista-despachante.js') }}"></script>
    <script src="{{ asset('js/portal/imoveis/leiloes/lista-leiloeiro.js') }}"></script>
@stop