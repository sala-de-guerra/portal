var csrfVar = $('meta[name="csrf-token"]').attr('content');
$.fn.dataTable.ext.errMode = 'none';

//pega data
var hoje = new Date()
var hojeFormatado = moment(hoje).format('DD/MM/YYYY');

jQuery.extend( jQuery.fn.dataTableExt.oSort, {
	"date-uk-pre": function ( a ) {
		if (a == null || a == "") {
			return 0;
		}
		var ukDatea = a.split('/');
		return (ukDatea[2] + ukDatea[1] + ukDatea[0]) * 1;
	},

	"date-uk-asc": function ( a, b ) {
		return ((a < b) ? -1 : ((a > b) ? 1 : 0));
	},

	"date-uk-desc": function ( a, b ) {
		return ((a < b) ? 1 : ((a > b) ? -1 : 0));
	}
} );

function _formataDatatableComData (idTabela){
    $('#' + idTabela).DataTable({
        "order": [[ 3, "asc" ]],
        columnDefs: [
            {type: 'date-uk', targets: 3}
        ],
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
};





function pad(n, width, z) {
    z = z || '0';
    n = n + '';
    return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
  }


$(document).ready(function(){  
    $.getJSON('/atende/listar-demandas-disponiveis', function(dados){
        $.each(dados, function(key, item) {
            let atende = item.idAtende
            var vencimento = moment(item.prazoAtendimentoAtende).format('DD/MM/YYYY')
            var linha =
                '<tr>' +
                    '<td id="numeroAtende'+item.idAtende+'">#' + pad(atende, 5) + '</td>' +
                    '<td><a href="/consulta-bem-imovel/'+ item.contratoFormatado +'" class="cursor-pointer">' + item.numeroContrato + '</a></td>' +
                    '<td id="atividade'+item.idAtende+'">' + item.nomeAtividade + '</td>' +
                    `<td id="vencimento${item.idAtende}">${vencimento}</td>`+
                    '<td>' + item.assuntoAtende + '</td>' +
                    '<td class="obs'+item.idAtende+'">' + item.descricaoAtende + '</td>' +
                    '<td>' + 
                        '<div class="btn-group" role="group">' +
                            '<button id="btnGroupDrop1'+item.idAtende+'" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                                'Ação' + 
                            '</button>' +
                            // botão dropdown
                        '<div id="dropdown'+item.idAtende+'" class="dropdown-menu" aria-labelledby="btnGroupDrop1">' +
                            '<a class="dropdown-item" type="button" id="btn-consulta' + item.idAtende +' "class="btn btn-primary" data-toggle="modal" data-target="#modalConsulta' + item.idAtende + '">' + '<i class="fa fa-search" aria-hidden="true"></i>' + ' Consultar' + '</a>' +
                            // '<a class="dropdown-item" type="button" id="btn-editar' + item.idAtende +' "class="btn btn-primary" data-toggle="modal" data-target="#modalTratar' + item.idAtende + '">' + '<i class="far fa-edit">' + '</i>' + ' Tratar' + '</a>' +
                            '<a class="dropdown-item" type="button" href="/atende/tratar-atende/'+ item.idAtende +'"><i class="far fa-edit"></i>' + ' Tratar' + '</a>'+
                            '<a class="dropdown-item"  type="button" id="btn-direcionar' + item.idAtende +' "class="btn btn-primary" data-toggle="modal" data-target="#modalDirecionar' + item.idAtende + '">'+ '<i class="fas fa-exchange-alt">' + '</i>' + ' Direcionar</a>' +
                        '</div>' +
                            // Modal de consulta
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
                                            '<div id="redirecionamento'+item.idAtende+'">'+
                                                '<p><b>'+'Motivo do redirecionamento:'+'</b>'+'<span class="pl-5"></span></p>' +  
                                                '<textarea id="textoRedirecionamento'+item.idAtende+'" class="form-control" rows="3" disabled>'+ item.motivoRedirecionamento +'</textarea>'+
                                            '</div>'+
                                        '</div>' + 
                                    '</div>' +
                                    '<div class="modal-footer">' +
                                        '<button type="button" class="btn btn-secondary" data-dismiss="modal">' + 'Sair' + '</button>' +
                                    '</div>' + 
                                '</div>' + 
                            '</div>' + 
                        '</div>' +
                        // Modal tratamento
                    '<div class="modal fade" id="modalTratar' + item.idAtende + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                        '<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">' +
                            '<div class="modal-content">' +
                                '<form method="post" enctype="multipart/form-data" action="/atende/responder/' + item.idAtende + '">' +
                                        '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                                        '<input type="hidden" class="form-control" name="_method" value="PUT">' +
                                    '<div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">' +
                                        '<h5 style="color: white;" class="modal-title" id="exampleModalLabel">' + 'Tratar Demanda' + '</h5>' +
                                        '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">' +
                                            '<span aria-hidden="true">&times;</span>' +
                                        '</button>' +
                                    '</div>' +
                                    '<div class="modal-body">' +
                                        '<div class="container">' +
                                        '<input type="hidden" name="emailContatoResposta" value="'+item.emailContatoResposta+'"></input>'+
                                        '<input type="hidden" name="emailContatoCopia" value="'+item.emailContatoCopia+'"></input>'+
                                        '<input type="hidden" name="emailContatoNovaCopia" value="'+item.emailContatoNovaCopia+'"></input>'+
                                        '<input type="hidden" name="numAtende" value=>"#' + pad(atende, 5)+'"></input>'+
                                            '<div>' +
                                            '<label for="exampleFormControlTextarea1">Responder Atende</label>'+
                                            '<textarea class="form-control" name="respostaAtende" rows="15" required></textarea>'+
                                            '</div>' +
                                            '<div class="row">'+
                                            '<div class="form-group col-sm-10">'+
                                            '<input type="file" name="arquivo" ></input>'+
                                            '</div>'+
                                            '</div>' + 
                                        '</div>' + 
                                    '</div>' +
                                    '<div class="modal-footer">' +
                                        '<button type="button" class="btn btn-secondary" data-dismiss="modal">' + 'Sair' + '</button>' +
                                        '<button type="submit" class="btn btn-success">Responder</button>' +
                                    '</div>' +
                                '</form>'+ 
                            '</div>' + 
                        '</div>' + 
                    '</div>' +
                        // modal redirecionar
                            '<div class="modal fade" id="modalDirecionar' + item.idAtende + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                            '<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">' +
                                '<div class="modal-content">' +
                                    '<form method="post" action="/atende/redirecionar/' + item.idAtende + '">' +
                                        '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                                        '<input type="hidden" class="form-control" name="_method" value="PUT">' +
                                        '<div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">' +
                                            '<h5 style="color: white;" class="modal-title" id="exampleModalLabel">' + 'Direcionar' + '</h5>' +
                                            '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">' +
                                                '<span aria-hidden="true">&times;</span>' +
                                            '</button>' +
                                        '</div>' +
                                        '<div class="modal-body">' +
                                            '<div class="container">' +
                                                '<div>' +

                                                '<label for="exampleFormControlSelect1">Selecione o Destinatário</label>'+
                                                '<select class="form-control" id="selectDestinatario'+item.idAtende+'" name="matriculaResponsavelAtividade" required>'+
                                                '</select>'+'<br>'+

                                                '<div class="form-group">'+
                                                '<label for="exampleFormControlTextarea1">Motivo do redirecionamento</label>'+
                                                '<textarea class="form-control" name="motivoRedirecionamento" rows="3" required></textarea>'+
                                            '</div>'+

                                                '</div>' +
                                            '</div>' + 
                                        '</div>' +
                                        '<div class="modal-footer">' +
                                            '<button type="button" class="btn btn-secondary" data-dismiss="modal">' + 'Sair' + '</button>' +
                                            '<button type="submit" class="btn btn-success">Salvar</button>' +
                                        '</div>' +
                                    '</form>'+
                                '</div>' + 
                            '</div>' + 
                        '</div>' + 

                        '<div class="modal fade" id="excluir' + item.idAtende + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                        '<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">' +
                            '<div class="modal-content">' +
                                '<form method="post" action="/excluir/gestor/' + item.idAtende + '">' +
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
                                            '<div>' +
                
                                            '<label for="exampleFormControlTextarea1">Motivo da Exclusão</label>'+
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



        var confereVencimento = moment(item.prazoAtendimentoAtende).isBefore(hoje);

        $(linha).appendTo('#tblminhasDemandas>tbody');

        $('#btnGroupDrop1'+item.idAtende).click(function() {
            $.getJSON('/gerencial/gestao-equipes/listar-empregados-equipe/' +item.idEquipe, function(dadosEmpregado){
                $.each(dadosEmpregado, function(empKey, empItem) {
                    var redirect =
                                '<option value="'+empItem.matricula+'">'+empItem.nomeCompleto+'</option>'           
                $(redirect).appendTo('#selectDestinatario'+item.idAtende);
                    })
                })
            })
            

        if ($('#atividade' + item.idAtende).text() == 'SIOUV'){
            var btnexcluir = '<a class="dropdown-item" type="button" id="btn-excluir' + item.idAtende +' "class="btn btn-primary" data-toggle="modal" data-target="#excluir' + item.idAtende + '">'+ '<i class="far fa-trash-alt"></i>' + ' Excluir</a>'
            $(btnexcluir).appendTo("#dropdown" + item.idAtende);
        }
        
        if (confereVencimento == true){
            $('#numeroAtende'+item.idAtende).html('<b style="color: red;">#' + pad(atende, 5) + '</b>')
        }


        if ($('#textoRedirecionamento'+item.idAtende).text() == "null"){
            $('#redirecionamento'+item.idAtende).remove()
        }
        
        var redirect =   '<option value="'+item.idAtende+'">'+item.idAtende+'</option>'
        $(redirect).appendTo('#selectID');
       
        
            var subtring = $('.obs'+item.idAtende).text()
            var novo = subtring.substring(0, 50) + ' [...]'
            $('.obs'+item.idAtende).text(novo)
            
        })
    }).done(function() {
        _formataDatatableComData('tblminhasDemandas')
    })
})


function _formataDatatableFinalizados (idTabela){
    $('#' + idTabela).DataTable({
        "order": [[ 3, "desc" ]],
        columnDefs: [
            {type: 'date-uk', targets: 3}
        ],
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
};


$.getJSON('demandas-finalizadas-responsavel', function(dados){
    $.each(dados, function(key, item) {
    let atende = item.idAtende
     var linha = 
     `<tr>
     <td>#`+pad(atende, 5)+`</td>
     <td><a href="/consulta-bem-imovel/${item.contratoFormatado}" class="cursor-pointer">${item.numeroContrato}</a></td>
     <td>${item.nomeEquipe}</td>
     <td>`+moment(item.dataAlteracao).format('DD/MM/YYYY')+`</td>
     <td>${item.nomeAtividade}</td>
     <td>${item.assuntoAtende}</td>`+
     '<td>' + 
     '<div class="btn-group" role="group">' +
         '<button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
             'Ação' + 
         '</button>' + 

         // botão dropdown
         '<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">' +
         '<a class="dropdown-item" type="button" id="btn-consulta' + item.idAtende +' "class="btn btn-primary" data-toggle="modal" data-target="#Consulta' + item.idAtende + '">' + '<i class="fa fa-search" aria-hidden="true"></i>' + ' Consultar' + '</a>' +
         '</div>' +

         // Modal de consulta
         '<div class="modal fade" id="Consulta' + item.idAtende + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
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
                             '<textarea class="form-control" rows="5" disabled>'+ item.descricaoAtende +'</textarea>'+
                         '</div><br>' +
                        '<div>'+
                         '<p><b>'+'Resposta:'+'</b></p>'+
                            '<p>'+ item.respostaAtende +'</p>'+
                        '</div><br>' +

                     '</div>' + 
                 '</div>' +
                 '<div class="modal-footer">' +
                     '<button type="button" class="btn btn-secondary" data-dismiss="modal">' + 'Sair' + '</button>' +
                 '</div>' + 
             '</div>' + 
         '</div>' + 
     '</div>' +
     '</td>' + 
 '</tr>'

        $(linha).appendTo('#tblFinalizados>tbody');
        })
    }).done(function() {
        _formataDatatableFinalizados('tblFinalizados')
})


setTimeout(function(){
    $('#fadeOut').fadeOut("slow");
}, 5000);

//troca demanda aberta por finalizada
$("#btnFinalizado").click(function() {
    $("#displayAberto").css("display", "none");
    $("#displayFechado").css("display", "block");
});
// troca demanda finalizada por aberta
$("#btnAbertas").click(function() {
    $("#displayFechado").css("display", "none");
    $("#displayAberto").css("display", "block");
});
