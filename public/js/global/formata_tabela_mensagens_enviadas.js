
function _formataTabelaMensagensEnviadas (numeroContrato) {

    $.getJSON('/estoque-imoveis/consulta-mensagens-enviadas/' + numeroContrato, function(dados){

        $.each(dados.mensagens, function(key, item) {
            var linha = 
                '<tr>' +
                    '<td>' + item.tipoMensagem + '</td>' +
                    '<td>' + item.codigoAgencia + '</td>' +
                    '<td>' + item.emailProponente + '</td>' +
                    '<td>' + item.emailCorretor + '</td>' +
                    '<td class="formata-data-sem-hora">' + item.dataEnvio + '</td>' +
                '</tr>';
            
            $(linha).appendTo('#tblMensagensEnviadas>tbody');
        })

    });

};