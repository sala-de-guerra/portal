var csrfVar = $('meta[name="csrf-token"]').attr('content');
$.fn.dataTable.ext.errMode = 'none';

function _formataDatatableComData (idTabela){
    $('#' + idTabela).DataTable({
        "order": [[ 2, "asc" ]],
        columnDefs: [
            {type: 'date-uk', targets: 2}
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


$(document).ready(function(){  

    $.getJSON('/atende/lista-atende-faleConosco', function(dados){
        $.each(dados, function(key, item) {
            var linha =
            ` <tr>
            <td>${item.id}</td>
            <td>${item.Nome_Atividade}</td>
            <td>${item.Data_atendimento}</td>
            <td>${item.Assunto}</td>
            <td class="obs${+ item.id}">${item.Descricao}</td>
            <td>
            <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Ação 
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <a class="dropdown-item" type="button" id="btn-consulta${+ item.id}" class="btn btn-primary" data-toggle="modal" data-target="#modalConsulta${+ item.id}"><i class="fa fa-search" aria-hidden="true"></i>&nbspConsultar</a>
                <a class="dropdown-item" type="button" id="btn-editar${+ item.id}" class="btn btn-primary" data-toggle="modal" data-target="#modalTratar${+ item.id}"><i class="far fa-edit"></i>&nbspTratar</a>
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

                <div class="modal fade" id="modalTratar${+ item.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">
                        <h5 style="color: white;" class="modal-title" id="exampleModalLabel">Tratar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" action="/fale-conosco/responder/${+ item.id}">
                    <input type="hidden" class="form-control" name="_token" value="${csrfVar}">
                    <input type="hidden" class="form-control" name="_method" value="put">
                    <div class="container">
                        <input type="hidden" name="emailContatoResposta" value="${item.Email_contato}"></input>
                        <input type="hidden" name="Responsavel" value="${item.Responsavel_Atendimento}"></input>
                        <div>
                        <label for="exampleFormControlTextarea1">Responder Atende</label>
                        <textarea class="form-control" name="respostaFaleConosco" rows="15" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                        <button type="submit" class="btn btn-primary">Responder</button>
                    </div>
                    </form>
                    </div>
                    </div>
                </div>
            </div>


            </tr>`

            $(linha).appendTo('#tblFaleconosco>tbody');

            $.getJSON('/gerencial/listar-empregado', function(dadosEmpregado){
                $.each(dadosEmpregado, function(empKey, empItem) {
                    var redirect =
                                '<option value="'+empItem.matricula+'">'+empItem.nomeCompleto+'</option>'           
                $(redirect).appendTo('#responsavelAtendimentoDirecionar');
                })
            })

            var subtring = $('.obs'+item.id).text()
            var novo = subtring.substring(0, 50) + ' [...]'
            $('.obs'+item.id).text(novo)
        })
    }).done(function() {
        _formataDatatableComData('tblFaleconosco')
    })
})

// setTimeout(function(){
//     _formataDatatable()
//     }, 1000);
