var unidade = $('#lotacao').text()
var csrfVar = $('meta[name="csrf-token"]').attr('content');

var url_atual = window.location.href;
var chbformatado = url_atual.substr(75);
$(document).ready(function(){

    var appendbotao = '<div class="row">'+ 
                            '<div class="col-sm-4">'+
                        '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalbotaokit">'+
                            'Receber documentos Leiloeiro'+
                        '</button>'+
                            '</div>'+
                            '<div class="col-sm-4">'+
                        '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalbotaodespachante">'+
                            'Entregar ao despachante'+
                        '</button>'+
                        '</div>'+
                        '<div class="col-sm-4">'+
                        '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalReceberdespachante">'+
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
                           '<form method="PUT" action="/estoque-imoveis/leiloes-negativos/tratar/receber-documentos-leiloeiro/'+chbformatado+'">'+
                                '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                                '<input type="hidden" class="form-control" name="_method" value="PUT">' +
                                    '<div class="form-group">'+
                                       '<label>Selecione o leiloeiro</label>'+
                                       '<select class="custom-select" name="idLeiloeiro" id="inputGroupSelect01">'+
                                           '<option value="disabled" disabled selected hidden>Selecione um leiloeiro</option>'+
                                       '</select>'+
                                   '<a href="https://portal.gilie.des.sp.caixa/fornecedores/controle-leiloeiros">'+'<small class="form-text">'+'Se não encontrar. clique aqui para cadastrar.'+'</small>'+'</a>'+
                                   '</div>'+
                                   '<div class="form-group">'+
                                       '<label>'+'Data de ateste do recebimento'+'</label>'+
                                       '<input type="date" name="previsaoRecebimentoDocumentosLeiloeiro" id="datepicker" class="form-control" placeholder="Selecione no calendário" required>'+
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
                    '<form method="PUT" action="/estoque-imoveis/leiloes-negativos/tratar/entregar-documentos-despachante/'+chbformatado+'">'+
                        '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                        '<input type="hidden" class="form-control" name="_method" value="PUT">' +
                            '<div class="form-group">'+
                                '<label class="input-group-text">'+'Selecione o despachante'+'</label>'+
                                '<select class="custom-select" name="idDespachante"id="inputGroupSelect02">'+
                                    '<option value="disabled" disabled selected hidden>Selecione um despachante</option>'+
                                '</select>'+
                            '<a href="https://portal.gilie.des.sp.caixa/fornecedores/controle-despachantes">'+'<small class="form-text">'+'Se não encontrar. clique aqui para cadastrar.'+'</small>'+'</a>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label>'+'Data da entrega'+'</label>'+
                                '<input type="date" name="dataRetiradaDocumentosDespachante" class="form-control" placeholder="Selecione no calendário" required>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label>'+'Nº da O.S'+'</label>'+
                                '<input type="text" name="numeroOficioUnidade" class="form-control" required>'+
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
            '<form method="PUT" action="/estoque-imoveis/leiloes-negativos/tratar/receber-documentos-despachante/'+chbformatado+'">'+
                 '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                 '<input type="hidden" class="form-control" name="_method" value="PUT">' +
                     
                    '<div class="form-group">'+
                        '<label>'+'Nº Protocolo do cartório'+'</label>'+
                        '<input type="text" name="numeroProtocoloCartorio" class="form-control">'+
                    '</div>'+
                    '<div class="form-group">'+
                        '<label>'+'Senha protocolo'+'</label>'+
                        '<input type="date" name="codigoAcessoProtocoloCartorio" class="form-control">'+
                    '</div>'+
                    '<div class="form-group">'+
                        '<label>'+'Data prevista do cartório'+'</label>'+
                        '<input type="date" name="dataPrevistaAnaliseCartorio"class="form-control" placeholder="Selecione no calendário">'+
                    '</div>'+
                    '<div class="form-group">'+
                        '<label>'+'Data da retirada no cartório'+'</label>'+
                        '<input type="date" name="dataRetiradaDocumentoCartorio" class="form-control" placeholder="Selecione no calendário">'+
                    '</div>'+
                    '<div class="form-group">'+
                        '<label>'+'Data de entrega averbação'+'</label>'+
                        '<input type="date" name="previsaoRecebimentoDocumentosLeiloeiro"class="form-control" placeholder="Selecione no calendário">'+
                    '</div>'+
                     '<div class="form-group">'+
                        '<label>'+'Exigência cartorária'+'</label>'+
                        '<textarea style="height: 150px" type="text" name="previsaoRecebimentoDocumentosLeiloeiro"  class="form-control">'+'</textarea>'+
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

    
/***************************************************\
| Torna required campo do form de acordo com select |
\***************************************************/

    $('#statusLeiloesNegativos').change(function () {
        $('#dataRetiradaDespachante').val('');
        if ($(this).val() === 'rede') {
            
        }
    })
})
