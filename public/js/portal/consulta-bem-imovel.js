$(document).ready(function(){

    _formataTabelaHistorico (numeroContrato);
    _formataTabelaMensagensEnviadas (numeroContrato);

    $.getJSON('/estoque-imoveis/consulta-contrato/' + numeroContrato, function(dados){


        var numeroBem = dados.numeroBem;
        // var dossieDigital = dados.dossieDigital;

        // _formataTabelaDocumentos (numeroBem, dossieDigital);

        // _formataTabelaLaudos (numeroBem);


        $.each(dados, function(key, item) {
            $('#' + key).html(item);
        });

        var arrayPorcentagemEStatus = {
            0: "Preparaçâo",
            25: "Leilão",
            50: "Venda Online",
            75: "Contratação",
            99: "Vendido",
        };

        _formataProgressBar ("progressBarGeral", arrayPorcentagemEStatus, dados.statusImovel);
        _formataDatatable();
    
    });

    $.getJSON('/estoque-imoveis/distrato/consultar-dados-demanda/' + numeroContrato, function(dados){
        console.log('/estoque-imoveis/distrato/consultar-dados-demanda/' + numeroContrato);


        $.each(dados, function(key, item) {

            li = 
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


            '</li>';
            
            $(li).appendTo('#listaDistratos'); 
            
        });
        _formataData();
    });

    // var tamanhoMaximoView = 8;
    // var tamanhoMaximo = 8388608;

    // _animaInputFile();

    

});

function copyToClipboard(element) {

    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();

    $("#labelCopyToClipboard").fadeIn(600).delay(2000).fadeOut(600);
}

 // 'idDistrato' =>,
        //     'nomeProponente' =>,
        //     'cpfCnpjProponente' =>,
        //     'telefoneProponente' =>,
        //     'emailProponente' =>,
        //     'modalidadeProposta' =>,
        //     'dataCadastro' =>,
        //     'dataUltimaAlteracaoDemanda' =>,
        //     'motivoDistrato' =>,
        //     'statusAnaliseDistrato' =>,
        //     'observacaoDistrato' =>, 