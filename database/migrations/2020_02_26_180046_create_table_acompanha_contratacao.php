<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAcompanhaContratacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_ACOMPANHAMENTO_CONTRATACAO', function (Blueprint $table) {
            $table->bigIncrements('idAcompanhamentoContratacao');
            $table->string('numeroContrato', 50);
            $table->string('nomeProponente', 250);
            $table->string('cpfCnpjProponente', 150)->nullable();
            $table->string('statusAcompanhamentoContratacao', 150)->nullable();
            $table->string('matriculaAnalista', 7)->nullable();
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
        Schema::dropIfExists('TBL_ACOMPANHAMENTO_CONTRATACAO');
    }
}
