function _formataDatatableComData (idTabela){
    $('#' + idTabela).DataTable({
        "order": [[ 0, "desc" ],[ 1, "asc"]],
        columnDefs: [
            {type: 'date-uk', targets: [1]} //vai filtrar a coluna com data dd/mm/yyyy
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

var csrfVar = $('meta[name="csrf-token"]').attr('content');

$(document).ready( function () {
    $.getJSON('/gerencial/gestao-subsidios/lista-dijur', function(dados){
        $.each(dados, function(key, item) {

            item.dataRetorno = moment(item.dataRetorno).format('DD/MM/YYYY')
            item.dataSolicitação = moment(item.dataSolicitação).format('DD/MM/YYYY')

           /* var contrato = item.Contrato
            var bem = href="/consulta-bem-imovel/${item.NU_BEM}

            var consultaContrato
                if (contrato == bem){
                    <a href="/consulta-bem-imovel/${item.contratoFormatado}" class="cursor-pointer">${contrato}</a>
                } else {
                    <a href="/consulta-bem-imovel/${item.contratoFormatado}" class="cursor-pointer" class="disabled">${contrato}</a>
                } 
            */

            let linha =
                `<tr>
                    <td id='corMulta${item.seq}'>${item.prazoComMulta}</td>
                    <td>${item.dataRetorno}</td>
                    <td style="write-space:nowrap">
                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalHistoricoSeq${item.seq}"><i style="color: #054f77; font-size: 13pt;" class="fas fa-info-circle"></i></button>${item.seq}

                    <div class="modal fade" id="modalHistoricoSeq${item.seq}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                            <div class="modal-content">
                            <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                <h5 class="modal-title" style="color: white;">Dados Sequencial ${item.seq}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Processo:</label>
                                    <p>${item.processo}</p>
                                </div>
                                
                                <div class="form-group">
                                    <label>Data da Solicitação:</label>
                                    <p>${item.dataSolicitação}</p>
                                </div>

                                <div class="form-group">
                                <label>Tipo:</label>
                                <p>${item.tipo}</p>
                                </div>

                                <div class="form-group">
                                <label>Parte:</label>
                                <p>${item.parte}</p>
                                </div>

                                <div class="form-group">
                                <label>CFP/CNPJ Parte:</label>
                                <p>${item.cpfCnpj}</p>
                                </div>

                                <div class="form-group">
                                <label>Contrato:</label>
                                <p>${item.Contrato}</p>
                                </div>

                                <div class="form-group">
                                <label>Advogado:</label>
                                <p>${item.advogado}</p>
                                </div>

                                <div class="form-group">
                                <label>E-mail Advogado:</label>
                                <p>${item.emailResposta}</p>
                                </div>

                                <div class="form-group">
                                <label>Observação:</label>
                                <p>${item.observacao}</p>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                            </div>
                        </div>
                        </div>
                    </td>
                    <td>${item.Contrato}</td>
                    
                    <td style="white-space:nowrap;"><span data-toggle="tooltip" data-placement="top" title="Responder Subsídio">
                    <button id="btnSijur${item.seq}" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalResponderSubsidio${item.seq}">
                    <i class="fas fa-file-signature"></i>
                    </button></span>

                    <span data-toggle="tooltip" data-placement="top" title="Abrir Atende Subsídio">
                    <button id="btnSubsidio${item.seq}" type="button" style="background-color: #4db1ac; color: white;" class="btn btn-light" data-toggle="modal" data-target="#modalAtendeSubsidio${item.seq}">
                    <i class="fas fa-user-edit"></i>
                    </button></span>

                        <div class="modal fade" id="modalResponderSubsidio${item.seq}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <input type="hidden" name="comentario" value="${item.comentario}">
                            <input type="hidden" name="prazo" value="${moment(item.vencimento).format("DD/MM/YYYY")}">
                            <input type="hidden" name="email" value="${item.email}">
                            <input type="hidden" name="siouv" value="${item.numeroSiouv}">
                            <input type="hidden" name="tipo" value="${item.tipo}">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Contrato</label>
                                        <input type="number" name="cadastraContratoSiouv" class="form-control" aria-describedby="Numero Contrato" placeholder="Informe contrato sem pontuação" required>
                                    </div>
                                    <div class="form-group">
                                    <label>Coordenador</label>
                                        <select class="form-control" id="selectCoordenador${item.seq}" name="cadastraCoordenadorSiouv"></select>
                                    </div>
                                    <div class="form-group">
                                        <label>Responsável</label>
                                        <select class="form-control" id="selectDestinatario${item.seq}" name="cadastraResponsavelSiouv"></select>
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


                       <div class="modal fade" id="modalAtendeSubsidio${item.seq}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                <h5 class="modal-title" style="color: white;">Abrir Atende Subsídio</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="/gerencial/gestao-subsidios/editar-contrato">
                            <input type="hidden" name="_token" value="${csrfVar}">
                            <input type="hidden" name="manifesto" value="${item.manifesto}">
                            <input type="hidden" name="comentario" value="${item.comentario}">
                            <input type="hidden" name="nome" value="${item.Nome}">
                            <input type="hidden" name="cpf" value="${item.CPF}">
                            <input type="hidden" name="prazo" value="${moment(item.vencimento).format("DD/MM/YYYY")}">
                            <input type="hidden" name="email" value="${item.email}">
                            <input type="hidden" name="siouv" value="${item.numeroSiouv}">
                            <input type="hidden" name="tipo" value="${item.tipo}">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Contrato</label>
                                        <input type="number" name="editaContratoSijur" class="form-control" aria-describedby="Numero Contrato" placeholder="Informe contrato sem pontuação">
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
                  
                   </td>
                 </tr>`
    
            $(linha).appendTo('#tblSijurPendentes>tbody');   
        
            if (item.prazoComMulta == 'SIM'){
                $('#corMulta'+item.seq).html('<b style="color: red;">SIM</b>')
            }

            $('#dataHoraCaptura').text(item.dataEHoraCaptura +'h')
           
        })

    }).done(function() {
        _formataDatatableComData("tblSijurPendentes")
    
    })
});

setTimeout(function(){
    $('#fadeOut').fadeOut("slow");
  }, 2000);


