// 8 MEGA = 8388608 bytes
// 20 MEGA = 20971520 bytes

var tamanhoMaximoView = 8;

$('#labelLimiteArquivos span').html(tamanhoMaximoView);

var tamanhoMaximo = 8388608;

// Carrega função de animação de spinner do arquivo anima_loading_submit.js
$('#formUploadComplemento').submit(function(){
    _animaLoadingSubmit();
});

//  FUNÇÃO DE ANIMAÇÃO DO BOTÃO UPLOAD do arquivo anima_input_file.js
_animaInputFile();


// FUNÇÃO QUE PROIBE DAR UPLOAD EM ARQUIVOS QUE NÃO SEJAM OS PERMITIDOS do arquivo anima_input_file.js
_tiposArquivosPermitidos();

// ####################### VALIDAÇÃO DE SWIFT #######################
// $('.valida-swift').change(function() {
//     let field = $(this);
//     let value = $(this).val();
//     _validaSwift(field, value);
// });

// ####################### VALIDAÇÃO DE IBAN #######################
// $('.valida-iban').change(function(){
//     let field = $(this);
//     let value = $(this).val();
//     _validaIban(field, value);
// });

$(document).ready(function() {

    var unidade = $('#unidade').val();

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

            // function formatMoney () {
            //     numeral.locale('pt-br');
            //     var money = numeral(dados[0].valorOperacao).format('0,0.00');
            //     return money;
            // };

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
            
            if (dados[0].mercadoriaEmTransito == 'SIM') {
                $('#divMercadoriaEmTransito').show();
            }
            
            if (dados[0].cnaeRestrito == 'SIM') {
                $('#divCnaeRestrito').show();
            }
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
            //         $('#' + key).val(item);
            //     });
            // };


            $.each(dados[0].esteira_contratacao_confere_conformidade, function(key, item) {
                $('#div' + item.tipoDocumento).show();
                $('#' + item.tipoDocumento).val(item.statusDocumento);
            });


            // IF que fazem aparecer os campos de input file de acordo com o status

            if ($("select[name=statusInvoice]").val() == 'INCONFORME') {
                $('#divInvoiceUpload').show();
                $('#uploadInvoice').attr('required', true);
            };
        
            if ($("select[name=statusConhecimento]").val() == 'INCONFORME') {
                $('#divConhecimentoUpload').show();
                $('#uploadConhecimento').attr('required', true);
            };
        
            if ($("select[name=statusDi]").val() == 'INCONFORME') {
                $('#divDiUpload').show();
                $('#uploadDi').attr('required', true);
            };
        
            if ($("select[name=statusDue").val() == 'INCONFORME') {
                $('#divDueUpload').show();
                $('#uploadDue').attr('required', true);
            };
        
            // if ($("select[name=statusDadosBancarios").val() == 'INCONFORME') {
            //     $('.iban').prop('disabled', false);
            // };
                   
            //Função global que formata DataTable para portugues do arquivo formata_datatable.js.
            _formataDatatable();

        }
    });

}); // fecha document ready
