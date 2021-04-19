<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class CreateTiposMovimentacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_movimentacao', function (Blueprint $table) {
            $table->id();
            $table->string('descricao',18);
            $table->enum('tipo',['S','D','B']);//S - soma , D - subtracao, B - busca
            $table->timestamps();
        });

        DB::table('tipos_movimentacao')->insert(
            array(
                'descricao' => 'SAQUE',
                'tipo' => 'S'
            )
        );
        DB::table('tipos_movimentacao')->insert(
            array(
                'descricao' => 'DEPOSITO',
                'tipo' => 'D'
            )
        );
        DB::table('tipos_movimentacao')->insert(
            array(
                'descricao' => 'SALDO',
                'tipo' => 'B'
            )
        );
        DB::table('tipos_movimentacao')->insert(
            array(
                'descricao' => 'EXTRATO',
                'tipo' => 'B'
            )
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos_movimentacao');
    }
}
