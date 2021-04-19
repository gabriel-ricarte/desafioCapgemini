<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovimentacaoController;

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