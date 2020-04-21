<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlteraTableAtendeDemandasInsereCodigoUnidade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_ATENDE_DEMANDAS', function (Blueprint $table) {
            $table->integer('codigoUnidade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TBL_ATENDE_DEMANDAS', function (Blueprint $table) {
            $table->dropColumn('codigoUnidade');
        });
    }
}
