<?php

namespace App\Models\LeilaoNegativo;

use Illuminate\Database\Eloquent\Model;

class Codigo_correio_leilaoNegativo extends Model
{
    public $timestamps = false;
    
    public function leilao()
    {
        return $this->belongsTo('App\Models\Models\LeilaoNegativo\LeilaoNegativo', 'contratoFormatado', 'contratoFormatado');
        
    }
}
