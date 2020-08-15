var csrfVar = $('meta[name="csrf-token"]').attr('content');

    function _formataDatatableComId (idTabela){
        $('#' + idTabela).DataTable({
            "order": [[ 1, "asc" ]],
            "language": {
                "decimal": ",",
                "thousands": ".",
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
    
    
    
    $(document).ready(function(){
        $.getJSON('/estoque-imoveis/universo-chave', function(dados){
            $.each(dados, function(key, item) {
                var linha =
                    `<tr>
                        <td><a href="/consulta-bem-imovel/${item.contratoFormatado}" class="cursor-pointer">${item.contrato}</a></td>
                        <td>${item.chave}</td>
                        <td>${item.quantidadeChave}</td>
                        <td>${item.quantidadeEmprestada}</td>
                        <td>${item.endereco}</td>
                        <td>${item.ocupacao}</td>
                        <td>                   
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#emprestarModal${item.idChaves}">
                            Status
                            </button>

                            <!-- Modal Emprestar-->
                            <div class="modal fade" id="emprestarModal${item.idChaves}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Status de chaves</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table" id="controleDeChaves${item.idChaves}">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nº Chave</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td id="numeroChave${item.numeroChave1}">${item.numeroChave1}</td>
                                                    <td id="statusChave${item.numeroChave1}">${item.statusChave1}</td>
                                                    <td>
                                                        <button type="button" id="btnEmprestar${item.numeroChave1}" class="btn btn-primary" data-toggle="modal" data-target="#emprestar${item.numeroChave1}">
                                                            emprestar
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr id="linha2${item.numeroChave2}">
                                                    <td id="numeroChave${item.numeroChave2}">${item.numeroChave2}</td>
                                                    <td id="statusChave${item.numeroChave2}">${item.statusChave2}</td>
                                                    <td>
                                                        <button type="button" id="btnEmprestar${item.numeroChave2}" class="btn btn-primary" data-toggle="modal" data-target="#emprestar${item.numeroChave2}">
                                                            emprestar
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr id="linha3${item.numeroChave3}">
                                                    <td id="numeroChave${item.numeroChave3}">${item.numeroChave3}</td>
                                                    <td id="statusChave${item.numeroChave3}">${item.statusChave3}</td>
                                                    <td>
                                                        <button type="button" id="btnEmprestar${item.numeroChave3}" class="btn btn-primary" data-toggle="modal" data-target="#emprestar${item.numeroChave3}">
                                                            emprestar
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr id="linha4${item.numeroChave4}">
                                                    <td id="numeroChave${item.numeroChave4}">${item.numeroChave4}</td>
                                                    <td id="statusChave${item.numeroChave4}">${item.statusChave4}</td>
                                                    <td>
                                                        <button type="button" id="btnEmprestar${item.numeroChave4}" class="btn btn-primary" data-toggle="modal" data-target="#emprestar${item.numeroChave4}">
                                                            emprestar
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr id="linha5${item.numeroChave5}">
                                                    <td id="numeroChave${item.numeroChave5}">${item.numeroChave5}</td>
                                                    <td id="statusChave${item.numeroChave5}">${item.statusChave5}</td>
                                                    <td>
                                                        <button type="button" id="btnEmprestar${item.numeroChave5}" class="btn btn-primary" data-toggle="modal" data-target="#emprestar${item.numeroChave5}">
                                                            emprestar
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr id="linha6${item.numeroChave6}">
                                                    <td id="numeroChave${item.numeroChave6}">${item.numeroChave6}</td>
                                                    <td id="statusChave${item.numeroChave6}">${item.statusChave6}</td>
                                                    <td>
                                                        <button type="button" id="btnEmprestar${item.numeroChave6}" class="btn btn-primary" data-toggle="modal" data-target="#emprestar${item.numeroChave6}">
                                                            emprestar
                                                        </button>
                                                    </td>
                                                </tr>                                                                                                                                                                                                                                               
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    </div>
                                    </div>
                                </div>
                            </div> <!-- Fim do Modal -->

                            <!-- Modal chave 1 -->
                            <div class="modal fade" id="emprestar${item.numeroChave1}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Emprestar chave ${item.numeroChave1}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="/estoque-imoveis/empresta-chave/${item.idChaves}">
                                    <input type="hidden" name="_token" value="${csrfVar}">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nomeProponente"><span style="color: red;">*</span> Nome proponente: </label>
                                            <input type="text" class="form-control" name="nomeProponente1" placeholder="Nome do responsável pela chave" required> 
                                        </div>
                                        <div class="form-group">
                                            <label for="cpfProponente"><span style="color: red;">*</span> CPF proponente: </label>
                                            <input type="text" class="form-control" name="cpfProponente1" placeholder="CPF do responsável pela chave" required> 
                                        </div>
                                        <div class="form-group">
                                            <label for="RGProponente">RG proponente: </label>
                                            <input type="text" class="form-control" name="RGProponente1" placeholder="RG do responsável pela chave"> 
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Emprestar</button>
                                    </div>
                                    </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal chave 2 -->
                            <div class="modal fade" id="emprestar${item.numeroChave2}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Emprestar chave ${item.numeroChave2}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="/estoque-imoveis/empresta-chave/${item.idChaves}">
                                    <input type="hidden" name="_token" value="${csrfVar}">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nomeProponente"><span style="color: red;">*</span> Nome proponente: </label>
                                            <input type="text" class="form-control" name="nomeProponente2" placeholder="Nome do responsável pela chave" required> 
                                        </div>
                                        <div class="form-group">
                                            <label for="cpfProponente"><span style="color: red;">*</span> CPF proponente: </label>
                                            <input type="text" class="form-control" name="cpfProponente2" placeholder="CPF do responsável pela chave" required> 
                                        </div>
                                        <div class="form-group">
                                            <label for="RGProponente">RG proponente: </label>
                                            <input type="text" class="form-control" name="RGProponente2" placeholder="RG do responsável pela chave"> 
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Emprestar</button>
                                    </div>
                                    </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal chave 3 -->
                            <div class="modal fade" id="emprestar${item.numeroChave3}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Emprestar chave ${item.numeroChave3}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="/estoque-imoveis/empresta-chave/${item.idChaves}">
                                    <input type="hidden" name="_token" value="${csrfVar}">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nomeProponente"><span style="color: red;">*</span> Nome proponente: </label>
                                            <input type="text" class="form-control" name="nomeProponente3" placeholder="Nome do responsável pela chave" required> 
                                        </div>
                                        <div class="form-group">
                                            <label for="cpfProponente"><span style="color: red;">*</span> CPF proponente: </label>
                                            <input type="text" class="form-control" name="cpfProponente3" placeholder="CPF do responsável pela chave" required> 
                                        </div>
                                        <div class="form-group">
                                            <label for="RGProponente">RG proponente: </label>
                                            <input type="text" class="form-control" name="RGProponente3" placeholder="RG do responsável pela chave"> 
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Emprestar</button>
                                    </div>
                                    </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal chave 4 -->
                            <div class="modal fade" id="emprestar${item.numeroChave4}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Emprestar chave ${item.numeroChave4}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="/estoque-imoveis/empresta-chave/${item.idChaves}">
                                    <input type="hidden" name="_token" value="${csrfVar}">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nomeProponente"><span style="color: red;">*</span> Nome proponente: </label>
                                            <input type="text" class="form-control" name="nomeProponente4" placeholder="Nome do responsável pela chave" required> 
                                        </div>
                                        <div class="form-group">
                                            <label for="cpfProponente"><span style="color: red;">*</span> CPF proponente: </label>
                                            <input type="text" class="form-control" name="cpfProponente4" placeholder="CPF do responsável pela chave" required> 
                                        </div>
                                        <div class="form-group">
                                            <label for="RGProponente">RG proponente: </label>
                                            <input type="text" class="form-control" name="RGProponente4" placeholder="RG do responsável pela chave"> 
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Emprestar</button>
                                    </div>
                                    </form>
                                    </div>
                                </div>
                            </div>   
                        
                            <!-- Modal chave 5 -->
                            <div class="modal fade" id="emprestar${item.numeroChave5}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Emprestar chave ${item.numeroChave5}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="/estoque-imoveis/empresta-chave/${item.idChaves}">
                                    <input type="hidden" name="_token" value="${csrfVar}">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nomeProponente"><span style="color: red;">*</span> Nome proponente: </label>
                                            <input type="text" class="form-control" name="nomeProponente5" placeholder="Nome do responsável pela chave" required> 
                                        </div>
                                        <div class="form-group">
                                            <label for="cpfProponente"><span style="color: red;">*</span> CPF proponente: </label>
                                            <input type="text" class="form-control" name="cpfProponente5" placeholder="CPF do responsável pela chave" required> 
                                        </div>
                                        <div class="form-group">
                                            <label for="RGProponente">RG proponente: </label>
                                            <input type="text" class="form-control" name="RGProponente5" placeholder="RG do responsável pela chave"> 
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Emprestar</button>
                                    </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Modal chave 6 -->
                            <div class="modal fade" id="emprestar${item.numeroChave6}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Emprestar chave ${item.numeroChave6}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="/estoque-imoveis/empresta-chave/${item.idChaves}">
                                    <input type="hidden" name="_token" value="${csrfVar}">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nomeProponente"><span style="color: red;">*</span> Nome proponente: </label>
                                            <input type="text" class="form-control" name="nomeProponente6" placeholder="Nome do responsável pela chave" required> 
                                        </div>
                                        <div class="form-group">
                                            <label for="cpfProponente"><span style="color: red;">*</span> CPF proponente: </label>
                                            <input type="text" class="form-control" name="cpfProponente6" placeholder="CPF do responsável pela chave" required> 
                                        </div>
                                        <div class="form-group">
                                            <label for="RGProponente">RG proponente: </label>
                                            <input type="text" class="form-control" name="RGProponente6" placeholder="RG do responsável pela chave"> 
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Emprestar</button>
                                    </div>
                                    </form>
                                    </div>
                                </div>
                            </div>                               
                        </td>
                    </tr>` 
                   
                    //remove nulos
                    if($('#numeroChave' + item.numeroChave2).text() == 'null'){
                        $('#linha2' + item.numeroChave2).remove()
                    }
                    if($('#numeroChave' + item.numeroChave3).text() == 'null'){
                        $('#linha3' + item.numeroChave3).remove()
                    }
                    if($('#numeroChave' + item.numeroChave4).text() == 'null'){
                        $('#linha4' + item.numeroChave4).remove()
                    }
                    if($('#numeroChave' + item.numeroChave5).text() == 'null'){
                        $('#linha5' + item.numeroChave5).remove()
                    }
                    if($('#numeroChave' + item.numeroChave6).text() == 'null'){
                        $('#linha6' + item.numeroChave6).remove()
                    }

                   

                $(linha).appendTo('#tblControleChaveGeral>tbody');

                //Retira botão emprestar e colore status
                if($('#statusChave' + item.numeroChave1).text() == 'EMPRESTADO'){
                    $('#statusChave' + item.numeroChave1).html('<span style="color: red;">EMPRESTADO</span>')
                    $('#btnEmprestar' + item.numeroChave1).remove()
                }else{
                    $('#statusChave' + item.numeroChave1).html('<span style="color: green;">DISPONIVEL</span>')
                }
                if($('#statusChave' + item.numeroChave2).text() == 'EMPRESTADO'){
                    $('#statusChave' + item.numeroChave2).html('<span style="color: red;">EMPRESTADO</span>')
                    $('#btnEmprestar' + item.numeroChave2).remove()
                }else{
                    $('#statusChave' + item.numeroChave2).html('<span style="color: green;">DISPONIVEL</span>')
                }
                if($('#statusChave' + item.numeroChave3).text() == 'EMPRESTADO'){
                    $('#statusChave' + item.numeroChave3).html('<span style="color: red;">EMPRESTADO</span>')
                    $('#btnEmprestar' + item.numeroChave3).remove()
                }else{
                    $('#statusChave' + item.numeroChave3).html('<span style="color: green;">DISPONIVEL</span>')
                }
                if($('#statusChave' + item.numeroChave4).text() == 'EMPRESTADO'){
                    $('#statusChave' + item.numeroChave4).html('<span style="color: red;">EMPRESTADO</span>')
                    $('#btnEmprestar' + item.numeroChave4).remove()
                }else{
                    $('#statusChave' + item.numeroChave4).html('<span style="color: green;">DISPONIVEL</span>')
                }
                if($('#statusChave' + item.numeroChave5).text() == 'EMPRESTADO'){
                    $('#statusChave' + item.numeroChave5).html('<span style="color: red;">EMPRESTADO</span>')
                    $('#btnEmprestar' + item.numeroChave5).remove()
                }else{
                    $('#statusChave' + item.numeroChave5).html('<span style="color: green;">DISPONIVEL</span>')
                }
                if($('#statusChave' + item.numeroChave6).text() == 'EMPRESTADO'){
                    $('#statusChave' + item.numeroChave6).html('<span style="color: red;">EMPRESTADO</span>')
                    $('#btnEmprestar' + item.numeroChave6).remove()
                }else{
                    $('#statusChave' + item.numeroChave6).html('<span style="color: green;">DISPONIVEL</span>')
                }    
            }
        )}

    ).done(function() {
        _formataDatatableComId('tblControleChaveGeral')
         $('.spinnerTblGeral').remove()
    })

    $.getJSON('/estoque-imoveis/universo-emprestado', function(dados){
        $.each(dados, function(key, item) {
            var linha =
                `<tr>
                    <td><a href="/consulta-bem-imovel/${item.contratoFormatado}" class="cursor-pointer">${item.contrato}</a></td>
                    <td>${item.chave}</td>
                    <td>${item.endereco}</td>
                    <td>                            
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#devolverModal${item.idChaves}">
                            Devolução
                        </button>
                        <!-- Modal Emprestar-->
                        <div class="modal fade" id="devolverModal${item.idChaves}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Status de chaves</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table" id="controleDeDevolucaoChaves${item.idChaves}">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nº Chave</th>
                                                <th scope="col">Nome</th>
                                                <th scope="col">CPF</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td id="numeroChave${item.numeroChave1}">${item.numeroChave1}</td>
                                                <td id="nomeProponente${item.numeroChave1}">${item.nomeProponente1}</td>
                                                <td id="cpfProponente${item.numeroChave1}">${item.cpfProponente1}</td>
                                                <td>
                                                    <button type="button" id="btnDevolver${item.numeroChave1}" class="btn btn-primary" data-toggle="modal" data-target="#devolver${item.numeroChave1}">
                                                        devolver
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr id="linha2${item.numeroChave2}">
                                                <td id="numeroChave${item.numeroChave2}">${item.numeroChave2}</td>
                                                <td id="nomeProponente${item.numeroChave2}">${item.nomeProponente2}</td>
                                                <td id="cpfProponente${item.numeroChave2}">${item.cpfProponente2}</td>
                                                <td>
                                                    <button type="button" id="btnDevolver${item.numeroChave2}" class="btn btn-primary" data-toggle="modal" data-target="#devolver${item.numeroChave2}">
                                                        devolver
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr id="linha3${item.numeroChave3}">
                                                <td id="numeroChave${item.numeroChave3}">${item.numeroChave3}</td>
                                                <td id="nomeProponente${item.numeroChave3}">${item.nomeProponente3}</td>
                                                <td id="cpfProponente${item.numeroChave3}">${item.cpfProponente3}</td>
                                                <td>
                                                    <button type="button" id="btnDevolver${item.numeroChave3}" class="btn btn-primary" data-toggle="modal" data-target="#devolver${item.numeroChave3}">
                                                        devolver    
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr id="linha4${item.numeroChave4}">
                                                <td id="numeroChave${item.numeroChave4}">${item.numeroChave4}</td>
                                                <td id="nomeProponente${item.numeroChave4}">${item.nomeProponente4}</td>
                                                <td id="cpfProponente${item.numeroChave4}">${item.cpfProponente4}</td>
                                                <td>
                                                    <button type="button" id="btnDevolver${item.numeroChave4}" class="btn btn-primary" data-toggle="modal" data-target="#devolver${item.numeroChave4}">
                                                        devolver
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr id="linha5${item.numeroChave5}">
                                                <td id="numeroChave${item.numeroChave5}">${item.numeroChave5}</td>
                                                <td id="nomeProponente${item.numeroChave5}">${item.nomeProponente5}</td>
                                                <td id="cpfProponente${item.numeroChave5}">${item.cpfProponente5}</td>
                                                <td>
                                                    <button type="button" id="btnDevolver${item.numeroChave5}" class="btn btn-primary" data-toggle="modal" data-target="#devolver${item.numeroChave5}">
                                                        devolver
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr id="linha6${item.numeroChave6}">
                                                <td id="numeroChave${item.numeroChave6}">${item.numeroChave6}</td>
                                                <td id="nomeProponente${item.numeroChave6}">${item.nomeProponente6}</td>
                                                <td id="cpfProponente${item.numeroChave6}">${item.cpfProponente6}</td>
                                                <td>
                                                    <button type="button" id="btnDevolver${item.numeroChave6}" class="btn btn-primary" data-toggle="modal" data-target="#devolver${item.numeroChave6}">
                                                        devolver
                                                    </button>
                                                </td>
                                            </tr>                                                                                                                                                                                                                                               
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>
                                </div>
                            </div>
                        </div> <!-- Fim do Modal -->

                        <!-- Modal chave 1 -->
                        <div class="modal fade" id="devolver${item.numeroChave1}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Emprestar chave ${item.numeroChave1}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="/estoque-imoveis/empresta-chave/${item.idChaves}">
                                <input type="hidden" name="_token" value="${csrfVar}">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nomeProponente"><span style="color: red;">*</span> Nome proponente: </label>
                                        <input type="text" class="form-control" name="nomeProponente1" placeholder="Nome do responsável pela chave" required> 
                                    </div>
                                    <div class="form-group">
                                        <label for="cpfProponente"><span style="color: red;">*</span> CPF proponente: </label>
                                        <input type="text" class="form-control" name="cpfProponente1" placeholder="CPF do responsável pela chave" required> 
                                    </div>
                                    <div class="form-group">
                                        <label for="RGProponente">RG proponente: </label>
                                        <input type="text" class="form-control" name="RGProponente1" placeholder="RG do responsável pela chave"> 
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-primary">Emprestar</button>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal chave 2 -->
                        <div class="modal fade" id="devolver${item.numeroChave2}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Emprestar chave ${item.numeroChave2}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="/estoque-imoveis/empresta-chave/${item.idChaves}">
                                <input type="hidden" name="_token" value="${csrfVar}">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nomeProponente"><span style="color: red;">*</span> Nome proponente: </label>
                                        <input type="text" class="form-control" name="nomeProponente2" placeholder="Nome do responsável pela chave" required> 
                                    </div>
                                    <div class="form-group">
                                        <label for="cpfProponente"><span style="color: red;">*</span> CPF proponente: </label>
                                        <input type="text" class="form-control" name="cpfProponente2" placeholder="CPF do responsável pela chave" required> 
                                    </div>
                                    <div class="form-group">
                                        <label for="RGProponente">RG proponente: </label>
                                        <input type="text" class="form-control" name="RGProponente2" placeholder="RG do responsável pela chave"> 
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-primary">Emprestar</button>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal chave 3 -->
                        <div class="modal fade" id="devolver${item.numeroChave3}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Emprestar chave ${item.numeroChave3}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="/estoque-imoveis/empresta-chave/${item.idChaves}">
                                <input type="hidden" name="_token" value="${csrfVar}">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nomeProponente"><span style="color: red;">*</span> Nome proponente: </label>
                                        <input type="text" class="form-control" name="nomeProponente3" placeholder="Nome do responsável pela chave" required> 
                                    </div>
                                    <div class="form-group">
                                        <label for="cpfProponente"><span style="color: red;">*</span> CPF proponente: </label>
                                        <input type="text" class="form-control" name="cpfProponente3" placeholder="CPF do responsável pela chave" required> 
                                    </div>
                                    <div class="form-group">
                                        <label for="RGProponente">RG proponente: </label>
                                        <input type="text" class="form-control" name="RGProponente3" placeholder="RG do responsável pela chave"> 
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-primary">Emprestar</button>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal chave 4 -->
                        <div class="modal fade" id="devolver${item.numeroChave4}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Emprestar chave ${item.numeroChave4}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="/estoque-imoveis/empresta-chave/${item.idChaves}">
                                <input type="hidden" name="_token" value="${csrfVar}">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nomeProponente"><span style="color: red;">*</span> Nome proponente: </label>
                                        <input type="text" class="form-control" name="nomeProponente4" placeholder="Nome do responsável pela chave" required> 
                                    </div>
                                    <div class="form-group">
                                        <label for="cpfProponente"><span style="color: red;">*</span> CPF proponente: </label>
                                        <input type="text" class="form-control" name="cpfProponente4" placeholder="CPF do responsável pela chave" required> 
                                    </div>
                                    <div class="form-group">
                                        <label for="RGProponente">RG proponente: </label>
                                        <input type="text" class="form-control" name="RGProponente4" placeholder="RG do responsável pela chave"> 
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-primary">Emprestar</button>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>   
                    
                        <!-- Modal chave 5 -->
                        <div class="modal fade" id="devolver${item.numeroChave5}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Emprestar chave ${item.numeroChave5}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="/estoque-imoveis/empresta-chave/${item.idChaves}">
                                <input type="hidden" name="_token" value="${csrfVar}">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nomeProponente"><span style="color: red;">*</span> Nome proponente: </label>
                                        <input type="text" class="form-control" name="nomeProponente5" placeholder="Nome do responsável pela chave" required> 
                                    </div>
                                    <div class="form-group">
                                        <label for="cpfProponente"><span style="color: red;">*</span> CPF proponente: </label>
                                        <input type="text" class="form-control" name="cpfProponente5" placeholder="CPF do responsável pela chave" required> 
                                    </div>
                                    <div class="form-group">
                                        <label for="RGProponente">RG proponente: </label>
                                        <input type="text" class="form-control" name="RGProponente5" placeholder="RG do responsável pela chave"> 
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-primary">Emprestar</button>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Modal chave 6 -->
                        <div class="modal fade" id="devolver${item.numeroChave6}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Emprestar chave ${item.numeroChave6}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="/estoque-imoveis/empresta-chave/${item.idChaves}">
                                <input type="hidden" name="_token" value="${csrfVar}">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nomeProponente"><span style="color: red;">*</span> Nome proponente: </label>
                                        <input type="text" class="form-control" name="nomeProponente6" placeholder="Nome do responsável pela chave" required> 
                                    </div>
                                    <div class="form-group">
                                        <label for="cpfProponente"><span style="color: red;">*</span> CPF proponente: </label>
                                        <input type="text" class="form-control" name="cpfProponente6" placeholder="CPF do responsável pela chave" required> 
                                    </div>
                                    <div class="form-group">
                                        <label for="RGProponente">RG proponente: </label>
                                        <input type="text" class="form-control" name="RGProponente6" placeholder="RG do responsável pela chave"> 
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-primary">Emprestar</button>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>                               
                    </td>
                </tr>` 

            $(linha).appendTo('#tblControleChavesEmprestadas>tbody');
        }
    )}
    ).done(function() {
        _formataDatatableComId('tblControleChavesEmprestadas')
         $('.spinnerTbl').remove()
    })
})