<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulário de Microatividades</title>
</head>
<body>



    
<form action="produtividade-cepat/cria-micro-atividade" method="post">

    {{ csrf_field() }}

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

        <button type="submit">Gravar </button>


</form>


</body>
</html>