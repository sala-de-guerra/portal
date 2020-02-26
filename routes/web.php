<?php

//index
Route::get('', function () {
    return view('portal.index');
});

// route 404
Route::fallback(function(){return response()->view('errors.404', [], 404);});

//teste
Route::get('teste', function () {
    return view('teste');
});    

// sobre
Route::get('sobre', function () {
    return view('portal.informativas.sobre');
});

// area de atuação
Route::get('area', function () {
    return view('portal.informativas.area');
});

// duvidas frequentes
Route::get('faq', function () {
    return view('portal.informativas.faq');
});

// orientações
Route::get('orientacoes', function () {
    return view('portal.informativas.orientacoes');
});

// conheca o projeto
Route::get('projeto', function () {
    return view('portal.informativas.projeto');
});

// Pesquisar

Route::get('pesquisar', function () {
    return view('portal.imoveis.pesquisar');
});

Route::prefix('indicadores')->group(function () {
    Route::get('distrato', function () {
        return view('portal.imoveis.distrato.indicadores-distrato');
    });    
});

// Consulta de bem imóvel
Route::get('consulta-bem-imovel/{contrato}', 'GestaoImoveisCaixa\ConsultaContratoController@show');


//  ROTAS WEB DOS PROCESSOS PERTINENTES AO ESTOQUE DE IMÓVEIS
Route::prefix('estoque-imoveis')->group(function () {
    // ROTAS API DE CONSULTA JSON
    Route::get('consulta-contrato/{contrato}', 'GestaoImoveisCaixa\ConsultaContratoController@capturaDadosBaseSimov');
    Route::get('consulta-mensagens-enviadas/{contrato}', 'GestaoImoveisCaixa\ConsultaContratoController@consultaMensagensEnviadas');
    Route::get('consulta-historico-contrato/{contrato}', 'GestaoImoveisCaixa\ConsultaContratoController@consultaHistorico');

    // ROTAS DO PROJETO DE CONSULTA COM WHERE VARIAVEL (GOOGLE 2.0)
    Route::prefix('consultar-imovel')->group(function () {
        Route::get('/', 'GestaoImoveisCaixa\ConsultaContratoController@consultaImovelComWhereVariavel');
        Route::post('resultado', 'GestaoImoveisCaixa\ConsultaContratoController@pesquisaContratoComWhereVariavel');
    });

    // ROTAS DO PROJETO DE DISTRATO
    Route::prefix('distrato')->group(function () {
        Route::get('/', 'GestaoImoveisCaixa\DistratoDemandaController@index');
        Route::get('consultar-dados-demanda/{contrato}', 'GestaoImoveisCaixa\DistratoDemandaController@jsonDadosDemanda');
        Route::get('listar-protocolos', 'GestaoImoveisCaixa\DistratoDemandaController@listarDemandas');
        Route::get('relacao-despesas/{distrato}', 'GestaoImoveisCaixa\DistratoRelacaoDespesasController@listarRelacaoDeDespesas');
        Route::get('tratar/{contrato}', 'GestaoImoveisCaixa\DistratoDemandaController@visualizarDemanda');
        Route::post('cadastrar-demanda', 'GestaoImoveisCaixa\DistratoDemandaController@cadastrarDemanda');
        Route::post('cadastrar-despesa/{distrato}', 'GestaoImoveisCaixa\DistratoRelacaoDespesasController@cadastrarDespesa');
        Route::put('alterar-demanda-distrato/{distrato}', 'GestaoImoveisCaixa\DistratoDemandaController@alterarDemanda');
        Route::put('atualizar/{demanda}', 'GestaoImoveisCaixa\DistratoDemandaController@analisarDemanda');
        Route::put('atualizar-despesa/{despesa}', 'GestaoImoveisCaixa\DistratoRelacaoDespesasController@atualizarDespesa');
        Route::put('emitir-parecer-analista/{distrato}', 'GestaoImoveisCaixa\DistratoDemandaController@emitirParecerAnalista');
        Route::put('emitir-parecer-gestor/{distrato}', 'GestaoImoveisCaixa\DistratoDemandaController@emitirParecerGestor');
        Route::get('indicadores-distrato', 'GestaoImoveisCaixa\DistratoDemandaController@indicadoresDistrato');
        Route::put('excluir-despesa/{despesa}', 'GestaoImoveisCaixa\DistratoRelacaoDespesasController@excluirDespesa');
        Route::put('validar-despesa/{despesa}', 'GestaoImoveisCaixa\DistratoRelacaoDespesasController@validarDespesa');
        Route::get('emite-dle-despesas/{distrato}', 'GestaoImoveisCaixa\DistratoRelacaoDespesasController@emitePlanilhaDleDespesas');
    });

    // ROTAS DO PROJETO MONITORA PAGAMENTO SINAL (5% DA PROPOSTA)
    Route::prefix('monitora-pagamento-sinal')->group(function () {
        Route::get('/', 'GestaoImoveisCaixa\MonitoraPagamentoSinalController@index');
        Route::get('listar-contratos-sem-pagamento-sinal', 'GestaoImoveisCaixa\MonitoraPagamentoSinalController@listarContratosSemPagamentoSinal');
    });

    // ROTAS DO PROJETO ACOMPANHA CONTRATACAO
    Route::prefix('acompanha-contratacao')->group(function () {
        Route::get('/', 'GestaoImoveisCaixa\ConformidadeContratataoController@consultaContratosContratacaoSessentaDias');
        Route::get('listar-contratos-em-contratacao-ultimos-sessenta-dias', 'GestaoImoveisCaixa\ConformidadeContratataoController@acompanhaContratacao');
    });

    // ROTAS DO PROJETO DE CONFORMIDADE CONTRATACAO
    Route::prefix('conformidade-contratacao')->group(function () {
        Route::get('/', 'GestaoImoveisCaixa\ConformidadeContratataoController@index');
        Route::get('listar-contratos', 'GestaoImoveisCaixa\ConformidadeContratataoController@listarContratosConformidade');
    });

    // ROTA PARA REGISTRO DE HISTÓRICO
    Route::post('registrar-historico/{contrato}', 'GestaoImoveisCaixa\RegistroAtendimentoController@registrarHistorico');

    // ROTAS DO PROJETO DE MENSAGENS AUTOMÁTICAS
    Route::prefix('mensagens-automaticas')->group(function () {
        Route::get('autorizacao-contratacao', 'GestaoImoveisCaixa\MensagensAutomaticaAutorizacaoController@enviarMensageriasAutorizacaoContratacao');
        Route::get('autorizacao-contratacao/{contrato}', 'GestaoImoveisCaixa\MensagensAutomaticaAutorizacaoController@enviarAutorizacaoContratacaoViaPortal');
    });
});

// ROTA QUE ATUALIZA O JSON DA CONSULTA DE IMÓVEIS
Route::prefix('portal')->group(function () {
    Route::get('cria-json-google', 'JsonGooglePortal@criaJsonParaAbastecerBarraPesquisaGoogle');
});

// Gerencial

// equipes
Route::get('/equipes', function () {
    return view('portal.gerencial.equipes');
});
