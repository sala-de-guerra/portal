<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesquisaCepatAtividade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_PRODUTIVIDADE_CEPAT_TBL_ATIVIDADES', function (Blueprint $table) {
            $table->bigIncrements('idAtividade');
            $table->integer('idMicro')->references('idMicro')->on('TBL_PRODUTIVIDADE_CEPAT_TBL_MICROPROCESSOS');
            $table->string('RESPONSAVEL_CADASTRO_ATIVIDADE', 12);
            $table->string('NOME_ATIVIDADE', 120);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_PRODUTIVIDADE_CEPAT_TBL_ATIVIDADES');
    }
}
