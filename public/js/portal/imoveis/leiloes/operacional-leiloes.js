var unidade = $('#lotacao').text()
var csrfVar = $('meta[name="csrf-token"]').attr('content');
var url     = window.location.href;
var chbsplit     = url.slice(75) 
var numeroLeilao = ""
var prevdadosleiloeiro = ""
var prevdadosdespachante = ""
var cidadecartorio = ""
var url_atual = window.location.href;
var chbformatado = numeroContrato;

$(document).ready(function(){
    $("#custom-tabs-one-leiloes-tab").click();
    var appendbotao =   '<div class="row">' +
                            '<div class="col-sm-6">'+
                                '<button id="botaoEditarDadosContrato" class="btn btn-primary" data-toggle="modal" data-target="#modaldeEdicao" style="margin: 0 30px 0 10px;"><i style="color: white;" class="far fa-edit"></i><span style="color: White;">Editar</span></button>' +
                                '<button id="botaoAlteraStatus" style="display:none;" class="btn btn-primary" data-toggle="modal" data-target="#modalAlteraStatus" style="margin: 0 30px 0 10px;"><span style="color: White;">Averbar</span>&nbsp&nbsp<i style="color: white;" class="fas fa-check"></i></button>&nbsp&nbsp' +
                                '<button type="button" id="botaoReceberDocumentosLeiloeiro" style="display:none;" class="btn btn-primary" data-toggle="modal" data-target="#modalbotaokit">' +
                                    'Receber Documentos Leiloeiro' +
                                '</button>' +
                                '<button type="button" id="botaoEntregarDocumentosDespachante" style="display:none;" class="btn btn-primary" data-toggle="modal" data-target="#modalbotaodespachante">' +
                                    'Entregar Documentos ao Despachante' +
                                '</button>' +
                                '<button type="button" id="botaoReceberProtocoloCartorio" style="display:none;" class="btn btn-primary" data-toggle="modal" data-target="#modalReceberprotocolo">' +
                                    'Receber Protocolo Cartório' +
                                '</button>' +
                                '<button type="button" id="botaoReceberDocumentosdespachante" style="display:none;" class="btn btn-primary" data-toggle="modal" data-target="#modalReceberdespachante">' +
                                    'Receber Documento Despachante' +
                                '</button>' + 
                            '<br><br>' +
                            '</div>'+
                            '<div class="col-sm-3">'+
                            '</div>'+
                        '</div>' +

             //    <!-- form do botão Alterar Status para Averbado -->
             '<div class="modal fade" id="modalAlteraStatus" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">'+
             '<div class="modal-dialog" role="document">'+
                 '<div class="modal-content">'+
                 '<div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">'+
                     '<h5 style="color: white;" class="modal-title" id="staticBackdropLabel">Averbar contrato</h5>'+
                     '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                     '<span aria-hidden="true">&times;</span>'+
                     '</button>'+
                 '</div>'+
                 '<div class="modal-body px-2">'+
                 '<form id="formAlteraStatus">'+
                     '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                     '<input type="hidden" class="form-control" name="_method" value="PUT">' +
                         '<div class="form-group">'+
                             '<div style="display:none;" class="form-check form-check-inline">' +
                                 '<input class="form-check-input" type="radio" name="existeExigencia" id="radioAlteraStatus" value="NAO" checked>' +
                                 '<label class="form-check-label">SIM</label>'+
                             '</div>' +
                             '<div class="form-group">'+
                             '<label>'+'Data de Entrega Averbação'+'</label>'+
                             '<input type="text" name="dataEntregaAverbacaoExigenciaUnidade" class="form-control datepicker" autocomplete="off" placeholder="Selecione no calendário" required>'+
                         '</div>'+
                         '<p>(Preencha estes campos apenas se tiver certeza de que não é possivel preencher o restante das informações)</p>'+
                         '</div>'+
                     '<div class="modal-footer">'+
                         '<button type="button" class="btn btn-secondary" data-dismiss="modal">'+'Fechar'+'</button>'+
                         '<button type="submit" class="btn btn-primary">'+'Salvar'+'</button>'+
                     '</div>'+
                 '</div>'+
                     '</form>'+
             '</div>'+
         '</div>'+
         '</div>'+
                       


                        // modal de edição
                        '<div class="modal fade" id="modaldeEdicao" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">'+
                        '<div class="modal-dialog" role="document">'+
                            '<div class="modal-content">'+
                            '<div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">'+
                                '<h5 style="color: white;" class="modal-title" id="staticBackdropLabel">Editar dados</h5>'+
                                '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                                '<span aria-hidden="true">&times;</span>'+
                                '</button>'+
                            '</div>'+
                            '<form method="POST" action="/estoque-imoveis/leiloes-negativos/tratar/editar-dados-contrato/'+chbformatado+'">'+
                                '<div class="modal-body">'+
                                    '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                                    '<input type="hidden" class="form-control" name="_method" value="PUT">' +
                                    '<div class="form-group">'+
                                        '<label>Nº Leilão</label>'+
                                        '<input type="text" id="inputNumeroLeilao" name="numeroLeilao" class="form-control" autocomplete="off" placeholder="'+numeroLeilao+'">'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label>Previsão de Recebimento do Leiloeiro</label>'+
                                        '<input type="text" id="inputprevisaoRecebimentoDocumentosLeiloeiro" name="previsaoRecebimentoDocumentosLeiloeiro" class="form-control datepicker" autocomplete="off" placeholder="'+prevdadosleiloeiro+'">'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label>Previsão Entrega Docs Despachante</label>'+
                                        '<input type="text" id="inputprevisaoDisponibilizacaoDocumentosAoDespachante" name="previsaoDisponibilizacaoDocumentosAoDespachante" class="form-control datepicker" autocomplete="off" placeholder="'+prevdadosdespachante+'">'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label>Cidade Comarca Cartório</label>'+
                                        '<input type="text" id="inputcidadeComarcaCartorio" name="cidadeComarcaCartorio" class="form-control" autocomplete="off" placeholder="'+cidadecartorio+'">'+
                                    '</div>'+
                                    // '<div class="form-group">'+
                                    //     '<label>Código de Rastreamento do Correio:</label>'+
                                    //     '<input type="text" id="inputCodigoCorreio" name="codigoCorreio" class="form-control" autocomplete="off">'+
                                    // '</div>'+
                                    '<p>'+'Deseja vincular essas informações a <b>TODOS</b> os contratos deste leilão (exceto: Cidade Comarca)?'+'</p>'+
                                    '<div class="form-check form-check-inline">' +
                                        '<input type="radio" class="form-check-input" onclick="javascript:Check();" name="sensibilizarTodosContratosLeilao" id="CheckN" value="NAO">'+
                                        '<label class="form-check-label" for="exigenciaCartorariaNao">Não</label>' +
                                    '</div>'+
                                    '<div class="form-check form-check-inline">' +
                                        '<input type="radio" class="form-check-input" onclick="javascript:Check();" name="sensibilizarTodosContratosLeilao" id="CheckS" value="SIM">'+
                                        '<label class="form-check-label" for="exigenciaCartorariaNao">Sim</label>' + 
                                    '</div>'+
                                    '<div id="visibilidades" style="visibility:hidden">'+
                                        '<div class="alert alert-warning">'+
                                            '<div class="close" data-dismiss="alert" aria-label="close">'+'</div>'+
                                                '<i class="fas fa-exclamation-triangle"></i>'+' ATENÇÃO: '+
                                                '<p>'+'Esta ação ira afetar <b>TODOS</b> os contratos deste leilão.'+'<br>'+
                                                'clique em salvar se tiver certeza desta ação.'+'</p>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="modal-footer">'+
                                        '<button type="button" class="btn btn-secondary" data-dismiss="modal">'+'Fechar'+'</button>'+
                                        '<button type="submit" class="btn btn-primary">'+'Salvar'+'</button>'+
                                    '</div>'+
                                '</div>'+
                            '</form>'+
                        '</div>'+
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
                                       '<label>Selecione o Leiloeiro</label>'+'<span style="color: red;">'+'*'+'</span>'+
                                       '<select class="custom-select" name="idLeiloeiro" id="inputGroupSelect01">'+
                                           '<option value="disabled" disabled selected hidden>Selecione um leiloeiro</option>'+
                                       '</select>'+
                                   '<a href="/fornecedores/controle-leiloeiros">'+'<small class="form-text">'+'Se não encontrar. clique aqui para cadastrar.'+'</small>'+'</a>'+
                                   '</div>'+
                                   '<div class="form-group">'+'<span style="color: red;">'+'*'+'</span>'+
                                       '<label>'+'Data de Ateste do Recebimento'+'</label>'+
                                       '<input type="text" name="dataEntregaDocumentosLeiloeiro" id="datepicker" class="form-control datepicker" autocomplete="off" placeholder="Selecione no calendário" required>'+
                                   '</div>'+
                               '<div class="modal-footer">'+
                                   '<button type="button" class="btn btn-secondary" data-dismiss="modal">'+'Fechar'+'</button>'+
                                   '<button type="submit" class="btn btn-primary">'+'Salvar'+'</button>'+
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
                                '<label>Selecione o Despachante</label>'+'<span style="color: red;">'+'*'+'</span>'+
                                '<select class="custom-select" name="idDespachante"id="inputGroupSelect02">'+
                                    '<option value="disabled" disabled selected hidden>Selecione um despachante</option>'+
                                '</select>'+
                            '<a href="/fornecedores/controle-despachantes">'+'<small class="form-text">'+'Se não encontrar. clique aqui para cadastrar.'+'</small>'+'</a>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label>'+'Data da Entrega'+'</label>'+'<span style="color: red;">'+'*'+'</span>'+
                                '<input type="text" name="dataRetiradaDocumentosDespachante" class="form-control datepicker" autocomplete="off" placeholder="Selecione no calendário" required>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label>'+'Nº da O.S'+'</label>'+'<span style="color: red;">'+'*'+'</span>'+
                                '<input type="text" name="numeroOficioUnidade" class="form-control oficio" required>'+
                            '</div>'+'<br>'+
                            '<p>'+'Deseja vincular a este despachante <b>TODOS</b> os contratos deste leilão ?'+'</p>'+

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
                            '<button type="button" class="btn btn-secondary" data-dismiss="modal">'+'Fechar'+'</button>'+
                            '<button type="submit" class="btn btn-primary">'+'Salvar'+'</button>'+
                        '</div>'+
                    '</div>'+
                        '</form>'+
                '</div>'+
            '</div>'+
        '</div>'+
        //    <!-- form do botão receber protocolo-->
            '<div class="modal fade" id="modalReceberprotocolo" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">'+
            '<div class="modal-dialog" role="document">'+
                '<div class="modal-content">'+
                '<div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">'+
                    '<h5 style="color: white;" class="modal-title" id="staticBackdropLabel">Receber protocolo</h5>'+
                    '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                    '<span aria-hidden="true">&times;</span>'+
                    '</button>'+
                '</div>'+
                '<div class="modal-body px-2">'+
                '<form method="POST" action="/estoque-imoveis/leiloes-negativos/tratar/receber-protocolo-cartorio/'+chbformatado+'">'+
                    '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                    '<input type="hidden" class="form-control" name="_method" value="PUT">' +
                        
                        '<div class="form-group">'+
                            '<p style="color: red;">Campos obrigatórios (*)</p>'+
                            '<label>'+'Nº Protocolo do cartório'+'</label>'+'<span style="color: red;">'+'*'+'</span>'+
                            '<input type="text" name="numeroProtocoloCartorio" id="inputNumeroProtocoloCartorio" class="form-control" required>'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<label>'+'Senha Protocolo'+'</label>'+'<span style="color: red;">'+'*'+'</span>'+
                            '<input type="text" name="codigoAcessoProtocoloCartorio" id="inputCodigoAcessoProtocoloCartorio" class="form-control" required>'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<label>'+'Data Prevista de Análise do Cartório'+'</label>'+'<span style="color: red;">'+'*'+'</span>'+
                            '<input type="text" name="dataPrevistaAnaliseCartorio" id="inputDataPrevistaAnaliseCartorio" class="form-control datepicker" autocomplete="off" placeholder="Selecione no calendário" required>'+
                        '</div>'+
                    '<div class="modal-footer">'+
                        '<button type="button" class="btn btn-secondary" data-dismiss="modal">'+'Fechar'+'</button>'+
                        '<button type="submit" class="btn btn-primary">'+'Salvar'+'</button>'+
                    '</div>'+
                '</div>'+
                    '</form>'+
            '</div>'+
        '</div>'+
    '</div>'+

        //    <!-- form do botão receber despachante -->
            '<div class="modal fade" id="modalReceberdespachante" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">'+
            '<div class="modal-dialog" role="document">'+
                '<div class="modal-content">'+
                '<div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">'+
                    '<h5 style="color: white;" class="modal-title" id="staticBackdropLabel">Receber documentos</h5>'+
                    '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                    '<span aria-hidden="true">&times;</span>'+
                    '</button>'+
                '</div>'+
                '<div class="modal-body px-2">'+
                '<form method="POST" action="/estoque-imoveis/leiloes-negativos/tratar/receber-documentos-despachante/'+chbformatado+'">'+
                    '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                    '<input type="hidden" class="form-control" name="_method" value="PUT">' +
                        '<div class="form-group">'+
                            '<label>'+'Data da Retirada no Cartório'+'</label>'+
                            '<input type="text" name="dataRetiradaDocumentoCartorio" class="form-control datepicker" autocomplete="off" placeholder="Selecione no calendário">'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<label>'+'Data de Entrega Averbação'+'</label>'+
                            '<input type="text" name="dataEntregaAverbacaoExigenciaUnidade" class="form-control datepicker" autocomplete="off" placeholder="Selecione no calendário">'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<label>Exigência Cartorária: </label><br>'+
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
                        '<button type="button" class="btn btn-secondary" data-dismiss="modal">'+'Fechar'+'</button>'+
                        '<button type="submit" class="btn btn-primary">'+'Salvar'+'</button>'+
                    '</div>'+
                '</div>'+
                    '</form>'+
            '</div>'+
        '</div>'+

                //    <!-- form do botão receber despachante -->
            '<div class="modal fade" id="modalReceberdespachante" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">'+
            '<div class="modal-dialog" role="document">'+
                '<div class="modal-content">'+
                '<div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">'+
                    '<h5 style="color: white;" class="modal-title" id="staticBackdropLabel">Receber documentos</h5>'+
                    '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                    '<span aria-hidden="true">&times;</span>'+
                    '</button>'+
                '</div>'+
                '<div class="modal-body px-2">'+
                '<form method="POST" action="/estoque-imoveis/leiloes-negativos/tratar/receber-documentos-despachante/'+chbformatado+'">'+
                    '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                    '<input type="hidden" class="form-control" name="_method" value="PUT">' +
                        '<div class="form-group">'+
                            '<label>'+'Data da Retirada no Cartório'+'</label>'+
                            '<input type="text" name="dataRetiradaDocumentoCartorio" class="form-control datepicker" autocomplete="off" placeholder="Selecione no calendário">'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<label>'+'Data de Entrega Averbação'+'</label>'+
                            '<input type="text" name="dataEntregaAverbacaoExigenciaUnidade" class="form-control datepicker" autocomplete="off" placeholder="Selecione no calendário">'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<label>Exigência Cartorária: </label><br>'+
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
                        '<button type="button" class="btn btn-secondary" data-dismiss="modal">'+'Fechar'+'</button>'+
                        '<button type="submit" class="btn btn-primary">'+'Salvar'+'</button>'+
                    '</div>'+
                '</div>'+
                    '</form>'+
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
        var PeganumeroLeilao = window.document.getElementById('numeroLeilao').innerText
        var inputNumeroLeilao = window.document.getElementById('inputNumeroLeilao')
        inputNumeroLeilao.value = PeganumeroLeilao
        let PegaprevisaoRecDocLeiloeiroFormatado = new FormataDataClass()
        var PegaprevisaoRecDocLeiloeiro = window.document.getElementById('previsaoRecebimentoDocumentosLeiloeiro').innerText
        var inputprevisaoRecebimentoDocumentosLeiloeiro = window.document.getElementById('inputprevisaoRecebimentoDocumentosLeiloeiro')
        inputprevisaoRecebimentoDocumentosLeiloeiro.value = PegaprevisaoRecDocLeiloeiroFormatado.textoParaData(PegaprevisaoRecDocLeiloeiro).toLocaleString('pt-BR').substring(0, 10)
        let PegaprevisaoDocDespachanteFormatado = new FormataDataClass()
        var PegaprevisaoDocDespachante = window.document.getElementById('previsaoDisponibilizacaoDocumentosAoDespachante').innerText
        var inputprevisaoDisponibilizacaoDocumentosAoDespachante = window.document.getElementById('inputprevisaoDisponibilizacaoDocumentosAoDespachante')
        inputprevisaoDisponibilizacaoDocumentosAoDespachante.value = PegaprevisaoDocDespachanteFormatado.textoParaData(PegaprevisaoDocDespachante).toLocaleString('pt-BR').substring(0, 10)
        var PegacidadeComarcaCartorio = window.document.getElementById('cidadeComarcaCartorio').innerText
        var inputcidadeComarcaCartorio = window.document.getElementById('inputcidadeComarcaCartorio')
        inputcidadeComarcaCartorio.value = PegacidadeComarcaCartorio
        // var pegaCodigoCorreio = window.document.getElementById('codigoCorreio').innerText
        var inputcidadeComarcaCartorio = window.document.getElementById('inputCodigoCorreio')
        // inputcidadeComarcaCartorio.value = pegaCodigoCorreio

        // $('#statusAverbacao').text('AVERBACAO CONCLUIDA')
        switch ($('#statusAverbacao').text()) {
            case 'AGUARDA DOC LEILOEIRO':
                $('#botaoReceberDocumentosLeiloeiro').show()
                $('#botaoEntregarDocumentosDespachante').remove()
                $('#botaoReceberProtocoloCartorio').remove()
                $('#botaoReceberDocumentosdespachante').remove()
                break;
            case 'RECEBIDO DOC LEILOEIRO':
            case 'AGUARDA DOC GILIESP':
                $('#botaoReceberDocumentosLeiloeiro').remove()
                $('#botaoEntregarDocumentosDespachante').show()
                $('#botaoReceberProtocoloCartorio').remove()
                $('#botaoReceberDocumentosdespachante').remove()
                break;
            case 'ENTREGUE DOC DESPACHANTE':
                $('#botaoReceberDocumentosLeiloeiro').remove()
                $('#botaoEntregarDocumentosDespachante').remove()
                $('#botaoReceberProtocoloCartorio').show()
                $('#botaoReceberDocumentosdespachante').remove()
                break;
            case 'AGUARDA PRAZO CRI':
                $('#botaoReceberDocumentosLeiloeiro').remove()
                $('#botaoEntregarDocumentosDespachante').remove()
                $('#botaoReceberProtocoloCartorio').remove()
                $('#botaoReceberDocumentosdespachante').show()
                break;
            case 'AVERBACAO CONCLUIDA':
                $('#botaoReceberDocumentosLeiloeiro').remove()
                $('#botaoEntregarDocumentosDespachante').remove()
                $('#botaoReceberProtocoloCartorio').remove()
                $('#botaoReceberDocumentosdespachante').remove()
                $('#botaoEditarDadosContrato').remove()
                $('#botaoAlteraStatus').remove()
                break;
        }
            var verificaLeiloeiro = $('#nomeEmpresaAssessoraLeiloeiro').text()
            var verificaDespachante = $('#nomeDespachante').text()

    if (verificaLeiloeiro != "" && verificaDespachante != "" ){
        $('#botaoAlteraStatus').show()
    }
    $("#formAlteraStatus").submit(function (event) {
        event.preventDefault()
        var agoraVai = $(this).serialize()
            Swal.fire({
                title: 'AVISO',
                text: "Alguns campos ficarão sem preenchimento, não será possivel preencher após a confirmação",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: "Cancelar",
                confirmButtonText: 'Concordo'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '/estoque-imoveis/leiloes-negativos/tratar/receber-documentos-despachante/'+chbformatado,
                        type: "post",
                        data: agoraVai,
                        dataType: 'json',
                        success: function (response) {
                            Swal.fire(
                                'Alterado!',
                                'Averbação concluída.',
                                'success'
                            )
                        } 
                    }).done(
                        location.reload()
                    ) 
                }
            })
        })

    }, 1500)
})
// função que pergunta se o usuario tem certeza de sensibilizar todos os leilões
function SIMnoCheck() {
    if (document.getElementById('CheckSim').checked) {
        document.getElementById('visibilidade').style.visibility = 'visible';
    } else {
        document.getElementById('visibilidade').style.visibility = 'hidden';
    }
}
function Check() {
    if (document.getElementById('CheckS').checked) {
        document.getElementById('visibilidades').style.visibility = 'visible';
    } else {
        document.getElementById('visibilidades').style.visibility = 'hidden';
    }
}

    var botaoCadastrarCodigo = `
    <button type="button" style="color: #white; font-size: 13pt; padding: 0; margin: 0;" class="btn btn-primary" data-toggle="modal" data-target="#cadastraCodigoCorreio">&nbsp Cadastrar &nbsp</button>
    
    <div class="modal fade" id="cadastraCodigoCorreio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Título do modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               
            <form action="/estoque-imoveis/leiloes-negativos/novo-codigo-correio" method="POST">
            <input type="hidden" name="_token" value="${csrfVar}">
                <input type="hidden" class="form-control" name="contratoFormatado" value="${chbsplit}">
                <div class="form-group">
                    <label>Código de Rastreamento Correio</label>
                    <input type="text" maxlength="13" class="form-control" name="codigoDoCorreio" required>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
            </form>
            </div>
            </div>
        </div>
    </div>`
    $(botaoCadastrarCodigo).appendTo('#botaocadastrar')



