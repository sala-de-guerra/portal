<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ControleMensageria extends Model
{
    protected $table = 'TBL_CONTROLE_MENSAGENS_ENVIADAS';
    protected $primaryKey = 'numeroContrato';
    public $timestamps = true;
    protected $fillable = [
            'tipoMensagem',
            'numeroContrato',
            'emailProponente',
        ];
}
