<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlteraTableDistratoDemandaComValoresPropostaAgRegistroContrato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_DISTRATOS_DEMANDAS', function (Blueprint $table) {
            $table->decimal('valorRecursosPropriosProposta', 17, 2)->nullable();
            $table->decimal('valorFgtsProposta', 17, 2)->nullable();
            $table->decimal('valorFinanciadoProposta', 17, 2)->nullable();
            $table->decimal('valorParceladoProposta', 17, 2)->nullable();
            $table->integer('codigoAgenciaContratacao')->nullable();
            $table->string('vendaRegistradaCartorio', 3)->nullable();
            $table->string('emailSolicitandoDocumentacaoParaPagamento', 3)->nullable();
            $table->string('isentarMulta', 3)->nullable();


            // REMOVI ESSAS COLUNAS POIS AGORA EXITE TABELA AUXILIAR PARA CADASTRAR DESPESAS E MULTAS
            $table->dropColumn('valorMulta');
            $table->dropColumn('incidenciaMulta');

            /*
                COLOQUEI O ATRIBUTO NULLABLE NO MOTIVO CADASTRO PARA NÃO IMPEDIR O CADASTRO SEM MOTIVO 
                (CASO DO CADASTRO SER FEITO POR COLEGA SEM CONHECIMENTO TECNICO DA ATIVIDADE)
            */
            $table->string('motivoDistrato')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TBL_DISTRATOS_DEMANDAS', function (Blueprint $table) {
            $table->dropColumn('valorRecursosPropriosProposta');
            $table->dropColumn('ValorFgtsProposta');
            $table->dropColumn('ValorFinanciadoProposta');
            $table->dropColumn('valorParceladoProposta');
            $table->dropColumn('codigoAgenciaContratacao');
            $table->dropColumn('vendaRegistradaCartorio');
            $table->dropColumn('emailSolicitandoDocumentacaoParaPagamento');

            $table->decimal('valorMulta', 17, 2)->nullable();
            $table->string('incidenciaMulta', 3)->nullable();

            $table->string('motivoDistrato')->change();
        });
    }
}
