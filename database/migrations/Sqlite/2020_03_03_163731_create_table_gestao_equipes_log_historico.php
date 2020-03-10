<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableGestaoEquipesLogHistorico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_GESTAO_EQUIPES_LOG_HISTORICO', function (Blueprint $table) {
            $table->bigIncrements('idLog');
            $table->integer('idEquipe');
            $table->string('matriculaResponsavel');
            $table->string('tipo', 255);
            $table->text('observacao');
            $table->dateTime('dataLog');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_GESTAO_EQUIPES_LOG_HISTORICO');
    }
}
