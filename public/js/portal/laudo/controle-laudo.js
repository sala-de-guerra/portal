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

function _formataDatatableComData (idTabela){
    $('#' + idTabela).DataTable({
        "order": [[ 3, "asc" ]],
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
};
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

        $.getJSON('/controle-laudos/universo', function(dados){
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
                        <textarea class="form-control" rows="5" disabled>${item.observacao}</textarea>
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
                        <td id="quantoFalta${item.NU_BEM}">${item.quanto_falta}</td>
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
                                                    <option value="Concluida">Concluída</option>
                                                    <option value="Convocada">Convocada</option>
                                                    <option value="Emitida">Emitida</option>
                                                    <option value="Excluída">Excluída</option>
                                                    <option value="Laudo Finalizado">Laudo Finalizado</option>
                                                    <option value="Vistoria Concluida">Vistoria Concluída</option>
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

        $(linha).appendTo('#tblLaudoEmDia>tbody');
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
            if ($('#quantoFalta'+item.NU_BEM).text() < 20 ){
                $('#quantoFalta'+item.NU_BEM).html('<b style="color: green;">'+item.quanto_falta +'</b>')
            }else{
                $('#quantoFalta'+item.NU_BEM).html('<b style="color: blue;">'+item.quanto_falta +'</b>')
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
setTimeout(function(){
    _formataDatatableComData("tblLaudoEmDia")
    $(".OS").mask("0000.0000.000000000/0000.00.00.00");
    $('#tblLaudoEmDia').dataTable( {
        "autoWidth": false
      } );
    }, 2000);
    
setTimeout(function(){
    $('.spinnerTbl').remove()
    }, 2000);

