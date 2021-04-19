<?php

namespace App\Http\Controllers;

use App\Models\Movimentacao;
use App\Models\TipoMovimentacao;
use App\Models\ContaCorrente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TipoMovimentacaoController extends Controller
{

    public function list(Request $request){
        $tipoMovimentacao = new TipoMovimentacao();
        $tiposMoviemntacoesDisponiveis = $tipoMovimentacao->getList();
        return ['msg' => 'Sucesso', 'data' => $tiposMoviemntacoesDisponiveis];
    }
}
