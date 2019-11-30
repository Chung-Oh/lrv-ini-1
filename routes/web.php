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

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
    Route::resource('clients', 'ClientsController');
});

/*
|--------------------------------------------------------------------------
| Formas de nomear rotas
|--------------------------------------------------------------------------
| Os 2 exemplos abaixo tem o mesmo efeito, servem para usar o nome no HTML
| como em formulários. Ex:
| <form method="post" action="{{ route('meu-nome') }}">
*/
Route::name('meu-nome')->get('/rota-nomeada/qualquer-coisa', function () {
    echo 'Pagina Qualquer Coisa';
});

Route::get('/rota-nomeada/qualquer-coisa', function () {
    echo 'Pagina Qualquer Coisa';
})->name('meu-nome');
