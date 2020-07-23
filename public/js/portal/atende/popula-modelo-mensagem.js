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
                        </button>

                        <div class="modal fade" id="modalModeloMensageria${item.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">${item.nomeModelo}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <div class="modal-body">
                                    
                                        <textarea class="form-control" rows="10">${item.modeloMensageria}</textarea>     
                                </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>`
            
            $(linha).appendTo('#tblMensagemCriada>tbody');
        })
        _formataDatatableComId("tblMensagemCriada")
    })

