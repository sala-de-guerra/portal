function _formataDatatableComData (idTabela){
    $('#' + idTabela).DataTable({
        "order": [[ 0, "asc" ]],  //vai pegar a 1a coluna e colocar os dados de forma crescente
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
    $.getJSON('/contratacao/controle-sap/lista-universo', function(dados){
        $.each(dados, function(key, item) {{

            var tabela = `
                <tr>
                    <td>${item.gilie}</td>
                    <td><a href="/consulta-bem-imovel/${item.contratoFormatado}" class="cursor-pointer" target="_blank">${item.nuBEM}</a></td>
                    <td>${item.proponente}
                    
                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalDadosProponente${item.nuBEM}"><i style="color: #054f77; font-size: 13pt;" class="fas fa-info-circle"></i></button>
    
                    <div class="modal fade" id="modalDadosProponente${item.nuBEM}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                    <h5 class="modal-title" style="color: white;">Dados do Proponente ${item.proponente}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Nome:</label>
                                        <p>${item.proponente}</p>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>CPF/CNPJ:</label>
                                        <p>${item.cpfCnpjProponente}</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Endereço do proponente:</label>
                                        <p>${item.endereco}</p>
                                        <p>${item.cidade} / ${item.uf} / ${item.cep}</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div> 
                    </td>

                    <td>${item.cpfCnpjProponente}</td>
                    <td>${item.dataEntradaSimov}</td>
                    <td>${item.objLocacao}</td>
                    <td>${item.numeroImobilizado}</td>
                    <td>${item.numeroEdificio}</td>
                    <td style="white-space:nowrap;">R$ ${item.valorBoleto}</td>
                    <td>${item.dataPagamento}</td>
                </tr>
                `
                $(tabela).appendTo('#tblSap>tbody');
            }
        })
    }).done(function() {
        _formataDatatableComData("tblSap")
    })
})
