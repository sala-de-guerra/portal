@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row">
    <div class="col-sm-5">
        <h1 class="m-0 text-dark">
            Conheça o Projeto - Portal GILIE
        </h1>
    </div>
    <div class="col-sm-5">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="mailto:gilie09@mail.caixa?cc=c079436@mail.caixa;c111710@mail.caixa;c142765@mail.caixa&amp;subject=Sobre%20o%20Projeto%20Portal%20GILIE&amp;body=Deixe%20seu%20recado!"><i class="far fa-comment"></i>  #FaleConosco! </a></li>
            <li class="breadcrumb-item"><a href="sip:C142765@corp.caixa.gov.br">Carlos </a></li>
            <li class="breadcrumb-item"><a href="sip:c111710@corp.caixa.gov.br">Chuman </a></li>
            <li class="breadcrumb-item"><a href="sip:C079436@corp.caixa.gov.br">Vlad </a></li>
        </ul>
    </div>
    <div class="col-sm-2">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/projeto"> Conheça o Projeto</a> </li>
        </ol>
    </div>
</div>


@stop


@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card collapsed-card card-secondary">
            <div class="card-header">
                <h3 class="card-title"><i class="far fa-lg fa-calendar-check"></i> Linha do Tempo</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button> <!-- Collapse Button -->
                </div> <!-- /.card-tools -->
            </div> <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">

                    </div> <!-- /.col-sm-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->
</div> <!-- /.row -->

<div class="row">
    <div class="col-md-12">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title"><i class="far fa-lg fa-calendar-alt"></i> Planejamento</h3>
            </div> <!-- /.card-header -->
            <div class="card-body padding0">
                <blockquote class="quote-secondary margin0">
                    <div class="row">

                        <div class="col-sm-6">
                            <h4>Propostas de melhoria para o Processo de Contratação:</h4>
                            <ul class="list-unstyled">
                                <li>- Novo Portal de controle de imóveis Caixa e consulta de dados;</li>
                                <li>- Normalização dos dados do Simov, Imagem.caixa e Painel de Vendas;</li>
                                <li>- Mensageria automática de autorização de contratação;</li>
                                <li>- Barra de busca dinâmica para facilitar a localizção do bem;</li>
                                <li>- Controle de histórico de ações e mensagens realizadas do bem;</li>
                                <li>- Upload automatizado de foto e mapa de localização do bem no site X Imóveis;</li>
                            </ul>
                        </div> <!-- /.col-sm-6 -->

                        <div class="col-sm-6">
                            <h4>Propostas de melhoria para o Macro-Processo Imóveis Caixa:</h4>
                            <ul class="list-unstyled">
                                <li>- Função de visualização de arquivos do dossiê digital diretamente no portal, blindando os arquivos reais;</li>
                                <li>- Função de upload de arquivos para o dossiê digital com catalogação de documentos;</li>
                                <li>- Criação de calendário de Leilões com datas pré-acordadas de 1º e 2º leilão para melhor controle;</li>
                                <li>- Melhoria da ferramenta de notificação automática de leilão através do calendário e banco de dados;</li>
                                <li>- Controle de retorno de notificações de leilão;</li>
                                <li>- Controle diário de vencimento de propostas e acionamento do próximo proponente;</li>
                            </ul>
                        </div> <!-- /.col-sm-6 -->

                    </div> <!-- /.row -->
                </blockquote>
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->

</div> <!-- /.row -->

<div class="row">

    <div class="col-md-6">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title"><i class="far fa-lg fa-calendar-check"></i> Requisitos para Desenvolvimento</h3>
            </div> <!-- /.card-header -->
            <div class="card-body padding0">
                <div class="row">
                    <div class="col-sm-12">

                        <blockquote class="quote-secondary margin0">
                            <ul class="list-unstyled">
                                <li>- Servidores web configurados para PHP, com ambientes de desenvolvimento, homologação e produção;</li>
                                <li>- Servidor de banco de dados SQL;</li>
                                <li>- Servidor de arquivos para o dossiê digital dos bens (Diretório Virtual);</li>
                                <li>
                                    <div id="divModal" class="divModal">
                                        <div class="radio-inline">
                                            <a href="" rel="tooltip" data-toggle="modal" data-target="#modalFluxo">- Fluxograma do Processo;</a>
                                            <div class="modal fade" id="modalFluxo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content" height="600px">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title">Macro Processos Alienar v1</h3>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <embed src="/pdf/Macro_Processos_Alienar_v1.pdf" width="100%" height="650px" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="http://fontes.des.caixa/GILIESP/portal" target="_blank">- Versionamento do código no Fontes (GIT).</a></li>
                            </ul>

                        </blockquote>

                    </div> <!-- /.col-sm-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->

</div> <!-- /.row -->

<div class="row">

    <div class="col-md-6">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-lg fa-cog"></i> Metodologias Aplicadas</h3>
            </div> <!-- /.card-header -->
            <div class="card-body padding0">
                <div class="row">
                    <div class="col-sm-12">

                        <blockquote class="quote-secondary margin0">
                            <ol class="list-unstyled">
                                <li>1. Kanban: atualização online no 
                                    <a href="https://kanban.caixa/public/board/88e63ea35dab873d1e15250fc817535ad50d18cfd1fc5775f862b8239b98" target="_blank">Kanban.Caixa</a>;
                                </li>
                                <li>2. MVC: separação da regra de negócios das regras de visualização;</li>
                                <li>3. Time Boxed: Sprints de 14 dias para posicionamento andamento do projeto;</li>
                                <li>4. GIT: Versionamento e Backup no Fontes;</li>
                            </ol>
                        </blockquote>

                    </div> <!-- /.col-sm-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->

    <div class="col-md-6">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-lg fa-graduation-cap"></i> Aprendizado</h3>
            </div> <!-- /.card-header -->
            <div class="card-body padding0">
                <div class="row">
                    <div class="col-sm-12">

                        <blockquote class="quote-secondary margin0">
                            <h4>Maturação da equipe em termos técnicos</h4>
                            <ul class="list-unstyled">
                                <li>1. Solicitação de ambiente para desenvolvimento de aplicações em parceria com GITEC-SP</li>
                                <li>2. Configuração e uso do Framework MVC Laravel.</li>
                                <li>3. Construção de validações e regras de negócio.</li>
                                <li>4. Construção de validações e regras de negócio.</li>
                                <li>5. Upload de arquivos com telas de consulta, visualização e download.</li>
                                <li>6. Formação Alura em PHP para o colega Rafael e Python para o colega Marcos.</li>
                            </ul>
                        </blockquote>

                    </div> <!-- /.col-sm-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->

</div> <!-- /.row -->


@section('footer')


@stop

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')

@stop