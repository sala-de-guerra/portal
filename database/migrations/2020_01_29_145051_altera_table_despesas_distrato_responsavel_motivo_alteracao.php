<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlteraTableDespesasDistratoResponsavelMotivoAlteracao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_DISTRATO_RELACAO_DESPESAS', function (Blueprint $table) {
            $table->string('responsavelAlteracaoDespesa', 7)->nullable();
            $table->text('motivoAlteracaoDespesa')->nullable();
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
            $table->dropColumn('responsavelAlteracaoDespesa');
            $table->dropColumn('motivoAlteracaoDespesa');
        });
    }
}
