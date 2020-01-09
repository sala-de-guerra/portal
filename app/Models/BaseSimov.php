<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseSimov extends Model
{
    protected $table = 'ALITB001_Imovel_Completo';
    // protected $primaryKey = 'BEM_FORMATADO';

    public function distrato()
    {
        return $this->hasMany('App\Models\GestaoImoveisCaixa\Distrato', 'contratoFormatado', 'BEM_FORMATADO');
    }

    public function propostas()
    {
        return $this->hasMany('App\Models\PropostasSimov', 'contratoFormatado', 'BEM_FORMATADO');
    }
}