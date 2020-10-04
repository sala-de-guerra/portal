<?php

namespace App\Models\TMA;

use Illuminate\Database\Eloquent\Model;

class TBLTmaAuxiliar extends Model
{
    protected $table = 'TBL_VENDA_AUXILIAR';
    protected $primaryKey = 'BEM_FORMATADO';
    public $timestamps = false;
    protected $fillable = [
        'BEM_FORMATADO'
        ,'NU_BEM'
        ,'baixaEfetuada'
        ];
}