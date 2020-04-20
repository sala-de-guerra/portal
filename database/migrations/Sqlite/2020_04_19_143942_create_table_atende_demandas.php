<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAtendeDemandas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_ATENDE_DEMANDAS', function (Blueprint $table) {
            $table->bigIncrements('idAtende');
            $table->string('contratoFormatado', 50);
            $table->string('numeroContrato', 50);
            $table->integer('idEquipe');
            $table->integer('idAtividade');
            $table->string('matriculaResponsavelAtividade');
            $table->string('assuntoAtende', 150);
            $table->text('descricaoAtende');
            $table->text('motivoRedirecionamento')->nullable();
            $table->text('respostaAtende')->nullable();
            $table->date('prazoAtendimentoAtende');
            $table->string('statusAtende');
            $table->string('matriculaCriadorDemanda');
            $table->string('emailContatoResposta', 150)->nullable();
            $table->datetime('dataCadastro');
            $table->datetime('dataAlteracao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_ATENDE_DEMANDAS');
    }
}
