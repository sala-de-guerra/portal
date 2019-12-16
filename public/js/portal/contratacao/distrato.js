$(document).ready(function(){

    $.getJSON('/estoque-imoveis/controle-distrato', function(dados){

        $.each(distratos, function(key, item) {
            var linha = 
                '<tr href="/consulta-bem-imovel/' + item.bemFormatado + '>' +
                    '<td>' + item.bemFormatado + '</td>' +
                    '<td>' + item.nomeProponente + '</td>' +
                    '<td>' + item.cpfCnpjProponente + '</td>' +
                    '<td>' + item.statusDistrato + '</td>' +
                    '<td>' + item.MotivoDistrato + '</td>' +
                '</tr>';
            
            $(linha).appendTo('#tblDistrato>tbody');
        })
    
    });

    _formataDatatable ();

});