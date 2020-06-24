var csrfVar = $('meta[name="csrf-token"]').attr('content');
$.fn.dataTable.ext.errMode = 'none';

$(document).ready(function(){  
    $.getJSON('/atende/listar-demandas-agencia', function(dados){
        $.each(dados, function(key, item) {
            var linha =
                '<tr>' +
                    '<td>' + item.idAtende + '</td>' +
                    '<td><a href="/consulta-bem-imovel/'+ item.contratoFormatado +'" class="cursor-pointer">' + item.numeroContrato + '</a></td>' +
                    '<td class="formata-data-sem-hora">' + item.prazoAtendimentoAtende + '</td>' +
                    '<td>' + item.assuntoAtende + '</td>' +
                    '<td class="obs'+item.idAtende+'">' + item.descricaoAtende + '</td>' +
                    '<td>' + 
                    '<div class="btn-group" role="group">' +
                        '<button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                            'Ação' + 
                        '</button>' +
                        // botão dropdown
                    '<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">' +
                        '<a class="dropdown-item" type="button" id="btn-consulta' + item.idAtende +' "class="btn btn-primary" data-toggle="modal" data-target="#modalConsulta' + item.idAtende + '">' + '<i class="fa fa-search" aria-hidden="true"></i>' + ' Consultar' + '</a>' +
                        '<a class="dropdown-item" type="button" id="btn-excluir' + item.idAtende +' "class="btn btn-primary" data-toggle="modal" data-target="#modalExcluir' + item.idAtende + '">' + '<i class="fas fa-trash-alt"></i>&nbsp Excluir</a>' +
                    '</div>' +
                        // Modal de Consulta
                        '<div class="modal fade" id="modalConsulta' + item.idAtende + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                        '<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">' +
                            '<div class="modal-content">' +
                                '<div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">' +
                                    '<h5 style="color: white;" class="modal-title" id="exampleModalLabel">' + 'Consulta' + '</h5>' +
                                    '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">' +
                                        '<span aria-hidden="true">&times;</span>' +
                                    '</button>' +
                                '</div>' +
                                '<div class="modal-body">' +
                                    '<div class="container">' +
                                        '<div>' +
                                            '<p><b>'+'Contrato:'+'</b>'+'<span class="pl-5">' + item.contratoFormatado + '</span></p>' +
                                            '<p><b>'+'Descrição:'+'</b></p>'+
                                            '<textarea class="form-control" rows="3" disabled>'+ item.descricaoAtende +'</textarea>'+
                                        '</div><br>' +
                                    '</div>' + 
                                '</div>' +
                                '<div class="modal-footer">' +
                                    '<button type="button" class="btn btn-secondary" data-dismiss="modal">' + 'Sair' + '</button>' +
                                '</div>' + 
                            '</div>' + 
                        '</div>' + 
                    '</div>' +
                    // Modal Exclusão
                '<div class="modal fade" id="modalExcluir' + item.idAtende + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                    '<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">' +
                        '<div class="modal-content">' +
                            '<form method="post" enctype="multipart/form-data" action="/excluir/gestor/' + item.idAtende + '">' +
                                    '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                                    '<input type="hidden" class="form-control" name="_method" value="PUT">' +
                                '<div style="background: linear-gradient(to right, #cc0000 0%, #ff6699 100%);" class="modal-header">' +
                                    '<h5 style="color: white;" class="modal-title" id="exampleModalLabel">' + 'Excluir' + '</h5>' +
                                    '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">' +
                                        '<span aria-hidden="true">&times;</span>' +
                                    '</button>' +
                                '</div>' +
                                '<div class="modal-body">' +
                                    '<div class="container">' +
                                    '<input type="hidden" name="emailContatoResposta" value="'+item.emailContatoResposta+'"></input>'+
                                    '<input type="hidden" name="emailContatoCopia" value="'+item.emailContatoCopia+'"></input>'+
                                    '<input type="hidden" name="emailContatoNovaCopia" value="'+item.emailContatoNovaCopia+'"></input>'+
                                        '<div>' +
                                        '<label for="exampleFormControlTextarea1">Motivo Exclusão</label>'+
                                        '<textarea class="form-control" name="respostaAtende" rows="5" required></textarea>'+
                                        '</div>' +
                                    '</div>' + 
                                '</div>' +
                                '<div class="modal-footer">' +
                                    '<button type="button" class="btn btn-secondary" data-dismiss="modal">' + 'Sair' + '</button>' +
                                    '<button type="submit" class="btn btn-danger">Excluir</button>' +
                                '</div>' +
                            '</form>'+ 
                        '</div>' + 
                    '</div>' + 
                '</div>' +
                '</td>'+
            '</tr>' 
               

        $(linha).appendTo('#tblminhasDemandasAgencia>tbody');

            var subtring = $('.obs'+item.idAtende).text()
            var novo = subtring.substring(0, 50) + ' [...]'
            $('.obs'+item.idAtende).text(novo)
            
        })
    _formataData();
    })
})

$.getJSON('/atende/listar-demandas-finalizadas', function(dados){
    $.each(dados, function(key, item) {
        var linha =
            '<tr>' +
                '<td>' + item.idAtende + '</td>' +
                '<td><a href="/consulta-bem-imovel/'+ item.contratoFormatado +'" class="cursor-pointer">' + item.numeroContrato + '</a></td>' +
                '<td>' + item.assuntoAtende + '</td>' +
                '<td class="obs'+item.idAtende + 999 +'">' + item.descricaoAtende + '</td>' +
                '<td class="obs'+item.idAtende+'">' + item.respostaAtende + '</td>' +
                '<td>'+
                '<div class="btn-group" role="group">' +
                '<button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                    'Ação' + 
                '</button>' +
                // botão dropdown
            '<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">' +
                '<a class="dropdown-item" type="button" id="btn-consulta' + item.idAtende +' "class="btn btn-primary" data-toggle="modal" data-target="#modalConsulta' + item.idAtende + '">' + '<i class="fa fa-search" aria-hidden="true"></i>' + ' Consultar' + '</a>' +
            '</div>' +
             // Modal de Consulta
             '<div class="modal fade" id="modalConsulta' + item.idAtende + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
             '<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">' +
                 '<div class="modal-content">' +
                     '<div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">' +
                         '<h5 style="color: white;" class="modal-title" id="exampleModalLabel">' + 'Consulta' + '</h5>' +
                         '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">' +
                             '<span aria-hidden="true">&times;</span>' +
                         '</button>' +
                     '</div>' +
                     '<div class="modal-body">' +
                         '<div class="container">' +
                             '<div>' +
                                 '<p><b>'+'Contrato:'+'</b>'+'<span class="pl-5">' + item.contratoFormatado + '</span></p>' +
                                 '<p><b>'+'Descrição:'+'</b></p>'+
                                 '<textarea class="form-control" rows="3" disabled>'+ item.descricaoAtende +'</textarea>'+
                             '</div><br>' +
                             '<p><b>'+'Resposta:'+'</b></p>'+
                              '<textarea class="form-control" rows="3" disabled>'+ item.respostaAtende +'</textarea>'+
                         '</div>' + 
                     '</div>' +
                     '<div class="modal-footer">' +
                         '<button type="button" class="btn btn-secondary" data-dismiss="modal">' + 'Sair' + '</button>' +
                     '</div>' + 
                 '</div>' + 
             '</div>' + 
         '</div>' +
         '</td>'+
            '</tr>' 
           

    $(linha).appendTo('#tblminhasDemandasFinalizado>tbody');

    var subtring = $('.obs'+item.idAtende).text()
    var novo = subtring.substring(0, 50) + ' [...]'
    $('.obs'+item.idAtende).text(novo)

    var newsubtring = $('.obs'+item.idAtende + 999).text()
    var novodesricao = newsubtring.substring(0, 50) + ' [...]'
    $('.obs'+item.idAtende + 999).text(novodesricao)

    })
})

$.getJSON('/listar/atende-sem-contrato-agencia', function(dados){
    $.each(dados, function(key, item) {
        var linha =
            '<tr>' +
                '<td>' + item.id + '</td>' +
                '<td>' + item.Nome_Atividade + '</td>' +
                '<td class="formata-data-sem-hora">' + item.Data_atendimento + '</td>' +
                '<td>' + item.Assunto + '</td>' +
                '<td class="obs'+item.id+'">' + item.Descricao + '</td>' +
                `<td>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ação 
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" type="button" id="btn-consulta${+ item.id}" class="btn btn-primary" data-toggle="modal" data-target="#modalConsulta${+ item.id}"><i class="fa fa-search" aria-hidden="true"></i>&nbspConsultar</a>
                        <a class="dropdown-item" type="button" id="btn-editar${+ item.id}" class="btn btn-primary" data-toggle="modal" data-target="#modalExcluir${+ item.id}"><i class="fas fa-trash-alt"></i>&nbsp Excluir</a>
                    </div>
                    <div class="modal fade" id="modalConsulta${+ item.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">
                            <h5 style="color: white;" class="modal-title" id="exampleModalLabel">Consultar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div>
                                    <p><b>Descrição completa: </b></p>
                                    <textarea class="form-control" rows="3" disabled>${item.Descricao}</textarea>
                                </div><br>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
        
                <div class="modal fade" id="modalExcluir${+ item.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div style="background: linear-gradient(to right, #cc0000 0%, #ff6699 100%);" class="modal-header">
                        <h5 style="color: white;" class="modal-title" id="exampleModalLabel">Excluir</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" action="/fale-conosco/excluir/${+ item.id}">
                    <input type="hidden" class="form-control" name="_token" value="${csrfVar}">
                    <input type="hidden" class="form-control" name="_method" value="put">
                    <div class="container">
                        <input type="hidden" name="emailContatoResposta" value="${item.Email_contato}"></input>
                        <input type="hidden" name="Responsavel" value="${item.Responsavel_Atendimento}"></input>
                        <div>
                        <label for="exampleFormControlTextarea1">Motivo da Exclusão</label>
                        <textarea class="form-control" name="respostaFaleConosco" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                        <button type="submit" class="btn btn-danger">Responder</button>
                    </div>
                    </form>
                    </div>
                    </div>
                </div>
            </div>


            </tr>`
           

    $(linha).appendTo('#tblFaleconoscoAgencia>tbody');

    var subtring = $('.obs'+item.id).text()
    var novo = subtring.substring(0, 50) + ' [...]'
    $('.obs'+item.id).text(novo)

    })

        $.getJSON('/listar/atende-sem-contrato-finalizado', function(dados){
            $.each(dados, function(key, item) {
                var linha =
                    '<tr>' +
                        '<td>' + item.id + '</td>' +
                        '<td>' + item.Nome_Atividade + '</td>' +
                        '<td>' + item.Assunto + '</td>' +
                        '<td class="obs'+item.id+'">' + item.Descricao + '</td>' +
                        '<td class="obs'+item.id + 999+'">' + item.Resposta + '</td>' +
                        `<td>
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Ação 
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" type="button" id="btn-consulta${+ item.id}" class="btn btn-primary" data-toggle="modal" data-target="#modalConsulta${+ item.id}"><i class="fa fa-search" aria-hidden="true"></i>&nbspConsultar</a>
                            </div>
                            <div class="modal fade" id="modalConsulta${+ item.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                <div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">
                                    <h5 style="color: white;" class="modal-title" id="exampleModalLabel">Consultar</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div>
                                            <p><b>Descrição completa: </b></p>
                                            <textarea class="form-control" rows="3" disabled>${item.Descricao}</textarea>
                                        </div><br>

                                        <div>
                                        <p><b>Resposta: </b></p>
                                        <textarea class="form-control" rows="3" disabled>${item.Resposta}</textarea>
                                    </div><br>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                                </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </tr>`
                
        
            $(linha).appendTo('#tblFaleconoscoAgenciaFinalizado>tbody');

            var subtring = $('.obs'+item.id).text()
            var novo = subtring.substring(0, 50) + ' [...]'
            $('.obs'+item.id).text(novo)
        })
    })
})
setTimeout(function(){
    _formataDatatable()

    var pegaNumeroDeRegistrosDemandaAgencia = $('#tblminhasDemandasAgencia_info').text()
    var totalRegistroDemandaAgencia = pegaNumeroDeRegistrosDemandaAgencia.substring(24,25);
    $('#badgeDemandaAgencia').html(totalRegistroDemandaAgencia);
    if ($('#badgeDemandaAgencia').text() == 'e'){
        $('#badgeDemandaAgencia').html('0')
    }

    var pegaNumeroDeRegistrosDemandaAgenciaFinalizado = $('#tblminhasDemandasFinalizado_info').text()
    var totalRegistroDemandaAgenciaFinalizado = pegaNumeroDeRegistrosDemandaAgenciaFinalizado.substring(24,25);
    $('#badgeDemandaAgenciaFinalizado').html(totalRegistroDemandaAgenciaFinalizado);
    if ($('#badgeDemandaAgenciaFinalizado').text() == 'e'){
        $('#badgeDemandaAgenciaFinalizado').html('0')
    }
  
    var pegaNumeroDeRegistrosSemContrato = $('#tblFaleconoscoAgencia_info').text()
    var totalRegistroSemContrato= pegaNumeroDeRegistrosSemContrato.substring(24,25);
    $('#badgeDemandaSemContrato').html(totalRegistroSemContrato);
    if ($('#badgeDemandaSemContrato').text() == 'e'){
        $('#badgeDemandaSemContrato').html('0')
    }

    var pegaNumeroDeRegistros = $('#tblFaleconoscoAgenciaFinalizado_info').text()
    var totalRegistro = pegaNumeroDeRegistros.substring(24,25);
    $('#badgeFinalizado').html(totalRegistro);
    if ($('#badgeFinalizado').text() == 'e'){
        $('#badgeFinalizado').html('0')
    }
    }, 2000);

setTimeout(function(){
    $('#fadeOut').fadeOut("slow");
}, 2000);


