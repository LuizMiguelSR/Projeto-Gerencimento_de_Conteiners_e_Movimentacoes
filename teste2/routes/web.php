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
    return view('/home');
})->name('home');

Route::get('/gerenciar_container', [ContainerController::class, 'gerenciar'])->name('gerenciar_container');
Route::get('/formulario_container', [ContainerController::class, 'index'])->name('formulario_container');
Route::post('/novo_container', [ContainerController::class, 'novo'])->name('novo_container');
Route::resource('containers', 'App\Http\Controllers\ContainerController');

Route::get('/movimentar', [MovimentacaoController::class, 'movimentar'])->name('movimentar');
Route::get('/formulario_movimentacao/{id}', [MovimentacaoController::class, 'index'])->name('formulario_movimentacao');
Route::post('/nova_movimentacao', [MovimentacaoController::class, 'novo'])->name('nova_movimentacao');

Route::get('/gerenciar_movimentacao', [MovimentacaoController::class, 'gerenciar'])->name('gerenciar_movimentacao');
