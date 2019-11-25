//Função global para montar cada linha de histórico do arquivo formata_tabela_historico.js

function _formataTabelaHistorico (dados) {

    var unidade = $('#unidade').val();

    $.each(dados[0].esteira_contratacao_historico, function(key, item) {
    
        if (item.analiseHistorico === null) {
            var linha = 
            '<tr>' +
                '<td class="col-sm-1">' + item.idHistorico + '</td>' +
                '<td class="col-sm-1 formata-data">' + item.dataStatus + '</td>' +
                '<td class="col-sm-1">' + item.tipoStatus + '</td>' +
                '<td class="col-sm-1 responsavel">' + item.responsavelStatus + '</td>' +
                '<td class="col-sm-1">' + item.area + '</td>' +
                '<td class="col-sm-7"></td>' +
            '</tr>';
        }
        else {               
            var linha = 
                '<tr>' +
                    '<td class="col-sm-1">' + item.idHistorico + '</td>' +
                    '<td class="col-sm-1 formata-data">' + item.dataStatus + '</td>' +
                    '<td class="col-sm-1">' + item.tipoStatus + '</td>' +
                    '<td class="col-sm-1 responsavel">' + item.responsavelStatus + '</td>' +
                    '<td class="col-sm-1">' + item.area + '</td>' +
                    '<td class="col-sm-7 Nenhum">' + item.analiseHistorico + '</td>' +
                '</tr>';
        }

        $(linha).appendTo('#historico>tbody');

        if (unidade != '5459') {
            $('.responsavel').remove();
        }; 
    });

};
