<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControleMensageriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_CONTROLE_MENSAGENS_ENVIADAS', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipoMensagem', 50);
            $table->string('numeroContrato', 50);
            $table->integer('codigoAgencia');
            $table->string('emailProponente', 50)->nullable();
            $table->string('emailCorretor', 50)->nullable();
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
        Schema::dropIfExists('TBL_CONTROLE_MENSAGENS_ENVIADAS');
    }
}
