<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlteraHistoricoPortalGiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_HISTORICO_PORTAL_GILIE', function (Blueprint $table) {
            $table->string('numeroContrato', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TBL_HISTORICO_PORTAL_GILIE', function (Blueprint $table) {
            $table->dropColumn('numeroContrato');
        });
    }
}
