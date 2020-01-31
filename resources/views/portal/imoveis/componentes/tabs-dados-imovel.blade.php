

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0">
                <ul class="nav nav-tabs d-flex justify-content-between" id="custom-tabs-one-tab" role="tablist">
                  
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-dados-tab" data-toggle="pill" href="#custom-tabs-one-dados" role="tab" aria-controls="custom-tabs-one-dados" aria-selected="true">
                            <h5>Dados do Imóvel</h5>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-leiloes-tab" data-toggle="pill" href="#custom-tabs-one-leiloes" role="tab" aria-controls="custom-tabs-one-leiloes" aria-selected="false">
                            <h5>Leilões</h5>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-contratacao-tab" data-toggle="pill" href="#custom-tabs-one-contratacao" role="tab" aria-controls="custom-tabs-one-contratacao" aria-selected="false">
                            <h5>Contratação</h5>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-distrato-tab" data-toggle="pill" href="#custom-tabs-one-distrato" role="tab" aria-controls="custom-tabs-one-distrato" aria-selected="false">
                            <h5>Distrato</h5>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-historico-tab" data-toggle="pill" href="#custom-tabs-one-historico" role="tab" aria-controls="custom-tabs-one-historico" aria-selected="false">
                            <h5>Histórico</h5>
                        </a>
                    </li>

                    <li class="nav-item">
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
                                <h2 class="card-title"><b>Trajetória do Imóvel</b></h2>
                                <br>
                                <div class="card-body pb-0" id="progressBarGeral"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Dossiê Digital:</label>
                                    <br>
                                    <button class="btn btn-outline-primary ml-2" data-toggle="tooltip" data-placement="top" title="Copiar link" onclick="copyToClipboard('#linkServidor')"><i class="far fa-copy"></i></button>
                                    <a href="file://///sp7257sr001/PUBLIC/EstoqueImoveis/{{ $numeroContrato ?? '' }}" id="linkServidor">\\sp7257sr001\PUBLIC\EstoqueImoveis\{{ $numeroContrato ?? '' }}</a>
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Descrição do Imóvel:</label>
                                    <p id="descricaoImovel"></p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Descrição Adicional:</label>
                                    <p id="descricaoAdicionalImovel"></p>
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
                        
                        <!-- <div class="row"> -->
                            <!-- <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Valor de Avaliação:</label>
                                    <p id="valorAvaliacao"></p>
                                </div>
                            </div> -->
                            <!-- <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Origem do Imóvel:</label>
                                    <p id="origemImovel"></p>
                                </div>
                            </div> -->
                        <!-- </div> -->

                    </div>

                    <div class="tab-pane fade" id="custom-tabs-one-leiloes" role="tabpanel" aria-labelledby="custom-tabs-one-leiloes-tab">
                        
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Valor no Primeiro Leilão:</label>
                                    <p id="valorPrimeiroLeilao"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Valor no Segundo Leilão:</label>
                                    <p id="valorSegundoLeilao"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Valor de Venda:</label>
                                    <p id="valorVenda"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Valor Contábil:</label>
                                    <p id="valorContabil"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Data de Consolidação:</label>
                                    <p id="dataConsolidacao"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Agrupamento Leilão:</label>
                                    <p id="agrupamentoLeilao"></p>
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
                                    <label>Data Arremate:</label>
                                    <p id="dataArremate" class="formata-data-sem-hora"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Data Primeiro Leilão:</label>
                                    <p id="dataPrimeiroLeilao" class="formata-data-sem-hora"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Data Segundo Leilão:</label>
                                    <p id="dataSegundoLeilao" class="formata-data-sem-hora"></p>
                                </div>
                            </div>
                            <!-- <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Número do Item:</label>
                                    <p id="numeroItem"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Data Arremate:</label>
                                    <p id="dataArremate" class="formata-data-sem-hora"></p>
                                </div>
                            </div> -->
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
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Total Recebido:</label>
                                    <p id="valorTotalRecebido"></p>
                                </div>
                            </div>
                        </div>

                        <hr class="pontilhado">

                        <h2 class="card-title"><b>Conformidade</b></h2>

                        <br>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Status Conformidade:</label>
                                    <p id="nomeStatusDossie"></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Card Agrupamento:</label>
                                    <p id="cardAgrupamentoConformidade"></p>
                                </div>
                            </div>
                        </div>

                        <hr class="pontilhado">

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

                        <hr>




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
                                <table id="tblHistorico" class="table table-bordered table-striped dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Matrícula</th>
                                            <th>Tipo</th>
                                            <th>Atividade</th>
                                            <th>Observação</th>
                                            <th>Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="custom-tabs-one-mensagens" role="tabpanel" aria-labelledby="custom-tabs-one-mensagens-tab">
                        <div class="row">
                            <div class="col-sm-12">
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