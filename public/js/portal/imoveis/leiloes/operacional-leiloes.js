var unidade = $('#lotacao').text()
var csrfVar = $('meta[name="csrf-token"]').attr('content');

var url_atual = window.location.href;
var chbformatado = numeroContrato;
$(document).ready(function(){
    $("#custom-tabs-one-leiloes-tab").click();

    var appendbotao = '<div class="row">'+ 
                            '<div id="botaoKIT" class="col-sm-4">'+
                        '<button type="button" id="botaoReceberDocumentosLeiloeiro" class="btn btn-primary" data-toggle="modal" data-target="#modalbotaokit">'+
                            'Receber documentos Leiloeiro'+
                        '</button>'+
                            '</div>'+
                            '<div class="col-sm-4">'+
                        '<button type="button" id="botaoEntregarDocumentosDespachante" class="btn btn-primary" data-toggle="modal" data-target="#modalbotaodespachante">'+
                            'Entregar ao despachante'+
                        '</button>'+
                        '</div>'+
                        '<div class="col-sm-4">'+
                        '<button type="button" id="botaoReceberDocumentosDespachante" class="btn btn-primary" data-toggle="modal" data-target="#modalReceberdespachante">'+
                            'Receber documento do despachante'+
                        '</button>'+
                        '</div>'+
                       '</div>'+
                       
//                     //    <!-- form do botão receber documentos leiloeiro -->
                       '<div class="modal fade" id="modalbotaokit" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">'+
                       '<div class="modal-dialog" role="document">'+
                           '<div class="modal-content">'+
                           '<div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">'+
                               '<h5 style="color: white;" class="modal-title" id="staticBackdropLabel">Receber documentos</h5>'+
                               '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                               '<span aria-hidden="true">&times;</span>'+
                               '</button>'+
                           '</div>'+
                           '<div class="modal-body">'+
                           '<form method="POST" action="/estoque-imoveis/leiloes-negativos/tratar/receber-documentos-leiloeiro/'+chbformatado+'">'+
                                '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                                '<input type="hidden" class="form-control" name="_method" value="PUT">' +
                                    '<div class="form-group">'+
                                        '<p style="color: red;">Campos obrigatórios (*)</p>'+
                                       '<label>Selecione o leiloeiro</label>'+'<span style="color: red;">'+'*'+'</span>'+
                                       '<select class="custom-select" name="idLeiloeiro" id="inputGroupSelect01">'+
                                           '<option value="disabled" disabled selected hidden>Selecione um leiloeiro</option>'+
                                       '</select>'+
                                   '<a href="https://portal.gilie.des.sp.caixa/fornecedores/controle-leiloeiros">'+'<small class="form-text">'+'Se não encontrar. clique aqui para cadastrar.'+'</small>'+'</a>'+
                                   '</div>'+
                                   '<div class="form-group">'+'<span style="color: red;">'+'*'+'</span>'+
                                       '<label>'+'Data de ateste do recebimento'+'</label>'+
                                       '<input type="date" name="previsaoRecebimentoDocumentosLeiloeiro" id="datepicker" class="form-control datepicker" placeholder="Selecione no calendário" required>'+
                                   '</div>'+
                               '<div class="modal-footer">'+
                                   '<button type="button" class="btn btn-secondary" data-dismiss="modal">'+'fechar'+'</button>'+
                                   '<button type="submit" class="btn btn-primary">'+'salvar'+'</button>'+
                               '</div>'+
                           '</div>'+
                               '</form>'+
                       '</div>'+
                   '</div>'+
               '</div>'+
//                 //    <!-- form do botão entregar documentos despachante -->
                '<div class="modal fade" id="modalbotaodespachante" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">'+
                '<div class="modal-dialog" role="document">'+
                    '<div class="modal-content">'+
                    '<div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">'+
                        '<h5 style="color: white;" class="modal-title" id="staticBackdropLabel">Receber documentos</h5>'+
                        '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                        '<span aria-hidden="true">&times;</span>'+
                        '</button>'+
                    '</div>'+
                    '<div class="modal-body">'+
                    '<form method="POST" action="/estoque-imoveis/leiloes-negativos/tratar/entregar-documentos-despachante/'+chbformatado+'">'+
                        '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                        '<input type="hidden" class="form-control" name="_method" value="PUT">' +
                            '<div class="form-group">'+
                            '<p style="color: red;">Campos obrigatórios (*)</p>'+
                                '<label>Selecione o despachante</label>'+'<span style="color: red;">'+'*'+'</span>'+
                                '<select class="custom-select" name="idDespachante"id="inputGroupSelect02">'+
                                    '<option value="disabled" disabled selected hidden>Selecione um despachante</option>'+
                                '</select>'+
                            '<a href="https://portal.gilie.des.sp.caixa/fornecedores/controle-despachantes">'+'<small class="form-text">'+'Se não encontrar. clique aqui para cadastrar.'+'</small>'+'</a>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label>'+'Data da entrega'+'</label>'+'<span style="color: red;">'+'*'+'</span>'+
                                '<input type="date" name="dataRetiradaDocumentosDespachante" class="form-control datepicker" placeholder="Selecione no calendário" required>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label>'+'Nº da O.S'+'</label>'+'<span style="color: red;">'+'*'+'</span>'+
                                '<input type="text" name="numeroOficioUnidade" class="form-control oficio" required>'+
                            '</div>'+'<br>'+
                            '<p>'+'Deseja vincular a este depachante <b>TODOS</b> os contratos deste leilão ?'+'</p>'+

                            '<div class="form-check form-check-inline">' +
                                '<input type="radio" class="form-check-input" onclick="javascript:SIMnoCheck();" name="sensibilizarTodosContratosLeilao" id="CheckNao" value="NAO">'+
                                '<label class="form-check-label" for="exigenciaCartorariaNao">Não</label>' +
                            '</div>'+
                            '<div class="form-check form-check-inline">' +
                                '<input type="radio" class="form-check-input" onclick="javascript:SIMnoCheck();" name="sensibilizarTodosContratosLeilao" id="CheckSim" value="SIM">'+
                                '<label class="form-check-label" for="exigenciaCartorariaNao">Sim</label>' + 
                            '</div>'+
                            '<div id="visibilidade" style="visibility:hidden">'+
                            '<div class="alert alert-warning">'+
                                '<div class="close" data-dismiss="alert" aria-label="close">'+'</div>'+
                                    '<i class="fas fa-exclamation-triangle"></i>'+' ATENÇÃO: '+
                                    '<p>'+'Esta ação ira afetar <b>TODOS</b> os contratos deste leilão.'+'<br>'+
                                        'clique em salvar se tiver certeza desta ação.'+'</p>'+
                                '</div>'+
                            '</div>'+
                            '<div class="modal-footer">'+
                            '<button type="button" class="btn btn-secondary" data-dismiss="modal">'+'fechar'+'</button>'+
                            '<button type="submit" class="btn btn-primary">'+'salvar'+'</button>'+
                        '</div>'+
                    '</div>'+
                        '</form>'+
                '</div>'+
            '</div>'+
        '</div>'+
        //                     //    <!-- form do botão receber documentos leiloeiro -->
        '<div class="modal fade" id="modalReceberdespachante" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">'+
        '<div class="modal-dialog" role="document">'+
            '<div class="modal-content">'+
            '<div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">'+
                '<h5 style="color: white;" class="modal-title" id="staticBackdropLabel">Receber documentos</h5>'+
                '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                '<span aria-hidden="true">&times;</span>'+
                '</button>'+
            '</div>'+
            '<div class="modal-body px-0">'+
            '<div style="overflow-y: hidden; height: calc(100vh - 15rem);">'+
            '<div class="px-2" style="overflow-y: auto; height: 100%;">'+
            '<form method="POST" action="/estoque-imoveis/leiloes-negativos/tratar/receber-documentos-despachante/'+chbformatado+'">'+
                 '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                 '<input type="hidden" class="form-control" name="_method" value="PUT">' +
                     
                    '<div class="form-group">'+
                         '<p style="color: red;">Campos obrigatórios (*)</p>'+
                        '<label>'+'Nº Protocolo do cartório'+'</label>'+'<span style="color: red;">'+'*'+'</span>'+
                        '<input type="text" name="numeroProtocoloCartorio" id="inputNumeroProtocoloCartorio" class="form-control" required>'+
                    '</div>'+
                    '<div class="form-group">'+
                        '<label>'+'Senha protocolo'+'</label>'+'<span style="color: red;">'+'*'+'</span>'+
                        '<input type="text" name="codigoAcessoProtocoloCartorio" id="inputCodigoAcessoProtocoloCartorio" class="form-control" required>'+
                    '</div>'+
                    '<div class="form-group">'+
                        '<label>'+'Data prevista do cartório'+'</label>'+'<span style="color: red;">'+'*'+'</span>'+
                        '<input type="date" name="dataPrevistaAnaliseCartorio" id="inputDataPrevistaAnaliseCartorio" class="form-control datepicker" placeholder="Selecione no calendário" required>'+
                    '</div>'+
                    '<div class="form-group">'+
                        '<label>'+'Data da retirada no cartório'+'</label>'+
                        '<input type="date" name="dataRetiradaDocumentoCartorio" class="form-control datepicker" placeholder="Selecione no calendário">'+
                    '</div>'+
                    '<div class="form-group">'+
                        '<label>'+'Data de entrega averbação'+'</label>'+
                        '<input type="date" name="dataEntregaAverbacaoExigenciaUnidade" class="form-control datepicker" placeholder="Selecione no calendário">'+
                    '</div>'+
                    '<div class="form-group">'+
                        '<label>Exigência cartorária: </label><br>'+
                        '<div class="form-check form-check-inline">' +
                            '<input class="form-check-input" type="radio" name="existeExigencia" id="exigenciaCartorariaSim" value="SIM">' +
                            '<label class="form-check-label" for="exigenciaCartorariaSim">Sim</label>' +
                        '</div>' +
                        '<div class="form-check form-check-inline">' +
                            '<input class="form-check-input" type="radio" name="existeExigencia" id="exigenciaCartorariaNao" value="NAO">' +
                            '<label class="form-check-label" for="exigenciaCartorariaNao">Não</label>' +
                        '</div>' +
                    '</div>'+
                     '<div class="form-group">'+
                        '<label>Observação</label>'+
                        '<textarea style="height: 150px" type="text" name="observacao"  class="form-control">'+'</textarea>'+
                    '</div>'+

                '<div class="modal-footer">'+
                    '<button type="button" class="btn btn-secondary" data-dismiss="modal">'+'fechar'+'</button>'+
                    '<button type="submit" class="btn btn-primary">'+'salvar'+'</button>'+
                '</div>'+
            '</div>'+
                '</form>'+
        '</div>'+
    '</div>'+
'</div>'

    $(appendbotao).appendTo("#LeilaoNegativo")
   
    $('.datepicker').datepicker({});
    
    $(".oficio").mask("0000.000.0000.000");
        
    /***************************************************\
    | Torna required campo do form de acordo com select |
    \***************************************************/

    $('#statusLeiloesNegativos').change(function () {
        $('#dataRetiradaDespachante').val('');
        if ($(this).val() === 'rede') {
            
        }
    })

    setTimeout(function() {
        var divNumeroProtocoloCartorio = window.document.getElementById('numeroProtocoloCartorio').innerText
        var inputNumeroProtocoloCartorio = window.document.getElementById('inputNumeroProtocoloCartorio')
        inputNumeroProtocoloCartorio.value = divNumeroProtocoloCartorio
        var divCodigoAcessoProtocoloCartorio = window.document.getElementById('codigoAcessoProtocoloCartorio').innerText
        var inputCodigoAcessoProtocoloCartorio = window.document.getElementById('inputCodigoAcessoProtocoloCartorio')
        inputCodigoAcessoProtocoloCartorio.value = divCodigoAcessoProtocoloCartorio
        // var divDataPrevistaAnaliseCartorio = window.document.getElementById('dataPrevistaAnaliseCartorio').innerText
        // var inputDataPrevistaAnaliseCartorio = window.document.getElementById('inputDataPrevistaAnaliseCartorio')
        // inputDataPrevistaAnaliseCartorio.value = divDataPrevistaAnaliseCartorio

        // $('#statusAverbacao').text("AGUARDA DOC GILIESP")
        switch ($('#statusAverbacao').text()) {
            case 'AGUARDA DOC LEILOEIRO':
            case 'CADASTRADO':
                $('#botaoEntregarDocumentosDespachante').remove()
                $('#botaoReceberDocumentosDespachante').remove()
                break;
            case 'RECEBIDO DOC LEILOEIRO':
                $('#botaoReceberDocumentosLeiloeiro').remove()
                $('#botaoReceberDocumentosDespachante').remove()
                break;
            case 'ENTREGUE DOC DESPACHANTE':
            case 'AGUARDA PRAZO CRI':
            case 'AGUARDA DOC GILIESP':
                $('#botaoReceberDocumentosLeiloeiro').remove()
                $('#botaoEntregarDocumentosDespachante').remove()
                break;
            case 'AVERBACAO CONCLUIDA':
                $('#botaoReceberDocumentosLeiloeiro').remove()
                $('#botaoEntregarDocumentosDespachante').remove()
                $('#botaoReceberDocumentosDespachante').remove()
                break;
        }
    }, 1500);

})

// função que pergunta se o usuario tem certeza de sensibilizar todos os leilões
function SIMnoCheck() {
    if (document.getElementById('CheckSim').checked) {
        document.getElementById('visibilidade').style.visibility = 'visible';
    }
    else document.getElementById('visibilidade').style.visibility = 'hidden';

}