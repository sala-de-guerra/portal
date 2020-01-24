<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricoPortalGiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_HISTORICO_PORTAL_GILIE', function (Blueprint $table) {
            $table->bigIncrements('idHistorico');
            $table->string('numeroContrato', 50);
            $table->string('matricula', 7);
            $table->string('tipo', 255);
            $table->string('atividade', 255);
            $table->text('observacao');
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
        Schema::dropIfExists('TBL_HISTORICO_PORTAL_GILIE');
    }
}
