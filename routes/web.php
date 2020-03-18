<?php

//index
Route::get('', function () {
    return view('portal.index');
})->name('index');

// route 404
Route::fallback(function(){return response()->view('errors.404', [], 404);});

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
Route::get('consulta-bem-imovel/{contrato}', 'GestaoImoveisCaixa\ConsultaContratoController@show')->name('consulta-bem-imovel');

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
    
    // ROTAS DO PROJETO ACOMPANHA CONTRATACAO
    Route::prefix('acompanha-contratacao')->group(function () {
        Route::get('/', 'GestaoImoveisCaixa\AcompanhamentoContratacaoController@consultaContratosContratacaoSessentaDias');
        Route::get('listar-contratos-em-contratacao-ultimos-sessenta-dias', 'GestaoImoveisCaixa\AcompanhamentoContratacaoController@listarContratosContratacaoUltimosSessentaDias');
        Route::get('listar-contratos-sem-pagamento-sinal', 'GestaoImoveisCaixa\MonitoraPagamentoSinalController@listarContratosSemPagamentoSinal');
        Route::put('/atualizar/{idAcompanhamentoContratacao}', 'GestaoImoveisCaixa\AcompanhamentoContratacaoController@atualizaAcompanhamentoContratacao');
    });

    // ROTAS DO PROJETO DE CONFORMIDADE CONTRATACAO
    Route::prefix('conformidade-contratacao')->group(function () {
        Route::get('/', 'GestaoImoveisCaixa\ConformidadeContratataoController@index');
        Route::get('listar-contratos', 'GestaoImoveisCaixa\ConformidadeContratataoController@listarContratosConformidade');
    });

    // ROTAS DO PROJETO DE LEILÕES
    Route::prefix('leiloes')->group(function () {
        Route::get('leiloes-negativos', function () {
            return view('portal.imoveis.leiloes.leiloes-negativos');
        });
        Route::get('tratar', function () {
            return view('portal.imoveis.leiloes.operacional-leiloes');
        });
    });

    // ROTA PARA REGISTRO DE HISTÓRICO
    Route::post('registrar-historico/{contrato}', 'GestaoImoveisCaixa\RegistroAtendimentoController@registrarHistorico');

    // ROTAS DO PROJETO DE MENSAGENS AUTOMÁTICAS
    Route::prefix('mensagens-automaticas')->group(function () {
        Route::get('autorizacao-contratacao', 'GestaoImoveisCaixa\MensagensAutomaticaAutorizacaoController@enviarMensageriasAutorizacaoContratacao');
        Route::get('autorizacao-contratacao/{contrato}', 'GestaoImoveisCaixa\MensagensAutomaticaAutorizacaoController@enviarAutorizacaoContratacaoViaPortal');
    });
});

// GERENCIAL
Route::prefix('gerencial')->group(function () {
    // GESTÃO DE EQUIPES
    Route::prefix('gestao-equipes')->group(function () {
        // RETORNA A VIEW DO PROJETO PARA CADASTRAR EQUIPES
        Route::get('/', 'GestaoEquipesController@index');
        // MÉTODO PARA CADASTRAR NOVA EQUIPE
        Route::post('/', 'GestaoEquipesController@cadastrarEquipe');
        // MÉTODO PARA EDITAR UMA EQUIPE
        Route::put('/', 'GestaoEquipesController@editarCadastroEquipe');
        // MÉTODO PARA DESATIVAR UMA EQUIPE
        Route::delete('/', 'GestaoEquipesController@desativarEquipe');
        // LISTAR GESTORES DA UNIDADE
        Route::get('listar-gestores/{codigoUnidade}', 'GestaoEquipesController@listaGestoresUnidade');
        // LISTA AS EQUIPES DE DETERMINADA UNIDADE COM OS EMPREGADOS
        Route::get('listar-equipes/{codigoUnidade}', 'GestaoEquipesController@listarEquipesUnidade');
        // LISTA DE UNIDADES
        Route::get('listar-unidades', 'GestaoEquipesController@listarUnidades');
        // DESIGNA O EMPREGADO PARA UMA EQUIPE
        Route::put('alocar-empregado', 'GestaoEquipesController@alocarEmpregadoEquipe');
    });
    
    // GESTÃO DE ATIVIDADES
    Route::prefix('gestao-atividades')->group(function () {
        // RETORNA A VIEW DO PROJETO PARA CADASTRAR ATIVIDADES
        Route::get('/', 'GestaoEquipesAtividadesController@index');
        // MÉTODO PARA CADASTRAR NOVA ATIVIDADE
        Route::post('/', 'GestaoEquipesAtividadesController@cadastrarAtividade');
        // MÉTODO PARA EDITAR ATIVIDADE
        Route::put('/{idAtividade}', 'GestaoEquipesAtividadesController@editarAtividade');
        // MÉTODO PARA DESATIVAR ATIVIDADE
        Route::delete('/{idAtividade}', 'GestaoEquipesAtividadesController@desativarAtividade');
        // MÉTODO DESIGNAR EMPREGADO NA ATIVIDADE
        Route::post('/designar-empregado-atividade', 'GestaoEquipesAtividadesController@designarEmpregadoAtividade');
        // MÉTODO PARA LISTAR AS ATIVIDADES DA UNIDADE
        Route::get('/listar-atividades/{codigoUnidade}', 'GestaoEquipesAtividadesController@listarAtividadesComResponsaveis');
    });
});

// ROTA DE TESTE TROCA EMPREGADO CELULA
Route::match(['get', 'post', 'put', 'delete'], 'url', function (\Illuminate\Http\Request $request) {
    // dd($request);
    $resultado = rand(0, 1);
    return $resultado == 0 ? response('error', 500) : response('success', 200);
});

// ROTA PARA CADASTRAR TODOS OS EMPREGADOS DA UNIDADE (RELACIONADOS NO ARRAY) NAS TABELAS DE EMPREGADOS E GESTAO EQUIPES EMPREGADOS
Route::get('cadastra-empregados-unidade', 'CadastraEquipeTblEmpregadosTblGestaoEquipeEmpregadosController@CadastraEquipeTblEmpregadosTblGestaoEquipeEmpregadosController');