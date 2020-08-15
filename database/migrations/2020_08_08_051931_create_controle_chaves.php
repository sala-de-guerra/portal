<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControleChaves extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_CONTROLE_CHAVES', function (Blueprint $table) {
            $table->bigIncrements('idChaves');
            $table->string('BEM_FORMATADO')->unique();
            $table->string('NU_BEM')->unique();
            $table->string('numeroChave')->nullable();
            $table->integer('quantidadeChave');
            $table->integer('quantidadeEmprestada');
            $table->text('observacao')->nullable();
            $table->string('numeroChave1')->nullable();
            $table->string('statusChave1')->nullable();
            $table->string('nomeProponente1')->nullable();
            $table->string('cpfProponente1')->nullable();
            $table->string('RGProponente1')->nullable();
            $table->date('dataRetiradaChave1')->nullable();
            $table->string('numeroChave2')->nullable();
            $table->string('statusChave2')->nullable();
            $table->string('nomeProponente2')->nullable();
            $table->string('cpfProponente2')->nullable();
            $table->string('RGProponente2')->nullable();
            $table->date('dataRetiradaChave2')->nullable();
            $table->string('numeroChave3')->nullable();
            $table->string('statusChave3')->nullable();
            $table->string('nomeProponente3')->nullable();
            $table->string('cpfProponente3')->nullable();
            $table->string('RGProponente3')->nullable();
            $table->date('dataRetiradaChave3')->nullable();
            $table->string('numeroChave4')->nullable();
            $table->string('statusChave4')->nullable();
            $table->string('nomeProponente4')->nullable();
            $table->string('cpfProponente4')->nullable();
            $table->string('RGProponente4')->nullable();
            $table->date('dataRetiradaChave4')->nullable();
            $table->string('numeroChave5')->nullable();
            $table->string('statusChave5')->nullable();
            $table->string('nomeProponente5')->nullable();
            $table->string('cpfProponente5')->nullable();
            $table->string('RGProponente5')->nullable();
            $table->date('dataRetiradaChave5')->nullable();
            $table->string('numeroChave6')->nullable();
            $table->string('statusChave6')->nullable();
            $table->string('nomeProponente6')->nullable();
            $table->string('cpfProponente6')->nullable();
            $table->string('RGProponente6')->nullable();
            $table->date('dataRetiradaChave6')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_CONTROLE_CHAVES');
    }
}
