$(document).ready(function() { 

    $('.sidebar-toggle').click();

    $.ajax({
        type: 'GET',
        url: '../contratacao/formalizar',
        // url: '../contratacao/formalizar',
        data: 'value',
        dataType: 'json',
        success: function (dados) {

            $.each(dados.demandasFormalizadas, function(key, item) {

                // TABELA CONTRATOS CONFORMES E FORMALIZADOS

                    // monta a linha com o array de cada demanda
                    var linha = 
                        '<tr>' +
                            '<td>' + item.idDemanda + '</td>' +
                            '<td>' + item.nomeCliente + '</td>' +
                            '<td>' + item.cpfCnpj + '</td>' +  //////////////////////////////////ARRUMAR
                            '<td>' + item.tipoOperacao + '</td>' +
                            '<td class="mascaradinheiro">' + item.valorOperacao + '</td>' +
                            '<td>' + item.unidadeDemandante + '</td>' +
                            '<td>' + item.statusAtual + '</td>' +
                            '<td class="padding5">' +
                                '<a href="../contratacao/formalizar/' + item.idDemanda + '" rel="tooltip" class="btn btn-success margin05 inline formalizar" id="btnFormalizar' + item.idDemanda + '" title="Formalizar demanda">' + 
                                '<span> <i class="glyphicon glyphicon-open-file"> </i></span>' + 
                                '</a>' +
                            '</td>' +
                        '</tr>';

                    // popula a linha na tabela
                    $(linha).appendTo('#tabelaContratacoesFormalizadas>tbody');

            });

        }
    });

    $.ajax({
        type: 'GET',
        url: '../contratacao/formalizar/pendentes-de-retorno',
        // url: '../contratacao/formalizar',
        data: 'value',
        dataType: 'json',
        success: function (dados) {

            $.each(dados.demandasPendentesRetorno, function(key, item) {

            // TABELA CONTROLE DE RETORNOS

                // monta a linha com o array de cada demanda
                var linha = 
                    '<tr href="/esteiracomex/contratacao/consultar/' + item.idDemanda + '">' +
                        '<td>' + item.numeroContrato + '</td>' +
                        // '<td>' + item.idDemanda + '</td>' +
                        '<td>' + item.nomeCliente + '</td>' +
                        '<td>' + item.cpfCnpj + '</td>' +  //////////////////////////////////ARRUMAR
                        '<td>' + item.tipoOperacao + '</td>' +
                        '<td class="mascaradinheiro">' + item.valorOperacao + '</td>' +
                        '<td>' + item.unidadeDemandante + '</td>' +
                        '<td>' + item.dataLiquidacao + '</td>' +
                        '<td class="formata-data">' + item.dataEnvioContrato + '</td>' +
                        '<td class="formata-data">' + item.dataLimiteRetorno + '</td>' +
                        // '<td>' + item.statusAtual + '</td>' +
                    '</tr>';

                // popula a linha na tabela
                $(linha).appendTo('#tabelaControleRetornos>tbody');

            });
         
        }
    });

    $.ajax({
        type: 'GET',
        url: '../contratacao/formalizar/contratos-assinados',
        // url: '../contratacao/formalizar',
        data: 'value',
        dataType: 'json',
        success: function (dados) {

            $.each(dados.listaDemandasSemConformidade, function(key, item) {
         
                // TABELA VERIFICAÇÃO DE ASSINATURA

                // monta a linha com o array de cada demanda
                var linha = 
                    '<tr>' +
                        '<td>' + item.numeroContrato + '</td>' +
                        '<td>' + item.nomeCliente + '</td>' +
                        '<td>' + item.cpfCnpj + '</td>' + 
                        '<td>' + item.tipoOperacao + '</td>' +
                        '<td class="mascaradinheiro">' + item.valorOperacao + '</td>' +
                        '<td class="formata-data-sem-hora">>' + item.dataLiquidacao + '</td>' +
                        '<td>' + item.unidadeDemandante + '</td>' +
                        '<td>' + item.statusAtual + '</td>' +
                        '<td class="padding5">' +
                            '<a href="../contratacao/verificar-contrato-assinado/' + item.idDemanda + '" rel="tooltip" class="btn btn-info margin05 inline verificar" id="btnVerificar' + item.idDemanda + '" title="Verificar assinatura do contrato">' + 
                            '<span> <i class="fa fa-pencil"> </i></span>' + 
                            '</a>' +
                        '</td>' +
                    '</tr>';

                // popula a linha na tabela
                $(linha).appendTo('#tabelaVerificacaoAssinatura>tbody');

               
            });

        //Função global que formata a data para valor humano do arquivo formata_data.js
        _formataData();

        //Função global que formata dinheiro para valor humano do arquivo formata_data.js.
        _formataValores();

        //Função global que formata DataTable para portugues do arquivo formata_datatable.js.
        setTimeout(function(){ 
            _formataDatatableComId('tabelaContratacoesFormalizadas');
            _formataDatatableComId('tabelaControleRetornos');
            _formataDatatableComId('tabelaVerificacaoAssinatura');
        }, 500);


        }
    });

    $('#tabelaControleRetornos tbody').on('click', 'tr', function () {
        var href = $(this).attr("href");            
        if (href == undefined) {
            document.location.href = '/esteiracomex/acompanhar/contratacao';
        } else {
            document.location.href = href;
        };
    });  

});
