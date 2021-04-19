<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContaCorrenteController;
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

Route::get('/', [ContaCorrenteController::class, 'index']);

Route::get('/movimentacao/conta/{conta}/senha/{senha}', [MovimentacaoController::class, 'index']);


