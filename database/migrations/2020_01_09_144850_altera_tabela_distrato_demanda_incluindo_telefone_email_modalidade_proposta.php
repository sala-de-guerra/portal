<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlteraTabelaDistratoDemandaIncluindoTelefoneEmailModalidadeProposta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_DISTRATOS_DEMANDAS', function (Blueprint $table) {
            $table->string('telefoneProponente', 50)->nullable();
            $table->string('emailProponente', 255)->nullable();
            $table->string('tipoVendaProposta', 100)->nullable();
            $table->string('demandaAtiva', 3)->nullable();
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
            $table->dropColumn('telefoneProponente');
            $table->dropColumn('emailProponente');
            $table->dropColumn('tipoVendaProposta');
            $table->dropColumn('demandaAtiva');
        });
    }
}
