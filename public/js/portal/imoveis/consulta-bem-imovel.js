var csrfVar = $('meta[name="csrf-token"]').attr('content');
var obs = '';
var historicofatiado = '';

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
        } else if ($('#statusProposta').html() == 'Desclassificada' || $('#statusProposta').html() == 'Desistência' || $('#statusProposta').html() == 'Indeferido') {
            $('#custon-tabs-li-contratacao').remove()
            $('#custon-tabs-li-aviso').css('display', 'block')

        }

        if ($('#statusImovel').html() == 'Vendido'){
            $('#custon-tabs-li-laudos').remove()
            $('#custon-tabs-li-Pagamentos').css('display', 'block')
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
    }, 1000);

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

setTimeout(function()
{ 
var classificacao = $('#classificacao').text()
if (classificacao == 'Oriundos SFI-Gar. Fiduciária' || classificacao == 'Patrimonial -Realização de Garantia' ||
    classificacao == 'EMGEA - Realização de Garantia' ){
    $('#consultaLeilaoNegativo').remove();
}
}, 4000);

$.getJSON('/estoque-imoveis/leiloes-negativos/codigo-correio/' + numeroContrato, function(dados){
    $.each(dados, function(key, item) {
        codigo = 
                `<li>${item.codigoDoCorreio}</li>`
        $(codigo).appendTo('#codigoDoCorreio')

    })
})

//Aba Pagamentos
var totalSomaPagamentos = 0
var somavaloresPag = 0
$("#custon-tabs-li-Pagamentos").one( "click", function() {
    $.getJSON('/pagamentos/' + numeroContrato, function(dados){
        $.each(dados, function(key, item) {
            valorParaSoma = (item.valor) / 100;
            somavaloresPag = valorParaSoma + somavaloresPag;
            totalSomaPagamentos = somavaloresPag.toLocaleString('pt-BR',{minimumFractionDigits: 2});
            $('#totalValoresPagamento').text('R$ ' + totalSomaPagamentos)

            if(item.valorPagamento == 'null' || item.valorPagamento == null){
                item.valorPagamento = '0,00'  
            } 
            if(item.servico == 'null' || item.servico == null){
                item.servico = ''  
            } 
            if(item.numeroCompromisso == 'null' || item.numeroCompromisso == null){
                item.numeroCompromisso = ''  
            }
           
            let linha =
                `<tr>
                    <td>${item.credor}</td>
                    <td>${item.servico}</td>
                    <td>`+moment(item.referenciaDe).format('DD/MM/YYYY')+`</td>
                    <td>`+moment(item.referenciaAte).format('DD/MM/YYYY')+`</td>
                    <td>`+moment(item.dataPagamento).format('DD/MM/YYYY')+`</td>
                    <td>R$ ${item.valorPagamento}</td>
                    <td>R$ ${item.valorParcela}</td>
                    <td>${item.numeroCompromisso}</td>
    
                </tr>`
                    $(linha).appendTo('#tblPagamentos>tbody');

        });
    })
    $.getJSON('/pagamentos/ddq-1/' + numeroContrato, function(dados){
        $.each(dados, function(key, item) {
            let linha =
                `<tr>
                    <td>${item.tipoPagamento}</td>
                    <td>R$ ${item.valorPagamento}</td>
                </tr>`
                    $(linha).appendTo('#tblDDQ1>tbody');

        });
    })
    $.getJSON('/pagamentos/ddq-2/' + numeroContrato, function(dados){
        $.each(dados, function(key, item) {
            let linha =
                `<tr>
                    <td>${item.tipoPagamento}</td>
                    <td>R$ ${item.valorPagamento}</td>
                </tr>`
                    $(linha).appendTo('#tblDDQ2>tbody');

        });
    })
    $.getJSON('/pagamentos/ddq/' + numeroContrato, function(dados){
        $.each(dados, function(key, item) {
            if(item.status == "Data de Alienação"){
                $('#dataAlienacao').text(item.valores)
            }else if(item.status == "Devolução ao Ex-Mutuário"){
                $('#devExMutuario').text("R$ " + item.valores)
            }else if(item.status == "Valor de Alienação"){
                $('#valorAlienacao').text("R$ " + item.valores)
            }else if(item.status == "Resultado da Alienação"){
                $('#resultAlienacao').text("R$ " + item.valores)
            }else if(item.status == "Leilão"){
                $('#leilao').text(item.valores)
            }

        });
    })
    var somavalores = 0;
    var totalSoma = 0;
    $.getJSON('/pagamentos/cdp/' + numeroContrato, function(dados){
        $.each(dados, function(key, item) {
            //Formata valores
            valor = item.valor
            valorFormatado = Number(valor)/ 100
            valorBRL = valorFormatado.toLocaleString('pt-BR',{minimumFractionDigits: 2});
            
            // tira null
            if (item.processo == null){
                item.processo = ''
            }
            if (item.cnpj == null){
                item.cnpj = ''
            }
            if (item.sq == null){
                item.sq = ''
            }
            if (item.tp == null){
                item.tp = ''
            }
            let linha =
                `<tr>
                    <td>${item.processo}</td>
                    <td>${item.cnpj}</td>
                    <td>${item.dataPagamento}</td>
                    <td>${item.sq}</td>
                    <td>${item.tp}</td>
                    <td>${item.despesa}</td>
                    <td>R$ ${valorBRL}</td>
                    <td>${item.pg}</td>
                    <td>${item.cla}</td>

                </tr>`
        $(linha).appendTo('#tblCDP>tbody');

        somavalores = valorFormatado + somavalores;
        totalSoma = somavalores.toLocaleString('pt-BR',{minimumFractionDigits: 2});
        });
        $('#totalValoresCDP').text('R$ ' + totalSoma)
    })
})