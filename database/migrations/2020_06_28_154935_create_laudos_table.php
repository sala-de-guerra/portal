<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaudosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('TBL_CONTROLE_LAUDO', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quanto_falta');
            $table->string('UNA');
            $table->string('BEM_FORMATADO');
            $table->string('NU_BEM');
            $table->string('STATUS_IMOVEL');
            $table->datetime('DATA_LAUDO');
            $table->datetime('DATA_VENCIMENTO_LAUDO');
            $table->string('CLASSIFICACAO');
            $table->text('observacao')->nullable();
            $table->string('numeroOS')->nullable();
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
        Schema::dropIfExists('TBL_CONTROLE_LAUDO');
    }
}
