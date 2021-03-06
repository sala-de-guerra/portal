function _formataTabelaDespesasDistrato (idDistrato, view) {
    $.getJSON('/estoque-imoveis/distrato/relacao-despesas/' + idDistrato, function(dados_despesa){
        $.each(dados_despesa, function(key, item) {

            var corIconeDespesa;
            var sentidoIconeDespesa;
            var title;
            var hidden;

            if (item.devolucaoPertinente == "SIM" ) {
                corIconeDespesa = "success";
                sentidoIconeDespesa = "up";
                title = "Válida"
                hidden = "hidden";
            } else {
                corIconeDespesa = "danger";
                sentidoIconeDespesa = "down";
                title = "Inválida"
                hidden = "";
            };

            if (item.observacaoDespesa === null) {
                item.observacaoDespesa = "";
            }

            var linha =
                '<tr>' +
                    '<td>' + item.idDespesa + '</td>' +
                    '<td>' + item.tipoDespesa + '</td>' +
                    '<td class="formata-valores">' + item.valorDespesa + '</td>' +
                    '<td class="formata-data-sem-hora">' + item.dataEfetivaDaDespesa + '</td>' +
                    '<td>' + item.observacaoDespesa + '</td>' +
                    '<td>' +
                        '<div class="row">' +
                            '<button class="btn btn-' + corIconeDespesa + ' m-2" title="' + title + '">' +
                                '<i class="far fa-thumbs-' + sentidoIconeDespesa + '"></i>' +
                            '</button>' +

                            '<div id="btnConsultaMotivoInvalidacao' + item.idDespesa + '" class="m-2"> </div>' +
                        '</div>' +
                    '</td>' +
                    '<td class="col-sm-2">' +
                        '<div class="row">' +
                            '<div id="btnAlteraDespesa' + item.idDespesa + '" class="m-2"> </div>' +

                            '<div id="btnInvalidaDespesaDistrato' + item.idDespesa + '" class="m-2"> </div>' +
    
                            '<div id="btnExcluiDespesaDistrato' + item.idDespesa + '" class="m-2"> </div>' +
                        '</div>' +
                    '</td>' +
                '</tr>';
                
            $(linha).appendTo('#tblDespesasDistrato' + item.idDistrato +'>tbody');

            if (view == "operacional") {

                var btnConsultaMotivoInvalidacao =

                    '<button class="btn btn-primary" title="Motivo da Invalidação" data-toggle="modal" data-target="#modalConsultaMotivoInvalidacao' + item.idDespesa + '" ' + hidden + '>' +
                        '<i class="fas fa-info-circle"></i>' +
                    '</button>' +

                    '<div class="modal fade" id="modalConsultaMotivoInvalidacao' + item.idDespesa + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                        '<div class="modal-dialog" role="document">' +
                            '<div class="modal-content">' +

                                '<div class="modal-header">' +
                                    '<h5 class="modal-title" id="exampleModalLabel">Motivo da Invalidação</h5>' +
                                    '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">' +
                                        '<span aria-hidden="true">&times;</span>' +
                                    '</button>' +
                                '</div>' +

                                '<div class="modal-body">' +

                                    '<div class="form-group">' +
                                        '<p>' + item.motivoAlteracaoDespesa + '</p>' +                                        
                                    '</div>' +

                                '</div>' +

                                '<div class="modal-footer">' +
                                    '<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>' +
                                '</div>' +

                            '</div>' +
                        '</div>' +
                    '</div>';
            
                $(btnConsultaMotivoInvalidacao).appendTo("#btnConsultaMotivoInvalidacao" + item.idDespesa);

                var btnAlteraDespesa = 

                    '<button type="button" class="btn btn-info" title="Alterar Despesa" data-toggle="modal" data-target="#modalAlteraDespesaDistrato' + item.idDespesa + '">' +
                        '<i class="far fa-edit"></i>' +
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
                                            '<select name="tipoDespesa" class="form-control">' +
                                                '<option value="' + item.tipoDespesa + '" selected disabled>' + item.tipoDespesa + '</option>' +
                                                '<option value="AUTORIZADAS REEMBOLSO EMGEA">Autorizadas Reembolso EMGEA</option>' +
                                                '<option value="BENFEITORIAS">Benfeitorias</option>' +
                                                '<option value="COMISSAO DE LEILOEIRO">Comissão de Leiloeiro</option>' +
                                                '<option value="CONDOMINIO">Condomínio</option>' +
                                                '<option value="CUSTAS CARTORARIAS">Custas Cartorárias</option>' +
                                                '<option value="FINANCIAMENTO E FGTS">Financiamento e/ou FGTS</option>' +
                                                '<option value="IPTU">IPTU</option>' +
                                                '<option value="ITBI">ITBI</option>' +
                                                '<option value="MULTA">Multa</option>' +
                                                '<option value="PARCELA DE FINANCIAMENTO">Prcela de Financiamento</option>' +
                                                '<option value="PARCELAMENTO E FGTS">Parcelamento e/ou FGTS</option>' +
                                                '<option value="PARCELAS E TAXAS DE FINANCIAMENTO">Parcelas e Taxas de Financiamento</option>' +
                                                '<option value="RECURSOS PROPRIOS">Recursos Próprios</option>' +
                                            '</select>' +
                                        '</div>' +

                                        '<div class="form-group">' +
                                            '<label>Data Efetiva da Despesa:</label>' +
                                            '<input type="text" name="dataEfetivaDaDespesa" class="form-control datepicker" required>' +
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
                    '</div>';
                
                $(btnAlteraDespesa).appendTo("#btnAlteraDespesa" + item.idDespesa);

                var btnInvalidaDespesaDistrato =

                    '<button type="button" class="btn btn-warning" title="Invalidar Despesa" data-toggle="modal" data-target="#modalInvalidaDespesaDistrato' + item.idDespesa + '">' +
                        '<i class="far fa-thumbs-down"></i>' +
                    '</button>' +

                    '<div class="modal fade" id="modalInvalidaDespesaDistrato' + item.idDespesa + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                        '<div class="modal-dialog" role="document">' +
                            '<div class="modal-content">' +
                                '<form method="post" action="/estoque-imoveis/distrato/validar-despesa/' + item.idDespesa + '" id="formInvalidaDespesaDistrato' + item.idDespesa + '">' +
                                    
                                '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                                '<input type="hidden" class="form-control" name="_method" value="PUT">' +
                                '<input type="hidden" class="form-control" name="idDespesa" value="'+ item.idDespesa +'">' +

                                    '<div class="modal-header">' +
                                        '<h5 class="modal-title" id="exampleModalLabel">Validar Despesa?</h5>' +
                                        '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">' +
                                            '<span aria-hidden="true">&times;</span>' +
                                        '</button>' +
                                    '</div>' +

                                    '<div class="modal-body">' +

                                        '<div class="form-group">' +
                                            '<select name="devolucaoPertinente" class="form-control" required>' +
                                                '<option value="' + item.devolucaoPertinente + '" selected disabled>' + item.devolucaoPertinente + '</option>' +
                                                '<option value="SIM">SIM</option>' +
                                                '<option value="NÃO">NÃO</option>' +
                                            '</select>' +
                                        '</div>' +

                                        '<div class="form-group">' +
                                            '<label>Observações:</label>' +
                                            '<textarea rows="5" name="motivoAlteracaoDespesa" class="form-control"></textarea>' +                                        
                                        '</div>' +

                                    '</div>' +

                                    '<div class="modal-footer">' +
                                        '<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>' +
                                        '<button type="submit" class="btn btn-primary">Salvar</button>' +
                                    '</div>' +

                                '</form>' +
                            '</div>' +
                        '</div>' +
                    '</div>';

                $(btnInvalidaDespesaDistrato).appendTo('#btnInvalidaDespesaDistrato' + item.idDespesa);

                var btnExcluiDespesaDistrato =

                    '<button type="button" class="btn btn-danger" title="Excluir Despesa" data-toggle="modal" data-target="#modalExcluiDespesaDistrato' + item.idDespesa + '">' +
                        '<i class="fas fa-trash-alt"></i>' +
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
                    '</div>';

                $(btnExcluiDespesaDistrato).appendTo('#btnExcluiDespesaDistrato' + item.idDespesa);
            };

        });
    
        // _formataData();
        // _formataValores();
        _formataDatatableComId ('tblDespesasDistrato' + idDistrato);
    
        $(".modal").on('hidden.bs.modal', function(e){
            $(this).find("form")[0].reset();
        });

        $( function() {
            $( ".datepicker" ).datepicker();
        }); 

    });
    
};