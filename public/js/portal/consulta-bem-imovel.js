$(document).ready(function(){
    $.getJSON('/estoque-imoveis/consulta-contrato/' + numeroContrato, function(dados){


        var numeroBem = dados.numeroBem;
        // var dossieDigital = dados.dossieDigital;

        // _formataTabelaDocumentos (numeroBem, dossieDigital);

        // _formataTabelaLaudos (numeroBem);


        $.each(dados, function(key, item) {
            $('#' + key).html(item);
        });

        var arrayPorcentagemEStatus = {
            0: "Preparaçâo",
            25: "Leilão",
            50: "Venda",
            75: "Contratação",
            99: "Vendido",
        };

        _formataProgressBar ("progressBarGeral", arrayPorcentagemEStatus, "Contratação")
        _formataDatatable ();
    });


    // var tamanhoMaximoView = 8;
    // var tamanhoMaximo = 8388608;

    // _animaInputFile();

    _formataTabelaHistorico (numeroContrato);
    _formataTabelaMensagensEnviadas (numeroContrato);

});