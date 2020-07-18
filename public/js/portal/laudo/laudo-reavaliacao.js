var csrfVar = $('meta[name="csrf-token"]').attr('content');
$.fn.dataTable.ext.errMode = 'none';


 $("#reavaliacaotbl").click(function() {
     $.getJSON('/controle-laudos/reavaliacao', function(dados){
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

            $.each(dados, function(key, item) {
                var observacao = item.observacao
                if (typeof(observacao) != "undefined" && observacao !== null){
                var observacao = observacao.substring(0, 20) + '[...]' + '<button type="button" class="btn btn-Link" data-toggle="modal" data-target="#obsModal'+item.NU_BEM+'"><i style="color: #247cb4;" class="fas fa-info-circle"></i>'+
                '</button>'+
                `
                <div class="modal fade" id="obsModal${item.NU_BEM}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                            <h5 class="modal-title" style="color: white;" id="exampleModalLabel">Observação</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ${item.observacao}
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
                        <td>${item.CLASSIFICACAO}</td>
                        <td>${item.STATUS_IMOVEL}</td>
                        <td id="quantoFalta${item.NU_BEM}">${item.laudoPedido}</td>
                        <td id="OS${item.NU_BEM}">${item.numeroOS}</td>
                        <td id="status${item.NU_BEM}">${item.statusSiopi}</td>
                        <td id="obs${item.NU_BEM}">${observacao}</td>
                        <td>
                            <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ação
                            </button> 

                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" id="cadastra${item.NU_BEM}" type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastraOS${item.NU_BEM}"><i class="far fa-edit"></i>Cadastrar O.S</a>
                                <a class="dropdown-item" id="altera${item.NU_BEM}" type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastrarStatus${item.NU_BEM}"><i class="far fa-edit"></i>alterar</a>
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
                                  <form method="post" action="controle-laudos/envia-mensagem">
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
                                                        <textarea name="observacao" class="form-control" rows="5"></textarea>
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

                        <!-- Modal cadastra status -->
                        <div class="modal fade" id="cadastrarStatus${item.NU_BEM}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                        <h5 class="modal-title" style="color: white;">Cadastrar Status Siopi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="/controle-laudos/alterar/${item.id}" id="formStatus${item.NU_BEM}">
                                            <input type="hidden" name="_token" value="${csrfVar}">
                                            <div class="form-group">
                                                <label>Nº da O.S</label>
                                                <input type="text" name="numeroOS" class="form-control OS" minlength="33" value="${item.numeroOS}" maxlength="33">
                                            </div>
                                            <p><b>Status O.S</b></p>
                                            <div class="input-group mb-3">
                                                <select class="custom-select" name="statusSiopi">
                                                    <option selected value="${item.statusSiopi}">Escolher...</option>
                                                    <option value="Cancelada">Cancelada</option>
                                                    <option value="Concluida">Concluida</option>
                                                    <option value="Convocada">Convocada</option>
                                                    <option value="Emitida">Emitida</option>
                                                    <option value="Excluída">Excluída</option>
                                                    <option value="Laudo Finalizado">Laudo Finalizado</option>
                                                    <option value="Vistoria Concluida">Vistoria Concluida</option>
                                                </select>
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
                        
                        <!-- Modal cadastra O.S -->
                            <div class="modal fade" id="cadastraOS${item.NU_BEM}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                            <h5 class="modal-title" style="color: white;">Cadastrar O.S</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="controle-laudos/cadastrarOS" id="formLaudo${item.NU_BEM}">
                                                <div class="modal-body">
                                                    <input type="hidden" name="_token" value="${csrfVar}">
                                                    <input type="hidden" name="contratoFormatado" value="${item.BEM_FORMATADO}">
                                                    <input type="hidden" name="numBem" value="${item.NU_BEM}">
                                                    <input type="hidden" name="statusSiopi" value="Convocada">
                                                    <div class="form-group">
                                                        <label>Nº da O.S</label>
                                                        <input type="text" name="numeroOS" class="form-control OS" minlength="33" maxlength="33" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                                    </div>
                                                </div>
                                            </form>                   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>` 

            if (item.statusSiopi != "Concluida"){
                $(linha).appendTo('#tblReavaliacao>tbody');
            }
    
            
        var dias = $('#quantoFalta'+item.NU_BEM).text()
        var positivo = Math.abs(dias)

        if ($('#OS'+item.NU_BEM).text() == 'null'){
                $('#OS'+item.NU_BEM).text("")
                $('#altera'+item.NU_BEM).remove()
                $('#observa'+item.NU_BEM).remove()
                $('#msg'+item.NU_BEM).remove()
            }else{
                $('#cadastra'+item.NU_BEM).remove()
            }
            if ($('#obs'+item.NU_BEM).text() == 'null'){
                $('#obs'+item.NU_BEM).text("")
            }
            if ($('#status'+item.NU_BEM).text() == 'null'){
                $('#status'+item.NU_BEM).text("")
            }
            if (positivo < 5 ){
                $('#quantoFalta'+item.NU_BEM).html('<b style="color: blue;">'+Math.abs(item.laudoPedido) +'</b>')
            }else if (positivo <= 8 ){
                $('#quantoFalta'+item.NU_BEM).html('<b style="color: green;">'+Math.abs(item.laudoPedido) +'</b>')
            }else if (positivo == "0" || positivo == null || positivo == "null" ){
                $('#quantoFalta'+item.NU_BEM).html('<b style="color: red;">'+"inconsistência" +'</b>')
            }else{
                $('#quantoFalta'+item.NU_BEM).html('<b style="color: red;">'+Math.abs(item.laudoPedido) +'</b>')
            }
            $('#btnToggle'+item.NU_BEM).click(function() {
                $('#toggleModelo'+item.NU_BEM).toggle();
              });
              $('#btnToggleCobranca'+item.NU_BEM).click(function() {
                $('#toggleModeloCobranca'+item.NU_BEM).toggle();
              });
            $('#formLaudo'+item.NU_BEM).submit( function(e) {

                e.preventDefault();
    
                let datas = JSON.stringify( $(this).serialize() );
                let url = $(this).attr('action');
                let method = $(this).attr('method');
                console.log(datas);
                console.log(url);
                console.log(method);
                var post = datas
                var post = post.substring(137, 172);
                var decodedUrl = decodeURIComponent(post);
   
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
                    $('#OS'+item.NU_BEM).html(decodedUrl)
                    $('#status'+item.NU_BEM).html("Convocada")
                    $('#cadastra'+item.NU_BEM).remove()
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
            $('#formStatus'+item.NU_BEM).submit( function(e) {
    
                e.preventDefault();
    
    
                let datas = JSON.stringify( $(this).serialize() );
                let url = $(this).attr('action');
                let method = $(this).attr('method');
                console.log(datas);
                console.log(url);
                console.log(method);
                var post  = datas
                var post2 = datas
                var post = post.substring(106, 140);
                var decodedUrl = decodeURIComponent(post);
                var post2 = post2.substring(58, 93);
                var decodedUrl2 = decodeURIComponent(post2);

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
                    $('#status'+item.NU_BEM).html(decodedUrl)
                    $('#OS'+item.NU_BEM).html(decodedUrl2)
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
    
            $('#formOBS'+item.NU_BEM).submit( function(e) {
    
                e.preventDefault();
    
    
                let datas = JSON.stringify( $(this).serialize() );
                let url = $(this).attr('action');
                let method = $(this).attr('method');
                console.log(datas);
                console.log(url);
                console.log(method);
                var post = datas
                var post = post.substring(96, 130);
                console.log(post)
                var decodedUrl = decodeURIComponent(post);
    
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
                        $('#obs'+item.NU_BEM).html(decodedUrl + '[...]') 
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
             }
         )}
    )
})
$("#reavaliacaotbl").click(function() {
    setTimeout(function(){
        $('.dtableReavaliacao').DataTable({
            "order": [[ 3, "desc" ]],
            'columnDefs' : [ { 
                'searchable'    : false, 
                'targets'       : [7] 
                },
            ],
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
        $('.dtableReavaliacao').removeAttr('id');
        $('.spinnerTblReavaliacao').remove()
        $("#reavaliacaotbl").off('click')
        $(".OS").mask("0000.0000.000000000/0000.00.00.00");
    }, 1000);
})