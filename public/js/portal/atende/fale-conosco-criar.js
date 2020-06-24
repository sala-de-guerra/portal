var csrfVar = $('meta[name="csrf-token"]').attr('content');

var gilie = $('#numeroGilie').val()

$(document).ready(function(){  
    $.getJSON('/atende/lista-atende-generico', function(dados){
        $.each(dados, function(key, item) {
            var linha =
            ` <tr>
            <td>${item.Nome_Atividade}</td>
            <td><button type="button" class="btn btn-link" data-toggle="modal" data-target="#demandaGenericaModal${+ item.id}">
            Abrir Atende
          </button>

          <div class="modal fade" id="demandaGenericaModal${+ item.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header"style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Abrir Atende</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                    <form method="post" action="/fale-conosco/abrir">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="${csrfVar}">
                        <input type="hidden" name="responsavelAtendimento" value="${item.Responsavel_Atendimento}">
                        <input type="hidden" name="responsavelDesignacao" value="${item.Responsavel_Designacao}">
                        <input type="hidden" name="nomeAtividade" value="${item.Nome_Atividade}">
                        <input type="hidden" name="prazoAtendimento" value="${item.Prazo_Atendimento}">
                        <input type="hidden" name="gilie" value="${item.GILIE}">
                        <div class="form-group">
                            <label>Assunto</label>
                            <input type="text" name="Assunto" class="form-control" placeholder="Assunto do Atende" required>
                        </div>
                        <div class="form-group">
                        <label for="exampleFormControlTextarea1">Descrição</label>
                            <textarea name="Descricao" class="form-control" id="formAtende" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="emailContatoResposta" aria-describedby="emailHelp" placeholder="email">
                            <small class="form-text text-muted">Preencha este campo caso deseje <b>direcionar</b> a resposta.</small>
                            <small class="form-text text-muted">este campo em branco, a resposta irá para quem efetuou a abertura do atende.</small>
                            <small class="form-text text-muted">envio para email caixa deve seguir o padrao c999999@<b>mail.caixa</b> ou a9999@<b>mail.caixa</b>.</small>

                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>

                    </div>
                </div>
                </div>
                </td>
            </tr>`

        $(linha).appendTo('#tblAtendeGenerico>tbody');
        })
    })

    $.getJSON('/atende/lista-atende-generico/' + gilie, function(dados){
        $.each(dados, function(key, item) {
            var linha =
            ` <tr>
            <td>${item.Nome_Atividade}</td>
            <td><button type="button" class="btn btn-link" data-toggle="modal" data-target="#demandaGenericaModal${+ item.id}">
            Abrir Atende
          </button>

          <div class="modal fade" id="demandaGenericaModal${+ item.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header"style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Abrir Atende</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                    <form method="post" action="/fale-conosco/abrir">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="${csrfVar}">
                        <input type="hidden" name="responsavelAtendimento" value="${item.Responsavel_Atendimento}">
                        <input type="hidden" name="responsavelDesignacao" value="${item.Responsavel_Designacao}">
                        <input type="hidden" name="nomeAtividade" value="${item.Nome_Atividade}">
                        <input type="hidden" name="prazoAtendimento" value="${item.Prazo_Atendimento}">
                        <input type="hidden" name="gilie" value="${item.GILIE}">
                        <div class="form-group">
                            <label>Assunto</label>
                            <input type="text" name="Assunto" class="form-control" placeholder="Assunto do Atende" required>
                        </div>
                        <div class="form-group">
                        <label for="exampleFormControlTextarea1">Descrição</label>
                            <textarea name="Descricao" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="emailContatoResposta" aria-describedby="emailHelp" placeholder="email">
                            <small class="form-text text-muted">Preencha este campo caso deseje <b>direcionar</b> a resposta.</small>
                            <small class="form-text text-muted">este campo em branco, a resposta irá para quem efetuou a abertura do atende.</small>
                            <small class="form-text text-muted">envio para email caixa deve seguir o padrao c999999@<b>mail.caixa</b> ou a9999@<b>mail.caixa</b>.</small>

                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>

                    </div>
                </div>
                </div>
                </td>
            </tr>`

        $(linha).appendTo('#tblAtendeGenericoporgilie>tbody');
        })
    })
})
