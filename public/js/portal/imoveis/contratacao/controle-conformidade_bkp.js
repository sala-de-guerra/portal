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

// pegar a data de hoje para atualizar "ultimo tratamento"
Date.prototype.getMonthFormatted = function() {
	var month = this.getMonth() + 1;
	return month < 10 ? '0' + month : month;
}
Date.prototype.getDateFormatted = function() {
	var date = this.getDate();
	return date < 10 ? '0' + date : date;
}
var d = new Date();
var strDate = d.getDateFormatted() + "/" + d.getMonthFormatted() + "/" + d.getFullYear();


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
                    '<div class="row ml-2">' +
                    // '<div >'+
                    //     '<button id="btnLinkServidor" onclick="copyToClipboard(' + elementoLinkServidor + ')" class="btn btn-outline-primary ml-2 mb-2" data-toggle="tooltip" data-placement="top" title="Copiar link"><i class="far fa-copy"></i></button>' +
                    //     '<a href="file://///arquivos.caixa/sp/SP7257FS201/PUBLICO/PUBLIC/EstoqueImoveis/' + item.contratoFormatado + '" id="linkServidor' + item.numeroContrato + '" hidden>\\\\arquivos.caixa\\sp\\SP7257FS201\\PUBLICO\\PUBLIC\\EstoqueImoveis\\'+ item.contratoFormatado +'</a>&nbsp&nbsp&nbsp&nbsp' +
                    // '</div>' +
                    
                    '<div >'+
                    '<button id="'+item.numeroContrato+'" type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalOBS'+ item.numeroContrato+'"><i class="fas fa-info-circle"></i>'+'</button>&nbsp&nbsp&nbsp&nbsp'+
                    '</div>' +
                    '<div class="divBotao'+item.numeroContrato+'" style="display: none;">'+
                    '<button id="botaoContato'+item.numeroContrato+'" type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalContato'+ item.numeroContrato+'"><i class="far fa-envelope"></i>'+'</button>'+
                    '</div>' +

                    // Modal de Observação
                '<div class="modal fade" id="modalOBS'+ item.numeroContrato+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">'+
                '<div class="modal-dialog modal-lg" role="document">'+
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
                    '<h5 style="color: white;" class="modal-title" id="exampleModalLabel">' + 'Enviar Mensagem' + '</h5>' +
                       '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                       '<span aria-hidden="true">&times;</span>'+
                       '</button>'+
                   '</div><br>'+
                //    '<div class="container">'+

                //     '<p class="ml-3">Deseja enviar um email cobrando o andamento do processo <b>'+item.contratoFormatado+'</b><br>'+ 
                //     'em nome de <b>'+item.nomeProponente+' </b> para a agência: <b>'+item.codigoAgencia+'</b></p>'+
                //    '</div>'+
                   '<div class="modal-body" id="formContato'+ item.numeroContrato+'">'+ 

                   '</div>'+
                   '</div>'+
               '</div>'+
               '</div>'+
               '<td class="formata-data-sem-horas" id="novoHistorico'+item.numeroContrato+'">' + item.dataNovoHistorio + '</td>' +
            '</tr>';

            
            if (item.cardAgrupamento == "Agência" && item.sinalPago == "SIM" && item.tipoProposta != "A vista com recursos proprios" ) {
                $(linha).appendTo('#tblCardAgrupamentoAgencia>tbody');
                $('.divBotao'+item.numeroContrato).show()
            } else if (item.fluxoContratacao == "AG" && item.sinalPago == "SIM" && item.tipoProposta != "A vista com recursos proprios") {
                $(linha).appendTo('#tblConformidadeFluxoAgencia>tbody');
            } else if (item.fluxoContratacao == "CCA" && item.sinalPago == "SIM" && item.tipoProposta != "A vista com recursos proprios"){ 
                $(linha).appendTo('#tblConformidadeFluxoCca>tbody');
            } else if (item.cardAgrupamento == null && item.sinalPago == "SIM" && item.tipoProposta != "A vista com recursos proprios"){ 
                $(linha).appendTo('#tblCardAgrupamentoAgencia>tbody');
            }

            // else {
            //     $(linha).appendTo('#tblCardAgrupamentoAgencia>tbody');
            //     $('.divBotao'+item.numeroContrato).show()
            // }

            if (item.tipoHistorico == "CONTRATACAO" || item.tipoHistorico == "DISTRATO" ||
                item.tipoHistorico == "PAGAMENTO" || item.tipoHistorico == "PREPARACAO" ||
                item.tipoHistorico == "CONFORMIDADE CONTRATAÇÃO" || item.tipoHistorico == "AVERBACAO" ||
                item.tipoHistorico == "EMGEA" ||
                item.tipoHistorico == "LEILÃO NEGATIVO" || item.tipoHistorico == "ATENDE") 
            {
                $('#novoHistorico'+item.numeroContrato).text("")
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
                var novaData = formataData.replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1');
                
                if (analisaTipo == "CONFORMIDADE" || analisaTipo == "COBRANCA"){
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
                        $('#novoHistorico'+ item.numeroContrato).text(strDate)
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

                    '<form id="formEnviodeCobrancaAgencia'+ item.numeroContrato+'" method="post" action="/estoque-imoveis/conformidade-contratacao/mensagem">' +
                        '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                        // '<input type="hidden" name="tipoAtendimento" value="ANALISE"></input>'+
                        // '<input type="hidden" name="atividadeAtendimento" value="COBRANCA"></input>'+
                        '<input type="hidden" name="emailAgencia" value="'+  item.emailAgencia +'"></input>'+
                        '<input type="hidden" name="nomeProponente" value="'+  item.nomeProponente +'"></input>'+
                        '<input type="hidden" name="contratoFormatado" value="'+  item.contratoFormatado +'"></input>'+
                        '<input type="hidden" name="codigoAgencia" value="'+  item.codigoAgencia +'"></input>'+
                        '<input type="hidden" name="gilieDeVinculacao" value="'+  item.gilieDeVinculacao +'"></input>'+

                        '<div class="form-group">'+
                        '<p>Incluir Mensagem : </p>' +
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
                        '<button type="submit" class="btn btn-primary">'+'Enviar'+'</button>'+
                    '</div>'+
                    '</form>'


                   
            $('#formContato'+item.numeroContrato).html(formCobrancaAgencia)
            
            $('#btnToggle'+item.numeroContrato).click(function() {
                $('#toggleModelo'+item.numeroContrato).toggle();
              });

            // let resultado = JSON.parse(data)
            // $.each(resultado.historico, function(chave, valor) {
            //     let analisaTipo = valor.atividade
            //     let formataData = valor.data
            //     let novaData = formataData.replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1');
                
            //     if (analisaTipo == "COBRANCA"){
            //     let toString = valor.observacao.replace(/(<([^>]+)>)/ig,"");
            //      let data = 
            //      '<textarea class="form-control" rows="3" disabled>'+ toString +'</textarea>'+
            //     '<small class="form-text text-muted">'+ 'incluida em <b>'+novaData+'</b> por <b>'+valor.matriculaResponsavel+'</b>.</small><br>'

            //      $('#ultimaOBSCobrancaAgencia'+ item.numeroContrato).html(data)
            //     }
            // })
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
                            title: 'Email enviado!'
                        });
                        $('#novoHistorico'+ item.numeroContrato).text(strDate)
                    },
                  
                    error: function () {
                        
                        $('.modal').modal('hide');
            
                        Toast.fire({
                            icon: 'error',
                            title: 'Erro: Email não enviado. tente novamente!'
                        });
                    }
                    
                });
            
            })
        })
    })

        });
    })).done(function() {
        _formataDatas()
        _formataDatatableComData()
    })

})

$.when($.getJSON('/estoque-imoveis/acompanha-contratacao/listar-contratos-sem-pagamento-sinal', function(dados){
    $.each(dados, function(key, item) {  

        elementoServidorpag = "'#linkServidorpag" + item.NU_BEM + "'";
            
            let formataData = item.vencimentoPp15
            let novaData = formataData.replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1');
        
            let Novalinha = 
            '<tr>' +
            '<td><a href="/consulta-bem-imovel/'+ item.BEM_FORMATADO +'" class="cursor-pointer">' + item.NU_BEM + '</a></td>' +
                '<td class="formata-valores">' + item.VALOR_REC_PROPRIOS_PROPOSTA + '</td>' +
                '<td>' + novaData + '</td>' +
                '<td>' + item.STATUS_IMOVEL + '</td>' +
                '<td>'+ 
                    '<div class="row ml-2">' +
                    // '<div>'+
                    //     '<button id="btnLinkServidorpag" onclick="copyToClipboard(' + elementoServidorpag + ')" class="btn btn-outline-primary ml-2" data-toggle="tooltip" data-placement="top" title="Copiar link"><i class="far fa-copy"></i></button>' +
                    //     '<a href="file://///arquivos.caixa/sp/SP7257FS201/PUBLICO/PUBLIC/EstoqueImoveis/' + item.BEM_FORMATADO + '" id="linkServidorpag' + item.NU_BEM + '" hidden>\\\\arquivos.caixa\\sp\\SP7257FS201\\PUBLICO\\PUBLIC\\EstoqueImoveis\\'+ item.BEM_FORMATADO +'</a>&nbsp&nbsp&nbsp&nbsp' +
                    // '</div>' +
                '<div>'+
                '<button id="Pagamento'+item.NU_BEM+'" class="btn btn-primary" data-toggle="modal" data-target="#modalPagamento'+ item.NU_BEM+'"><i class="fas fa-info-circle"></i>'+'</button>&nbsp&nbsp&nbsp&nbsp'+
                '</div>'+

                '<div class="divBotao'+item.NU_BEM+'">'+
                '<button id="botaoContato'+item.NU_BEM+'" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalContatoPagamento'+ item.NU_BEM+'"><i class="far fa-envelope"></i>'+'</button>'+
                '</div>' +

                 // Modal de contato
               '<div class="modal fade" id="modalContatoPagamento'+ item.NU_BEM+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">'+
                '<div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">'+
                    '<div class="modal-content">'+
                            '<div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">' +
                                '<h5 style="color: white;" class="modal-title" id="exampleModalLabel">' + 'Enviar Mensagem' + '</h5>' +
                                '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                                '<span aria-hidden="true">&times;</span>'+
                                '</button>'+
                            '</div><br>'+
                            '<div class="modal-body" id="formContatoPagamento'+ item.NU_BEM+'">'+ 

                            '</div>'+
                        '</div>'+
                    '</div>'+
                   '</div>'+

                // Modal de Observação
                '<div class="modal fade" id="modalPagamento'+ item.NU_BEM+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">'+
                '<div class="modal-dialog" role="document">'+
                    '<div class="modal-content">'+
                    '<div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">' +
                    '<h5 style="color: white;" class="modal-title" id="exampleModalLabel">' + 'Observação' + '</h5>' +
                            '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                        '<span aria-hidden="true">&times;</span>'+
                        '</button>'+
                    '</div>'+
                    '<div class="modal-body" id="modalBodyPagamento'+ item.NU_BEM+'">'+
                    '</div>'+
                '</div>'+
                '</div>'+
                '</td>' +
                '<td class="formata-data-sem-hora" id="novoHistorico'+item.NU_BEM+'">' + item.updated_at + '</td>' +
            '</tr>';
        $(Novalinha).appendTo('#tblContratosSemPagamentoSinal>tbody');
 
        var formCobrancaPagamento = 

        '<form id="formEnviodeCobrancaAgencia'+ item.NU_BEM+'" method="post" action="/estoque-imoveis/conformidade-contratacao/mensagemPagamento">' +
            '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
            // '<input type="hidden" name="tipoAtendimento" value="ANALISE"></input>'+
            // '<input type="hidden" name="atividadeAtendimento" value="COBRANCA"></input>'+
            '<input type="hidden" name="bemFormatado" value="'+  item.BEM_FORMATADO +'"></input>'+

            '<p><span style="color: red;">* </span>E-mail proponente: <b>'+item.emailproponente+'</b></p>'+
            '<p id="corretor'+item.NU_BEM+'"><span style="color: red;">* </span>E-mail Corretor: <b>'+item.EMAIL_CORRETOR+'</b></p>'+

            '<div class="form-group">'+
            '<p>Incluir Mensagem : </p>' +
                '<textarea name="observacaoAtendimento" class="form-control" rows="5" required></textarea>'+
            '</div>'+

            '<label>Enviar para: </label>'+
            '<input type="email" class="form-control" name="emailContato" placeholder="email" required><br>'+

            '<div class="form-group">'+
            '<button id="btnToggle'+item.NU_BEM+'" type="button" class="btn btn-primary">Modelo de Cobrança</button><br><br>'+
            
            '<div contenteditable="true" id="toggleModelo'+item.NU_BEM+'" style="display: none;">À <br> '+ item.NOME_PROPONENTE+' ,<br>'+
            'Corretor(a): '+ item.NO_CORRETOR+' <br>'+
            'Setor de Habitação <br><br>'+
            '1. Solicitamos o envio do boleto/pp15 referente ao valor em Recursos próprios do cliente <b>'+ item.NOME_PROPONENTE+'</b>, não recebido até o momento.<br><br>'+

            '2. Aguardamos o envio do mesmo para prosseguimento da contratação referente ao imóvel adjudicado -'+item.BEM_FORMATADO +'. <br><br>'+

            '3. À disposição para esclarecimentos. <br><br>'+

            'Atenciosamente, <br><br>'+

            item.UNA +
            
            
            '</div>'+
            '</div>'+


        '<div class="modal-footer">'+
            '<button type="button" class="btn btn-secondary" data-dismiss="modal">'+'Voltar'+'</button>'+
            '<button type="submit" class="btn btn-primary">'+'Enviar'+'</button>'+
        '</div>'+
        '</form>'

            $('#formContatoPagamento'+item.NU_BEM).html(formCobrancaPagamento)

            $('#btnToggle'+item.NU_BEM).click(function() {
                $('#toggleModelo'+item.NU_BEM).toggle();
            });

            $('#formEnviodeCobrancaAgencia'+item.NU_BEM).submit( function(e) {

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
                            title: 'Email enviado!'
                        });
                        $('#novoHistorico'+ item.NU_BEM).text(strDate)
                    },
                
                    error: function () {
                        
                        $('.modal').modal('hide');

                        Toast.fire({
                            icon: 'error',
                            title: 'Erro: Email não enviado. tente novamente!'
                        });
                    }
                    
                });

            })

        $('#Pagamento'+item.NU_BEM).click(function() {
            $.get( '/estoque-imoveis/consulta-historico-contrato/'+item.BEM_FORMATADO, function(data) {
                console.log(item.BEM_FORMATADO)
                var formPag =
                        '<form method="post" action="/estoque-imoveis/conformidade-contratacao/registrar-historico/' + item.BEM_FORMATADO+ '">' +
                            '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                            '<input type="hidden" name="tipoAtendimento" value="ANALISE"></input>'+
                            '<input type="hidden" name="atividadeAtendimento" value="COBRANCA"></input>'+
                            '<p>Contrato: <b>'+  item.BEM_FORMATADO + '</b></p>' +
    
                            '<p>Última Observação </p>'+
                            '<span id="ultimaObsPag'+ item.NU_BEM+'"></span>'+
    
                            '<div class="form-group">'+
                            '<p>Nova Observação </p>' +
                                '<textarea name="observacaoAtendimento" class="form-control" rows="5" required></textarea>'+
                            '</div>'+
                        '<div class="modal-footer">'+
                            '<button type="button" class="btn btn-secondary" data-dismiss="modal">'+'Voltar'+'</button>'+
                            '<button type="submit" class="btn btn-primary">'+'Gravar'+'</button>'+
                        '</div>'+
                        '</form>'
    
                $('#modalBodyPagamento'+item.NU_BEM).html(formPag)
                
                var Novoresultado = JSON.parse(data)
                $.each(Novoresultado.historico, function(chave, valor) {
                    
                    var analisaTipo = valor.atividade
                    var formataData = valor.data
                    var novaData = formataData.replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1');
                    
                    if (analisaTipo == "COBRANCA"){
                    let toString = valor.observacao.replace(/(<([^>]+)>)/ig,"");
                     var NovoDado = 
                     '<textarea class="form-control" rows="3" disabled>'+ toString +'</textarea>'+
                    '<small class="form-text text-muted">'+ 'incluida em <b>'+novaData+'</b> por <b>'+valor.matriculaResponsavel+'</b>.</small><br>'
                     $('#ultimaObsPag'+ item.NU_BEM).html(NovoDado)
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
                            $('#novoHistorico'+ item.NU_BEM).text(strDate)
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
    $('#tblContratosSemPagamentoSinal').addClass("dataTable");
    _formataData()  
    _formataValores();
    _formataDatatableComData()
    $('.spinnerTbl').remove()
})
