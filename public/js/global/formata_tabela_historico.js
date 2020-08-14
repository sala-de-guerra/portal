var s = new Date(Date.now() - 7 * 24 * 60 * 60 * 1000)
var semanaPassada = moment(s).format('DD/MM/YYYY');


function _formataTabelaHistorico (numeroContrato) {
    $.getJSON('/estoque-imoveis/consulta-historico-contrato/' + numeroContrato, function(dados) {
        $.each(dados.historico, function(key, item) {
            var historicoCompleto = item.observacao
            HistoricoSemQuebra = historicoCompleto.replace(/(<p[^>]+?>|<p>|<\/p>)/img, "");
            var stripped = HistoricoSemQuebra.replace(/(<br\s*\/?>){1,}/gi, '<p>');

            var data = moment(item.data).format('DD/MM/YYYY')
            var linha = 
                '<tr>' +
                    '<td>' + item.idHistorico + '</td>' +
                    '<td>' + item.matriculaResponsavel + '</td>' +
                    '<td>' + item.tipo + '</td>' +
                    '<td id="atividade_historico'+ item.idHistorico +'">' + item.atividade + '</td>' +
                    '<td class="col-sm-4 overflow-auto" =>' + 
                        '<div class="row">' +
                            '<div class="col" id="obs'+ item.idHistorico +'">' +
                               item.observacao + 
                            '</div>' +

                            '<div class="m-2 d-flex justify-content-end">' +
                                '<button class="btn btn-primary btnHistorico" title="Observação do Histórico" data-toggle="modal" data-target="#modalConsultaObservacaoHistorico' + item.idHistorico + '">' +
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
                                                '<p id="observacaoHist'+ item.idHistorico +'">' +  item.observacao + '</p>' +
            
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

            var confereSemana = moment(item.data).isBefore(s);
            if(item.atividade == 'ATENDE'){
            if (item.tipo == 'RESPOSTA'){
                status = 'Respondido'
            }else{
                status = 'Aberto'
            }

                if (confereSemana == false){
                   var lista =
                            `<tr>
                            <td>${data}</td>
                            <td>${status}</td>
                            </tr>`
                $(lista).appendTo('#tblTooltipAtende>tbody');
                }
            }
                
                $(linha).appendTo('#tblHistorico>tbody');
                formata_observacao ("obs" + item.idHistorico);
            
                var busca = $('#atividade_historico'+item.idHistorico).text()
                if (busca == "LEILÃO NEGATIVO") {
                    obs = item.observacao
                }
                
                var busca = $('#atividade_historico'+item.idHistorico).text()
                if (busca == "LEILÃO NEGATIVO") {
                    historicofatiado = $('#obs'+item.idHistorico).text()
                }

                if (item.tipo == "RESPOSTA"){
                   $('#observacaoHist' + item.idHistorico).html(stripped)
                 }

        }) 

        _formataDatatableComId ("tblHistorico");
    });
};



$.getJSON('/estoque-imoveis/consulta-historico-contrato/' + numeroContrato, function(dados) {
    $.each(dados.historico, function(key, item) {
        var data = moment(item.data).format('DD/MM/YYYY')
  
        var confereSemana = moment(item.data).isBefore(s);
        if(item.atividade == 'ATENDE'){
        if (item.tipo == 'RESPOSTA'){
            status = 'Respondido'
        }else{
            status = 'Aberto'
        }

            if (confereSemana == false){
               var lista =
                        `<tr>
                        <td>${data}</td>
                        <td>${status}</td>
                        <td id="obs${item.idHistorico}">${item.observacao}</td>
                        <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalHistoricoObs${item.idHistorico}">
                            <i class="fas fa-info-circle"></i>
                        </button>

                        <div class="modal fade" id="modalHistoricoObs${item.idHistorico}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg mda modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                <div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">
                                    <h5 style="color: white;" class="modal-title" id="exampleModalLabel">Descrição atende</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>${item.observacao}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                                </div>
                                </div>
                            </div>
                            </div>
                        </td>
                        </tr>`
            
            $(lista).appendTo('#tblHistoricoAtende>tbody');
            formata_observacao ("obs" + item.idHistorico);
            }
        }
    }) 
});



function formata_observacao(idobs){
    $('#' + idobs).html($('#' + idobs).html().substring(0, 62) + ' [...]');
}
