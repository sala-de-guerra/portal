function _formataTabelaMensagensEnviadas (numeroContrato) {
        $("#custom-tabs-one-mensagens-tab").one( "click", function() {
        $.getJSON('/estoque-imoveis/consulta-mensagens-enviadas/' + numeroContrato, function(dados){
            if (dados.length !== 0) {
                $.each(dados.mensagens, function(key, item) {
                    var linha = 
                        '<tr>' +
                            '<td>' + item.idMensagem + '</td>' +
                            '<td>' + item.tipoMensagem + '</td>' +
                            '<td>' + item.codigoAgencia + '</td>' +
                            '<td>' + item.emailProponente + '</td>' +
                            '<td>' + item.emailCorretor + '</td>' +
                            '<td class="formata-data">' + item.dataEnvio + '</td>' +
                        '</tr>';
                    $(linha).appendTo('#tblMensagensEnviadas>tbody');
                })
            }
            _formataDatatableComId ("tblMensagensEnviadas");
            _formataData();
        });
    })
};