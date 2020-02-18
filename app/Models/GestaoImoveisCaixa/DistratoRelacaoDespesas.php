<?php

namespace App\Models\GestaoImoveisCaixa;

use Illuminate\Database\Eloquent\Model;

class DistratoRelacaoDespesas extends Model
{
    protected $table = 'TBL_DISTRATO_RELACAO_DESPESAS';
    protected $primaryKey = 'idDespesa';
    public $timestamps = false;
    protected $fillable = [
            'idDistrato',
            'tipoDespesa',
            'valorDespesa',
            'devolucaoPertinente',
            'observacaoDespesa',
        ];

    public function distrato()
    {
        return $this->belongsTo('App\Models\GestaoImoveisCaixa\Distrato', 'idDistrato', 'idDistrato');
    }
}
