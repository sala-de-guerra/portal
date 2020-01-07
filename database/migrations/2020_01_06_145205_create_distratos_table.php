<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_DISTRATOS_DEMANDAS', function (Blueprint $table) {
            $table->bigIncrements('idDistrato');
            $table->string('contratoFormatado', 50);
            $table->string('nomeProponente', 250);
            $table->string('statusAnalise', 50);
            $table->string('motivoDistrato', 250);
            $table->text('observacaoDistrato')->nullable();
            $table->text('parecerAnalista')->nullable();
            $table->string('matriculaAnalista', 7)->nullable();
            $table->text('parecerGestor')->nullable();
            $table->string('matriculaGestor', 7)->nullable();
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
        Schema::dropIfExists('TBL_DISTRATOS_DEMANDAS');
    }
}
