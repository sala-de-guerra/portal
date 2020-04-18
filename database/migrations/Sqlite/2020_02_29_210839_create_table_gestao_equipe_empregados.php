<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableGestaoEquipeEmpregados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_GESTAO_EQUIPES_EMPREGADOS', function (Blueprint $table) {
            $table->string('matricula', 7)->unique();
            $table->smallInteger('codigoUnidadeLotacao')->nullable();
            $table->integer('idEquipe')->nullable();
            $table->boolean('disponivel')->default(true);
            $table->boolean('eventualEquipe')->default(false);
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
        Schema::dropIfExists('TBL_GESTAO_EQUIPES_EMPREGADOS');
    }
}
