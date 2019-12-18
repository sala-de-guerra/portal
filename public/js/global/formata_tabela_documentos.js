//Função global que monta a tabela de arquivos do arquivo formata_tabela_documentos.js

function _formataTabelaDocumentos (numeroBem, dossieDigital) {

    var urlDiretorioVirtual = '../img/mock/';
    
    $.each(dossieDigital, function(key, item) {
        var linha = 
            '<tr>' +
                '<td>' +
                    '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalArquivo' + item.idDocumento + '">' +
                        '<i class="fas fa-search-plus"></i>' +
                        '   Visualizar' +
                    '</button>' +
                    '<div class="modal fade" id="modalArquivo' + item.idDocumento + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                        '<div class="modal-dialog mw-100 w-75" role="document">' +
                            '<div class="modal-content">' +
                                '<div class="modal-header">' +
                                    '<h5 class="modal-title">' + item.tipoDocumento + ' ' + item.nomeDocumento + '</h5>' +
                                    '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                                    '<span aria-hidden="true">&times;</span>' +
                                    '</button>' +
                                    '<a class="btn btn-primary pull-right" href="' + urlDiretorioVirtual + item.caminhoDoDocumento + '" download="' + item.tipoDoDocumento + '">Baixar arquivo</a>' +
                                '</div>' +
                                '<div class="modal-body">' +
                                    '<embed src="' + urlDiretorioVirtual + numeroBem + '.pdf" width="100%" height="650px" />' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +           
                '</td>' +
                '<td>' + item.idDocumento + '</td>' +
                '<td>' + item.nomeDocumento + '</td>' +
                '<td>' + item.tipoDocumento + '</td>' +
                '<td>' + item.dataUpload + '</td>' +
            '</tr>';
        
        $(linha).appendTo('#tblDossieDigital>tbody');
    })

};

