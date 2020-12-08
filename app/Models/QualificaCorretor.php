<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QualificaCorretor extends Model
{
    protected $table = 'TBL_CORRETORES_QUALIFICACAO';
    protected $primaryKey = 'NU_CPF_CORRETOR';
    public $timestamps = false;
    protected $fillable = [
        'NU_CPF_CORRETOR'
        ,'NO_CORRETOR'
        ,'QUALIFICACAO'
        ,'GILIE'
        ];
}