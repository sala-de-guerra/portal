<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableGestaoEquipesAtividades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_GESTAO_EQUIPES_ATIVIDADES', function (Blueprint $table) {
            $table->bigIncrements('idAtividade');
            $table->integer('idEquipe');
            $table->string('nomeAtividade', 100);
            $table->text('sinteseAtividade');
            $table->boolean('atividadeSubordinada');
            $table->integer('idAtividadeSubordinante')->nullable();
            $table->boolean('atividadeAtiva')->default(true);
            $table->dateTime('dataCriacaoAtividade');
            $table->dateTime('dataAtualizacaoAtividade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_GESTAO_EQUIPES_ATIVIDADES');
    }
}
