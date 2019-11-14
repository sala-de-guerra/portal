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

// Controle de Contratação
Route::get('/controle-contratacao', function () {
    return view('portal.imoveis.controle-contratacao');
});

// Consulta de bem imóvel

Route::get('/consulta-bem-imovel', function () {
    return view('portal.imoveis.consulta-bem-imovel');
});

// Rotina Automatica de envio de mensagens Adjudicados

Route::prefix('estoque-imoveis')->group(function () {
    Route::get('rotina-mensagens', 'GestaoImoveisCaixa\RotinaMensagensAutomatica@enviarMensageriasAutorizacaoContratacao');

  // Gerencial
// equipes
Route::get('equipes', function () {
    return view('portal.gerencial.equipes');
});


    Route::get('rota-charles-imoveis-caixa', 'GestaoImoveisCaixa\RotinaMensagensAutomatica@mensagemAutorizacaoCaixaEngeaCharles');
});

