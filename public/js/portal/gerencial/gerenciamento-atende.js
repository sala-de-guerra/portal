var csrfVar = $('meta[name="csrf-token"]').attr('content');

//pega data
var hoje = new Date()
var hojeFormatado = moment(hoje).format('DD/MM/YYYY');

//formata idAtende #00000
function pad(n, width, z) {
    z = z || '0';
    n = n + '';
    return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
  }

//Arruma ordenação datatable na data formato dd/mm/aaaa
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

function _formataDatatableComId (idTabela){
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

$( document ).ready(function() {
    $.getJSON('listar-atende', function(dados){
           $.each(dados, function(key, item) {
            let atende = item.idAtende
            var vencimento = moment(item.prazoAtendimentoAtende).format('DD/MM/YYYY')

            var linha = 
            `<tr>
            <td>#`+pad(atende, 5)+`</td>
            <td><a href="/consulta-bem-imovel/${item.contratoFormatado}" class="cursor-pointer">${item.numeroContrato}</a></td>
            <td>${item.nomeEquipe}</td>
            <td id="vencimento${item.idAtende}">${vencimento}</td>
            <td>${item.nomeAtividade}</td>
            <td>${item.assuntoAtende}</td>
            <td id="nome${item.idAtende}">${item.matriculaResponsavelAtividade}</td>`+
            '<td>' + 
            '<div class="btn-group" role="group">' +
                '<button id="btnGroupDrop1'+item.idAtende+'" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                    'Ação' + 
                '</button>' + 

                // botão dropdown
                '<div class="dropdown-menu" aria-labelledby="btnGroupDrop1'+item.idAtende+'">' +
                '<a class="dropdown-item" type="button" id="btn-consulta' + item.idAtende +' "class="btn btn-primary" data-toggle="modal" data-target="#Consulta' + item.idAtende + '">' + '<i class="fa fa-search" aria-hidden="true"></i>' + ' Consultar' + '</a>' +
                    '<a class="dropdown-item" type="button" id="btn-redirecionar' + item.idAtende +' "class="btn btn-primary" data-toggle="modal" data-target="#redirecionar' + item.idAtende + '">' + '<i class="fas fa-exchange-alt"></i>' + ' redirecionar' + '</a>' +
                    // '<a class="dropdown-item" type="button" id="btn-tratar' + item.idAtende +' "class="btn btn-primary" data-toggle="modal" data-target="#tratar' + item.idAtende + '">' + '<i class="far fa-edit"></i>' + ' tratar' + '</a>' +
                    '<a class="dropdown-item" type="button" href="/atende/tratar-atende/'+ item.idAtende +'"><i class="far fa-edit"></i>' + ' Tratar' + '</a>'+
                    '<a class="dropdown-item" type="button" id="btn-excluir' + item.idAtende +' "class="btn btn-primary" data-toggle="modal" data-target="#excluir' + item.idAtende + '">'+ '<i class="far fa-trash-alt"></i>' + ' excluir</a>' +
                '</div>' +

                // Modal de consulta
                '<div class="modal fade" id="Consulta' + item.idAtende + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                '<div class="modal-dialog modal-lg" role="document">' +
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
                                    '<textarea class="form-control" rows="20" disabled>'+ item.descricaoAtende +'</textarea>'+
                                '</div><br>' +
                            '</div>' + 
                        '</div>' +
                        '<div class="modal-footer">' +
                            '<button type="button" class="btn btn-secondary" data-dismiss="modal">' + 'Sair' + '</button>' +
                        '</div>' + 
                    '</div>' + 
                '</div>' + 
            '</div>' +


                
                //modal redirecionar
                '<div class="modal fade" id="redirecionar' + item.idAtende + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                '<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">' +
                    '<div class="modal-content">' +
                        '<form method="post" action="/redirecionar/gestor/' + item.idAtende + '">' +
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
                                    '<select class="form-control" id="selectDestinatario'+item.idAtende+'" name="matriculaResponsavelAtividade">'+
                                    '</select>'+'<br>'+

                                    '<div class="form-group">'+
                                    '<label for="exampleFormControlTextarea1">Motivo do redirecionamento</label>'+
                                    '<textarea class="form-control" name="motivoRedirecionamento" rows="10"></textarea>'+
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

        // Modal tratamento
    //     '<div class="modal fade" id="tratar' + item.idAtende + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
    //     '<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">' +
    //         '<div class="modal-content">' +
    //             '<form method="post" action="/responder/gestor/' + item.idAtende + '">' +
    //                     '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
    //                     '<input type="hidden" class="form-control" name="_method" value="PUT">' +
    //                 '<div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">' +
    //                     '<h5 style="color: white;" class="modal-title" id="exampleModalLabel">' + 'Tratar Demanda' + '</h5>' +
    //                     '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">' +
    //                         '<span aria-hidden="true">&times;</span>' +
    //                     '</button>' +
    //                 '</div>' +
    //                 '<div class="modal-body">' +
    //                     '<div class="container">' +
    //                         '<div>' +

    //                         '<label for="exampleFormControlTextarea1">Responder Atende</label>'+
    //                         '<textarea class="form-control" name="respostaAtende" rows="15" required></textarea>'+

    //                         '</div>' +
    //                     '</div>' + 
    //                 '</div>' +
    //                 '<div class="modal-footer">' +
    //                     '<button type="button" class="btn btn-secondary" data-dismiss="modal">' + 'Sair' + '</button>' +
    //                     '<button type="submit" class="btn btn-success">Responder</button>' +
    //                 '</div>' +
    //             '</form>'+ 
    //         '</div>' + 
    //     '</div>' + 
    // '</div>' +

        // Modal Exclusão
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
            '</td>' + 
        '</tr>'
        
        var confereVencimento = moment(item.prazoAtendimentoAtende).isBefore(hoje);
        
        $(linha).appendTo('#tblAtendeAberto>tbody');

            if (confereVencimento == true){
            $('#nome'+item.idAtende).html('<b style="color: red;">'+item.matriculaResponsavelAtividade +'</b>')
            }

            $('#btnGroupDrop1'+item.idAtende).one("click", function() {
                $.getJSON('/gerencial/listar-empregado', function(dadosEmpregado){
                    $.each(dadosEmpregado, function(empKey, empItem) {
                        var redirect =
                                    '<option value="'+empItem.matricula+'">'+empItem.nomeCompleto+'</option>'           
                    $(redirect).appendTo('#selectDestinatario'+item.idAtende);
                    })
                })
            });
        })
        _formataDatatableComId("tblAtendeAberto")
    })
})

function _formataDatatabFinalizados (idTabela){
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

$('#custom-tabs-one-finalizado-tab').one("click", function() {
    $.getJSON('listar-finalizados', function(dados){
        $.each(dados, function(key, item) {
        let atende = item.idAtende
        var linha = 
        `<tr>
        <td>#`+pad(atende, 5)+`</td>
        <td><a href="/consulta-bem-imovel/${item.contratoFormatado}" class="cursor-pointer">${item.numeroContrato}</a></td>
        <td>${item.nomeEquipe}</td>
        <td>`+moment(item.dataAlteracao).format('DD/MM/YYYY')+`</td>
        <td>${item.nomeAtividade}</td>
        <td>${item.assuntoAtende}</td>
        <td>${item.matriculaResponsavelAtividade}</td>`+
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
                            '</div><hr><br>' +
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

    $(linha).appendTo('#tblAtendeFinalizado>tbody');
    })
    _formataDatatabFinalizados("tblAtendeFinalizado")
    })
})


