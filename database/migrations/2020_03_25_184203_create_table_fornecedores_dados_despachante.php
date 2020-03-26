<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableFornecedoresDadosDespachante extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_FORNECEDORES_DADOS_DESPACHANTE', function (Blueprint $table) {
            $table->bigIncrements('idDespachante');
            $table->string('numeroContrato', 50);
            $table->date('dataVencimentoContrato');
            $table->string('cnpjDespachante', 20);
            $table->string('nomeDespachante', 255);
            $table->string('telefoneDespachante', 20)->nullable();
            $table->string('emailDespachante', 255)->nullable();
            $table->string('nomePrimeiroResponsavelDespachante', 255);
            $table->string('telefonePrimeiroResponsavelDespachante', 20)->nullable();
            $table->string('emailPrimeiroResponsavelDespachante', 255)->nullable();
            $table->string('nomeSegundoResponsavelDespachante', 255)->nullable();
            $table->string('telefoneSegundoResponsavelDespachante', 20)->nullable();
            $table->string('emailSegundoResponsavelDespachante', 255)->nullable();
            $table->string('nomeTerceiroResponsavelDespachante', 255)->nullable();
            $table->string('telefoneTerceiroResponsavelDespachante', 20)->nullable();
            $table->string('emailTerceiroResponsavelDespachante', 255)->nullable();
            $table->string('unidadeGestora', 4);
            $table->boolean('despachanteAtivo')->default(true);
            $table->datetime('dataCadastro');
            $table->datetime('dataAlteracao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_FORNECEDORES_DADOS_DESPACHANTE');
    }
}
