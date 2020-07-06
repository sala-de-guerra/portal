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
            $table->string('BEM_FORMATADO');
            $table->string('NU_BEM');
            $table->text('observacao')->nullable();
            $table->string('numeroOS');
            $table->string('statusSiopi')->nullable();
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
