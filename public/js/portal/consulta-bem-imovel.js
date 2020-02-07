var csrfVar = $('meta[name="csrf-token"]').attr('content');

$(document).ready(function(){

    _formataTabelaHistorico (numeroContrato);
    _formataTabelaMensagensEnviadas (numeroContrato);
    _formataListaDistrato (numeroContrato);
    setTimeout(function() {
        _formataData();
        _formataValores();
    }, 4000);


    $.getJSON('/estoque-imoveis/consulta-contrato/' + numeroContrato, function(dados){

        var numeroBem = dados.numeroBem;
        // var dossieDigital = dados.dossieDigital;
        // _formataTabelaDocumentos (numeroBem, dossieDigital);
        // _formataTabelaLaudos (numeroBem);


        $.each(dados, function(key, item) {
            $('#' + key).html(item);
        });

        $('#linkServidor').attr('onClick',"window.open('\\sp7257sr001/PUBLIC/EstoqueImoveis/" + numeroContrato + "')");
        $('#linkXimoveis').attr('onClick','window.open("https://venda-imoveis.caixa.gov.br/sistema/detalhe-imovel.asp?hdnOrigem=index&hdnimovel=' + numeroBem + '")');

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