<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableAtendeDemandasInsereEmailsCopias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_ATENDE_DEMANDAS', function (Blueprint $table) {
            $table->string('emailContatoCopia', 150)->nullable();
            $table->string('emailContatoNovaCopia', 150)->nullable();
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
            $table->dropColumn('emailContatoCopia', 150)->nullable();
            $table->dropColumn('emailContatoNovaCopia', 150)->nullable();
        });
    }
}
