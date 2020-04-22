@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')
<style>
  

    
</style>

@section('content_header')


<div class="row mb-2">
    <div class="col-sm-4">
        <h1 class="m-0 text-dark">Imóvel CAIXA nº <p class="d-inline" id="numeroBem"></p></h1>
    </div>
    <div class="col-sm-4">
        @if (env('APP_ENV') != 'PRODUCAO')
            @if (in_array(session()->get('acessoEmpregadoPortal'), ['DESENVOLVEDOR'])) <!-- env('NOME_NOSSA_UNIDADE'), 'GESTOR', 'DESENVOLVEDOR'-->
        <button style="background-color: #ffa500; color: white;" type="button" class="btn" data-toggle="modal" data-target="#modalAtende">
            <b>+ Atende</b>  
        </button>
            @endif
        @endif
    </div>
    <div class="col-sm-4">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"> <i class="fa fa-map-signs"></i> <a href="/pesquisar"> Pesquisar Bem Imóvel</a> </li>
            <li class="breadcrumb-item active"> <a href="/index"> Consultar Bem Imóvel</a> </li>
        </ol>
    </div>
</div>

<!-- Modal Atende -->
<div id='modalAtendeHtml'></div>

@if (session('tituloMensagem'))
    <div id="fadeOut" class="card text-white bg-{{ session('corMensagem') }} hidden" >
        <div class="card-header">
            <div class="card-body">
                <h5 class="card-title"><strong>{{ session('tituloMensagem') }}</strong></h5>
                <br>
                <p class="card-text">{{ session('corpoMensagem') }}</p>
            </div>
        </div>
    </div>
@endif

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
        var numeroContrato = '{{ $numeroContrato }}';

        function avisoMensageria(url) {
            Swal.fire({
            titleText: 'Deseja realmente enviar a autorização de contratação?',
            text: "certifique-se de que a PP15 foi paga",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, enviar!',
            cancelButtonText: "Cancelar",
            
            }).then((result) => {
                if (result.value == true) {
                    $.get(url, function(){
                        if (result.value) {
                            Swal.fire(
                                'Mensagem enviada!',
                                'A mensagem foi enviada com sucesso',
                                'success'
                                )
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                    })
                } 
            })   
        }
    </script>
    
    <!-- <script src="{{ asset('js/global/formata_observacoes.js') }}"></script> -->
    <script src="{{ asset('js/global/formata_progress_bar.js') }}"></script>
    <script src="{{ asset('js/global/formata_tabela_historico.js') }}"></script>
    <script src="{{ asset('js/global/formata_tabela_mensagens_enviadas.js') }}"></script>
    <script src="{{ asset('js/global/formata_tabela_despesas_distrato.js') }}"></script>
    <script src="{{ asset('js/global/formata_lista_distrato.js') }}"></script>
    <script src="{{ asset('js/global/formata_data.js') }}"></script>   <!--Função global que formata a data para valor humano br.-->
    <script src="{{ asset('js/portal/imoveis/consulta-bem-imovel.js') }}"></script>
    <script src="{{ asset('js/portal/atende/atende.js') }}"></script>
    <script>
                setTimeout(function(){
                $('#fadeOut').fadeOut("slow");
                }, 4000);
    </script>

@stop