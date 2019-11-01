$(document).ready(function() {

    $.ajax({
        type: 'GET',
        url: '/esteiracomex/contratacao/liquidar/listar-contratos',
        // url: '../../esteiracomex/gerenciar/listar-demandas-para-liquidar',
        data: 'value',
        dataType: 'json',
        success: function (dados) {
            // captura os arrays de demandas do json
            $.each(dados.demandasParaLiquidar, function(key, item) {

            // monta a linha com o array de cada demanda

                var linha = 
                '<tr>' +
                    '<td>' + item.idDemanda + '</td>' +
                    '<td>' + item.nomeCliente + '</td>' +
                    '<td>' + item.cpfCnpj + '</td>' +
                    '<td>' + item.tipoOperacao + '</td>' +
                    '<td>' + item.numeroContrato + '</td>' +
                    '<td class="formata-data-sem-hora">' + item.dataLiquidacao + '</td>' +
                    '<td class="mascaradinheiro">' + item.valorOperacao + '</td>' +
                    '<td>' + item.dadosContaCliente + '</td>' +
                    '<td>' +
                        '<div class="radio-inline padding0">' +
                            '<a href="../contratacao/consultar/' + item.idDemanda + '" rel="tooltip" class="btn btn-primary" id="btnConsulta' + item.idDemanda + '" title="Consultar demanda."' + 
                                '<span> <i class="fa fa-binoculars"> </i> </span>' + 
                            '</a>' +
                        '</div>' +
                        '<div class="radio-inline padding0">' +
                            '<form method="POST" action="/esteiracomex/contratacao/liquidar/' + item.idDemanda + '" enctype="multipart/form-data" name="formLiquida' + item.idDemanda + '" id="formLiquida' + item.idDemanda + '">' +
                                '<input type="text" class="liquida" name="statusAtual" value="LIQUIDADA" hidden>' +
                                '<input type="text" class="_method" name="_method" value="PUT" hidden>' +
                                '<button type="submit" form="formLiquida' + item.idDemanda + '" class="btn btn-success margin0" id="btnLiquida' + item.idDemanda + '" title="Liquidar demanda."' + 
                                    '<span> <i class="fa fa-check"> </i> </span>' + 
                                '</button>' +
                            '</form>' +
                        '</div>' +
                        '<div class="radio-inline padding0">' +
                            '<div id="divModal' + item.idDemanda + '" class="divModal">' +           
                                '<div class="radio-inline padding0">' +
                                    '<a rel="tooltip" type="submit" class="btn btn-danger" id="btnExcluiDoc' + item.idDemanda + '" title="Excluir arquivo." data-toggle="modal" data-target="#exclusaoModal' + item.idDemanda + '">' + 
                                        '<span> <i class="glyphicon glyphicon-trash"> </i> </span>' + 
                                    '</a>'  +
                                    '<div class="modal fade" id="exclusaoModal' + item.idDemanda + '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' +  
                                        '<div class="modal-dialog">' +
                                            '<div class="modal-content">' +
                                                '<div class="modal-header">' +
                                                    '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                                    '<h4 class="modal-title">Demanda #' + item.idDemanda + ' - Inconforme</h4>' +
                                                '</div>' +
                                                '<div class="modal-body">' +
                                                    '<form method="POST" action="/esteiracomex/contratacao/liquidar/' + item.idDemanda + '" enctype="multipart/form-data" name="formDevolve' + item.idDemanda + '" id="formDevolve' + item.idDemanda + '">' +
                                                        '<input type="text" class="devolve" name="statusAtual" value="NÃO LIQUIDADA" hidden>' +
                                                        '<input type="text" class="_method" name="_method" value="PUT" hidden>' +
                                                        '<div class="col-md-12">' +
                                                            '<div class="form-group">' +
                                                                '<label for="motivoDevolucaoLiquidacao" class="control-label">Motivo Devolução:</label>' +
                                                                '<textarea name="motivoDevolucaoLiquidacao" id="motivoDevolucaoLiquidacao" class="form-control" rows="7" cols="80"></textarea>' +
                                                            '</div>' +
                                                        '</div>' +
                                                        '<div class="input-group col-sm-2">' +
                                                            '<button type="submit" form="formDevolve' + item.idDemanda + '" class="btn btn-primary">Confirmar</button>' +
                                                        '</div>' +
                                                    '</form>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +                                        
                                '</div>' +
                            '</div>' +                           
                        '</div>' +
                    '</td>' +
                '</tr>';

                // popula a linha na tabela
                $(linha).appendTo('#tabelaPedidosContratacao>tbody');
                    
            });

            //Função global que formata a data para valor humano do arquivo formata_data.js
            _formataData();

            //Função global que formata dinheiro para valor humano do arquivo formata_data.js.
            _formataValores();

            //Função global que formata DataTable para portugues do arquivo formata_datatable.js.
            _formataDatatable();

        }
    });


});