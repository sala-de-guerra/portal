var csrfVar = $('meta[name="csrf-token"]').attr('content');

function _formataDatatableComId (idTabela){
    $('#' + idTabela).DataTable({
        "order": [[ 0, "desc" ]],
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


    $.getJSON('/atende/lista-mensagem', function(dados){
        $.each(dados, function(key, item) { 
            var linha =
                `<tr>
                    <td>${item.nomeModelo}</td>
                    <td>
                        <button class="btn btn-primary btnHistorico" title="Modelo Mensagem" data-toggle="modal" data-target="#modalModeloMensageria${item.id}">
                            <i class="far fa-envelope"></i>
                        </button>&nbsp&nbsp&nbsp

                        <button class="btn btn-danger btnHistorico" title="Apagar Modelo" data-toggle="modal" data-target="#modalApagarModeloMensageria${item.id}">
                            <i class="fas fa-trash-alt"></i>
                        </button>

                        <div class="modal fade" id="modalModeloMensageria${item.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">${item.nomeModelo}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <div class="modal-body">
                                    
                                        <p>${item.modeloMensageria}</p>  
                                </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modalApagarModeloMensageria${item.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Apagar Modelo de Mensagem</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/atende/apagar-mensagem/${item.id}" method="post">
                                <input type="hidden" name="_token" value="${csrfVar}">
                                <input type="hidden" class="form-control" name="_method" value="GET">
                                    <div class="modal-body">
                                        <p>Tem certeza que deseja apagar modelo: <b>${item.nomeModelo}</b> ? </p>  
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                                        <button type="submit" class="btn btn-danger">Apagar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    </td>
                </tr>`
            
            $(linha).appendTo('#tblMensagemCriada>tbody');
        })
        _formataDatatableComId("tblMensagemCriada")
    })
//Fade Out Flash Message
setTimeout(function(){
    $('#fadeOut').fadeOut("slow");
}, 4000);