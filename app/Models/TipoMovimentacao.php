<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TipoMovimentacao extends Model
{
    use HasFactory;

    protected $table = 'tipos_movimentacao';

    public function movimentacao(){
		return $this->hasMany('App\Movimentacao');
	}

    public function getList()
    {
        $sql = "SELECT tm.id,tm.descricao,tm.tipo FROM tipos_movimentacao as tm";
        return DB::select($sql);
    }
}
