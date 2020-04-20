<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlteraTableGestaoEquipeCelulaInsereCamposIncluirEquipeAtendeIconeEquipe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_GESTAO_EQUIPES_CELULAS', function (Blueprint $table) {
            $table->boolean('incluirEquipeAtende')->nullable();
            $table->string('iconeEquipe', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TBL_GESTAO_EQUIPES_CELULAS', function (Blueprint $table) {
            $table->dropColumn('incluirEquipeAtende');
            $table->dropColumn('iconeEquipe');
        });
    }
}
