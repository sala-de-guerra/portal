var csrfVar = $('meta[name="csrf-token"]').attr('content');

$.getJSON('/gerencial/listar-empregado', function(dadosEmpregado){
    $.each(dadosEmpregado, function(empKey, empItem) {
        var redirect =
                    '<option value="'+empItem.matricula+'">'+empItem.nomeCompleto+'</option>'           
    $(redirect).appendTo('#responsavelAtendimento');
    })
})

$(document).ready(function(){  
    $.getJSON('/atende/lista-atende-generico', function(dados){
        $.each(dados, function(key, item) {
            var linha =
            ` <tr>
            <td>${item.Nome_Atividade}</td>
            <td>${item.Responsavel_Atendimento}</td>
            <td>${item.Prazo_Atendimento}</td>
            <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#apagarAtividade${+ item.id}">
            Apagar Atividade
          </button>
          
          <div class="modal fade" id="apagarAtividade${+ item.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div style="background: linear-gradient(to right, #cc0000 0%, #ff6699 100%);" class="modal-header">
                        <h5 style="color: white;" class="modal-title" id="exampleModalLabel">Remover Despachante</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form method="post" action="/gerencial/apagar-demanda-generica/${item.id}">
                    <input type="hidden" class="form-control" name="_token" value="${csrfVar}">
                    <input type="hidden" class="form-control" name="_method" value="DELETE">
                    <div class="modal-body">
                        <div class="container"> 
                        <p>Tem certeza que deseja excluir Atividade:</p>
                        <p><b>${item.Nome_Atividade}</b></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </div>
                </form>
                    </div>
                    </div>
                </div>
            </div>
          </td>
            </tr>`

        $(linha).appendTo('#tblAtendeGenericoGerencial>tbody');
        })
        _formataDatatable();
    })
})