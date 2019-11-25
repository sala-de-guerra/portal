//Função global que monta a tabela de arquivos do arquivo formata_tabela_documentos.js

function _formataTabelaLaudos (numeroBem) {

    var urlDiretorioVirtual = '../img/mock/';

    var linha = 
        '<tr>' +
            '<td>' +
                '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalLaudo">' +
                    '<i class="fas fa-search-plus"></i>' +
                    '   Visualizar' +
                '</button>' +
                '<div class="modal fade" id="modalLaudo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                    '<div class="modal-dialog mw-100 w-75" role="document">' +
                        '<div class="modal-content">' +
                            '<div class="modal-header">' +
                                '<h5 class="modal-title" id="exampleModalLabel">Laudo</h5>' +
                                '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                                '<span aria-hidden="true">&times;</span>' +
                                '</button>' +
                            '</div>' +
                            '<div class="modal-body">' +
                                '<embed src="' + urlDiretorioVirtual + numeroBem + '.pdf" width="100%" height="650px" />' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>' +           
            '</td>' +
            '<td id="numeroLaudo"></td>' +
            '<td id="dataLaudo"></td>' +
            '<td id="dataVencimentoLaudo"></td>' +
            '<td id="dataUploadLaudo"></td>' +
        '</tr>';
    
    $(linha).appendTo('#tblLaudos>tbody');

};

