var csrfVar = $('meta[name="csrf-token"]').attr('content');
/**********************\
| Config inicial Toast |
\**********************/

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

//Arruma ordenação do datatable em formato Brasil
jQuery.extend( jQuery.fn.dataTableExt.oSort, {
	"date-uk-pre": function ( a ) {
		if (a == null || a == "") {
			return 0;
		}
		var ukDatea = a.split('/');
		return (ukDatea[2] + ukDatea[1] + ukDatea[0]) * 1;
	},

	"date-uk-asc": function ( a, b ) {
		return ((a < b) ? -1 : ((a > b) ? 1 : 0));
	},

	"date-uk-desc": function ( a, b ) {
		return ((a < b) ? 1 : ((a > b) ? -1 : 0));
	}
} );

//define formato brasileiro de data na coluna 3
function _formataDatatableComData (){
    $('.dataTable').DataTable({
        "order": [[ 3, "asc" ]],
        columnDefs: [
            {type: 'date-uk', targets: 3}
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
};

        $.getJSON('/controle-laudos/universo', function(dados){
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
                var observacao = observacao.substring(0, 20) + '[...]' + '<button type="button" class="btn btn-Link" data-toggle="modal" data-target="#obsModal'+item.id+'"><i style="color: #247cb4;" class="fas fa-info-circle"></i>'+
                '</button>'+
                `
                <div class="modal fade" id="obsModal${item.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <td>`+ moment(item.DATA_VENCIMENTO_LAUDO).format("DD/MM/YYYY") +`</td>
                        <td id="quantoFalta${item.id}">${item.quanto_falta}</td>
                        <td id="OS${item.id}">${item.numeroOS}</td>
                        <td id="status${item.id}">${item.statusSiopi}</td>
                        <td id="obs${item.id}">${observacao}</td>
                        <td>
                            <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ação
                            </button> 

                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastraOS${item.id}"><i class="far fa-edit"></i>O.S</a>
                                <a class="dropdown-item" type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastrarStatus${item.id}"><i class="far fa-edit"></i>Status Siopi</a>
                                <a class="dropdown-item" type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastraOBS${item.id}"><i class="far fa-edit"></i>Observação</a>
                                <a class="dropdown-item" type="button" class="btn btn-primary" data-toggle="modal" data-target="#mensageria${item.id}"><i class="far fa-envelope"></i></i>mensagem</a>
                            </div> 
                            <!-- Modal Mensageria -->
                            <div class="modal fade" id="mensageria${item.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                  <button id="btnToggle${item.id}" type="button" class="btn btn-primary">Modelo de Cobrança</button><br><br>
                                  </div>
                                  <div class="col-sm">
                                  <button id="btnToggleCobranca${item.id}" type="button" class="btn btn-primary">Modelo de Correção</button><br><br>
                                  </div>
                                 
                                  
                                  <div contenteditable="true" id="toggleModelo${item.id}" style="display: none;"><br>
                                  Prezado Credenciado(a): <br><br>
                                  1. Solicitamos informações sobre a entrega do laudo referente à O.S ${item.numeroOS} no sistema SIOPI, ainda não entregue<br><br>
                      
                                  2. Prazo para atendimento da solicitação:  1 dia útil à partir do recebimento desta mensagem (${strDate}), sob pena de cancelamento da O.S. <br><br>
                      
                                  3. À disposição. <br><br>
                      
                                  Atenciosamente, <br><br>
                      
                                  ${item.UNA} 
                                  
                                  
                                  </div>
                
                                  </div>
                                  <div contenteditable="true" id="toggleModeloCobranca${item.id}" style="display: none;"><br>
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
                            <div class="modal fade" id="cadastraOBS${item.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                            <h5 class="modal-title" style="color: white;">Cadastrar Observação</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="/controle-laudos/alterar/${item.id}" id="formOBS${item.id}">
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
                        <div class="modal fade" id="cadastrarStatus${item.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                        <h5 class="modal-title" style="color: white;">Cadastrar Status Siopi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="/controle-laudos/alterar/${item.id}" id="formStatus${item.id}">
                                            <input type="hidden" name="_token" value="${csrfVar}">
                                            <input type="hidden" name="contratoFormatado" value="${item.BEM_FORMATADO}">
                                            <div class="input-group mb-3">
                                                <select class="custom-select" name="statusSiopi">
                                                    <option selected>Escolher...</option>
                                                    <option value="Cancelada">Cancelada</option>
                                                    <option value="Concluída">Concluída</option>
                                                    <option value="Convocada">Convocada</option>
                                                    <option value="Emitida">Emitida</option>
                                                    <option value="Excluída">Excluída</option>
                                                    <option value="Laudo Finalizado">Laudo Finalizado</option>
                                                    <option value="Vistoria Concluída">Vistoria Concluída</option>
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
                            <div class="modal fade" id="cadastraOS${item.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                            <h5 class="modal-title" style="color: white;">Cadastrar O.S</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="/controle-laudos/alterar/${item.id}" id="formLaudo${item.id}">
                                                <div class="modal-body">
                                                    <input type="hidden" name="_token" value="${csrfVar}">
                                                    <input type="hidden" name="contratoFormatado" value="${item.BEM_FORMATADO}">
                                                    <div class="form-group">
                                                        <label>Nº da O.S</label>
                                                        <input type="text" name="numeroOS" class="form-control OS" minlength="33" maxlength="33" value="${item.numeroOS}" required>
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

        $(linha).appendTo('#tblLaudoEmDia>tbody');
            if ($('#OS'+item.id).text() == 'null'){
                $('#OS'+item.id).text("")
            }
            if ($('#obs'+item.id).text() == 'null'){
                $('#obs'+item.id).text("")
            }
            if ($('#status'+item.id).text() == 'null'){
                $('#status'+item.id).text("")
            }
            if ($('#quantoFalta'+item.id).text() < 20 ){
                $('#quantoFalta'+item.id).html('<b style="color: green;">'+item.quanto_falta +'</b>')
            }else{
                $('#quantoFalta'+item.id).html('<b style="color: blue;">'+item.quanto_falta +'</b>')
            }
            $('#btnToggle'+item.id).click(function() {
                $('#toggleModelo'+item.id).toggle();
              });
              $('#btnToggleCobranca'+item.id).click(function() {
                $('#toggleModeloCobranca'+item.id).toggle();
              });
            $('#formLaudo'+item.id).submit( function(e) {

                e.preventDefault();
    
                let datas = JSON.stringify( $(this).serialize() );
                let url = $(this).attr('action');
                let method = $(this).attr('method');
                // console.log(datas);
                // console.log(url);
                // console.log(method);
                var post = datas
                var resultadoPrimeiraParte = post.substring(94, 113);
                var resultadoSegundaParte = post.substring(116, 129);
    
                
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
                    $('#OS'+item.id).text(resultadoPrimeiraParte + "/" + resultadoSegundaParte)
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
            $('#formStatus'+item.id).submit( function(e) {
    
                e.preventDefault();
    
    
                let datas = JSON.stringify( $(this).serialize() );
                let url = $(this).attr('action');
                let method = $(this).attr('method');
                // console.log(datas);
                // console.log(url);
                // console.log(method);
                var post = datas
                var post = post.substring(97, 130);
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
                    $('#status'+item.id).html(decodedUrl)
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
    
            $('#formOBS'+item.id).submit( function(e) {
    
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
                        $('#obs'+item.id).html(decodedUrl + '[...]') 
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
setTimeout(function(){
    _formataDatatableComData()
    $(".OS").mask("0000.0000.000000000/0000.00.00.00");
    }, 1000);
    
setTimeout(function(){
    $('.spinnerTbl').remove()
    }, 1000);

