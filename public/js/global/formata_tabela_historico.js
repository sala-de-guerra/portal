function _formataTabelaHistorico (numeroContrato) {
    $.getJSON('/estoque-imoveis/consulta-historico-contrato/' + numeroContrato, function(dados) {
        $.each(dados.historico, function(key, item) {
            var linha = 
                '<tr>' +
                    '<td>' + item.idHistorico + '</td>' +
                    '<td>' + item.matriculaResponsavel + '</td>' +
                    '<td>' + item.tipo + '</td>' +
                    '<td>' + item.atividade + '</td>' +
                    '<td class="col-sm-4 overflow-auto" =>' + 
                        '<div class="row">' +
                            '<div class="col" id="obs'+ item.idHistorico +'">' +
                               item.observacao + 
                            '</div>' +

                            '<div class="col m-2">' +
                                '<button class="btn btn-primary" title="Observação do Histórico" data-toggle="modal" data-target="#modalConsultaObservacaoHistorico' + item.idHistorico + '">' +
                                    '<i class="fas fa-info-circle"></i>' +
                                '</button>' +
            
                                '<div class="modal fade" id="modalConsultaObservacaoHistorico' + item.idHistorico + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                                    '<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">' +
                                        '<div class="modal-content">' +
            
                                            '<div class="modal-header">' +
                                                '<h5 class="modal-title" id="exampleModalLabel">Observação do Histórico</h5>' +
                                                '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">' +
                                                    '<span aria-hidden="true">&times;</span>' +
                                                '</button>' +
                                            '</div>' +
            
                                            '<div class="modal-body">' +
            
                                                '<div class="form-group">' +
                                                    '<p>' + item.observacao + '</p>' +                                        
                                                '</div>' +
            
                                            '</div>' +
            
                                            '<div class="modal-footer">' +
                                                '<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>' +
                                            '</div>' +
            
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
    
                            '</div>' +
                            
                        '</div>' +
                    '</td>' +
                    '<td class="formata-data">' + item.data + '</td>' +
                '</tr>';
                // console.log("obs" + item.idHistorico)
                $(linha).appendTo('#tblHistorico>tbody');
                formata_observacao ("obs" + item.idHistorico);
        }) 
        _formataDatatableComId ("tblHistorico");
    });
};

function formata_observacao(idobs){
    $('#' + idobs).html($('#' + idobs).html().substring(0, 62) + ' [...]');
}