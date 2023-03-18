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

Route::get('/novo_container', [ContainerController::class, 'index'])->name('novo_container');
Route::post('/cadastrar_container', [ContainerController::class, 'novo'])->name('cadastrar_container');
Route::get('/gerenciar_container', [ContainerController::class, 'gerenciar'])->name('gerenciar_container');
Route::resource('containers', 'App\Http\Controllers\ContainerController');
Route::delete('/containers/{id}', [ContainerController::class, 'delete'])->name('containers.delete');
Route::post('/filtrar_container', [ContainerController::class, 'filter'])->name('filtrar_container');

Route::get('/movimentar', [MovimentacaoController::class, 'movimentar'])->name('movimentar');
Route::get('/formulario_movimentacao/{id}', [MovimentacaoController::class, 'index'])->name('nova_movimentacao');
Route::post('/nova_movimentacao', [MovimentacaoController::class, 'novo'])->name('nova_movimentacao');
