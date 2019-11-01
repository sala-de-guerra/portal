$(document).ready(function() {
    
    var idDemanda = $("#idDemanda").val();

    $.ajax({
        type: 'GET',
        url: '/esteiracomex/contratacao/cadastrar/' + idDemanda,
        data: 'value',
        dataType: 'json',
        success: function (dados) {

            if (dados[0].cpf == null){
                $('#cpfCnpj').html(dados[0].cnpj);
            }

            else {
                $('#cpfCnpj').html(dados[0].cpf);
            };

            if (dados[0].tipoOperacao == 'Pronto Importação Antecipado' || dados[0].tipoOperacao == 'Pronto Exportação Antecipado') {
                $('#divDataPrevistaEmbarque').show();

                function formatDate () {
                    var datePart = dados[0].dataPrevistaEmbarque.match(/\d+/g),
                    year = datePart[0],
                    month = datePart[1], 
                    day = datePart[2];
                    
                    return day+'/'+month+'/'+year;
                };
            }
            else {
                var formatDate = dados[0].dataPrevistaEmbarque;
            };

            if (dados[0].dataLiquidacao == null) {
                formatDate2 = '';
            }

            else{
                function formatDate2 () {
                    var datePart = dados[0].dataLiquidacao.match(/\d+/g),
                    year = datePart[0],
                    month = datePart[1], 
                    day = datePart[2];
                
                    return day+'/'+month+'/'+year;
                };
            };

            $('#nomeCliente').html(dados[0].nomeCliente);
            $('#tipoOperacao').html(dados[0].tipoOperacao);
            $('#tipoMoeda').html(dados[0].tipoMoeda);
            $('#valorOperacao').html(dados[0].valorOperacao);
            $('#dataPrevistaEmbarque').html(formatDate);
            $('#agResponsavel').html(dados[0].agResponsavel);
            $('#srResponsavel').html(dados[0].srResponsavel);            
            $('#dataLiquidacao').html(formatDate2);
            $('#numeroBoleto').html(dados[0].numeroBoleto);
            $('#equivalenciaDolar').html(dados[0].equivalenciaDolar);
            $('#statusGeral').html(dados[0].statusAtual);
            

            //Função global para montar cada linha de histórico do arquivo formata_tabela_historico.js
            _formataTabelaHistorico(dados);

            //Função global que formata a data para valor humano do arquivo formata_data.js
            _formataData();

            //Função global que formata dinheiro para valor humano do arquivo formata_data.js.
            _formataValores();

            // IF que faz aparecer e popula os capos de Conta de Beneficiário no exterior e IBAN etc

            var tipoOperação = $("#tipoOperacao").html();

            if ((tipoOperação == 'Pronto Importação Antecipado') || (tipoOperação == 'Pronto Importação')){
                $('#divHideDadosBancarios').show();
                $('#divHideDadosIntermediario').show();
                $.each(dados[0].esteira_contratacao_conta_importador, function(key, item) {
                    $('#' + key).html(item);
                });
            };

            // //Função global que monta a tabela de contratos assinados para verificacao do arquivo formata_tabela_documentos.js
            // _formataTabelaVerificaContratosAssinados(dados);

            //Função global que formata DataTable para portugues do arquivo formata_datatable.js.
            _formataDatatable ();
            
        }
    });

    $.ajax({
        type: 'GET',
        url: '/esteiracomex/contratacao/formalizar/dados/' + idDemanda,
        data: 'value',
        dataType: 'json',
        success: function(dados) {
            //Função global que monta a tabela de contratos assinados para verificacao do arquivo formata_tabela_documentos.js
            _formataTabelaVerificaContratosAssinados(dados);
        }
    });

    setTimeout(function(){ 
        $.ajax({
            type: 'GET',
            url: '/esteiracomex/contratacao/formalizar/contratos-assinados/' + idDemanda,
            data: 'value',
            dataType: 'json',
            success: function (dados) {

                $.each(dados.listaContratosDisponiveisConformidade, function(key, item) {
                    // console.log(item.idUploadContratoAssinado);
                    if (item.statusContrato == 'CONTRATO ASSINADO') {

                        // $('#modalAprovaDoc' + item.idUploadContratoAssinado).hide();
                        // $('#modalExcluiDoc' + item.idUploadContratoAssinado).hide();
                        // $('#btnVisualizaDoc' + item.idUploadContratoAssinado).addClass('alinhaBotaoDireita');
                        

                        var botaoAcao = 
                            '<form method="post" action="/esteiracomex/contratacao/verificar-contrato-assinado/' + item.idUploadContratoAssinado + '" enctype="multipart/form-data" class="radio-inline padding0 excluiDocumentos">' +
                                '<input type="text" class="_method" name="_method" value="PUT" hidden>' +
                                '<input type="text" class="excluid" name="idUploadLink" value="' + item.idUploadContratoAssinado + '" hidden>' +
                                '<input type="text" class="aprovaHidden" name="aprovarContrato" value="SIM" required hidden>' +
                                '<div class="radio-inline padding0">' +
                                    '<a rel="tooltip" type="submit" class="btn btn-success" id="btnAprovaDoc' + item.idUploadContratoAssinado + '" title="Aprovar arquivo."' + 
                                        '<span> <i class="fa fa-check"> </i>   ' + '</span>' + 
                                    '</a>' +
                                '</div>' +
                            '</form>' +
                            '<div class="radio-inline padding0">' +
                                '<div id="divModal' + item.idUploadContratoAssinado + '" class="divModal">' +           
                                    '<div class="radio-inline padding0">' +
                                        '<a rel="tooltip" type="submit" class="btn btn-danger" id="btnExcluiDoc' + item.idUploadContratoAssinado + '" title="Excluir arquivo." data-toggle="modal" data-target="#exclusaoModal' + item.idUploadContratoAssinado + '">' + 
                                            '<span> <i class="glyphicon glyphicon-trash"> </i> </span>' + 
                                        '</a>'  +
                                    '</div>' +
                                    '<div class="radio-inline padding0">' +
                                        '<div class="modal fade" id="exclusaoModal' + item.idUploadContratoAssinado + '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' +  
                                            '<div class="modal-dialog">' +
                                                '<div class="modal-content">' +
                                                    '<div class="modal-header">' +
                                                        '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                                        '<h4 class="modal-title">Contrato nº ' + item.numeroContrato + ' - Inconforme</h4>' +
                                                    '</div>' +
                                                    '<div class="modal-body">' +
                                                        '<form method="post" action="/esteiracomex/contratacao/verificar-contrato-assinado/' + item.idUploadContratoAssinado + '" class="radio-inline padding0 excluiDocumentos" name="formExcluiDocumentos' + item.idUploadContratoAssinado + '" id="formExcluiDocumentos' + item.idUploadContratoAssinado + '">' +
                                                            '<input type="text" class="_method" name="_method" value="PUT" hidden>' +
                                                            '<input type="text" class="excluid" name="idUploadLink" value="' + item.idUploadContratoAssinado + '" hidden>' +
                                                            '<input type="text" class="aprovaHidden" name="aprovarContrato" value="NÃO" required hidden>' +
                                                            '<div class="col-md-12">' +
                                                                '<div class="form-group">' +
                                                                    '<label for="motivoInconformidade" class="control-label">Motivo Inconformidade:</label>' +
                                                                    '<div class="col-md-12">' +
                                                                        '<textarea name="motivoInconformidade" id="motivoInconformidade" class="form-control" rows="6"></textarea>' +
                                                                    '</div>' +
                                                                '</div>' +
                                                            '</div>' +
                                                            '<div class="input-group col-sm-2 right">' +
                                                                '<button type="submit" class="btn btn-primary">Confirmar</button>' +
                                                            '</div>' +
                                                        '</form>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>' +                                        
                                    '</div>' +
                                '</div>' +   
                            '</div>';

                        var el = document.getElementById('divModal' + item.idUploadContratoAssinado);
                        elChild = document.createElement('spam');
                        elChild.innerHTML = botaoAcao;
                        
                        // Prepend it
                        el.insertBefore(elChild, el.firstChild);
                        
                        // $(botaoAcao).prependTo('#divModal' + item.idUploadContratoAssinado);
                
                        // $('#btnExcluiDoc' + item.idUploadContratoAssinado).click(function(){
                        //     $(this).parents("tr").hide();
                        //     $(this).closest("div.divModal").find("input[class='aprovaHidden']").val("NAO");
                        //     $(this).closest("form").submit();
                        //     // $(this).closest("div.divModal").find("input[class='statusDocumento']").val("INCONFORME");
                        //     // alert ("Documento marcado para exclusão, salve a análise para efetivar o comando. Caso não queira mais excluir o documento atualize a página sem gravar.");
                        // });

                        $('#btnAprovaDoc' + item.idUploadContratoAssinado).click(function(){
                            // $(this).parents("tr").hide();
                            // $(this).closest("div.divModal").find("input[class='aprovaHidden']").val("SIM");
                            $(this).closest("form").submit();
                            // $(this).closest("div.divModal").find("input[class='statusDocumento']").val("CONFORME");
                            // alert ("Documento marcado para aprovação, salve a análise para efetivar o comando. Caso não queira mais aprovar o documento atualize a página sem gravar.");
                        }); 
                    }
                });
            }
        })
    }, 1000);
    

}); // fecha document ready

