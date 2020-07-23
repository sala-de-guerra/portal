<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableModelosMensageria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_MODELO_MENSAGERIA', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('matricula');
            $table->string('nomeModelo');
            $table->text('modeloMensageria');
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
        Schema::dropIfExists('TBL_MODELO_MENSAGERIA');
    }
}
