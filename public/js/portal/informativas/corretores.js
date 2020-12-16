var csrfVar = $('meta[name="csrf-token"]').attr('content');

function _formataDatatableComData (idTabela){
    $('#' + idTabela).DataTable({
        "order": [[ 0, "asc" ]],

       columnDefs: [
           {type: 'date-uk', targets: [6]} //vai filtrar a coluna com data dd/mm/yyyy
       ],

        "pageLength": 25,
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
}

$('#selectGILIE').change(function(){
    if ($(this).val() === "7257") {
        $('#tblBH').css('display', 'none');
        $('#tblBU').css('display', 'none');
        $('#tblBE').css('display', 'none');
        $('#tblBR').css('display', 'none');
        $('#tblCT').css('display', 'none');
        $('#tblFO').css('display', 'none');
        $('#tblGO').css('display', 'none');
        $('#tblPO').css('display', 'none');
        $('#tblRJ').css('display', 'none');
        $('#tblRE').css('display', 'none');
        $('#tblSA').css('display', 'none');
        $('#tblSP').css('display', 'block');
        $.getJSON('corretores/lista-corretores', function(dados){
            $.each(dados, function(key, item) {

                var corretores = item.CORRETOR
                var corretorFormatado = corretores.toUpperCase();

                var venc = Date.parse(item.VENCIMENTO)
                 
                let linha =
               
                    `<tr>
                        <td>${corretorFormatado}</td>
                        <td>${item.CRECI}</td>
                        <td style="white-space:nowrap;" id="telefone${item.CRECI}">(${item.DDDCELULAR})`+" "+`${item.TELEFONECELULAR}</td>
                        <td>${item.EMAIL}</td>
                        <td style="white-space:nowrap;"><button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalQualificacao${item.CRECI}">
                        ${item.qualificacao}</button>

                            <!-- Modal -->
                                <div class="modal fade" id="modalQualificacao${item.CRECI}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                        <h5 class="modal-title" style="color: white;" id="exampleModalLabel">Alterar tipo contrato</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="/corretores/qualifica-corretor">
                                    <input type="hidden" name="_token" value="${csrfVar}">
                                    <input type="hidden" name="cpfCorretor" value="${item.cpfCorretor}">
                                    <input type="hidden" name="nomeCorretor" value="${item.CORRETOR}">
                                    <input type="hidden" name="gilie" value="${item.GILIE}">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="formQualificacao${item.CRECI}">Qualificação</label>
                                            <select class="form-control" name="qualificacao" id="formQualificacao${item.CRECI}">
                                                <option value="Contratado" selected>Contratado</option>
                                                <option value="Pré-habilitado">Pré-habilitado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Alterar</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                     </form>  
                        </td>
                        
                        <td>
                        <!-- Modal e-mail-->
                        <div class="dropdown">
                            <span data-toggle="tooltip" data-placement="top" title="Enviar e-mail">
                       
                            <button class="btn btn-primary dropdown-toggle" type="button" id="botaoEmail${item.CRECI + item.GILIE}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-target="#modalDadosCorretor${item.cpfCorretor}"><i class="far fa-envelope"></i>
                            </button> ` + `
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" id="envCor${item.cpfCorretor}" type="button" data-toggle="modal" data-target="#enviarCorretor${item.cpfCorretor}"><i class="far fa-envelope"></i>&nbsp Enviar orientação Corretor</a>
                                <a class="dropdown-item" id="envCecot${item.cpfCorretor}" type="button" data-toggle="modal" data-target="#enviarCecot${item.cpfCorretor}"><i class="far fa-envelope"></i>&nbsp Enviar Área Caixa</a>
                            </div>
                        </div>

                            <!-- Modal enviar Corretor -->
                            <div class="modal fade" id="enviarCorretor${item.cpfCorretor}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirmação de envio</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form class="col-md-12" action="corretores/envia-email-corretor/${item.cpfCorretor}" method="POST">
                                        <input type="hidden" name="_token" value="${csrfVar}">
                                        <input type="hidden" name="gilie" value="${item.GILIE}">
                                            <div class="modal-body">
                                                Deseja enviar e-mail com orientações para efetivação de contratação ao corretor <strong>${corretorFormatado}</strong>? 
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Enviar</button>
                                            </div>
                                        
                                        </form>
                                    
                                    </div>
                                </div> 
                            </div>
                            
                            
                            <!-- Modal envia CECOT15 -->
                            <div class="modal fade" id="enviarCecot${item.cpfCorretor}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirmação de envio</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form class="col-md-12" action="corretores/envia-email-cecot/${item.cpfCorretor}" method="POST">
                                        <input type="hidden" name="_token" value="${csrfVar}">
                                        <input type="hidden" name="gilie" value="${item.GILIE}">
                                            <div class="modal-body">
                                                Deseja enviar e-mail de solicitação de cadastramento do corretor <strong>${corretorFormatado}</strong> para área gestora da Caixa? 
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Enviar</button>
                                            </div>
                                        
                                        </form>
                                    
                                    </div>
                                </div> 
                            </div>         


                        </td>    


                        <td>${item.VENCIMENTO}</td>

                       

                    </tr>`

                        $(linha).appendTo('#tblCorretores>tbody');

                        if(item.qualificacao == "Contratado"){
                            $('#botaoEmail' + item.CRECI + item.GILIE).remove()
                        }
                        
                        if($('#telefone' + item.CRECI).text() == "(null) null" ||
                        $('#telefone' + item.CRECI).text() == "(Null) Null"){
                        $('#telefone' + item.CRECI).text("")
                    }
                    
                    $('.editalVigente').text("EDITAL " + item.EDITAL);
            });
            _formataDatatableComData("tblCorretores")
            $('.spinnerTbl').remove()
            $('#tblCorretores').attr('id', 'tblCorretoresPopulada');
            $("[name='numeroEdital']").mask("0000/0000-0000");

        });

    }else if ($(this).val() === "7255") {
        $('#tblBH').css('display', 'none');
        $('#tblBU').css('display', 'none');
        $('#tblBE').css('display', 'none');
        $('#tblBR').css('display', 'none');
        $('#tblCT').css('display', 'none');
        $('#tblFO').css('display', 'none');
        $('#tblGO').css('display', 'none');
        $('#tblPO').css('display', 'none');
        $('#tblRJ').css('display', 'none');
        $('#tblRE').css('display', 'none');
        $('#tblSP').css('display', 'none');
        $('#tblSA').css('display', 'block');

        $.getJSON('corretores/lista-corretores-sa', function(dados){
            $.each(dados, function(key, item) {

                var corretores = item.CORRETOR
                var corretorFormatado = corretores.toUpperCase();

                let linha =
               
                    `<tr>
                        <td>${corretorFormatado}</td>
                        <td>${item.CRECI}</td>
                        <td style="white-space:nowrap;" id="telefone${item.CRECI}">(${item.DDDCELULAR})`+" "+`${item.TELEFONECELULAR}</td>
                        <td>${item.EMAIL}</td>
                        <td style="white-space:nowrap;"><button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalQualificacao${item.CRECI}">
                        ${item.qualificacao}</button>

                            <!-- Modal -->
                                <div class="modal fade" id="modalQualificacao${item.CRECI}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                        <h5 class="modal-title" style="color: white;" id="exampleModalLabel">Alterar tipo contrato</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="/corretores/qualifica-corretor">
                                    <input type="hidden" name="_token" value="${csrfVar}">
                                    <input type="hidden" name="cpfCorretor" value="${item.cpfCorretor}">
                                    <input type="hidden" name="nomeCorretor" value="${item.CORRETOR}">
                                    <input type="hidden" name="gilie" value="${item.GILIE}">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="formQualificacao${item.CRECI}">Qualificação</label>
                                            <select class="form-control" name="qualificacao" id="formQualificacao${item.CRECI}">
                                                <option value="Contratado" selected>Contratado</option>
                                                <option value="Pré-habilitado">Pré-habilitado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Alterar</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </form>  
                        </td>

                        <td>
                        <!-- Modal e-mail-->
                        <div class="dropdown">
                            <span data-toggle="tooltip" data-placement="top" title="Alter">
                       
                            <button class="btn btn-primary dropdown-toggle" type="button" id="botaoEmail${item.CRECI + item.GILIE}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-target="#modalDadosCorretor${item.cpfCorretor}"><i class="far fa-envelope"></i>
                            </button> ` + `
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" id="envCor${item.cpfCorretor}" type="button" data-toggle="modal" data-target="#enviarCorretor${item.cpfCorretor}"><i class="far fa-envelope"></i>&nbsp Enviar orientação Corretor</a>
                                <a class="dropdown-item" id="envCecot${item.cpfCorretor}" type="button" data-toggle="modal" data-target="#enviarCecot${item.cpfCorretor}"><i class="far fa-envelope"></i>&nbsp Enviar Área Caixa</a>
                            </div>
                        </div>

                            <!-- Modal enviar Corretor -->
                            <div class="modal fade" id="enviarCorretor${item.cpfCorretor}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirmação de envio</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form class="col-md-12" action="corretores/envia-email-corretor/${item.cpfCorretor}" method="POST">
                                        <input type="hidden" name="_token" value="${csrfVar}">
                                        <input type="hidden" name="gilie" value="${item.GILIE}">
                                            <div class="modal-body">
                                                Deseja enviar e-mail com orientações para efetivação de contratação ao corretor <strong>${corretorFormatado}</strong>? 
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Enviar</button>
                                            </div>
                                        
                                        </form>
                                    
                                    </div>
                                </div> 
                            </div>
                            
                            
                            <!-- Modal envia CECOT15 -->
                            <div class="modal fade" id="enviarCecot${item.cpfCorretor}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirmação de envio</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form class="col-md-12" action="corretores/envia-email-cecot/${item.cpfCorretor}" method="POST">
                                        <input type="hidden" name="_token" value="${csrfVar}">
                                        <input type="hidden" name="gilie" value="${item.GILIE}">
                                            <div class="modal-body">
                                                Deseja enviar e-mail de solicitação de cadastramento do corretor <strong>${corretorFormatado}</strong> para área gestora da Caixa? 
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Enviar</button>
                                            </div>
                                        
                                        </form>
                                    
                                    </div>
                                </div> 
                            </div>         


                        </td>    

                        <td>${item.VENCIMENTO}</td>
                    </tr>`
                        $(linha).appendTo('#tblCorretoresSA>tbody');

                        if(item.qualificacao == "Contratado"){
                            $('#botaoEmail' + item.CRECI + item.GILIE).remove()
                        }
                        
                        if($('#telefone' + item.CRECI).text() == "(null) null" ||
                        $('#telefone' + item.CRECI).text() == "(Null) Null"){
                        $('#telefone' + item.CRECI).text("")
                    }
                    $('.editalVigente').text("EDITAL " + item.EDITAL);
            });
            _formataDatatableComData("tblCorretoresSA")
            $('.spinnerTblSA').remove()
            $('#tblCorretoresSA').attr('id', 'tblCorretoresSAPopulada');
            $("[name='numeroEdital']").mask("0000/0000-0000");
        });
    }else if ($(this).val() === "7253") {
         $('#tblBH').css('display', 'none');
         $('#tblBU').css('display', 'none');
         $('#tblBE').css('display', 'none');
         $('#tblBR').css('display', 'none');
         $('#tblCT').css('display', 'none');
         $('#tblFO').css('display', 'none');
         $('#tblGO').css('display', 'none');
         $('#tblPO').css('display', 'none');
         $('#tblRJ').css('display', 'none');
         $('#tblSP').css('display', 'none');
         $('#tblSA').css('display', 'none');
         $('#tblRE').css('display', 'block');
        $.getJSON('corretores/lista-corretores-re', function(dados){
            $.each(dados, function(key, item) {

                var corretores = item.CORRETOR
                var corretorFormatado = corretores.toUpperCase();

                let linha =
               
                    `<tr>
                        <td>${corretorFormatado}</td>
                        <td>${item.CRECI}</td>
                        <td style="white-space:nowrap;" id="telefone${item.CRECI}">(${item.DDDCELULAR})`+" "+`${item.TELEFONECELULAR}</td>
                        <td>${item.EMAIL}</td>
                        <td style="white-space:nowrap;"><button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalQualificacao${item.CRECI}">
                        ${item.qualificacao}</button>

                            <!-- Modal -->
                                <div class="modal fade" id="modalQualificacao${item.CRECI}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                        <h5 class="modal-title" style="color: white;" id="exampleModalLabel">Alterar tipo contrato</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="/corretores/qualifica-corretor">
                                    <input type="hidden" name="_token" value="${csrfVar}">
                                    <input type="hidden" name="cpfCorretor" value="${item.cpfCorretor}">
                                    <input type="hidden" name="nomeCorretor" value="${item.CORRETOR}">
                                    <input type="hidden" name="gilie" value="${item.GILIE}">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="formQualificacao${item.CRECI}">Qualificação</label>
                                            <select class="form-control" name="qualificacao" id="formQualificacao${item.CRECI}">
                                                <option value="Contratado" selected>Contratado</option>
                                                <option value="Pré-habilitado">Pré-habilitado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Alterar</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </form>  
                        </td>

                        <td>
                        <!-- Modal e-mail-->
                        <div class="dropdown">
                            <span data-toggle="tooltip" data-placement="top" title="Alter">
                       
                            <button class="btn btn-primary dropdown-toggle" type="button" id="botaoEmail${item.CRECI + item.GILIE}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-target="#modalDadosCorretor${item.cpfCorretor}"><i class="far fa-envelope"></i>
                            </button> ` + `
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" id="envCor${item.cpfCorretor}" type="button" data-toggle="modal" data-target="#enviarCorretor${item.cpfCorretor}"><i class="far fa-envelope"></i>&nbsp Enviar orientação Corretor</a>
                                <a class="dropdown-item" id="envCecot${item.cpfCorretor}" type="button" data-toggle="modal" data-target="#enviarCecot${item.cpfCorretor}"><i class="far fa-envelope"></i>&nbsp Enviar Área Caixa</a>
                            </div>
                        </div>

                            <!-- Modal enviar Corretor -->
                            <div class="modal fade" id="enviarCorretor${item.cpfCorretor}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirmação de envio</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form class="col-md-12" action="corretores/envia-email-corretor/${item.cpfCorretor}" method="POST">
                                        <input type="hidden" name="_token" value="${csrfVar}">
                                        <input type="hidden" name="gilie" value="${item.GILIE}">
                                            <div class="modal-body">
                                                Deseja enviar e-mail com orientações para efetivação de contratação ao corretor <strong>${corretorFormatado}</strong>? 
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Enviar</button>
                                            </div>
                                        
                                        </form>
                                    
                                    </div>
                                </div> 
                            </div>
                            
                            
                            <!-- Modal envia CECOT15 -->
                            <div class="modal fade" id="enviarCecot${item.cpfCorretor}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirmação de envio</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form class="col-md-12" action="corretores/envia-email-cecot/${item.cpfCorretor}" method="POST">
                                        <input type="hidden" name="_token" value="${csrfVar}">
                                        <input type="hidden" name="gilie" value="${item.GILIE}">
                                            <div class="modal-body">
                                                Deseja enviar e-mail de solicitação de cadastramento do corretor <strong>${corretorFormatado}</strong> para área gestora da Caixa? 
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Enviar</button>
                                            </div>
                                        
                                        </form>
                                    
                                    </div>
                                </div> 
                            </div>         


                        </td>    

                        <td>${item.VENCIMENTO}</td>
                    </tr>`
                        $(linha).appendTo('#tblCorretoresRE>tbody');

                        
                        if(item.qualificacao == "Contratado"){
                            $('#botaoEmail' + item.CRECI + item.GILIE).remove()
                        }
                        
                        if($('#telefone' + item.CRECI).text() == "(null) null" ||
                        $('#telefone' + item.CRECI).text() == "(Null) Null"){
                        $('#telefone' + item.CRECI).text("")
                    }
                    $('.editalVigente').text("EDITAL " + item.EDITAL);
            });
            _formataDatatableComData("tblCorretoresRE")
            $('.spinnerTblRE').remove()
            $('#tblCorretoresRE').attr('id', 'tblCorretoresREPopulada');
            $("[name='numeroEdital']").mask("0000/0000-0000");
        });
    }else if ($(this).val() === "7254") {
        $('#tblBH').css('display', 'none');
        $('#tblBU').css('display', 'none');
        $('#tblBE').css('display', 'none');
        $('#tblBR').css('display', 'none');
        $('#tblCT').css('display', 'none');
        $('#tblFO').css('display', 'none');
        $('#tblGO').css('display', 'none');
        $('#tblPO').css('display', 'none');
        $('#tblSP').css('display', 'none');
        $('#tblSA').css('display', 'none');
        $('#tblRE').css('display', 'none');
        $('#tblRJ').css('display', 'block');
       $.getJSON('corretores/lista-corretores-rj', function(dados){
           $.each(dados, function(key, item) {

            var corretores = item.CORRETOR
            var corretorFormatado = corretores.toUpperCase();

            let linha =
           
                `<tr>
                    <td>${corretorFormatado}</td>
                       <td>${item.CRECI}</td>
                       <td style="white-space:nowrap;" id="telefone${item.CRECI}">(${item.DDDCELULAR})`+" "+`${item.TELEFONECELULAR}</td>
                       <td>${item.EMAIL}</td>
                       <td style="white-space:nowrap;"><button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalQualificacao${item.CRECI}">
                       ${item.qualificacao}</button>

                           <!-- Modal -->
                               <div class="modal fade" id="modalQualificacao${item.CRECI}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog">
                                   <div class="modal-content">
                                   <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                       <h5 class="modal-title" style="color: white;" id="exampleModalLabel">Alterar tipo contrato</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                   </div>
                                   <form method="post" action="/corretores/qualifica-corretor">
                                   <input type="hidden" name="_token" value="${csrfVar}">
                                   <input type="hidden" name="cpfCorretor" value="${item.cpfCorretor}">
                                   <input type="hidden" name="nomeCorretor" value="${item.CORRETOR}">
                                   <input type="hidden" name="gilie" value="${item.GILIE}">
                                   <div class="modal-body">
                                       <div class="form-group">
                                           <label for="formQualificacao${item.CRECI}">Qualificação</label>
                                           <select class="form-control" name="qualificacao" id="formQualificacao${item.CRECI}">
                                               <option value="Contratado" selected>Contratado</option>
                                               <option value="Pré-habilitado">Pré-habilitado</option>
                                           </select>
                                       </div>
                                   </div>
                                   <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                       <button type="submit" class="btn btn-primary">Alterar</button>
                                   </div>
                                   </div>
                               </div>
                               </div>
                           </form>  
                       </td>
                        
                       <td>
                       <!-- Modal e-mail-->
                        <div class="dropdown">
                            <span data-toggle="tooltip" data-placement="top" title="Alter">
                       
                            <button class="btn btn-primary dropdown-toggle" type="button" id="botaoEmail${item.CRECI + item.GILIE}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-target="#modalDadosCorretor${item.cpfCorretor}"><i class="far fa-envelope"></i>
                            </button> ` + `
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" id="envCor${item.cpfCorretor}" type="button" data-toggle="modal" data-target="#enviarCorretor${item.cpfCorretor}"><i class="far fa-envelope"></i>&nbsp Enviar orientação Corretor</a>
                                <a class="dropdown-item" id="envCecot${item.cpfCorretor}" type="button" data-toggle="modal" data-target="#enviarCecot${item.cpfCorretor}"><i class="far fa-envelope"></i>&nbsp Enviar Área Caixa</a>
                            </div>
                        </div>

                            <!-- Modal enviar Corretor -->
                            <div class="modal fade" id="enviarCorretor${item.cpfCorretor}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirmação de envio</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form class="col-md-12" action="corretores/envia-email-corretor/${item.cpfCorretor}" method="POST">
                                        <input type="hidden" name="_token" value="${csrfVar}">
                                        <input type="hidden" name="gilie" value="${item.GILIE}">
                                            <div class="modal-body">
                                                Deseja enviar e-mail com orientações para efetivação de contratação ao corretor <strong>${corretorFormatado}</strong>? 
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Enviar</button>
                                            </div>
                                        
                                        </form>
                                    
                                    </div>
                                </div> 
                            </div>
                            
                            
                            <!-- Modal envia CECOT15 -->
                            <div class="modal fade" id="enviarCecot${item.cpfCorretor}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirmação de envio</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form class="col-md-12" action="corretores/envia-email-cecot/${item.cpfCorretor}" method="POST">
                                        <input type="hidden" name="_token" value="${csrfVar}">
                                        <input type="hidden" name="gilie" value="${item.GILIE}">
                                            <div class="modal-body">
                                                Deseja enviar e-mail de solicitação de cadastramento do corretor <strong>${corretorFormatado}</strong> para área gestora da Caixa? 
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Enviar</button>
                                            </div>
                                        
                                        </form>
                                    
                                    </div>
                                </div> 
                            </div>         


                        </td>    

                       <td>${item.VENCIMENTO}</td>
                   </tr>`
                       $(linha).appendTo('#tblCorretoresRJ>tbody');

                       if(item.qualificacao == "Contratado"){
                        $('#botaoEmail' + item.CRECI + item.GILIE).remove()
                    }
                       
                       if($('#telefone' + item.CRECI).text() == "(null) null" ||
                       $('#telefone' + item.CRECI).text() == "(Null) Null"){
                       $('#telefone' + item.CRECI).text("")
                   }
                   $('.editalVigente').text("EDITAL " + item.EDITAL);
           });
           _formataDatatableComData("tblCorretoresRJ")
           $('.spinnerTblRJ').remove()
           $('#tblCorretoresRJ').attr('id', 'tblCorretoresRJPopulada');
           $("[name='numeroEdital']").mask("0000/0000-0000");
       });
    }else if ($(this).val() === "7251") {
        $('#tblBH').css('display', 'none');
        $('#tblBU').css('display', 'none');
        $('#tblBE').css('display', 'none');
        $('#tblBR').css('display', 'none');
        $('#tblCT').css('display', 'none');
        $('#tblFO').css('display', 'none');
        $('#tblGO').css('display', 'none');
        $('#tblSP').css('display', 'none');
        $('#tblSA').css('display', 'none');
        $('#tblRE').css('display', 'none');
        $('#tblRJ').css('display', 'none');
        $('#tblPO').css('display', 'block');
       $.getJSON('corretores/lista-corretores-po', function(dados){
           $.each(dados, function(key, item) {

                var corretores = item.CORRETOR
                var corretorFormatado = corretores.toUpperCase();

                let linha =
               
                    `<tr>
                        <td>${corretorFormatado}</td>
                       <td>${item.CRECI}</td>
                       <td style="white-space:nowrap;" id="telefone${item.CRECI}">(${item.DDDCELULAR})`+" "+`${item.TELEFONECELULAR}</td>
                       <td>${item.EMAIL}</td>
                       <td style="white-space:nowrap;"><button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalQualificacao${item.CRECI}">
                       ${item.qualificacao}</button>

                           <!-- Modal -->
                               <div class="modal fade" id="modalQualificacao${item.CRECI}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog">
                                   <div class="modal-content">
                                   <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                       <h5 class="modal-title" style="color: white;" id="exampleModalLabel">Alterar tipo contrato</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                   </div>
                                   <form method="post" action="/corretores/qualifica-corretor">
                                   <input type="hidden" name="_token" value="${csrfVar}">
                                   <input type="hidden" name="cpfCorretor" value="${item.cpfCorretor}">
                                   <input type="hidden" name="nomeCorretor" value="${item.CORRETOR}">
                                   <input type="hidden" name="gilie" value="${item.GILIE}">
                                   <div class="modal-body">
                                       <div class="form-group">
                                           <label for="formQualificacao${item.CRECI}">Qualificação</label>
                                           <select class="form-control" name="qualificacao" id="formQualificacao${item.CRECI}">
                                               <option value="Contratado" selected>Contratado</option>
                                               <option value="Pré-habilitado">Pré-habilitado</option>
                                           </select>
                                       </div>
                                   </div>
                                   <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                       <button type="submit" class="btn btn-primary">Alterar</button>
                                   </div>
                                   </div>
                               </div>
                               </div>
                           </form>  
                       </td>
                                               
                       <td>
                       <!-- Modal e-mail-->
                        <div class="dropdown">
                            <span data-toggle="tooltip" data-placement="top" title="Alter">
                       
                            <button class="btn btn-primary dropdown-toggle" type="button" id="botaoEmail${item.CRECI + item.GILIE}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-target="#modalDadosCorretor${item.cpfCorretor}"><i class="far fa-envelope"></i>
                            </button> ` + `
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" id="envCor${item.cpfCorretor}" type="button" data-toggle="modal" data-target="#enviarCorretor${item.cpfCorretor}"><i class="far fa-envelope"></i>&nbsp Enviar orientação Corretor</a>
                                <a class="dropdown-item" id="envCecot${item.cpfCorretor}" type="button" data-toggle="modal" data-target="#enviarCecot${item.cpfCorretor}"><i class="far fa-envelope"></i>&nbsp Enviar Área Caixa</a>
                            </div>
                        </div>

                            <!-- Modal enviar Corretor -->
                            <div class="modal fade" id="enviarCorretor${item.cpfCorretor}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirmação de envio</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form class="col-md-12" action="corretores/envia-email-corretor/${item.cpfCorretor}" method="POST">
                                        <input type="hidden" name="_token" value="${csrfVar}">
                                        <input type="hidden" name="gilie" value="${item.GILIE}">
                                            <div class="modal-body">
                                                Deseja enviar e-mail com orientações para efetivação de contratação ao corretor <strong>${corretorFormatado}</strong>? 
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Enviar</button>
                                            </div>
                                        
                                        </form>
                                    
                                    </div>
                                </div> 
                            </div>
                            
                            
                            <!-- Modal envia CECOT15 -->
                            <div class="modal fade" id="enviarCecot${item.cpfCorretor}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirmação de envio</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form class="col-md-12" action="corretores/envia-email-cecot/${item.cpfCorretor}" method="POST">
                                        <input type="hidden" name="_token" value="${csrfVar}">
                                        <input type="hidden" name="gilie" value="${item.GILIE}">
                                            <div class="modal-body">
                                                Deseja enviar e-mail de solicitação de cadastramento do corretor <strong>${corretorFormatado}</strong> para área gestora da Caixa? 
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Enviar</button>
                                            </div>
                                        
                                        </form>
                                    
                                    </div>
                                </div> 
                            </div>         


                        </td>    

                       <td>${item.VENCIMENTO}</td>
                   </tr>`
                       $(linha).appendTo('#tblCorretoresPO>tbody');
                       
                       if(item.qualificacao == "Contratado"){
                        $('#botaoEmail' + item.CRECI + item.GILIE).remove()
                    }

                       if($('#telefone' + item.CRECI).text() == "(null) null" ||
                       $('#telefone' + item.CRECI).text() == "(Null) Null"){
                       $('#telefone' + item.CRECI).text("")
                   }
                   $('.editalVigente').text("EDITAL " + item.EDITAL);
           });
           _formataDatatableComData("tblCorretoresPO")
           $('.spinnerTblPO').remove()
           $('#tblCorretoresPO').attr('id', 'tblCorretoresPOPopulada');
           $("[name='numeroEdital']").mask("0000/0000-0000");
       });
    }else if ($(this).val() === "7249") {
        $('#tblBH').css('display', 'none');
        $('#tblBU').css('display', 'none');
        $('#tblBE').css('display', 'none');
        $('#tblBR').css('display', 'none');
        $('#tblCT').css('display', 'none');
        $('#tblFO').css('display', 'none');
        $('#tblSP').css('display', 'none');
        $('#tblSA').css('display', 'none');
        $('#tblRE').css('display', 'none');
        $('#tblRJ').css('display', 'none');
        $('#tblPO').css('display', 'none');
        $('#tblGO').css('display', 'block');
       $.getJSON('corretores/lista-corretores-go', function(dados){
           $.each(dados, function(key, item) {

            var corretores = item.CORRETOR
            var corretorFormatado = corretores.toUpperCase();

            let linha =
           
                `<tr>
                    <td>${corretorFormatado}</td>
                       <td>${item.CRECI}</td>
                       <td style="white-space:nowrap;" id="telefone${item.CRECI}">(${item.DDDCELULAR})`+" "+`${item.TELEFONECELULAR}</td>
                       <td>${item.EMAIL}</td>
                       <td style="white-space:nowrap;"><button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalQualificacao${item.CRECI}">
                       ${item.qualificacao}</button>

                           <!-- Modal -->
                               <div class="modal fade" id="modalQualificacao${item.CRECI}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog">
                                   <div class="modal-content">
                                   <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                       <h5 class="modal-title" style="color: white;" id="exampleModalLabel">Alterar tipo contrato</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                   </div>
                                   <form method="post" action="/corretores/qualifica-corretor">
                                   <input type="hidden" name="_token" value="${csrfVar}">
                                   <input type="hidden" name="cpfCorretor" value="${item.cpfCorretor}">
                                   <input type="hidden" name="nomeCorretor" value="${item.CORRETOR}">
                                   <input type="hidden" name="gilie" value="${item.GILIE}">
                                   <div class="modal-body">
                                       <div class="form-group">
                                           <label for="formQualificacao${item.CRECI}">Qualificação</label>
                                           <select class="form-control" name="qualificacao" id="formQualificacao${item.CRECI}">
                                               <option value="Contratado" selected>Contratado</option>
                                               <option value="Pré-habilitado">Pré-habilitado</option>
                                           </select>
                                       </div>
                                   </div>
                                   <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                       <button type="submit" class="btn btn-primary">Alterar</button>
                                   </div>
                                   </div>
                               </div>
                               </div>
                           </form>  
                       </td>
                                                                      
                       <td>
                       <!-- Modal e-mail-->
                        <div class="dropdown">
                            <span data-toggle="tooltip" data-placement="top" title="Alter">
                       
                            <button class="btn btn-primary dropdown-toggle" type="button" id="botaoEmail${item.CRECI + item.GILIE}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-target="#modalDadosCorretor${item.cpfCorretor}"><i class="far fa-envelope"></i>
                            </button> ` + `
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" id="envCor${item.cpfCorretor}" type="button" data-toggle="modal" data-target="#enviarCorretor${item.cpfCorretor}"><i class="far fa-envelope"></i>&nbsp Enviar orientação Corretor</a>
                                <a class="dropdown-item" id="envCecot${item.cpfCorretor}" type="button" data-toggle="modal" data-target="#enviarCecot${item.cpfCorretor}"><i class="far fa-envelope"></i>&nbsp Enviar Área Caixa</a>
                            </div>
                        </div>

                            <!-- Modal enviar Corretor -->
                            <div class="modal fade" id="enviarCorretor${item.cpfCorretor}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirmação de envio</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form class="col-md-12" action="corretores/envia-email-corretor/${item.cpfCorretor}" method="POST">
                                        <input type="hidden" name="_token" value="${csrfVar}">
                                        <input type="hidden" name="gilie" value="${item.GILIE}">
                                            <div class="modal-body">
                                                Deseja enviar e-mail com orientações para efetivação de contratação ao corretor <strong>${corretorFormatado}</strong>? 
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Enviar</button>
                                            </div>
                                        
                                        </form>
                                    
                                    </div>
                                </div> 
                            </div>
                            
                            
                            <!-- Modal envia CECOT15 -->
                            <div class="modal fade" id="enviarCecot${item.cpfCorretor}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirmação de envio</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form class="col-md-12" action="corretores/envia-email-cecot/${item.cpfCorretor}" method="POST">
                                        <input type="hidden" name="_token" value="${csrfVar}">
                                        <input type="hidden" name="gilie" value="${item.GILIE}">
                                            <div class="modal-body">
                                                Deseja enviar e-mail de solicitação de cadastramento do corretor <strong>${corretorFormatado}</strong> para área gestora da Caixa? 
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Enviar</button>
                                            </div>
                                        
                                        </form>
                                    
                                    </div>
                                </div> 
                            </div>         


                        </td>    

                       <td>${item.VENCIMENTO}</td>
                   </tr>`
                       $(linha).appendTo('#tblCorretoresGO>tbody');

                       if(item.qualificacao == "Contratado"){
                        $('#botaoEmail' + item.CRECI + item.GILIE).remove()
                    }
                       
                       if($('#telefone' + item.CRECI).text() == "(null) null" ||
                       $('#telefone' + item.CRECI).text() == "(Null) Null"){
                       $('#telefone' + item.CRECI).text("")
                   }
                   $('.editalVigente').text("EDITAL " + item.EDITAL);
           });
           _formataDatatableComData("tblCorretoresGO")
           $('.spinnerTblGO').remove()
           $('#tblCorretoresGO').attr('id', 'tblCorretoresGOPopulada');
           $("[name='numeroEdital']").mask("0000/0000-0000");
       });
    }else if ($(this).val() === "7248") {
        $('#tblBH').css('display', 'none');
        $('#tblBU').css('display', 'none');
        $('#tblBE').css('display', 'none');
        $('#tblBR').css('display', 'none');
        $('#tblCT').css('display', 'none');
        $('#tblSP').css('display', 'none');
        $('#tblSA').css('display', 'none');
        $('#tblRE').css('display', 'none');
        $('#tblRJ').css('display', 'none');
        $('#tblPO').css('display', 'none');
        $('#tblGO').css('display', 'none');
        $('#tblFO').css('display', 'block');
       $.getJSON('corretores/lista-corretores-fo', function(dados){
           $.each(dados, function(key, item) {
    
            var corretores = item.CORRETOR
            var corretorFormatado = corretores.toUpperCase();

            let linha =
           
                `<tr>
                    <td>${corretorFormatado}</td>
                       <td>${item.CRECI}</td>
                       <td style="white-space:nowrap;" id="telefone${item.CRECI}">(${item.DDDCELULAR})`+" "+`${item.TELEFONECELULAR}</td>
                       <td>${item.EMAIL}</td>
                       <td style="white-space:nowrap;"><button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalQualificacao${item.CRECI}">
                       ${item.qualificacao}</button>

                           <!-- Modal -->
                               <div class="modal fade" id="modalQualificacao${item.CRECI}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog">
                                   <div class="modal-content">
                                   <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                       <h5 class="modal-title" style="color: white;" id="exampleModalLabel">Alterar tipo contrato</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                   </div>
                                   <form method="post" action="/corretores/qualifica-corretor">
                                   <input type="hidden" name="_token" value="${csrfVar}">
                                   <input type="hidden" name="cpfCorretor" value="${item.cpfCorretor}">
                                   <input type="hidden" name="nomeCorretor" value="${item.CORRETOR}">
                                   <input type="hidden" name="gilie" value="${item.GILIE}">
                                   <div class="modal-body">
                                       <div class="form-group">
                                           <label for="formQualificacao${item.CRECI}">Qualificação</label>
                                           <select class="form-control" name="qualificacao" id="formQualificacao${item.CRECI}">
                                               <option value="Contratado" selected>Contratado</option>
                                               <option value="Pré-habilitado">Pré-habilitado</option>
                                           </select>
                                       </div>
                                   </div>
                                   <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                       <button type="submit" class="btn btn-primary">Alterar</button>
                                   </div>
                                   </div>
                               </div>
                               </div>
                           </form>  
                       </td>
                       
                      <td>                   
                      <!-- Modal e-mail-->
                        <div class="dropdown">
                            <span data-toggle="tooltip" data-placement="top" title="Alter">
                       
                            <button class="btn btn-primary dropdown-toggle" type="button" id="botaoEmail${item.CRECI + item.GILIE}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-target="#modalDadosCorretor${item.cpfCorretor}"><i class="far fa-envelope"></i>
                            </button> ` + `
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" id="envCor${item.cpfCorretor}" type="button" data-toggle="modal" data-target="#enviarCorretor${item.cpfCorretor}"><i class="far fa-envelope"></i>&nbsp Enviar orientação Corretor</a>
                                <a class="dropdown-item" id="envCecot${item.cpfCorretor}" type="button" data-toggle="modal" data-target="#enviarCecot${item.cpfCorretor}"><i class="far fa-envelope"></i>&nbsp Enviar Área Caixa</a>
                            </div>
                        </div>

                            <!-- Modal enviar Corretor -->
                            <div class="modal fade" id="enviarCorretor${item.cpfCorretor}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirmação de envio</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form class="col-md-12" action="corretores/envia-email-corretor/${item.cpfCorretor}" method="POST">
                                        <input type="hidden" name="_token" value="${csrfVar}">
                                        <input type="hidden" name="gilie" value="${item.GILIE}">
                                            <div class="modal-body">
                                                Deseja enviar e-mail com orientações para efetivação de contratação ao corretor <strong>${corretorFormatado}</strong>? 
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Enviar</button>
                                            </div>
                                        
                                        </form>
                                    
                                    </div>
                                </div> 
                            </div>
                            
                            
                            <!-- Modal envia CECOT15 -->
                            <div class="modal fade" id="enviarCecot${item.cpfCorretor}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirmação de envio</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form class="col-md-12" action="corretores/envia-email-cecot/${item.cpfCorretor}" method="POST">
                                        <input type="hidden" name="_token" value="${csrfVar}">
                                        <input type="hidden" name="gilie" value="${item.GILIE}">
                                            <div class="modal-body">
                                                Deseja enviar e-mail de solicitação de cadastramento do corretor <strong>${corretorFormatado}</strong> para área gestora da Caixa? 
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Enviar</button>
                                            </div>
                                        
                                        </form>
                                    
                                    </div>
                                </div> 
                            </div>         


                        </td>    

                       <td>${item.VENCIMENTO}</td>
                   </tr>`
                       $(linha).appendTo('#tblCorretoresFO>tbody');

                       if(item.qualificacao == "Contratado"){
                        $('#botaoEmail' + item.CRECI + item.GILIE).remove()
                    }
                       
                       if($('#telefone' + item.CRECI).text() == "(null) null" ||
                       $('#telefone' + item.CRECI).text() == "(Null) Null"){
                       $('#telefone' + item.CRECI).text("")
                   }
                   $('.editalVigente').text("EDITAL " + item.EDITAL);
           });
           _formataDatatableComData("tblCorretoresFO")
           $('.spinnerTblFO').remove()
           $('#tblCorretoresFO').attr('id', 'tblCorretoresFOPopulada');
           $("[name='numeroEdital']").mask("0000/0000-0000");
       });
 }else if ($(this).val() === "7247") {
        $('#tblBH').css('display', 'none');
        $('#tblBU').css('display', 'none');
        $('#tblBE').css('display', 'none');
        $('#tblBR').css('display', 'none');
        $('#tblSP').css('display', 'none');
        $('#tblSA').css('display', 'none');
        $('#tblRE').css('display', 'none');
        $('#tblRJ').css('display', 'none');
        $('#tblPO').css('display', 'none');
        $('#tblGO').css('display', 'none');
        $('#tblFO').css('display', 'none');
        $('#tblCT').css('display', 'block');
       $.getJSON('corretores/lista-corretores-ct', function(dados){
           $.each(dados, function(key, item) {

            var corretores = item.CORRETOR
            var corretorFormatado = corretores.toUpperCase();

            let linha =
           
                `<tr>
                    <td>${corretorFormatado}</td>
                       <td>${item.CRECI}</td>
                       <td style="white-space:nowrap;" id="telefone${item.CRECI}">(${item.DDDCELULAR})`+" "+`${item.TELEFONECELULAR}</td>
                       <td>${item.EMAIL}</td>
                       <td style="white-space:nowrap;"><button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalQualificacao${item.CRECI}">
                       ${item.qualificacao}</button>

                           <!-- Modal -->
                               <div class="modal fade" id="modalQualificacao${item.CRECI}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog">
                                   <div class="modal-content">
                                   <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                       <h5 class="modal-title" style="color: white;" id="exampleModalLabel">Alterar tipo contrato</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                   </div>
                                   <form method="post" action="/corretores/qualifica-corretor">
                                   <input type="hidden" name="_token" value="${csrfVar}">
                                   <input type="hidden" name="cpfCorretor" value="${item.cpfCorretor}">
                                   <input type="hidden" name="nomeCorretor" value="${item.CORRETOR}">
                                   <input type="hidden" name="gilie" value="${item.GILIE}">
                                   <div class="modal-body">
                                       <div class="form-group">
                                           <label for="formQualificacao${item.CRECI}">Qualificação</label>
                                           <select class="form-control" name="qualificacao" id="formQualificacao${item.CRECI}">
                                               <option value="Contratado" selected>Contratado</option>
                                               <option value="Pré-habilitado">Pré-habilitado</option>
                                           </select>
                                       </div>
                                   </div>
                                   <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                       <button type="submit" class="btn btn-primary">Alterar</button>
                                   </div>
                                   </div>
                               </div>
                               </div>
                           </form>  
                       </td>
                       <td>                    
                       <!-- Modal e-mail-->
                       <div class="dropdown">
                           <span data-toggle="tooltip" data-placement="top" title="Alter">
                      
                           <button class="btn btn-primary dropdown-toggle" type="button" id="botaoEmail${item.CRECI + item.GILIE}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-target="#modalDadosCorretor${item.cpfCorretor}"><i class="far fa-envelope"></i>
                           </button> ` + `
                           <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                               <a class="dropdown-item" id="envCor${item.cpfCorretor}" type="button" data-toggle="modal" data-target="#enviarCorretor${item.cpfCorretor}"><i class="far fa-envelope"></i>&nbsp Enviar orientação Corretor</a>
                               <a class="dropdown-item" id="envCecot${item.cpfCorretor}" type="button" data-toggle="modal" data-target="#enviarCecot${item.cpfCorretor}"><i class="far fa-envelope"></i>&nbsp Enviar Área Caixa</a>
                           </div>
                       </div>

                           <!-- Modal enviar Corretor -->
                           <div class="modal fade" id="enviarCorretor${item.cpfCorretor}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <h5 class="modal-title">Confirmação de envio</h5>
                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                           <span aria-hidden="true">&times;</span>
                                           </button>
                                       </div>

                                       <form class="col-md-12" action="corretores/envia-email-corretor/${item.cpfCorretor}" method="POST">
                                       <input type="hidden" name="_token" value="${csrfVar}">
                                       <input type="hidden" name="gilie" value="${item.GILIE}">
                                           <div class="modal-body">
                                               Deseja enviar e-mail com orientações para efetivação de contratação ao corretor <strong>${corretorFormatado}</strong>? 
                                           </div>

                                           <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                               <button type="submit" class="btn btn-primary">Enviar</button>
                                           </div>
                                       
                                       </form>
                                   
                                   </div>
                               </div> 
                           </div>
                           
                           
                           <!-- Modal envia CECOT15 -->
                           <div class="modal fade" id="enviarCecot${item.cpfCorretor}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <h5 class="modal-title">Confirmação de envio</h5>
                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                           <span aria-hidden="true">&times;</span>
                                           </button>
                                       </div>

                                       <form class="col-md-12" action="corretores/envia-email-cecot/${item.cpfCorretor}" method="POST">
                                       <input type="hidden" name="_token" value="${csrfVar}">
                                       <input type="hidden" name="gilie" value="${item.GILIE}">
                                           <div class="modal-body">
                                               Deseja enviar e-mail de solicitação de cadastramento do corretor <strong>${corretorFormatado}</strong> para área gestora da Caixa? 
                                           </div>

                                           <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                               <button type="submit" class="btn btn-primary">Enviar</button>
                                           </div>
                                       
                                       </form>
                                   
                                   </div>
                               </div> 
                           </div>         


                       </td>    
                       <td>${item.VENCIMENTO}</td>
                   </tr>`
                       $(linha).appendTo('#tblCorretoresCT>tbody');

                       if(item.qualificacao == "Contratado"){
                        $('#botaoEmail' + item.CRECI + item.GILIE).remove()
                    }
                       
                       if($('#telefone' + item.CRECI).text() == "(null) null" ||
                       $('#telefone' + item.CRECI).text() == "(Null) Null"){
                       $('#telefone' + item.CRECI).text("")
                   }
                   $('.editalVigente').text("EDITAL " + item.EDITAL);
           });
           _formataDatatableComData("tblCorretoresCT")
           $('.spinnerTblCT').remove()
           $('#tblCorretoresCT').attr('id', 'tblCorretoresCTPopulada');
           $("[name='numeroEdital']").mask("0000/0000-0000");
       });
    }else if ($(this).val() === "7109") {
        $('#tblBH').css('display', 'none');
        $('#tblBU').css('display', 'none');
        $('#tblBE').css('display', 'none');
        $('#tblSP').css('display', 'none');
        $('#tblSA').css('display', 'none');
        $('#tblRE').css('display', 'none');
        $('#tblRJ').css('display', 'none');
        $('#tblPO').css('display', 'none');
        $('#tblGO').css('display', 'none');
        $('#tblFO').css('display', 'none');
        $('#tblCT').css('display', 'none');
        $('#tblBR').css('display', 'block');
       $.getJSON('corretores/lista-corretores-br', function(dados){
           $.each(dados, function(key, item) {
 
            var corretores = item.CORRETOR
            var corretorFormatado = corretores.toUpperCase();

            let linha =
           
                `<tr>
                        <td>${corretorFormatado}</td>
                       <td>${item.CRECI}</td>
                       <td style="white-space:nowrap;" id="telefone${item.CRECI}">(${item.DDDCELULAR})`+" "+`${item.TELEFONECELULAR}</td>
                       <td>${item.EMAIL}</td>
                       <td style="white-space:nowrap;"><button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalQualificacao${item.CRECI}">
                       ${item.qualificacao}</button>

                           <!-- Modal -->
                               <div class="modal fade" id="modalQualificacao${item.CRECI}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog">
                                   <div class="modal-content">
                                   <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                       <h5 class="modal-title" style="color: white;" id="exampleModalLabel">Alterar tipo contrato</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                   </div>
                                   <form method="post" action="/corretores/qualifica-corretor">
                                   <input type="hidden" name="_token" value="${csrfVar}">
                                   <input type="hidden" name="cpfCorretor" value="${item.cpfCorretor}">
                                   <input type="hidden" name="nomeCorretor" value="${item.CORRETOR}">
                                   <input type="hidden" name="gilie" value="${item.GILIE}">
                                   <div class="modal-body">
                                       <div class="form-group">
                                           <label for="formQualificacao${item.CRECI}">Qualificação</label>
                                           <select class="form-control" name="qualificacao" id="formQualificacao${item.CRECI}">
                                               <option value="Contratado" selected>Contratado</option>
                                               <option value="Pré-habilitado">Pré-habilitado</option>
                                           </select>
                                       </div>
                                   </div>
                                   <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                       <button type="submit" class="btn btn-primary">Alterar</button>
                                   </div>
                                   </div>
                               </div>
                               </div>
                           </form>  
                       </td>
                       <td>                 
                       <!-- Modal e-mail-->
                       <div class="dropdown">
                           <span data-toggle="tooltip" data-placement="top" title="Alter">
                      
                           <button class="btn btn-primary dropdown-toggle" type="button" id="botaoEmail${item.CRECI + item.GILIE}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-target="#modalDadosCorretor${item.cpfCorretor}"><i class="far fa-envelope"></i>
                           </button> ` + `
                           <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                               <a class="dropdown-item" id="envCor${item.cpfCorretor}" type="button" data-toggle="modal" data-target="#enviarCorretor${item.cpfCorretor}"><i class="far fa-envelope"></i>&nbsp Enviar orientação Corretor</a>
                               <a class="dropdown-item" id="envCecot${item.cpfCorretor}" type="button" data-toggle="modal" data-target="#enviarCecot${item.cpfCorretor}"><i class="far fa-envelope"></i>&nbsp Enviar Área Caixa</a>
                           </div>
                       </div>

                           <!-- Modal enviar Corretor -->
                           <div class="modal fade" id="enviarCorretor${item.cpfCorretor}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <h5 class="modal-title">Confirmação de envio</h5>
                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                           <span aria-hidden="true">&times;</span>
                                           </button>
                                       </div>

                                       <form class="col-md-12" action="corretores/envia-email-corretor/${item.cpfCorretor}" method="POST">
                                       <input type="hidden" name="_token" value="${csrfVar}">
                                       <input type="hidden" name="gilie" value="${item.GILIE}">
                                           <div class="modal-body">
                                               Deseja enviar e-mail com orientações para efetivação de contratação ao corretor <strong>${corretorFormatado}</strong>? 
                                           </div>

                                           <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                               <button type="submit" class="btn btn-primary">Enviar</button>
                                           </div>
                                       
                                       </form>
                                   
                                   </div>
                               </div> 
                           </div>
                           
                           
                           <!-- Modal envia CECOT15 -->
                           <div class="modal fade" id="enviarCecot${item.cpfCorretor}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <h5 class="modal-title">Confirmação de envio</h5>
                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                           <span aria-hidden="true">&times;</span>
                                           </button>
                                       </div>

                                       <form class="col-md-12" action="corretores/envia-email-cecot/${item.cpfCorretor}" method="POST">
                                       <input type="hidden" name="_token" value="${csrfVar}">
                                       <input type="hidden" name="gilie" value="${item.GILIE}">
                                           <div class="modal-body">
                                               Deseja enviar e-mail de solicitação de cadastramento do corretor <strong>${corretorFormatado}</strong> para área gestora da Caixa? 
                                           </div>

                                           <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                               <button type="submit" class="btn btn-primary">Enviar</button>
                                           </div>
                                       
                                       </form>
                                   
                                   </div>
                               </div> 
                           </div>         


                       </td>    
                       <td>${item.VENCIMENTO}</td>
                   </tr>`
                       $(linha).appendTo('#tblCorretoresBR>tbody');

                       if(item.qualificacao == "Contratado"){
                        $('#botaoEmail' + item.CRECI + item.GILIE).remove()
                    }
                      
                       if($('#telefone' + item.CRECI).text() == "(null) null" ||
                       $('#telefone' + item.CRECI).text() == "(Null) Null"){
                       $('#telefone' + item.CRECI).text("")
                   }
                   $('.editalVigente').text("EDITAL " + item.EDITAL);
           });
           _formataDatatableComData("tblCorretoresBR")
           $('.spinnerTblBR').remove()
           $('#tblCorretoresBR').attr('id', 'tblCorretoresBRPopulada');
           $("[name='numeroEdital']").mask("0000/0000-0000");
       });
    }else if ($(this).val() === "7243") {
        $('#tblBH').css('display', 'none');
        $('#tblBU').css('display', 'none');
        $('#tblSP').css('display', 'none');
        $('#tblSA').css('display', 'none');
        $('#tblRE').css('display', 'none');
        $('#tblRJ').css('display', 'none');
        $('#tblPO').css('display', 'none');
        $('#tblGO').css('display', 'none');
        $('#tblFO').css('display', 'none');
        $('#tblCT').css('display', 'none');
        $('#tblBR').css('display', 'none');
        $('#tblBE').css('display', 'block');
       $.getJSON('corretores/lista-corretores-be', function(dados){
           $.each(dados, function(key, item) {
 
            var corretores = item.CORRETOR
            var corretorFormatado = corretores.toUpperCase();

            let linha =
           
                `<tr>
                    <td>${corretorFormatado}</td>
                       <td>${item.CRECI}</td>
                       <td style="white-space:nowrap;" id="telefone${item.CRECI}">(${item.DDDCELULAR})`+" "+`${item.TELEFONECELULAR}</td>
                       <td>${item.EMAIL}</td>
                       <td style="white-space:nowrap;"><button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalQualificacao${item.CRECI}">
                       ${item.qualificacao}</button>

                           <!-- Modal -->
                               <div class="modal fade" id="modalQualificacao${item.CRECI}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog">
                                   <div class="modal-content">
                                   <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                       <h5 class="modal-title" style="color: white;" id="exampleModalLabel">Alterar tipo contrato</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                   </div>
                                   <form method="post" action="/corretores/qualifica-corretor">
                                   <input type="hidden" name="_token" value="${csrfVar}">
                                   <input type="hidden" name="cpfCorretor" value="${item.cpfCorretor}">
                                   <input type="hidden" name="nomeCorretor" value="${item.CORRETOR}">
                                   <input type="hidden" name="gilie" value="${item.GILIE}">
                                   <div class="modal-body">
                                       <div class="form-group">
                                           <label for="formQualificacao${item.CRECI}">Qualificação</label>
                                           <select class="form-control" name="qualificacao" id="formQualificacao${item.CRECI}">
                                               <option value="Contratado" selected>Contratado</option>
                                               <option value="Pré-habilitado">Pré-habilitado</option>
                                           </select>
                                       </div>
                                   </div>
                                   <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                       <button type="submit" class="btn btn-primary">Alterar</button>
                                   </div>
                                   </div>
                               </div>
                               </div>
                           </form>  
                       </td>
                                               
                       <td>
                       <!-- Modal e-mail-->
                       <div class="dropdown">
                           <span data-toggle="tooltip" data-placement="top" title="Alter">
                      
                           <button class="btn btn-primary dropdown-toggle" type="button" id="botaoEmail${item.CRECI + item.GILIE}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-target="#modalDadosCorretor${item.cpfCorretor}"><i class="far fa-envelope"></i>
                           </button> ` + `
                           <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                               <a class="dropdown-item" id="envCor${item.cpfCorretor}" type="button" data-toggle="modal" data-target="#enviarCorretor${item.cpfCorretor}"><i class="far fa-envelope"></i>&nbsp Enviar orientação Corretor</a>
                               <a class="dropdown-item" id="envCecot${item.cpfCorretor}" type="button" data-toggle="modal" data-target="#enviarCecot${item.cpfCorretor}"><i class="far fa-envelope"></i>&nbsp Enviar Área Caixa</a>
                           </div>
                       </div>

                           <!-- Modal enviar Corretor -->
                           <div class="modal fade" id="enviarCorretor${item.cpfCorretor}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <h5 class="modal-title">Confirmação de envio</h5>
                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                           <span aria-hidden="true">&times;</span>
                                           </button>
                                       </div>

                                       <form class="col-md-12" action="corretores/envia-email-corretor/${item.cpfCorretor}" method="POST">
                                       <input type="hidden" name="_token" value="${csrfVar}">
                                       <input type="hidden" name="gilie" value="${item.GILIE}">
                                           <div class="modal-body">
                                               Deseja enviar e-mail com orientações para efetivação de contratação ao corretor <strong>${corretorFormatado}</strong>? 
                                           </div>

                                           <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                               <button type="submit" class="btn btn-primary">Enviar</button>
                                           </div>
                                       
                                       </form>
                                   
                                   </div>
                               </div> 
                           </div>
                           
                           
                           <!-- Modal envia CECOT15 -->
                           <div class="modal fade" id="enviarCecot${item.cpfCorretor}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <h5 class="modal-title">Confirmação de envio</h5>
                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                           <span aria-hidden="true">&times;</span>
                                           </button>
                                       </div>

                                       <form class="col-md-12" action="corretores/envia-email-cecot/${item.cpfCorretor}" method="POST">
                                       <input type="hidden" name="_token" value="${csrfVar}">
                                       <input type="hidden" name="gilie" value="${item.GILIE}">
                                           <div class="modal-body">
                                               Deseja enviar e-mail de solicitação de cadastramento do corretor <strong>${corretorFormatado}</strong> para área gestora da Caixa? 
                                           </div>

                                           <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                               <button type="submit" class="btn btn-primary">Enviar</button>
                                           </div>
                                       
                                       </form>
                                   
                                   </div>
                               </div> 
                           </div>         


                       </td>    

                       <td>${item.VENCIMENTO}</td>
                   </tr>`
                       $(linha).appendTo('#tblCorretoresBE>tbody');

                       if(item.qualificacao == "Contratado"){
                        $('#botaoEmail' + item.CRECI + item.GILIE).remove()
                    }
                       
                       if($('#telefone' + item.CRECI).text() == "(null) null" ||
                       $('#telefone' + item.CRECI).text() == "(Null) Null"){
                       $('#telefone' + item.CRECI).text("")
                   }
                   $('.editalVigente').text("EDITAL " + item.EDITAL);
           });
           _formataDatatableComData("tblCorretoresBE")
           $('.spinnerTblBE').remove()
           $('#tblCorretoresBE').attr('id', 'tblCorretoresBEPopulada');
           $("[name='numeroEdital']").mask("0000/0000-0000");
       });
    }else if ($(this).val() === "7242") {
        $('#tblBH').css('display', 'none');
        $('#tblSP').css('display', 'none');
        $('#tblSA').css('display', 'none');
        $('#tblRE').css('display', 'none');
        $('#tblRJ').css('display', 'none');
        $('#tblPO').css('display', 'none');
        $('#tblGO').css('display', 'none');
        $('#tblFO').css('display', 'none');
        $('#tblCT').css('display', 'none');
        $('#tblBR').css('display', 'none');
        $('#tblBE').css('display', 'none');
        $('#tblBU').css('display', 'block');
       $.getJSON('corretores/lista-corretores-bu', function(dados){
           $.each(dados, function(key, item) {
 
            var corretores = item.CORRETOR
            var corretorFormatado = corretores.toUpperCase();

            let linha =
           
                `<tr>
                    <td>${corretorFormatado}</td>
                       <td>${item.CRECI}</td>
                       <td style="white-space:nowrap;" id="telefone${item.CRECI}">(${item.DDDCELULAR})`+" "+`${item.TELEFONECELULAR}</td>
                       <td>${item.EMAIL}</td>
                       <td style="white-space:nowrap;"><button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalQualificacao${item.CRECI}">
                       ${item.qualificacao}</button>

                           <!-- Modal -->
                               <div class="modal fade" id="modalQualificacao${item.CRECI}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog">
                                   <div class="modal-content">
                                   <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                       <h5 class="modal-title" style="color: white;" id="exampleModalLabel">Alterar tipo contrato</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                   </div>
                                   <form method="post" action="/corretores/qualifica-corretor">
                                   <input type="hidden" name="_token" value="${csrfVar}">
                                   <input type="hidden" name="cpfCorretor" value="${item.cpfCorretor}">
                                   <input type="hidden" name="nomeCorretor" value="${item.CORRETOR}">
                                   <input type="hidden" name="gilie" value="${item.GILIE}">
                                   <div class="modal-body">
                                       <div class="form-group">
                                           <label for="formQualificacao${item.CRECI}">Qualificação</label>
                                           <select class="form-control" name="qualificacao" id="formQualificacao${item.CRECI}">
                                               <option value="Contratado" selected>Contratado</option>
                                               <option value="Pré-habilitado">Pré-habilitado</option>
                                           </select>
                                       </div>
                                   </div>
                                   <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                       <button type="submit" class="btn btn-primary">Alterar</button>
                                   </div>
                                   </div>
                               </div>
                               </div>
                           </form>  
                       </td>
                                               
                       <td>
                       <!-- Modal e-mail-->
                       <div class="dropdown">
                           <span data-toggle="tooltip" data-placement="top" title="Alter">
                      
                           <button class="btn btn-primary dropdown-toggle" type="button" id="botaoEmail${item.CRECI + item.GILIE}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-target="#modalDadosCorretor${item.cpfCorretor}"><i class="far fa-envelope"></i>
                           </button> ` + `
                           <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                               <a class="dropdown-item" id="envCor${item.cpfCorretor}" type="button" data-toggle="modal" data-target="#enviarCorretor${item.cpfCorretor}"><i class="far fa-envelope"></i>&nbsp Enviar orientação Corretor</a>
                               <a class="dropdown-item" id="envCecot${item.cpfCorretor}" type="button" data-toggle="modal" data-target="#enviarCecot${item.cpfCorretor}"><i class="far fa-envelope"></i>&nbsp Enviar Área Caixa</a>
                           </div>
                       </div>

                           <!-- Modal enviar Corretor -->
                           <div class="modal fade" id="enviarCorretor${item.cpfCorretor}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <h5 class="modal-title">Confirmação de envio</h5>
                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                           <span aria-hidden="true">&times;</span>
                                           </button>
                                       </div>

                                       <form class="col-md-12" action="corretores/envia-email-corretor/${item.cpfCorretor}" method="POST">
                                       <input type="hidden" name="_token" value="${csrfVar}">
                                       <input type="hidden" name="gilie" value="${item.GILIE}">
                                           <div class="modal-body">
                                               Deseja enviar e-mail com orientações para efetivação de contratação ao corretor <strong>${corretorFormatado}</strong>? 
                                           </div>

                                           <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                               <button type="submit" class="btn btn-primary">Enviar</button>
                                           </div>
                                       
                                       </form>
                                   
                                   </div>
                               </div> 
                           </div>
                           
                           
                           <!-- Modal envia CECOT15 -->
                           <div class="modal fade" id="enviarCecot${item.cpfCorretor}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <h5 class="modal-title">Confirmação de envio</h5>
                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                           <span aria-hidden="true">&times;</span>
                                           </button>
                                       </div>

                                       <form class="col-md-12" action="corretores/envia-email-cecot/${item.cpfCorretor}" method="POST">
                                       <input type="hidden" name="_token" value="${csrfVar}">
                                       <input type="hidden" name="gilie" value="${item.GILIE}">
                                           <div class="modal-body">
                                               Deseja enviar e-mail de solicitação de cadastramento do corretor <strong>${corretorFormatado}</strong> para área gestora da Caixa? 
                                           </div>

                                           <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                               <button type="submit" class="btn btn-primary">Enviar</button>
                                           </div>
                                       
                                       </form>
                                   
                                   </div>
                               </div> 
                           </div>         


                       </td>     

                       <td>${item.VENCIMENTO}</td>
                   </tr>`
                       $(linha).appendTo('#tblCorretoresBU>tbody');

                       if(item.qualificacao == "Contratado"){
                        $('#botaoEmail' + item.CRECI + item.GILIE).remove()
                    }
                       
                       if($('#telefone' + item.CRECI).text() == "(null) null" ||
                       $('#telefone' + item.CRECI).text() == "(Null) Null"){
                       $('#telefone' + item.CRECI).text("")
                   }
                   $('.editalVigente').text("EDITAL " + item.EDITAL);
           });
           _formataDatatableComData("tblCorretoresBU")
           $('.spinnerTblBU').remove()
           $('#tblCorretoresBU').attr('id', 'tblCorretoresBUPopulada');
           $("[name='numeroEdital']").mask("0000/0000-0000");
       });
    }else if ($(this).val() === "7244") {
        $('#tblSP').css('display', 'none');
        $('#tblSA').css('display', 'none');
        $('#tblRE').css('display', 'none');
        $('#tblRJ').css('display', 'none');
        $('#tblPO').css('display', 'none');
        $('#tblGO').css('display', 'none');
        $('#tblFO').css('display', 'none');
        $('#tblCT').css('display', 'none');
        $('#tblBR').css('display', 'none');
        $('#tblBE').css('display', 'none');
        $('#tblBU').css('display', 'none');
        $('#tblBH').css('display', 'block');
       $.getJSON('corretores/lista-corretores-bh', function(dados){
           $.each(dados, function(key, item) {

            var corretores = item.CORRETOR
            var corretorFormatado = corretores.toUpperCase();

            let linha =
           
                `<tr>
                    <td>${corretorFormatado}</td>
                       <td>${item.CRECI}</td>
                       <td style="white-space:nowrap;" id="telefone${item.CRECI}">(${item.DDDCELULAR})`+" "+`${item.TELEFONECELULAR}</td>
                       <td>${item.EMAIL}</td>
                       <td style="white-space:nowrap;"><button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalQualificacao${item.CRECI}">
                       ${item.qualificacao}</button>

                           <!-- Modal -->
                               <div class="modal fade" id="modalQualificacao${item.CRECI}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog">
                                   <div class="modal-content">
                                   <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                       <h5 class="modal-title" style="color: white;" id="exampleModalLabel">Alterar tipo contrato</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                   </div>
                                   <form method="post" action="/corretores/qualifica-corretor">
                                   <input type="hidden" name="_token" value="${csrfVar}">
                                   <input type="hidden" name="cpfCorretor" value="${item.cpfCorretor}">
                                   <input type="hidden" name="nomeCorretor" value="${item.CORRETOR}">
                                   <input type="hidden" name="gilie" value="${item.GILIE}">
                                   <div class="modal-body">
                                       <div class="form-group">
                                           <label for="formQualificacao${item.CRECI}">Qualificação</label>
                                           <select class="form-control" name="qualificacao" id="formQualificacao${item.CRECI}">
                                               <option value="Contratado" selected>Contratado</option>
                                               <option value="Pré-habilitado">Pré-habilitado</option>
                                           </select>
                                       </div>
                                   </div>
                                   <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                       <button type="submit" class="btn btn-primary">Alterar</button>
                                   </div>
                                   </div>
                               </div>
                               </div>
                           </form>  
                       </td>

                       <td>                
                       <!-- Modal e-mail-->
                       <div class="dropdown">
                           <span data-toggle="tooltip" data-placement="top" title="Alter">
                      
                           <button class="btn btn-primary dropdown-toggle" type="button" id="botaoEmail${item.CRECI + item.GILIE}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-target="#modalDadosCorretor${item.cpfCorretor}"><i class="far fa-envelope"></i>
                           </button> ` + `
                           <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                               <a class="dropdown-item" id="envCor${item.cpfCorretor}" type="button" data-toggle="modal" data-target="#enviarCorretor${item.cpfCorretor}"><i class="far fa-envelope"></i>&nbsp Enviar orientação Corretor</a>
                               <a class="dropdown-item" id="envCecot${item.cpfCorretor}" type="button" data-toggle="modal" data-target="#enviarCecot${item.cpfCorretor}"><i class="far fa-envelope"></i>&nbsp Enviar Área Caixa</a>
                           </div>
                       </div>

                           <!-- Modal enviar Corretor -->
                           <div class="modal fade" id="enviarCorretor${item.cpfCorretor}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <h5 class="modal-title">Confirmação de envio</h5>
                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                           <span aria-hidden="true">&times;</span>
                                           </button>
                                       </div>

                                       <form class="col-md-12" action="corretores/envia-email-corretor/${item.cpfCorretor}" method="POST">
                                       <input type="hidden" name="_token" value="${csrfVar}">
                                       <input type="hidden" name="gilie" value="${item.GILIE}">
                                           <div class="modal-body">
                                               Deseja enviar e-mail com orientações para efetivação de contratação ao corretor <strong>${corretorFormatado}</strong>? 
                                           </div>

                                           <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                               <button type="submit" class="btn btn-primary">Enviar</button>
                                           </div>
                                       
                                       </form>
                                   
                                   </div>
                               </div> 
                           </div>
                           
                           
                           <!-- Modal envia CECOT15 -->
                           <div class="modal fade" id="enviarCecot${item.cpfCorretor}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <h5 class="modal-title">Confirmação de envio</h5>
                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                           <span aria-hidden="true">&times;</span>
                                           </button>
                                       </div>

                                       <form class="col-md-12" action="corretores/envia-email-cecot/${item.cpfCorretor}" method="POST">
                                       <input type="hidden" name="_token" value="${csrfVar}">
                                       <input type="hidden" name="gilie" value="${item.GILIE}">
                                           <div class="modal-body">
                                               Deseja enviar e-mail de solicitação de cadastramento do corretor <strong>${corretorFormatado}</strong> para área gestora da Caixa? 
                                           </div>

                                           <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                               <button type="submit" class="btn btn-primary">Enviar</button>
                                           </div>
                                       
                                       </form>
                                   
                                   </div>
                               </div> 
                           </div>         


                       </td>

                       <td>${item.VENCIMENTO}</td>


                   </tr>`
                       $(linha).appendTo('#tblCorretoresBH>tbody');

                       if(item.qualificacao == "Contratado"){
                        $('#botaoEmail' + item.CRECI + item.GILIE).remove()
                    }
                       
                       if($('#telefone' + item.CRECI).text() == "(null) null" ||
                       $('#telefone' + item.CRECI).text() == "(Null) Null"){
                       $('#telefone' + item.CRECI).text("")
                   }
                   $('.editalVigente').text("EDITAL " + item.EDITAL);
           });
           _formataDatatableComData("tblCorretoresBH")
           $('.spinnerTblBH').remove()
           $('#tblCorretoresBH').attr('id', 'tblCorretoresBHPopulada');
           $("[name='numeroEdital']").mask("0000/0000-0000");
       });
    }else{
        $('#tblSP').css('display', 'none');
        $('#tblSA').css('display', 'none');
        $('#tblRE').css('display', 'none');
        $('#tblRJ').css('display', 'none');
        $('#tblPO').css('display', 'none');
        $('#tblGO').css('display', 'none');
        $('#tblFO').css('display', 'none');
        $('#tblCT').css('display', 'none');
        $('#tblBR').css('display', 'none');
        $('#tblBE').css('display', 'none');
        $('#tblBU').css('display', 'none');
        $('#tblBH').css('display', 'none');
        $('.editalVigente').text(" ");
   }
})

