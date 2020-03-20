var csrfVar = $('meta[name="csrf-token"]').attr('content');

$(document).ready(function(){

    $("#custom-tabs-one-leiloes-tab").click();
    _formataTabelaHistorico (numeroContrato);
    _formataTabelaMensagensEnviadas (numeroContrato);
    _formataListaDistrato (numeroContrato) // NO FINAL DESTA FUNÇÃO É CHAMADA A FUNÇÃO _formataTabelaDespesasDistrato
    setTimeout(function() {
        _formataData();
        _formataValores();
    }, 3000);

    $.getJSON('/estoque-imoveis/consulta-contrato/' + numeroContrato, function(dados){
    // $.getJSON('../js/imovel_mockado.json', function(dados){

        var numeroBem = dados.numeroBem;
        // var dossieDigital = dados.dossieDigital;
        // _formataTabelaDocumentos (numeroBem, dossieDigital);
        // _formataTabelaLaudos (numeroBem);

        $.each(dados, function(key, item) {
            $('#' + key).html(item);
            $('#statusImovelLeilao').html(dados.statusImovel);
            $('#matriculaImovelLeilao').html(dados.matriculaImovel + ' / ' + dados.cidadeImovel);
            
            // REMOVE O BLOCO DE CONFORMIDADE CASO NÃO EXISTA DADOS DE CONFORMIDADE NO IMAGEM.CAIXA
            if (key == 'nomeStatusDossie' && item == null) {
                $('#cardTitleConformidade').remove();
                $('#brConformidade').remove();
                $('#rowConformidade').remove();
                $('#pontilhadoConformidade').remove();
            }
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

/***************************************************\
| Torna required campo do form de acordo com select |
\***************************************************/

$('#statusLeiloesNegativos').change(function () {
    $('#dataRetiradaDespachante').val('');
    if ($(this).val() === 'rede') {
        
    }
})