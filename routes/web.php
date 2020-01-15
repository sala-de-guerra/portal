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

// Auth::routes();

// Route::get('/home', function() {
//     return view('home');
// })->name('home')->middleware('auth');

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

Route::get('/consulta-bem-imovel/{contrato}', 'GestaoImoveisCaixa\ContratosEstoqueCaixa@show');

//Contratacao

// Distrato

// Route::get('/controle-distrato', function () {
//     return view('portal.imoveis.distrato.controle-distrato');
// });

// Route::get('/distrato', function () {
//     return view('portal.imoveis.contratacao.distrato');
// });


// Operacional Distrato

// Route::get('/operacional-distrato', function () {
//     return view('portal.imoveis.distrato.operacional-distrato');
// });

// Rotas web dos processos pertinentes ao Estoque de Imóveis

Route::prefix('estoque-imoveis')->group(function () {
    Route::get('distrato', 'GestaoImoveisCaixa\DistratoController@index');
    Route::get('distrato/listar-protocolos', 'GestaoImoveisCaixa\DistratoController@show');
    Route::get('distrato/tratar/{contrato}', 'GestaoImoveisCaixa\DistratoController@edit');
    Route::put('distrato/atualizar/{demanda}', 'GestaoImoveisCaixa\DistratoController@update');
    Route::get('distrato/consultar-dados-demanda/{contrato}', 'GestaoImoveisCaixa\DistratoController@jsonDadosDemandaDistrato');
    Route::post('distrato/cadastrar-demanda', 'GestaoImoveisCaixa\DistratoController@store');
    Route::get('rotina-mensagens', 'GestaoImoveisCaixa\RotinaMensagensAutomatica@enviarMensageriasAutorizacaoContratacao');
    Route::get('rotina-mensagens-com-contrato-fixo', 'GestaoImoveisCaixa\RotinaMensagensAutomatica@enviarMensageriasComRelacaoFixaDeContratos');
    Route::get('enviar-autorizacao-contratacao/{contrato}', 'GestaoImoveisCaixa\RotinaMensagensAutomatica@enviarAutorizacaoContratacaoViaPortal');
    Route::get('consulta-contrato/{contrato}', 'GestaoImoveisCaixa\ContratosEstoqueCaixa@capturaDadosBaseSimov');
    Route::get('consulta-mensagens-enviadas/{contrato}', 'GestaoImoveisCaixa\ConsultaContratoController@consultaMensagensEnviadas');
    Route::get('consulta-historico-contrato/{contrato}', 'GestaoImoveisCaixa\ConsultaContratoController@consultaHistorico');
});

// Rotina Automatica de envio de mensagens Adjudicados

Route::prefix('portal')->group(function () {
    Route::get('cria-json-google', 'JsonGooglePortal@criaJsonParaAbastecerBarraPesquisaGoogle');
});


// Gerencial

// equipes
Route::get('/equipes', function () {
    return view('portal.gerencial.equipes');
});

