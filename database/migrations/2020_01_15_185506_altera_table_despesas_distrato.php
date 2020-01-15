<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlteraTableDespesasDistrato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_DISTRATO_RELACAO_DESPESAS', function (Blueprint $table) {
            $table->date('dataEfetivaDaDespesa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TBL_DISTRATO_RELACAO_DESPESAS', function (Blueprint $table) {
            $table->dropColumn('dataEfetivaDaDespesa');
        });
    }
}
