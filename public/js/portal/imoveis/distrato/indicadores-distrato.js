$(document).ready(function(){

    $.getJSON('/estoque-imoveis/distrato/indicadores-distrato', function(dados){

        var linha = 
            '<tr>' +
                '<td><p class="text-center">' + dados.quantidadeDemandasNaoIniciadas + '</p></td>' +
                '<td><p class="text-center">' + dados.quantidadeDemandasEmTratamentoGilie + '</p></td>' +
                '<td><p class="text-center">' + dados.quantidadeDemandasEmTratamentoAgencia + '</p></td>' +
                '<td><p class="text-center">' + dados.quantidadeDemandasPendentesJurirEmgea + '</p></td>' +
                '<td><p class="text-center">' + dados.quantidadeDemandasConcluidas + '</p></td>' +
                '<td><p class="text-center">' + dados.tmaDemandasDistratoConcluidas + '</p></td>' +
            '</tr>';
        $(linha).appendTo('#tblIndicadoresDistrato>tbody'); 

        _formataDatatable();
        _formataData();

    });
});