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
            <li class="breadcrumb-item active"><i class="fa fa-map-signs"></i></i> Atende</li>
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
                  
                    <li class="nav-item" id="custon-tabs-li-dados-imovel">
                        <a class="nav-link" id="custom-tabs-one-dados-tab" data-toggle="pill" href="#custom-tabs-one-dados" role="tab" aria-controls="custom-tabs-one-dados" aria-selected="false">
                            <h5>Dados do Imóvel</h5>
                        </a>
                    </li>
                    
                    <li class="nav-item" id="custon-tabs-li-contratacao">
                        <a class="nav-link" id="custom-tabs-one-contratacao-tab" data-toggle="pill" href="#custom-tabs-one-contratacao" role="tab" aria-controls="custom-tabs-one-contratacao" aria-selected="false">
                            <h5>Contratação</h5>
                        </a>
                    </li>


                    <li class="nav-item" id="custon-tabs-li-historico">
                        <a class="nav-link" id="custom-tabs-one-historico-tab" data-toggle="pill" href="#custom-tabs-one-historico" role="tab" aria-controls="custom-tabs-one-historico" aria-selected="false">
                            <h5>Histórico</h5>
                        </a>
                    </li>

                    <li class="nav-item" id="custon-tabs-li-mensagens">
                        <a class="nav-link active" id="custom-tabs-one-mensagens-tab" data-toggle="pill" href="#custom-tabs-one-mensagens" role="tab" aria-controls="custom-tabs-one-mensagens" aria-selected="true">
                            <h5>Responder Atende</h5>
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

                    <div class="tab-pane fade" id="custom-tabs-one-laudos" role="tabpanel" aria-labelledby="custom-tabs-one-laudos-tab">

                        <div class="row">
                            <div class="col-sm-3"> 
                                <div class="form-group">
                                    <label>Data Laudo de Avaliação:</label>
                                    <p class="formata-data-sem-hora" id="dataLaudoAvaliacao"></p>
                                </div>
                            </div> 
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Data Validade do Laudo:</label>
                                    <p class="formata-data-sem-hora" id="dataValidadeLaudoAvaliacao"></p>
                                </div>
                            </div> 
                            <div class="col-sm-3"> 
                                <div class="form-group">
                                    <label>Valor de Avaliação:</label>
                                    <p class="formata-valores" id="valorAvaliacao"></p>
                                </div>
                            </div> 
                        </div>
                    </div>

                    <div class="tab-pane fade" id="custom-tabs-one-leiloes" role="tabpanel" aria-labelledby="custom-tabs-one-leiloes-tab">
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-body pb-0" id="progressBarLeilaoNegativo"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Data Primeiro Leilão:</label>
                                    <p class="formata-data-sem-hora" id="dataPrimeiroLeilao"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Valor no Primeiro Leilão:</label>
                                    <p class="formata-valores" id="valorPrimeiroLeilao"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Data Segundo Leilão:</label>
                                    <p class="formata-data-sem-hora" id="dataSegundoLeilao"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Valor no Segundo Leilão:</label>
                                    <p class="formata-valores" id="valorSegundoLeilao"></p>
                                </div>
                            </div>                            
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Data de Consolidação:</label>
                                    <p class="formata-data-sem-hora" id="dataConsolidacao"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Número Leilão:</label>
                                    <p id="numeroLeilao"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Número do Item:</label>
                                    <p id="numeroItem"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Status SIMOV:</label>
                                    <p id="statusImovelLeilao"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Valor de Venda:</label>
                                    <p class="formata-valores" id="valorVenda"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Valor Contábil:</label>
                                    <p class="formata-valores" id="valorContabil"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Matrícula / RI:</label>
                                    <p id="matriculaImovelLeilao"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Cidade Comarca Cartório:</label>
                                    <p id="cidadeComarcaCartorio"></p>
                                </div>
                            </div>
                        </div>
                         
                        <!-- <hr class="pontilhado"> -->
                        <hr>
                        <div id="consultaLeilaoNegativo">
                            <div style="color: #054f77; font-size: 13pt;"><b>Dados do Leilão Negativo:</b>
                            <b class="badge badge-info badge-large mx-4" id="statusAverbacao"></b>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-6">
                                <div class="btn-group dropup">
                                    <button type="button" class="btn btn-link dropdown-toggle" style="color: #054f77; font-size: 13pt;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-info-circle"></i>Leiloeiro: <span id="nomeLeiloeiro"></span>
                                    </button>
                                    <div class="dropdown-menu" style="background-color: #054f77; color: white;">
                                        <h6 class="dropdown-header" style="color: white;">Telefone:</h6>
                                        <h6 class="dropdown-header" style="color: white;"><span id="telefoneLeiloeiro"></span></h6>
                                        <div class="dropdown-divider"></div>
                                        <h6 class="dropdown-header" style="color: white;">E-mail:</h6>
                                        <h6 class="dropdown-header" style="color: white;"><span id="emailLeiloeiro"></span></h6>
                                        <div class="dropdown-divider"></div>
                                        <h6 class="dropdown-header" style="color: white;">Site:</h6>
                                        <h6 class="dropdown-header" style="color: white;"><span id="siteEmpresaAssessoraLeiloeiro"></span></h6>
                                        <div class="dropdown-divider"></div>
                                        <h6 class="dropdown-header" style="color: white;">Empresa:</h6>
                                        <h6 class="dropdown-header" style="color: white;"><span id="nomeEmpresaAssessoraLeiloeiro"></span></h6>
                                        <div class="dropdown-divider"></div>
                                        <h6 class="dropdown-header" style="color: white;">Telefone:</h6>
                                        <h6 class="dropdown-header" style="color: white;"><span id="telefoneEmpresaAssessoraLeiloeiro"></span></h6>
                                        <div class="dropdown-divider"></div>
                                        <h6 class="dropdown-header" style="color: white;">E-mail:</h6>
                                        <h6 class="dropdown-header" style="color: white;"><span id="emailEmpresaAssessoraLeiloeiro"></span></h6>
 
                                    </div>
                                  </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="btn-group dropup">
                                        <button type="button" class="btn btn-link dropdown-toggle" style="color: #054f77; font-size: 13pt;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-info-circle"></i>Despachante: <span id="nomeDespachante"></span>
                                        </button>
                                        <div class="dropdown-menu" style="background-color: #054f77; color: white;">
                                            <h6 class="dropdown-header" style="color: white;">Telefone:</h6>
                                            <h6 class="dropdown-header" style="color: white;"><span id="telefoneDespachante"></span></h6>
                                            <div class="dropdown-divider"></div>
                                            <h6 class="dropdown-header" style="color: white;">E-mail:</h6>
                                            <h6 class="dropdown-header" style="color: white;"><span id="emailDespachante"></span></h6>
                                            <div class="dropdown-divider"></div>
                                            <h6 class="dropdown-header" style="color: white;">Responsável:</h6>
                                            <h6 class="dropdown-header" style="color: white;"><span id="nomePrimeiroResponsavelDespachante"></span></h6>
                                            <div class="dropdown-divider"></div>
                                            <h6 class="dropdown-header" style="color: white;">Telefone:</h6>
                                            <h6 class="dropdown-header" style="color: white;"><span id="telefonePrimeiroResponsavelDespachante"></span></h6>
                                            <div class="dropdown-divider"></div>
                                            <h6 class="dropdown-header" style="color: white;">E-mail:</h6>
                                            <h6 class="dropdown-header" style="color: white;"><span id="emailPrimeiroResponsavelDespachante"></span></h6>
     
                                        </div>
                                      </div>
                                    </div>

                            </div><br><br>

                            <div id="cardLeilao">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Previsão Recebimento Kit Leiloeiro:</label>
                                            <p class="formata-data-sem-hora" id="previsaoRecebimentoDocumentosLeiloeiro"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Data Recebimento Kit Leiloeiro:</label>
                                            <p class="formata-data-sem-hora" id="dataEntregaDocumentosLeiloeiro"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Previsão Entrega Docs Despachante:</label>
                                            <p class="formata-data-sem-hora" id="previsaoDisponibilizacaoDocumentosAoDespachante"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Data Entrega Docs Despachante:</label>
                                            <p class="formata-data-sem-hora" id="dataRetiradaDocumentosDespachante"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Nº Ordem de Serviço: </label>
                                            <p id="numeroOficioUnidade"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Nº Protocolo:</label>
                                            <p id="numeroProtocoloCartorio"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Senha de Acesso:</label>
                                            <p id="codigoAcessoProtocoloCartorio"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Previsão Análise Cartório:</label>
                                            <p class="formata-data-sem-hora" id="dataPrevistaAnaliseCartorio"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Data Retirada Documento Cartório:</label>
                                            <p class="formata-data-sem-hora" id="dataRetiradaDocumentoCartorio"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Data Entrega Documento Unidade:</label>
                                            <p class="formata-data-sem-hora" id="dataEntregaAverbacaoExigenciaUnidade"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Data Última Alteração:</label>
                                            <p class="formata-data-sem-hora" id="dataAlteracao"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Histórico :</label><button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalHistoricoleilaoNegativoCompleto"><i style="color: #054f77; font-size: 13pt;" class="fas fa-info-circle"></i></button>
                                            <p id="historicoLeilaoNegativo"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Código Rastreamento Correio:</label>&nbsp&nbsp
                                            <span id="botaocadastrar"></span>
                                            {{-- @if (in_array(session()->get('acessoEmpregadoPortal'), [env('NOME_NOSSA_UNIDADE'), 'GESTOR', 'DESENVOLVEDOR']))
                                            <button type="button" style="color: #white; font-size: 13pt; padding: 0; margin: 0;" class="btn btn-primary" data-toggle="modal" data-target="#cadastraCodigoCorreio">&nbsp Cadastrar &nbsp</button>
                                            @endif --}}
                                            <a href="https://www2.correios.com.br/sistemas/rastreamento/default.cfm" target="_blank" data-toggle="tooltip" data-placement="top" title="ir para o site de rastreio" class="btn btn-link" data-toggle="modal"><i style="color: #054f77; font-size: 13pt;" class="fas fa-external-link-square-alt"></i></a>
                                            {{-- <p id="codigoCorreio"></p> --}}
                                            <ul style="list-style-type: none; padding: 0; margin: 0;" id="codigoDoCorreio"></ul>
                                        </div>
                                    </div>
                                    <br>
                                    <br>             

                                    <!-- Modal -->
                                    <div class="modal fade" id="modalHistoricoleilaoNegativoCompleto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable"  role="document">
                                        <div class="modal-content">
                                        <div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">
                                            <h5 class="modal-title" style="color: white;" id="exampleModalLabel">Histórico</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <label for="paragrafoHistoricoleilaoNegativoCompleto">Histórico</label>
                                        <textarea class="form-control" rows="3" disabled id="paragrafoHistoricoleilaoNegativoCompleto"></textarea>
                                        </div>

                                    <div class="container">
                                        <form method='post'>
                                            {{ csrf_field() }}
                                            <input type="hidden" name="tipoAtendimento" value="REGISTRO">
                                            <input type="hidden" name="atividadeAtendimento" value="LEILÃO NEGATIVO">
                                            <div class="form-group">
                                                <p>Novo Histórico</p>
                                                    <textarea name="observacaoAtendimento" class="form-control" rows="5" required></textarea>
                                                </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            <button type="submit" class="btn btn-primary">Gravar</button>
                                        </div>
                                    </form>
                                </div>

                                        </div>
                                    </div>
                                    </div>
                                        </div>
     
                                    <!-- Botões do leilão negativo -->
                                    <div id="LeilaoNegativo"></div>
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
                                    <p id="dataProposta" class="formata-data-sem-hora"></p>
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

                    <div class="tab-pane fade" id="custom-tabs-one-distrato" role="tabpanel" aria-labelledby="custom-tabs-one-distrato-tab">

                        <div class="row">
                            <div class="col-sm-12">
                                <ul id="listaDistratos" class="list-unstyled">

                                </ul>
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

                                <button type="button" id="historicoPrestador" class="btn btn-primary float-right" style="display: none;" data-toggle="modal" data-target="#modalCadastraAtendimento">
                                    <i class="fas fa-lg fa-headset m-2"></i>
                                    Cadastrar Historico
                                </button>

                                <!-- Modal -->
                                <div class="modal fade modalCadastraAtendimento" id="modalCadastraAtendimento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form method='post' id="formCadastraAtendimento">
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

                    <div class="tab-pane fade" id="custom-tabs-one-aviso" role="tabpanel" aria-labelledby="custom-tabs-one-aviso-tab">
                        
                        <h2 class="card-title">
                            <b>AVISO</b>
                            <b class="badge badge-info badge-large mx-4"></b>
                            <!-- <b class="badge badge-info badge-large mx-4" id="nomeStatusDossie"></b> -->
                        </h2>
                    
                        <div style="background-color: #fff9c2;" class="alert alert-warning justify-content-center"  >
                            <div class="pl-5">
                                <p class="justify-content-center"><i class="fas fa-exclamation-triangle"></i> <strong> ATENÇÃO!</strong></p>
                                 <p>Esta proposta não foi sincronizada entre SIMOV e Portal GILIE ou não existe proposta cadastrada para o contrato.<br>
                                    Orientamos verificar situação para ajuste diretamente no <a href="https://simov.caixa" target="_blank" class="alert-link">simov.caixa</a>.</p>

                                 <p>O <b>simov.caixa</b> é de acesso exclusivo à funcionários lotados nas GILIE/GEIPT, em caso de dúvidas encaminhar e-mail para <b>giliesp01@caixa.gov.br</b></p>
                                 <p style="color: red">* recomendamos não utilizar dados da planilha do SIMOV</p>
                            </div>
                        </div>
                    </div>


                    <div class="tab-pane fade show active" id="custom-tabs-one-mensagens" role="tabpanel" aria-labelledby="custom-tabs-one-mensagens-tab">
                
                            <div class="col-sm-12">                       
                                <div id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="card card-primary">
                                      <div class="card-header" role="tab" id="headingOne"  onclick="mudaColapse()">
                                        <h5 class="mb-0">
                                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <div class="row">
                                                <div class="col-md-10">
                                                
                                                        <div class="row">
                                                            <div class="col-sm">
                                                                ATENDE: <b>{{$listaDemandasAtende->idAtende}}</b> 
                                                            </div>
                                                            <div class="col-sm">
                                                                Aberto por: <b>{{$listaDemandasAtende->matriculaCriadorDemanda}}</b>  
                                                            </div>
                                                            <div class="col-sm">
                                                                Contrato: <b><span id="numeroCHB">{{$listaDemandasAtende->contratoFormatado}}</span>
                                                                </div></b>
                                                          </div>
                                               
                                                </div>
                                                <div class="col-md-2">
                                                    <button id="collapse" class="btn btn-primary" style="float: right">X</button>
                                                </div>
                                            </div>
                                          </a>
                                        </h5>
                                      </div>
                                
                                      <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="card-block">
                                        
                                    <div class="row">
                                        <div class="col-md-12">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="row">
                                
                                                                <b><p>Assunto: </b>{{$listaDemandasAtende->assuntoAtende}}</p> 
                                                                {{-- <div class="container">
                                                                    <p>{{$listaDemandasAtende->descricaoAtende}}</p> 
                                                                </div> --}}
                                                                <textarea class="form-control" rows="5">{{$listaDemandasAtende->descricaoAtende}}</textarea>
                                
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
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleFormControlTextarea1">Responder Atende</label>
                                                                <textarea class="form-control" name="respostaAtende" rows="10" required></textarea>
                                                                </div>
                                                                <div class="row">
                                                                <div class="form-group col-sm-10">
                                                                <input type="file" name="arquivo">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success">Responder</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div> <!-- /.card-body -->
                                        </div> <!-- /.card -->
                                    </div> <!-- /.col -->
                                </div> <!-- /.row -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script>
var botãoPrestador = $('.dropdown-item-title').text()
if (botãoPrestador == "CRISTIANE VIEIRA BARBOSA"){
    $('#historicoPrestador').css('display','block');
}
</script>
                     

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
<script src="{{ asset('js/global/formata_progress_bar.js') }}"></script>
<script src="{{ asset('js/global/formata_tabela_historico.js') }}"></script>
<script src="{{ asset('js/global/formata_data.js') }}"></script>
@stop
