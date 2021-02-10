var csrfVar = $('meta[name="csrf-token"]').attr('content');
$.fn.dataTable.ext.errMode = 'none';
/**********************\
| Config inicial Toast |
\**********************/

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

// pegar a data de hoje para atualizar "ultimo tratamento"
Date.prototype.getMonthFormatted = function() {
	var month = this.getMonth() + 1;
	return month < 10 ? '0' + month : month;
}
Date.prototype.getDateFormatted = function() {
	var date = this.getDate();
	return date < 10 ? '0' + date : date;
}
var d = new Date();
var strDate = d.getDateFormatted() + "/" + d.getMonthFormatted() + "/" + d.getFullYear();


$(document).ready(function(){
    $(".menu-hamburguer").click();

    $.when($.getJSON('/estoque-imoveis/conformidade-contratacao/listar-contratos', function(dados){
        $.each(dados, function(key, item) {
           var dataRetorno =  moment(item.dataRetorno).format("DD/MM/YYYY")
            elementoLinkServidor = "'#linkServidor" + item.numeroContrato + "'";
            var linha =
            `
            <tr>
                <td><a href="/consulta-bem-imovel/${item.contratoFormatado}" class="cursor-pointer">${item.numeroContrato}</a></td>
                <td>${item.tipoVenda}</td>
                <td>${item.dataEntradaConformidade}</td>
                <td>${item.tipoProposta}</td>
                <td>${item.statusContratacao}</td>
                <td>
                    <div class="row ml-2">
                    
                    <!--
                        <div>
                            <button id="btnLinkServidor" onclick="copyToClipboard(${elementoLinkServidor})" class="btn btn-outline-primary ml-2 mb-2" data-toggle="tooltip" data-placement="top" title="Copiar link"><i class="far fa-copy"></i></button>
                            <a href="file://///arquivos.caixa/sp/SP7257FS201/PUBLICO/PUBLIC/EstoqueImoveis/${item.contratoFormatado}" id="linkServidor${item.numeroContrato}" hidden>\\\\arquivos.caixa\\sp\\SP7257FS201\\PUBLICO\\PUBLIC\\EstoqueImoveis\\${item.contratoFormatado}</a>&nbsp&nbsp&nbsp&nbsp
                        </div>
                    -->
                    
                    <div>
                        <button id="${item.numeroContrato}" type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalOBS${item.numeroContrato}"><i class="fas fa-info-circle"></i>
                        </button>&nbsp&nbsp&nbsp&nbsp
                    </div>
                    <div>
                        <button onclick="datepicker()" id="botaoOpcao${item.numeroContrato}" type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalOpcao${item.numeroContrato}"><i class="far fa-edit"></i>
                        </button>
                    </div>
                    <div class="divBotao'+item.numeroContrato+'" style="display: none;">
                        <button id="botaoContato${item.numeroContrato}" type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalContato${item.numeroContrato}"><i class="far fa-envelope"></i>
                        </button>
                    </div>

                    <!-- Modal de Observação -->

                    <div class="modal fade" id="modalOBS${item.numeroContrato}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">
                                    <h5 style="color: white;" class="modal-title" id="exampleModalLabel">Observação</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body" id="modal${item.numeroContrato}">
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal Controle e-mails -->

                    <div class="modal fade" id="modalOpcao${item.numeroContrato}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">
                                    <h5 style="color: white;" class="modal-title" id="exampleModalLabel">Escolha a melhor opção para situação do contrato ${item.contratoFormatado}:</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="modal${item.numeroContrato}">
                                    
                                <!--
                                    <button type="button" class="btn btn-link tooltip-col" data-toggle="modal" data-target="#modalGerarPropostaSiopi${item.numeroContrato}" title="teste"><i class="far fa-sticky-note"></i><p>Gerar Proposta SIOPI</p><span class="tooltiptext4"><br>Síntese da atividade: <br><hr><br> este é um teste</span>
                                    </button>&nbsp&nbsp
                                -->

                                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalGerarPropostaSiopi${item.numeroContrato}"><i class="far fa-sticky-note"></i><p>Gerar Proposta SIOPI</p></button>&nbsp&nbsp

                                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalVincularPropostaSiopi${item.numeroContrato}"><i class="fas fa-link"></i><p>Vincular Proposta SIOPI</p></button>&nbsp&nbsp
                                    
                                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalEfetivarAssinaturaContrato${item.numeroContrato}"><i class="fas fa-file-signature"></i><p>Efetivar Assinatura Contrato</p></button>&nbsp&nbsp
                                    
                                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalInconformeSiiac${item.numeroContrato}"><i class="fas fa-exclamation"></i><p>Inconforme SIIAC</p></button>&nbsp&nbsp</br></br>
                                    
                                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalDossieGilie${item.numeroContrato}"><i class="fas fa-archive"></i><p>Dossiê GILIE</p></button>&nbsp&nbsp
                                    
                                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalDossieAgencia${item.numeroContrato}"><i class="fas fa-store-alt"></i><p>Dossiê Agência</p></button>&nbsp&nbsp
                                    
                                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalOutros${item.numeroContrato}"><i class="fas fa-th-large"></i><p>Outros</p></button><br>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modalGerarPropostaSiopi${item.numeroContrato}" tabindex="-1" role="dialog" aria-labelledby="ModalLabelGerarPropostaSiopi" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ModalLabelGerarPropostaSiopi"><b>Contrato ${item.contratoFormatado}</b> | Situação: Em conformidade no SIIAC e sem proposta no SIOPI</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form method="POST" action="conformidade-contratacao/gerar-proposta-siouv-mail/${item.contratoFormatado}" id="formGerarPropostaSiopi${item.contratoFormatado}">
                                    <div class="modal-body">
                                        <input type="hidden" name="_token" value="${csrfVar}">
                                        <input type="hidden" name="contratoFormatado" value="${item.contratoFormatado}">
                                    
                                        <p>Caso o processo esteja em conformidade no SIIAC nas opções TRIAGEM GILIE e TRIAGEM AGÊNCIA, deve-se observar a movimentação da contratação no SIOPI.</p>
                                        
                                        <p>Importante:</p>
                                        <ul>
                                            <li>Verificar se o laudo de avaliação está válido e apresenta 540 dias de validade para permitir vinculação</li>
                                        </ul>
                                        <hr>

                                        <div class="form-group">
                                            <label for="formPrazo${item.numeroContrato}">Informar prazo de retorno da Agência</label>
                                            <input type="date" class="form-control datepicker" name="prazoAtendimentoAgencia" autocomplete="off" id="formPrazo${item.numeroContrato}" placeholder="Selecione data no calendário..." required size="32">
                                            <small class="form-text text-muted">**Campo Obrigatório</small>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                
                    <div class="modal fade" id="modalVincularPropostaSiopi${item.numeroContrato}" tabindex="-1" role="dialog" aria-labelledby="ModalLabelVincularPropostaSiopi" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ModalLabelVincularPropostaSiopi"><b>Contrato ${item.contratoFormatado}</b> | Situação: Em conformidade no SIIAC e proposta não vinculada ao imóvel</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form method="post" action="conformidade-contratacao/vincular-proposta-siouv-mail/${item.contratoFormatado}" id="formVincularPropostaSiopi${item.contratoFormatado}">
                                    <div class="modal-body">
                                        <input type="hidden" name="_token" value="${csrfVar}">
                                        <input type="hidden" name="contratoFormatado" value="${item.contratoFormatado}">

                                        <p>Caso o processo esteja em conformidade no SIIAC nas opções TRIAGEM GILIE e TRIAGEM AGÊNCIA, deve-se observar a movimentação da contratação no SIOPI.</p>
                                        
                                        <p>Importante:</p>
                                        <ul>
                                            <li>Verificar se taxa já foi isenta e vinculada à proposta</li>
                                            <li>Observar se o laudo de avaliação está válido e apresenta 540 dias de validade</li>
                                            <li>Verificar se no imóvel não consta proposta anterior bloqueando o imóvel</li>
                                        </ul>
                                        <hr>

                                        <div class="form-group">
                                            <label for="formPrazo${item.numeroContrato}">Informar prazo de retorno da Agência</label>
                                            <input type="date" class="form-control datepicker" name="prazoAtendimentoAgencia" autocomplete="off" id="formPrazoVincular${item.numeroContrato}" placeholder="Selecione data no calendário..." required>
                                            <small class="form-text text-muted">**Campo Obrigatório</small>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                    </div>                                        
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                  
                    <div class="modal fade" id="modalEfetivarAssinaturaContrato${item.numeroContrato}" tabindex="-1" role="dialog" aria-labelledby="ModalLabelEfetivarAssinaturaContrato" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ModalLabelEfetivarAssinaturaContrato"><b>Contrato ${item.contratoFormatado}</b> | Situação: Em conformidade no SIIAC, proposta gerada e vinculada no SIOPI, falta apenas a emissão de contrato</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form method="post" action="conformidade-contratacao/efetivar-assinatura-mail/${item.contratoFormatado}" id="formEfetivarAssinaturaContrato${item.contratoFormatado}">
                                    <div class="modal-body">
                                        <input type="hidden" name="_token" value="${csrfVar}">
                                        <input type="hidden" name="contratoFormatado" value="${item.contratoFormatado}">

                                        <p>Caso o processo esteja em conformidade no SIIAC nas opções TRIAGEM GILIE e TRIAGEM AGÊNCIA, deve-se observar a movimentação da contratação no SIOPI.</p>
                                        <p>Importante:</p>
                                        <ul>
                                            <li>Verificar no CIWEB se o contrato novo apresenta TP 025</li>
                                            <li style="color: red;"><strong>Atenção:</strong> caso seja observado que há TP 025 LIB/PEND/ATU para o novo contrato, não será necessário o envio do presente e-mail, apenas proceder com os acertos contábeis.</li>
                                            <li>OBS: Para verificar o status do TP025:
                                                <ul>
                                                    <li> <a href="http://ciweb4.extranet.caixa/sso/" target="_blank">Ciweb</a> &rarr; pesquisar pelo CPF do proponente &rarr; tela CPE </li>
                                                    ou
                                                    <li> <a href="http://siopi.caixa/siopi-web/" target="_blank">SIOPI</a> &rarr; Proposta individual PF/PJ &rarr; clicar na proposta desejada (comparar endereço do imóvel) número do contrato será escrito no lado direito da tela </li>
                                                </ul> 
                                            </li>
                                        </ul>
                                        <hr>
                                        
                                        <div class="form-group">
                                            <label for="formPrazo${item.numeroContrato}">Informar prazo de retorno da Agência</label>
                                            <input type="date" class="form-control datepicker" name="prazoAtendimentoAgencia" autocomplete="off" id="formPrazoAssinatura${item.numeroContrato}" placeholder="Selecione data no calendário..." required>
                                            <small class="form-text text-muted">**Campo Obrigatório</small>
                                        </div>
                                    </div>                                        
                                    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                          
                    
                    <div class="modal fade" id="modalInconformeSiiac${item.numeroContrato}" tabindex="-1" role="dialog" aria-labelledby="ModalLabelInconformeSiiac" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ModalLabelInconformeSiiac"><b>Contrato ${item.contratoFormatado}</b> | Situação: A documentação está inconforme no SIIAC e necessita de ação da agência para regularização</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form method="post" action="conformidade-contratacao/inconformidade-siiac-mail/${item.contratoFormatado}" id="formInconformeSiiac${item.contratoFormatado}" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input type="hidden" name="_token" value="${csrfVar}">
                                        <input type="hidden" name="contratoFormatado" value="${item.contratoFormatado}">
 
                                        <p>Considerando-se Fluxo Agência, observar a necessidade de enviar dossiê inicial ou regularização de inconformidade no endereço <a href="http://retaguarda.caixa/digitalizar/#/" target="_blank">http://retaguarda.caixa/digitalizar/#/</a> - Aba Digitalização Pendente </p>
                                        
                                        <p>Importante:</p>
                                        <ul>
                                            <li>Anexar PA, disponível ao analisar o CPF do proponente em <a href="http://siiac.caixa/jsp/index.cef" target="_blank">http://siiac.caixa/jsp/index.cef</a></li>
                                        </ul>
                                        <hr>

                                        <div class="form-group">
                                            <label for="formPrazo${item.numeroContrato}">Informar prazo de retorno da Agência</label>
                                            <input type="date" class="form-control datepicker" name="prazoAtendimentoAgencia" autocomplete="off" id="formPrazoInconforme${item.numeroContrato}" placeholder="Selecione data no calendário..." required>
                                            <small class="form-text text-muted">**Campo Obrigatório</small>
                                        </div>                                        
                                    
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Observações:</label>
                                            <textarea class="form-control" name="obsInconformeSiiac" id="obsInconformeSiiac"></textarea>
                                            <small class="form-text text-muted">**Campo opcional</small>
                                        </div>
                                        
                                        <div class="form-group"> 
                                            <input type="file" name="attachment" class="fupload form-control-file" required>
                                            <small class="form-text text-muted">**Campo Obrigatório** Máx. 2MB</small>
                                            <label for="fupload" class="control-label label-bordered inputFile"></label>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modalDossieGilie${item.numeroContrato}" tabindex="-1" role="dialog" aria-labelledby="ModalLabelDossieGilie" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ModalLabelDossieGilie"><b>Contrato ${item.contratoFormatado}</b> | Situação: A documentação inicial não foi enviada no fila única pela GILIE e necessita de ação da agência para envio</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form method="post" action="conformidade-contratacao/dossie-gilie-mail/${item.contratoFormatado}" id="formDossieGilie${item.contratoFormatado}">
                                    <div class="modal-body">
                                        <input type="hidden" name="_token" value="${csrfVar}">
                                        <input type="hidden" name="contratoFormatado" value="${item.contratoFormatado}">
                                        
                                        <p>Considerando-se Fluxo Agência, observar a necessidade de enviar dossiê inicial ou regularização de inconformidade no endereço <a href="http://retaguarda.caixa/digitalizar/#/digitalizacaoPendente" target="_blank">http://retaguarda.caixa/digitalizar/#/</a> - Aba Digitalização Pendente.</p>

                                        <p>Status AGUARDA DOCS GILIE no <a href="http://retaguarda.caixa/digitalizar/#/" target="_blank">http://retaguarda.caixa/digitalizar/#/</a> - Aba Processos Digitalizados</p>
                               
                                        <hr>
                                            
                                        <p><strong>Itens a serem enviados pela Agência:</strong></p>
                                        
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="docIdent" id="docIdent" name="docIdent">
                                            <label class="form-check-label" for="docIdent">Documento de Identificação (RG/CNH/etc)<b style="color:red;"> *CO 020</b></label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="compEndereco" name="compEndereco" id="compEndereco">
                                            <label class="form-check-label" for="compEndereco">Comprovante de Endereço<b style="color:red;"> *CO 020</b></label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="compRenda" id="compRenda" name="compRenda">
                                            <label class="form-check-label" for="compRenda">Comprovante de Renda<b style="color:red;"> *CR016</b></label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="certNascCas" id="certNascCas" name="certNascCas">
                                            <label class="form-check-label" for="certNascCas">Certidão de Nascimento/Casamento</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="compPagto" id="compPagto" name="compPagto">
                                            <label class="form-check-label" for="compPagto">Comprovante de Pagamento de Entrada (PP15 ou boleto <b>e</b> respectivo comprovante)</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="impRenda" id="impRenda" name="impRenda">
                                            <label class="form-check-label" for="impRenda">Imposto de Renda Completo (Apenas recibo não basta) OU <b style="color:red;"> *MO29899</b></label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="formEnc" id="formEnc" name="formEnc">
                                            <label class="form-check-label" for="formEnc">Formulário de Encaminhamento de Demanda<b style="color:red;"> *PF MO19601 PJ MO19602</b></label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="propCompra" id="propCompra" name="propCompra">
                                            <label class="form-check-label" for="propCompra">Proposta de Compra / Termo de Arrematação<b style="color:red;"> *MO19570</b></label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="termoDir" id="termoDir" name="termoDir">
                                            <label class="form-check-label" for="termoDir">Termo de Aquisição por Exercício de Direito de Preferência<b style="color:red;"> *MO28097</b></label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="declNeg" id="declNeg" name="declNeg">
                                            <label class="form-check-label" for="declNeg">Declaração Negativa de Propriedade do Imóvel<b style="color:red;"> *MO29898</b></label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="certIptu" id="certIptu" name="certIptu">
                                            <label class="form-check-label" for="certIptu">Certidão de IPTU na prefeitura demonstrando endereço atualizado</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="matrImov" id="matrImov" name="matrImov">
                                            <label class="form-check-label" for="matrImov">Matrícula do Imóvel - verificar se ao mandar é possível "puxar" matrícula e cartório</label>
                                        </div> 
                                        <br>
                                    
                                        <div class="form-group">
                                            <label for="formPrazo${item.numeroContrato}">Informar prazo de retorno da Agência</label>
                                            <input type="date" class="form-control datepicker" name="prazoAtendimentoAgencia" autocomplete="off" id="formPrazoGilie${item.numeroContrato}" placeholder="Selecione data no calendário..." required>
                                            <small class="form-text text-muted">**Campo Obrigatório</small>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                

                    <div class="modal fade" id="modalDossieAgencia${item.numeroContrato}" tabindex="-1" role="dialog" aria-labelledby="ModalLabelDossieAgencia" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ModalLabelDossieAgencia"><b>Contrato ${item.contratoFormatado}</b> | Situação: A documentação inicial não foi enviada no fila única da agência após DOSSIE GILIE no siiac.caixa estar em conformidade</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form method="post" action="conformidade-contratacao/dossie-agencia-mail/${item.contratoFormatado}" id="formDossieAgencia${item.contratoFormatado}">
                                
                                    <div class="modal-body">
                                        <input type="hidden" name="_token" value="${csrfVar}">
                                        <input type="hidden" name="contratoFormatado" value="${item.contratoFormatado}">
                                    
                                        <p>Considerando-se Fluxo Agência, observar a necessidade de enviar dossiê inicial ou regularização de inconformidade no endereço <a href="http://retaguarda.caixa/digitalizar/#/digitalizacaoPendente" target="_blank">http://retaguarda.caixa/digitalizar/#/</a> - Aba Digitalização Pendente.</p>

                                        <p>Status AGUARDA DOCS GILIE no <a href="http://retaguarda.caixa/digitalizar/#/" target="_blank">http://retaguarda.caixa/digitalizar/#/</a> - Aba Processos Digitalizados</p>
                               
                                        <hr>
                                    
                                        <p><strong>Itens a serem enviados pela Agência:</strong></p>
                                        
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="docIdent" id="docIdentAg" name="docIdent">
                                            <label class="form-check-label" for="docIdentAg">Documento de Identificação (RG/CNH/etc)<b style="color:red;"> *CO 020</b></label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="compEndereco" name="compEndereco" id="compEnderecoAg">
                                            <label class="form-check-label" for="compEnderecoAg">Comprovante de Endereço<b style="color:red;"> *CO 020</b></label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="compRenda" id="compRendaAg" name="compRenda">
                                            <label class="form-check-label" for="compRendaAg">Comprovante de Renda<b style="color:red;"> *CR016</b></label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="certNascCas" id="certNascCasAg" name="certNascCas">
                                            <label class="form-check-label" for="certNascCasAg">Certidão de Nascimento/Casamento</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="compPagto" id="compPagtoAg" name="compPagto">
                                            <label class="form-check-label" for="compPagtoAg">Comprovante de Pagamento de Entrada (PP15 ou boleto <b>e</b> respectivo comprovante)</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="impRenda" id="impRendaAg" name="impRenda">
                                            <label class="form-check-label" for="impRendaAg">Imposto de Renda Completo (Apenas recibo não basta) OU <b style="color:red;"> *MO29899</b></label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="formEnc" id="formEncAg" name="formEnc">
                                            <label class="form-check-label" for="formEncAg">Formulário de Encaminhamento de Demanda<b style="color:red;"> *PF MO19601 PJ MO19602</b></label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="propCompra" id="propCompraAg" name="propCompra">
                                            <label class="form-check-label" for="propCompraAg">Proposta de Compra / Termo de Arrematação<b style="color:red;"> *MO19570</b></label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="termoDir" id="termoDirAg" name="termoDir">
                                            <label class="form-check-label" for="termoDirAg">Termo de Aquisição por Exercício de Direito de Preferência<b style="color:red;"> *MO28097</b></label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="declNeg" id="declNegAg" name="declNeg">
                                            <label class="form-check-label" for="declNegAg">Declaração Negativa de Propriedade do Imóvel<b style="color:red;"> *MO29898</b></label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="certIptu" id="certIptuAg" name="certIptu">
                                            <label class="form-check-label" for="certIptuAg">Certidão de IPTU na prefeitura demonstrando endereço atualizado</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="matrImov" id="matrImovAg" name="matrImov">
                                            <label class="form-check-label" for="matrImovAg">Matrícula do Imóvel - verificar se ao mandar é possível "puxar" matrícula e cartório</label>
                                        </div> 
                                        <br>

                                        <div class="form-group">
                                            <label for="formPrazo${item.numeroContrato}">Informar prazo de retorno da Agência</label>
                                            <input type="date" class="form-control datepicker" name="prazoAtendimentoAgencia" autocomplete="off" id="formPrazoAgencia${item.numeroContrato}" placeholder="Selecione data no calendário..." required>
                                            <small class="form-text text-muted">**Campo Obrigatório</small>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                
                    <div class="modal fade" id="modalOutros${item.numeroContrato}" tabindex="-1" role="dialog" aria-labelledby="ModalLabelOutros" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalLabelOutros"><b>Contrato ${item.contratoFormatado}</b> | Situação: Outros</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <form method="post" action="conformidade-contratacao/outros-agencia-mail/${item.contratoFormatado}" id="formOutros${item.contratoFormatado}" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <input type="hidden" name="_token" value="${csrfVar}">
                                    <input type="hidden" name="contratoFormatado" value="${item.contratoFormatado}">
                                
                                    <p>Será apenas utilizado corpo do e-mail.</p>
                                    <p>Cabe ao analista formular e-mail e salvar na respectiva pasta no servidor.</p>
                                    <hr>

                                    <div class="form-group">
                                        <label for="obsOutros${item.numeroContrato}">Digite os parágrafos a serem acrescentados no e-mail:</label>
                                        <textarea class="form-control" id="obsOutros${item.numeroContrato}" rows="3" name="textoEmail" required></textarea>
                                        <small class="form-text text-muted">**Campo Obrigatório</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="formPrazo${item.numeroContrato}">Informar prazo de retorno da Agência</label>
                                        <input type="date" class="form-control datepicker" name="prazoAtendimentoAgencia" autocomplete="off" id="formPrazoOutros${item.numeroContrato}" placeholder="Selecione data no calendário..." required>
                                        <small class="form-text text-muted">**Campo Obrigatório</small>
                                    </div>
                                    
                                    <div class="form-group"> 
                                        <input type="file" name="attachment" class="fupload form-control-file">
                                        <small class="form-text text-muted">**Máx. 2MB</small>
                                        <label for="fupload" class="control-label label-bordered inputFile"></label>
                                    </div>
                                    
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>




            
                    <!-- Modal de contato -->

                    <div class="modal fade" id="modalContato${item.numeroContrato}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                            <div class="modal-content">
                                <div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">
                                    <h5 style="color: white;" class="modal-title" id="exampleModalLabel">Enviar Mensagem</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div><br>

                <!--     
                                <div class="container">
                                    <p class="ml-3">Deseja enviar um email cobrando o andamento do processo <b>${item.contratoFormatado}</b><br> 
                                    em nome de <b>${item.nomeProponente} </b> para a agência: <b>${item.codigoAgencia}</b></p>
                                </div>

                -->
                                <div class="modal-body" id="formContato${item.numeroContrato}">
                                </div>
                            </div>
                        </div>
                    </div>
               <td class="formata-data-sem-horas" id="novoHistorico${item.numeroContrato}"></td>
               <td>${dataRetorno}</td>
            </tr>
            `

            
            if (item.cardAgrupamento == "Agência" && item.sinalPago == "SIM" && item.tipoProposta != "A vista com recursos proprios" ) {
                $(linha).appendTo('#tblCardAgrupamentoAgencia>tbody');
                $('.divBotao'+item.numeroContrato).show()
            } else if (item.fluxoContratacao == "AG" && item.sinalPago == "SIM" && item.tipoProposta != "A vista com recursos proprios") {
                $(linha).appendTo('#tblConformidadeFluxoAgencia>tbody');
            } else if (item.fluxoContratacao == "CCA" && item.sinalPago == "SIM" && item.tipoProposta != "A vista com recursos proprios"){ 
                $(linha).appendTo('#tblConformidadeFluxoCca>tbody');
            } else if (item.cardAgrupamento == null && item.sinalPago == "SIM" && item.tipoProposta != "A vista com recursos proprios"){ 
                $(linha).appendTo('#tblCardAgrupamentoAgencia>tbody');
            }

            // else {
            //     $(linha).appendTo('#tblCardAgrupamentoAgencia>tbody');
            //     $('.divBotao'+item.numeroContrato).show()
            // }

            // if (item.tipoHistorico == "CONTRATACAO" || item.tipoHistorico == "DISTRATO" ||
            //     item.tipoHistorico == "PAGAMENTO" || item.tipoHistorico == "PREPARACAO" ||
            //     item.tipoHistorico == "CONFORMIDADE CONTRATAÇÃO" || item.tipoHistorico == "AVERBACAO" ||
            //     item.tipoHistorico == "EMGEA" ||
            //     item.tipoHistorico == "LEILÃO NEGATIVO" || item.tipoHistorico == "ATENDE") 
            // {
            //     $('#novoHistorico'+item.numeroContrato).text("")
            //  }
      

           
 

        $('#'+item.numeroContrato).click(function() {
        $.get( '/estoque-imoveis/consulta-historico-contrato/'+item.contratoFormatado, function(data) {
           
            var form =
                    '<form id="formEnviodeObs'+ item.numeroContrato+'" method="post" action="/estoque-imoveis/conformidade-contratacao/registrar-historico/' + item.contratoFormatado+ '">' +
                        '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                        '<input type="hidden" name="tipoAtendimento" value="ANALISE"></input>'+
                        '<input type="hidden" name="atividadeAtendimento" value="CONFORMIDADE"></input>'+
                        '<p>Contrato: <b>'+  item.contratoFormatado + '</b></p>' +

                        '<p>Última Observação </p>'+
                        '<span id="ultimaOBS'+ item.numeroContrato+'"></span>'+

                        '<div class="form-group">'+
                        '<p>Nova Observação </p>' +
                            '<textarea name="observacaoAtendimento" class="form-control" rows="5" required></textarea>'+
                        '</div>'+
                    '<div class="modal-footer">'+
                        '<button type="button" class="btn btn-secondary" data-dismiss="modal">'+'Voltar'+'</button>'+
                        '<button type="submit" class="btn btn-primary">'+'Gravar'+'</button>'+
                    '</div>'+
                    '</form>'

            $('#modal'+item.numeroContrato).html(form)

            let resultado = JSON.parse(data)
            $.each(resultado.historico, function(chave, valor) {
                let analisaTipo = valor.atividade
                let formataData = valor.data
                var novaData = formataData.replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1');
                
                if (analisaTipo == "CONFORMIDADE" || analisaTipo == "COBRANCA"){
                let toString = valor.observacao.replace(/(<([^>]+)>)/ig,"");
                 let data = 
                 '<textarea class="form-control" rows="3" disabled>'+ toString +'</textarea>'+
                '<small class="form-text text-muted">'+ 'incluida em <b>'+novaData+'</b> por <b>'+valor.matriculaResponsavel+'</b>.</small><br>'
                 $('#ultimaOBS'+ item.numeroContrato).html(data)
                }
            })
            $('#formEnviodeObs'+item.numeroContrato).submit( function(e) {

                e.preventDefault();
                let datas = JSON.stringify( $(this).serialize() );
                let url = $(this).attr('action');
                let method = $(this).attr('method');
                // console.log(datas);
                // console.log(url);
                // console.log(method);
                
                $.ajax({
                    type: method,
                    url: url,
                    // data: {datas, csrfVar},
                    data: $(this).serialize(),
                    success: function (result){
                        
                        $('.modal').modal('hide');

                        Toast.fire({
                            icon: 'success',
                            title: 'Alteração salva!'
                        });
                        $('#novoHistorico'+ item.numeroContrato).text(strDate)
                    },
                  
                    error: function () {
                        
                        $('.modal').modal('hide');
            
                        Toast.fire({
                            icon: 'error',
                            title: 'Erro: alteração não efetuada!'
                        });
                    }
                });
            
            })
        })
    })


    $('#botaoContato'+item.numeroContrato).click(function() {
        $.get( '/estoque-imoveis/consulta-historico-contrato/'+item.contratoFormatado, function(data) {

            var formCobrancaAgencia = 

                    '<form id="formEnviodeCobrancaAgencia'+ item.numeroContrato+'" method="post" action="/estoque-imoveis/conformidade-contratacao/mensagem">' +
                        '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                        // '<input type="hidden" name="tipoAtendimento" value="ANALISE"></input>'+
                        // '<input type="hidden" name="atividadeAtendimento" value="COBRANCA"></input>'+
                        '<input type="hidden" name="emailAgencia" value="'+  item.emailAgencia +'"></input>'+
                        '<input type="hidden" name="nomeProponente" value="'+  item.nomeProponente +'"></input>'+
                        '<input type="hidden" name="contratoFormatado" value="'+  item.contratoFormatado +'"></input>'+
                        '<input type="hidden" name="codigoAgencia" value="'+  item.codigoAgencia +'"></input>'+
                        '<input type="hidden" name="gilieDeVinculacao" value="'+  item.gilieDeVinculacao +'"></input>'+

                        '<div class="form-group">'+
                        '<p>Incluir Mensagem : </p>' +
                            '<textarea name="observacaoAtendimento" class="form-control" rows="5" required></textarea>'+
                        '</div>'+

                        '<div class="form-group">'+
                        '<button id="btnToggle'+item.numeroContrato+'" type="button" class="btn btn-primary">Modelo de Cobrança</button><br><br>'+
                        
                        '<div contenteditable="true" id="toggleModelo'+item.numeroContrato+'" style="display: none;">À <br> AG '+ item.codigoAgencia+'<br>'+
                        'A/C <br>'+
                        'Setor de Habitação <br><br>'+
                        '1. Até o presente momento não identificamos a finalização do processo de contratação referente o imóvel <b>' +item.contratoFormatado+ '</b> em nome de <b>'+ item.nomeProponente+'</b><br><br>'+

                        '2. Solicitamos retorno com a data prevista de finalização ou os motivos que impossibilitam a conclusão do financiamento. <br><br>'+

                        '3. À disposição para esclarecimentos. <br><br>'+

                        'Atenciosamente, <br><br>'+

                        item.gilieDeVinculacao +
                        
                        
                        '</div>'+
                        '</div>'+


                    '<div class="modal-footer">'+
                        '<button type="button" class="btn btn-secondary" data-dismiss="modal">'+'Voltar'+'</button>'+
                        '<button type="submit" class="btn btn-primary">'+'Enviar'+'</button>'+
                    '</div>'+
                    '</form>'


                   
            $('#formContato'+item.numeroContrato).html(formCobrancaAgencia)
            
            $('#btnToggle'+item.numeroContrato).click(function() {
                $('#toggleModelo'+item.numeroContrato).toggle();
              });

            // let resultado = JSON.parse(data)
            // $.each(resultado.historico, function(chave, valor) {
            //     let analisaTipo = valor.atividade
            //     let formataData = valor.data
            //     let novaData = formataData.replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1');
                
            //     if (analisaTipo == "COBRANCA"){
            //     let toString = valor.observacao.replace(/(<([^>]+)>)/ig,"");
            //      let data = 
            //      '<textarea class="form-control" rows="3" disabled>'+ toString +'</textarea>'+
            //     '<small class="form-text text-muted">'+ 'incluida em <b>'+novaData+'</b> por <b>'+valor.matriculaResponsavel+'</b>.</small><br>'

            //      $('#ultimaOBSCobrancaAgencia'+ item.numeroContrato).html(data)
            //     }
            // })
            $('#formEnviodeCobrancaAgencia'+item.numeroContrato).submit( function(e) {

                e.preventDefault();
               
                
                let datas = JSON.stringify( $(this).serialize() );
                let url = $(this).attr('action');
                let method = $(this).attr('method');
            
                // console.log(datas);
                // console.log(url);
                // console.log(method);
                
                $.ajax({
                    type: method,
                    url: url,
                    // data: {datas, csrfVar},
                    data: $(this).serialize(),
                    success: function (result){
                        
                        $('.modal').modal('hide');
                    
                        Toast.fire({
                            icon: 'success',
                            title: 'Email enviado!'
                        });
                        $('#novoHistorico'+ item.numeroContrato).text(strDate)
                    },
                  
                    error: function () {
                        
                        $('.modal').modal('hide');
            
                        Toast.fire({
                            icon: 'error',
                            title: 'Erro: Email não enviado. tente novamente!'
                        });
                    }
                    
                });
            
            })
        })
    })

        });
    })).done(function() {
        // _formataDatas()
        // _formataDatatableComData()
        $.getJSON('/estoque-imoveis/conformidade-contratacao/listar-data-conformidade', function(dados){
            $.each(dados, function(key, item) {
                var dateTime = moment(item.dataAlteração).format("YYYY-MM-DD");
                $('#novoHistorico'+ item.nuBem).text(item.dataAlteração)
            })
        }).done(function() { _formataDatatableComData()})
    })

})

$.when($.getJSON('/estoque-imoveis/acompanha-contratacao/listar-contratos-sem-pagamento-sinal', function(dados){
    $.each(dados, function(key, item) {  

        elementoServidorpag = "'#linkServidorpag" + item.NU_BEM + "'";
            
            let formataData = item.vencimentoPp15
            let novaData = formataData.replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1');
        
            let Novalinha = 
            '<tr>' +
            '<td><a href="/consulta-bem-imovel/'+ item.BEM_FORMATADO +'" class="cursor-pointer">' + item.NU_BEM + '</a></td>' +
                '<td class="formata-valores">' + item.VALOR_REC_PROPRIOS_PROPOSTA + '</td>' +
                '<td>' + novaData + '</td>' +
                '<td>' + item.STATUS_IMOVEL + '</td>' +
                '<td>'+ 
                    '<div class="row ml-2">' +
                    // '<div>'+
                    //     '<button id="btnLinkServidorpag" onclick="copyToClipboard(' + elementoServidorpag + ')" class="btn btn-outline-primary ml-2" data-toggle="tooltip" data-placement="top" title="Copiar link"><i class="far fa-copy"></i></button>' +
                    //     '<a href="file://///arquivos.caixa/sp/SP7257FS201/PUBLICO/PUBLIC/EstoqueImoveis/' + item.BEM_FORMATADO + '" id="linkServidorpag' + item.NU_BEM + '" hidden>\\\\arquivos.caixa\\sp\\SP7257FS201\\PUBLICO\\PUBLIC\\EstoqueImoveis\\'+ item.BEM_FORMATADO +'</a>&nbsp&nbsp&nbsp&nbsp' +
                    // '</div>' +
                '<div>'+
                '<button id="Pagamento'+item.NU_BEM+'" class="btn btn-primary" data-toggle="modal" data-target="#modalPagamento'+ item.NU_BEM+'"><i class="fas fa-info-circle"></i>'+'</button>&nbsp&nbsp&nbsp&nbsp'+
                '</div>'+

                '<div class="divBotao'+item.NU_BEM+'">'+
                '<button id="botaoContato'+item.NU_BEM+'" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalContatoPagamento'+ item.NU_BEM+'"><i class="far fa-envelope"></i>'+'</button>'+
                '</div>' +

                 // Modal de contato
               '<div class="modal fade" id="modalContatoPagamento'+ item.NU_BEM+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">'+
                '<div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">'+
                    '<div class="modal-content">'+
                            '<div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">' +
                                '<h5 style="color: white;" class="modal-title" id="exampleModalLabel">' + 'Enviar Mensagem' + '</h5>' +
                                '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                                '<span aria-hidden="true">&times;</span>'+
                                '</button>'+
                            '</div><br>'+
                            '<div class="modal-body" id="formContatoPagamento'+ item.NU_BEM+'">'+ 

                            '</div>'+
                        '</div>'+
                    '</div>'+
                   '</div>'+

                // Modal de Observação
                '<div class="modal fade" id="modalPagamento'+ item.NU_BEM+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">'+
                '<div class="modal-dialog" role="document">'+
                    '<div class="modal-content">'+
                    '<div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">' +
                    '<h5 style="color: white;" class="modal-title" id="exampleModalLabel">' + 'Observação' + '</h5>' +
                            '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                        '<span aria-hidden="true">&times;</span>'+
                        '</button>'+
                    '</div>'+
                    '<div class="modal-body" id="modalBodyPagamento'+ item.NU_BEM+'">'+
                    '</div>'+
                '</div>'+
                '</div>'+
                '</td>' +
                '<td class="formata-data-sem-hora" id="novoHistorico'+item.NU_BEM+'">' + item.updated_at + '</td>' +
            '</tr>';
        $(Novalinha).appendTo('#tblContratosSemPagamentoSinal>tbody');
 
        var formCobrancaPagamento = 

        '<form id="formEnviodeCobrancaAgencia'+ item.NU_BEM+'" method="post" action="/estoque-imoveis/conformidade-contratacao/mensagemPagamento">' +
            '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
            // '<input type="hidden" name="tipoAtendimento" value="ANALISE"></input>'+
            // '<input type="hidden" name="atividadeAtendimento" value="COBRANCA"></input>'+
            '<input type="hidden" name="bemFormatado" value="'+  item.BEM_FORMATADO +'"></input>'+

            '<p><span style="color: red;">* </span>E-mail proponente: <b>'+item.emailproponente+'</b></p>'+
            '<p id="corretor'+item.NU_BEM+'"><span style="color: red;">* </span>E-mail Corretor: <b>'+item.EMAIL_CORRETOR+'</b></p>'+

            '<div class="form-group">'+
            '<p>Incluir Mensagem : </p>' +
                '<textarea name="observacaoAtendimento" class="form-control" rows="5" required></textarea>'+
            '</div>'+

            '<label>Enviar para: </label>'+
            '<input type="email" class="form-control" name="emailContato" placeholder="email" required><br>'+

            '<div class="form-group">'+
            '<button id="btnToggle'+item.NU_BEM+'" type="button" class="btn btn-primary">Modelo de Cobrança</button><br><br>'+
            
            '<div contenteditable="true" id="toggleModelo'+item.NU_BEM+'" style="display: none;">À <br> '+ item.NOME_PROPONENTE+' ,<br>'+
            'Corretor(a): '+ item.NO_CORRETOR+' <br>'+
            'Setor de Habitação <br><br>'+
            '1. Solicitamos o envio do boleto/pp15 referente ao valor em Recursos próprios do cliente <b>'+ item.NOME_PROPONENTE+'</b>, não recebido até o momento.<br><br>'+

            '2. Aguardamos o envio do mesmo para prosseguimento da contratação referente ao imóvel adjudicado -'+item.BEM_FORMATADO +'. <br><br>'+

            '3. À disposição para esclarecimentos. <br><br>'+

            'Atenciosamente, <br><br>'+

            item.UNA +
            
            
            '</div>'+
            '</div>'+


        '<div class="modal-footer">'+
            '<button type="button" class="btn btn-secondary" data-dismiss="modal">'+'Voltar'+'</button>'+
            '<button type="submit" class="btn btn-primary">'+'Enviar'+'</button>'+
        '</div>'+
        '</form>'

            $('#formContatoPagamento'+item.NU_BEM).html(formCobrancaPagamento)

            $('#btnToggle'+item.NU_BEM).click(function() {
                $('#toggleModelo'+item.NU_BEM).toggle();
            });

            $('#formEnviodeCobrancaAgencia'+item.NU_BEM).submit( function(e) {

                e.preventDefault();
            
                
                let datas = JSON.stringify( $(this).serialize() );
                let url = $(this).attr('action');
                let method = $(this).attr('method');

                // console.log(datas);
                // console.log(url);
                // console.log(method);
                
                $.ajax({
                    type: method,
                    url: url,
                    // data: {datas, csrfVar},
                    data: $(this).serialize(),
                    success: function (result){
                        
                        $('.modal').modal('hide');
                    
                        Toast.fire({
                            icon: 'success',
                            title: 'Email enviado!'
                        });
                        $('#novoHistorico'+ item.NU_BEM).text(strDate)
                    },
                
                    error: function () {
                        
                        $('.modal').modal('hide');

                        Toast.fire({
                            icon: 'error',
                            title: 'Erro: Email não enviado. tente novamente!'
                        });
                    }
                    
                });

            })

        $('#Pagamento'+item.NU_BEM).click(function() {
            $.get( '/estoque-imoveis/consulta-historico-contrato/'+item.BEM_FORMATADO, function(data) {
                console.log(item.BEM_FORMATADO)
                var formPag =
                        '<form method="post" action="/estoque-imoveis/conformidade-contratacao/registrar-historico/' + item.BEM_FORMATADO+ '">' +
                            '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                            '<input type="hidden" name="tipoAtendimento" value="ANALISE"></input>'+
                            '<input type="hidden" name="atividadeAtendimento" value="COBRANCA"></input>'+
                            '<p>Contrato: <b>'+  item.BEM_FORMATADO + '</b></p>' +
    
                            '<p>Última Observação </p>'+
                            '<span id="ultimaObsPag'+ item.NU_BEM+'"></span>'+
    
                            '<div class="form-group">'+
                            '<p>Nova Observação </p>' +
                                '<textarea name="observacaoAtendimento" class="form-control" rows="5" required></textarea>'+
                            '</div>'+
                        '<div class="modal-footer">'+
                            '<button type="button" class="btn btn-secondary" data-dismiss="modal">'+'Voltar'+'</button>'+
                            '<button type="submit" class="btn btn-primary">'+'Gravar'+'</button>'+
                        '</div>'+
                        '</form>'
    
                $('#modalBodyPagamento'+item.NU_BEM).html(formPag)
                
                var Novoresultado = JSON.parse(data)
                $.each(Novoresultado.historico, function(chave, valor) {
                    
                    var analisaTipo = valor.atividade
                    var formataData = valor.data
                    var novaData = formataData.replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1');
                    
                    if (analisaTipo == "COBRANCA"){
                    let toString = valor.observacao.replace(/(<([^>]+)>)/ig,"");
                     var NovoDado = 
                     '<textarea class="form-control" rows="3" disabled>'+ toString +'</textarea>'+
                    '<small class="form-text text-muted">'+ 'incluida em <b>'+novaData+'</b> por <b>'+valor.matriculaResponsavel+'</b>.</small><br>'
                     $('#ultimaObsPag'+ item.NU_BEM).html(NovoDado)
                    }
                })
                $('form').submit( function(e) {
    
                    e.preventDefault();
                
                    let datas = JSON.stringify( $(this).serialize() );
                    let url = $(this).attr('action');
                    let method = $(this).attr('method');
                
                    // console.log(datas);
                    // console.log(url);
                    // console.log(method);
                    
                    $.ajax({
                        type: method,
                        url: url,
                        // data: {datas, csrfVar},
                        data: $(this).serialize(),
                        success: function (result){
                            
                            $('.modal').modal('hide');

                            Toast.fire({
                                icon: 'success',
                                title: 'Alteração salva!'
                            });
                            $('#novoHistorico'+ item.NU_BEM).text(strDate)
                        },
                      
                        error: function () {
                            
                            $('.modal').modal('hide');
                
                            Toast.fire({
                                icon: 'error',
                                title: 'Erro: alteração não efetuada!'
                            });
                        }
                        
                    });
                
                })
            })
        })
    })
})).done(function() {
    $('#tblContratosSemPagamentoSinal').addClass("dataTable");
    _formataData()  
    _formataValores();
    _formataDatatableComData()
    $('.spinnerTbl').remove()
})

function datepicker() {
    $('.datepicker').datepicker({dateFormat: 'yy-mm-dd', minDate:0}) 
  }