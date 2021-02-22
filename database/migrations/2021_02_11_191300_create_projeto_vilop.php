<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetoVilop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS', function (Blueprint $table) {
            $table->bigIncrements('IdMacro');
            $table->string('CGC_UNIDADE', 4);
            $table->string('NOME_UNIDADE', 50);
            $table->string('NOME_MACROATIVIDADE', 120);
            $table->string('MATRICULA_RESPONSAVEL_RESPOSTA', 120);
            $table->dateTime('DATA_RESPOSTA');
            $table->string('EXCLUIDO_USUARIO', 1);
            $table->string('MATRICULA_RESPONSAVEL_EXCLUSAO', 12)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS');
    }
}
