<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateTabelaImportExcelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_IMPORTA_EXCEL', function (Blueprint $table) {
            $table->bigIncrements('idExcel');
            $table->string('DataInclusaoPlanilha')->nullable();
            $table->string('MatriculaInclusaoPlanilha')->nullable();
            $table->string('Contrato');
            $table->string('NU_BEM')->nullable();;
            $table->string('Classificacao')->nullable();;
            $table->string('Status')->nullable();;
            $table->string('Coluna1')->nullable();;
            $table->string('Caixa');
            $table->string('Silog');
            $table->string('Matricula');
            $table->string('GILIE');
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
        Schema::dropIfExists('TBL_IMPORTA_EXCEL');
    }
}
