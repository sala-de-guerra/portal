<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_DISTRATOS_DEMANDAS', function (Blueprint $table) {
            $table->bigIncrements('idDistrato');
            $table->string('contratoFormatado', 50);
            $table->string('nomeProponente', 250);
            $table->string('cpfCnpjProponente', 150)->nullable();
            $table->string('telefoneProponente', 50)->nullable();
            $table->string('emailProponente', 255)->nullable();
            $table->string('emailCorretor', 255)->nullable();
            $table->string('nomeCorretor', 250)->nullable();
            $table->datetime('dataProposta')->nullable();
            $table->string('tipoVendaProposta', 100)->nullable();
            $table->decimal('valorRecursosPropriosProposta', 17, 2)->nullable();
            $table->decimal('valorFgtsProposta', 17, 2)->nullable();
            $table->decimal('valorFinanciadoProposta', 17, 2)->nullable();
            $table->decimal('valorParceladoProposta', 17, 2)->nullable();
            $table->decimal('valorTotalProposta', 17, 2)->nullable();
            $table->string('demandaAtiva', 3)->nullable();
            $table->integer('codigoAgenciaContratacao')->nullable();
            $table->string('vendaRegistradaCartorio', 3)->nullable();
            $table->string('emailSolicitandoDocumentacaoParaPagamento', 3)->nullable();
            $table->string('statusAnaliseDistrato', 50);
            $table->string('motivoDistrato', 250)->nullable();
            $table->text('observacaoDistrato')->nullable();
            $table->text('parecerAnalista')->nullable();
            $table->string('matriculaAnalista', 7)->nullable();
            $table->text('parecerGestor')->nullable();
            $table->string('matriculaGestor', 7)->nullable();
            $table->string('isentarMulta', 3)->nullable();
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
        Schema::dropIfExists('TBL_DISTRATOS_DEMANDAS');
    }
}
