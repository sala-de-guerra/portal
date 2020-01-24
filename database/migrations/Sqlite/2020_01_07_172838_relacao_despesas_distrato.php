<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelacaoDespesasDistrato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_DISTRATO_RELACAO_DESPESAS', function (Blueprint $table) {
            $table->bigIncrements('idDespesa');
            $table->integer('idDistrato');
            $table->string('tipoDespesa', 250);
            $table->decimal('valorDespesa', 17, 2);
            $table->string('devolucaoPertinente', 3)->nullable();
            $table->text('observacaoDespesa')->nullable();
            $table->date('dataEfetivaDaDespesa')->nullable();
            $table->string('excluirDespesa', 3)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_DISTRATO_RELACAO_DESPESAS');
    }
}
