//Função global que monta a tabela de arquivos do arquivo formata_tabela_documentos.js

function _formataTabelaDocumentos (dados) {

    var urlDiretorioVirtual = 'https://inova.ceopc.des.caixa/uploads/';

    $.each(dados[0].esteira_contratacao_upload, function(key, item) {
        var linha = 
            '<tr>' +
                '<td>' +
                    '<div id="divModal' + item.idUploadLink + '" class="divModal">' +           
                        '<div class="radio-inline padding0">' +
                            '<a rel="tooltip" class="btn btn-primary" title="Visualizar arquivo." data-toggle="modal" data-target="#modal' + item.idUploadLink + '">' + 
                                '<span class="fa fa-search-plus"></span>' + 
                            '</a>' +
                            '<div class="modal fade" id="modal' + item.idUploadLink + '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' + 
                                '<div class="modal-dialog modal-lg">' + 
                                    '<div class="modal-content" height="600px">' + 
                                        '<div class="modal-header">' +
                                            '<h3 class="modal-title">' + item.nomeDoDocumento +
                                            '<button type="button" class="btn btn-danger pull-right margin10" data-dismiss="modal">Fechar painel</button>' +
                                            '<a class="btn btn-primary pull-right margin10" href="' + urlDiretorioVirtual + item.caminhoDoDocumento + '" download="' + item.tipoDoDocumento + '">Baixar arquivo</a>' +
                                            '</h3>' +
                                        '</div>' +
                                        '<div class="modal-body">' +
                                            '<a href="#!" class="modal-close waves-effect waves-green btn-flat" id="btn_fecha_modal"> </a>' +
                                            '<embed src="' + urlDiretorioVirtual + item.caminhoDoDocumento + '" width="100%" height="650px" />' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</td>' +
                '<td>' + item.idUploadLink + '</td>' +
                '<td>' + item.nomeDoDocumento + '</td>' +
                '<td>' + item.tipoDoDocumento + '</td>' +
                '<td class="formata-data">' + item.dataInclusao + '</td>' +
            '</tr>';
        
        $(linha).appendTo('#documentacao>tbody');

    });
};

//Função global que monta a tabela de contratos assinados do arquivo formata_tabela_documentos.js

function _formataTabelaUploadContratosAssinados (dados) {

    let _motivoInconformidade = '';

    // console.log(dados);
    
    var urlRotaPutContratoAssinado = '../carregar-contrato-assinado/';

    $.each(dados.listaContratosPendentesUpload, function(key, item) {
        if (item.motivoInconformidade !== null) {
            _motivoInconformidade = item.motivoInconformidade.replace(/\n/g, "<br/>");
        }

        if (item.temRetornoRede == 'SIM') {
            // if (item.statusContrato != 'CONTRATO ASSINADO') {
                if (item.dataArquivoContratoConforme == null) {
                    var linha = 
                        '<tr>' +
                            '<td>' +
                                '<div id="divModal' + item.idUploadContratoSemAssinatura + '" class="divModal">' +           
                                    '<div class="radio-inline padding0">' +
                                        '<a rel="tooltip" class="btn btn-primary" title="Upload de Arquivo." data-toggle="modal" data-target="#modal' + item.idUploadContratoSemAssinatura + '">' + 
                                            '<span class="fa fa-cloud-upload">  -   Clique para carregar</span>' + 
                                        '</a>' +
                                        '<div class="modal fade" id="modal' + item.idUploadContratoSemAssinatura + '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' + 
                                            '<div class="modal-dialog modal-lg">' + 
                                                '<div class="modal-content" height="300px">' + 
                                                    '<div class="modal-header">' +
                                                        '<h3 class="modal-title"> CONTRATO DE ' + item.tipoContrato + ' Nº ' + item.numeroContrato +
                                                        '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                                        '</h3>' +
                                                    '</div>' +
                                                    '<div class="modal-body">' +
                                                        '<form method="POST" action="' + urlRotaPutContratoAssinado + item.idContrato + '" enctype="multipart/form-data" id="formCarregaContratoAssinado' + item.idContrato + '">' +
                                                            '<div class="form-group radio-inline">' +
                                                                '<h4><label class="label label-warning">Para que o crédito / débito seja efetivado na conta do cliente certifique se há saldo na conta.</label></h4>' +
                                                                '<input type="text" name="tipoContrato" value="' + item.tipoContrato + '" hidden>' +
                                                                '<input type="text" name="idUploadContratoSemAssinatura" value="' + item.idUploadContratoSemAssinatura + '" hidden>' +
                                                                '<div class="col-sm-10 input-group float-left uploadContratoAssinado">' +
                                                                    '<label class="input-group-btn">' +
                                                                        '<span class="btn btn-primary front">' +
                                                                        '<i class="fa fa-lg fa-cloud-upload"></i>' +
                                                                        ' Carregar arquivo&hellip;' +
                                                                        '</span>' +
                                                                        '<input type="file" class="behind" accept=".pdf" name="uploadContratoAssinado[]" id="uploadContratoAssinado' + item.idUploadContratoSemAssinatura + '" required>' +
                                                                    '</label>' +
                                                                    '<input type="text" class="form-control previewNomeArquivo" readonly>' +
                                                                '</div>' +
                                                                '<div class="input-group col-sm-2 righth">' +
                                                                    '<button type="submit" id="submitBtn" class="btn btn-primary margin20 center">Gravar</button>' +
                                                                '</div>' +
                                                            '</div>' +
                                                        '</form>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</td>' +
                            '<td>' + item.numeroContrato + '</td>' +
                            '<td>' + item.tipoContrato + '</td>' +
                            '<td class="formata-data">' + item.dataLimiteRetorno + '</td>' +
                            '<td>' + _motivoInconformidade + '</td>' +
                        '</tr>';
                    
                    $(linha).appendTo('#contratos>tbody');
                };
            // };
        };
    });

    var emptySpace = $("#contratos>tbody").html().trim();

    if (emptySpace == '') {

        var linha = '<h4><label class="col label bg-red error">Todos os contratos assinados desta demanda já foram apresentados e estão em análise.</label></h4>';
        $(linha).appendTo('#divContratos');
    }


};

//Função global que monta a tabela de contratos do arquivo formata_tabela_documentos.js

// function _formataTabelaContratos (dados) {

//     $.each(dados.listaContratosDemanda, function(key, item) {

//         if (item.temRetornoRede == 'SIM') {
//             if (item.dataConfirmacaoAssinatura == null) {
//                 var linha = 
//                     '<tr>' +
//                         '<td>' +
//                             '<div id="divContrato' + item.idContrato + '" class="divContrato">' +
//                             '</div>' +
//                         '</td>' +
//                         '<td>' + item.numeroContrato + '</td>' +
//                         '<td>' + item.tipoContrato + '</td>' +
//                         '<td class="formata-data">' + item.dataLimiteRetorno + '</td>' +
//                         '<td class="formata-data">' + item.dataConfirmacaoAssinatura + '</td>' +
//                     '</tr>';
                
//                 $(linha).appendTo('#contratos>tbody');
//             };
//         };
//     });
// };

//Função global que monta a tabela de contratos assinados para verificacao do arquivo formata_tabela_documentos.js

function _formataTabelaVerificaContratosAssinados (dados) {
    // console.log(dados);
    var urlDiretorioVirtual = 'https://inova.ceopc.hom.caixa/uploads/';

    $.each(dados.listaContratosDisponiveisConformidade, function(key, item) {
        // console.log(item);
            // if (item.tipoDoDocumento == "CONTRATACAO" || item.tipoDoDocumento == "ALTERACAO" || item.tipoDoDocumento == "CANCELAMENTO") {
                var linha = 
                    '<tr>' +
                        '<td>' +
                            '<div class="radio-inline padding0">' +
                                '<div id="divModal' + item.idUploadLink + '" class="divModal">' +  
                                    '<a rel="tooltip" class="btn btn-primary" title="Visualizar arquivo." data-toggle="modal" data-target="#modal' + item.idUploadLink + '">' + 
                                        '<span class="fa fa-search-plus"></span>' + 
                                    '</a>' +
                                    '<div class="modal fade" id="modal' + item.idUploadLink + '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' + 
                                        '<div class="modal-dialog modal-lg">' + 
                                            '<div class="modal-content" height="600px">' + 
                                                '<div class="modal-header">' +
                                                    '<h3 class="modal-title">' + item.nomeDoDocumento +
                                                    '<button type="button" class="btn btn-danger pull-right margin10" data-dismiss="modal">Fechar painel</button>' +
                                                    '<a class="btn btn-primary pull-right margin10" href="' + urlDiretorioVirtual + item.caminhoDoDocumento + '" download="' + item.tipoDoDocumento + '">Baixar arquivo</a>' +
                                                    '</h3>' +
                                                '</div>' +
                                                '<div class="modal-body">' +
                                                    '<a href="#!" class="modal-close waves-effect waves-green btn-flat" id="btn_fecha_modal"> </a>' +
                                                    '<embed src="' + urlDiretorioVirtual + item.caminhoDoDocumento + '" width="100%" height="650px" />' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</td>' +
                        '<td>' + item.idUploadLink + '</td>' +
                        '<td>' + item.nomeDoDocumento + '</td>' +
                        '<td>' + item.tipoDoDocumento + '</td>' +
                        '<td class="formata-data">' + item.dataInclusao + '</td>' +
                    '</tr>';
                $(linha).appendTo('#contratos>tbody');
                // var linha = 
                //     '<tr>' +
                //         '<td>' +
                //             '<div class="radio-inline padding0">' +
                //             '<div id="divModal' + item.idUploadLink + '" class="divModal">' +           
                                
                //                     '<a rel="tooltip" class="btn btn-primary" id="btnVisualizaDoc' + item.idUploadLink + '" title="Visualizar arquivo." data-toggle="modal" data-target="#modal' + item.idUploadLink + '">' + 
                //                         '<span class="fa fa-search-plus"></span>' + 
                //                     '</a>' +
                //                     '<div class="modal fade" id="modal' + item.idUploadLink + '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' + 
                //                         '<div class="modal-dialog modal-lg">' + 
                //                             '<div class="modal-content" height="600px">' + 
                //                                 '<div class="modal-header">' +
                //                                     '<h3 class="modal-title">' + item.nomeDoDocumento +
                //                                     '<button type="button" class="btn btn-danger pull-right margin10" data-dismiss="modal">Fechar painel</button>' +
                //                                     '<a class="btn btn-primary pull-right margin10" href="' + urlDiretorioVirtual + item.caminhoDoDocumento + '" download="' + item.tipoDoDocumento + '">Baixar arquivo</a>' +
                //                                     '</h3>' +
                //                                 '</div>' +
                //                                 '<div class="modal-body">' +
                //                                     '<a href="#!" class="modal-close waves-effect waves-green btn-flat" id="btn_fecha_modal"> </a>' +
                //                                     '<embed src="' + urlDiretorioVirtual + item.caminhoDoDocumento + '" width="100%" height="650px" />' +
                //                                 '</div>' +
                //                             '</div>' +
                //                         '</div>' +
                //                     '</div>' +
                //                 '</div>' +
                //             '</div>' +
                //             '<div class="radio-inline padding0" id="modalAprovaDoc' + item.idUploadLink + '">' +
                //             '<form method="post" action="/esteiracomex/contratacao/verificar-contrato-assinado/' + item.idUploadLink + '" enctype="multipart/form-data" class="radio-inline padding0 excluiDocumentos">' +
                //                 '<input type="text" class="_method" name="_method" value="PUT" hidden>' +
                //                 '<input type="text" class="excluid" name="idUploadLink" value="' + item.idUploadLink + '" hidden>' +
                //                 '<input type="text" class="aprovaHidden" name="aprovarContrato" value="SIM" hidden>' +
                                
                //                     '<a rel="tooltip" type="submit" class="btn btn-success" id="btnAprovaDoc' + item.idUploadLink + '" title="Aprovar arquivo."' + 
                //                         '<span> <i class="fa fa-check"> </i>   ' + '</span>' + 
                //                     '</a>' +
                //                 '</div>' +
                //             '</form>' +
                //             '<div class="radio-inline padding0" id="modalExcluiDoc' + item.idUploadLink + '">' +
                //                 '<div id="divModal' + item.idUploadLink + '" class="divModal">' +           
                //                     '<div class="radio-inline padding0">' +
                //                         '<a rel="tooltip" type="submit" class="btn btn-danger" id="btnExcluiDoc' + item.idUploadLink + '" title="Excluir arquivo." data-toggle="modal" data-target="#exclusaoModal' + item.idUploadLink + '">' + 
                //                             '<span> <i class="glyphicon glyphicon-trash"> </i> </span>' + 
                //                         '</a>'  +
                //                         '<div class="modal fade" id="exclusaoModal' + item.idUploadLink + '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' +  
                //                             '<div class="modal-dialog">' +
                //                                 '<div class="modal-content">' +
                //                                     '<div class="modal-header">' +
                //                                         '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                //                                         '<h4 class="modal-title">Contrato - Inconforme</h4>' +
                //                                     '</div>' +
                //                                     '<div class="modal-body">' +
                //                                         '<form method="post" action="/esteiracomex/contratacao/verificar-contrato-assinado/' + item.idUploadLink + '" class="radio-inline padding0 excluiDocumentos" name="formExcluiDocumentos' + item.idUploadLink + '" id="formExcluiDocumentos' + item.idUploadLink + '">' +
                //                                             '<input type="text" class="_method" name="_method" value="PUT" hidden>' +
                //                                             '<input type="text" class="excluid" name="idUploadLink" value="' + item.idUploadLink + '" hidden>' +
                //                                             '<input type="text" class="aprovaHidden" name="aprovarContrato" value="NÃO" required hidden>' +
                //                                             '<div class="col-md-12">' +
                //                                                 '<div class="form-group">' +
                //                                                     '<label for="motivoInconformidade" class="control-label">Motivo Inconformidade:</label>' +
                //                                                     '<div class="col-md-12">' +
                //                                                         '<textarea name="motivoInconformidade" id="motivoInconformidade" class="form-control" rows="6"></textarea>' +
                //                                                     '</div>' +
                //                                                 '</div>' +
                //                                             '</div>' +
                //                                             '<div class="input-group col-sm-2 right">' +
                //                                                 '<button type="submit" class="btn btn-primary">Confirmar</button>' +
                //                                             '</div>' +
                //                                         '</form>' +
                //                                     '</div>' +
                //                                 '</div>' +
                //                             '</div>' +
                //                         '</div>' +                                        
                //                     '</div>' +
                //                 '</div>' +   
                //             '</div>' +
                //         '</td>' +
                //         '<td>' + item.idUploadLink + '</td>' +
                //         '<td>' + item.nomeDoDocumento + '</td>' +
                //         '<td>' + item.tipoDoDocumento + '</td>' +
                //         '<td class="formata-data">' + item.dataInclusao + '</td>' +
                //     '</tr>';
                
                // $(linha).appendTo('#contratos>tbody');

                // $(botaoAcao).prependTo('#divModal' + item.idUploadLink);
            
                // $('#btnExcluiDoc' + item.idUploadContratoAssinado).click(function(){
                //     $(this).parents("tr").hide();
                //     $(this).closest("div.divModal").find("input[class='aprovaHidden']").val("NAO");
                //     $(this).closest("form").submit();
                //     // $(this).closest("div.divModal").find("input[class='statusDocumento']").val("INCONFORME");
                //     // alert ("Documento marcado para exclusão, salve a análise para efetivar o comando. Caso não queira mais excluir o documento atualize a página sem gravar.");
                // });

                // $('#btnAprovaDoc' + item.idUploadLink).click(function(){
                //     // $(this).parents("tr").hide();
                //     // $(this).closest("div.divModal").find("input[class='aprovaHidden']").val("SIM");
                //     $(this).closest("form").submit();
                //     // $(this).closest("div.divModal").find("input[class='statusDocumento']").val("CONFORME");
                //     // alert ("Documento marcado para aprovação, salve a análise para efetivar o comando. Caso não queira mais aprovar o documento atualize a página sem gravar.");
                // }); 
            // }
         
    });
        
};