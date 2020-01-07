<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlteraTableDistrato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_DISTRATOS_DEMANDAS', function (Blueprint $table) {
            $table->renameColumn('statusAnalise', 'statusAnaliseDistrato');
            $table->string('cpfCnpj', 150)->nullable();
            $table->decimal('valorTotalProposta', 17, 2)->nullable();
            $table->decimal('valorMulta', 17, 2)->nullable();
            $table->string('incidenciaMulta', 3)->nullable();
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
            $table->renameColumn('statusAnaliseDistrato', 'statusAnalise');
            $table->dropColumn('cpfCnpj');
            $table->dropColumn('valorTotalProposta');
            $table->dropColumn('valorMulta');
            $table->dropColumn('incidenciaMulta');
        });
    }
}
