var csrfVar = $('meta[name="csrf-token"]').attr('content');
$.fn.dataTable.ext.errMode = 'none';
/**********************\
| Config inicial Toast |
\**********************/

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

$(document).ready(function(){
    $(".menu-hamburguer").click();

    $.when($.getJSON('/estoque-imoveis/conformidade-contratacao/listar-contratos', function(dados){
        $.each(dados, function(key, item) {

            elementoLinkServidor = "'#linkServidor" + item.numeroContrato + "'";
            var linha =
            '<tr>' +
                '<td><a href="/consulta-bem-imovel/'+ item.contratoFormatado +'" class="cursor-pointer">' + item.numeroContrato + '</a></td>' +
                '<td>' + item.tipoVenda + '</td>' +
                '<td>' + item.dataEntradaConformidade + '</td>' +
                '<td>' + item.tipoProposta + '</td>' +
                '<td>' + item.statusContratacao + '</td>' +
                '<td>' +
                    '<div class="row">' +
                    '<div class="col-4">'+
                        '<button id="btnLinkServidor" onclick="copyToClipboard(' + elementoLinkServidor + ')" class="btn btn-outline-primary ml-2" data-toggle="tooltip" data-placement="top" title="Copiar link"><i class="far fa-copy"></i></button>' +
                        '<a href="file://///sp7257sr001/PUBLIC/EstoqueImoveis/' + item.contratoFormatado + '" id="linkServidor' + item.numeroContrato + '" hidden>\\\\sp7257sr001\\PUBLIC\\EstoqueImoveis\\'+ item.contratoFormatado +'</a>' +
                    '</div>' +
                    
                    '<div class="col-4">'+
                    '<button id="'+item.numeroContrato+'" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalOBS'+ item.numeroContrato+'"><i class="fas fa-info-circle"></i>'+'</button>'+
                    '</div>' +
                    '<div class="col-4 divBotao'+item.numeroContrato+'" style="display: none;">'+
                    '<button id="botaoContato'+item.numeroContrato+'" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalContato'+ item.numeroContrato+'"><i class="far fa-envelope"></i>'+'</button>'+
                    '</div>' +

                    // Modal de Observação
                '<div class="modal fade" id="modalOBS'+ item.numeroContrato+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">'+
                '<div class="modal-dialog" role="document">'+
                    '<div class="modal-content">'+
                    '<div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">' +
                    '<h5 style="color: white;" class="modal-title" id="exampleModalLabel">' + 'Observação' + '</h5>' +
                            '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                        '<span aria-hidden="true">&times;</span>'+
                        '</button>'+
                    '</div>'+
                    '<div class="modal-body" id="modal'+ item.numeroContrato+'">'+
                    '</div>'+
                '</div>'+
                '</div>'+
                '</div>'+
            
                          // Modal de contato
               '<div class="modal fade" id="modalContato'+ item.numeroContrato+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">'+
               '<div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">'+
                   '<div class="modal-content">'+
                    '<div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">' +
                    '<h5 style="color: white;" class="modal-title" id="exampleModalLabel">' + 'Contato' + '</h5>' +
                       '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                       '<span aria-hidden="true">&times;</span>'+
                       '</button>'+
                   '</div>'+
                   '<div class="modal-body" id="formContato'+ item.numeroContrato+'">'+
                      
                   '</div>'+
                   '</div>'+
               '</div>'+
               '</div>'+
               '<td class="formata-data-sem-hora">' + item.dataNovoHistorio + '</td>' +
            '</tr>';

            if (item.cardAgrupamento == "Agência" && item.sinalPago == "SIM") {
                $(linha).appendTo('#tblCardAgrupamentoAgencia>tbody');
                $('.divBotao'+item.numeroContrato).show()
            } else if (item.fluxoContratacao == "AG" && item.sinalPago == "SIM") {
                $(linha).appendTo('#tblConformidadeFluxoAgencia>tbody');
            } else if (item.fluxoContratacao == "CCA" && item.sinalPago == "SIM") {
                $(linha).appendTo('#tblConformidadeFluxoCca>tbody');
            } else {
                $(linha).appendTo('#tblCardAgrupamentoAgencia>tbody');
                $('.divBotao'+item.numeroContrato).show()
            }


        $('#'+item.numeroContrato).click(function() {
        $.get( '/estoque-imoveis/consulta-historico-contrato/'+item.contratoFormatado, function(data) {
           
            var form =
                    '<form id="formEnviodeObs'+ item.numeroContrato+'" method="post" action="/estoque-imoveis/conformidade-contratacao/registrar-historico/' + item.contratoFormatado+ '">' +
                        '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                        '<input type="hidden" name="tipoAtendimento" value="ANALISE"></input>'+
                        '<input type="hidden" name="atividadeAtendimento" value="CONFORMIDADE"></input>'+
                        '<p>Contrato: <b>'+  item.contratoFormatado + '</b></p>' +

                        '<p>Última Observação </p>'+
                        '<span id="ultimaOBS'+ item.numeroContrato+'"></span>'+

                        '<div class="form-group">'+
                        '<p>Nova Observação </p>' +
                            '<textarea name="observacaoAtendimento" class="form-control" rows="5" required></textarea>'+
                        '</div>'+
                    '<div class="modal-footer">'+
                        '<button type="button" class="btn btn-secondary" data-dismiss="modal">'+'Voltar'+'</button>'+
                        '<button type="submit" class="btn btn-primary">'+'Gravar'+'</button>'+
                    '</div>'+
                    '</form>'

            $('#modal'+item.numeroContrato).html(form)

            let resultado = JSON.parse(data)
            $.each(resultado.historico, function(chave, valor) {
                let analisaTipo = valor.atividade
                let formataData = valor.data
                let novaData = formataData.replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1');
                
                if (analisaTipo == "CONFORMIDADE"){
                let toString = valor.observacao.replace(/(<([^>]+)>)/ig,"");
                 let data = 
                 '<textarea class="form-control" rows="3" disabled>'+ toString +'</textarea>'+
                '<small class="form-text text-muted">'+ 'incluida em <b>'+novaData+'</b> por <b>'+valor.matriculaResponsavel+'</b>.</small><br>'
                 $('#ultimaOBS'+ item.numeroContrato).html(data)
                }
            })
            $('#formEnviodeObs'+item.numeroContrato).submit( function(e) {

                e.preventDefault();
            
                let datas = JSON.stringify( $(this).serialize() );
                let url = $(this).attr('action');
                let method = $(this).attr('method');
            
                // console.log(datas);
                // console.log(url);
                // console.log(method);
                
                $.ajax({
                    type: method,
                    url: url,
                    // data: {datas, csrfVar},
                    data: $(this).serialize(),
                    success: function (result){
                        
                        $('.modal').modal('hide');
                        
                        
                        Toast.fire({
                            icon: 'success',
                            title: 'Alteração salva!'
                        });
                
                    },
                  
                    error: function () {
                        
                        $('.modal').modal('hide');
            
                        Toast.fire({
                            icon: 'error',
                            title: 'Erro: alteração não efetuada!'
                        });
                    }
                    
                });
            
            })
        })
    })


    $('#botaoContato'+item.numeroContrato).click(function() {
        $.get( '/estoque-imoveis/consulta-historico-contrato/'+item.contratoFormatado, function(data) {
           
            var formCobrancaAgencia =
                    '<form id="formEnviodeCobrancaAgencia'+ item.numeroContrato+'" method="post" action="/estoque-imoveis/conformidade-contratacao/registrar-historico/' + item.contratoFormatado+ '">' +
                        '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                        '<input type="hidden" name="tipoAtendimento" value="ANALISE"></input>'+
                        '<input type="hidden" name="atividadeAtendimento" value="COBRANCA"></input>'+
                        '<p>Email Agência: &nbsp&nbsp<b>'+  item.emailAgencia + '</b></p>' +

                        '<p>Última Cobrança </p>'+
                        '<span id="ultimaOBSCobrancaAgencia'+ item.numeroContrato+'"></span>'+

                        '<div class="form-group">'+
                        '<p>Incluir Novo Histórico: </p>' +
                            '<textarea name="observacaoAtendimento" class="form-control" rows="5" required></textarea>'+
                        '</div>'+

                        '<div class="form-group">'+
                        '<button id="btnToggle'+item.numeroContrato+'" type="button" class="btn btn-primary">Modelo de Cobrança</button><br><br>'+
                        
                        '<div contenteditable="true" id="toggleModelo'+item.numeroContrato+'" style="display: none;">À <br> AG '+ item.codigoAgencia+'<br>'+
                        'A/C <br>'+
                        'Setor de Habitação <br><br>'+
                        '1. Até o presente momento não identificamos a finalização do processo de contratação referente o imóvel <b>' +item.contratoFormatado+ '</b> em nome de <b>'+ item.nomeProponente+'</b><br><br>'+

                        '2. Solicitamos retorno com a data prevista de finalização ou os motivos que impossibilitam a conclusão do financiamento. <br><br>'+

                        '3. À disposição para esclarecimentos. <br><br>'+

                        'Atenciosamente, <br><br>'+

                        item.gilieDeVinculacao +
                        
                        
                        '</div>'+
                        '</div>'+
                    '<div class="modal-footer">'+
                        '<button type="button" class="btn btn-secondary" data-dismiss="modal">'+'Voltar'+'</button>'+
                        '<button type="submit" class="btn btn-primary">'+'Gravar'+'</button>'+
                    '</div>'+
                    '</form>'
                   
            $('#formContato'+item.numeroContrato).html(formCobrancaAgencia)
            
            $('#btnToggle'+item.numeroContrato).click(function() {
                $('#toggleModelo'+item.numeroContrato).toggle();
              });

            let resultado = JSON.parse(data)
            $.each(resultado.historico, function(chave, valor) {
                let analisaTipo = valor.atividade
                let formataData = valor.data
                let novaData = formataData.replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1');
                
                if (analisaTipo == "COBRANCA"){
                let toString = valor.observacao.replace(/(<([^>]+)>)/ig,"");
                 let data = 
                 '<textarea class="form-control" rows="3" disabled>'+ toString +'</textarea>'+
                '<small class="form-text text-muted">'+ 'incluida em <b>'+novaData+'</b> por <b>'+valor.matriculaResponsavel+'</b>.</small><br>'

                 $('#ultimaOBSCobrancaAgencia'+ item.numeroContrato).html(data)
                }
            })
            $('#formEnviodeCobrancaAgencia'+item.numeroContrato).submit( function(e) {

                e.preventDefault();
            
                let datas = JSON.stringify( $(this).serialize() );
                let url = $(this).attr('action');
                let method = $(this).attr('method');
            
                // console.log(datas);
                // console.log(url);
                // console.log(method);
                
                $.ajax({
                    type: method,
                    url: url,
                    // data: {datas, csrfVar},
                    data: $(this).serialize(),
                    success: function (result){
                        
                        $('.modal').modal('hide');
                    
                        Toast.fire({
                            icon: 'success',
                            title: 'Alteração salva!'
                        });
                   
                    },
                  
                    error: function () {
                        
                        $('.modal').modal('hide');
            
                        Toast.fire({
                            icon: 'error',
                            title: 'Erro: alteração não efetuada!'
                        });
                    }
                    
                });
            
            })
        })
    })

        });
    })).done(function() {
        _formataData() 
        _formataValores();
        _formataDatatableComData()
    })

})

$.when($.getJSON('/estoque-imoveis/acompanha-contratacao/listar-contratos-sem-pagamento-sinal', function(dados){
    $.each(dados, function(key, item) {  
        
        elementoServidor = "'#linkServidor" + item.numeroContrato + "'";
            
            let formataData = item.vencimentoPp15
            let novaData = formataData.replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1');
        
            let Novalinha = 
            '<tr>' +
            '<td><a href="/consulta-bem-imovel/'+ item.bemFormatado +'" class="cursor-pointer">' + item.numeroContrato + '</a></td>' +
                '<td class="formata-valores">' + item.valorProposta + '</td>' +
                '<td>' + novaData + '</td>' +
                '<td>' + item.statusSimov + '</td>' +
                '<td>'+ 
                    '<div class="row">' +
                    '<div class="col-6">'+
                        '<button id="btnLinkServidor" onclick="copyToClipboard(' + elementoServidor + ')" class="btn btn-outline-primary ml-2" data-toggle="tooltip" data-placement="top" title="Copiar link"><i class="far fa-copy"></i></button>' +
                        '<a href="file://///sp7257sr001/PUBLIC/EstoqueImoveis/' + item.bemFormatado + '" id="linkServidor' + item.numeroContrato + '" hidden>\\\\sp7257sr001\\PUBLIC\\EstoqueImoveis\\'+ item.bemFormatado +'</a>' +
                    '</div>' +

                '<div class="col-6">'+
                '<button id="Pagamento'+item.numeroContrato+'" class="btn btn-primary" data-toggle="modal" data-target="#modalPagamento'+ item.numeroContrato+'"><i class="fas fa-info-circle"></i>'+'</button>'+
                '</div>'+
                // Modal de Observação
                '<div class="modal fade" id="modalPagamento'+ item.numeroContrato+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">'+
                '<div class="modal-dialog" role="document">'+
                    '<div class="modal-content">'+
                    '<div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">' +
                    '<h5 style="color: white;" class="modal-title" id="exampleModalLabel">' + 'Observação' + '</h5>' +
                            '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                        '<span aria-hidden="true">&times;</span>'+
                        '</button>'+
                    '</div>'+
                    '<div class="modal-body" id="modalBodyPagamento'+ item.numeroContrato+'">'+
                    '</div>'+
                '</div>'+
                '</div>'+
                '</td>' +
            '</tr>';
        $(Novalinha).appendTo('#tblContratosSemPagamentoSinal>tbody'); 

        $('#Pagamento'+item.numeroContrato).click(function() {
            $.get( '/estoque-imoveis/consulta-historico-contrato/'+item.bemFormatado, function(data) {
                var formPag =
                        '<form method="post" action="/estoque-imoveis/conformidade-contratacao/registrar-historico/' + item.bemFormatado+ '">' +
                            '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                            '<input type="hidden" name="tipoAtendimento" value="ANALISE"></input>'+
                            '<input type="hidden" name="atividadeAtendimento" value="COBRANÇA"></input>'+
                            '<p>Contrato: <b>'+  item.bemFormatado + '</b></p>' +
    
                            '<p>Última Observação </p>'+
                            '<span id="ultimaObsPag'+ item.numeroContrato+'"></span>'+
    
                            '<div class="form-group">'+
                            '<p>Nova Observação </p>' +
                                '<textarea name="observacaoAtendimento" class="form-control" rows="5" required></textarea>'+
                            '</div>'+
                        '<div class="modal-footer">'+
                            '<button type="button" class="btn btn-secondary" data-dismiss="modal">'+'Voltar'+'</button>'+
                            '<button type="submit" class="btn btn-primary">'+'Gravar'+'</button>'+
                        '</div>'+
                        '</form>'
    
                $('#modalBodyPagamento'+item.numeroContrato).html(formPag)
                
                var Novoresultado = JSON.parse(data)
                $.each(Novoresultado.historico, function(chave, valor) {
                    
                    var analisaTipo = valor.atividade
                    var formataData = valor.data
                    var novaData = formataData.replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1');
                    
                    if (analisaTipo == "COBRANÇA"){
                     var NovoDado = 
                     '<textarea class="form-control" rows="3" disabled>'+ valor.observacao +'</textarea>'+
                    '<small class="form-text text-muted">'+ 'incluida em <b>'+novaData+'</b> por <b>'+valor.matriculaResponsavel+'</b>.</small><br>'
                     $('#ultimaObsPag'+ item.numeroContrato).html(NovoDado)
                    }
                })
                $('form').submit( function(e) {
    
                    e.preventDefault();
                
                    let datas = JSON.stringify( $(this).serialize() );
                    let url = $(this).attr('action');
                    let method = $(this).attr('method');
                
                    // console.log(datas);
                    // console.log(url);
                    // console.log(method);
                    
                    $.ajax({
                        type: method,
                        url: url,
                        // data: {datas, csrfVar},
                        data: $(this).serialize(),
                        success: function (result){
                            
                            $('.modal').modal('hide');

                            Toast.fire({
                                icon: 'success',
                                title: 'Alteração salva!'
                            });
                            
                        },
                      
                        error: function () {
                            
                            $('.modal').modal('hide');
                
                            Toast.fire({
                                icon: 'error',
                                title: 'Erro: alteração não efetuada!'
                            });
                        }
                        
                    });
                
                })
            })
        })
    })
})).done(function() { 
    $("#tblContratosSemPagamentoSinal").addClass("dataTable");
    _formataValores();
    _formataDatatableComData()
})

2
3
$("#btnRefresh").click(function() {
    location.reload();
});