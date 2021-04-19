<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContaCorrenteController;
use App\Http\Controllers\MovimentacaoController;
use App\Http\Controllers\TipoMovimentacaoController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'movimentacao'] ,function () {
   Route::post('/saque', [MovimentacaoController::class, 'saque']);
   Route::post('/deposito', [MovimentacaoController::class, 'deposito']);
   Route::get('/saldo', [MovimentacaoController::class, 'saldo']);
   Route::post('/extrato', [MovimentacaoController::class, 'extrato']);
});

Route::group(['prefix' => 'conta-corrente'] ,function () {
    Route::get('/list', [ContaCorrenteController::class, 'list']);
    Route::post('/create', [ContaCorrenteController::class, 'store']);
    Route::get('/show/{id}', [ContaCorrenteController::class, 'show']);
 });

 Route::group(['prefix' => 'tipo-movimentacao'] ,function () {
    Route::get('/list', [TipoMovimentacaoController::class, 'list']);
 });

 Route::group(['prefix' => 'user'] ,function () {
    Route::get('/list', [UserController::class, 'list']);
    Route::post('/create', [UserController::class, 'store']);
 });
