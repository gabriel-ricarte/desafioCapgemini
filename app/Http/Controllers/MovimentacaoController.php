<?php

namespace App\Http\Controllers;

use App\Models\Movimentacao;
use App\Models\TipoMovimentacao;
use App\Models\ContaCorrente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MovimentacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoMovimentacao = new TipoMovimentacao();
        return $tipoMovimentacao::all();
    }

    /**
     * metodo de saque
     */
    public function saque(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'conta' => 'required|exists:contas_correntes,conta',
            'senha' =>  'required|max:4|min:4',
            'valor' => 'required|integer|min:200'
            ],
            [
               'conta.required' => 'Numero de conta não informado',
               'conta.exists' => 'Numero da conta inválido',
               'valor.required' => 'Valor não informado',
               'valor.integer' => 'Valor deve ser um inteiro',
               'valor.min' => 'Valor deve ser maior que dois reais',
               'senha.min' => 'Senha deve possuir 4 digitos',
               'senha.max' => 'Senha deve possuir 4 digitos',

        ]);

            if(!$validator->fails()){

                try{
                    DB::beginTransaction();

                    $rsContaCorrente = ContaCorrente::where('conta', $request->conta)->first();
                    $retorno = ['msg' => 'Operação realizada com sucesso !', 'status' => 201];
                    if($rsContaCorrente && $rsContaCorrente->senha == $request->senha){
                        $operacao = $this->calculaValor($request,$rsContaCorrente, 'S');
                        if($operacao['valida']){
                            $rsContaCorrente->saldo = $operacao['valor_atual'];
                            $rsContaCorrente->save();
                            Movimentacao::create(['conta_corrente_id'=> $rsContaCorrente->id, 'tipo_movimentacao_id' => Movimentacao::SAQUE, 'valor' => $request->valor]);
                        }else{
                            DB::rollback();
                            return response(['message' => $operacao['msg'], 'data' => []], 201)->header('Content-Type', 'text/plain charset=utf-8');
                        }
                    }else{
                        DB::rollback();
                            return response(['message' => ['conta' => ['Conta e/ou senha inválidos']], 'data' => []], 201)->header('Content-Type', 'text/plain charset=utf-8');
                    }

                    DB::commit();
                }catch(\Exception $e){
                    DB::rollback();
                    $retorno['status'] = 500;
                    $retorno['msg'] = $e->getMessage();
                }
                return response(['message' => $retorno['msg'], 'data' => []], $retorno['status'])->header('Content-Type', 'text/plain charset=utf-8');
            }else{
                $errors = $validator->errors();
                return response(['message' => $errors], 500)->header('Content-Type', 'text/plain charset=utf-8');
            }

    }

    /**
     * metodo de deposito
     */
    public function deposito(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'conta' => 'required|exists:contas_correntes,conta',
            'senha' =>  'required|max:4|min:4',
            'valor' => 'required|integer|min:200'
            ],
            [
               'conta.required' => 'Numero de conta não informado',
               'conta.exists' => 'Numero da conta inválido',
               'valor.required' => 'Valor não informado',
               'valor.integer' => 'Valor deve ser um inteiro',
               'valor.min' => 'Valor deve ser maior que dois reais',
               'senha.min' => 'Senha deve possuir 4 digitos',
               'senha.max' => 'Senha deve possuir 4 digitos',

        ]);

            if(!$validator->fails()){

                try{
                    DB::beginTransaction();

                    $rsContaCorrente = ContaCorrente::where('conta', $request->conta)->first();
                    $retorno = ['msg' => 'Operação realizada com sucesso !', 'status' => 201];
                    if($rsContaCorrente && $rsContaCorrente->senha == $request->senha){
                        $operacao = $this->calculaValor($request,$rsContaCorrente, 'D');
                        if($operacao['valida']){
                            $rsContaCorrente->saldo = $operacao['valor_atual'];
                            $rsContaCorrente->save();
                            Movimentacao::create(['conta_corrente_id'=> $rsContaCorrente->id, 'tipo_movimentacao_id' => Movimentacao::DEPOSITO, 'valor' => $request->valor]);
                        }else{
                            DB::rollback();
                            return response(['message' => $operacao['msg'], 'data' => []], 201)->header('Content-Type', 'text/plain charset=utf-8');
                        }
                    }else{
                        DB::rollback();
                            return response(['message' => ['conta' => ['Conta e/ou senha inválidos']], 'data' => []], 201)->header('Content-Type', 'text/plain charset=utf-8');
                    }

                    DB::commit();
                }catch(\Exception $e){
                    DB::rollback();
                    $retorno['status'] = 500;
                    $retorno['msg'] = $e->getMessage();
                }
                return response(['message' => $retorno['msg'], 'data' => []], $retorno['status'])->header('Content-Type', 'text/plain charset=utf-8');
            }else{
                $errors = $validator->errors();
                return response(['message' => $errors], 500)->header('Content-Type', 'text/plain charset=utf-8');
            }
    }

    /**
     * metodo de extrato
     */
    public function extrato(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'conta' => 'required|exists:contas_correntes,conta',
            'senha' =>  'required|max:4|min:4',
            'periodo' => 'required|in:M,A',
            'valor_periodo' => 'required|integer'
            ],
            [
               'conta.required' => 'Numero de conta não informado',
               'conta.exists' => 'Numero da conta inválido',
               'senha.min' => 'Senha deve possuir 4 digitos',
               'senha.max' => 'Senha deve possuir 4 digitos',
               'periodo.required' => 'Tipo do periodo não informado',
               'periodo.in' => 'Periodo deve ser caractere entre "M" (mês) ou "A" (ano)',
               'valor_periodo.required' => 'Valor do periodo não informado',

        ]);

       if(!$validator->fails()){
            try{
                DB::beginTransaction();

                 $rsContaCorrente = ContaCorrente::where('conta', $request->conta)->first();
                 $retorno = ['msg' => 'Operação realizada com sucesso !', 'status' => 201];
                 $movimentacoes = [];
                    if($rsContaCorrente && $rsContaCorrente->senha == $request->senha){
                        switch ($request->periodo) {
                            case 'M':

                                if($request->valor_periodo < 10){
                                    $request->valor_periodo = '0'.$request->valor_periodo;
                                }
                                $lastDateOfMonth = date("Y-m-t", strtotime(date('Y')."-{$request->valor_periodo}-".'01'));
                                $movimentacoes = Movimentacao::where('conta_corrente_id', $rsContaCorrente->id)->where('created_at','>=',date('Y')."-{$request->valor_periodo}-".'01')->where("created_at" ,'<=', $lastDateOfMonth)->get();
                                break;
                            case 'A':
                                $movimentacoes = Movimentacao::where('conta_corrente_id', $rsContaCorrente->id)->where('created_at','>=',date('Y').'-01-01')->where('created_at','<=',date('Y').'-12-31')->get();
                                break;
                            default:
                               $movimentacoes = [];
                                break;
                        }

                        Movimentacao::create(['conta_corrente_id'=> $rsContaCorrente->id, 'tipo_movimentacao_id' => Movimentacao::EXTRATO, 'valor' => 0]);

                    }else{
                        DB::rollback();
                           return response(['message' => ['conta' => ['Conta e/ou senha inválidos']], 'data' => []], 201)->header('Content-Type', 'text/plain charset=utf-8');
                    }

                    DB::commit();
                }catch(\Exception $e){
                    DB::rollback();
                    $retorno['status'] = 500;
                    $retorno['msg'] = $e->getMessage();
                }
                return response(['message' => $retorno['msg'], 'data' => $movimentacoes], $retorno['status'])->header('Content-Type', 'text/plain charset=utf-8');
            }else{
                return response(['message' => $validator->errors()], 500)->header('Content-Type', 'text/plain charset=utf-8');
            }

    }

   public function saldo(Request $request){

            $validator = Validator::make($request->all(), [
                'conta' => 'required|exists:contas_correntes,conta',
                'senha' =>  'required|max:4|min:4',
                ],
                [
                   'conta.required' => 'Numero de conta não informado',
                   'conta_corrente_conta.exists' => 'Numero da conta inválido ou inexistente',
                   'senha.required' => 'Senha não informada'

                ]);

        if(!$validator->fails()){
            try{
                DB::beginTransaction();
                $retorno = ['msg' => 'Operação realizada com sucesso !', 'status' => 201];
                $rsContaCorrente = ContaCorrente::where('conta', $request->conta)->first();
                    if($rsContaCorrente && $rsContaCorrente->senha == $request->senha){

                       $saldo = $rsContaCorrente->saldo;
                       Movimentacao::create(['conta_corrente_id'=> $rsContaCorrente->id, 'tipo_movimentacao_id' => Movimentacao::SALDO, 'valor' => 0]);
                    }else{
                        DB::rollback();
                            return response(['message' => 'Conta e/ou senha inválidos', 'data' => []], 201)->header('Content-Type', 'text/plain charset=utf-8');
                    }

                    DB::commit();
                }catch(\Exception $e){
                    DB::rollback();
                    $retorno['status'] = 500;
                    $retorno['msg'] = $e->getMessage();
                }
                return response(['message' => $retorno['msg'], 'data' => [$saldo]], $retorno['status'])->header('Content-Type', 'text/plain charset=utf-8');
            }else{
                return response(['message' => $validator->errors()], 500)->header('Content-Type', 'text/plain charset=utf-8');
            }

   }

    protected function calculaValor(Request $request, $conta, $operacao){
        $msg = 'Operação realizada com sucesso !';
        $valor_atual = $conta->saldo;
        $valida = true;
        switch($operacao){
            case 'S' :
                if($valor_atual >= $request->valor){
                    $valor_atual = $valor_atual - $request->valor;
                }else{
                    $msg = 'Saldo insuficiente !';
                    $valida = false;
                }
                break;
            case 'D' :
                    $valor_atual = $valor_atual + $request->valor;

        }
        return ['msg' => $msg,'valor_atual' => $valor_atual,'valida' => $valida];
    }
}
