<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlteraTableGestaoEquipesCelulasInsereResponsavelAlteracao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_GESTAO_EQUIPES_CELULAS', function (Blueprint $table) {
            $table->string('responsavelExclusao', 7)->nullable();
            $table->string('responsavelEdicao', 7)->nullable();
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
            $table->dropColumn('responsavelExclusao');
            $table->dropColumn('responsavelEdicao');
        });
    }
}
