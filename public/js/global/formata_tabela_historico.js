function _formataTabelaHistorico (numeroContrato) {
    $.getJSON('/estoque-imoveis/consulta-historico-contrato/' + numeroContrato, function(dados) {
        $.each(dados.historico, function(key, item) {
            var linha = 
                '<tr>' +
                    '<td>' + item.idHistorico + '</td>' +
                    '<td>' + item.matriculaResponsavel + '</td>' +
                    '<td>' + item.tipo + '</td>' +
                    '<td>' + item.atividade + '</td>' +
                    '<td>' + item.observacao + '</td>' +
                    '<td class="formata-data">' + item.data + '</td>' +
                '</tr>';
            $(linha).appendTo('#tblHistorico>tbody');
        }) 
    });
};