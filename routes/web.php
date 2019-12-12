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

//teste
Route::get('/teste', function () {
    return view('teste');
});    


 // sobre
 Route::get('/sobre', function () {
    return view('portal.informativas.sobre');
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
Route::get('/controle-contratacao', function () {
    return view('portal.imoveis.controle-contratacao');
});

// Pesquisar

Route::get('/pesquisar', function () {
    return view('portal.imoveis.pesquisar');
});


// Consulta de bem imóvel

Route::get('/consulta-bem-imovel/{contrato}', 'GestaoImoveisCaixa\ContratosEstoqueCaixa@capturaDadosBaseSimov');

// Rotina Automatica de envio de mensagens Adjudicados

Route::prefix('estoque-imoveis')->group(function () {
    Route::get('rotina-mensagens', 'GestaoImoveisCaixa\RotinaMensagensAutomatica@enviarMensageriasAutorizacaoContratacao');
    Route::get('rotina-mensagens-com-contrato-fixo', 'GestaoImoveisCaixa\RotinaMensagensAutomatica@enviarMensageriasComRelacaoFixaDeContratos');
    Route::get('rota-charles-imoveis-caixa', 'GestaoImoveisCaixa\RotinaMensagensAutomatica@mensagemAutorizacaoCaixaEngeaCharles');
    Route::get('consulta-contrato/{contrato}', 'GestaoImoveisCaixa\ContratosEstoqueCaixa@capturaDadosBaseSimov');
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

