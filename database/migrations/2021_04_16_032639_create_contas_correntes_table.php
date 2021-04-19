<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateContasCorrentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contas_correntes', function (Blueprint $table) {
            $table->id();
            $table->string('status',1)->default('1'); // 1 - ativo ; 2 - inativo
            $table->string('senha',4);
            $table->bigInteger('conta',8);
            $table->bigInteger('saldo');
            $table->bigInteger('user_id')->unsigned();
            $table->date('data_criacao')->default(date('Y-m-d'));
            $table->date('data_encerramento')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        DB::table('contas_correntes')->insert(
            array(
                'status' => '1',
                'senha' => '1234',
                'conta' => 0001,
                'saldo' => 100000,
                'user_id' => 1
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
        Schema::table('contas_correntes', function(Blueprint $table)
        {
            $table->dropIfExists('contas_correntes');
            $table->dropForeign('user_id');
        });
    }
}
