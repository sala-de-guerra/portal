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
        {{-- @if (env('APP_ENV') != 'PRODUCAO')
            @if (in_array(session()->get('acessoEmpregadoPortal'), ['DESENVOLVEDOR'])) <!-- env('NOME_NOSSA_UNIDADE'), 'GESTOR', 'DESENVOLVEDOR'--> --}}
        {{-- <button style="background-color: #ffa500; color: white;" type="button" class="btn" data-toggle="modal" data-target="#modalAtende">
            <b>+ Atende</b>  
        </button> --}}

        <button type="button" class="btn-behance" data-toggle="modal" data-target="#modalAtendeAviso" id="btnAtende">
            <span class="btn-gradient">
              <i class="fas fa-headset"></i>
            </span>
            <span class="btn-text">Atende</span>
          </button>
        
          <div class="modal fade" id="modalAtendeAviso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background: repeating-linear-gradient(
                    45deg,
                    #d1e704,
                    #d1e704 10px,
                    #98a802 10px,
                    #98a802 20px
                  );">
                  <h5 class="modal-title" id="exampleModalLabel"><b>Atenção:</b></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    O estoque de contratação da GILIE/SP  foi migrado para a CEVEN em 29/03/2021 .<br>
                    Solicitamos abrir demanda para aquela área via ATENDE SUBAN pelo endereço:<br>
                    <a  href="http://inovacao.suban.caixa/apps/atende/#/login">http://inovacao.suban.caixa/apps/atende/#/login</a>, opção Imóveis CAIXA
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                </div>
              </div>
            </div>
          </div>
        
            {{-- @endif
        @endif --}}
    </div>
    <div class="col-sm-4">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><i class="fa fa-map-signs"></i></i><a href="/"> Principal</a> </li>
            <li class="breadcrumb-item active"></i>Consulta Imóvel</li>
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
            console.log(url)
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