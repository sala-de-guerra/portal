<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GestaoEquipesLogHistorico extends Model
{
    protected $table = 'TBL_GESTAO_EQUIPES_LOG_HISTORICO';
    protected $primaryKey = 'idLog';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = 
        [
            'idEquipe',
            'matriculaResponsavel',
            'tipo',
            'observacao',
            'dataLog',
        ];
}
