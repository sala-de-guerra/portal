<?php

namespace App\Models\GestaoImoveisCaixa;

use Illuminate\Database\Eloquent\Model;

class ConformidadeContratacao extends Model
{
    protected $table = 'ADJTBL_imoveisCaixa';

    public function simov()
    {
        return $this->belongsTo('App\Models\BaseSimov', 'NU_BEM', 'numeroContrato');
    }
}