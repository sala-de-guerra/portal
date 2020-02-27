@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')
<!-- <style>
.hover {
    background: #e5e5e5 !important; 
}
</style> -->

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

        <button type="button" class="btn btn-primary p-1 m-1" data-toggle="modal" data-target="#modalCartilhaContratacaoAVista">
            Cartilha para Contratação à Vista &nbsp &nbsp
            <i class="fas fa-lg fa-external-link-alt"></i>
        </button>

        <div class="modal fade" id="modalCartilhaContratacaoAVista" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cartilha para Contratação à Vista</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <embed src="../pdf/CARTILHA_CONTRATACAO_AQUISICAO_A_VISTA.v1.pdf" width="100%" height="650px"/>
                    </div>
                </div>
            </div>
        </div>

        &nbsp

        <button type="button" class="btn btn-primary p-1 m-1" data-toggle="modal" data-target="#modalCartilhaContratacaoFGTS">
            Cartilha para Contratação com uso do FGTS e Parcelamento &nbsp &nbsp
            <i class="fas fa-lg fa-external-link-alt"></i>
        </button>

        <div class="modal fade" id="modalCartilhaContratacaoFGTS" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cartilha para Contratação com uso do FGTS e Parcelamento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <embed src="../pdf/CARTILHA_CONTRATACAO_FINANC_FGTS_PARCELAMENTO_v1.pdf" width="100%" height="650px"/>
                    </div>
                </div>
            </div>
        </div>

        &nbsp

        <button type="button" class="btn btn-primary p-1 m-1" data-toggle="modal" data-target="#modalCartilhaVendaOnline">
            Cartilha de Venda Online &nbsp &nbsp
            <i class="fas fa-lg fa-external-link-alt"></i>
        </button>

        <div class="modal fade" id="modalCartilhaVendaOnline" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cartilha de Venda Online</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <embed src="../pdf/ApresentacaoAgencias.pdf" width="100%" height="650px"/>
                    </div>
                </div>
            </div>
        </div>

        &nbsp

        <button type="button" class="btn btn-primary p-1 m-1" data-toggle="modal" data-target="#modalCartilhaContratacaoCCA">
            Cartilha de Contratação em CCA &nbsp &nbsp
            <i class="fas fa-lg fa-external-link-alt"></i>
        </button>

        <div class="modal fade" id="modalCartilhaContratacaoCCA" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cartilha de Contratação em CCA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <embed src="../pdf/CARTILHA_CONTRATACAO_VIA_CCA_VERSAO_4.pdf" width="100%" height="650px"/>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
</div>
    
    <br>

<div class="row">

    <div class="col-md-12">
        <div class="card card-default">

            <div class="card-header">
                <h3 class="card-title">Links Úteis</h3>
            </div>

            <div class="card-body">
                <ul class="row" style="list-style: none;">   
                    <li class="col-6 pb-4">
                        <button class="col-12 btn btn-default">
                            Acompanhamento do processo de contratação:
                            <br>
                            <a href="http://imagem.caixa/imoveiscaixa/" target="_blank">http://imagem.caixa/imoveiscaixa/</a>
                        </button>
                    </li>
                    <li class="col-6 pb-4">
                        <button class="col-12 btn btn-default">
                            Consulta de ações judiciais e demais demandas jurídicas :
                            <br>
                            <a href="http://www.portal.dijur.caixa/" target="_blank">http://www.portal.dijur.caixa/</a>
                        </button>
                    </li>
                    <li class="col-6 pb-4">
                        <button class="col-12 btn btn-default">
                            Criação de DLE com código de barras:
                            <br>
                            <a href="http://sinafweb.caixa/" target="_blank">http://sinafweb.caixa/</a>
                        </button>
                    </li>
                    <li class="col-6 pb-4">
                        <button class="col-12 btn btn-default">
                            Dúvidas sobre o envio e tratamento da conformidade (ATENDE):
                            <br>
                            <a href="http://inovacao.suban.caixa/apps/atende/#/login" target="_blank">http://inovacao.suban.caixa/apps/atende/#/login</a>
                        </button>
                    </li>
                    <li class="col-6 pb-4">
                        <button class="col-12 btn btn-default">
                            Gestão de ativos e contratos:
                            <br>
                            <a href="http://siga.caixa/" target="_blank">http://siga.caixa/</a>
                        </button>
                    </li>
                    <li class="col-6 pb-4">
                        <button class="col-12 btn btn-default">
                            Portal da GEIPT com indicadores e ferramentas de gestão estratégica :
                            <br>
                            <a href="http://alienar.caixa/" target="_blank">http://alienar.caixa/</a>
                        </button>
                    </li>
                </ul>
            </div>

        </div>
        
    </div>
    
</div>



@section('footer')


@stop

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
        
@stop


@section('js')
<!-- <script>
$('li').mouseover(function(){
$(this).addClass('hover');
});
$('li').mouseout(function(){
$(this).removeClass('hover');
});
</script> -->

@stop