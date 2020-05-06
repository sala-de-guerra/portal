var csrfVar = $('meta[name="csrf-token"]').attr('content');

$(document).ready(function(){
    $(".menu-hamburguer").click();

    $.when($.getJSON('/estoque-imoveis/conformidade-contratacao/listar-contratos', function(dados){
        $.each(dados, function(key, item) {

            elementoLinkServidor = "'#linkServidor" + item.numeroContrato + "'";

            var linha =
            '<tr>' +
                '<td>' + item.numeroContrato + '</td>' +
                '<td>' + item.codigoAgencia + '</td>' +
                '<td>' + item.tipoVenda + '</td>' +
                '<td>' + item.tipoProposta + '</td>' +
                '<td class="formata-valores">' + item.valorRecursosProprios + '</td>' +
                '<td class="formata-valores">' + item.valorTotalRecebido + '</td>' +
                '<td>' + item.statusContratacao + '</td>' +
                '<td>' + item.cardAgrupamento + '</td>' +
                '<td>' + item.dataEntradaConformidade + '</td>' +
                '<td>' +
                    '<div class="row">' +
                        '<button id="btnLinkServidor" onclick="copyToClipboard(' + elementoLinkServidor + ')" class="btn btn-outline-primary ml-2" data-toggle="tooltip" data-placement="top" title="Copiar link"><i class="far fa-copy"></i></button>' +
                        '<a href="file://///sp7257sr001/PUBLIC/EstoqueImoveis/' + item.contratoFormatado + '" id="linkServidor' + item.numeroContrato + '" hidden></a>' +
                    '</div>' +
                '</td>' +
                '<td>' +
                    '<div class="row">' +
                        '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalObservacao'+ item.numeroContrato +'" data-whatever="@mdo"><i class="fas fa-info-circle"></i></button>' +
                    '</div>' +
                    // Modal de Observação
                '<div class="modal fade" id="modalObservacao'+ item.numeroContrato +'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">'+
                '<div class="modal-dialog" role="document">'+
                    '<div class="modal-content">'+
                        '<div class="modal-header">'+
                            '<h5 class="modal-title" id="exampleModalLabel">'+'Observação'+'</h5>'+
                            '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                        '<span aria-hidden="true">&times;</span>'+
                        '</button>'+
                    '</div>'+
                    '<div class="modal-body">'+
                        '<form method="post" action="/estoque-imoveis/registrar-historico/' + item.contratoFormatado+ '">' +
                        '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                        '<input type="hidden" name="tipoAtendimento" value="ANALISE"></input>'+
                        '<input type="hidden" name="atividadeAtendimento" value="CONFORMIDADE"></input>'+
                        '<div class="form-group">'+
                            '<textarea name="observacaoAtendimento" class="form-control" rows="10"></textarea>'+
                        '</div>'+
                    '<div class="modal-footer">'+
                        '<button type="button" class="btn btn-secondary" data-dismiss="modal">'+'Fechar'+'</button>'+
                        '<button type="submit" class="btn btn-primary">'+'Salvar'+'</button>'+
                    '</div>'+
                    '</form>'+
                    '</div>'+
                '</div>'+
                '</div>'+

                '</td>' +
            '</tr>';
            if (item.cardAgrupamento == "Agência") {
                $(linha).appendTo('#tblCardAgrupamentoAgencia>tbody');
            } else if (item.fluxoContratacao == "AG") {
                $(linha).appendTo('#tblConformidadeFluxoAgencia>tbody');
            } else {
                $(linha).appendTo('#tblConformidadeFluxoCca>tbody');
            }
        });
    })).done(function() { 
        _formataValores();
        _formataDatatable();
    });
});