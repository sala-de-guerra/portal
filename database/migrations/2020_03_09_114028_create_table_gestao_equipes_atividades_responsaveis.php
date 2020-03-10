<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableGestaoEquipesAtividadesResponsaveis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_GESTAO_EQUIPES_ATIVIDADES_RESPONSAVEIS', function (Blueprint $table) {
            $table->bigIncrements('idResponsavelAtividade');
            $table->integer('idAtividade');
            $table->string('matriculaResponsavelAtividade', 7);
            $table->boolean('atuandoAtividade')->default(true);
            $table->string('matriculaResponsavelDesignacao', 7);
            $table->dateTime('dataCadastro');
            $table->dateTime('dataAtualizacao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_GESTAO_EQUIPES_ATIVIDADES_RESPONSAVEIS');
    }
}
