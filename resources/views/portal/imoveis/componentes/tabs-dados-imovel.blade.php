<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0">
                <ul class="nav nav-tabs d-flex justify-content-between" id="custom-tabs-one-tab" role="tablist">
                  
                    <li class="nav-item" id="custon-tabs-li-dados-imovel">
                        <a class="nav-link active" id="custom-tabs-one-dados-tab" data-toggle="pill" href="#custom-tabs-one-dados" role="tab" aria-controls="custom-tabs-one-dados" aria-selected="true">
                            <h5>Dados do Imóvel</h5>
                        </a>
                    </li>

                    <li class="nav-item" id="custon-tabs-li-laudos">
                        <a class="nav-link" id="custom-tabs-one-laudos-tab" data-toggle="pill" href="#custom-tabs-one-laudos" role="tab" aria-controls="custom-tabs-one-laudos" aria-selected="false">
                            <h5>Laudos</h5>
                        </a>
                    </li>

                    <li class="nav-item" id="custon-tabs-li-leiloes">
                        <a class="nav-link" id="custom-tabs-one-leiloes-tab" data-toggle="pill" href="#custom-tabs-one-leiloes" role="tab" aria-controls="custom-tabs-one-leiloes" aria-selected="false">
                            <h5>Leilões</h5>
                        </a>
                    </li>
                    
                    <li class="nav-item" id="custon-tabs-li-contratacao">
                        <a class="nav-link" id="custom-tabs-one-contratacao-tab" data-toggle="pill" href="#custom-tabs-one-contratacao" role="tab" aria-controls="custom-tabs-one-contratacao" aria-selected="false">
                            <h5>Contratação</h5>
                        </a>
                    </li>

                    <li style="display: none;" class="nav-item" id="custon-tabs-li-aviso">
                        <a class="nav-link" id="custom-tabs-one-aviso-tab" data-toggle="pill" href="#custom-tabs-one-aviso" role="tab" aria-controls="custom-tabs-one-aviso" aria-selected="false">
                            <h5>Contratação</h5>
                        </a>
                    </li>
                    
                    <li class="nav-item" id="custon-tabs-li-distrato">
                        <a class="nav-link" id="custom-tabs-one-distrato-tab" data-toggle="pill" href="#custom-tabs-one-distrato" role="tab" aria-controls="custom-tabs-one-distrato" aria-selected="false">
                            <h5>Distrato</h5>
                        </a>
                    </li>

                    <li class="nav-item" id="custon-tabs-li-historico">
                        <a class="nav-link" id="custom-tabs-one-historico-tab" data-toggle="pill" href="#custom-tabs-one-historico" role="tab" aria-controls="custom-tabs-one-historico" aria-selected="false">
                            <h5>Histórico</h5>
                        </a>
                    </li>

                    <li class="nav-item" id="custon-tabs-li-mensagens">
                        <a class="nav-link" id="custom-tabs-one-mensagens-tab" data-toggle="pill" href="#custom-tabs-one-mensagens" role="tab" aria-controls="custom-tabs-one-mensagens" aria-selected="false">
                            <h5>Mensagens</h5>
                        </a>
                    </li>


                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">

                    <div class="tab-pane fade show active" id="custom-tabs-one-dados" role="tabpanel" aria-labelledby="custom-tabs-one-dados-tab">
                    
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="card-title"><b>Trajetória do Imóvel - </b><b id="numeroContratoFormatado">{{ $numeroContrato ?? $contratoFormatado }}</b></h2>
                                <button class="btn btn-outline-primary ml-2" data-toggle="tooltip" data-placement="top" title="Copiar CHB" onclick="copyToClipboard('#numeroContratoFormatado')"><i class="far fa-copy"></i></button>
                                <br>
                                <div class="card-body pb-0" id="progressBarGeral"></div>
                            </div>
                        </div>

                        <div class="row">
                            @if (session()->get('acessoEmpregadoPortal') !== 'AGENCIA')
                            <div class="col-sm-3">
                                 <div class="form-group">
                                    <label>Dossiê Digital:</label>
                                    <br>
                                    <button class="btn btn-outline-primary ml-2" data-toggle="tooltip" data-placement="top" title="Copiar link" onclick="copyToClipboard('#linkServidor')"><i class="far fa-copy mx-1"></i>Servidor</button>
                                    <a href="file://///arquivos.caixa/sp/SP7257FS201/PUBLICO/PUBLIC/EstoqueImoveis/{{ $numeroContrato ?? $contratoFormatado ?? '' }}" id="linkServidor" hidden>\\arquivos.caixa\sp\SP7257FS201\PUBLICO\PUBLIC\EstoqueImoveis\{{ $numeroContrato ?? $contratoFormatado ?? '' }}</a>
                                </div> 
                            </div>
                            @endif
                            <div id="anuncioSiteCaixa"class="col-sm-3">
                                <div class="form-group">
                                    <label>Anúncio X Imóveis:</label>
                                    <br>
                                    <button id="linkXimoveis" onClick="" class="btn btn-outline-primary ml-2" data-toggle="tooltip" data-placement="top" title="Visitar o anúncio do imóvel"><i class="fas fa-globe-americas mx-1"></i>X-Imóveis</button>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Nome Ex-Mutuário:</label>
                                    <p id="nomeExMutuario"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>CPF Ex-Mutuário:</label>
                                    <p id="cpfCnpjExMutuario"></p>
                                </div>
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
                                    <label>Status SIMOV:</label>
                                    <p id="statusImovel"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Classificação:</label>
                                    <p id="classificacao"></p>
                                </div>
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
                                {{-- <div class="col-sm-6">
                                    <div class="tooltip-col text-center" style="color: #054f77; font-size: 13pt;"><i class="fas fa-info-circle"></i>
                                        Leiloeiro: <span id="nomeLeiloeiro"></span>
                                        <span class="tooltiptext">
                                            <div class="form-group">
                                                <b>Telefone:</b><br>
                                                <span id="telefoneEmpresaAssessoraLeiloeiro"></span><br>

                                                <b>E-mail:</b><br>
                                                <span id="emailEmpresaAssessoraLeiloeiro"></span><br>

                                                <b>Site:</b><br>
                                                <span id="siteEmpresaAssessoraLeiloeiro"></span><br>

                                                <b>Empresa:</b><br>
                                                <span id="nomeEmpresaAssessoraLeiloeiro"></span><br>

                                                <b>Telefone:</b><br>
                                                <span id="telefoneLeiloeiro"></span><br>

                                                <b>E-mail:</b><br>
                                                <span id="emailLeiloeiro"></span>
                                            </div>
                                        </span>
                                    </div>
                                </div> --}}
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
                                    {{-- <div class="tooltip-col text-center" style="color: #054f77; font-size: 13pt;"><i class="fas fa-info-circle"></i>
                                        Despachante: <span id="nomeDespachante"></span>
                                        <span class="tooltiptext">
                                            <div class="form-group"><br>
                                                <b>Telefone:</b><br>
                                                <span id="telefoneDespachante"></span><br>

                                                <b>E-mail:</b><br>
                                                <span id="emailDespachante"></span><br>

                                                <b>Responsável:</b><br>
                                                <span id="nomePrimeiroResponsavelDespachante"></span><br>

                                                <b>Telefone:</b><br>
                                                <span id="telefonePrimeiroResponsavelDespachante"></span><br>

                                                <b>E-mail:</b><br>
                                                <span id="emailPrimeiroResponsavelDespachante"></span>                                    
                                            </div>
                                        </span>
                                    </div>
                                </div> --}}
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
                                            <label>Nº Oficio: </label>
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
                                        <form method='post' action='/estoque-imoveis/leiloes-negativos/tratar/{{ $numeroContrato ?? $contratoFormatado ?? '' }}'>
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



                        <!-- <div>
                            <div class="tooltip-col text-center" style="color: #054f77; font-size: 13pt;">Leiloeiro
                            <span class="tooltiptext">
                            
                            </span>
                            </div>
                        </div> -->
    
                      

                        
                        
                        
                        <!-- <h2 class="card-title"><b>Averbação de Leilões Negativos</b></h2>

                        <br>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Status Atual:</label>
                                    <p id=""></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Última atualização:</label>
                                    <p class="formata-data-sem-hora" id=""></p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Observações:</label>
                                    <p id=""></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Data Recebimento Kit Leiloeiro:</label>
                                    <p class="formata-data-sem-hora" id="dataKitLeiloeiro"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Protocolo de Prenotação:</label>
                                    <p id=""></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Senha de acompanhamento:</label>
                                    <p id=""></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Dados do Leiloeiro:</label>
                                    <p id=""></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Número da O.S.:</label>
                                    <p id="dataKitLeiloeiro"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Data Retirada Despachante:</label>
                                    <p class="formata-data-sem-hora" id=""></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Dados do Despachante:</label>
                                    <p id=""></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Dados do Despachante:</label>
                                    <p id=""></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div id="" class="col-auto">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalKitLeiloeiro">
                                    <i class="fas fa-file-import"></i> Receber Kit Leiloeiro
                                </button>
                            </div>

                            <div class="modal fade" id="modalKitLeiloeiro" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form method='post' action='' id="formKitLeiloeiro">
                                            {{ csrf_field() }}
                                            <div class="modal-header">
                                                <h5 class="modal-title">Receber Kit Leiloeiro</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label>CHB Formatado:</label>
                                                    <input type="text" name="contratoFormatado" class="form-control" id="inputChb" placeholder="00.0000.0000000-0" required>
                                                </div>

                                                <div class="form-group">
                                                    <button type="button" class="btn btn-primary" onclick="_validarCHB('#inputChb');">Validar CHB</button>
                                                </div>

                                                <div class="form-group">
                                                    <label>Nome do Proponente:</label>
                                                    <input type="text" name="nomeProponente" class="form-control" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>CPF / CNPJ:</label>
                                                    <input type="text" name="cpfCnpjProponente" class="form-control" required>
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


                            <div id="" class="col-auto">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
                                    <i class="fas fa-file-export"></i> Enviar Kit Despachante
                                </button>
                            </div>

                            <div id="" class="col-auto">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAlterarStatus">
                                    <i class="fas fa-file-export"></i> Alterar Status
                                </button>
                            </div>

       
                            <div class="modal fade" id="modalAlterarStatus" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form method='post' action='' id="formAlterarStatus">
                                            {{ csrf_field() }}
                                            <div class="modal-header">
                                                <h5 class="modal-title">Alterar Status</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label>Novo Status:</label>
                                                    <select name="statusLeiloesNegativos" id="statusLeiloesNegativos" class="form-control" required>
                                                        <option value="" selected>Selecione</option>
                                                        <option value="NOTA DEVOLUTIVA EM TRATAMENTO">NOTA DEVOLUTIVA EM TRATAMENTO</option>
                                                        <option value="NOTA DEVOLUTIVA TRATADA">NOTA DEVOLUTIVA TRATADA</option>
                                                        <option value="AVERBADO">AVERBADO</option>
                                                        <option value="ACAO JUDICIAL IMPEDITIVA">AÇÃO JUDICIAL IMPEDITIVA</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Data Retirada Despachante:</label>
                                                    <input type="text" name="dataRetiradaDespachante" id="dataRetiradaDespachante" class="form-control mascaradata datepicker" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Observações:</label>
                                                    <textarea rows="5" name="observacaoLeiloesNegativos" class="form-control"></textarea>
                                                </div>


                                                <div class="form-group">
                                                    <label>CHB Formatado:</label>
                                                    <input type="text" name="contratoFormatado" class="form-control" id="inputChb" placeholder="00.0000.0000000-0" required>
                                                </div>

                                                <div class="form-group">
                                                    <button type="button" class="btn btn-primary" onclick="_validarCHB('#inputChb');">Validar CHB</button>
                                                </div>

                                                <div class="form-group">
                                                    <label>Nome do Proponente:</label>
                                                    <input type="text" name="nomeProponente" class="form-control" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>CPF / CNPJ:</label>
                                                    <input type="text" name="cpfCnpjProponente" class="form-control" required>
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


                        </div> -->

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

                        <!-- <div class="modal fade" id="modalConsultaCiweb" tabindex="-1" role="dialog" aria-labelledby="modalConsultaCiweb" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <embed src="https://ciweb4.extranet.caixa/ciweb2.0/Contrato/PesquisarContrato/" width=200 height=200 />
                                        <object type="text/html" data="https://ciweb4.extranet.caixa/ciweb2.0/Contrato/PesquisarContrato/" width="800px" height="600px" style="overflow:auto;border:1px ridge #ccc"></object>
                                    </div>
                                    <div class="modal-footer">

                                    </div>
                                </div>
                            </div>
                        </div> -->

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

                        <!-- <h2 class="card-title"><b>CIOPE</b></h2>

                        <br>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Tipo de Contratacao:</label>
                                    <p id="tipoContratacaoCiope"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Card Agrupamento:</label>
                                    <p id="cardAgrupamentoCiope"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Status Dossiê:</label>
                                    <p id="statusDossieCiope"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Fluxo de Contratação:</label>
                                    <p id="tipoFluxoContratacao"></p>
                                </div>
                            </div>
                        </div> -->
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
                                <!-- Modal -->
                                <div class="modal fade modalCadastraAtendimento" id="modalCadastraAtendimento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form method='post' action='/estoque-imoveis/registrar-historico/{{ $numeroContrato ?? $contratoFormatado }}' id="formCadastraAtendimento">
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
                                                        <option value="EMAIL">E-MAIL</option>
                                                        <option value="PRESENCIAL">PRESENCIAL</option>
                                                        <option value="OUVIDORIA">SAC/OUVIDORIA</option>
                                                        <option value="SKYPE">SKYPE/LYNC</option>
                                                        <option value="TELEFONE">TELEFONE</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Coordenação:</label>
                                                    <select name="atividadeAtendimento" class="form-control" required>
                                                        <option value="">Selecione</option>
                                                        <option value="CONTRATACAO">CONTRATAÇÃO</option>
                                                        <option value="PAGAMENTO">PAGAMENTO</option>
                                                        <option value="PREPARACAO">PREPARAÇÃO</option>
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


                    <div class="tab-pane fade" id="custom-tabs-one-mensagens" role="tabpanel" aria-labelledby="custom-tabs-one-mensagens-tab">
                        
                            @if (in_array(session()->get('acessoEmpregadoPortal'), [env('NOME_NOSSA_UNIDADE'), 'GESTOR', 'DESENVOLVEDOR']))
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="alert" style="background-color: #fff9c2;" >
                                        <div>
                                            <i class="fas fa-exclamation-triangle"></i> ATENÇÃO:
                                                Envie a autorização apenas após o pagamento da PP15
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn btn-primary float-right" onclick="avisoMensageria('/estoque-imoveis/mensagens-automaticas/autorizacao-contratacao/{{ $numeroContrato ?? $contratoFormatado }}')">
                                        <i class="far fa-lg fa-envelope m-2"></i>
                                        Enviar Autorização de Contratação
                                    </button>
                                </div>
                           
                            @endIf
                            <div class="col-sm-12">
                                <br>
                                <br>
                                
                                <table id="tblMensagensEnviadas" class="table table-bordered table-striped dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tipo de Mensagem</th>
                                            <th>Unidade Destino</th>
                                            <th>E-mail do Proponente</th>
                                            <th>E-mail do Corretor</th>
                                            <th>Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- 
<div class="row">
    <div class="col-md-12">
        <div class="card collapsed-card card-primary">
            <div class="card-header">
                <h3 class="card-title">Dossiê Digital</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 table-responsive p-0">
                        <table id="tblDossieDigital" class="table">
                            <thead>
                            <tr>
                                <th>Visualizar Documento</th>
                                <th>ID do Documento</th>
                                <th>Nome do Documento</th>
                                <th>Tipo de Documento</th>
                                <th>Data do Upload</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div> 
                </div> 

                <div class="row">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUploadArquivo">
                            <i class="fas fa-cloud-upload-alt"></i>
                                Upload de Arquivo
                        </button>
                        <div class="modal fade" id="modalUploadArquivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Upload de Arquivo</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="" enctype="multipart/form-data" id="formCarregaArquivo">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Tipo de Documento</label>
                                                    <select class="form-control select2" style="width: 100%;" required>
                                                        <option selected="selected">Documento 1</option>
                                                        <option>Documento 2</option>
                                                        <option>Documento 3</option>
                                                        <option>Documento 4</option>
                                                        <option>Outros</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 input-group">
                                                    <label class="input-group-btn">
                                                        <span class="btn btn-primary front">
                                                            <i class="fa fa-lg fa-cloud-upload"></i>
                                                                Carregar arquivo&hellip;
                                                        </span>
                                                        <input type="file" class="behind" accept=".pdf" name="uploadArquivo[]" id="inputUploadArquivo" required>
                                                    </label>
                                                    <input type="text" class="form-control previewNomeArquivo" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-group col-md-2">
                                                    <button type="submit" id="submitBtn" class="btn btn-primary">Gravar</button>
                                                </div>
                                            </div>
                                        </form>
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
        <div class="card collapsed-card card-primary">
            <div class="card-header">
                <h3 class="card-title">Laudos de Avaliação</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="card-body">
            
                <div class="row">
                    <div class="col-sm-12 table-responsive p-0">
                        <table id="tblLaudos" class="table">
                            <thead>
                            <tr>
                                <th>Visualizar Documento</th>
                                <th>Número do Laudo</th>
                                <th>Data do Laudo</th>
                                <th>Vencimento do Laudo </th>
                                <th>Data do Upload</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUploadLaudo">
                            <i class="fas fa-cloud-upload-alt"></i>
                             Upload de Arquivo
                        </button>
                        <div class="modal fade" id="modalUploadLaudo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Upload de Laudo</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="" enctype="multipart/form-data" id="formCarregaLaudo">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Data do Laudo</label>
                                                    <input type="text" class="form-control" placeholder="DD/MM/AAAA" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 input-group">
                                                    <label class="input-group-btn">
                                                        <span class="btn btn-primary front">
                                                            <i class="fa fa-lg fa-cloud-upload"></i>
                                                             Carregar arquivo&hellip;
                                                        </span>
                                                        <input type="file" class="behind" accept=".pdf" name="uploadLaudo[]" id="inputUploadLaudo" required>
                                                    </label>
                                                    <input type="text" class="form-control previewNomeArquivo" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-group col-md-2">
                                                    <button type="submit" id="submitBtn" class="btn btn-primary">Gravar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
