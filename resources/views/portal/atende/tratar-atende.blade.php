@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')

@if (session('tituloMensagem'))
<div id="fadeOut" class="card text-white bg-{{ session('corMensagem') }}">
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
        <h1 class="m-0 text-dark">
            Minhas Demandas - {{$listaDemandasAtende->numeroContrato}}
        </h1>
    </div><br>


    <div class="col">
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item active"> Atende</li>
            <li class="breadcrumb-item active"><a href="/atende/minhas-demandas"> Minhas Demandas</a> </li>    
        </ol>
    </div>
</div><br>



 @stop 


@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0">
                <ul class="nav nav-tabs d-flex justify-content-between" id="custom-tabs-one-tab" role="tablist">
                  
                    <li class="nav-item nav-card" id="custon-tabs-li-dados-imovel">
                        <a class="nav-link" id="custom-tabs-one-dados-tab" data-toggle="pill" href="#custom-tabs-one-dados" role="tab" aria-controls="custom-tabs-one-dados" aria-selected="false">
                            <h5>Dados do Imóvel</h5>
                        </a>
                    </li>
                    
                    <li class="nav-item nav-card" id="custon-tabs-li-contratacao">
                        <a class="nav-link" id="custom-tabs-one-contratacao-tab" data-toggle="pill" href="#custom-tabs-one-contratacao" role="tab" aria-controls="custom-tabs-one-contratacao" aria-selected="false">
                            <h5>Contratação</h5>
                        </a>
                    </li>


                    <li class="nav-item nav-card" id="custon-tabs-li-historico">
                        <a class="nav-link" id="custom-tabs-one-historico-tab" data-toggle="pill" href="#custom-tabs-one-historico" role="tab" aria-controls="custom-tabs-one-historico" aria-selected="false">
                            <h5>Histórico</h5>
                        </a>
                    </li>

                    <li class="nav-item nav-card" id="custon-tabs-li-mensagens">
                        <a class="nav-link active" id="custom-tabs-one-mensagens-tab" data-toggle="pill" href="#custom-tabs-one-mensagens" role="tab" aria-controls="custom-tabs-one-mensagens" aria-selected="true">
                            <h5>Responder Atende</h5>
                        </a>
                    </li>

                    <li class="nav-item nav-card" id="custon-tabs-li-modeloMensageria">
                        <a class="nav-link" id="custom-tabs-one-modeloMensageria-tab" data-toggle="pill" href="#custom-tabs-one-modeloMensageria" role="tab" aria-controls="custom-tabs-one-modeloMensageria" aria-selected="false">
                            <h5>Modelos de Mensagem</h5>
                        </a>
                    </li>


                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">

                    <div class="tab-pane fade" id="custom-tabs-one-dados" role="tabpanel" aria-labelledby="custom-tabs-one-dados-tab">
                    
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="card-title"><b>Trajetória do Imóvel - </b><b id="numeroContratoFormatado">{{$listaDemandasAtende->contratoFormatado}}</b></h2>
                                <button class="btn btn-outline-primary ml-2" data-toggle="tooltip" data-placement="top" title="Copiar CHB"><i class="far fa-copy"onclick="copyToClipboard('#numeroContratoFormatado')" ></i></button>
                                <br>
                                <div class="card-body pb-0" id="progressBarGeral"></div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- @if (session()->get('acessoEmpregadoPortal') !== 'AGENCIA') --}}
                            <div class="col-sm-3">
                                 <div class="form-group">
                                    <label>Dossiê Digital:</label>
                                    <br>
                                    <button class="btn btn-outline-primary ml-2" data-toggle="tooltip" data-placement="top" title="Copiar link" onclick="copyToClipboard('#linkServidor')"><i class="far fa-copy mx-1"></i>Servidor</button>
                                    <a href="file://///arquivos.caixa/sp/SP7257FS201/PUBLICO/PUBLIC/EstoqueImoveis/{{ $numeroContrato ?? $contratoFormatado ?? '' }}" id="linkServidor" hidden>\\arquivos.caixa\sp\SP7257FS201\PUBLICO\PUBLIC\EstoqueImoveis\{{$listaDemandasAtende->contratoFormatado}}</a>
                                </div> 
                            </div>
                            {{-- @endif --}}
                            <div id="anuncioSiteCaixa"class="col-sm-3">
                                <div class="form-group">
                                    <label>Anúncio X Imóveis:</label>
                                    <br>
                                    <button id="linkXimoveis" onClick="" class="btn btn-outline-primary ml-2" data-toggle="tooltip" data-placement="top" title="Visitar o anúncio do imóvel"><i class="fas fa-globe-americas mx-1"></i>X-Imóveis</button>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Status SIMOV:</label>
                                    <p id="statusImovel"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Classificação:</label>
                                    <p id="classificacao"></p>
                                </div>
                                {{-- <div class="form-group">
                                    <label>Vinculação:</label>
                                    <p id="GILIE"></p>
                                </div> --}}
                            </div>
                            <div class="col-sm-3">
                                {{-- <div class="form-group">
                                    <label>CPF Ex-Mutuário:</label>
                                    <p id=""></p>
                                </div> --}}
                            </div>
                        </div>

                        <div class="row">
                            <!-- <div class="col-sm-3">
                                <div class="form-group">
                                    <label>CHB:</label>
                                    <p id="numeroBem"></p>
                                </div>
                            </div> -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Endereço:</label>
                                    <p id="enderecoImovel"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Bairro:</label>
                                    <p id="bairroImovel"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>CEP:</label>
                                    <p id="cep"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Cidade do Imóvel:</label>
                                    <p id="cidadeImovel"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>UF do Imóvel:</label>
                                    <p id="ufImovel"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Tipo de Imóvel:</label>
                                    <p id="tipoImovel"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Empreendimento:</label>
                                    <p id="nomeEmpreendimento"></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>IPTU:</label>
                                    <p id="IPTU"></p>
                                </div>
                                {{-- <div class="form-group">
                                    <label>Status SIMOV:</label>
                                    <p id="statusImovel"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Classificação:</label>
                                    <p id="classificacao"></p>
                                </div> --}}
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Matrícula do Imóvel:</label>
                                    <p id="matriculaImovel"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Origem da Matrícula:</label>
                                    <p id="origemMatricula"></p>
                                </div>
                            </div>
                            
                        </div>
                        
                        <!-- <div class="row">
                            
                        </div>  -->
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Descrição do Imóvel:</label>
                                    <p id="descricaoImovel"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Descrição Adicional:</label>
                                    <p id="descricaoAdicionalImovel"></p>
                                </div>
                            </div>
                        
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Vinculação:</label>
                                    <p id="GILIE"></p>
                                </div>
                            </div>
                        </div>

                        <hr class="pontilhado">

                        <h2 class="card-title"><b>Dados do Ex-Mutuário</b></h2>

                        <br><br>
                        {{-- <div class="form-group">
                            <label>Nome Ex-Mutuário:</label>
                            <p id="nomeExMutuario"></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>CPF Ex-Mutuário:</label>
                            <p id="cpfCnpjExMutuario"></p>
                        </div>
                    </div> --}}

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Nome:</label>
                                    <p id="nomeExMutuario"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>CPF/CNPJ:</label>
                                    <p id="cpfCnpjExMutuario"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>E-mail:</label>
                                    <p id="emailExMutuario"></p>
                                </div>
                            </div>
                        </div>

                    </div>

                    

                    <div class="tab-pane fade" id="custom-tabs-one-contratacao" role="tabpanel" aria-labelledby="custom-tabs-one-contratacao-tab">
                        
                        <h2 class="card-title">
                            <b>Proposta Atual</b>
                            <b class="badge badge-info badge-large mx-4" id="tipoVenda"></b>
                            <!-- <b class="badge badge-info badge-large mx-4" id="nomeStatusDossie"></b> -->
                        </h2>

                        <br>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Nome:</label>
                                    <br>
                                    <button class="btn btn-outline-primary ml-2" data-toggle="tooltip" data-placement="top" title="Copiar nome" onclick="copyToClipboard('#nomeProponente')"><i class="far fa-copy"></i></button>
                                    <p class="d-inline" id="nomeProponente"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>CPF / CNPJ:</label>
                                    <br>
                                    <button class="btn btn-outline-primary ml-2" data-toggle="tooltip" data-placement="top" title="Copiar CPF/CNPJ" onclick="copyToClipboard('#cpfCnpjProponente')"><i class="far fa-copy"></i></button>
                                    <p class="d-inline" id="cpfCnpjProponente"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Telefone:</label>
                                    <p id="telefoneProponente"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>E-mail:</label>
                                    <p id="emailProponente"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Nome do Corretor:</label>
                                    <p id="nomeCorretor"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>CRECI do Corretor:</label>
                                    <p id="numeroCreciCorretor"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Telefone do Corretor:</label>
                                    <p id="telefoneCorretor"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>E-mail do Corretor:</label>
                                    <p id="emailCorretor"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Data da Proposta:</label>
                                    <p id="dataProposta"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Total da Proposta:</label>
                                    <p class="formata-valores" id="valorTotalProposta"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Valor em Recursos Próprios:</label>
                                    <p class="formata-valores" id="valorRecursosPropriosProposta"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Valor de FGTS:</label>
                                    <p class="formata-valores" id="valorFgtsProposta"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Valor de Financiamento:</label>
                                    <p class="formata-valores" id="valorFinanciamentoProposta"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Valor Parcelado:</label>
                                    <p class="formata-valores" id="valorParceladoProposta"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Número de Parcelas:</label>
                                    <p id="quantidadeParcelasProposta"></p>
                                </div>
                            </div>
                            <div style="visibility: hidden;" class="col-sm-3">
                                <div class="form-group">
                                    <label>Status da Proposta:</label>
                                    <p id="statusProposta"></p>
                                </div>
                            </div> 
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Sigla Comissão:</label>
                                    <p id="siglaComissao"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Agrupamento:</label>
                                    <p id="agrupamento"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Data de Assinatura do Contrato:</label>
                                    <p id="dataAssinaturaContrato" class="formata-data-sem-hora"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Data de Registro no Cartório:</label>
                                    <br>
                                    <p id="dataRegistroCartorio" class="formata-data-sem-hora"></p>
                                </div>
                            </div>
                        </div>


                        <hr class="pontilhado">

                        <h2 class="card-title" id="cardTitleConformidade"><b>Conformidade</b></h2>

                        <br id="brConformidade">

                        <div class="row" id="rowConformidade">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Status Conformidade:</label>
                                    <p id="nomeStatusDossie"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Card Agrupamento:</label>
                                    <p id="cardAgrupamento"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Data Parecer Conformidade:</label>
                                    <p id="dataParecerConformidade" class="formata-data-sem-hora"></p>
                                </div>
                            </div>
                        </div>

                        <hr class="pontilhado" id="pontilhadoConformidade">

                        <h2 class="card-title"><b>Agência Responsável</b></h2>

                        <br>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Código:</label>
                                    <p id="codigoAgContratacaoProposta"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Unidade:</label>
                                    <p id="nomeAgContratacaoProposta"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Caixa Postal:</label>
                                    <p id="emailAgContratacaoProposta"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Fluxo de Contratação:</label>
                                    <p id="tipoFluxoContratacao"></p>
                                </div>
                            </div>
                        </div>

                     
                    </div>


                    <div class="tab-pane fade" id="custom-tabs-one-historico" role="tabpanel" aria-labelledby="custom-tabs-one-historico-tab">
                        <div class="row">
                            <div class="col-sm-12">
                                @if (in_array(session()->get('acessoEmpregadoPortal'), [env('NOME_NOSSA_UNIDADE'), 'GESTOR', 'DESENVOLVEDOR']))
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modalCadastraAtendimento">
                                    <i class="fas fa-lg fa-headset m-2"></i>
                                    Cadastrar Historico
                                </button>
                                @endIf

    
                                <!-- Modal -->
                                <div class="modal fade modalCadastraAtendimento" id="modalCadastraAtendimento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form method='post' id="formCadastraAtendimento" action="/estoque-imoveis/registrar-historico/{{$listaDemandasAtende->contratoFormatado}}">
                                                {{ csrf_field() }}
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Cadastrar Histórico</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                <div class="form-group">
                                                    <label>Tipo de Histórico:</label>
                                                    <select name="tipoAtendimento" class="form-control" required>
                                                        <option value="">Selecione</option>
                                                        <option value="ANALISE">ANÁLISE/SUBSIDIO</option>
                                                        <option value="CAR-CAC">CAR/CAC</option>
                                                        <option value="EMAIL">E-MAIL</option>
                                                        <option value="PRESENCIAL">PRESENCIAL</option>
                                                        <option value="OUVIDORIA">SAC/OUVIDORIA</option>
                                                        <option value="SKYPE">SKYPE/LYNC</option>
                                                        <option value="TELEFONE">TELEFONE</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Atividade:</label>
                                                    <select name="atividadeAtendimento" class="form-control" required>
                                                        <option value="">Selecione</option>
                                                        <option value="CONTRATACAO">CONTRATAÇÃO</option>
                                                        <option value="PAGAMENTO">PAGAMENTO</option>
                                                        <option value="PREPARACAO">PREPARAÇÃO</option>
                                                        <option value="LEILÃO NEGATIVO">LEILÃO NEGATIVO</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Observações:</label>
                                                    <textarea rows="10" name="observacaoAtendimento" class="form-control"></textarea>
                                                </div>


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <br>
                                <br>
                        

                                <table id="tblHistorico" class="table table-bordered table-striped ">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Matrícula</th>
                                            <th>Tipo</th>
                                            <th>Atividade</th>
                                            <th class="obs">Observação</th>
                                            <th>Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>  

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



                    <div class="tab-pane fade" id="custom-tabs-one-modeloMensageria" role="tabpanel" aria-labelledby="custom-tabs-one-modeloMensageria-tab">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="notice notice-success">
                                    <strong>Modelos: </strong> Você pode criar modelos de mensagem para usar quando desejar</a>
                                </div>
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modalCadastraMensagem">
                                    <i class="far fa-envelope"></i>
                                    Criar Modelo Mensagem
                                </button> <br><br>

                                <button type="button" style="background-color: #e47b22; color: white;" class="btn btn-link float-right" data-toggle="modal" data-target="#modalmodeloSiouv">
                                    <i class="far fa-envelope"></i>
                                    Modelo Siouv
                                </button>                      

                                <!-- Modal Modelo de Mensagem-->
                                <div class="modal fade modalCadastraAtendimento" id="modalCadastraMensagem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <form method='post' id="formCadastraMensagem" action="/atende/criar-mensagem">
                                                {{ csrf_field() }}
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Cadastrar Mensagem</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                <div class="form-group">
                                                    <label>Nome do modelo:</label>
                                                    <input type="text" name="nomeModelo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Modelo Mensagem:</label>
                                                    <textarea rows="10" name="modeloMensageria" class="form-control summernote"></textarea>
                                                </div>


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Modelo de Siouv -->
                                <div class="modal fade" id="modalmodeloSiouv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                        <h5 class="modal-title" style="color: white;" id="exampleModalLabel">Cria modelo SIOUV</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                         <form method="post" action="/gerencial/gestao-siouv/modelo-siouv">
                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Nº SIOUV</label>
                                                <input type="number" name="numeroSiouv" class="form-control" aria-describedby="Numero Siouv" placeholder="Informe número SIOUV">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            <button type="submit" class="btn btn-primary">Criar mensagem</button>
                                        </div>
                                    </form>
                                    </div>
                                    </div>
                                </div>


                                <br>
                                <br>
                        

                                <table id="tblMensagemCriada" class="table table-bordered table-striped ">
                                    <thead>
                                        <tr>
                                            <th>Nome Modelo</th>
                                            <th>Modelo</th>
                                        </tr>
                                    </thead>
                                    <tbody>  

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="tab-pane fade show active" id="custom-tabs-one-mensagens" role="tabpanel" aria-labelledby="custom-tabs-one-mensagens-tab">
                        <div class="col-sm" style="display: none">
                            Contrato: <b><span id="numeroCHB">{{$listaDemandasAtende->contratoFormatado}}</span>
                        </div></b>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-2">
                                        ATENDE: <b>#{{str_pad($listaDemandasAtende->idAtende, 5, '0', STR_PAD_LEFT)}}</b> 
                                            
                                    </div>
                                    <div class="col-sm-2">
                                        Aberto por: <b>{{$listaDemandasAtende->matriculaCriadorDemanda}}</b>
                                    </div>

                                    <div class="col-sm-8">
                                        Cópia da resposta para: <b>{{$listaDemandasAtende->emailContatoResposta}}</b>&nbsp&nbsp&nbsp&nbsp       
                                        <b>{{$listaDemandasAtende->emailContatoCopia}}</b>&nbsp&nbsp&nbsp&nbsp
                                        <b>{{$listaDemandasAtende->emailContatoNovaCopia}}</b>
                                    </div>
                                    
                                </div>
                            </div>
                        </div><br>

                                                    <div class="col-sm-3">
                                 <div class="form-group">
                                    <label>Dossiê Digital:</label>
                                    <button class="btn btn-outline-primary ml-2" data-toggle="tooltip" data-placement="top" title="Copiar link" onclick="copyToClipboard('#linkServidor')"><i class="far fa-copy mx-1"></i>Servidor</button>
                                    <a href="file://///arquivos.caixa/sp/SP7257FS201/PUBLICO/PUBLIC/EstoqueImoveis/{{ $numeroContrato ?? $contratoFormatado ?? '' }}" id="linkServidor" hidden>\\arquivos.caixa\sp\SP7257FS201\PUBLICO\PUBLIC\EstoqueImoveis\{{$listaDemandasAtende->contratoFormatado}}</a>
                                </div> 
                            </div>



                        <div class="row">
                        <div class="col-md-12">
                            <div class="card card-default">
                                
                                <div class="card-body">
                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form method="post" enctype="multipart/form-data" action="/atende/responder/{{$listaDemandasAtende->idAtende}}">
                                            {{ csrf_field() }} 
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" name="_method" value="PUT">
                                                    <input type="hidden" name="emailContatoResposta" value="{{$listaDemandasAtende->emailContatoResposta}}">
                                                    <input type="hidden" name="emailContatoCopia" value="{{$listaDemandasAtende->emailContatoCopia}}">
                                                    <input type="hidden" name="emailContatoNovaCopia" value="{{$listaDemandasAtende->emailContatoNovaCopia}}">
                                                    <input type="hidden" name="descricaoAtende" value="{{$listaDemandasAtende->descricaoAtende}}">
                                                    <input type="hidden" name="matriculaCriadorDemanda" value="{{$listaDemandasAtende->matriculaCriadorDemanda}}">
                                                    <input type="hidden" name="contratoFormatado" value="{{$listaDemandasAtende->contratoFormatado}}">
                                                    <input type="hidden" name="numAtende" value="{{$listaDemandasAtende->idAtende}}">
                                                </div>
                                                        
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Responder Atende</label>
                                                        <textarea class="form-control summernote" name="respostaAtende" rows="10" required></textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-sm-10">
                                                        <input type="file" name="arquivo">
                                                        <button  style="float: right;" onclick="addCopia()" type="button" class="btn btn-primary">Adicionar email para cópia de resposta</button><br><br>
                                
                                                    <div style="display: none;" class="form-group toggle">
                                                        <label>Primeiro e-mail cópia</label>
                                                        <input type="email" class="form-control" name="emailAnexadoPeloResponsavel" placeholder="email">
                                                        <small class="form-text text-muted">Preencha este campo caso deseje enviar um cópia da resposta.</small>
                                                    </div>
                                                    <div style="display: none;" class="form-group toggle">
                                                        <label>Segundo e-mail cópia</label>
                                                        <input type="email" class="form-control" name="emailAnexadoPeloResponsavelCopia" placeholder="email">
                                                        <small  class="form-text text-muted">Preencha este campo caso deseje enviar um cópia da resposta.</small>
                                                    </div>
                                                    <div style="display: none;" class="form-group toggle">
                                                        <label>Terceiro e-mail cópia</label>
                                                        <input type="email" class="form-control" name="emailAnexadoPeloResponsavelTerceiraCopia" placeholder="email">
                                                        <small  class="form-text text-muted">Preencha este campo caso deseje enviar um cópia da resposta.</small>
                                                    </div>
                                                </div>
                                            <br>
                                           
                                            <div style="float: right;" class="modal-footer">
                                                <button type="submit" class="btn btn-success">Enviar Resposta</button>
                                            </div>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </div> <!-- /.card-body -->
                        </div> <!-- /.card -->
                    </div> <!-- /.col -->
                </div> <!-- /.row -->
                <hr>


                <div class="row">
                    <div class="col-md-12">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
            
                                            <b><p>Assunto: </b>{{$listaDemandasAtende->assuntoAtende}}</p> 
                                            <textarea class="form-control" rows="10">{{$listaDemandasAtende->descricaoAtende}}</textarea>
            
                                        </div>
                                    </div>
                                            </div>
                                        </div>
                                    </div>           
                                </div>

                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
@section('footer')


@stop

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
 
@stop


@section('js')
<script>
     var numeroContrato = $('#numeroCHB').text()
</script>
<script src="{{ asset('js/portal/atende/tratar-atende.js') }}"></script>
<script src="{{ asset('js/portal/atende/popula-modelo-mensagem.js') }}"></script>
<script src="{{ asset('js/global/formata_progress_bar.js') }}"></script>
<script src="{{ asset('js/global/formata_tabela_historico.js') }}"></script>
<script src="{{ asset('js/global/formata_data.js') }}"></script>
<script>
    function addCopia(){
    $('.toggle').toggle()
}
</script>
<script>
$('.summernote').summernote({
  height: 200,
  lang: "pt-BR" 
});
</script>
@stop
