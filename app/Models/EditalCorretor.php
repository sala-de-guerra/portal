<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EditalCorretor extends Model
{
    protected $table = 'TBL_CORRETORES_EDITAIS';
    protected $primaryKey = 'GILIE';
    public $timestamps = false;
    protected $fillable = [
        'GILIE'
        ,'edital'
        ];
}