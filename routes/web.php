<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovimentacaoController;

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

Route::group(['prefix' => 'movimentacao'] ,function () {
   Route::post('/saque', [MovimentacaoController::class, 'saque']);
   Route::post('/deposito', [MovimentacaoController::class, 'deposito']);
   Route::get('/saldo', [MovimentacaoController::class, 'saldo']);
   Route::post('/extrato', [MovimentacaoController::class, 'extrato']);
});

Route::group(['prefix' => 'conta'] ,function () {
   Route::post('/saque', [MovimentacaoController::class, 'saque']);
   Route::post('/deposito', [MovimentacaoController::class, 'deposito']);
   Route::post('/saldo', [MovimentacaoController::class, 'saldo']);
   Route::post('/extrato', [MovimentacaoController::class, 'extrato']);
});

