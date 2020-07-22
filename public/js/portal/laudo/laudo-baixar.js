var csrfVar = $('meta[name="csrf-token"]').attr('content');
$.fn.dataTable.ext.errMode = 'none';

Date.prototype.getMonthFormatted = function() {
    var month = this.getMonth() + 1;
    return month < 10 ? '0' + month : month;
}
Date.prototype.getDateFormatted = function() {
    var date = this.getDate();
    return date < 10 ? '0' + date : date;
}
var d = new Date();
var strDate = d.getDateFormatted()  + "/" + d.getMonthFormatted() + "/" + d.getFullYear();

$( document ).ready(function() {
     $.getJSON('/controle-laudos/reavaliacao', function(dados){
            $.each(dados, function(key, item) {
                var observacao = item.observacao
                if (typeof(observacao) != "undefined" && observacao !== null){
                var observacao = observacao.substring(0, 20) + '[...]' + '<button type="button" class="btn btn-Link" data-toggle="modal" data-target="#obsModal'+item.NU_BEM+'"><i style="color: #247cb4;" class="fas fa-info-circle"></i>'+
                '</button>'+
                `
                <div class="modal fade" id="obsModal${item.NU_BEM}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                            <h5 class="modal-title" style="color: white;" id="exampleModalLabel">Observação</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <textarea class="form-control" rows="5" disabled>${item.observacao}</textarea><br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                        </div>
                        </div>
                    </div>
                    </div>
                `
                }
                var linha =
                    `<tr>
                        <td><a href="/consulta-bem-imovel/${item.BEM_FORMATADO}" class="cursor-pointer">${item.NU_BEM}</a></td>
                        <td id="quantoFalta${item.NU_BEM}" style="color: red;"><b>${Math.abs(item.laudoPedido)}</b></td>
                        <td id="OS${item.NU_BEM}">${item.numeroOS}</td>
                        <td id="obs${item.NU_BEM}">${observacao}</td>
                        <td>
                        <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ação
                        </button> 

                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" id="observa${item.NU_BEM}" type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastraOBS${item.NU_BEM}"><i class="far fa-edit"></i>Observação</a>
                            <a class="dropdown-item" id="msg${item.NU_BEM}" type="button" class="btn btn-primary" data-toggle="modal" data-target="#mensageria${item.NU_BEM}"><i class="far fa-envelope"></i></i>mensagem</a>
                        </div>
                        <!-- Modal Mensageria -->
                        <div class="modal fade" id="mensageria${item.NU_BEM}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                <h5 class="modal-title" style="color: white;" id="exampleModalLabel">Enviar Mensagem</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                              <form method="post" action="/controle-laudos/envia-mensagem/${item.id}">
                                    <input type="hidden" name="_token" value="${csrfVar}">
                                    <input type="hidden" name="numeroOS" value="${item.numeroOS}">
                                    <input type="hidden" name="bemFormatado" value="${item.BEM_FORMATADO}">

                              <div class="form-group sl-6">
                              <p>Incluir Mensagem : </p>
                                  <textarea name="observacaoAtendimento" class="form-control" rows="5" required></textarea>
                              </div>
                  
                              <label>Enviar para: </label>
                              <input type="email" class="form-control" name="emailContato" placeholder="email" required><br>
                              <small class="form-text text-muted"><span style="color: red;">* Feche um modelo para abrir o outro.</span></small>
                              <div class="row">
                              <div class="col-sm">
                              <button id="btnToggle${item.NU_BEM}" type="button" class="btn btn-primary">Modelo de Cobrança</button><br><br>
                              </div>
                              <div class="col-sm">
                              <button id="btnToggleCobranca${item.NU_BEM}" type="button" class="btn btn-primary">Modelo de Correção</button><br><br>
                              </div>
                             
                              
                              <div contenteditable="true" id="toggleModelo${item.NU_BEM}" style="display: none;"><br>
                              Prezado Credenciado(a): <br><br>
                              1. Solicitamos informações sobre a entrega do laudo referente à O.S ${item.numeroOS} no sistema SIOPI, ainda não entregue<br><br>
                  
                              2. Prazo para atendimento da solicitação:  1 dia útil à partir do recebimento desta mensagem (${strDate}), sob pena de cancelamento da O.S. <br><br>
                  
                              3. À disposição. <br><br>
                  
                              Atenciosamente, <br><br>
                  
                              ${item.UNA} 
                              
                              
                              </div>
            
                              </div>
                              <div contenteditable="true" id="toggleModeloCobranca${item.NU_BEM}" style="display: none;"><br>
                              Prezado Credenciado(a): <br><br>
                              1.	Solicitamos correção no laudo: <br><br>
                  
                               - (motivo da correção) <br><br>
                  
                              2.    Após a correção, favor substituir a via do laudo no sistema SIOPI.<br><br>
                              
                              3. À disposição. <br><br>
                  
                              Atenciosamente, <br><br>
                  
                              ${item.UNA} 

                              </div>
                              <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                              <button type="submit" class="btn btn-primary">Enviar</button>
                              </div>
                              </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Modal Cadastra Observação-->
                            <div class="modal fade" id="cadastraOBS${item.NU_BEM}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                            <h5 class="modal-title" style="color: white;">Cadastrar Observação</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="/controle-laudos/cadastrarobs/${item.id}" id="formOBS${item.NU_BEM}">
                                                <input type="hidden" name="_token" value="${csrfVar}">
                                                <input type="hidden" name="contratoFormatado" value="${item.BEM_FORMATADO}">
                                                    <div class="form-group">
                                                        <p>Observação </p>
                                                        <textarea name="observacao" class="form-control" rows="5" required></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                    Enviado para correção ? <br>
                                                        <input type="radio" name="correcao" value=1>
                                                        <label for="Sim">Sim</label><br>
                                                        <input type="radio" name="correcao" value=0 checked>
                                                        <label for="Nao">Não</label><br>
                                                    </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </td>
                </tr>` 

            if (item.statusSiopi == "Concluida"){
            $(linha).appendTo('#tblbaixar>tbody');
            }
            if ($('#obs'+item.NU_BEM).text() == 'null'){
                $('#obs'+item.NU_BEM).text("")
            }
            $('#btnToggle'+item.NU_BEM).click(function() {
                $('#toggleModelo'+item.NU_BEM).toggle();
              });
              $('#btnToggleCobranca'+item.NU_BEM).click(function() {
                $('#toggleModeloCobranca'+item.NU_BEM).toggle();
            });  
        })
    })
})   


    setTimeout(function(){
        $('#tblbaixar').DataTable({
            "order": [[ 1, "desc" ]],
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "Mostrar _MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            }
        });
        $('.spinnerTbl').remove()
    }, 2000);
