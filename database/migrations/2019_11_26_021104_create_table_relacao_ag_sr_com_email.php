<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRelacaoAgSrComEmail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL', function (Blueprint $table) {
            $table->string('codigoAgencia', 4);
            $table->string('nomeAgencia', 100);
            $table->string('emailAgencia', 100);
            $table->string('codigoSr', 4);
            $table->string('nomeSr', 100);
            $table->string('emailsr', 100);
            $table->string('codigoGigad', 4);
            $table->string('nomeGigad', 100);
            $table->string('emailGigad', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL');
    }
}
