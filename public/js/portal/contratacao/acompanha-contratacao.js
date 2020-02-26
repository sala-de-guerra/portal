$(document).ready(function(){
    $(".menu-hamburguer").click();

    $.getJSON('/estoque-imoveis/acompanha-contratacao/listar-contratos-em-contratacao-ultimos-sessenta-dias', function(dados){
        $.each(dados, function(key, item) {

            elementoLinkServidor = "'#linkServidor" + item.numeroContrato + "'";

            var linha =
            '<tr>' +
                '<td>' + item.numeroContrato + '</td>' +
                '<td>' + item.classificacaoImovel + '</td>' +
                '<td>' + item.tipoVenda + '</td>' +
                '<td>' + item.nomeProponente + '</td>' +
                '<td>' + item.cpfCnpjProponente + '</td>' +
                '<td class="formata-data-sem-hora">' + item.dataProposta + '</td>' +
                '<td>' + item.quantidadeDiasAposProposta + '</td>' +
                '<td>' + item.cardAgrupamentoContratacao + '</td>' +
                '<td>' + item.statusConformidadeContratacao + '</td>' +
                '<td class="justify-content-center align-items-center">' +
                    // '<div class="row">' +
                    //     '<div class="col-sm">' +
                    //         '<button id="btnLinkServidor" onclick="copyToClipboard(' + elementoLinkServidor + ')" class="btn btn-outline-primary ml-2" data-toggle="tooltip" data-placement="top" title="Copiar link do servidor"><i class="far fa-copy"></i></button>' +
                    //         '<a href="file://///sp7257sr001/PUBLIC/EstoqueImoveis/' + item.contratoFormatado + '" id="linkServidor' + item.numeroContrato + '" hidden></a>' +
                    //     '</div>' +
                    // '</div>'+
                    '<div class="row">' + 
                        '<div class="col-sm">' +
                            '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAcompanhaContratacao' + item.numeroContrato + '" ><i class="fas fa-edit"></i></button>' +
                        '</div>'+
                    '</div>'+
                    
                '</td>' +
                '</td>' +
            '</tr>';

            $(linha).appendTo('#tblContratosContratacaoUltimoSessentaDias>tbody');
            montaModal(item);
        });
        _formataData();  
    });
    setTimeout(function() {
        _formataDatatableComId('tblContratosContratacaoUltimoSessentaDias');
    }, 2000);
}); 

function montaModal(objetoContratacao)
{
    _token = $('meta[name="csrf-token"]').attr('content');
    
    modal = '<div class="modal fade" id="modalAcompanhaContratacao' + objetoContratacao.numeroContrato + '" tabindex="-1" role="dialog" aria-labelledby="modalAcompanhaContratacaoLabel" aria-hidden="true">' +
                '<div class="modal-dialog" role="document">' +
                    '<div class="modal-content">' +
                        '<div class="modal-header">' +
                            '<h5 class="modal-title" id="modalAcompanhaContratacaoLabel">Acompanhamento Contratação ' + objetoContratacao.numeroContrato + '</h5>' +
                            '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">' +
                                '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                        '</div>' +
                        '<form class="col-md-12" action="/estoque-imoveis/acompanha-contratacao/atualizar/' + objetoContratacao.numeroContrato + '" method="POST"></form>' +
                        '<div class="modal-body">' +
                            '<input type="hidden" name="_method" value="PUT"></input>' +
                            '<input type="hidden" name="_token" value="' + _token + '">' +
                            '<div class="row">' +
                                '<label>Status:' +    
                                    '<select name="tratado" class="form-control">' +
                                        '<option disabled selected>Selecione</option>' +
                                        '<option value="tratado">Tratado</option>' +
                                        '<option value="pendente">Pendente</option>' +
                                    '</select>' +
                                '</label>' +
                            '</div>' +
                        '</div>' +
                        '<div class="modal-footer">' +
                            '<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>' +
                            '<button type="button" class="btn btn-primary">Salvar</button>' +
                        '</div>' +
                        '</form>'
                    '</div>' +
                '</div>' +
            '</div>';

    $(modal).appendTo('body');
}

function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).attr('href')).select();
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