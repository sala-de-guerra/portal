<?php

namespace App\Models\Laudo;

use Illuminate\Database\Eloquent\Model;

class Laudo extends Model
{
    protected $table = 'TBL_CONTROLE_LAUDO';
    protected $appends = [
        'datavencimento'
    ];
    protected $fillable = [
        'UNA',
        'quanto_falta',
        'STATUS_IMOVEL',
        'numeroOS',
        'datavencimento'
        ];

    public function setDatavencimentoAttribute()
    {
        return date('d/m/Y', strtotime($this->attributes['datavencimento']));

    }
}

