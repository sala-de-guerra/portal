//Função global que monta a tabela de arquivos do arquivo formata_tabela_documentos.js

function _formataTabelaLaudos () {

    // var urlDiretorioVirtual = 'https://inova.ceopc.des.caixa/uploads/';
    
    var linhas = 
        '<tr>' +
            '<td>' +
                '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">' +
                    '<i class="fas fa-search-plus"></i>' +
                    '   Visualizar' +
                '</button>' +
                '<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                    '<div class="modal-dialog" role="document">' +
                        '<div class="modal-content">' +
                            '<div class="modal-header">' +
                                '<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>' +
                                '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                                '<span aria-hidden="true">&times;</span>' +
                                '</button>' +
                            '</div>' +
                            '<div class="modal-body">' +
                                '<embed src="img/mock/00.0000.0001766-3M.pdf" width="100%" height="650px" />' +
                            '</div>' +
                            '<div class="modal-footer">' +
                                '<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>' +           
            '</td>' +
            '<td>456654</td>' +
            '<td>01/11/2019</td>' +
            '<td>01/11/2019</td>' +
            '<td>01/05/2020</td>' +
        '</tr>';
    
    $(linhas).appendTo('#tblLaudos>tbody');

};

