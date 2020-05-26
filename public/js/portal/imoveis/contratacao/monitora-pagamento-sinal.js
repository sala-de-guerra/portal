$(document).ready(function(){
    $.getJSON('estoque-imoveis/acompanha-contratacao/listar-contratos-sem-pagamento-sinal', function(dados){
        $.each(dados, function(key, item) {          
            var linha = 
                '<tr class="cursor-pointer">' +
                    '<td>' + item.numeroContrato + '</td>' +
                    '<td class="formata-data-sem-hora">' + item.dataProposta + '</td>' +
                    '<td class="formata-data-sem-hora">' + item.vencimentoPp15 + '</td>' +
                    '<td>' + item.statusSimov + '</td>' +
                    '<td>' + item.classificacaoImovel + '</td>' +
                '</tr>';
            $(linha).appendTo('#tblContratosSemPagamentoSinal>tbody'); 
        })
        _formataData();
        _formataDatatable();
    });
});
