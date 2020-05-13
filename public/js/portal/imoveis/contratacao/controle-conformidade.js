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
                    '<div class="col-6">'+
                        '<button id="btnLinkServidor" onclick="copyToClipboard(' + elementoLinkServidor + ')" class="btn btn-outline-primary ml-2" data-toggle="tooltip" data-placement="top" title="Copiar link"><i class="far fa-copy"></i></button>' +
                        '<a href="file://///sp7257sr001/PUBLIC/EstoqueImoveis/' + item.contratoFormatado + '" id="linkServidor' + item.numeroContrato + '" hidden>\\\\sp7257sr001\\PUBLIC\\EstoqueImoveis\\'+ item.contratoFormatado +'</a>' +
                    '</div>' +
                    
                    '<div class="col-6">'+
                    '<button id="'+item.numeroContrato+'" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalOBS'+ item.numeroContrato+'"><i class="fas fa-info-circle"></i>'+'</button>'+
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

                '</td>' +
            '</tr>';

            if (item.cardAgrupamento == "Agência") {
                $(linha).appendTo('#tblCardAgrupamentoAgencia>tbody');
            } else if (item.fluxoContratacao == "AG") {
                $(linha).appendTo('#tblConformidadeFluxoAgencia>tbody');
            } else {
                $(linha).appendTo('#tblConformidadeFluxoCca>tbody');
            }
            


        $('#'+item.numeroContrato).click(function() {
        $.get( '/estoque-imoveis/consulta-historico-contrato/'+item.contratoFormatado, function(data) {
           
            var form =
                    '<form method="post" action="/estoque-imoveis/conformidade-contratacao/registrar-historico/' + item.contratoFormatado+ '">' +
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

            var resultado = JSON.parse(data)
            $.each(resultado.historico, function(chave, valor) {
                var analisaTipo = valor.atividade
                var formataData = valor.data
                var novaData = formataData.replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1');
                
                if (analisaTipo == "CONFORMIDADE"){
                 var data = 
                 '<textarea class="form-control" rows="3" disabled>'+ valor.observacao +'</textarea>'+
                '<small class="form-text text-muted">'+ 'incluida em <b>'+novaData+'</b> por <b>'+valor.matriculaResponsavel+'</b>.</small><br>'
                 $('#ultimaOBS'+ item.numeroContrato).html(data)
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

        });
    })).done(function() { 
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
               console.log(item.bemFormatado)
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