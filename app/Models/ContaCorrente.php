<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ContaCorrente extends Model
{
    use HasFactory;
    protected $table = 'contas_correntes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'valor',
        'tipo_movimentacao_id',
        'conta_corrente_id',
    ];

    public function getList()
    {
        $sql = "SELECT u.nome,cc.conta,cc.saldo,cc.senha FROM contas_correntes as cc inner join users as u on cc.user_id = u.id";
        return DB::select($sql);
    }

    public function getInfo($params)
    {
        $sql = "SELECT u.nome,cc.conta,cc.saldo,cc.senha,cc.senha,u.cpf,u.cnpj,u.tipo_pessoa FROM contas_correntes as cc inner join users as u on cc.user_id = u.id where cc.id = {$params}";
        return DB::select($sql);
    }

    public function getLastConta()
    {
        $sql = "SELECT cc.conta FROM contas_correntes as cc order by conta desc limit 1";
        $contaCorrente = DB::select($sql);
        $contaCorrente = end($contaCorrente);

        return (int)$contaCorrente->conta + 5;
    }
}
