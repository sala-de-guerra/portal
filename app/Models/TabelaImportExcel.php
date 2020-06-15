<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TabelaImportExcel extends Model
{
    protected $table = 'TBL_IMPORTA_EXCEL';
    protected $appends = [
        'created_at'
    ];
    
    protected $fillable = 
    [
        'Contrato',
        'Caixa',
        'Silog',
        'Matricula',
        'GILIE',
        'created_at',
    ];

    public function getCreatedAtAttribute()
    {
        return date('d/m/Y', strtotime($this->attributes['created_at']));

    }
}
