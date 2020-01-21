function _formataListaDistrato (numeroContrato, view) {

    $.getJSON('/estoque-imoveis/distrato/consultar-dados-demanda/' + numeroContrato, function(dados){

        $.each(dados, function(key, item) {

            var li =
                '<li id="list-' + item.idDistrato + '">' +

                    '<div class="row">' +
                        '<div class="col-sm-3">' +
                            '<div class="form-group">' +
                                '<label>Protocolo:</label>' +
                                '<p>' + item.idDistrato + '</p>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-sm-3">' +
                            '<div class="form-group">' +
                                '<label>Modalidade de Compra::</label>' +
                                '<p>' + item.modalidadeProposta + '</p>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-sm-6">' +
                            '<div class="form-group">' +
                                '<label>Observação:</label>' +
                                '<p>' + item.observacaoDistrato + '</p>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +

                    '<div class="row">' +
                        '<div class="col-sm-3">' +
                            '<div class="form-group">' +
                                '<label>Nome:</label>' +
                                '<p>' + item.nomeProponente + '</p>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-sm-3">' +
                            '<div class="form-group">' +
                                '<label>CPF / CNPJ:</label>' +
                                '<p>' + item.cpfCnpjProponente + '</p>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-sm-3">' +
                            '<div class="form-group">' +
                                '<label>Telefone:</label>' +
                                '<p>' + item.telefoneProponente + '</p>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-sm-3">' +
                            '<div class="form-group">' +
                                '<label>E-mail:</label>' +
                                '<p>' + item.emailProponente + '</p>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +

                    '<div class="row">' +    
                        '<div class="col-sm-3">' +
                            '<div class="form-group">' +
                                '<label>Data de Início:</label>' +
                                '<p class="formata-data-sem-hora">' + item.dataCadastro + '</p>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-sm-3">' +
                            '<div class="form-group">' +
                                '<label>Motivo do Distrato:</label>' +
                                '<p>' + item.motivoDistrato + '</p>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-sm-3">' +
                            '<div class="form-group">' +
                                '<label>Status do Distrato:</label>' +
                                '<p>' + item.statusAnaliseDistrato + '</p>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-sm-3">' +
                            '<div class="form-group">' +
                                '<label>Total da Proposta:</label>' +
                                '<p class="formata-valores">' + item.valorTotalProposta + '</p>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +

                    '<div class="row">' +
                        '<div class="col-sm-3">' +
                            '<div class="form-group">' +
                                '<label>Valor em Recursos Próprios:</label>' +
                                '<p class="formata-valores">' + item.valorRecursosPropriosProposta + '</p>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-sm-3">' +
                            '<div class="form-group">' +
                                '<label>Valor de FGTS:</label>' +
                                '<p class="formata-valores">' + item.valorFgtsProposta + '</p>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-sm-3">' +
                            '<div class="form-group">' +
                                '<label>Valor de Financiamento:</label>' +
                                '<p class="formata-valores">' + item.valorFinanciadoProposta + '</p>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-sm-3">' +
                            '<div class="form-group">' +
                                '<label>Valor Parcelado::</label>' +
                                '<p class="formata-valores">' + item.valorParceladoProposta + '</p>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +

                    '<div class="row">' +
                        '<div class="col-md-12">' +
                            '<div class="card collapsed-card card-primary">' +
                                '<div class="card-header cursor-pointer" data-card-widget="collapse">' +
                                    '<h3 class="card-title">Despesas de Distrato Cadastradas</h3>' +
                                    '<div class="card-tools">' +
                                        '<button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>' +
                                    '</div>' +
                                '</div>' +
                                '<div class="card-body">' +
                                    '<div class="row">' +    
                                        '<div class="col-sm-12 table-responsive">' +
                                            '<div class="form-group">' +
                                                '<label>Despesas de Distrato Cadastradas:</label>' +
                                                '<table id="tblDespesasDistrato' + item.idDistrato + '" class="table table-bordered table-striped dataTable">' +
                                                    '<thead>' +
                                                        '<tr>' +
                                                            '<th>#</th>' +
                                                            '<th>Tipo de Despesa</th>' +
                                                            '<th>Valor</th>' +
                                                            '<th>Data Efetiva</th>' +
                                                            '<th>Observações</th>' +
                                                            '<th>Validade</th>' +
                                                            '<th>Ações</th>' +
                                                        '</tr>' +
                                                    '</thead>' +
                                                    '<tbody>' +

                                                    '</tbody>' +
                                                '</table>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +

                    '<div class="row">' +

                        '<div id="btnAnalisarDistrato' + item.idDistrato + '" class="col-sm-2"></div>' +

                        '<div id="btnCadastrarDespesaDistrato' + item.idDistrato + '" class="col-sm-2"></div>' +

                        '<div id="btnParecerAnalistaDistrato' + item.idDistrato + '" class="col-sm-2"></div>' +

                        '<div id="btnParecerGerenteDistrato' + item.idDistrato + '" class="col-sm-2"></div>' +

                        '<div id="btnAlterarStatusDistrato' + item.idDistrato + '" class="col-sm-2"></div>' +

                    '</div>' +

                '</li>' +
                '<hr>';
                
            $(li).appendTo('#listaDistratos'); 
            
            if (view == "operacional") {
                var btnAnalisarDistrato =
                
                    '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAnalisarDistrato' + item.idDistrato + '">' +
                        '<i class="far fa-lg fa-edit"></i>' +
                        'Analisar Distrato' +
                    '</button>' +

                    '<div class="modal fade" id="modalAnalisarDistrato' + item.idDistrato + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                        '<div class="modal-dialog" role="document">' +
                            '<div class="modal-content">' +
                                '<form method="post" action="/estoque-imoveis/distrato/atualizar/' + item.idDistrato + '" id="formAnalisarDistrato' + item.idDistrato + '">' +
                                    
                                    '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                                    '<input type="hidden" class="form-control" name="_method" value="PUT">' +


                                    '<div class="modal-header">' +
                                        '<h5 class="modal-title" id="exampleModalLabel">Analisar Distrato</h5>' +
                                        '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">' +
                                            '<span aria-hidden="true">&times;</span>' +
                                        '</button>' +
                                    '</div>' +

                                    '<div class="modal-body">' +

                                        '<div class="form-group">' +
                                            '<label>Alterar Motivo de Distrato:</label>' +
                                            '<select id="selectMotivo' + item.idDistrato + '" name="motivoDistrato" class="form-control" required>' +
                                                '<option value="">Selecione</option>' +
                                                '<option value="ACAO JUDICIAL">AÇÃO JUDICIAL</option>' +
                                                '<option value="CREDITO NAO APROVADO">CRÉDITO NÃO APROVADO</option>' +
                                                '<option value="DESISTENCIA">DESISTÊNCIA</option>' +
                                                '<option value="DISTRATO CANCELADO">DISTRATO CANCELADO</option>' +
                                                '<option value="DIREITO DE PREFERENCIA DO EX-MUTUARIO">DIREITO DE PREFERÊNCIA DO EX-MUTUÁRIO</option>' +
                                                '<option value="ERRO FORMAL DE EDITAL">ERRO FORMAL DE EDITAL</option>' +
                                                '<option value="IMPOSSIBILIDADE DE REGISTRO DE AQUISICAO">IMPOSSIBILIDADE DE REGISTRO DE AQUISIÇÃO</option>' +
                                                '<option value="LEILOES NEGATIVOS">LEILÕES NEGATIVOS</option>' +
                                            '</select>' +
                                        '</div>' +

                                        '<div class="form-group">' +
                                            '<label>Observações:</label>' +
                                            '<textarea rows="5" name="observacaoDistrato" class="form-control"></textarea>' +                                        
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
                $(btnAnalisarDistrato).appendTo('#btnAnalisarDistrato' + item.idDistrato);

                $('#selectMotivo' + item.idDistrato).val(item.motivoDistrato);

                var btnCadastrarDespesaDistrato =
                    '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastraDespesaDistrato' + item.idDistrato + '">' +
                        '<i class="far fa-lg fa-edit"></i>' +
                        'Cadastrar Despesa' +
                    '</button>' +

                    '<div class="modal fade" id="modalCadastraDespesaDistrato' + item.idDistrato + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                        '<div class="modal-dialog" role="document">' +
                            '<div class="modal-content">' +
                                '<form method="post" action="/estoque-imoveis/distrato/cadastrar-despesa/' + item.idDistrato + '" id="formCadastraDespesaDistrato' + item.idDistrato + '">' +
                                    
                                '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                                // '<input type="hidden" class="form-control" name="_method" value="PUT">' +
                                // '<input type="hidden" class="form-control" name="idDistrato" value="'+ item.idDistrato +'">' +

                                    '<div class="modal-header">' +
                                        '<h5 class="modal-title" id="exampleModalLabel">Cadastrar Despesa</h5>' +
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
                                            '<input type="text" name="valorDespesa" class="form-control mascaradinheiro" required>' +                                        
                                        '</div>' +

                                        '<div class="form-group">' +
                                            '<label>Observações:</label>' +
                                            '<textarea rows="5" name="observacaoDespesa" class="form-control"></textarea>' +                                        
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

                $(btnCadastrarDespesaDistrato).appendTo('#btnCadastrarDespesaDistrato' + item.idDistrato);

                var btnParecerAnalistaDistrato =
                    
                    '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalParecerAnalistaDistrato' + item.idDistrato + '">' +
                        '<i class="far fa-lg fa-edit"></i>' +
                        'Parecer Analista' +
                    '</button>' +

                    '<div class="modal fade" id="modalParecerAnalistaDistrato' + item.idDistrato + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                        '<div class="modal-dialog" role="document">' +
                            '<div class="modal-content">' +
                                '<form method="post" action="/estoque-imoveis/distrato/emitir-parecer-analista/' + item.idDistrato + '" id="formParecerAnalistaDistrato' + item.idDistrato + '">' +
                                    
                                '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                                '<input type="hidden" class="form-control" name="_method" value="PUT">' +


                                    '<div class="modal-header">' +
                                        '<h5 class="modal-title" id="exampleModalLabel">Emitir Parecer do Analista</h5>' +
                                        '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">' +
                                            '<span aria-hidden="true">&times;</span>' +
                                        '</button>' +
                                    '</div>' +
                                    
                                    '<div class="modal-body">' +

                                        '<div class="form-group">' +
                                            '<label>Observações:</label>' +
                                            '<textarea rows="5" name="observacaoDistrato" class="form-control"></textarea>' +                                        
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
                $(btnParecerAnalistaDistrato).appendTo('#btnParecerAnalistaDistrato' + item.idDistrato);

                var btnParecerGerenteDistrato =
                    
                    '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalParecerGerenteDistrato' + item.idDistrato + '">' +
                        '<i class="far fa-lg fa-edit"></i>' +
                        'Parecer Gerente' +
                    '</button>' +

                    '<div class="modal fade" id="modalParecerGerenteDistrato' + item.idDistrato + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                        '<div class="modal-dialog" role="document">' +
                            '<div class="modal-content">' +
                                '<form method="post" action="/estoque-imoveis/distrato/emitir-parecer-gestor/' + item.idDistrato + '" id="formParecerGerenteDistrato' + item.idDistrato + '">' +
                                    
                                '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                                '<input type="hidden" class="form-control" name="_method" value="PUT">' +


                                    '<div class="modal-header">' +
                                        '<h5 class="modal-title" id="exampleModalLabel">Emitir Parecer do Gerente</h5>' +
                                        '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">' +
                                            '<span aria-hidden="true">&times;</span>' +
                                        '</button>' +
                                    '</div>' +
                                    '<div class="modal-body">' +

                                        '<div class="form-group">' +
                                            '<label>Parecer do Analista - ' + item.matriculaAnalista + ':</label>' +
                                            '<p>' + item.parecerAnalista + '</p>' +
                                        '</div>' +

                                        '<div class="form-group">' +
                                            '<label>Observações:</label>' +
                                            '<textarea rows="5" name="observacaoDistrato" class="form-control"></textarea>' +                                        
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
                $(btnParecerGerenteDistrato).appendTo('#btnParecerGerenteDistrato' + item.idDistrato);

                var btnAlterarStatusDistrato =
                    '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAlterarStatusDistrato' + item.idDistrato + '">' +
                        '<i class="far fa-lg fa-edit"></i>' +
                        'Alterar Status' +
                    '</button>' +

                    '<div class="modal fade" id="modalAlterarStatusDistrato' + item.idDistrato + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                        '<div class="modal-dialog" role="document">' +
                            '<div class="modal-content">' +
                                '<form method="post" action="/estoque-imoveis/distrato/alterar-status-distrato/' + item.idDistrato + '" id="formAlterarStatusDistrato' + item.idDistrato + '">' +
                                    
                                '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                                '<input type="hidden" class="form-control" name="_method" value="PUT">' +


                                    '<div class="modal-header">' +
                                        '<h5 class="modal-title" id="exampleModalLabel">Alterar Status</h5>' +
                                        '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">' +
                                            '<span aria-hidden="true">&times;</span>' +
                                        '</button>' +
                                    '</div>' +
                                    '<div class="modal-body">' +

                                        '<div class="form-group">' +
                                            '<label>Alterar Status da Demanda:</label>' +
                                            '<select name="statusAnaliseDistrato" class="form-control">' +
                                                '<option value="" selected>Selecione</option>' +
                                                '<option value="AVERBACAO DISTRATO">AVERBAÇÃO DISTRATO</option>' +
                                                '<option value="CADASTRADO">CADASTRADO</option>' +
                                                '<option value="CONCLUIDO">CONCLUÍDO</option>' +
                                                '<option value="CONSULTA JURIR">CONSULTA JURIR</option>' +
                                            '</select>' +
                                        '</div>' +

                                        '<div class="form-group">' +
                                            '<label>Observações:</label>' +
                                            '<textarea rows="5" name="observacaoDistrato" class="form-control"></textarea>' +                                        
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

                    $(btnAlterarStatusDistrato).appendTo('#btnAlterarStatusDistrato' + item.idDistrato);

            };

            _formataTabelaDespesasDistrato (item.idDistrato);

        });
    
    });
};