var gilie = $('#lotacao').text()
var csrfVar = $('meta[name="csrf-token"]').attr('content');

$(document).ready(function(){
$.getJSON('/fornecedores/controle-leiloeiros/listar-leiloeiros/' + gilie, function(dados){
    $.each(dados, function(key, item) {
        var linha =
            '<tr>' +
                '<td>' + item.idLeiloeiro + '</td>' +
                '<td>' + item.nomeEmpresaAssessoraLeiloeiro + '</td>' +
                '<td>' + item.numeroContrato + '</td>' +
                '<td>' + item.classificacaoImoveisLeilao + '</td>' +
                '<td class="formata-data-sem-hora">' + item.dataVencimentoContrato + '</td>' +
                '<td>' + item.nomeLeiloeiro + '</td>' +
                '<td>' + item.telefoneLeiloeiro + '</td>' +
                '<td>' + 
                    '<div class="btn-group" role="group">' +
                        '<button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                            'Ação' + 
                        '</button>' + 

                        // botão dropdown
                        '<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">' +
                            '<a class="dropdown-item" type="button" id="btn-consulta' + item.idLeiloeiro +' "class="btn btn-primary" data-toggle="modal" data-target="#modalConsulta' + item.idLeiloeiro + '">' + '<i class="fa fa-search" aria-hidden="true">' + '</i>' + ' Consultar' + '</a>' +
                            '<a class="dropdown-item" type="button" id="btn-editar' + item.idLeiloeiro +' "class="btn btn-primary" data-toggle="modal" data-target="#modalEditar' + item.idLeiloeiro + '">' + '<i class="far fa-edit">' + '</i>' + ' Editar' + '</a>' +
                            '<a class="dropdown-item" type="button" id="btn-remove' + item.idLeiloeiro +' "class="btn btn-primary" data-toggle="modal" data-target="#modalRemove' + item.idLeiloeiro + '">'+ '<i class="far fa-trash-alt">' + '</i>' + ' Remover</a>' +
                        '</div>' + 
                       
                        // Modal de consulta
                        '<div class="modal fade" id="modalConsulta' + item.idLeiloeiro + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                            '<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">' +
                                '<div class="modal-content">' +
                                    '<div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">' +
                                        '<h5 style="color: white;" class="modal-title" id="exampleModalLabel">' + 'Cadastro completo' + '</h5>' +
                                        '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">' +
                                            '<span aria-hidden="true">&times;</span>' +
                                        '</button>' +
                                    '</div>' +
                                    '<div class="modal-body">' +
                                        '<div class="container">' +
                                            '<div>' +
                                                '<hr>'+
                                                    '<p><b>' + 'NOME:' + '</b>' + '<span class="pl-5">' + item.nomeEmpresaAssessoraLeiloeiro + '</span>' + '</p>' +
                                                    '<p><b>' + 'Classificação:' + '</b>' + '<span class="pl-5">' + item.classificacaoImoveisLeilao + '</span>' + '</p>' +
                                                    '<p><b>'+'Telefone:'+'</b>'+ '<span class="pl-3">'+item.telefoneLeiloeiro+'</span>'+'</p>'+
                                                    '<p><b>'+'E-MAIL:'+'</b>'+ '<span class="pl-3">'+item.emailEmpresaAssessoraLeiloeiro+'</span>'+'</p>'+
                                                    '<p><b>'+'Site:'+'</b>'+ '<a class="pl-3" href="'+item.siteEmpresaAssessoraLeiloeiro+'">'+item.siteEmpresaAssessoraLeiloeiro+'</a>'+'</p>'+
                                                    '<p><b>'+'Nº do contrato:'+'</b>'+ '<span class="pl-3">'+item.numeroContrato+'</span>'+'</p>'+
                                                    '<p><b>'+'Vencimento do contrato:'+'</b>'+ '<span class="pl-3" id="vencimento_contrato'+item.idLeiloeiro+'">'+item.dataVencimentoContrato+'</span>'+'</p>'+
                                                    '<hr>'+
                                                    '<p><b>'+'Leiloeiro:'+'</b>'+ '<span class="pl-3">'+item.nomeLeiloeiro+'</span>'+'</p>'+
                                                    '<p><b>'+'Telefone/Leiloeiro:'+'</b>'+ '<span class="pl-3">'+item.telefoneLeiloeiro+'</span>'+'</p>'+
                                                    '<p><b>'+'E-mail/Leiloeiro:'+'</b>'+ '<span class="pl-3">'+item.emailLeiloeiro+'</span>'+'</p>'+
                                                    '<hr>'+
                                                    '<p><b>'+'Endereço:'+'</b>'+ '<span class="pl-3">'+item.enderecoEmpresaAssessoraLeiloeiro+'</span>'+'</p>'+
                                                    '<p><b>'+'Endereço do leilão:'+'</b>'+ '<span class="pl-3">'+item.enderecoRealizacaoLeilao+'</span>'+'</p>'+                         
                                            '</div>' +
                                        '</div>' + 
                                    '</div>' +
                                    '<div class="modal-footer">' +
                                        '<button type="button" class="btn btn-secondary" data-dismiss="modal">' + 'Sair' + '</button>' +
                                    '</div>' + 
                                '</div>' + 
                            '</div>' + 
                        '</div>' +
                        // modal remover    
                        '<div class="modal fade" id="modalRemove' + item.idLeiloeiro + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                            '<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">' +
                                '<div class="modal-content">' +
                                    '<form method="post" action="/fornecedores/controle-leiloeiros/' + item.idLeiloeiro + '">' +
                                        '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                                        '<input type="hidden" class="form-control" name="_method" value="DELETE">' +
                                        '<div style="background: linear-gradient(to right, #cc0000 0%, #ff6699 100%);" class="modal-header">' +
                                            '<h5 style="color: white;" class="modal-title" id="exampleModalLabel">Remover Despachante</h5>' +
                                            '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">' +
                                            '<span aria-hidden="true">&times;</span>' +
                                            '</button>' +
                                        '</div>' +
                                        '<div class="modal-body">' +
                                            '<div class="container">' +  
                                                '<p>Tem certeza que deseja excluir: <b>' + item.nomeEmpresaAssessoraLeiloeiro + '</b> ?</p>' +
                                            '</div>' + 
                                        '</div>' +
                                        '<div class="modal-footer">' +
                                            '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>' +
                                            '<button type="submit" class="btn btn-danger">Excluir</button>' +
                                        '</div>' + 
                                    '</form>' +
                                '</div>' + 
                            '</div>' + 
                        '</div>' +  

                        // Modal editar
                        '<div class="modal fade" id="modalEditar' + item.idLeiloeiro + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                            '<div class="modal-dialog modal-lg" role="document">' +
                                '<div class="modal-content">' +
                                    '<form method="post" action="/fornecedores/controle-leiloeiros/' + item.idLeiloeiro +'">' +
                                    '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                                    '<input type="hidden" class="form-control" name="_method" value="PUT">' +
                                        '<div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">' +
                                            '<h5 style="color: white;" class="modal-title" id="exampleModalLabel">' + 'Editar cadastro:'+
                                            '<p>'+'Preencha os campos que deseja alterar e clique em salvar'+'</p>'+'</h5>' +
                                            '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">' +
                                                '<span aria-hidden="true">&times;</span>' +
                                            '</button>' +
                                        '</div>' +
                                            '<div class="modal-body" px-0>' +
                                                '<div style="overflow-y: hidden; height: calc(100vh - 15rem);">'+
                                                '<div class="px-2" style="overflow-y: auto; height: 100%;">'+
                                            '<div>' +
                                            '<div id="classificacao'+item.idLeiloeiro+'">'+
                                            '<p><b>' + 'Classificação:' + '</b>' + '<span class="pl-5" >' + item.classificacaoImoveisLeilao + '</span>' + '</p>' +
                                            '</div>'+

                                            '<div class="form-group">'+
                                            '<label style="float: left;">Contrato</label>'+
                                            '<span style="display: block; overflow: hidden; padding: 0 4px 0 6px;">'+
                                            '<input style="width: 100%;" type="text" name="numeroContrato" class="form-control" autocomplete="off" placeholder="'+item.numeroContrato+'">'+'</span>'+
                                            '</div>'+

                                            '<div class="form-group" id="vencimentoEmgea'+item.idLeiloeiro+'">'+
                                            '<label style="float: left;">Data de vencimento</label>'+
                                            '<span style="display: block; overflow: hidden; padding: 0 4px 0 6px;">'+
                                            '<input style="width: 100%;" type="date" name="dataVencimentoContrato" class="form-control" autocomplete="off" placeholder="'+item.dataVencimentoContrato+'">'+'</span>'+
                                            '</div>'+

                                            '<div class="form-group">'+
                                            '<label style="float: left;">Nome</label>'+
                                            '<span style="display: block; overflow: hidden; padding: 0 4px 0 6px;">'+
                                            '<input style="width: 100%;" type="text" name="nomeEmpresaAssessoraLeiloeiro" class="form-control" autocomplete="off" placeholder="'+item.nomeEmpresaAssessoraLeiloeiro+'">'+'</span>'+
                                            '</div>'+
                                            
                                            '<div class="form-group">'+
                                            '<label style="float: left;">Telefone</label>'+
                                            '<span style="display: block; overflow: hidden; padding: 0 4px 0 6px;">'+
                                            '<input style="width: 100%;" type="text" name="telefoneEmpresaAssessoraLeiloeiro" class="form-control telefoneComum" autocomplete="off" placeholder="'+item.telefoneEmpresaAssessoraLeiloeiro+'">'+'</span>'+
                                            '</div>'+

                                            '<div class="form-group">'+
                                            '<label style="float: left;">E-mail</label>'+
                                            '<span style="display: block; overflow: hidden; padding: 0 4px 0 6px;">'+
                                            '<input style="width: 100%;" type="email" name="emailEmpresaAssessoraLeiloeiro" class="form-control telefoneComum" autocomplete="off" placeholder="'+item.emailEmpresaAssessoraLeiloeiro+'">'+'</span>'+
                                            '</div>'+

                                            '<div class="form-group">'+
                                            '<label style="float: left;">Leiloeiro</label>'+
                                            '<span style="display: block; overflow: hidden; padding: 0 4px 0 6px;">'+
                                            '<input style="width: 100%;" type="text" name="nomeLeiloeiro" class="form-control" autocomplete="off" placeholder="'+item.nomeLeiloeiro+'">'+'</span>'+
                                            '</div>'+

                                            '<div class="form-group">'+
                                            '<label style="float: left;">Telefone do leiloeiro</label>'+
                                            '<span style="display: block; overflow: hidden; padding: 0 4px 0 6px;">'+
                                            '<input style="width: 100%;" type="text" name="telefoneLeiloeiro" class="form-control telefoneCelular" autocomplete="off" placeholder="'+item.telefoneLeiloeiro+'">'+'</span>'+
                                            '</div>'+

                                            '<div class="form-group">'+
                                            '<label style="float: left;">E-mail do leiloeiro</label>'+
                                            '<span style="display: block; overflow: hidden; padding: 0 4px 0 6px;">'+
                                            '<input style="width: 100%;" type="text" name="emailLeiloeiro" class="form-control telefoneCelular" autocomplete="off" placeholder="'+item.emailLeiloeiro+'">'+'</span>'+
                                            '</div>'+
                                            
                                            '<div class="form-group">'+
                                            '<label style="float: left;">Endereço</label>'+
                                            '<span style="display: block; overflow: hidden; padding: 0 4px 0 6px;">'+
                                            '<input style="width: 100%;" type="text" name="enderecoEmpresaAssessoraLeiloeiro" class="form-control" autocomplete="off" placeholder="'+item.enderecoEmpresaAssessoraLeiloeiro+'">'+'</span>'+
                                            '</div>'+

                                            '<div class="form-group">'+
                                            '<label style="float: left;">Endereço do leilão</label>'+
                                            '<span style="display: block; overflow: hidden; padding: 0 4px 0 6px;">'+
                                            '<input style="width: 100%;" type="text" name="enderecoRealizacaoLeilao" class="form-control" autocomplete="off" placeholder="'+item.enderecoRealizacaoLeilao+'">'+'</span>'+
                                            '</div>'+

                                            '<div class="form-group">'+
                                            '<label style="float: left;">Site</label>'+
                                            '<span style="display: block; overflow: hidden; padding: 0 4px 0 6px;">'+
                                            '<input style="width: 100%;" type="text" name="siteEmpresaAssessoraLeiloeiro" class="form-control" autocomplete="off" placeholder="'+item.siteEmpresaAssessoraLeiloeiro+'">'+'</span>'+
                                            '</div>'+
                                            
                                            '</div>' +
                                            '</div>' +
                                        '</div>' + 
                                    '</div>' +
                                    '<div class="modal-footer">' +
                                        '<button type="button" class="btn btn-secondary" data-dismiss="modal">' + 'Cancelar' + '</button>' +
                                        '<button type="submit" class="btn btn-success">Salvar</button>' +
                                    '</div>' + 
                                 '</form>'+
                                '</div>' + 
                            '</div>' + 
                        '</div>' +
                    '</div>' + 
                '</td>' +
            '</tr>';          
  
$(linha).appendTo('#tblLeiloeiro>tbody');

var SeCaixa = $('#classificacao' + item.idLeiloeiro).text()
if (SeCaixa == "Classificação:CAIXA"){
    $('#vencimentoEmgea'+item.idLeiloeiro).remove();
}

// altera a data do form para formato Brasil
var data =$('#vencimento_contrato'+ item.idLeiloeiro).text()
var novaData = data.replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1');
$('#vencimento_contrato'+item.idLeiloeiro).text(novaData)

$(".telefoneComum").mask("(00) 0000-0000");
$(".cnpj").mask("99.999.999/9999-99");
$(".telefoneCelular").mask("(00) 00000-0000");

})
}).done(function() { 
    _formataDatatable();
    _formataData();
})
})
    $(".telefoneComum").mask("(00) 0000-0000");
    $(".cnpj").mask("99.999.999/9999-99");
    $(".telefoneCelular").mask("(00) 00000-0000");


  setTimeout(function(){
    $('#fadeOut').fadeOut("slow");
    }, 3000);

$("#botaocaixa").click(function(){
    $(".LeiloeiroEmgea").hide();
    $(".LeiloeiroCaixa").show();
    $("#input").val("CAIXA");
});
      
$("#botaoemgea").click(function(){
    $(".LeiloeiroCaixa").hide();
    $(".LeiloeiroEmgea").show();
    $("#input").val("EMGEA");
});
      



