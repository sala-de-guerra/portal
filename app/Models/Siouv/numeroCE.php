<?php

namespace App\Models\Siouv;

use Illuminate\Database\Eloquent\Model;

class numeroCE extends Model
{
    protected $table = 'TBL_NUMERO_CE';
    public $timestamps = false;
    protected $fillable = [
         'idCe'
        ,'matricula'
        ];
}