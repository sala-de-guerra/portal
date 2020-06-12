<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtendeGenericosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_ATENDE_GENERICOS', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Responsavel_Atendimento');
            $table->string('Responsavel_Designacao');
            $table->string('Nome_Atividade');
            $table->integer('Prazo_Atendimento');
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
        Schema::dropIfExists('TBL_ATENDE_GENERICOS');
    }
}
