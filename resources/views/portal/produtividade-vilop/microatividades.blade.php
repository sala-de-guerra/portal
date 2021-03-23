@extends('portal.produtividade-vilop.template')
@extends('portal.produtividade-vilop.componentes.menu-lateral')


@section('saudacao')
    <h5 class="col-lg-12 callout callout-info">
        <strong> CGC/UNIDADE   {{$unidadeCGC ?? ''}} </strong> - {{ $unidadeNome ?? ''}}
        <br> Ref: Macroatividade - {{$nomeMacroAtividade ?? ''}}
    </h5>
    
@endsection


@section('conteudo')
@if (session('tituloMensagem'))
<div id="fadeOut" class="card text-white bg-{{ session('corMensagem') }}">
    <div class="card-header">
        <div class="card-body">
            <h5 class="card-title"><strong>{{ session('tituloMensagem') }}</strong></h5>
            <br>
            <p class="card-text">{{ session('corpoMensagem') }}</p>
        </div>
    </div>
</div>
@endif
<div class="card">
	<div class="card-header"> 
        <h4>
            <i class="nav-icon fas fa-chart-pie"></i> 
            Microatividade - Detalhamento
        </h4>
           
        </form>
    
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="form-group">
            <form action="/produtividade-vilop/cria-micro-atividade/{{$idMacro ?? ''}}" method="post">
                {{ csrf_field() }}
                <input type="hidden"  name="unidadeCGC" value="{{$unidadeCGC}}">

                <label class="font-weight-normal" for="nome-microatividade">1. Nome da Microatividade &nbsp</label>
                <a href="#" data-toggle="tooltip" data-placement="top" 
                    data-html="true"
                    title="<p>Os microprocessos são o conjunto de atividades e tarefas sequenciais com começo, meio e fim na unidade.</p>
                    <p> O detalhamento deve acompanhar a possibilidade ou não de se apurar o volume, a fte alocada, o tempo gasto, bem como a necessidade de se apurar a produtividade de forma individual.</p>">
                        <i class="far fa-question-circle 5x"></i>
                </a>

                <input type="text" 
                    name="nomeMicroAtividade" 
                    id="nome-microatividade"
                    placeholder="Digite o nome da microatividade"
                    class="form-control"
                    required>
        </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-inline">
                        <label class="font-weight-normal" for="quantidade-pessoas-alocadas">2. Quantidade de pessoas alocadas &nbsp</label>
                        <a tabindex="-1"
                            href="#" data-toggle="tooltip" data-placement="top" 
                            data-html="true"
                            title="<p>A quantidade pessoas alocadas deve ser calculada com a soma da  dedicação dos funcionários que realizam o microprocesso.</p>
                                <p>Pode ser número com casa decimal, formato 'x,x'. Deverá ser considerado que 1 funcionário trabalha por 300 min/dia, 20 dias por mês.</p>
                                <p><em>Ex.: 3 funcionários se dedicam por 2,5 horas, ou 50% do seu tempo</em>.</p>
                                <p>A quantidade de pessoas alocadas no microprocesso é de 1,5 pessoas!</p>">
                                <i class="far fa-question-circle 5x"></i>
                        </a> &nbsp

                        <input type="number" 
                            name="quantidadePessoasAlocadas" 
                            id="quantidade-pessoas-alocadas"
                            step="0.1"
                            class="form-control ml-1"
                            placeholder="Ex: 1,5"
                            title="Por favor, preencha somente com números"
                            required>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-inline">
                        <h5 class="text-danger">3. Esta atividade é Mensurável?** &nbsp</h5>
                        <a tabindex="-1"
                            href="#" data-toggle="tooltip" data-placement="top" 
                            data-html="true"
                            title="<p>Possibilidade de se tangibilizar o volume, a força de tabalho alocada e tempo gasto.</p>
                            <p><em>Ex. Atividade não mensurável: administrativo, caixa postal, teams, apresentações, reuniões e etc.</em></p>">
                            <i class="far fa-question-circle 5x"></i>
                        </a>     &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp           
                        <div class="form-check form-check-inline">
                            <input type="radio" 
                            id="opc-mensuravel-s" 
                            name="mensuravel" 
                            value="S" 
                            class="form-check-input"  
                            onclick="mensuravelClicado()"
                            checked>
                            <label for="opc-mensuravel-s" class="form-check-label">Sim</label><br>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" 
                            id="opc-mensuravel-n" 
                            name="mensuravel" 
                            value="N" 
                            class="form-check-input" 
                            onclick="mensuravelClicado()">
                            <label for="opc-mensuravel-n" class="form-check-label">Não</label><br>
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
                    <label class="font-weight-normal" for="volume-total-demanda">4. Volume total demanda recebida &nbsp</label>
                    <a  tabindex="-1"
                        href="#" data-toggle="tooltip" data-placement="top" 
                        data-html="true"
                        title="Volume total recebido no período de apuração">
                        <i class="far fa-question-circle 5x"></i>
                    </a>  
                        <input 
                            type="number" 
                            name="volumeTotalDemanda" 
                            id="volume-total-demanda-recebida"
                            class="form-control"
                            placeholder="Ex: 140">
                </div>

                <div class="form-group col-lg-6">
                    <label class="font-weight-normal" for="volume-total-demanda-tratada">5. Volume total demanda tratada &nbsp</label>
                    <a  tabindex="-1"
                        href="#" data-toggle="tooltip" data-placement="top" 
                        data-html="true"
                        title="Volume tratado no período de apuração">
                        <i class="far fa-question-circle 5x"></i>
                    </a>  
                        <input 
                            type="number" 
                            name="volumeTotalTratada" 
                            id="volume-total-demanda-tratada"
                            class="form-control"
                            placeholder="Ex: 120">
                </div>
            </div>

            <hr>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-start">
                        <h4>Período de Apuração &nbsp</h4>
                        <a tabindex="-1"
                            href="#" data-toggle="tooltip" data-placement="top" 
                            data-html="true"
                            title="<p>Período de apuração dos dados da volumetria</p>
                            <p><em>Ex.: 01/10/2020 a 31/01/2021</em></p>">
                            <span><i class="far fa-question-circle"></i></span>
                        </a>
                    </div>    
                </div>
            
                <div class="col lg-3">
                    <label class="font-weight-normal" for="periodo-inicio">6.1. Início do período apurado &nbsp</label>
                    <input 
                        type="text" 
                        name="periodoTratadoDe" 
                        id="periodo-inicio"
                        class="form-control datepicker"
                        placeholder="Ex: 01/10/2020"
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
                        placeholder="Ex: 31/01/2021"
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
                    <label class="font-weight-normal" for="media-dia">6.3. Média de Atendimentos por dia &nbsp</label>
                    <a 
                        tabindex="-1"
                        href="#" data-toggle="tooltip" data-placement="top" 
                        data-html="true"
                        title="<p>Quantidade apurada dividida por 20 dias úteis</p>">
                        <span><i class="far fa-question-circle"></i></span>
                    </a>        
                    <input 
                        type="number"
                        min="1" 
                        name="mediaDia" 
                        id="media-atendimento-dia"
                        class="form-control"
                        placeholder="Ex: 6">
                </div>

                <div class="col lg-3">
                    <label class="font-weight-normal" for="tempo-realizado-microprocesso">6.4. Tempo de realização (minutos) &nbsp</label>
                    <a 
                        tabindex="-1"
                        href="#" data-toggle="tooltip" data-placement="top" 
                        data-html="true"
                        title="<p>Tempo gasto para realização de 1(um) volume do microprocesso</p>">
                    <span><i class="far fa-question-circle"></i></span>
                    </a>                      
                    <input 
                        type="number"
                        step="0.10" 
                        name="tempoEmMinutos" 
                        id="tempo-realizado-microprocesso"
                        class="form-control"
                        placeholder="Ex: 5,00">
                </div>
            </div>
            <hr>
        
        <div class="row">
            <div class="col-sm-3">
                <div class="d-flex justify-content-start">
                    <h5>Nível de Complexidade &nbsp</h5>  
                    <a  tabindex="-1"
                        href="#" data-toggle="tooltip" data-placement="right" 
                        data-html="true"
                        title="
                        <p>Avalie o Nível de Complexidade que melhor descreve o microprocesso de acordo 
                            com os critérios e a afirmativa abaixo e selecione o número correspondente na escala:</p>
                        <p><b>Escala 1:</b> Atividade composta por elementos básicos em que há um ou poucos fatores a serem
                            apreciados, sendo de fácil entendimento e exigindo menor esforço intelectual para sua execução.</p>
                        <p><b>Escala 5:</b> Atividade que exige a análise de um conjunto de fatores de natureza diferenciada
                            e interdependentes, demandando para sua execução a apreciação dos fatos sob diversos ângulos,
                            requerendo capacidade intelectual elevada.</p>
                        ">
                        <span><i class="far fa-question-circle"></i></span>
                    </a>
                </div>
            </div>

            <div class="col-6">
                            
                <div class="form-check form-check-inline">
                    <input class="form-check-input"  type="radio" name="nivelComplexidade" id="nivel-complexidade-1" value = "1" required checked>
                    <label class="form-check-label" for="nivel-complexidade-1">Muito baixo</label>
                </div>
        
                <div class="form-check form-check-inline">
                    <input class="form-check-input"  type="radio" name="nivelComplexidade" id="nivel-complexidade-2" value = "2">
                    <label class="form-check-label" for="nivel-complexidade-2">Baixo</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input"  type="radio" name="nivelComplexidade" id="nivel-complexidade-3" value = "3">
                    <label class="form-check-label" for="nivel-complexidade-3">Médio</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input"  type="radio" name="nivelComplexidade" id="nivel-complexidade-4" value = "4">
                    <label  class="form-check-label" for="nivel-complexidade-4">Alto</label>
                </div>                

                <div class="form-check form-check-inline">
                    <input class="form-check-input"  type="radio" name="nivelComplexidade" id="nivel-complexidade-5" value = "5">
                    <label class="form-check-label" for="nivel-complexidade-5">Muito Alto</label>
                </div>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-sm-3">
                <div class="d-flex justify-content-start">
                    <h5>Nível de Automação &nbsp</h5>
                    <a  tabindex="-1"
                        href="#" data-toggle="tooltip" data-placement="right" 
                        data-html="true"
                        title="
                        <p>Avalie o Nível de Automação que melhor descreve a atividade de acordo
                            com os critérios e a afirmativa abaixo e selecione o número 
                            correspondente na escala:</p>
                        <p><b>Escala 1:</b> Atividade realizada 100% de forma manual, mediante análise 
                            de um empregado, sem utilização de ferramentas/sistemas que automatizem o trabalho.</p>
                        <p><b>Escala 5:</b> Atividade realizada de forma 100% automatizada, sem interferência 
                            manual por um empregado.</p>
                        ">
                        <span><i class="far fa-question-circle"></i></span>
                    </a>
                </div>   
            </div>
            <div class="col-6">
                <div class="form-check form-check-inline">
                    <input class="form-check-input"  type="radio" name="nivelAutomacao" id="nivel-automacao-1" value = "1" required checked>
                    <label class="form-check-label"  for="nivel-automacao-1">Muito baixo</label>
                </div>

                <div class="form-check form-check-inline">    
                    <input class="form-check-input"  type="radio" name="nivelAutomacao" id="nivel-automacao-2" value = "2">
                    <label class="form-check-label" for="nivel-automacao-2">Baixo</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input"  type="radio" name="nivelAutomacao" id="nivel-automacao-3" value = "3">
                    <label  class="form-check-label" for="nivel-automacao-3">Médio</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input"  type="radio" name="nivelAutomacao" id="nivel-automacao-4" value = "4">
                    <label class="form-check-label" for="nivel-automacao-4">Alto</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input"  type="radio" name="nivelAutomacao" id="nivel-automacao-5" value = "5">
                    <label class="form-check-label" for="nivel-automacao-5">Muito Alto</label>
                </div>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-sm-3">
                <div class="d-flex justify-content-start">                  
                    <h5>Grau de Criticidade &nbsp</h5>   
                    <a  tabindex="-1"
                        href="#" data-toggle="tooltip" data-placement="right" 
                        data-html="true"
                        title="
                        <p>Avalie o Nível de criticidade que melhor descreve a atividade de acordo
                            com os critérios e a afirmativa abaixo e selecione o número 
                            correspondente na escala:</p>
                        <p><b>Escala 1:</b> Atividade com grau criticidade/relevância baixo 
                            para o alcance do objetivo da unidade.</p>
                        <p><b>Escala 5:</b> Atividade de extrema criticidade/relevância para o alcance do objetivo
                            da unidade e que representa a essência da unidade.</p>
                        ">
                        <span><i class="far fa-question-circle"></i></span>
                    </a>   
                </div>
            </div>
            <div class="col-6">
                <div class="form-check form-check-inline">
                    <input class="form-check-input"  type="radio" name="grauCriticidade" id="nivel-criticidade-1" value = "1" required checked>
                    <label class="form-check-label" for="nivel-criticidade-1">Muito baixo</label>
                </div>
        
                <div class="form-check form-check-inline">
                    <input class="form-check-input"  type="radio" name="grauCriticidade" id="nivel-criticidade-2" value = "2">
                    <label class="form-check-label" for="nivel-criticidade-2">Baixo</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input"  type="radio" name="grauCriticidade" id="nivel-criticidade-3" value = "3">
                    <label class="form-check-label" for="nivel-criticidade-3">Médio</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input"  type="radio" name="grauCriticidade" id="nivel-criticidade-4" value = "4">
                    <label class="form-check-label" for="nivel-criticidade-4">Alto</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input"  type="radio" name="grauCriticidade" id="nivel-criticidade-5" value = "5">
                    <label class="form-check-label" for="nivel-criticidade-5">Muito Alto</label>
                </div>
            </div>
        </div>
        <hr> 

        <div class="row">
            <div class="col-sm-3">
                <div class="d-flex justify-content-start">
                    <h5>Grau de Padronização &nbsp</h5>
                    <a  tabindex="-1"
                        href="#" data-toggle="tooltip" data-placement="right" 
                        data-html="true"
                        title="
                        <p>Avalie o Nível de Padronização  que melhor descreve a atividade de acordo
                            com os critérios e a afirmativa abaixo e selecione o número 
                            correspondente na escala:</p>
                        <p><b>Escala 1:</b> Atividade diversificada e não repetitiva.
                            As etapas e as habilidades exigidas são variadas, com alto grau de inovação.</p>
                        <p><b>Escala 5:</b> Atividade seqüencial, uniforme e repetitiva.
                            As etapas e habilidades exigidas são as mesmas, sem mudança/variação.</p>
                        ">
                        <span><i class="far fa-question-circle"></i></span>
                    </a>
                </div>
            </div>
            <div class="col-6">
                <div class="form-check form-check-inline">
                    <input class="form-check-input"  type="radio" name="grauPadronizacao" id="nivel-padronizacao-1" value = "1" required checked>
                    <label class="form-check-label" for="nivel-padronizacao-1">Muito baixo</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input"  type="radio" name="grauPadronizacao" id="nivel-padronizacao-2" value = "2">
                    <label class="form-check-label" for="nivel-padronizacao-2">Baixo</label>
                </div>

                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input"  name="grauPadronizacao" id="nivel-padronizacao-3" value = "3">
                    <label class="form-check-label" for="nivel-padronizacao-3">Médio</label>
                </div>

                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input"  name="grauPadronizacao" id="nivel-padronizacao-4" value = "4">
                    <label class="form-check-label" for="nivel-padronizacao-4">Alto</label>
                </div>

                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input"  name="grauPadronizacao" id="nivel-padronizacao-5" value = "5">
                    <label class="form-check-label" for="nivel-padronizacao-5">Muito Alto</label>
                </div>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-sm-3">
                <div class="d-flex justify-content-start">
                    <h5>Grau de Autonomia &nbsp</h5>
                    <a  tabindex="-1"
                        href="#" data-toggle="tooltip" data-placement="right" 
                        data-html="true"
                        title="
                        <p>Avalie o Nível de Autonomia que melhor descreve a atividade de acordo
                            com os critérios e a afirmativa abaixo e selecione o número 
                            correspondente na escala:</p>
                        <p><b>Escala 1:</b> Atividade executada com baixo grau de autonomia 
                            em relação às outras unidades.</p>
                        <p><b>Escala 5:</b> Atividade executadas 100% pela unidade, com começo - meio - 
                            fim na unidade. Sem necessidade de comunicação/providência/interferência 
                            de outras unidades.</p>
                        ">
                        <span><i class="far fa-question-circle"></i></span>
                    </a>
                </div>
            </div> 
            <div class="col-6">
                <div class="form-check form-check-inline">
                    <input class="form-check-input"  type="radio" name="grauAutonomia" id="nivel-autonomia-1" value = "1" required checked>
                    <label class="form-check-label" for="nivel-autonomia-1">Muito baixo</label>
                </div>
            
                <div class="form-check form-check-inline">
                    <input class="form-check-input"  type="radio" name="grauAutonomia" id="nivel-autonomia-2" value = "2">    
                    <label class="form-check-label" for="nivel-autonomia-2">Baixo</label>
                </div>
                
                <div class="form-check form-check-inline">
                    <input class="form-check-input"  type="radio" name="grauAutonomia" id="nivel-autonomia-3" value = "3">
                    <label class="form-check-label"for="nivel-autonomia-3">Médio</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input"  type="radio" name="grauAutonomia" id="nivel-autonomia-4" value = "4">
                    <label class="form-check-label" for="nivel-autonomia-4">Alto</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input"  type="radio" name="grauAutonomia" id="nivel-autonomia-5" value = "5">
                    <label class="form-check-label"for="nivel-autonomia-5">Muito Alto</label>
                </div>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-sm-3">
                <div class="d-flex justify-content-start">
                    <h5>Sistema de Origem Informação &nbsp</h5>
                    <a  tabindex="-1"
                        href="#" data-toggle="tooltip" data-placement="left" 
                        data-html="true"
                        title="
                        <p>Por gentileza especificar se existe algum sistema corporativo de controle.</p>
                        <p><em>Ex: Chamados Serviços.caixa, Atender.Caixa, Atende, CIWEB, SIMCN, etc.</em></p>
                        ">
                        <span><i class="far fa-question-circle"></i></span>
                    </a>
                </div>
            </div> 
            <div class="col-6">         
                <textarea 
                    name="sistemaOrigemInformacao" 
                    id="sistema-origem-informacao" 
                    cols="50" 
                    rows="2">
                </textarea>

                    {{--Implementar estilização dos radio? 
                        
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-secondary active">
                                <input type="radio" name="options" id="option1" autocomplete="off" checked> Active
                            </label>
                            <label class="btn btn-secondary">
                                <input type="radio" name="options" id="option2" autocomplete="off"> Radio
                            </label>
                            <label class="btn btn-secondary">
                                <input type="radio" name="options" id="option3" autocomplete="off"> Radio
                            </label>
                        </div> --}}
            </div>
        </div>

        <div class="float-right">
            <button type="submit" class="btn btn-primary mt-2 text-right"> <i class="far fa-save 3x"></i> Gravar Respostas</button>
        </div>


    </div>       
</div> <!-- /.card-body -->		
</div><!-- card -->
</div>

  
@endsection

@section('css')

@endsection

@section('js')

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<script>

function mensuravelClicado(){

    if(document.getElementById('opc-mensuravel-s').checked)
    {
        
        document.getElementById("volume-total-demanda-recebida").disabled=false;
        document.getElementById("volume-total-demanda-tratada").disabled=false;
        document.getElementById("tempo-realizado-microprocesso").disabled=false;
        document.getElementById("media-atendimento-dia").disabled=false;
        
    }
    else if(document.getElementById('opc-mensuravel-n').checked) 
    {
        
        document.getElementById("volume-total-demanda-recebida").setAttribute("disabled", "true");
        document.getElementById("volume-total-demanda-tratada").setAttribute("disabled", "true");
        document.getElementById("tempo-realizado-microprocesso").setAttribute("disabled", "true");
        document.getElementById("media-atendimento-dia").setAttribute("disabled", "true");
    }

}

$(document).ready(function(){
    $("html, body").animate({ 
        scrollTop: $('#pesquisar-unidades').offset().top 
    }, 1000);
});

</script>


@endsection
