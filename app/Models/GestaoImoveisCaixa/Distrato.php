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

    public function distrato()
    {
        return $this->belongsTo('App\Models\BaseSimov', 'BEM_FORMATADO', 'contratoFormatado');
    }
}
