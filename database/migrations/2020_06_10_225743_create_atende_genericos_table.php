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
        Schema::create('TBL_FALE_CONOSCO', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Responsavel_Atendimento');
            $table->string('Responsavel_Designacao');
            $table->string('Nome_Atividade');
            $table->string('Assunto')->nullable();
            $table->text('Descricao')->nullable();
            $table->text('Resposta')->nullable();
            $table->string('GILIE');
            $table->integer('Prazo_Atendimento');
            $table->date('Data_atendimento')->nullable();
            $table->integer('Status');
            $table->string('Email_contato')->nullable();
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
        Schema::dropIfExists('TBL_FALE_CONOSCO');
    }
}
