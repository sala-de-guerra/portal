function _formataTabelaDespesasDistrato (numeroContrato) {
    $.getJSON('/estoque-imoveis/distrato/consultar-dados-demanda/' + numeroContrato, function(dados){
        $.each(dados, function(key, item) {
            var linha =
                '<tr>' +
                    '<td>' + item.tipoDespesaDistrato + '</td>' +
                    '<td>' + item.valorDespesaDistrato + '</td>' +
                    '<td>' + item.dataEfetivaDespesaDistrato + '</td>' +
                '</tr>';
            $(linha).appendTo('#tblDespesasDistrato' + item.idDistrato +'>tbody');
        });
    });
};