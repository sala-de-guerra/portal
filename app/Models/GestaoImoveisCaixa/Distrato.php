<?php

namespace App\Models\GestaoImoveisCaixa;

use Illuminate\Database\Eloquent\Model;

class Distrato extends Model
{
    protected $table = 'TBL_DISTRATOS_DEMANDAS';
    protected $primaryKey = 'idDistrato';
    protected $fillable = [
            'contratoFormatado',
            'nomeProponente',
            'statusAnalise',
            'motivoDistrato',
            'observacaoDistrato',
            'parecerAnalista',
            'matriculaAnalista',
            'parecerGestor',
            'matriculaGestor',
        ];

    public function simov()
    {
        return $this->belongsTo('App\Models\BaseSimov', 'contratoFormatado', 'BEM_FORMATADO');
    }

    public function despesas()
    {
        return $this->hasMany('App\Models\GestaoImoveisCaixa\DistratoRelacaoDespesas', 'idDistrato', 'idDistrato');
    }
}
