
// 8 MEGA = 8388608 bytes
// 20 MEGA = 20971520 bytes

var tamanhoMaximoView = 8;

$('#labelLimiteArquivos span').html(tamanhoMaximoView);

var tamanhoMaximo = 8388608;

// Carrega função de animação de spinner do arquivo anima_loading_submit.js
$('#formUploadComplemento').submit(function(){
    _animaLoadingSubmit();
});

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

            // if ((tipoOperação == 'Pronto Importação Antecipado') || (tipoOperação == 'Pronto Importação')){
            //     $('#divHideDadosBancarios').show();
            //     $('#divHideDadosIntermediario').show();
            //     $.each(dados[0].esteira_contratacao_conta_importador, function(key, item) {
            //         $('#' + key).html(item);
            //     });
            // };


            //Função global que formata DataTable para portugues do arquivo formata_datatable.js.
            _formataDatatable();

        }
    });

    var idDemanda = $("#idDemanda").val();

    $.ajax({
        type: 'GET',
        url: '/esteiracomex/contratacao/formalizar/contratos-assinados/dados/' + idDemanda,
        data: 'value',
        dataType: 'json',
        success: function (dados) {
            
            //Função global que monta a tabela de contratos assinados do arquivo formata_tabela_documentos.js
            _formataTabelaUploadContratosAssinados(dados);

            //Função global que formata a data para valor humano do arquivo formata_data.js
            _formataData();

            //  FUNÇÃO DE ANIMAÇÃO DO BOTÃO UPLOAD do arquivo anima_input_file.js
            _animaInputFile();

            // FUNÇÃO QUE PROIBE DAR UPLOAD EM ARQUIVOS QUE NÃO SEJAM OS PERMITIDOS do arquivo anima_input_file.js
            _tiposArquivosPermitidos();

        }
    });

}); // fecha document ready