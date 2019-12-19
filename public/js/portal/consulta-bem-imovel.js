$(document).ready(function(){
    $.getJSON('/estoque-imoveis/consulta-contrato/' + numeroContrato, function(dados){

        var progress = '';

        $('.progress-bar').css("width", function() {

            switch (dados.statusImovel) {

                case "1º leilão SFI":
                case "2º leilão SFI":
                    progress = 20
                    break;
                
                case "Publicado":
                    progress = 40
                    break;

                case "Em Contratação":
                    progress = 60
                    break;

                case "Distrato":
                    progress = 60
                    break;

                case "Vendido":
                    progress = 100
                    break;
        
            }
            return progress + "%";
        });
        
        if (progress >= 20) {
            $('.progress-leilao').removeClass('bg-secondary').addClass('bg-green');
        }
        if (progress >= 40) {
            $('.progress-venda').removeClass('bg-secondary').addClass('bg-green');
        }
        if (progress >= 60) {
            $('.progress-contratacao').removeClass('bg-secondary').addClass('bg-green');
        }
        if (progress >= 80) {
            $('.progress-distrato').removeClass('bg-secondary').addClass('bg-green');
        }
        if (progress == 100) {
            $('.progress-vendido').removeClass('bg-secondary').addClass('bg-green');
        }


        // var numeroBem = dados.numeroBem;
        // var dossieDigital = dados.dossieDigital;

        // _formataTabelaDocumentos (numeroBem, dossieDigital);

        // _formataTabelaLaudos (numeroBem);


        $.each(dados, function(key, item) {
            $('#' + key).html(item);
        });


        _formataDatatable ();
    });


    // var tamanhoMaximoView = 8;
    // var tamanhoMaximo = 8388608;

    // _animaInputFile();

    _formataTabelaHistorico (numeroContrato);
    _formataTabelaMensagensEnviadas (numeroContrato);

});