<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlteraTableGestaoEquipeAtividadeInsereCamposIncluirAtividadeAtendeIconeAtividade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_GESTAO_EQUIPES_ATIVIDADES', function (Blueprint $table) {
            $table->boolean('incluirAtividadeAtende')->nullable();
            $table->string('iconeAtividade', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TBL_GESTAO_EQUIPES_ATIVIDADES', function (Blueprint $table) {
            $table->dropColumn('incluirAtividadeAtende');
            $table->dropColumn('iconeAtividade');
        });
    }
}
