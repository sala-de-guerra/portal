<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TabelaImportExcel extends Model
{
    protected $table = 'TBL_IMPORTA_EXCEL';
    protected $fillable = 
    [
        'idExcel',
        'Contrato',
        'caixa',
        'silog',
        'created_at',
        'updated_at',
    ];
}
