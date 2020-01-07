<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseSimov extends Model
{
    protected $table = 'ALITB001_Imovel_Completo';
    protected $primaryKey = 'BEM_FORMATADO';

    public function distrato()
    {
        return $this->belongsTo('App\Models\GestaoImoveisCaixa\Distrato', 'contratoFormatado', 'BEM_FORMATADO');
    }
}