<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLeiloesNegativosContratos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_LEILOES_NEGATIVOS_CONTRATOS', function (Blueprint $table) {
            $table->bigIncrements('idContratoLeilaoNegativo');
            $table->string('contratoFormatado', 50);
            $table->string('numeroContrato', 50);
            $table->string('numeroLeilao', 255)->nullable();
            $table->string('statusAverbacao', 100);
            $table->string('unidadeResponsavel', 4);
            
            $table->integer('idLeiloeiro')->nullable();
            $table->date('previsaoRecebimentoDocumentosLeiloeiro');
            $table->date('dataEntregaDocumentosLeiloeiro')->nullable();
            
            $table->integer('idDespachante')->nullable();
            $table->date('previsaoDisponibilizacaoDocumentosAoDespachante');
            $table->date('dataRetiradaDocumentosDespachante')->nullable();
            $table->string('numeroOficioUnidade', 17)->nullable();
            $table->date('previsaoEntregaDocumentosCartorio')->nullable();
            
            $table->string('numeroProtocoloCartorio', 255)->nullable();
            $table->string('codigoAcessoProtocoloCartorio', 255)->nullable();
            $table->date('dataPrevistaAnaliseCartorio')->nullable();
            $table->date('dataRetiradaDocumentoCartorio')->nullable();
            $table->date('dataEntregaAverbacaoExigenciaUnidade')->nullable();
            $table->string('existeExigencia', 3)->nullable();
            
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
        Schema::dropIfExists('TBL_LEILOES_NEGATIVOS_CONTRATOS');
    }
}
