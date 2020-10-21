<?php

namespace App\Models\Siouv;

use Illuminate\Database\Eloquent\Model;

class Siouv extends Model
{
    protected $table = 'TBL_SIOUV_DEMANDAS';
    protected $primaryKey = 'numeroSiouv';
    public $timestamps = false;
    protected $fillable = [
         'numeroSiouv'
        ,'matriculaResponsavelAtividade'
        ,'status'
        ,'NU_BEM'
        ,'processo'
        ];
}