$(document).ready(function() {

    var cpfCnpj = $("#cpfCnpj").html();

    var protocolo = $("#idDemanda").html();

    var idDemanda = $("#idDemanda").val();

    var excluirDocumentos = [];
   
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
                $('.mercadoriaEmTransito').attr('required', false);
                $('#divMercadoriaEmTransito').hide();
                
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
            $('#dataLiquidacao').val(formatDate2);
            $('#numeroBoleto').val(dados[0].numeroBoleto);
            $('#equivalenciaDolar').val(dados[0].equivalenciaDolar);
            $('#statusGeral').val(dados[0].statusAtual);
            $('#mercadoriaEmTransito').val(dados[0].mercadoriaEmTransito);

            $('.mascaraInputDinheiro').mask('000.000.000.000.000,00' , { reverse : true});
            $('#dataLiquidacao').datepicker();

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


            $.each(dados[0].esteira_contratacao_confere_conformidade, function(key, item) {

                $('#div' + item.tipoDocumento).show();
                $('#' + item.tipoDocumento).val(item.statusDocumento);
                $('#' + item.tipoDocumento).attr('required', true);
                $('#id' + item.tipoDocumento).val(item.idCheckList);

            });
            
            //Função global que monta a tabela de arquivos do arquivo formata_tabela_documentos.js
            _formataTabelaDocumentos(dados);

            $.each(dados[0].esteira_contratacao_upload, function(key, item) {
                var botaoExcluir = 
                    '<form method="put" action="" enctype="multipart/form-data" class="form-horizontal excluiDocumentos" name="formExcluiDocumentos' + item.idUploadLink + '" id="formExcluiDocumentos' + item.idUploadLink + '">' +
                        '<input type="text" class="excluid" name="idUploadLink" value="' + item.idUploadLink + '" hidden="hidden">' +
                        '<input type="text" class="excluiHidden" name="excluir" value="NAO" hidden="hidden">' +
                    '</form>' +
                    '<div class="radio-inline padding0">' +
                        '<a rel="tooltip" class="btn btn-danger" id="btnExcluiDoc' + item.idUploadLink + '" title="Excluir arquivo."' + 
                            '<span> <i class="glyphicon glyphicon-trash"> </i>   ' + '</span>' + 
                        '</a>' +
                    '</div>';
                
                $(botaoExcluir).prependTo('#divModal' + item.idUploadLink);
        
                $('#btnExcluiDoc' + item.idUploadLink).click(function(){
                    $(this).parents("tr").hide();
                    $(this).closest("div.divModal").find("input[class='excluiHidden']").val("SIM");
                    alert ("Documento marcado para exclusão, salve a análise para efetivar o comando. Caso não queira mais excluir o documento atualize a página sem gravar.");
                });    

            });

            //Função global que formata DataTable para portugues do arquivo formata_datatable.js.
            _formataDatatable();

        }

    });

    function postar() {

        // Carrega função de animação de spinner do arquivo anima_loading_submit.js
        _animaLoadingSubmit();

        // var excluirDocumentos = [{'name':'id','value':'9','name':'excluir','value':'SIM'}];
        excluirDocumentos = [];
        $('.excluiDocumentos').each(function() {
            let documento = $(this).serializeArray().reduce(function(obj, item) {
                obj[item.name] = item.value;
                return obj;
            }, {});
            excluirDocumentos.push(documento);
            // return excluirDocumentos;
        });

        var data = $('#formAnaliseDemanda').serializeArray().reduce(function(obj, item) {
            obj[item.name] = item.value;
            return obj;
        });
        var formData = {data, excluirDocumentos};
        // var formData = JSON.stringify(dados);
        $.ajax({
            type: 'PUT',
            url: '/esteiracomex/contratacao/cadastrar/' + idDemanda,
            dataType: 'JSON',
            data: formData,
            statusCode: {
                200: function(data) {
                    window.location.href = "/esteiracomex/acompanhar/minhas-demandas";
                }
            }
        });
    };

    // function checarStatusDocumentos() {
    //     $('.statusDocumentos').each( function(){
    //         if ($(this).val() == 'INCONFORME') {

    //         }
    //     });
    // }

    // function testaCampos () {
    //     switch('INCONFORME' || '') {

    //         case $('#INVOICE').val():   
    //             console.log("não postar")
    //         break;
            
    //         case $('#CONHECIMENTO_DE_EMBARQUE').val():   
    //             console.log("não postar")
    //         break;

    //         case $('#DI').val():   
    //             console.log("não postar")
    //         break;

    //         case $('#DUE').val():   
    //             console.log("não postar")
    //         break;

    //         case $('#DADOS_CONTA_DO_BENEFICIARIO').val():   
    //             console.log("não postar")
    //         break;

    //         case $('#DOCUMENTOS_DIVERSOS').val():   
    //             console.log("não postar")
    //     }
    // }


    
    $('#formAnaliseDemanda').submit(function(e){
        e.preventDefault();

        if ($('#statusGeral').val() == 'DISTRIBUIDA') {
            alert("Selecione um status geral.");
        } 
        
        if ($('#statusGeral').val() == 'CONFORME') {
            var count = 0;
            $('.statusDocumentos').each(function() {
                if ($(this).val() == 'INCONFORME') {
                    ++count;
                }
                return count
            });
            
            if (count > 0) {
                alert("O status geral foi marcado como CONFORME porém algum documento está marcado como INCONFORME. Verifique os campos e clique em GRAVAR novamente.");
            }

            else {
                postar();
            }
        }

        else {
            postar();
        }

        // $('.statusDocumentos').each( function(){

        //     if ($(this).val() == 'INCONFORME') {

        //         if  ($('#statusGeral').val() != 'INCONFORME') {
        //             // $('#statusGeral').val('INCONFORME')
        //             alert("O status geral foi marcado como CONFORME porém algum documento está marcado como INCONFORME. Verifique os campos e clique em GRAVAR novamente.");
        //         } else {
        //             console.log("postar");
        //             // postar();
        //         }

        //     } else {
        //         console.log("postar");
        //         // postar();
        //     }
        // });
    });
}) // fim do doc ready
