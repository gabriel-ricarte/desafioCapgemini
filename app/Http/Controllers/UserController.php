<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TipoMovimentacao;
use App\Models\ContaCorrente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function list(){
        return ['msg' => 'Sucesso', 'data' => User::all()];
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'data_nasc' =>  'required',
            'sexo' =>  'required|in:M,F,N',
            ],
            [
               'nome.required' => 'nome do usuário não informado',
               'data_nasc.required' => 'data de nascimento do não informado',
               'sexo.required' => 'sexo não informado',
               'sexo.in' => 'valor de sexo invalido',

        ]);

        if(!$validator->fails()){

            try{
                DB::beginTransaction();
                $retorno = ['msg' => 'Operação realizada com sucesso !', 'status' => 201];
                $user = new User();
                $user->nome = $request->nome;
                $user->data_nasc = $request->data_nasc;
                $user->sexo =  $request->sexo;
                $user->cpf =  $request->cpf;
                $user->cnpj =  $request->cnpj;
                $user->tipo_pessoa =  $request->tipo_pessoa ? $request->tipo_pessoa : 'F';
                $user->save();

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
