var unidade = $('#lotacao').text()

$(document).ready(function(){  
        $.getJSON('/atende/listar-equipes-atividades-atende', function(dados){
            var modalEquipes = '';
            var modalMacroAtividadeComMicroAtividade = '';
            var modalMacroAtividadeComFormAtende = '';
            var modalBotaoMicroAtividadeComFormAtende = '';
            var modalMicroAtividadeComFormAtende = '';
            
            $.each(dados, function(colecaoEquipesKeys, colecaoEquipesValues) {
                console.log(colecaoEquipesValues)
                modalEquipes =
                '<div class="col-sm">'+
                    '<button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalMacroAtividades_' + colecaoEquipesValues.idEquipe + '_' + colecaoEquipesKeys + '">'+
                        '<i class="'+colecaoEquipesValues.iconeEquipe+'"></i><p>'+colecaoEquipesValues.nomeEquipe+'</p>'+
                    '</button>'+          
                '</div>'
                $(modalEquipes).appendTo('#listarEquipes');        
                $.each(colecaoEquipesValues.atividades, function(colecaoMacroAtividadesKeys, colecaoMacroAtividade) {
                    modalMacroAtividadeComMicroAtividade +=
                        '<div class="modal fade" id="modalMacroAtividades_'+ colecaoEquipesValues.idEquipe + '_' + colecaoEquipesKeys + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">'+
                            '<div class="modal-dialog modal-lg" role="document">'+
                                '<div class="modal-content">'+
                                    '<div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">'+
                                        '<h5 style="color: white;" class="modal-title" id="exampleModalLabel">Abrir Atende</h5>'+
                                        '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                    '</div>' +
                                    '<div class="modal-body">'+
                                        '<div class="row">'
                                        console.log(colecaoMacroAtividade.microAtividade.length)
                    if (colecaoMacroAtividade.microAtividade.length > 0) { 
                        $.each(colecaoMacroAtividade.microAtividade, function(colecaoMicroAtividadesKeys, colecaoMicroAtividade) {
                            modalBotaoMicroAtividadeComFormAtende +=      
                                            '<div class="col-sm">'+
                                                '<button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalMicro_' + colecaoMacroAtividade.idAtividade + '_' + colecaoMicroAtividadesKeys + '">'+
                                                    '<i class="' + colecaoMacroAtividade.iconeAtividade + '"></i><p>'+colecaoMacroAtividade.nomeAtividade+'</p>'+
                                                '</button>'+
                                            '</div>'
                            modalMicroAtividadeComFormAtende +=
                            '<div class="modal fade" id="modalMicro_' + colecaoMacroAtividade.idAtividade + '_' + colecaoMicroAtividadesKeys + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">'+
                                '<div class="modal-dialog modal-lg" role="document">'+
                                    '<div class="modal-content">'+
                                        '<div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">'+
                                            '<h5 style="color: white;" class="modal-title" id="exampleModalLabel">Abrir Atende</h5>'+
                                            '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                        '</div>'+
                                        '<div class="modal-body">'+
                                            '<div class="row">'+
                                                '<div class="col-sm">'+
                                                    '<button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalForm">'+
                                                        '<i class="' + colecaoMicroAtividade.iconeAtividade + '"></i><p>'+colecaoMicroAtividade.nomeAtividade+'</p>'+
                                                    '</button>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="modal-footer">'+
                                                '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalMacroAtividades_'+ colecaoEquipesValues.idEquipe + '_' + colecaoEquipesKeys + '">'+'Voltar'+'</button>'+
                                                '<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>' +
                            '</div>'          
                        })
                        modalMacroAtividadeComMicroAtividade += modalBotaoMicroAtividadeComFormAtende
                    } else {
                        modalMacroAtividadeComMicroAtividade +=
                            '<div class="col-sm">'+
                                '<button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalForm">'+
                                    '<i class="' + colecaoMacroAtividade.iconeAtividade + '"></i><p>' + colecaoMacroAtividade.nomeAtividade + '</p>'+
                                '</button>'+
                            '</div>'
                    }
                    modalMacroAtividadeComMicroAtividade +=
                                    '</div>'+
                                        '<div class="modal-footer">'+
                                            '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalMacroAtividades_'+colecaoEquipesValues.idEquipe + '_' + colecaoEquipesKeys + '">'+'Voltar'+'</button>'+
                                            '<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>' 
                })  
                modalMacroAtividadeComMicroAtividade += modalMicroAtividadeComFormAtende
                $(modalMacroAtividadeComMicroAtividade).appendTo('#listarEquipes');
            })
        })
    })
