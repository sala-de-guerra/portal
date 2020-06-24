<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaleConosco extends Model
{
    protected $table = 'TBL_ATENDE_SEM_CONTRATO';
    protected $appends = [
        'Data_atendimento'
    ];
    protected $fillable = 
    [
        'Data_atendimento',
    ];

    public function getDataAtendimentoAttribute()
    {
        return date('d/m/Y', strtotime($this->attributes['Data_atendimento']));

    }
}
