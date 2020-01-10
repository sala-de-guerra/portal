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
                                '<label>Data de início:</label>' +
                                '<p class="formata-data">' + item.dataCadastro + '</p>' +
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
                                '<label>Data de Alteração:</label>' +
                                '<p class="formata-data">' + item.dataUltimaAlteracaoDemanda + '</p>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +

                    '<div class="row">' +
                        '<div class="col-sm-3">' +
                            '<div class="form-group">' +
                                '<label>Modalidade de compra::</label>' +
                                '<p>' + item.modalidadeProposta + '</p>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-sm-9">' +
                            '<div class="form-group">' +
                                '<label>Observação:</label>' +
                                '<p>' + item.observacaoDistrato + '</p>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +

                    '<div id="btnAlteraStatus' + item.idDistrato + '" class="row">' +
                    
                    '</div>' +

                '</li>' +
                '<hr>';
                
            $(li).appendTo('#listaDistratos'); 
            
            if (view = "operacional") {
                var btn =
                
                    '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastraDistrato' + item.idDistrato + '">' +
                        '<i class="far fa-lg fa-edit"></i>' +
                        'Alterar Distrato' +
                    '</button>' +

                    '<div class="modal fade" id="modalCadastraDistrato' + item.idDistrato + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                        '<div class="modal-dialog" role="document">' +
                            '<div class="modal-content">' +
                                '<form method="post" action="/estoque-imoveis/distrato/cadastrar-demanda' + item.idDistrato + '" id="formCadastraDemandaDistrato">' +
                                    '{{ csrf_field() }}' +
                                    '<div class="modal-header">' +
                                        '<h5 class="modal-title" id="exampleModalLabel">Alterar Distrato</h5>' +
                                        '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">' +
                                            '<span aria-hidden="true">&times;</span>' +
                                        '</button>' +
                                    '</div>' +
                                    '<div class="modal-body">' +

                                        '<div class="form-group">' +
                                            '<label>Alterar Motivo de Distrato:</label>' +
                                            '<select name="motivoDistrato" class="form-control" required>' +
                                                '<option value="" selected>Selecione</option>' +
                                                '<option value="AÇÃO JUDICIAL">AÇÃO JUDICIAL</option>' +
                                                '<option value="LEILÕES NEGATIVOS">LEILÕES NEGATIVOS</option>' +
                                                '<option value="IMPOSSIBILIDADE DE REGISTRO DE AQUISIÇÃO">IMPOSSIBILIDADE DE REGISTRO DE AQUISIÇÃO</option>' +
                                                '<option value="DESISTÊNCIA">DESISTÊNCIA</option>' +
                                                '<option value="CRÉDITO NÃO APROVADO">CRÉDITO NÃO APROVADO</option>' +
                                                '<option value="ERRO FORMAL DE EDITAL">ERRO FORMAL DE EDITAL</option>' +
                                                '<option value="DIREITO DE PREFERÊNCIA DO EX-MUTUÁRIO">DIREITO DE PREFERÊNCIA DO EX-MUTUÁRIO</option>' +
                                                '<option value="DISTRATO CANCELADO">DISTRATO CANCELADO</option>' +
                                            '</select>' +
                                        '</div>' +

                                        '<div class="form-group">' +
                                            '<label>Alterar Motivo de Distrato:</label>' +
                                            '<select name="statusDistrato" class="form-control" required>' +
                                                '<option value="" selected>Selecione</option>' +
                                                '<option value="INICIAR ANÁLISE">INICIAR ANÁLISE</option>' +
                                                '<option value="EM ANÁLISE">EM ANÁLISE</option>' +
                                                '<option value="AGUARDA DOC CLIENTE">AGUARDA DOC CLIENTE</option>' +
                                                '<option value="AGUARDA COORDENADOR">AGUARDA COORDENADOR</option>' +
                                                '<option value="AGUARDA GF">AGUARDA GF</option>' +
                                                '<option value="AGUARDA AUT. EMGEA">AGUARDA AUT. EMGEA</option>' +
                                                '<option value="PREPARANDO ORIENT. AG.">PREPARANDO ORIENT. AG.</option>' +
                                                '<option value="ENCAMINHADO AGÊNCIA">ENCAMINHADO AGÊNCIA</option>' +
                                                '<option value="COMANDOS NO CIWEB">COMANDOS NO CIWEB</option>' +
                                                '<option value="COMANDOS NO SIMOV">COMANDOS NO SIMOV</option>' +
                                                '<option value="AVERBAÇÃO DISTRATO">AVERBAÇÃO DISTRATO</option>' +
                                                '<option value="CONCLUÍDO">CONCLUÍDO</option>' +
                                                '<option value="CONSULTA JURIR">CONSULTA JURIR</option>' +
                                            '</select>' +
                                        '</div>' +

                                        '<div class="form-group">' +
                                            '<label>Observações:</label>' +
                                            '<textarea rows="5" name="observacoesDistrato" class="form-control"></textarea>' +
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
                $(btn).appendTo('#btnAlteraStatus' + item.idDistrato); 

            }

        });
        // _formataData();
    });
};