<?php

namespace App\Models\Retorno;

use Illuminate\Database\Eloquent\Model;

class Retorno extends Model
{
    protected $table = 'TBL_CONTROLA_RETORNO';
    public $timestamps = false;
    protected $fillable = [
        'idRetorno'
        ,'nuBem'
        ,'dataRetorno'
        ,'matriculaSolicitante'
        ];
}