<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('data_nasc');
            $table->enum('sexo',['M','F','N'])->nullable();//M , F , N
            $table->string('cpf',20)->nullable();
            $table->string('cnpj',30)->nullable();
            $table->string('tipo_pessoa',1);//F ou J
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            array(
                'nome' => 'FULANO DA SILVA',
                'data_nasc' => '1993-12-26',
                'sexo' => 'M',
                'cpf' => '07138548478',
                'tipo_pessoa' => 'F'
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
        Schema::dropIfExists('users');
    }
}
