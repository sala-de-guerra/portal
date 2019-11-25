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

    <div class="col-md-6">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Cartilha para Contratação a Vista:</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <embed src="../pdf/CARTILHA_CONTRATACAO_AQUISICAO_A_VISTA.v1.pdf" width="100%" height="650px"/>
            </div>
            <!-- /.card-body -->

        </div>
        <!--/.direct-chat -->
    </div>
    <!-- /.col -->
    
    <div class="col-md-6">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Cartilha para Contratação com uso do FGTS e Parcelamento:</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <embed src="../pdf/CARTILHA_CONTRATACAO_FINANC_FGTS_PARCELAMENTO_v1.pdf" width="100%" height="650px"/>
            </div>
            <!-- /.card-body -->

        </div>
        <!--/.direct-chat -->
    </div>
    <!-- /.col -->

</div>
<!-- /.row -->    
    

<div class="row">

    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Orientações Sobre Venda Online</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <embed src="../pdf/ApresentacaoAgencias.pdf" width="100%" height="650px"/>
            </div>
            <!-- /.card-body -->

        </div>
        <!--/.direct-chat -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->



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
                        <a href="http://suban.mz.caixa/imoveiscaixa">http://suban.mz.caixa/imoveiscaixa</a>
                    </li>

                    <li class="list-group-item">
                        3) Demandas e dúvidas operacionais devem ser enviadas pela GILIE e pelas Agências através do link (ATENDE):
                        <a href="http://inovacao.suban.caixa/#/atende">http://inovacao.suban.caixa/#/atende</a>
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