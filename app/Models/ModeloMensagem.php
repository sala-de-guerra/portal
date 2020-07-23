<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModeloMensagem extends Model
{
    protected $table = 'TBL_MODELO_MENSAGERIA';
    protected $primaryKey = 'id';
    protected $fillable = [
            'matricula',
            'nomeModelo',
            'modeloMensageria',
            'created_at',
            'updated_at'
        ];
}