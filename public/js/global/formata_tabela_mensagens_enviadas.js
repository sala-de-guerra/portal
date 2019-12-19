
function _formataTabelaMensagensEnviadas (numeroContrato) {

    $.getJSON('/estoque-imoveis/consulta-mensagens-enviadas/' + numeroContrato, function(mensagens){

        $.each(mensagens, function(key, item) {
            var linha = 
                '<tr>' +
                    '<td>' + item.tipoMensagem + '</td>' +
                    '<td>' + item.codigoAgencia + '</td>' +
                    '<td>' + item.emailProponente + '</td>' +
                    '<td>' + item.emailCorretor + '</td>' +
                    '<td>' + item.dataEnvio + '</td>' +
                '</tr>';
            
            $(linha).appendTo('#tblMensagensEnviadas>tbody');
        })

    });

};