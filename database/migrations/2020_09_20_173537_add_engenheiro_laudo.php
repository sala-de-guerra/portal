<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEngenheiroLaudo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_CONTROLE_LAUDO', function (Blueprint $table) {
            $table->string('nomeEngenharia')->nullable();
            $table->string('emailEngenharia')->nullable();
            $table->string('cnpjEngenharia')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TBL_CONTROLE_LAUDO', function (Blueprint $table) {
            $table->dropColumn('nomeEngenharia')->nullable();
            $table->dropColumn('emailEngenharia')->nullable();
            $table->dropColumn('cnpjEngenharia')->nullable();
        });
    }
}
