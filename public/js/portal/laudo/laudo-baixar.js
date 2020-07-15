var csrfVar = $('meta[name="csrf-token"]').attr('content');
$.fn.dataTable.ext.errMode = 'none';

$( document ).ready(function() {
     $.getJSON('/controle-laudos/reavaliacao', function(dados){
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
                        <td id="quantoFalta${item.NU_BEM}" style="color: red;"><b>${Math.abs(item.laudoPedido)}</b></td>
                        <td id="OS${item.NU_BEM}">${item.numeroOS}</td>
                        <td id="obs${item.NU_BEM}">${observacao}</td>
                        <td>
                            <button id="btnGroupDrop1" type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastraOBS${item.NU_BEM}">
                            Observação
                            </button> 
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
                    </td>
                </tr>` 

            if (item.statusSiopi == "Concluida"){
            $(linha).appendTo('#tblbaixar>tbody');
            }
            if ($('#obs'+item.NU_BEM).text() == 'null'){
                $('#obs'+item.NU_BEM).text("")
            }  
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
    }, 1000);
