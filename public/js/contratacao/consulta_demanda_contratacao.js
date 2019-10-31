$(document).ready(function() {

    var idDemanda = $("#idDemanda").val();

    $.ajax({
        type: 'GET',
        url: '/esteiracomex/contratacao/cadastrar/' + idDemanda,
        data: 'value',
        dataType: 'json',
        success: function (dados) {

            if (dados[0].statusAtual == 'CANCELADA') {
                $('#animacaoBarraDeProgresso').hide();
                let mensagem = 
                    '<div class="box box-solid box-danger">' +
                        '<div class="box-header">' +
                            '<h3 class="box-title"><strong>Demanda Cancelada</strong></h3>' +
                        '</div>' +
                        '<div class="box-body">' +
                            '<p>Para realizar essa operação de ' + dados[0].tipoOperacao + ', será necessário uma nova solicitação. <a href="/esteiracomex/solicitar/contratacao"><strong>clique aqui</strong></a></p>' +
                        '</div>' +
                    '</div>';
                $('#msgmCancelamento').html(mensagem);

            }

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
            else{
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
            $('#valorOperacao').html(dados[0].valorOperacao); //mascarado
            $('#dataPrevistaEmbarque').html(formatDate);
            $('#agResponsavel').html(dados[0].agResponsavel);
            $('#srResponsavel').html(dados[0].srResponsavel);            
            $('#dataLiquidacao').html(formatDate2);
            $('#numeroBoleto').html(dados[0].numeroBoleto);
            $('#equivalenciaDolar').html(dados[0].equivalenciaDolar); //mascarado
            $('#statusGeral').html(dados[0].statusAtual);

            // $('.mascaradinheiro').mask('000.000.000.000.000,00' , { reverse : true});

            //Função global para montar cada linha de histórico do arquivo formata_tabela_historico.js
            _formataTabelaHistorico(dados);

            // IF que faz aparecer e popula os capos de Conta de Beneficiário no exterior e IBAN etc
            var tipoOperação = $("#tipoOperacao").html();

            // if ((tipoOperação == 'Pronto Importação Antecipado') || (tipoOperação == 'Pronto Importação')){
            //     $('#divHideDadosBancarios').show();
            //     $('#divHideDadosIntermediario').show();
            //     $.each(dados[0].esteira_contratacao_conta_importador, function(key, item) {
            //         $('#' + key).html(item);
            //     });
            // };


            $.each(dados[0].esteira_contratacao_confere_conformidade, function(key, item) {
                $('#div' + item.tipoDocumento).show();
                $('#' + item.tipoDocumento).val(item.statusDocumento);
            });

            //Função global que monta a tabela de arquivos do arquivo formata_tabela_documentos.js
            _formataTabelaDocumentos(dados);

            //Função global que formata a data para valor humano do arquivo formata_data.js
            _formataData();

            //Função global que formata dinheiro para valor humano do arquivo formata_data.js.
            _formataValores();

            //Função global que anima a barra de progresso do arquivo anima_progress_bar.js
            _progressBar ();

            //Função global que formata DataTable para portugues do arquivo formata_datatable.js.
            _formataDatatable();

        }
    });


}); // fecha document ready