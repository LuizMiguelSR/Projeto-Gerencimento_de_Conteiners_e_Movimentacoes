<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\MovimentacaoController;

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

/** Rotas pertinentes aos containers */
Route::get('novo_container', [ContainerController::class, 'index'])->name('novo_container');
Route::post('cadastrar_container', [ContainerController::class, 'novo'])->name('cadastrar_container');

Route::get('gerenciar_container', [ContainerController::class, 'gerenciar'])->name('gerenciar_container');

Route::resource('containers', 'App\Http\Controllers\ContainerController');

Route::delete('/container/{id}', [ContainerController::class, 'destroy'])->name('containers.destroy');

Route::post('/filtrar_container', [ContainerController::class, 'filter'])->name('filtrar_container');

/** Rotas pertinentes as movimentações */
Route::get('/nova_movimentacao', [MovimentacaoController::class, 'movimentar'])->name('nova_movimentacao');

Route::get('/gerenciar_movimentacao', [MovimentacaoController::class, 'gerenciar'])->name('gerenciar_movimentacao');

Route::resource('movimentar', 'App\Http\Controllers\MovimentacaoController');

Route::post('/cadastrar_movimentacao', [MovimentacaoController::class, 'novo'])->name('cadastrar_movimentacao');

Route::delete('/movimentacao/{id}', [MovimentacaoController::class, 'destroy'])->name('movimentacoes.destroy');

Route::post('/filtrar_movimentacao', [MovimentacaoController::class, 'filter'])->name('filtrar_movimentacao');
Route::post('/filtrar_container_movimentacao', [MovimentacaoController::class, 'filter_container'])->name('filtrar_container_movimentacao');

/** Rotas pertinentes aos relatórios de  movimentações */
Route::get('/relatorio-movimentacoes', [MovimentacaoController::class, 'relatorioMovimentacoes'])->name('relatorio.movimentacoes');

