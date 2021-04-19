<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimentacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimentacoes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('conta_corrente_id')->unsigned();
            $table->bigInteger('tipo_movimentacao_id')->unsigned();
            $table->bigInteger('valor');
            $table->foreign('conta_corrente_id')->references('id')->on('contas_correntes')->onDelete('cascade');
            $table->foreign('tipo_movimentacao_id')->references('id')->on('tipos_movimentacao')->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movimentacoes', function(Blueprint $table)
        {
            $table->dropIfExists('movimentacoes');
            $table->dropForeign('conta_corrente_id');
            $table->dropForeign('tipo_movimentacao_id');
        });
    }
}
