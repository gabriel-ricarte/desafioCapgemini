<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMovimentacao extends Model
{
    use HasFactory;

    protected $table = 'tipos_movimentacao';

    public function movimentacao(){
		return $this->hasMany('App\Movimentacao');
	}
}
