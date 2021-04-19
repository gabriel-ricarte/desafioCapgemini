<?php

namespace App\Http\Controllers;

use App\Models\Movimentacao;
use App\Models\TipoMovimentacao;
use App\Models\ContaCorrente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ContaCorrenteController extends Controller
{

    public function index(){
        return view('inicio');
    }
    public function list(Request $request){
        $contaCorrente = new ContaCorrente();
        $contasDisponiveis = $contaCorrente->getList();
        return ['msg' => 'Sucesso', 'data' => $contasDisponiveis];
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'senha' =>  'required|max:4|min:4',
            ],
            [
               'user_id.required' => 'Id do usuário não informado',
               'user_id.exists' => 'Id do usuário inválido',
               'senha.required' => 'Senha não informada',
               'senha.min' => 'Senha deve possuir 4 digitos',
               'senha.max' => 'Senha deve possuir 4 digitos',

        ]);

        if(!$validator->fails()){

            try{
                DB::beginTransaction();
                $retorno = ['msg' => 'Operação realizada com sucesso !', 'status' => 201];
                $contaCorrente = new ContaCorrente();
                $contaCorrente->user_id = $request->user_id;
                $contaCorrente->senha = $request->senha;
                $contaCorrente->conta = $contaCorrente->getLastConta();
                $contaCorrente->saldo = 0;
                $contaCorrente->save();

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
     * Display the specified resource.
     *
     * @param  \App\Models\Movimentacao  $movimentacao
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contaCorrenteTable = new ContaCorrente();
        $infoConta = $contaCorrenteTable->getInfo($id);
        return ['msg' => 'Sucesso', 'data' => $infoConta];
    }
}
