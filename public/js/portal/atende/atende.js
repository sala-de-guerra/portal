
function Atende () 
{ 
    var unidade = $('#lotacao').text()

    $(document).ready(function(){  
        $.getJSON('/atende/listar-equipes-atividades-atende', function(dados){
            let resultadoFuncaoModal = desenharModal(dados)
            document.getElementById('modalAtendeHtml').innerHTML = resultadoFuncaoModal
        })
    })

    function desenharModal(dados)
    {
        let modalMacroAtividades = '';
        let html =`
                <div class="modal" tabindex="-1" role="dialog" id="modalAtende">
                    <div class="modal-dialog modal-lg mda" role="document">
                    <div class="modal-content">
                        <div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">
                            <h5 style="color: white;" class="modal-title" id="exampleModalLabel">Abrir Atende</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="atende.fecharModais()"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
        `
        if(dados.length>0){
            dados.forEach(equipe => {
                html+=`
                                    <div class="col-sm" id="btnMacro${equipe.idEquipe}" >
                                        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalMacroAtividades_${equipe.idEquipe}">
                                            <i class="${equipe.iconeEquipe}"></i><p>${equipe.nomeEquipe}</p>
                                        </button>     
                                    </div>`
                    if (equipe.atividades.length > 0) {
                        modalMacroAtividades += criaModalMacroAtividades(equipe.atividades)
                    }
                    
                    // setTimeout(function(){ 
                    //     var retiraAtende = $('#GILIE').text()
                    //     console.log(retiraAtende); 
                    // }, 1000);
                     setTimeout(function(){
                        var retiraAtende = $('#GILIE').text()
                         if  (retiraAtende != equipe.Unidade){
                        $('#btnMacro' + equipe.idEquipe).remove()
                         }
                     }, 1000);
            });            
        }
        html += `   
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="atende.fecharModais()">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>`;
            html += modalMacroAtividades
        return html;
    }

    // onclick="atende.abreModalMacroAtividade(${equipe.atividades});"
    function criaModalMacroAtividades(arrayDeAtividades)
    {
        let modalMicroAtividade = ''
        let formMacroAtividade = ''
        let modalMacroAtividades = `
            <div class="modal fade" id="modalMacroAtividades_${arrayDeAtividades[0].idEquipe}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg mda" role="document">
                    <div class="modal-content">
                        <div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">
                            <h5 style="color: white;" class="modal-title" id="exampleModalLabel">Abrir Atende</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="atende.fecharModais()"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
        `
        arrayDeAtividades.forEach(macroAtividade => {
            if (macroAtividade.microAtividade.length > 0) {
                modalMacroAtividades += `
                                <div class="col-sm">
                                    <button type="button" class="btn btn-link tooltip-col" aria-hidden="true" class="btn btn-link" data-toggle="modal" data-target="#modalMicroAtividades_${macroAtividade.idAtividade}">
                                        <i class="${macroAtividade.iconeAtividade}"></i><p>${macroAtividade.nomeAtividade}</p><span class="tooltiptext4"><br>Síntese da atividade: <br><hr><br>${macroAtividade.sinteseAtividade}</span>
                                    </button>
                                </div>
                `
            } else {
                modalMacroAtividades += `
                                <div class="col-sm">
                                    <button type="button" class="btn btn-link tooltip-col" aria-hidden="true" data-toggle="modal" data-target="#modalFormAtende_${macroAtividade.idAtividade}">
                                        <i class="${macroAtividade.iconeAtividade}"></i><p>${macroAtividade.nomeAtividade}</p><span class="tooltiptext4"><br>Síntese da atividade: <br><hr><br>${macroAtividade.sinteseAtividade}</span>                         
                                    </button>
                                </div>
                `
                formMacroAtividade += criaFormAtende(macroAtividade)
            }
            if (macroAtividade.microAtividade.length > 0) {
                modalMicroAtividade += criaModalMicroAtividade(macroAtividade.microAtividade)
            }
        });
        modalMacroAtividades += `                                         
                        
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalMacroAtividades_${arrayDeAtividades[0].idEquipe}">Voltar</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="atende.fecharModais()">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        `
        modalMicroAtividade += formMacroAtividade
        modalMacroAtividades += modalMicroAtividade
        return modalMacroAtividades
    }

    function criaModalMicroAtividade(arrayMicroAtividades)
    {
        let formMicroAtividade = ''
        let modalMicroAtividade = `
            <div class="modal fade" id="modalMicroAtividades_${arrayMicroAtividades[0].idAtividadeSubordinante}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg mda" role="document">
                    <div class="modal-content">
                        <div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">
                            <h5 style="color: white;" class="modal-title" id="exampleModalLabel">Abrir Atende</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="atende.fecharModais()"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
        `
        arrayMicroAtividades.forEach(microAtividade => {
            modalMicroAtividade += `
                                <div class="col-sm">
                                    <button type="button" class="btn btn-link tooltip-col" aria-hidden="true" data-toggle="modal" data-target="#modalFormAtende_${microAtividade.idAtividade}">
                                        <i class="${microAtividade.iconeAtividade}"></i><p>${microAtividade.nomeAtividade}</p><span class="tooltiptext4"><br>Síntese da atividade: <br><hr><br>${microAtividade.sinteseAtividade}</span>    
                                    </button>
                                </div>
            `
            formMicroAtividade += criaFormAtende(microAtividade)
        });
        modalMicroAtividade += `
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Voltar</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="atende.fecharModais()">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `
        modalMicroAtividade += formMicroAtividade
        return modalMicroAtividade
    }

    function criaFormAtende(dadosAtividade)
    {
        let formAtende = `
            <div class="modal fade" id="modalFormAtende_${dadosAtividade.idAtividade}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg mda" role="document">
                    <div class="modal-content">
                        <div class="modal-header"style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                            <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Abrir Atende</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="atende.fecharModais()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="/atende">
                            <div class="modal-body">
                                <input type="hidden" name="_token" value="${csrfVar}">
                                <input type="hidden" name="contratoFormatado" value="${numeroContrato}">
                                <input type="hidden" name="idEquipe" value="${dadosAtividade.idEquipe}">
                                <input type="hidden" name="idAtividade" value="${dadosAtividade.idAtividade}">
                                
                                <div class="form-group">
                                    <label>Assunto</label>
                                    <input type="text" name="assuntoAtende" class="form-control" placeholder="Assunto do Atende" required>
                                </div>
                                <div class="form-group">
                                <label for="exampleFormControlTextarea1">Descrição</label>
                                    <textarea name="descricaoAtende" class="form-control" id="formAtende" rows="2" required></textarea>
                                </div>

                                <div class="form-group novoPrazo" style="display:none">
                                    <label>Informar novo prazo de atendimento</label>
                                    <input type="text" class="form-control datepicker" autocomplete="off" name="prazoAtendimentoAtende" placeholder="Selecione nova data no calendário...">
                                    <small class="form-text text-muted">Prazo padrão para atendimento desta demanda: <b>${dadosAtividade.prazoAtendimento}</b> dias úteis. </small>
                                    <small class="form-text text-muted">Este campo em branco, será considerado o prazo de dias padrão.</small>
                                </div>
                                

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="emailContatoResposta" aria-describedby="emailHelp" placeholder="email">
                                    <small class="form-text text-muted">Preencha este campo caso haja necessidade de <b>direcionar</b> a resposta.</small>
                                    <small class="form-text text-muted">Este campo em branco, a resposta irá para quem efetuou a abertura do atende.</small>
                                    <small class="form-text text-muted">Envio para email caixa deve seguir o padrao c999999@<b>corp.caixa.gov.br</b> ou ag9999@<b>caixa.gov.br</b>.</small>

                                </div>
                                <button style="float: right;" onclick="addCopia()" type="button" class="btn btn-link">Adicionar cópia de email</button><br>
                                
                                <div style="display: none;" class="form-group toggle">
                                    <label>CC</label>
                                    <input type="email" class="form-control" name="emailContatoCopia" placeholder="email">
                                    <small class="form-text text-muted">Preencha este campo caso deseje enviar um cópia da resposta.</small>
                                </div>
                                <div style="display: none;" class="form-group toggle">
                                    <label>CC</label>
                                    <input type="email" class="form-control" name="emailContatoNovaCopia" placeholder="email">
                                    <small  class="form-text text-muted">Preencha este campo caso deseje enviar um cópia da resposta.</small>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button data-toggle="modal" data-target="#modalTeste" style="float: left;" type="button" class="btn btn-link tooltip-col mr-4" aria-hidden="true"><span style="color: red;">Histórico atende aberto nos últimos 7 dias</span>
                                <small class="form-text text-muted">clique para ver mais.</small>
                                <span class="tooltiptext5"><br>Atende(s) última semana: <br>
                            
                                <table id="tblTooltipAtende" class="table">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Status</th>

                                    </thead>
                                    <tbody>  

                                    </tbody>
                                </table>
                            
                                </span>
                                </button>
                            
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        `
        return formAtende
    }
   
   
    function fecharModais()
    {
        $('.modal').modal('hide');
    }
    


    var _public= {
        criaModalMacroAtividades:criaModalMacroAtividades,
        criaModalMicroAtividade:criaModalMicroAtividade,
        criaFormAtende:criaFormAtende,
        fecharModais:fecharModais
    }
    return _public;
}

let atende = new Atende();

function addCopia(){
    $('.toggle').toggle()
}

setTimeout(function(){ 
    $('.datepicker').datepicker({dateFormat: 'yy-mm-dd', minDate:0}) 
    if ($('#perfil').text() == 'GESTOR' ||
        $('#perfil').text() == 'EVENTUAL' ||
        $('#perfil').text() == 'DESENVOLVEDOR'){
        $(".novoPrazo").css("display", "block");
    }
}, 1000);

