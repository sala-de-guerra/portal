var csrfVar = $('meta[name="csrf-token"]').attr('content');

$(document).ready(function(){

    _formataTabelaHistorico (numeroContrato);
    _formataTabelaMensagensEnviadas (numeroContrato);
    _formataListaDistrato (numeroContrato);

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
            50: "Venda Online",
            75: "Contratação",
            99: "Vendido",
        };

        _formataProgressBar ("progressBarGeral", arrayPorcentagemEStatus, dados.statusImovel);
        _formataDatatable();
        _formataData();
    
    });

    // var tamanhoMaximoView = 8;
    // var tamanhoMaximo = 8388608;

    // _animaInputFile();

});

function copyToClipboard(element) {

    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();

    $(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        Toast.fire({
            icon: 'success',
            title: 'Copiado com sucesso!'
        })    
    })
}