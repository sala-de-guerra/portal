var csrfVar = $('meta[name="csrf-token"]').attr('content');

    $(".vencidotbl").click(function() {
    $.getJSON('/controle-laudos/laudo-vencido', function(dados){
        $.each(dados, function(key, item) {
            var linha =
                    `<tr>
                        <td><a href="/consulta-bem-imovel/${item.BEM_FORMATADO}" class="cursor-pointer">${item.NU_BEM}</a></td>
                        <td>${item.CLASSIFICACAO}</td>
                        <td>${item.STATUS_IMOVEL}</td>
                        <td>`+ moment(item.DATA_VENCIMENTO_LAUDO).format("DD/MM/YYYY") +`</td>
                        <td id="quantoFalta${item.id}">${item.quanto_falta}</td>
                        <td id="OS${item.id}">${item.numeroOS}</td>
                        <td id="status${item.id}">${item.statusSiopi}</td>
                        <td id="obs${item.id}">${item.observacao}</td>
                        <td>
                            <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Cadastrar
                            </button> 

                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastraOS${item.id}"><i class="far fa-edit"></i>O.S</a>
                                <a class="dropdown-item" type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastrarStatus${item.id}"><i class="far fa-edit"></i>Status Siopi</a>
                                <a class="dropdown-item" type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastraOBS${item.id}"><i class="far fa-edit"></i>Observação</a>
                            </div> 

                            <!-- Modal -->
                            <div class="modal fade" id="cadastraOBS${item.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                            <h5 class="modal-title" style="color: white;">Cadastrar Observação</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="/controle-laudos/alterar/${item.id}" id="formOBS${item.id}">
                                                <input type="hidden" name="_token" value="${csrfVar}">
                                                <input type="hidden" name="contratoFormatado" value="${item.BEM_FORMATADO}">
                                                    <div class="form-group">
                                                        <p>Observação </p>
                                                        <textarea name="observacao" class="form-control" rows="5"></textarea>
                                                    </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- Modal -->
                        <div class="modal fade" id="cadastrarStatus${item.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                        <h5 class="modal-title" style="color: white;">Cadastrar Status Siopi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="/controle-laudos/alterar/${item.id}" id="formStatus${item.id}">
                                            <input type="hidden" name="_token" value="${csrfVar}">
                                            <input type="hidden" name="contratoFormatado" value="${item.BEM_FORMATADO}">
                                            <div class="input-group mb-3">
                                                <select class="custom-select" name="statusSiopi">
                                                    <option selected>Escolher...</option>
                                                    <option value="Cancelada">Cancelada</option>
                                                    <option value="Concluída">Concluída</option>
                                                    <option value="Convocada">Convocada</option>
                                                    <option value="Emitida">Emitida</option>
                                                    <option value="Excluída">Excluída</option>
                                                    <option value="Laudo Finalizado">Laudo Finalizado</option>
                                                    <option value="Vistoria Concluída">Vistoria Concluída</option>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Enviar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>    
                        
                        <!-- Modal -->
                            <div class="modal fade" id="cadastraOS${item.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                            <h5 class="modal-title" style="color: white;">Cadastrar O.S</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="/controle-laudos/alterar/${item.id}" id="formLaudo${item.id}">
                                                <div class="modal-body">
                                                    <input type="hidden" name="_token" value="${csrfVar}">
                                                    <input type="hidden" name="contratoFormatado" value="${item.BEM_FORMATADO}">
                                                    <div class="form-group">
                                                        <label>Nº da O.S</label>
                                                        <input type="text" name="numeroOS" class="form-control OS" minlength="33" maxlength="33" value="${item.numeroOS}" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                                    </div>
                                                </div>
                                            </form>                   
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>` 


        $(linha).appendTo('#tblLaudoVencido>tbody');
            if ($('#quantoFalta'+item.id).text() < 0 ){
                $('#quantoFalta'+item.id).html('<b style="color: red;">'+item.quanto_falta +'</b>')
            }
            if ($('#OS'+item.id).text() == 'null'){
                $('#OS'+item.id).text("")
            }
            if ($('#obs'+item.id).text() == 'null'){
                $('#obs'+item.id).text("")
            }
            if ($('#status'+item.id).text() == 'null'){
                $('#status'+item.id).text("")
            }

            $('#formLaudo'+item.id).submit( function(e) {

                e.preventDefault();
    
                let datas = JSON.stringify( $(this).serialize() );
                let url = $(this).attr('action');
                let method = $(this).attr('method');
                // console.log(datas);
                // console.log(url);
                // console.log(method);
                var post = datas
                var resprimeiraparte = post.substring(94, 113);
                var ressegundaparte = post.substring(116, 129);
    
                
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
                    $('#OS'+item.id).text(resprimeiraparte + "/" + ressegundaparte)
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
            $('#formStatus'+item.id).submit( function(e) {
    
                e.preventDefault();
    
    
                let datas = JSON.stringify( $(this).serialize() );
                let url = $(this).attr('action');
                let method = $(this).attr('method');
                console.log(datas);
                console.log(url);
                console.log(method);
    
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
                    $('#status'+item.id).text("Atualizado: F5 para ver.")
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
    
            $('#formOBS'+item.id).submit( function(e) {
    
                e.preventDefault();
    
    
                let datas = JSON.stringify( $(this).serialize() );
                let url = $(this).attr('action');
                let method = $(this).attr('method');
                console.log(datas);
                console.log(url);
                console.log(method);
    
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
                        $('#obs'+item.id).text("Atualizado: F5 para ver.")
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
            }
        )}
    )
})

$(".vencidotbl").click(function() {
setTimeout(function(){
    $('.dtableVencido').DataTable({
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
    $('.dtableVencido').removeAttr('id');
    $('.spinnerTblVencido').remove()
    $(".vencidotbl").off('click')
    $(".OS").mask("0000.0000.000000000/0000.00.00.00");
}, 1000);
})
