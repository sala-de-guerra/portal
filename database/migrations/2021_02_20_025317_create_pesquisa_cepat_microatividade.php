<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesquisaCepatMicroatividade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_PRODUTIVIDADE_CEPAT_TBL_MICROPROCESSOS', function (Blueprint $table) {
            $table->bigIncrements('idMicro');
            $table->integer('IdMacroProcesso')->references('IdMacro')->on('TBL_PRODUTIVIDADE_CEPAT_TBL_MACROPROCESSOS');
            $table->string('RESPONSAVEL_CADASTRO_MICROATIVIDADE', 12);
            $table->string('NOME_MICROATIVIDADE', 120);
            $table->string('MENSURAVEL', 1);
            $table->float('QTDE_PESSOAS_ALOCADAS')->nullable();
            $table->integer('VOLUME_TOTAL_DEMANDA');
            $table->integer('VOLUME_TOTAL_TRATADA');
            $table->dateTime('PERIODO_TRATADO_DE')->nullable();
            $table->dateTime('PERIODO_TRATADO_ATE')->nullable();
            $table->float('MEDIA_DIA')->nullable();
            $table->float('TEMPO_EM_MINUTOS')->nullable();
            $table->float('NIVEL_COMPLEXIDADE')->nullable();
            $table->float('NIVEL_AUTOMACAO')->nullable();
            $table->float('GRAU_CRITICIDADE')->nullable();
            $table->float('GRAU_PADRONIZACAO')->nullable();
            $table->float('GRAU_AUTONOMIA')->nullable();
            $table->string('EXCLUIDO_USUARIO', 1);
            $table->string('MATRICULA_RESPONSAVEL_EXCLUSAO', 12)->nullable();
            $table->string('SISTEMA_ORIGEM_INFORMACAO', 255)->nullable();
            $table->string('MATRICULA_RESPONSAVEL_UPLOAD', 12)->nullable();
            $table->dateTime('DATA_UPLOAD')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_PRODUTIVIDADE_CEPAT_TBL_MICROPROCESSOS');
    }
}
