<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableGestaoEquipesCelulas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_GESTAO_EQUIPES_CELULAS', function (Blueprint $table) {
            $table->increments('idEquipe');
            $table->smallInteger('codigoUnidadeEquipe')->nullable();
            $table->string('nomeEquipe', 255);
            $table->string('matriculaGestor', 7)->nullable();
            $table->string('nomeGestor', 50)->nullable();
            $table->string('matriculaEventual', 7)->nullable();
            $table->string('nomeEventual', 50)->nullable();
            $table->boolean('ativa')->default(true);
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
        Schema::dropIfExists('TBL_GESTAO_EQUIPES_CELULAS');
    }
}
