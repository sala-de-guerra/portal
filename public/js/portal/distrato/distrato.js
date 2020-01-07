$(document).ready(function(){

    $.getJSON('/estoque-imoveis/distrato/listar-protocolos', function(dados){

        $.each(distratos, function(key, item) {
            var linha = 
                '<tr href="/consulta-bem-imovel/' + item.contratoFormatado + '>' +
                    '<td>' + item.contratoFormatado + '</td>' +
                    '<td>' + item.nomeProponente + '</td>' +
                    '<td>' + item.statusAnalise + '</td>' +
                    '<td>' + item.motivoDistrato + '</td>' +
                    '<td>' + item.created_at + '</td>' +
                    '<td>' + '</td>' +
                '</tr>';
            
            $(linha).appendTo('#tblDistrato>tbody');
        })
    
    });

    _formataDatatable ();

});