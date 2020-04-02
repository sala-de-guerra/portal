var gilie = $('#lotacao').text()
var csrfVar = $('meta[name="csrf-token"]').attr('content');

$(document).ready(function(){
    montaLinhasFornecedores(gilie);
});

function refresh(gilie) {
    $('#tblfornecedores>tbody').empty();
    montaLinhasFornecedores(gilie);
}

function montaLinhasFornecedores(gilie){   
$.getJSON('/fornecedores/controle-despachantes/listar-despachantes/' + gilie, function(dados){
    $.each(dados, function(key, item) {
        var linha =
            '<tr>' +
                '<td>' + item.idDespachante + '</td>' +
                '<td>' + item.nomeDespachante + '</td>' +
                '<td>' + item.numeroContrato + '</td>' +
                '<td class="formata-data-sem-hora">' + item.dataVencimentoContrato + '</td>' +
                '<td>' + item.cnpjDespachante + '</td>' +
                '<td>' + 
                    '<div class="btn-group" role="group">' +
                        '<button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                            'Ação' + 
                        '</button>' + 

                        // botão dropdown
                        '<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">' +
                            '<a class="dropdown-item" type="button" id="btn-consulta' + item.idDespachante +' "class="btn btn-primary" data-toggle="modal" data-target="#modalConsulta' + item.idDespachante + '">' + '<i class="fa fa-search" aria-hidden="true">' + '</i>' + ' Consultar' + '</a>' +
                            '<a class="dropdown-item" type="button" id="btn-editar' + item.idDespachante +' "class="btn btn-primary" data-toggle="modal" data-target="#modalEditar' + item.idDespachante + '">' + '<i class="far fa-edit">' + '</i>' + ' Editar' + '</a>' +
                            '<a class="dropdown-item" type="button" id="btn-remove' + item.idDespachante +' "class="btn btn-primary" data-toggle="modal" data-target="#modalRemove' + item.idDespachante + '">'+ '<i class="far fa-trash-alt">' + '</i>' + ' Remover</a>' +
                        '</div>' + 
                       
                        // Modal de consulta
                        '<div class="modal fade" id="modalConsulta' + item.idDespachante + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
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
                                                    '<p>' + '<b>' + 'NOME:' + '</b>' + '<span class="pl-5" id="nome_despachante">' + item.nomeDespachante + '</span>' + '</p>' +
                                                    '<p>'+'<b>'+'Telefone:'+'</b>'+ '<span class="pl-3" id="telefone_despachante">'+item.telefoneDespachante+'</span>'+'</p>'+
                                                    '<p>'+'<b>'+'E-MAIL:'+'</b>'+ '<span class="pl-3" id="email_despachante">'+item.emailDespachante+'</span>'+'</p>'+
                                                    '<p>'+'<b>'+'CNPJ:'+'</b>'+ '<span class="pl-3" id="cnpj_despachante">'+item.cnpjDespachante+'</span>'+'</p>'+
                                                    '<p>'+'<b>'+'Nº do contrato:'+'</b>'+ '<span class="pl-3" id="numero_contrato">'+item.numeroContrato+'</span>'+'</p>'+
                                                    '<p>'+'<b>'+'Vencimento do contrato:'+'</b>'+ '<span class="pl-3" id="vencimento_contrato'+item.idDespachante+'">'+item.dataVencimentoContrato+'</span>'+'</p>'+
                                                '<hr>'+
                                                    '<p>'+'<b>'+'Responsável:'+'</b>'+ '<span class="pl-3" id="nome_responsavel">'+item.nomePrimeiroResponsavelDespachante+'</span>'+'</p>'+
                                                    '<p>'+'<b>'+'Telefone/Responsável:'+'</b>'+ '<span class="pl-3" id="telefone_responsavel">'+item.telefonePrimeiroResponsavelDespachante+'</span>'+'</p>'+
                                                    '<p>'+'<b>'+'E-mail/Responsável:'+'</b>'+ '<span class="pl-3" id="email_responsavel">'+item.emailPrimeiroResponsavelDespachante+'</span>'+'</p>'+
                                                '<hr>'+
                                                    '<p>'+'<b>'+'Segundo Responsável:'+'</b>'+ '<span class="pl-3" id="nome_segundo_responsavel">'+item.nomeSegundoResponsavelDespachante+'</span>'+'</p>'+
                                                    '<p>'+'<b>'+'Telefone/Segundo Responsável:'+'</b>'+ '<span class="pl-3" id="telefone_segundo_responsavel">'+item.telefoneSegundoResponsavelDespachante+'</span>'+'</p>'+
                                                    '<p>'+'<b>'+'E-mail/Segundo Responsável:'+'</b>'+ '<span class="pl-3" id="email_segundo_responsavel">'+item.emailSegundoResponsavelDespachante+'</span>'+'</p>'+
                                                '<hr>'+
                                                    '<p>'+'<b>'+'Terceiro Responsável:'+'</b>'+ '<span class="pl-3" id="nome_terceiro_responsavel">'+item.nomeTerceiroResponsavelDespachante+'</span>'+'</p>'+
                                                    '<p>'+'<b>'+'Telefone/Terceiro Responsável:'+'</b>'+ '<span class="pl-3" id="telefone_terceiro_responsavel">'+item.telefoneTerceiroResponsavelDespachante+'</span>'+'</p>'+
                                                    '<p>'+'<b>'+'E-mail/Terceiro Responsável:'+'</b>'+ '<span class="pl-3" id="email_terceiro_responsavel">'+item.emailTerceiroResponsavelDespachante+'</span>'+'</p>'+
                                                '<hr>'+                           
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
                        '<div class="modal fade" id="modalRemove' + item.idDespachante + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                            '<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">' +
                                '<div class="modal-content">' +
                                    '<form method="post" action="/fornecedores/controle-despachantes/' + item.idDespachante + '">' +
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
                                                '<p>Tem certeza que deseja excluir: <b>' + item.nomeDespachante + '</b> ?</p>' +
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
                        '<div class="modal fade" id="modalEditar' + item.idDespachante + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                            '<div class="modal-dialog modal-lg" role="document">' +
                                '<div class="modal-content">' +
                                    '<form method="post" action="/fornecedores/controle-despachantes/' + item.idDespachante + '">' +
                                    '<input type="hidden" class="form-control" name="_token" value="' + csrfVar + '">' +
                                    '<input type="hidden" class="form-control" name="_method" value="PUT">' +
                                        '<div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">' +
                                            '<h5 style="color: white;" class="modal-title" id="exampleModalLabel">' + 'Editar cadastro:' + 
                                            '<p>'+'Preencha os campos que deseja alterar e clique em salvar'+'</p>'+'</h5>' +
                                            '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">' +
                                                '<span aria-hidden="true">&times;</span>' +
                                            '</button>' +
                                        '</div>' +
                                            '<div class="modal-body" px-0>' +
                                                '<div style="overflow-y: hidden; height: calc(100vh - 15rem);">'+
                                                '<div class="px-2" style="overflow-y: auto; height: 100%;">'+
                                            '<div>' +
                                                    '<div class="form-group">'+
                                                        '<label class="pt-2" style="float: left;">'+'Contrato: '+'</label>'+
                                                    '<span style="display: block; overflow: hidden; padding: 0 4px 0 6px;">'+
                                                    '<input style="width: 100%;" type="text" name="numeroContrato" class="form-control" autocomplete="off" placeholder="'+item.numeroContrato+'">'+'</span>'+
                                                    '</div>'+

                                                    '<div class="form-group">'+
                                                        '<label class="pt-2" style="float: left;">'+'Vencimento do contrato: '+'</label>'+
                                                    '<span style="display: block; overflow: hidden; padding: 0 4px 0 6px;">'+
                                                    '<input style="width: 100%;" type="text" name="dataVencimentoContrato" class="form-control" autocomplete="off" placeholder="'+item.dataVencimentoContrato+'">'+'</span>'+
                                                    '</div>'+

                                                    '<div class="form-group">'+
                                                        '<label class="pt-2" style="float: left;">'+'CNPJ: '+'</label>'+
                                                    '<span style="display: block; overflow: hidden; padding: 0 4px 0 6px;">'+
                                                    '<input style="width: 100%;" type="text" name="cnpjDespachante" class="form-control cnpj" autocomplete="off" placeholder="'+item.cnpjDespachante+'">'+'</span>'+
                                                    '</div>'+

                                                    '<div class="form-group">'+
                                                        '<label class="pt-2" style="float: left;">'+'Despachante: '+'</label>'+
                                                    '<span style="display: block; overflow: hidden; padding: 0 4px 0 6px;">'+
                                                    '<input style="width: 100%;" type="text" name="nomeDespachante" class="form-control" autocomplete="off" placeholder="'+item.nomeDespachante+'">'+'</span>'+
                                                    '</div>'+

                                                    '<div class="form-group">'+
                                                        '<label class="pt-2" style="float: left;">'+'Telefone: '+'</label>'+
                                                    '<span style="display: block; overflow: hidden; padding: 0 4px 0 6px;">'+
                                                    '<input style="width: 100%;" type="text" name="telefoneDespachante" class="form-control telefoneComum" autocomplete="off" placeholder="'+item.telefoneDespachante+'">'+'</span>'+
                                                    '</div>'+

                                                    '<div class="form-group">'+
                                                        '<label class="pt-2" style="float: left;">'+'E-mail: '+'</label>'+
                                                    '<span style="display: block; overflow: hidden; padding: 0 4px 0 6px;">'+
                                                    '<input style="width: 100%;" type="text" name="emailDespachante" class="form-control" autocomplete="off" placeholder="'+item.emailDespachante+'">'+'</span>'+
                                                    '</div>'+

                                                    '<div class="form-group">'+
                                                        '<label class="pt-2" style="float: left;">'+'Responsável: '+'</label>'+
                                                    '<span style="display: block; overflow: hidden; padding: 0 4px 0 6px;">'+
                                                    '<input style="width: 100%;" type="text" name="nomePrimeiroResponsavelDespachante" class="form-control" autocomplete="off" placeholder="'+item.nomePrimeiroResponsavelDespachante+'">'+'</span>'+
                                                    '</div>'+

                                                    '<div class="form-group">'+
                                                        '<label class="pt-2" style="float: left;">'+'Telefone/Responsável: '+'</label>'+
                                                    '<span style="display: block; overflow: hidden; padding: 0 4px 0 6px;">'+
                                                    '<input style="width: 100%;" type="text" name="telefonePrimeiroResponsavelDespachante" class="form-control telefoneCelular" autocomplete="off" placeholder="'+item.telefonePrimeiroResponsavelDespachante+'">'+'</span>'+
                                                    '</div>'+

                                                    '<div class="form-group">'+
                                                        '<label class="pt-2" style="float: left;">'+'E-mail/Responsável: '+'</label>'+
                                                    '<span style="display: block; overflow: hidden; padding: 0 4px 0 6px;">'+
                                                    '<input style="width: 100%;" type="text" name="emailPrimeiroResponsavelDespachante" class="form-control" autocomplete="off" placeholder="'+item.emailPrimeiroResponsavelDespachante+'">'+'</span>'+
                                                    '</div>'+
                                                    
                                                    '<div class="form-group">'+
                                                        '<label class="pt-2" style="float: left;">'+'Segundo Responsável: '+'</label>'+
                                                    '<span style="display: block; overflow: hidden; padding: 0 4px 0 6px;">'+
                                                    '<input style="width: 100%;" type="text" name="nomeSegundoResponsavelDespachante" class="form-control" autocomplete="off" placeholder="'+item.nomeSegundoResponsavelDespachante+'">'+'</span>'+
                                                    '</div>'+

                                                    '<div class="form-group">'+
                                                        '<label class="pt-2" style="float: left;">'+'Telefone/Segundo Responsável: '+'</label>'+
                                                    '<span style="display: block; overflow: hidden; padding: 0 4px 0 6px;">'+
                                                    '<input style="width: 100%;" type="text" name="telefoneSegundoResponsavelDespachante" class="form-control telefoneCelular" autocomplete="off" placeholder="'+item.telefoneSegundoResponsavelDespachante+'">'+'</span>'+
                                                    '</div>'+

                                                    '<div class="form-group">'+
                                                        '<label class="pt-2" style="float: left;">'+'E-mail/Segundo Responsável: '+'</label>'+
                                                    '<span style="display: block; overflow: hidden; padding: 0 4px 0 6px;">'+
                                                    '<input style="width: 100%;" type="text" name="emailSegundoResponsavelDespachante" class="form-control" autocomplete="off" placeholder="'+item.emailSegundoResponsavelDespachante+'">'+'</span>'+
                                                    '</div>'+

                                                    '<div class="form-group">'+
                                                        '<label class="pt-2" style="float: left;">'+'Terceiro Responsável: '+'</label>'+
                                                    '<span style="display: block; overflow: hidden; padding: 0 4px 0 6px;">'+
                                                    '<input style="width: 100%;" type="text" name="nomeTerceiroResponsavelDespachante" class="form-control" autocomplete="off" placeholder="'+item.nomeTerceiroResponsavelDespachante+'">'+'</span>'+
                                                    '</div>'+

                                                    '<div class="form-group">'+
                                                        '<label class="pt-2" style="float: left;">'+'Telefone/Terceiro Responsável: '+'</label>'+
                                                    '<span style="display: block; overflow: hidden; padding: 0 4px 0 6px;">'+
                                                    '<input style="width: 100%;" type="text" name="telefoneTerceiroResponsavelDespachante" class="form-control telefoneCelular" autocomplete="off" placeholder="'+item.telefoneTerceiroResponsavelDespachante+'">'+'</span>'+
                                                    '</div>'+

                                                    '<div class="form-group">'+
                                                        '<label class="pt-2" style="float: left;">'+'E-mail/Terceiro Responsável: '+'</label>'+
                                                    '<span style="display: block; overflow: hidden; padding: 0 4px 0 6px;">'+
                                                    '<input style="width: 100%;" type="text" name="emailTerceiroResponsavelDespachante" class="form-control" autocomplete="off" placeholder="'+item.emailTerceiroResponsavelDespachante+'">'+'</span>'+
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

$(linha).appendTo('#tblfornecedores>tbody');

// altera a data do form para formato em portugues
var data =$('#vencimento_contrato'+ item.idDespachante).text()
var novaData = data.replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1');
$('#vencimento_contrato'+item.idDespachante).text(novaData)

$(".telefoneComum").mask("(00) 0000-0000");
$(".cnpj").mask("99.999.999/9999-99");
$(".telefoneCelular").mask("(00) 00000-0000");

})
}).done(function() { 
    _formataDatatable();
    _formataData();
})
}
    $(".telefoneComum").mask("(00) 0000-0000");
    $(".cnpj").mask("99.999.999/9999-99");
    $(".telefoneCelular").mask("(00) 00000-0000");



//   $( function() {
//     $( "#datepicker" ).datepicker({
//         dateFormat: "dd/mm/yy"
//       });
//   } );


  setTimeout(function(){
    $('#fadeOut').fadeOut("slow");
    }, 3000);

// Cria botão adicionar responsável no formulario
$(document).ready(function(){
    $(".add-more").click(function(e){
        e.preventDefault();
 
        var newIn = '<div class="form-group">' + '<label>'+'Nome do segundo responsável'+'</label>'+
        '<input type="text" name="nomeSegundoResponsavelDespachante" autocomplete="off" class="form-control">'+'</div>'+
        '<div class="form-group">'+'<label>'+'Telefone do segundo responsável'+'</label>'+
        '<input type="text" name="telefoneSegundoResponsavelDespachante" autocomplete="off" class="form-control telefoneCelular" id="telefoneSegundoResponsavelDespachante" placeholder="(11) 99599-9696">'+'</div>'+
        '<div class="form-group">'+'<label>'+'E-mail do segundo responsável'+'</label>'+'<input type="email" name="emailSegundoResponsavelDespachante"  autocomplete="off" class="form-control" placeholder="exemplo@email.com.br">'+'</div>'+
        '<button id="b2" class="btn add-one-more" type="button" style="background: #4F94CD; color: white;">'+'adicionar novo responsável'+'</button>'


        $(newIn).appendTo('#field');
        $('#b1').css("background", "#708090")
        $("#field").prop('id', 'field2')

        $(".add-one-more").click(function(e){
        e.preventDefault();
        var newIn = '<div class="form-group">'+'<label>'+'Nome do terceiro responsável'+'</label>'+
                    '<input type="text" name="nomeTerceiroResponsavelDespachante" autocomplete="off" class="form-control">'+'</div>'+
                    '<div class="form-group">'+'<label>'+'Telefone do terceiro responsável'+'</label>'+
                    '<input type="text" name="telefoneTerceiroResponsavelDespachante" autocomplete="off" class="form-control telefoneCelular" id="telefoneTerceiroResponsavelDespachante" placeholder="(11) 99599-9696">'+'</div>'+
                    '<div class="form-group">'+'<label>'+'E-mail do terceiro responsável'+'</label>'+
                    '<input type="email" name="emailTerceiroResponsavelDespachante" autocomplete="off" class="form-control" placeholder="exemplo@email.com.br">'+'</div>' 

        $(newIn).appendTo('#field2');
        $('#b2').css("background", "#708090")
        $("#field2").prop('id', 'fim')})
    
    })
       
})   
