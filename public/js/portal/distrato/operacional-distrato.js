var csrfVar = $('meta[name="csrf-token"]').attr('content');


$(document).ready(function(){

    $("#custom-tabs-one-distrato-tab").click();
    
    _formataTabelaHistorico (numeroContrato);
    _formataTabelaMensagensEnviadas (numeroContrato);
    _formataListaDistrato (numeroContrato, "operacional");
    _formataDatatable();


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

    
    });

    // var tamanhoMaximoView = 8;
    // var tamanhoMaximo = 8388608;

    // _animaInputFile();

});

// RESETAR CAMPOS DOS FORM AO FECHAR O MODAL

$(".modal").on('hidden.bs.modal', function(e){
    $(this).find("form")[0].reset();       
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