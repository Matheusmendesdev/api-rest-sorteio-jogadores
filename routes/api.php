<?php

use App\Http\Controllers\FormacaoTimesController;
use App\Http\Controllers\JogadorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/formarTimes', [FormacaoTimesController::class, 'formarTimes'])->name('times.formar');

Route::get('/jogadores', [JogadorController::class, 'index'])->name('jogador.index');
Route::get('/jogador/{id}', [JogadorController::class, 'show'])->name('jogador.show');
Route::get('/jogador/{id}', [JogadorController::class, 'show'])->name('jogador.show');
Route::post('/cadastroJogador', [JogadorController::class, 'store'])->name('jogador.store');
Route::put('/atualizarJogador/{id}', [JogadorController::class, 'update'])->name('jogador.update');
Route::delete('/deletarJogador/{id}', [JogadorController::class, 'destroy']);