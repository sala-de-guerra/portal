$(document).ready(function(){  
    $.getJSON('/atende/listar-demandas-disponiveis', function(dados){
        $.each(dados, function(key, item) {

            var linha =
                '<tr>' +
                    '<td>' + item.nomeEquipe + '</td>' +
                    '<td>' + item.nomeAtividade + '</td>' +
                    '<td class="formata-data-sem-hora">' + item.prazoAtendimentoAtende + '</td>' +
                    '<td>' + item.numeroContrato + '</td>' +
                    '<td>' + item.assuntoAtende + '</td>' +
                    '<td class="obs'+item.idAtende+'">' + item.descricaoAtende + '</td>' +
                    '<td>' + 
                        '<div class="btn-group" role="group">' +
                            '<button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                                'Ação' + 
                            '</button>' +
                            // botão dropdown
                        '<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">' +
                            '<a class="dropdown-item" type="button" id="btn-consulta' + item.idAtende +' "class="btn btn-primary" data-toggle="modal" data-target="#modalConsulta' + item.idAtende + '">' + '<i class="fa fa-search" aria-hidden="true"></i>' + ' Consultar' + '</a>' +
                            '<a class="dropdown-item" type="button" id="btn-editar' + item.idAtende +' "class="btn btn-primary" data-toggle="modal" data-target="#modalEditar' + item.idAtende + '">' + '<i class="far fa-edit">' + '</i>' + ' Tratar' + '</a>' +
                            '<a class="dropdown-item" href="https://portal.gilie.des.sp.caixa/atende/redirecionar-atende">'+ '<i class="fas fa-exchange-alt">' + '</i>' + ' Direcionar</a>' +
                        '</div>' +
                            // Modal de consulta
                            '<div class="modal fade" id="modalConsulta' + item.idAtende + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                            '<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">' +
                                '<div class="modal-content">' +
                                    '<div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">' +
                                        '<h5 style="color: white;" class="modal-title" id="exampleModalLabel">' + 'Consulta' + '</h5>' +
                                        '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">' +
                                            '<span aria-hidden="true">&times;</span>' +
                                        '</button>' +
                                    '</div>' +
                                    '<div class="modal-body">' +
                                        '<div class="container">' +
                                            '<div>' +
                                            '<p><b>'+'Contrato:'+'</b>'+'<span class="pl-5">' + item.contratoFormatado + '</span></p>' +
                                            '<p><b>'+'Descrição:'+'</b></p>'+
                                            '<p><span class="pl-5">' + item.descricaoAtende + '</span></p>' +
                                              
                                               
                                            '</div>' +
                                        '</div>' + 
                                    '</div>' +
                                    '<div class="modal-footer">' +
                                        '<button type="button" class="btn btn-secondary" data-dismiss="modal">' + 'Sair' + '</button>' +
                                    '</div>' + 
                                '</div>' + 
                            '</div>' + 
                        '</div>' 
                        // modal redirecionar
                //             '<div class="modal fade" id="modalDirecionar' + item.idAtende + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                //             '<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">' +
                //                 '<div class="modal-content">' +
                //                     '<div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">' +
                //                         '<h5 style="color: white;" class="modal-title" id="exampleModalLabel">' + 'Direcionar' + '</h5>' +
                //                         '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">' +
                //                             '<span aria-hidden="true">&times;</span>' +
                //                         '</button>' +
                //                     '</div>' +
                //                     '<div class="modal-body">' +
                //                         '<div class="container">' +
                //                             '<div>' +

                                                
                                                
                //                             '</div>' +
                //                         '</div>' + 
                //                     '</div>' +
                //                     '<div class="modal-footer">' +
                //                         '<button type="button" class="btn btn-secondary" data-dismiss="modal">' + 'Sair' + '</button>' +
                //                     '</div>' + 
                //                 '</div>' + 
                //             '</div>' + 
                //         '</div>' + 
                //     '</td>'+
                // '</tr>' 
               

        $(linha).appendTo('#tblminhasDemandas>tbody');
        
            var subtring = $('.obs'+item.idAtende).text()
            var novo = subtring.substring(0, 50) + ' [...]'
            $('.obs'+item.idAtende).text(novo)
            
        })
    _formataDatatable();
    _formataData();
    })
})


