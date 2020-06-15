var csrfVar = $('meta[name="csrf-token"]').attr('content');
$.fn.dataTable.ext.errMode = 'none';

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
            <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editarAtividade${+ item.id}">
                Editar
                </button>

                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#apagarAtividade${+ item.id}">
                Apagar
                </button>
          `+ 
          //Modal Apagar 
          `
          <div class="modal fade" id="apagarAtividade${+ item.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div style="background: linear-gradient(to right, #cc0000 0%, #ff6699 100%);" class="modal-header">
                        <h5 style="color: white;" class="modal-title" id="exampleModalLabel">Remover Atividade</h5>
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
          
            `+ 
            //Modal Editar 
            `
            <div class="modal fade" id="editarAtividade${+ item.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                      <div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">
                          <h5 style="color: white;" class="modal-title" id="exampleModalLabel">Editar Atividade</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                          <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                      <form method="post" action="/gerencial/editar-atividade-generica/${item.id}">
                      <input type="hidden" class="form-control" name="_token" value="${csrfVar}">
                      <input type="hidden" class="form-control" name="_method" value="put">
                      <div class="modal-body">

                      <div class="form-group">
                        <label for="nomeAtividade">Alterar Nome da Atividade</label>
                        <input type="text" class="form-control" name="nomeAtividade" value="${item.Nome_Atividade}">
                      </div>
                      <div class="form-group">
                        <label for="prazoAtendimento">Prazo de Atendimento</label>
                        <input type="number" class="form-control" name="prazoAtendimento" value="${item.Prazo_Atendimento}">
                      </div>

                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Selecione o Destinatário</label>
                      <select class="form-control" id="responsavelAtendimentoEditar" name="responsavelAtendimento">
                      '<option value="${item.Responsavel_Atendimento}" selected>Selecione</option>
                      </select>
                   </div>

                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                          <button type="submit" class="btn btn-primary">Alterar</button>
                      </div>
                  </form>
                      </div>
                      </div>
                  </div>
              </div>
                    
        </td>
            </tr>`
        $(linha).appendTo('#tblAtendeGenericoGerencial>tbody');

            $.getJSON('/gerencial/listar-empregado', function(dadosEmpregado){
                $.each(dadosEmpregado, function(empKey, empItem) {
                    var redirect =
                                '<option value="'+empItem.matricula+'">'+empItem.nomeCompleto+'</option>'           
                $(redirect).appendTo('#responsavelAtendimentoEditar');
                })
            })
        })
    })
})

$.getJSON('/gerencial/gerenciar-fale-conosco/lista', function(dados){
    $.each(dados, function(key, item) {
        var linha =
        ` <tr>
        <td>${item.Responsavel_Atendimento}</td>
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
            <a class="dropdown-item"  type="button" id="btn-direcionar${+ item.id}" class="btn btn-primary" data-toggle="modal" data-target="#modalDirecionar${+ item.id}"><i class="fas fa-exchange-alt"></i>&nbspDirecionar</a>
            <a class="dropdown-item" type="button" id="btn-excluir${+ item.id}" "class="btn btn-primary" data-toggle="modal" data-target="#excluir${+ item.id}"><i class="far fa-trash-alt"></i>&nbspExcluir</a>
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

        <div class="modal fade" id="modalDirecionar${+ item.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">
                <h5 style="color: white;" class="modal-title" id="exampleModalLabel">Direcionar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <form method="post" action="/gerencial/editar-atividade-generica/${item.id}">
            <input type="hidden" class="form-control" name="_token" value="${csrfVar}">
            <input type="hidden" class="form-control" name="_method" value="put">
            <div class="modal-body">
              <input type="hidden" class="form-control" name="nomeAtividade" value="${item.Nome_Atividade}">
              <input type="hidden" class="form-control" name="prazoAtendimento" value="${item.Prazo_Atendimento}">
      
          <div class="form-group">
            <label for="exampleFormControlSelect1">Selecione o Destinatário</label>
            <select class="form-control" id="responsavelAtendimentoDirecionar" name="responsavelAtendimento">
            '<option value="${item.Responsavel_Atendimento}" selected>Selecione</option>
            </select>
         </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                <button type="submit" class="btn btn-primary">Direcionar</button>
            </div>
            </form>
        </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="excluir${+ item.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div style="background: linear-gradient(to right, #cc0000 0%, #ff6699 100%);" class="modal-header">
            <h5 style="color: white;" class="modal-title" id="exampleModalLabel">Excluir</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <form method="post" enctype="multipart/form-data" action="/gerencial/excluir-atividade-generica/${item.id}">
        <input type="hidden" class="form-control" name="_token" value="${csrfVar}">
        <input type="hidden" class="form-control" name="_method" value="put">
        <div class="container">
            <div>
            <label for="exampleFormControlTextarea1">Motivo da exclusão:</label>
            <textarea class="form-control" name="respostaFaleConosco" rows="5" required></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
            <button type="submit" class="btn btn-danger">Excluir</button>
        </div>
        </form>
        </div>
        </div>
    </div>
</div>

        </tr>`

        $(linha).appendTo('#tblGerenciarFaleconosco>tbody');

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
})
setTimeout(function(){
    _formataDatatable()
    }, 1000);
