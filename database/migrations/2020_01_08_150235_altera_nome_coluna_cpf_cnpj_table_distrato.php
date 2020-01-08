<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlteraNomeColunaCpfCnpjTableDistrato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_DISTRATOS_DEMANDAS', function (Blueprint $table) {
            $table->renameColumn('cpfCnpj', 'cpfCnpjProponente');
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
            $table->renameColumn('cpfCnpjProponente', 'cpfCnpj');
        });
    }
}
