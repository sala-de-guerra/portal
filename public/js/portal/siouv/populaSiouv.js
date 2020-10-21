function _formataDatatableComData (idTabela){
    $('#' + idTabela).DataTable({
        "order": [[ 4, "asc" ]],
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

var csrfVar = $('meta[name="csrf-token"]').attr('content');

$(document).ready( function () {
    $.getJSON('/gerencial/gestao-siouv/lista-siouv', function(dados){
        $.each(dados, function(key, item) {
            let linha =
                `<tr>
                    <td>${item.tipo}</td>
                    <td>${item.numeroSiouv}
                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalHistoricoSiouv${item.numeroSiouv}"><i style="color: #054f77; font-size: 13pt;" class="fas fa-info-circle"></i></button>

                    <div class="modal fade" id="modalHistoricoSiouv${item.numeroSiouv}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                            <div class="modal-content">
                            <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                <h5 class="modal-title" style="color: white;">Siouv ${item.numeroSiouv}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                <label>Manifesto:</label>
                                <p>${item.manifesto}</p>
                                </div>

                                <div class="form-group">
                                <label>Comentário:</label>
                                <p>${item.comentario}</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                            </div>
                        </div>
                        </div>
                    </td>
                    <td><a href="/consulta-bem-imovel/${item.contratoFormatado}" class="cursor-pointer">${item.contrato}</a></td>
                    <td>${item.responsavel}</td>
                    <td>${item.vencimento}</td>
                    <td>${item.processo}</td>
                    <td><span data-toggle="tooltip" data-placement="top" title="Abrir atende">
                    <button id="btnSiouv${item.numeroSiouv}" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalSiouv${item.numeroSiouv}">
                        <i class="fas fa-headset"></i>
                    </button></span>
                    
                    <span data-toggle="tooltip" data-placement="top" title="Responder Siouv">
                    <button type="button" style="background-color: #e47b22; color: white;" class="btn btn-light" data-toggle="modal" data-target="#modalResponderSiouv${item.numeroSiouv}">
                        <i class="fas fa-edit"></i>
                    </button></span>


                        <div class="modal fade" id="modalSiouv${item.numeroSiouv}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                <h5 class="modal-title" style="color: white;">Cadastrar Atende</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="/gerencial/gestao-siouv/cadastra-siouv">
                            <input type="hidden" name="_token" value="${csrfVar}">
                            <input type="hidden" name="manifesto" value="${item.manifesto}">
                            <input type="hidden" name="prazo" value="${item.vencimento}">
                            <input type="hidden" name="email" value="${item.email}">
                            <input type="hidden" name="siouv" value="${item.numeroSiouv}">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Contrato</label>
                                        <input type="number" name="cadastraContratoSiouv" class="form-control" aria-describedby="Numero Contrato" placeholder="Informe contrato sem pontuação" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Responsável</label>
                                        <select class="form-control" id="selectDestinatario${item.numeroSiouv}" name="cadastraResponsavelSiouv"></select>
                                    </div>
                                    <div class="form-group">
                                        <label>Processo</label>
                                        <input type="text" name="cadastraProcessolSiouv" class="form-control" aria-describedby="Processo" placeholder="Informe Processo" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                                </div>
                            </form>
                        </div>
                        </div>


                        <div class="modal fade" id="modalResponderSiouv${item.numeroSiouv}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                            <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                <h5 class="modal-title" style="color: white;">Responder Siouv</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="/gerencial/gestao-siouv/responder-siouv">
                            <input type="hidden" name="_token" value="${csrfVar}">
                            <input type="hidden" name="manifesto" value="${item.manifesto}">
                            <input type="hidden" name="prazo" value="${item.vencimento}">
                            <input type="hidden" name="email" value="${item.email}">
                            <input type="hidden" name="siouv" value="${item.numeroSiouv}">
                                <div class="modal-body">
                                    <p>Resposta para: <b>${item.email}</b></p>
                                    <textarea class="form-control summernote" aria-label="With textarea" name="respostaSiouv"></textarea>
                                </div>
                                <div class="form-group container">
                                    <a href="/gerencial/gestao-siouv/modelo-sac/${item.numeroSiouv}"><button type="button" class="btn btn-primary">
                                    <i class="fas fa-edit">&nbsp Modelo SAC</i>
                                    </button></a>&nbsp&nbsp&nbsp

                                    <a href="/gerencial/gestao-siouv/modelo-siouv/${item.numeroSiouv}"><button type="button" class="btn btn-primary">
                                    <i class="fas fa-edit">&nbsp Modelo SIOUV</i>
                                    </button></a>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                                </div>
                            </form>
                        </div>
                        </div>
                  
                   </td>
                 </tr>`
    
            $(linha).appendTo('#tblSiouv>tbody');

            if(item.contrato != 'Não Cadastrado'){
                $('#btnSiouv'+item.numeroSiouv).remove()
            }

            $('#btnSiouv'+item.numeroSiouv).one("click", function() {
                $.getJSON('/gerencial/listar-empregado', function(dadosEmpregado){
                    $.each(dadosEmpregado, function(empKey, empItem) {
                        var redirect =
                                    '<option value="'+empItem.matricula+'">'+empItem.nomeCompleto+'</option>'           
                    $(redirect).appendTo('#selectDestinatario'+item.numeroSiouv);
                    })
                })
            });
        });

    $.getJSON('/gerencial/gestao-siouv/demandas-siouv', function(dados){
        $.each(dados, function(Key, item) {
            if(item.status == 'Distribuido'){
                item.status = 'Distribuido Atende'
            }
            var listaDemandasDiarias =
                    `<tr>
                    <td>${item.tipo}</td>
                    <td>${item.numeroSiouv}</td>
                    <td>${item.status}</td>
                    <td><a href="/consulta-bem-imovel/${item.contratoFormatado}" class="cursor-pointer">${item.contrato}</a></td>
                    </tr>`

        $(listaDemandasDiarias).appendTo('#tblSiouvTratados>tbody');
        })
    })
        
    }).done(function() {
        _formataDatatableComData("tblSiouv")
        $('.spinnerTbl').remove()
        $('.summernote').summernote({
            height: 200,
            lang: "pt-BR" 
          });
    })
});

setTimeout(function(){
    $('#fadeOut').fadeOut("slow");
  }, 2000);


