function _formataTabelaDespesasDistrato (idDistrato) {
    $.getJSON('/estoque-imoveis/distrato/relacao-despesas/' + idDistrato, function(dados){
        $.each(dados, function(key, item) {

            var corIconeDespesa;
            var sentidoIconeDespesa;

            if (item.devolucaoPertinente == "SIM" ) {
                corIconeDespesa = "success";
                sentidoIconeDespesa = "up";
            } else {
                corIconeDespesa = "danger";
                sentidoIconeDespesa = "down";
            };

            var linha =
                '<tr>' +
                    '<td>' + item.idDespesa + '</td>' +
                    '<td>' + item.tipoDespesa + '</td>' +
                    '<td class="formata-valores">' + item.valorDespesa + '</td>' +
                    '<td class="formata-data-sem-hora">' + item.dataEfetivaDaDespesa + '</td>' +
                    '<td>' + item.observacaoDespesa + '</td>' +
                    '<td>' +
                        '<div class="m-2">' +
                            '<span class="btn btn-' + corIconeDespesa + '">' +
                                '<i class="far fa-lg fa-thumbs-' + sentidoIconeDespesa + '"></i>' +
                            '</span>' +
                        '</div>' +
                    '</td>' +
                    '<td>' +

                        '<div class="row">' +
                            '<div id="btnAlteraDespesa' + item.idDespesa + '" class="m-2">' + 
                                '<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalAlteraDespesaDistrato' + item.idDespesa + '">' +
                                    '<i class="far fa-lg fa-edit"></i>' +
                                '</button>' +
            
                                '<div class="modal fade" id="modalAlteraDespesaDistrato' + item.idDespesa + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                                    '<div class="modal-dialog" role="document">' +
                                        '<div class="modal-content">' +
                                            '<form method="post" action="/estoque-imoveis/distrato/atualizar-despesa/' + item.idDespesa + '" id="formAlteraDespesaDistrato' + item.idDespesa + '">' +
                                                
                                            '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                                            '<input type="hidden" class="form-control" name="_method" value="PUT">' +
                                            '<input type="hidden" class="form-control" name="idDespesa" value="'+ item.idDespesa +'">' +
            
                                                '<div class="modal-header">' +
                                                    '<h5 class="modal-title" id="exampleModalLabel">Alterar Despesa</h5>' +
                                                    '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">' +
                                                        '<span aria-hidden="true">&times;</span>' +
                                                    '</button>' +
                                                '</div>' +

                                                '<div class="modal-body">' +
            


                                                    '<div class="form-group">' +
                                                        '<label>Tipo de Despesa:</label>' +
                                                        '<select name="tipoDespesa" class="form-control" required>' +
                                                            '<option value="">Selecione</option>' +
                                                            '<option value="AUTORIZADAS REEMBOLSO EMGEA">Autorizadas Reembolso EMGEA</option>' +
                                                            '<option value="BENFEITORIAS">Benfeitorias</option>' +
                                                            '<option value="COMISSAO DE LEILOEIRO">Comissão de Leiloeiro</option>' +
                                                            '<option value="CONDOMINIO">Condomínio</option>' +
                                                            '<option value="CUSTAS CARTORARIAS">Custas Cartorárias</option>' +
                                                            '<option value="FGTS">FGTS</option>' +
                                                            '<option value="FINANCIAMENTO">Financiamento</option>' +
                                                            '<option value="IPTU">IPTU</option>' +
                                                            '<option value="ITBI">ITBI</option>' +
                                                            '<option value="MULTA">Multa</option>' +
                                                            '<option value="OUTRAS DESPESAS">Outras Despesas</option>' +
                                                            '<option value="PARCELAMENTO">Parcelamento</option>' +
                                                            '<option value="RECURSOS PROPRIOS">Recursos Próprios</option>' +
                                                            '<option value="TAXAS DE FINANCIAMENTO">Taxas de Financiamento</option>' +
                                                        '</select>' +
                                                    '</div>' +
            
                                                    '<div class="form-group">' +
                                                        '<label>Data Efetiva da Despesa:</label>' +
                                                        '<input type="text" name="dataEfetivaDaDespesa" class="form-control mascaradata" required>' +
                                                    '</div>' +
            
                                                    '<div class="form-group">' +
                                                        '<label>Valor da Despesa:</label>' +
                                                        '<input type="text" name="valorDespesa" class="form-control mascaradinheiro" value="' + item.valorDespesa + '" required>' +                                        
                                                    '</div>' +
            
                                                    '<div class="form-group">' +
                                                        '<label>Observações:</label>' +
                                                        '<textarea rows="5" name="observacaoDespesa" class="form-control" value="' + item.observacaoDespesa + '"></textarea>' +                                        
                                                    '</div>' +
            
                                                '</div>' +
                                                '<div class="modal-footer">' +
                                                    '<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>' +
                                                    '<button type="submit" class="btn btn-primary">Salvar</button>' +
                                                '</div>' +
            
                                            '</form>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +

                            '<div id="btnInvalidaDespesaDistrato' + item.idDespesa + '" class="m-2">' + 
                                '<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalInvalidaDespesaDistrato' + item.idDespesa + '">' +
                                    '<i class="far fa-lg fa-thumbs-down"></i>' +
                                '</button>' +

                                '<div class="modal fade" id="modalInvalidaDespesaDistrato' + item.idDespesa + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                                    '<div class="modal-dialog" role="document">' +
                                        '<div class="modal-content">' +
                                            '<form method="post" action="/estoque-imoveis/distrato/validar-despesa/' + item.idDespesa + '" id="formInvalidaDespesaDistrato' + item.idDespesa + '">' +
                                                
                                            '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                                            '<input type="hidden" class="form-control" name="_method" value="PUT">' +
                                            '<input type="hidden" class="form-control" name="idDespesa" value="'+ item.idDespesa +'">' +
            
                                                '<div class="modal-header">' +
                                                    '<h5 class="modal-title" id="exampleModalLabel">Validar / Invalidar Despesa</h5>' +
                                                    '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">' +
                                                        '<span aria-hidden="true">&times;</span>' +
                                                    '</button>' +
                                                '</div>' +

                                                '<div class="modal-body">' +
            
                                                    '<div class="form-group">' +
                                                        '<select name="devolucaoPertinente" class="form-control" required>' +
                                                            '<option value="">Selecione</option>' +
                                                            '<option value="SIM">Valida</option>' +
                                                            '<option value="NAO">Não Valida</option>' +
                                                        '</select>' +
                                                    '</div>' +

            
                                                '</div>' +
                                                '<div class="modal-footer">' +
                                                    '<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>' +
                                                    '<button type="submit" class="btn btn-primary">Salvar</button>' +
                                                '</div>' +
            
                                            '</form>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
    
                            '<div id="btnExcluiDespesaDistrato' + item.idDespesa + '" class="m-2"> ' +
                                '<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExcluiDespesaDistrato' + item.idDespesa + '">' +
                                    '<i class="fas fa-lg fa-trash-alt"></i>' +
                                '</button>' +

                                '<div class="modal fade" id="modalExcluiDespesaDistrato' + item.idDespesa + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                                    '<div class="modal-dialog" role="document">' +
                                        '<div class="modal-content">' +
                                            '<form method="post" action="/estoque-imoveis/distrato/excluir-despesa/' + item.idDespesa + '" id="formExcluiDespesaDistrato' + item.idDespesa + '">' +
                                                
                                            '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                                            '<input type="hidden" class="form-control" name="_method" value="PUT">' +
                                            '<input type="hidden" class="form-control" name="idDespesa" value="'+ item.idDespesa +'">' +
            
                                                '<div class="modal-header">' +
                                                    '<h5 class="modal-title" id="exampleModalLabel">Excluir Despesa</h5>' +
                                                    '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">' +
                                                        '<span aria-hidden="true">&times;</span>' +
                                                    '</button>' +
                                                '</div>' +

                                                '<div class="modal-body">' +
            
                                                    '<div class="form-group">' +
                                                        '<label>Clique em Salvar para excluir a despesa:</label>' +
                                                    '</div>' +

            
                                                '</div>' +
                                                '<div class="modal-footer">' +
                                                    '<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>' +
                                                    '<button type="submit" class="btn btn-primary">Salvar</button>' +
                                                '</div>' +
            
                                            '</form>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        
                    '</td>' +
                '</tr>';
            $(linha).appendTo('#tblDespesasDistrato' + item.idDistrato +'>tbody');
        });
    
        _formataData();
        _formataValores();

    });
};