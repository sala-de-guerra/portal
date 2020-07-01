var csrfVar = $('meta[name="csrf-token"]').attr('content');
$.fn.dataTable.ext.errMode = 'none';

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
function _formataDatatablePendencia(){
    $('.dataTables').DataTable({
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

$(document).ready(function(){
        $.getJSON('/controle-laudos/universo', function(dados){
            $.each(dados, function(key, item) {
            
                var linha =
                    `<tr>
                        <td><a href="/consulta-bem-imovel/${item.BEM_FORMATADO}" class="cursor-pointer">${item.NU_BEM}</a></td>
                        <td>${item.CLASSIFICACAO}</td>
                        <td>${item.STATUS_IMOVEL}</td>
                        <td>`+ moment(item.DATA_VENCIMENTO_LAUDO).format("DD/MM/YYYY") +`</td>
                        <td id="quantoFalta${item.id}">${item.quanto_falta}</td>
                        <td id="OS${item.id}">${item.numeroOS}</td>
                        <td id="status${item.id}">${item.statusSiopi}</td>
                        <td id="obs${item.id}">${item.observacao}</td>
                        <td>
                            <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Cadastrar
                            </button> 

                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastraOS${item.id}"><i class="far fa-edit"></i>O.S</a>
                                <a class="dropdown-item" type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastrarStatus${item.id}"><i class="far fa-edit"></i>Status Siopi</a>
                                <a class="dropdown-item" type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastraOBS${item.id}"><i class="far fa-edit"></i>Observação</a>
                            </div> 

                        <!-- Modal -->
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
                                            <form method="post" action="/controle-laudos/alterar/${item.id}">
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
                        <!-- Modal -->
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
                                        <form method="post" action="/controle-laudos/alterar/${item.id}">
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
                        
                        <!-- Modal -->
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
                                            <form method="post" action="/controle-laudos/alterar/${item.id}">
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
        }
    )}
)

    $.getJSON('/controle-laudos/laudo-vencido', function(dados){
        $.each(dados, function(key, item) {
            var linha =
                    `<tr>
                        <td><a href="/consulta-bem-imovel/${item.BEM_FORMATADO}" class="cursor-pointer">${item.NU_BEM}</a></td>
                        <td>${item.CLASSIFICACAO}</td>
                        <td>${item.STATUS_IMOVEL}</td>
                        <td>`+ moment(item.DATA_VENCIMENTO_LAUDO).format("DD/MM/YYYY") +`</td>
                        <td id="quantoFalta${item.id}">${item.quanto_falta}</td>
                        <td id="OS${item.id}">${item.numeroOS}</td>
                        <td id="status${item.id}">${item.statusSiopi}</td>
                        <td id="obs${item.id}">${item.observacao}</td>
                        <td>
                            <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Cadastrar
                            </button> 

                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastraOS${item.id}"><i class="far fa-edit"></i>O.S</a>
                                <a class="dropdown-item" type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastrarStatus${item.id}"><i class="far fa-edit"></i>Status Siopi</a>
                                <a class="dropdown-item" type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastraOBS${item.id}"><i class="far fa-edit"></i>Observação</a>
                            </div> 

                        <!-- Modal -->
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
                                            <form method="post" action="/controle-laudos/alterar/${item.id}">
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
                        <!-- Modal -->
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
                                        <form method="post" action="/controle-laudos/alterar/${item.id}">
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
                        
                        <!-- Modal -->
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
                                            <form method="post" action="/controle-laudos/alterar/${item.id}">
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
                        </td>
                    </tr>` 


        $(linha).appendTo('#tblLaudoVencido>tbody');
            if ($('#quantoFalta'+item.id).text() < 0 ){
                $('#quantoFalta'+item.id).html('<b style="color: red;">'+item.quanto_falta +'</b>')
            }
            if ($('#OS'+item.id).text() == 'null'){
                $('#OS'+item.id).text("")
            }
            if ($('#obs'+item.id).text() == 'null'){
                $('#obs'+item.id).text("")
            }
            if ($('#status'+item.id).text() == 'null'){
                $('#status'+item.id).text("")
            }
        }
    )}
)

            $.getJSON('/controle-laudos/reavaliacao', function(dados){
                $.each(dados, function(key, item) {
                    var linha =
                    `<tr>
                        <td><a href="/consulta-bem-imovel/${item.BEM_FORMATADO}" class="cursor-pointer">${item.NU_BEM}</a></td>
                        <td>${item.CLASSIFICACAO}</td>
                        <td>${item.STATUS_IMOVEL}</td>
                        <td>`+ moment(item.DATA_VENCIMENTO_LAUDO).format("DD/MM/YYYY") +`</td>
                        <td id="quantoFalta${item.id}">${item.quanto_falta}</td>
                        <td id="OS${item.id}">${item.numeroOS}</td>
                        <td id="status${item.id}">${item.statusSiopi}</td>
                        <td id="obs${item.id}">${item.observacao}</td>
                        <td>
                            <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Cadastrar
                            </button> 

                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastraOS${item.id}"><i class="far fa-edit"></i>O.S</a>
                                <a class="dropdown-item" type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastrarStatus${item.id}"><i class="far fa-edit"></i>Status Siopi</a>
                                <a class="dropdown-item" type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastraOBS${item.id}"><i class="far fa-edit"></i>Observação</a>
                            </div> 

                        <!-- Modal -->
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
                                            <form method="post" action="/controle-laudos/alterar/${item.id}">
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
                        <!-- Modal -->
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
                                        <form method="post" action="/controle-laudos/alterar/${item.id}">
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
                        
                        <!-- Modal -->
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
                                            <form method="post" action="/controle-laudos/alterar/${item.id}">
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
                        </td>
                    </tr>` 


                $(linha).appendTo('#tblReavaliacao>tbody');
                    if ($('#OS'+item.id).text() == 'null'){
                        $('#OS'+item.id).text("")
                    }
                    if ($('#quantoFalta'+item.id).text() < 0 ){
                        $('#quantoFalta'+item.id).html('<b style="color: red;">'+item.quanto_falta +'</b>')
                    }else if ($('#quantoFalta'+item.id).text() >= 20 ){
                        $('#quantoFalta'+item.id).html('<b style="color: blue;">'+item.quanto_falta +'</b>')
                    }else{
                        $('#quantoFalta'+item.id).html('<b style="color: green;">'+item.quanto_falta +'</b>')
                    }
                    if ($('#obs'+item.id).text() == 'null'){
                        $('#obs'+item.id).text("")
                    }
                    if ($('#status'+item.id).text() == 'null'){
                        $('#status'+item.id).text("")
                    }
            }
        )}
    )

            $.getJSON('/controle-laudos/em-pendencia', function(dados){
                $.each(dados, function(key, item) {
                    var linha =
                    `<tr>
                        <td><a href="/consulta-bem-imovel/${item.BEM_FORMATADO}" class="cursor-pointer">${item.NU_BEM}</a></td>
                        <td>${item.CLASSIFICACAO}</td>
                        <td>${item.STATUS_IMOVEL}</td>
                        <td>`+ moment(item.DATA_VENCIMENTO_LAUDO).format("DD/MM/YYYY") +`</td>
                        <td id="quantoFalta${item.id}">${item.quanto_falta}</td>
                        <td id="OS${item.id}">${item.numeroOS}</td>
                        <td id="status${item.id}">${item.statusSiopi}</td>
                        <td id="obs${item.id}">${item.observacao}</td>
                        <td>
                            <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Cadastrar
                            </button> 

                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastraOS${item.id}"><i class="far fa-edit"></i>O.S</a>
                                <a class="dropdown-item" type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastrarStatus${item.id}"><i class="far fa-edit"></i>Status Siopi</a>
                                <a class="dropdown-item" type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastraOBS${item.id}"><i class="far fa-edit"></i>Observação</a>
                            </div> 

                        <!-- Modal -->
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
                                            <form method="post" action="/controle-laudos/alterar/${item.id}">
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
                        <!-- Modal -->
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
                                        <form method="post" action="/controle-laudos/alterar/${item.id}">
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
                        
                        <!-- Modal -->
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
                                            <form method="post" action="/controle-laudos/alterar/${item.id}">
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
                        </td>
                    </tr>` 

            $(linha).appendTo('#tblEmPendencia>tbody');
                if ($('#quantoFalta'+item.id).text() < 0 ){
                    $('#quantoFalta'+item.id).html('<b style="color: red;">'+item.quanto_falta +'</b>')
                }else{
                    $('#quantoFalta'+item.id).html('<b style="color: green;">'+item.quanto_falta +'</b>')
                }
                if ($('#OS'+item.id).text() == 'null'){
                    $('#OS'+item.id).text("")
                }
                if ($('#obs'+item.id).text() == 'null'){
                    $('#obs'+item.id).text("")
                }
                if ($('#status'+item.id).text() == 'null'){
                $('#status'+item.id).text("")
            }
            }
        )}
    )
})

setTimeout(function(){
    _formataDatatableComData()
    $(".OS").mask("0000.0000.000000000/0000.00.00.00");
    }, 2500);
    
setTimeout(function(){
    $('.spinnerTbl').remove()
    _formataDatatablePendencia()
    }, 4000);

setTimeout(function(){
    $('.bg-danger').fadeOut("slow");
    $('.bg-success').fadeOut("slow");
    }, 2000);