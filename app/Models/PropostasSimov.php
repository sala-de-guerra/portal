<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropostasSimov extends Model
{
    protected $table = 'ALITB048_CUB120000';
    // protected $primaryKey = 'BEM_FORMATADO';

    public function simov()
    {
        return $this->belongsTo('App\Models\BaseSimov', 'BEM_FORMATADO', 'NÚMERO BEM');
    }
}
