var csrfVar = $('meta[name="csrf-token"]').attr('content');
var obs = '';
var historicofatiado = '';
$(document).ready(function(){    
    $.getJSON('/estoque-imoveis/consulta-contrato/' + numeroContrato, function(dados){
        var numeroBem = dados.numeroBem;

        $.each(dados, function(key, item) {
            $('#' + key).html(item);
            $('#statusImovelLeilao').html(dados.statusImovel);
            $('#matriculaImovelLeilao').html(dados.matriculaImovel);

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
        // CASO NÃO EXISTA DADOS DE PROPONENTE REMOVER A RESPECTIVA ABA DA CONSULTA
        if ($('#nomeProponente').html() == '' || $('#nomeProponente').html() == null) {
            $('#custon-tabs-li-contratacao').remove();
        } else if ($('#statusProposta').html() == 'Desistência') {
            $('#custon-tabs-li-contratacao').remove()
        }
    });

    /****************************************************\
    | Monta a Progress Bar do Projeto de Leilão Negativo |
    \****************************************************/
    var arrayPorcentagemStatusLeilaoNegativo = {
        0: "Leiloeiro",
        25: "GILIE",
        50: "Despachante",
        75: "Cartório",
        99: "Averbado",
    };

    setTimeout(function() {
        _formataTabelaHistorico (numeroContrato);
        _formataTabelaMensagensEnviadas (numeroContrato);
        _formataListaDistrato (numeroContrato);
        setTimeout(function() {
            _formataData();
            _formataValores();
            var historicoConsultaLeilaoNegativo = window.document.getElementById('historicoLeilaoNegativo')
            historicoConsultaLeilaoNegativo.innerHTML = historicofatiado
            var paragrafoHistoricoleilaoNegativoCompleto = window.document.getElementById('paragrafoHistoricoleilaoNegativoCompleto')
            paragrafoHistoricoleilaoNegativoCompleto.innerHTML = obs
            if ($('#statusAverbacao').text() !== "") {
                _formataProgressBar ("progressBarLeilaoNegativo", arrayPorcentagemStatusLeilaoNegativo, $('#statusAverbacao').text());
            } else {
                $('#consultaLeilaoNegativo').remove();
            } 
            let consultaDistrato = window.document.getElementById('listaDistratos')
            if (!consultaDistrato) {
                $('#custom-tabs-one-distrato-tab').remove();
            }           
        }, 3800);
    }, 500);

});

function avisoMensageria(url) {
    Swal.fire({
    titleText: 'Deseja realmente enviar a autorização de contratação?',
    text: "certifique-se de que a PP15 foi paga",
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sim, enviar!',
    cancelButtonText: "Cancelar",
    
    }).then((result) => {
        if (result.value == true) {
            $.get(url, function(){
                if (result.value) {
                    Swal.fire(
                        'Mensagem enviada!',
                        'A mensagem foi enviada com sucesso',
                        'success'
                        )
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            })
        } 
    })   
}