<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Movimentacao extends Model
{
    use HasFactory;
    protected $table = 'movimentacoes';

    const SAQUE       = 1;
    const DEPOSITO    = 2;
    const SALDO       = 3;
    const EXTRATO     = 4;
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

    public function tipoMovimentacao(){
		return $this->belongsTo('App\TipoMovimentacao');
	}
}
