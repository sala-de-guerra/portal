<?php

namespace App\Models\GestaoImoveisCaixa;

use Illuminate\Database\Eloquent\Model;

class SaldoConstratoSinaf extends Model
{
    protected $table = 'TBL_SALDO_ATUALIZADO_CONTRATOS_SINAF';

    public function simov()
    {
        return $this->belongsTo('App\Models\BaseSimov', 'NU_BEM', 'numeroContrato');
    }
}
