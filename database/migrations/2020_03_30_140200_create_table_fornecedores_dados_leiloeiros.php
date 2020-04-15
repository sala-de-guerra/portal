<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableFornecedoresDadosLeiloeiros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_FORNECEDORES_DADOS_LEILOEIRO', function (Blueprint $table) {
            $table->bigIncrements('idLeiloeiro');
            $table->string('numeroContrato', 50);
            $table->string('classificacaoImoveisLeilao', 50)->nullable();
            $table->date('dataVencimentoContrato')->nullable();
            $table->integer('quantidadeLeiloesRealizados')->nullable();
            $table->string('nomeLeiloeiro', 255);
            $table->string('telefoneLeiloeiro', 20)->nullable();
            $table->string('emailLeiloeiro', 255)->nullable();
            $table->string('enderecoLeiloeiro', 255)->nullable();
            $table->string('nomeEmpresaAssessoraLeiloeiro', 255)->nullable();
            $table->string('telefoneEmpresaAssessoraLeiloeiro', 20)->nullable();
            $table->string('emailEmpresaAssessoraLeiloeiro', 255)->nullable();
            $table->string('siteEmpresaAssessoraLeiloeiro', 255)->nullable();
            $table->string('enderecoEmpresaAssessoraLeiloeiro', 255)->nullable();
            $table->string('enderecoRealizacaoLeilao', 255)->nullable();
            $table->string('unidadeGestora', 4);
            $table->boolean('leiloeiroAtivo')->default(true);
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
        Schema::dropIfExists('TBL_FORNECEDORES_DADOS_LEILOEIRO');
    }
}
