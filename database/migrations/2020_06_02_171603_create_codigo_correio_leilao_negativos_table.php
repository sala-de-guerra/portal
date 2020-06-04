<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodigoCorreioLeilaoNegativosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codigo_correio_leilao_negativos', function (Blueprint $table) {
            $table->bigIncrements('idContratoLeilaoNegativo');
            $table->string('contratoFormatado', 50);
            $table->string('codigoDoCorreio', 13);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('codigo_correio_leilao_negativos');
    }
}
