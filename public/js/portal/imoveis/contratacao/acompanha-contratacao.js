function _formataDatatableContratacao (){
    $('.dataTable').DataTable({
        "order": [[ 2, "asc" ]],
        columnDefs: [
            {type: 'date-uk', targets: 2}
        ],
        "scrollX": true,
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "Mostrar _MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        }
    });
};


$(document).ready(function(){
    $(".menu-hamburguer").click();

    $.getJSON('/estoque-imoveis/acompanha-contratacao/listar-contratos-em-contratacao-ultimos-sessenta-dias', function(dados){
        $.each(dados, function(key, item) {

            elementoLinkServidor = "'#linkServidor" + item.numeroContrato + "'";

            var linha =
            '<tr>' +
                '<td>' + item.idAcompanhamentoContratacao + '</td>' +
                '<td>' + item.numeroContrato + '</td>' +
                '<td class="formata-data-sem-hora">' + item.dataProposta + '</td>' +
                '<td>' + item.classificacaoImovel + '</td>' +
                '<td>' + item.tipoVenda + '</td>' +
                '<td>' + item.nomeProponente + '</td>' +
                '<td>' + item.cpfCnpjProponente + '</td>' +
                '<td>' + item.quantidadeDiasAposProposta + '</td>' +
                '<td>' + item.cardAgrupamentoContratacao + '</td>' +
                '<td>' + item.statusConformidadeContratacao + '</td>' +
                '<td>' + item.statusAcompanhamentoContratacao + '</td>' +
                '<td class="justify-content-center align-items-center">' +
                    // '<div class="row">' +
                    //     '<div class="col-sm">' +
                    //         '<button id="btnLinkServidor" onclick="copyToClipboard(' + elementoLinkServidor + ')" class="btn btn-outline-primary ml-2" data-toggle="tooltip" data-placement="top" title="Copiar link do servidor"><i class="far fa-copy"></i></button>' +
                    //         '<a href="file://///sp7257sr001/PUBLIC/EstoqueImoveis/' + item.contratoFormatado + '" id="linkServidor' + item.numeroContrato + '" hidden></a>' +
                    //     '</div>' +
                    // '</div>'+
                    '<div class="row">' + 
                        '<div class="col-sm">' +
                            '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAcompanhaContratacao' + item.idAcompanhamentoContratacao + '" ><i class="fas fa-edit"></i></button>' +
                        '</div>'+
                    '</div>'+
                    
                '</td>' +
                '</td>' +
            '</tr>';

            $(linha).appendTo('#tblContratosContratacaoUltimoSessentaDias>tbody');
            montaModal(item);
        }); 
    });
    $.getJSON('/estoque-imoveis/acompanha-contratacao/listar-contratos-sem-pagamento-sinal', function(dados){
        $.each(dados, function(key, item) {          
            var linha = 
                '<tr class="cursor-pointer">' +
                    '<td>' + item.numeroContrato + '</td>' +
                    '<td class="formata-valores">' + item.valorProposta + '</td>' +
                    '<td class="formata-data-sem-hora">' + item.vencimentoPp15 + '</td>' +
                    '<td>' + item.statusSimov + '</td>' +
                    '<td>' + item.classificacaoImovel + '</td>' +
                '</tr>';
            $(linha).appendTo('#tblContratosSemPagamentoSinal>tbody'); 
        })
    });
    setTimeout(function() {
        _formataData(); 
        _formataValores();
        _formataDatatableContratacao();
    }, 4000);
}); 

function montaModal(objetoContratacao)
{
    _token = $('meta[name="csrf-token"]').attr('content');
    
    modal = '<div class="modal fade" id="modalAcompanhaContratacao' + objetoContratacao.idAcompanhamentoContratacao + '" tabindex="-1" role="dialog" aria-labelledby="modalAcompanhaContratacaoLabel" aria-hidden="true">' +
                '<div class="modal-dialog" role="document">' +
                    '<div class="modal-content">' +
                        '<div class="modal-header">' +
                            '<h5 class="modal-title" id="modalAcompanhaContratacaoLabel">Acompanhamento Contratação ' + objetoContratacao.numeroContrato + '</h5>' +
                            '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">' +
                                '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                        '</div>' +
                        '<form class="col-md-12" action="/estoque-imoveis/acompanha-contratacao/atualizar/' + objetoContratacao.idAcompanhamentoContratacao + '" method="POST">' +
                        '<div class="modal-body">' +
                            '<input type="hidden" name="_method" value="PUT"></input>' +
                            '<input type="hidden" name="_token" value="' + _token + '">' +
                            '<input type="hidden" name="contratoFormatado" value="' + objetoContratacao.contratoFormatado + '">' +
                            '<div class="row">' +
                                '<label>Status:' +    
                                    '<select name="statusAcompanhamentoContratacao" class="form-control">' +
                                        '<option disabled selected>Selecione</option>' +
                                        '<option value="TRATADO">Tratado</option>' +
                                        '<option value="PENDENTE">Pendente</option>' +
                                    '</select>' +
                                '</label>' +
                            '</div>' +
                        '</div>' +
                        '<div class="modal-footer">' +
                            // '<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>' +
                            '<button type="submit" class="btn btn-primary">Salvar</button>' +
                        '</div>' +
                        '</form>' +
                    '</div>' +
                '</div>' +
            '</div>';

    $(modal).appendTo('body');
}