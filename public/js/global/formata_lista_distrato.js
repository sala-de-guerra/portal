function _formataListaDistrato (numeroContrato, view) {

    $.getJSON('/estoque-imoveis/distrato/consultar-dados-demanda/' + numeroContrato, function(dados){
        
        // CASO NÃO EXISTA DADOS DE DISTRATO, REMOVER A ABA DE DISTRATO
        if (dados.length == 0) {
            $('#custon-tabs-li-distrato').remove();
        }

        $.each(dados, function(key, item) {

            var li =
                '<li id="list-' + item.idDistrato + '">' +

                    '<div class="row">' +
                        '<div class="col-sm-12">' +
                            '<h2 class="card-title"><b>Trajetória do Distrato - Protocolo ' + item.idDistrato + '</b></h2>' +
                            '<br>' +
                            '<div class="card-body pb-0" id="progressBarDistrato' + item.idDistrato + '"></div>' +
                        '</div>' +
                    '</div>' +

                    '<div class="row">' +
                        '<div class="col-sm-3">' +
                            '<div class="form-group">' +
                                '<label>Agência de Contratação:</label>' +
                                '<p>' + item.codigoAgenciaContratacao + '</p>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-sm-3">' +
                            '<div class="form-group">' +
                                '<label>Modalidade de Compra:</label>' +
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
                                '<label>Valor Parcelado:</label>' +
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

                                                '<form method="GET" class="float-right" action="/estoque-imoveis/distrato/emite-dle-despesas/' + item.idDistrato + '">' +
                                                        
                                                    '<button type="submit" class="btn btn-success">' +
                                                        '<i class="far fa-lg fa-file-excel m-2"></i>' +
                                                        'Baixar Planilha de Despesas' +
                                                    '</button>' +

                                                '</form>' +

                                                '<label>Despesas de Distrato Cadastradas:</label>' +
                                                '<br>' +
                                                '<br>' +
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

                        '<div id="btnAnalisarDistrato' + item.idDistrato + '" class="col"></div>' +

                        '<div id="btnCadastrarDespesaDistrato' + item.idDistrato + '" class="col"></div>' +

                        '<div id="btnParecerAnalistaDistrato' + item.idDistrato + '" class="col"></div>' +

                        '<div id="btnParecerGerenteDistrato' + item.idDistrato + '" class="col"></div>' +

                        '<div id="btnAlterarDemandaDistrato' + item.idDistrato + '" class="col"></div>' +

                    '</div>' +

                '</li>' +
                '<hr class="pontilhado">';
                
            $(li).appendTo('#listaDistratos');
            
            if (view == "operacional") {

                if (item.statusAnaliseDistrato == "CADASTRADA") {

                    var btnAnalisarDistrato =
                    
                        '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAnalisarDistrato' + item.idDistrato + '">' +
                            '<i class="far fa-edit"></i>' +
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
                                                '<select name="motivoDistrato" class="form-control" required>' +
                                                    '<option value="">Selecione</option>' +
                                                    '<option value="ACAO JUDICIAL IMPEDITIVA">AÇÃO JUDICIAL IMPEDITIVA</option>' +
                                                    '<option value="ACAO JUDICIAL NAO IMPEDITIVA">AÇÃO JUDICIAL NÃO IMPEDITIVA</option>' +
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

                } else {

                    var btnCadastrarDespesaDistrato =
                        '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastraDespesaDistrato' + item.idDistrato + '">' +
                            '<i class="far fa-edit"></i>' +
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
                                                    '<option value="FINANCIAMENTO E FGTS">Financiamento e/ou FGTS</option>' +
                                                    '<option value="IPTU">IPTU</option>' +
                                                    '<option value="ITBI">ITBI</option>' +
                                                    '<option value="MULTA">Multa</option>' +
                                                    '<option value="PARCELAMENTO E FGTS">Parcelamento e/ou FGTS</option>' +
                                                    '<option value="PARCELAS E TAXAS DE FINANCIAMENTO">Parcelas e Taxas de Financiamento</option>' +
                                                    '<option value="RECURSOS PROPRIOS">Recursos Próprios</option>' +
                                                '</select>' +
                                            '</div>' +

                                            '<div class="form-group">' +
                                                '<label>Data Efetiva da Despesa:</label>' +
                                                '<input type="text" name="dataEfetivaDaDespesa" class="form-control mascaradata datepicker" required>' +
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
                            '<i class="far fa-edit"></i>' +
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
                                                '<textarea rows="5" name="parecerAnalista" class="form-control"></textarea>' +                                        
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
                            '<i class="far fa-edit"></i>' +
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
                                                '<label>Realizar Distrato:</label>' +
                                                '<br>' +
                                                '<div class="form-check form-check-inline">' +
                                                    '<input class="form-check-input" type="radio" name="decisaoGerenteDistrato" id="inlineRadio1" value="SIM" required>' +
                                                    '<label class="form-check-label" for="inlineRadio1">Sim</label>' +
                                                '</div>' +
                                                '<div class="form-check form-check-inline">' +
                                                    '<input class="form-check-input" type="radio" name="decisaoGerenteDistrato" id="inlineRadio2" value="NAO">' +
                                                    '<label class="form-check-label" for="inlineRadio2">Não</label>' +
                                                '</div>' +
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

                    var btnAlterarDemandaDistrato =
                        '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAlterarDemandaDistrato' + item.idDistrato + '">' +
                            '<i class="far fa-edit"></i>' +
                            'Alterar Demanda' +
                        '</button>' +

                        '<div class="modal fade" id="modalAlterarDemandaDistrato' + item.idDistrato + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                            '<div class="modal-dialog" role="document">' +
                                '<div class="modal-content">' +
                                    '<form method="post" action="/estoque-imoveis/distrato/alterar-demanda-distrato/' + item.idDistrato + '" id="formAlterarDemandaDistrato' + item.idDistrato + '">' +
                                        
                                        '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                                        '<input type="hidden" class="form-control" name="_method" value="PUT">' +


                                        '<div class="modal-header">' +
                                            '<h5 class="modal-title" id="exampleModalLabel">Alterar Demanda</h5>' +
                                            '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">' +
                                                '<span aria-hidden="true">&times;</span>' +
                                            '</button>' +
                                        '</div>' +
                                        '<div class="modal-body">' +

                                            '<div class="form-group">' +
                                                '<label>Alterar Status da Demanda:</label>' +
                                                '<select name="statusAnaliseDistrato" class="form-control">' +
                                                    '<option value="' + item.statusAnaliseDistrato + '" selected disabled>' + item.statusAnaliseDistrato + '</option>' +
                                                    '<option value="AVERBACAO DISTRATO">AVERBAÇÃO DISTRATO</option>' +
                                                    '<option value="CADASTRADA">CADASTRADA</option>' +
                                                    '<option value="CANCELADA">CANCELADA</option>' +
                                                    '<option value="CONCLUIDA">CONCLUÍDA</option>' +
                                                    '<option value="ENCAMINHADO AGENCIA">ENCAMINHADO AGENCIA</option>' +
                                                    '<option value="CONSULTA JURIR">CONSULTA JURIR</option>' +
                                                '</select>' +
                                            '</div>' +

                                            '<div class="form-group">' +
                                                '<label>Alterar Motivo de Distrato:</label>' +
                                                '<select name="motivoDistrato" class="form-control">' +
                                                    '<option value="' + item.motivoDistrato + '" selected disabled>' + item.motivoDistrato + '</option>' +
                                                    '<option value="ACAO JUDICIAL IMPEDITIVA">AÇÃO JUDICIAL IMPEDITIVA</option>' +
                                                    '<option value="ACAO JUDICIAL NAO IMPEDITIVA">AÇÃO JUDICIAL NÃO IMPEDITIVA</option>' +
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

                    $(btnAlterarDemandaDistrato).appendTo('#btnAlterarDemandaDistrato' + item.idDistrato);
                }

                _formataTabelaDespesasDistrato (item.idDistrato, "operacional");

            } else {
                _formataTabelaDespesasDistrato (item.idDistrato);
            };

            var arrayPorcentagemEStatus = {
                0: "Cadastrada",
                25: "Aguarda Docs.",
                50: "Em Análise",
                75: "Encaminhada Agência",
                99: "Concluída",
            };
    
            _formataProgressBar ("progressBarDistrato" + item.idDistrato, arrayPorcentagemEStatus, item.statusAnaliseDistrato);

        });

        
    });
    
};