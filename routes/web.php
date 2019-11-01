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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

 // index
 Route::get('/index', function () {
    return view('portal.index');
});

 // Controle de Contratação
 Route::get('/controle-contratacao', function () {
    return view('portal.imoveis.controle-contratacao');
});

// Consulta de bem imóvel

Route::get('/consulta-bem-imovel', function () {
    return view('portal.imoveis.consulta-bem-imovel');
});
