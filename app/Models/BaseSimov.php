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

    public function conformidadeContratacao()
    {
        return $this->hasOne('App\Models\GestaoImoveisCaixa\ConformidadeContratacao', 'numeroContrato', 'NU_BEM');
    }

    public function saldoContratoSinaf()
    {
        return $this->hasOne('App\Models\GestaoImoveisCaixa\SaldoConstratoSinaf', 'numeroContrato', 'NU_BEM');
    }

    public function leilaoNegativoExcel()
    {
        return $this->hasOne('App\Models\LeilaoNegativo\LeilaoNegativoExcel', 'BEM_FORMATADO', 'contratoFormatado');
    }
}