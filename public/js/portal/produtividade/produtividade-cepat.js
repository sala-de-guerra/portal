
var unidade = $('#unidade').text()
unidade = unidade.trim();
var csrfVarCepat = $('#tokencepat').val();

var lista = []

function sortUL(selector) {
  var $ul = $(selector);
  $ul.find('li').sort(function(a, b) {
    var upA = $(a).text().toUpperCase();
    var upB = $(b).text().toUpperCase();
    return (upA < upB) ? -1 : (upA > upB) ? 1 : 0;
  }).appendTo(selector);
};

$(document).ready(function(){
    $.getJSON('/produtividade-cepat/lista-macro-processo/' + unidade, function(dados){
        $.each(dados, function(key, item) {
            var id = item.IdMacro
            var linha =  `<tr>
                            <td>
                                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#excluirMacro${item.IdMacro}"><i style="color: red; font-size: 13pt;" class="fas fa-trash-alt"></i></button>
                                ${item.NOME_MACROATIVIDADE}

                                <div class="modal fade" id="excluirMacro${item.IdMacro}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div style="background: linear-gradient(to right, #cc0000 0%, #ff6699 100%);" class="modal-header">
                                        <h5 style="color: white;" class="modal-title" id="exampleModalLabel">Excluir Atividades</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="/produtividade-cepat/delete-macro-atividade/${item.IdMacro}" method="post">
                                    <div class="modal-body">
                                        <input type="hidden" name="_token" value="${csrfVarCepat}">
                                            <P>Tem certeza que deseja excluir <b>${item.NOME_MACROATIVIDADE}</b> e suas microatividades ?</P>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            <button type="submit" class="btn btn-danger">Excluir</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                </div>


                            </td>
                            <td>
                                <ol id="menu-${id}">
                                </ol>
                            </td>
                            <td>
                                <ol id="listaAtividade${id}">
      
                                </ol>
                            </td>
                            <td><button onclick="location.href = '/produtividade-cepat/microatividade/${id}';" class="btn btn-primary submit-button">Criar microatividade</button></td>
                        </tr>`
            $(linha).appendTo('#tblAtividadescepat>tbody');
            lista.push(item.IdMacro);
            $.each(item.micro_atividades, function(key, item) { 
                let periodoDE = moment(item.PERIODO_TRATADO_DE).format("DD/MM/YYYY")
                let periodoATE = moment(item.PERIODO_TRATADO_ATE).format("DD/MM/YYYY")

                var micro =`
                    <li>
                        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#editar${item.idMicro}"><i style="color: #054f77; font-size: 13pt;" class="far fa-edit"></i></button>${item.NOME_MICROATIVIDADE}
                    </li>
                    
                    <div class="modal fade" id="editar${item.idMicro}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                    <h5 class="modal-title" id="exampleModalLabel"  style="color: white;" >Alterar Microprocesso: <strong> ${item.NOME_MICROATIVIDADE} </strong> </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form action="update-micro-atividade/${item.idMicro}" method="post" id='formUpdate${item.idMicro}'>
                                    <input type="hidden" name="_token" value="${csrfVarCepat}">
                                    
                                    <div class="modal-body">    
                                        <div class="form-inline">
                                            <h5 style="color:red"><b>Deseja Excluir Micro Atividade: ${item.NOME_MICROATIVIDADE}?</b></h5>&nbsp&nbsp&nbsp&nbsp
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" value="Naoexcluir" id="exampleCheck2" class="custom-control-input" name="excluirMicroAtividade" checked>
                                                <label class="custom-control-label font-weight-normal" for="exampleCheck2">Não</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" value="excluir" class="custom-control-input" id="exampleCheck1" name="excluirMicroAtividade">
                                                <label class="custom-control-label font-weight-normal" for="exampleCheck1">Sim</label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group mb-5">
                                            <label class="font-weight-normal" for="nomeMicroAtividade${item.idMicro}">1. Nome Micro Atividade</label>
                                            <input type="text" class="form-control" name="nomeMicroAtividade" id="nomeMicroAtividade${item.idMicro}" value="${item.NOME_MICROATIVIDADE}">
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-inline">
                                                    <label class="font-weight-normal" for="quantidade-pessoas-alocadas">2. Quantidade de pessoas alocadas </label>
                                                    <input type="number" 
                                                        name="quantidadePessoasAlocadas" 
                                                        id="quantidade-pessoas-alocadas"
                                                        step="0.1"
                                                        class="form-control ml-1"
                                                        value="${item.QTDE_PESSOAS_ALOCADAS}"
                                                        title="Por favor, preencha somente com números"
                                                    >
                                                </div>
                                            </div>
                    
                                            <div class="col-lg-6">
                                                <div class="form-inline">
                                                    <h5 class="text-danger">3. Esta atividade é Mensurável?** &nbsp</h5>             
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" 
                                                            id="opc-mensuravel-${item.idMicro}S" 
                                                            name="mensuravel" 
                                                            value="S" 
                                                            class="custom-control-input"  
                                                            onclick="mensuravelClicado()"
                                                            >
                                                            <label for="opc-mensuravel-s" class="custom-control-label font-weight-normal">Sim</label><br>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" 
                                                            id="opc-mensuravel-${item.idMicro}N" 
                                                            name="mensuravel" 
                                                            value="N" 
                                                            class="custom-control-input" 
                                                            onclick="mensuravelClicado()">
                                                            <label for="opc-mensuravel-n" class="custom-control-label font-weight-normal">Não</label><br>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="col-lg-4">
                                            <h4>Volumetria </h4>
                                        </div>    
                    
                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label class="font-weight-normal" for="volume-total-demanda">4. Volume total demanda recebida</label>

                                                <input 
                                                    type="number" 
                                                    name="volumeTotalDemanda" 
                                                    id="volume-total-demanda-recebida"
                                                    class="form-control"
                                                    value="${item.VOLUME_TOTAL_DEMANDA}">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label class="font-weight-normal" for="volume-total-demanda-tratada">5. Volume total demanda tratada</label>

                                                <input 
                                                    type="number" 
                                                    name="volumeTotalTratada" 
                                                    id="volume-total-demanda-tratada"
                                                    class="form-control"
                                                    value="${item.VOLUME_TOTAL_TRATADA}">
                                            </div>    
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h4>Período de Apuração</h4>
                                            </div>    
                        
                                            <div class="col lg-3">
                                                <label class="font-weight-normal" for="periodo-inicio">6.1. Início do período apurado</label>
                                                <input 
                                                    type="text" 
                                                    name="periodoTratadoDe" 
                                                    id="periodo-inicio"
                                                    class="form-control datepicker"
                                                    value="${periodoDE}"
                                                    onkeyup="
                                                    var v = this.value;
                                                    if (v.match(/^\d{2}$/) !== null) {
                                                        this.value = v + '/';
                                                    } else if (v.match(/^\d{2}\/\d{2}$/) !== null) {
                                                        this.value = v + '/';
                                                    }"
                                                    maxlength="10"
                                                    >
                                            </div>

                                            <div class="col lg-3">
                                                <label class="font-weight-normal" for="periodo-fim">6.2. Fim do período apurado</label>
                                                <input 
                                                    type="text" 
                                                    name="periodoTratadoate" 
                                                    id="periodo-fim"
                                                    class="form-control datepicker"
                                                    value="${periodoATE}"
                                                    onkeyup="
                                                    var v = this.value;
                                                    if (v.match(/^\d{2}$/) !== null) {
                                                        this.value = v + '/';
                                                    } else if (v.match(/^\d{2}\/\d{2}$/) !== null) {
                                                        this.value = v + '/';
                                                    }"
                                                    maxlength="10">
                                            </div>

                                            <div class="col lg-3">
                                                <label class="font-weight-normal" for="media-dia">6.3. Média de Atendimentos por dia </label>
                                                <input 
                                                    type="number"
                                                    min="1" 
                                                    name="mediaDia" 
                                                    id="media-atendimento-dia"
                                                    class="form-control"
                                                    value="${item.MEDIA_DIA}">
                                            </div>

                                            <div class="col lg-3">
                                                <label class="font-weight-normal" for="tempo-realizado-microprocesso">6.4. Tempo de realização (minutos)</label>                                    
                                                <input 
                                                    type="number" 
                                                    name="tempoEmMinutos" 
                                                    id="tempo-realizado-microprocesso"
                                                    class="form-control"
                                                    value="${item.TEMPO_EM_MINUTOS}">
                                            </div>
                                        </div>

                                        <hr>           

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h5>Nível de Complexidade</h5>
                                            </div>
                                            <div class="col-6">     
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input" name="nivelComplexidade" id="nivel-complexidade-${item.idMicro}1" value = "1" ${item.NIVEL_COMPLEXIDADE == "1.0" ? 'cheked':''}>
                                                    <label class="custom-control-label font-weight-normal" for="nivel-complexidade-1">Muito baixo</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input" name="nivelComplexidade" id="nivel-complexidade-${item.idMicro}2" value = "2" ${item.NIVEL_COMPLEXIDADE == "2.0" ? 'cheked':''}>
                                                    <label class="custom-control-label font-weight-normal" for="nivel-complexidade-2">Baixo</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input" name="nivelComplexidade" id="nivel-complexidade-${item.idMicro}3" value = "3" ${item.NIVEL_COMPLEXIDADE == "3.0" ? 'cheked':''}>
                                                    <label class="custom-control-label font-weight-normal" for="nivel-complexidade-3">Médio</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input" name="nivelComplexidade" id="nivel-complexidade-${item.idMicro}4" value = "4" ${item.NIVEL_COMPLEXIDADE == "4.0" ? 'cheked':''}>
                                                    <label class="custom-control-label font-weight-normal" for="nivel-complexidade-4">Alto</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">        
                                                    <input type="radio" class="custom-control-input" name="nivelComplexidade" id="nivel-complexidade-${item.idMicro}5" value = "5" ${item.NIVEL_COMPLEXIDADE == "5.0" ? 'cheked':''}>
                                                    <label class="custom-control-label font-weight-normal" for="nivel-complexidade-5">Muito Alto</label>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h5>Nível de Automação</h5>
                                            </div>
                                            <div class="col-6"> 
                                                <div class="custom-control custom-radio custom-control-inline"> 
                                                    <input type="radio" class="custom-control-input" name="nivelAutomacao" id="nivel-automacao-${item.idMicro}1" value = "1">
                                                    <label class="custom-control-label font-weight-normal" for="nivel-automacao-1">Muito baixo</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline"> 
                                                    <input type="radio" class="custom-control-input" name="nivelAutomacao" id="nivel-automacao-${item.idMicro}2" value = "2">
                                                    <label class="custom-control-label font-weight-normal" for="nivel-automacao-2">Baixo</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline"> 
                                                    <input type="radio" class="custom-control-input" name="nivelAutomacao" id="nivel-automacao-${item.idMicro}3" value = "3">
                                                    <label class="custom-control-label font-weight-normal" for="nivel-automacao-3">Médio</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline"> 
                                                    <input type="radio" class="custom-control-input"name="nivelAutomacao" id="nivel-automacao-${item.idMicro}4" value = "4">
                                                    <label class="custom-control-label font-weight-normal" for="nivel-automacao-4">Alto</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline"> 
                                                    <input type="radio" class="custom-control-input" name="nivelAutomacao" id="nivel-automacao-${item.idMicro}5" value = "5">
                                                    <label class="custom-control-label font-weight-normal" for="nivel-automacao-5">Muito Alto</label>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h5>Grau de Criticidade</h5>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-radio custom-control-inline"> 
                                                    <input type="radio" class="custom-control-input" name="grauCriticidade" id="nivel-criticidade-${item.idMicro}1" value = "1">
                                                    <label class="custom-control-label font-weight-normal" for="nivel-criticidade-1">Muito baixo</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline"> 
                                                    <input type="radio" class="custom-control-input" name="grauCriticidade" id="nivel-criticidade-${item.idMicro}2" value = "2">
                                                    <label class="custom-control-label font-weight-normal" for="nivel-criticidade-2">Baixo</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline"> 
                                                    <input type="radio" class="custom-control-input" name="grauCriticidade" id="nivel-criticidade-${item.idMicro}3" value = "3">
                                                    <label class="custom-control-label font-weight-normal" for="nivel-criticidade-3">Médio</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline"> 
                                                    <input type="radio" class="custom-control-input" name="grauCriticidade" id="nivel-criticidade-${item.idMicro}4" value = "4">
                                                    <label class="custom-control-label font-weight-normal" for="nivel-criticidade-4">Alto</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline"> 
                                                    <input type="radio" class="custom-control-input" name="grauCriticidade" id="nivel-criticidade-${item.idMicro}5" value = "5">
                                                    <label class="custom-control-label font-weight-normal" for="nivel-criticidade-5">Muito Alto</label>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>  

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h5>Grau de Padronização</h5>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-radio custom-control-inline"> 
                                                    <input type="radio" class="custom-control-input" name="grauPadronizacao" id="nivel-padronizacao-${item.idMicro}1" value = "1">
                                                    <label class="custom-control-label font-weight-normal" for="nivel-padronizacao-1">Muito baixo</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline"> 
                                                    <input type="radio" class="custom-control-input" name="grauPadronizacao" id="nivel-padronizacao-${item.idMicro}2" value = "2">
                                                    <label class="custom-control-label font-weight-normal" for="nivel-padronizacao-2">Baixo</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline"> 
                                                    <input type="radio" class="custom-control-input" name="grauPadronizacao" id="nivel-padronizacao-${item.idMicro}3" value = "3">
                                                    <label class="custom-control-label font-weight-normal" for="nivel-padronizacao-3">Médio</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline"> 
                                                    <input type="radio" class="custom-control-input" name="grauPadronizacao" id="nivel-padronizacao-${item.idMicro}4" value = "4">
                                                    <label class="custom-control-label font-weight-normal" for="nivel-padronizacao-4">Alto</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline"> 
                                                    <input type="radio" class="custom-control-input" name="grauPadronizacao" id="nivel-padronizacao-${item.idMicro}5" value = "5">
                                                    <label class="custom-control-label font-weight-normal" for="nivel-padronizacao-5">Muito Alto</label>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h5>Grau de Autonomia</h5>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-radio custom-control-inline"> 
                                                    <input type="radio" class="custom-control-input" name="grauAutonomia" id="nivel-autonomia-${item.idMicro}1" value = "1">
                                                    <label class="custom-control-label font-weight-normal" for="nivel-autonomia-1">Muito baixo</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline"> 
                                                    <input type="radio" class="custom-control-input" name="grauAutonomia" id="nivel-autonomia-${item.idMicro}2" value = "2">    
                                                    <label class="custom-control-label font-weight-normal" for="nivel-autonomia-2">Baixo</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline"> 
                                                    <input type="radio" class="custom-control-input" name="grauAutonomia" id="nivel-autonomia-${item.idMicro}3" value = "3">
                                                    <label class="custom-control-label font-weight-normal" for="nivel-autonomia-3">Médio</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline"> 
                                                    <input type="radio" class="custom-control-input" name="grauAutonomia" id="nivel-autonomia-${item.idMicro}4" value = "4">
                                                    <label class="custom-control-label font-weight-normal" for="nivel-autonomia-4">Alto</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline"> 
                                                    <input type="radio" class="custom-control-input" name="grauAutonomia" id="nivel-autonomia-${item.idMicro}5" value = "5">
                                                    <label class="custom-control-label font-weight-normal" for="nivel-autonomia-5">Muito Alto</label>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h5>Sistema de Origem Informação</h5>
                                            </div>
                                            <div class="col-6">  
                                                <textarea 
                                                    name="sistemaOrigemInformacao" 
                                                    id="sistema-origem-informacao" 
                                                    cols="50" 
                                                    rows="2"
                                                    >${item.SISTEMA_ORIGEM_INFORMACAO}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Alterar</button>
                                    </div>

                                </form> 
                            </div>
                        </div>
                    </div>
                    ` 

                    if( item.EXCLUIDO_USUARIO == 'N'){
                        $(micro).appendTo('#menu-' + item.IdMacroProcesso);
                        $(`<li id='micro${item.idMicro}'>
                        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#criarAtividade${item.idMicro}"><i style="color: #054f77; font-size: 13pt;" class="fas fa-plus"></i></button>${item.NOME_MICROATIVIDADE}
                            <div class="modal fade" id="criarAtividade${item.idMicro}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Adicionar atividade em ${item.NOME_MICROATIVIDADE}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/produtividade-cepat/cria-atividade-da-micro/${item.idMicro}" method="post">
                                <input type="hidden" name="_token" value="${csrfVarCepat}">
                                <div class="modal-body">
                                    <label class="font-weight-normal" for="nomeAtividade">1. Nome nova atividade</label>
                                    <input type="text" class="form-control" name="nomeAtividade" id="nomeAtividade">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                                </div>
                            </div>
                            </div>
                        </li>`).appendTo('#listaAtividade' + item.IdMacroProcesso);
                    }
                
                $('#opc-mensuravel-'+item.idMicro+item.MENSURAVEL).prop("checked", true);
                $('#nivel-complexidade-'+item.idMicro + Math.floor(item.NIVEL_COMPLEXIDADE)).prop("checked", true);
                $('#nivel-automacao-'+item.idMicro + Math.floor(item.NIVEL_AUTOMACAO)).prop("checked", true);
                $('#nivel-criticidade-'+item.idMicro + Math.floor(item.GRAU_CRITICIDADE)).prop("checked", true);
                $('#nivel-padronizacao-'+item.idMicro + Math.floor(item.GRAU_PADRONIZACAO)).prop("checked", true);
                $('#nivel-autonomia-'+item.idMicro + Math.floor(item.GRAU_AUTONOMIA)).prop("checked", true);
                
                $.each(item.atividade_da_micro, function(key, item) { 
                    $(`<ul><li>${item.NOME_ATIVIDADE}</li></ul>`).appendTo('#micro' + item.idMicro);
                })

                $('#formUpdate' + item.idMicro).submit( function(e) {
                    e.preventDefault();
                    var $input = $(this).find('[name=excluirMicroAtividade]:checked');
                    
                    if ($input.val() == 'Naoexcluir'){
                        this.submit();
                    }else{
                        if (confirm('tem certeza que deseja excluir ??')) {
                            this.submit();
                            } else {
                            // Do nothing!
                            }
                    }
                })           
            })  
        })
    }).done(function() {
        var linhasDatatable = document.getElementById("tblAtividadescepat").rows.length;

        if (linhasDatatable < 2){
            $("#cardTabela").css("display", "none");
            $("#cardExplicacao").css("display", "block");
        }else{
            $("#cardExplicacao").css("display", "none");
            $("#cardTabela").css("display", "block");
        }

        $("#nivel-complexidade-").prop("checked", true);
        
        lista.forEach(function(valor, chave){
            sortUL('#menu-'+valor);
        });
    })
})


