
var tamanhoMaximo = 8388608;

// Carrega função de animação de spinner do arquivo anima_loading_submit.js
$('#formUploadFormaliza').submit(function(){
    _animaLoadingSubmit();
});

//  FUNÇÃO DE ANIMAÇÃO DO BOTÃO UPLOAD do arquivo anima_input_file.js
_animaInputFile();


// FUNÇÃO QUE PROIBE DAR UPLOAD EM ARQUIVOS QUE NÃO SEJAM OS PERMITIDOS do arquivo anima_input_file.js
_tiposArquivosPermitidos();

// Função que anima o radio de Tem retorno: Sim ou Não

$('#tipoContrato').change(function(){
    switch($('#tipoContrato option:selected').val()) {

        case "": 
            $('#divRadioRetorno').hide();
            $('.temRetornoRede').attr('checked', false);
            $('.temRetornoRede').prop('required', false);
        break;
        
        case "CONTRATACAO": 
            $('#divRadioRetorno').hide();
            $('.temRetornoRede').attr('checked', false);
            $('.temRetornoRede').prop('required', false);
        break;

        case "ALTERACAO": 
            $('#divRadioRetorno').show();
            $('.temRetornoRede').attr('checked', false);
            $('.temRetornoRede').prop('required', true);
        break;

        case "CANCELAMENTO": 
            $('#divRadioRetorno').show();
            $('.temRetornoRede').attr('checked', false);
            $('.temRetornoRede').prop('required', true);
        break;

    }
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

            if (dados[0].statusAtual == 'NÃO LIQUIDADA') {
                $('#motivoDevolucao').val(dados[0].motivoDevolucaoLiquidacao);
                $('#demandaNaoLiquidada').removeAttr('hidden');
            }

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

           
            $('#historico').DataTable({
                "pageLength": 5,
                "order": [[ 0, "desc" ]],    
                "language": {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "Mostrar _MENU_ resultados por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSearch": "Pesquisar",
                    "oPaginate": {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    },
                    "oAria": {
                        "sSortAscending": ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    }
                }
            });

        }
    });

}); // fecha document ready
