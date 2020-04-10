var csrfVar = $('meta[name="csrf-token"]').attr('content');

$(document).ready(function(){
    // $("#custom-tabs-one-leiloes-tab").click();
    // var arrayPorcentagemEStatus = {
    // 0: "Preparaçâo",
    // 25: "Leilão",
    // 50: "Venda Online",
    // 75: "Contratação",
    // 99: "Vendido",
    // };
    // _formataProgressBar ("progressBarGeral", arrayPorcentagemEStatus, dados.statusImovel);
    var appendbotao = '<div class="row">'+ 
                            '<div class="col-sm-3">'+
                        '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalbotaokit">'+
                            'Receber documentos Leiloeiro'+
                        '</button>'+
                            '</div>'+
                            '<div class="col-sm-3">'+
                        '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalbotaodespachante">'+
                            'Entregar ao despachante'+
                        '</button>'+
                        '</div>'+
                       '</div>'
    $(appendbotao).appendTo("#LeilaoNegativo")
});

/***************************************************\
| Torna required campo do form de acordo com select |
\***************************************************/

$('#statusLeiloesNegativos').change(function () {
    $('#dataRetiradaDespachante').val('');
    if ($(this).val() === 'rede') {
        
    }
})