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
                        <embed src="../pdf/ApresentacaoAgencias.pdf" width="100%" height="650px"/>
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
            <!-- /.card-header -->

            <div class="card-body">
                <ul class="list-group">

                    <li class="list-group-item">
                        1) Endereço para disponibilização de documentos pela GILIE e pelas Agências e tratamento pela CICOB Recife:
                        <a href="http://retaguarda.caixa/digitalizar/#/">http://retaguarda.caixa/digitalizar/#/</a>
                    </li>

                    <li class="list-group-item">
                        2) Acompanhamento do processo de concessão pela GILIE e pelas Agências no Painel Imóveis CAIXA:
                        <a href="http://imagem.caixa/imoveiscaixa/">http://imagem.caixa/imoveiscaixa/</a>
                    </li>

                    <li class="list-group-item">
                        3) Demandas e dúvidas operacionais devem ser enviadas pela GILIE e pelas Agências através do link (ATENDE):
                        <a href="http://inovacao.suban.caixa/apps/atende/#/login">http://inovacao.suban.caixa/apps/atende/#/login</a>
                    </li>

                    <li class="list-group-item">
                        4) Demandas jurídicas no portal DIJUR:
                        <a href="http://www.portal.dijur.caixa/">http://www.portal.dijur.caixa/</a>
                    </li>

                    <li class="list-group-item">
                        5) Acompanhamento de ativos e contratos no SIGA:
                        <a href="http://siga.caixa/">http://siga.caixa/</a>
                    </li>

                    
                </ul>
 
            </div>
            <!-- /.card-body -->

        </div>
        <!--/.direct-chat -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->


@section('footer')


@stop

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
        
@stop


@section('js')

@stop