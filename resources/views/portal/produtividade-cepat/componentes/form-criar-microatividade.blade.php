
@section('form-basico')

    
<form action="produtividade-cepat/cria-micro-atividade" method="post">

    <label for="nome-microatividade">Nome da Microatividade</label>
        <input type="text" 
            name="nomeMicroAtividade" 
            id="nome-microatividade"
            placeholder="Digite o nome da microatividade"
            required>
    
    <label for="quantidade-pessoas-alocadas">Quantidade de pessoas alocadas</label>
        <input type="number" 
            name="quantidadePessoasAlocadas" 
            id="quantidade-pessoas-alocadas"
            step="0.1"
            min="0.1"
            required>

    <legend class="">Esta atividade é Mensurável?</legend>

        <input type="radio" id="opc-mensuravel-s" name="mensuravel" value="SIM" checked>
        <label for="opc-mensuravel-s">Sim</label><br>
        
        <input type="radio" id="opc-mensuravel-n" name="mensuravel" value="NAO">
        <label for="opc-mensuravel-n">Não</label><br>

    <label for="volume-total-demanda">Volume total demanda recebida</label>
        <input 
            type="number" 
            name="volumeTotalDemanda" 
            id="volume-total-demanda">

    <label for="volume-total-demanda-tratada">Volume total demanda tratada</label>
        <input 
            type="number" 
            name="volumeTotalTratada" 
            id="volume-total-demanda-tratada">
    
    <legend>Período de Apuração</legend>

    <label for="periodo-inicio">Início do período apurado</label>
    <input 
        type="date" 
        name="periodoTratadoDe" 
        id="periodo-inicio">
    
    <label for="periodo-fim">Fim do período apurado</label>
    <input 
        type="date" 
        name="periodoTratadoate" 
        id="periodo-fim">

    <label for="media-dia">Média de Atendimentos por dia </label>
    <input 
        type="number" 
        name="mediaDia" 
        id="media-dia"
        step="0.1">
    
    <label for="tempo-realizado-microprocesso">Tempo de realização do microprocesso</label>
    <input 
        type="number" 
        name="tempoEmMinutos" 
        id="tempo-realizado-microprocesso">
    
    <legend>Nivel de Complexidade</legend>
        
        <label for="nivel-complexidade-1">Muito baixo</label>
        <input type="radio" name="nivelComplexidade" id="nivel-complexidade-1" value = "1">

        <label for="nivel-complexidade-2">Baixo</label>
        <input type="radio" name="nivelComplexidade" id="nivel-complexidade-2" value = "2">

        <label for="nivel-complexidade-3">Médio</label>
        <input type="radio" name="nivelComplexidade" id="nivel-complexidade-3" value = "3">

        <label for="nivel-complexidade-4">Alto</label>
        <input type="radio" name="nivelComplexidade" id="nivel-complexidade-4" value = "4">

        <label for="nivel-complexidade-5">Muito Alto</label>
        <input type="radio" name="nivelComplexidade" id="nivel-complexidade-5" value = "5">

    
    <legend>Nivel de Automação</legend>
        
        <label for="nivel-automacao-1">Muito baixo</label>
        <input type="radio" name="nivelAutomacao" id="nivel-automacao-1" value = "1">

        <label for="nivel-automacao-2">Baixo</label>
        <input type="radio" name="nivelAutomacao" id="nivel-automacao-2" value = "2">

        <label for="nivel-automacao-3">Médio</label>
        <input type="radio" name="nivelAutomacao" id="nivel-automacao-3" value = "3">

        <label for="nivel-automacao-4">Alto</label>
        <input type="radio" name="nivelAutomacao" id="nivel-automacao-4" value = "4">

        <label for="nivel-automacao-5">Muito Alto</label>
        <input type="radio" name="nivelAutomacao" id="nivel-automacao-5" value = "5">

    <legend>Grau de Criticidade</legend>
        
        <label for="nivel-citicidade-1">Muito baixo</label>
        <input type="radio" name="grauCriticidade" id="nivel-citicidade-1" value = "1">

        <label for="nivel-citicidade-2">Baixo</label>
        <input type="radio" name="grauCriticidade" id="nivel-citicidade-2" value = "2">

        <label for="nivel-citicidade-3">Médio</label>
        <input type="radio" name="grauCriticidade" id="nivel-citicidade-3" value = "3">

        <label for="nivel-citicidade-4">Alto</label>
        <input type="radio" name="grauCriticidade" id="nivel-citicidade-4" value = "4">

        <label for="nivel-citicidade-5">Muito Alto</label>
        <input type="radio" name="grauCriticidade" id="nivel-citicidade-5" value = "5">

    
    <legend>Grau de Padronização</legend>
        
        <label for="nivel-padronizacao-1">Muito baixo</label>
        <input type="radio" name="grauPadronizacao" id="nivel-padronizacao-1" value = "1">

        <label for="nivel-padronizacao-2">Baixo</label>
        <input type="radio" name="grauPadronizacao" id="nivel-padronizacao-2" value = "2">

        <label for="nivel-padronizacao-3">Médio</label>
        <input type="radio" name="grauPadronizacao" id="nivel-padronizacao-3" value = "3">

        <label for="nivel-padronizacao-4">Alto</label>
        <input type="radio" name="grauPadronizacao" id="nivel-padronizacao-4" value = "4">

        <label for="nivel-padronizacao-5">Muito Alto</label>
        <input type="radio" name="grauPadronizacao" id="nivel-padronizacao-5" value = "5">

    
    <legend>Grau de Autonomia</legend>
        
        <label for="nivel-autonomia-1">Muito baixo</label>
        <input type="radio" name="grauAutonomia" id="nivel-autonomia-1" value = "1">

        <label for="nivel-autonomia-2">Baixo</label>
        <input type="radio" name="grauAutonomia" id="nivel-autonomia-2" value = "2">

        <label for="nivel-autonomia-3">Médio</label>
        <input type="radio" name="grauAutonomia" id="nivel-autonomia-3" value = "3">

        <label for="nivel-autonomia-4">Alto</label>
        <input type="radio" name="grauAutonomia" id="nivel-autonomia-4" value = "4">

        <label for="nivel-autonomia-5">Muito Alto</label>
        <input type="radio" name="grauAutonomia" id="nivel-autonomia-5" value = "5">

    <button type="submit"> Gravar</button>
</form>


@endsection




@section('form-criar-microatividade')

<div class="row">
<form method="post" action="produtividade-cepat/cria-micro-atividade" id="formMicroatividade">
<div class="modal-body">
    {{ csrf_field() }}

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="nomeMicroAtividade">Nome da Micro Atividade:</label>&nbsp&nbsp&nbsp&nbsp&nbsp
            <input type="text" class="form-control" id="nomeMicroAtividade" rows="1" name="nomeMicroAtividade" placeholder="Digite aqui..." required>
        </div>

        <div class="form-group col-md-6">
                <legend class="col-form-label col-sm-6 pt-0"><b>Esta atividade é Mensurável?</b></legend>
                <div class="custom-control custom-radio custom-control-inline">
                    <input class="custom-control-input" type="radio" name="mensuravel" id="opc_mensuravel" value="S" checked>
                    <label class="custom-control-label" for="opc_mensuravel">Sim</label>
                
                    <input class="custom-control-input" type="radio" name="mensuravel" id="exampleRadios2" value="N">
                    <label class="custom-control-label" for="exampleRadios2">Não</label>
                </div>
            
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-4 mb-3">
            <label for="volTotDemanda">Volume Total de Demanda</label>

            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalInfoVolTot"><i style="color: #054f77; font-size: 13pt;" class="fas fa-info-circle"></i></button>

            <div class="modal fade" id="modalInfoVolTot" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            aqui vai o texto
                        </div>
                    </div>
                </div>
            </div>

            <input type="text" class="form-control" id="volTotDemanda" name="volumeTotalDemanda" required>
        </div>

        <div class="col-md-4 mb-3">
            <label for="volTratDemanda">Volume Demanda Tratada</label>
            <input type="text" class="form-control" id="volTratDemanda" name="volumeTotalTratada" required> 
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-4 mb-3">
            <div class="form-row">
                <legend class="col-form-label pt-0"><b>Período de Apuração</b></legend>
                <div class="col">
                    <div class="form-group">
                        <label for="periodoTratadoDe">Informar Data de Início</label>
                        <input type="date" class="form-control" name="periodoTratadoDe" autocomplete="off" id="periodoTratadoDe" placeholder="DD/MM/AAAA" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="periodoTratadoate">Informar Data Final</label>
                        <input type="date" class="form-control" name="periodoTratadoate" autocomplete="off" id="periodoTratadoate" placeholder="DD/MM/AAAA" required>
                    </div>
                </div>
            </div>
        </div>
    

        <div class="col-md-4 mb-3">
            <label for="mediaDia">Média/Dia</label>
            <input type="text" class="form-control" id="mediaDia" name="mediaDia" required> 
        </div>

        <div class="col-md-4 mb-3">
            <label for="tempoMin">Tempo Realização do Microprocesso</label>
            <input type="text" class="form-control" id="tempoMin" name="tempoEmMinutos" placeholder="Valor em minutos"required> 
        </div>
    </div>

    <div class="form-group">
        <label for="nivelComplexidade">Nível de Complexidade</label>
        <select class="form-control" id="nivelComplexidade" name="nivelComplexidade" required>
            <option selected>Escolha...</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
    </div>

    <div class="form-group">
        <label for="nivelAutomacao">Nível de Automação</label>
        <select class="form-control" id="nivelAutomacao" name="nivelAutomacao" required>
            <option selected>Escolha...</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
    </div>

    <div class="form-row">
        <div class="col-md-4 mb-3">
            <label for="grauCriticidade">Grau de Criticidade</label>
            <select class="form-control" id="grauCriticidade" name="grauCriticidade" required>
                <option selected>Escolha...</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>

        <div class="col-md-4 mb-3">
            <label for="grauPadronizacao">Grau de Padronização</label>
            <select class="form-control" id="grauPadronizacao" name="grauPadronizacao" required>
                <option selected>Escolha...</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>

        <div class="col-md-4 mb-3">
            <label for="grauAutonomia">Grau de Autonomia</label>
            <select class="form-control" id="grauAutonomia" name="grauAutonomica" required>
                <option selected>Escolha...</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>
    </div>

    <div class="form-group col-md-6">
        <label for="qtdsistemaOrigemInformacaoPessoas">Medida de Apuração</label>
        <input type="text" class="form-control" id="sistemaOrigemInformacao" name="sistemaOrigemInformacao" required>
    </div>

</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
    <button type="submit" class="btn btn-primary">Salvar</button>
</div>

</form>
</div>
@endsection
