<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//index
Route::get('/', function () {
    return view('portal.index');
});    

// route 404
Route::fallback(function(){return response()->view('errors.404', [], 404);});

//teste
Route::get('/teste', function () {
    return view('teste');
});    

// sobre
Route::get('/sobre', function () {
    return view('portal.informativas.sobre');
});

// area de atuação
Route::get('/area', function () {
    return view('portal.informativas.area');
});

// duvidas frequentes
Route::get('/faq', function () {
    return view('portal.informativas.faq');
});

// orientações
Route::get('/orientacoes', function () {
    return view('portal.informativas.orientacoes');
});

// conheca o projeto
Route::get('/projeto', function () {
    return view('portal.informativas.projeto');
});


// Controle de Contratação
Route::get('/controle-conformidade', function () {
    return view('portal.imoveis.contratacao.controle-conformidade');
});

// Pesquisar

Route::get('/pesquisar', function () {
    return view('portal.imoveis.pesquisar');
});

// Consulta de bem imóvel
Route::get('/consulta-bem-imovel/{contrato}', 'GestaoImoveisCaixa\ConsultaContratoController@show');


//  ROTAS WEB DOS PROCESSOS PERTINENTES AO ESTOQUE DE IMÓVEIS
Route::prefix('estoque-imoveis')->group(function () {
    // ROTAS API DE CONSULTA JSON
    Route::get('consulta-contrato/{contrato}', 'GestaoImoveisCaixa\ConsultaContratoController@capturaDadosBaseSimov');
    Route::get('consulta-mensagens-enviadas/{contrato}', 'GestaoImoveisCaixa\ConsultaContratoController@consultaMensagensEnviadas');
    Route::get('consulta-historico-contrato/{contrato}', 'GestaoImoveisCaixa\ConsultaContratoController@consultaHistorico');

    // ROTAS DO PROJETO DE DISTRATO
    Route::prefix('distrato')->group(function () {
        Route::get('/', 'GestaoImoveisCaixa\DistratoDemandaController@index');
        Route::get('consultar-dados-demanda/{contrato}', 'GestaoImoveisCaixa\DistratoDemandaController@jsonDadosDemandaDistrato');
        Route::get('listar-protocolos', 'GestaoImoveisCaixa\DistratoDemandaController@show');
        Route::get('relacao-despesas/{distrato}', 'GestaoImoveisCaixa\DistratoDemandaController@listarRelacaoDeDespesasDaDemandaDeDistrato');
        Route::get('tratar/{contrato}', 'GestaoImoveisCaixa\DistratoDemandaController@edit');
        Route::post('cadastrar-demanda', 'GestaoImoveisCaixa\DistratoDemandaController@store');
        Route::post('cadastrar-despesa/{distrato}', 'GestaoImoveisCaixa\DistratoDemandaController@cadastrarDespesa');
        Route::put('atualizar/{demanda}', 'GestaoImoveisCaixa\DistratoDemandaController@update');
        Route::put('atualizar-despesa/{despesa}', 'GestaoImoveisCaixa\DistratoDemandaController@atualizarDespesa');
        Route::put('emitir-parecer-analista/{distrato}', 'GestaoImoveisCaixa\DistratoDemandaController@emitirParecerAnalista');
        Route::put('emitir-parecer-gestor/{distrato}', 'GestaoImoveisCaixa\DistratoDemandaController@emitirParecerGestor');
        Route::put('excluir-despesa/{despesa}', 'GestaoImoveisCaixa\DistratoDemandaController@excluirDespesa');
        Route::put('validar-despesa/{despesa}', 'GestaoImoveisCaixa\DistratoDemandaController@validarDespesaGestor');
    });

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
