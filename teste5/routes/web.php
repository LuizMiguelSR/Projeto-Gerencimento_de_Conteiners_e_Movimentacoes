<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerContainer;
use App\Http\Controllers\ControllerMovimentacao;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::resource('/containers', 'App\Http\Controllers\ControllerContainer');
Route::post('/containers/filtrar', [ControllerContainer::class, 'filtrar'])->name('filtrar_container');

Route::resource('/movimentacoes', 'App\Http\Controllers\ControllerMovimentacao');
Route::post('/movimentacoes/filtrar/container', [ControllerMovimentacao::class, 'filtrar_container'])->name('filtrar_movimentacao_container');
Route::post('/movimentacoes/filtrar/movimentacao', [ControllerMovimentacao::class, 'filtrar_movimentacao'])->name('filtrar_movimentacao');

Route::get('/relatorio_movimentacoes', [ControllerMovimentacao::class, 'relatorio_movimentacoes'])->name('relatorio_movimentacoes');
