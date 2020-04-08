var csrfVar = $('meta[name="csrf-token"]').attr('content');

$(document).ready(function(){
    var obs = '';
    _formataTabelaHistorico (numeroContrato);
    _formataTabelaMensagensEnviadas (numeroContrato);
    _formataListaDistrato (numeroContrato);
    setTimeout(function() {
        _formataData();
        _formataValores();
    }, 4000);


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
        // VERIFICA O STATUS NO SIMOV PARA REMOVER O ANUNCIO NO X IMÓVEIS
        switch (dados.statusImovel) {
            case 'Em Análise':
            case 'Em Cadastramento':
            case 'Aguarda Justif. Avaliação':
            case 'Em Pendência':
            case 'Em Reavaliação':
            case 'Aguarda Licitação':
            case 'Arrendado':
            case 'Devolvido':
            case 'Excluído':
            case 'Indício de Fraude':
            case 'Laudo Vencido':
            case 'Venda Direta Ocupante':
            case 'Venda por credenciado':
            case 'Montagem de Licitação':
            case 'Aguarda 1º Leilão SFI':
            case 'Aguarda 2º Leilão SFI':
            case 'Em Homologação':
            case 'Em Contratação':
            case 'Contratação pendente':
            case 'Vendido':
            case 'Venda Direito Preferência':
            case 'Venda Direta Beneficiário':          
                var anuncioSiteCaixa = document.getElementById('anuncioSiteCaixa');
                anuncioSiteCaixa.remove(); 
                break;
        }

        // CASO NÃO EXISTA DADOS DE PROPONENTE E LEILÃO, REMOVER AS RESPECTIVAS ABAS DA CONSULTA
        // if ($('#nomeProponente').html() == '' || $('#nomeProponente').html() == null) {
        //     $('#custon-tabs-li-contratacao').remove();
        // }
        // if ($('#dataPrimeiroLeilao').html() == '' || $('#dataPrimeiroLeilao').html() == null) {
        //     $('#custon-tabs-li-leiloes').remove();
        // }
    });


    // var tamanhoMaximoView = 8;
    // var tamanhoMaximo = 8388608;

    // _animaInputFile();

});