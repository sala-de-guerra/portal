<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GestaoEquipesCelulas extends Model
{
    protected $table = 'TBL_GESTAO_EQUIPES_CELULAS';
    protected $primaryKey = 'idEquipe';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = 
        [
            'codigoUnidadeEquipe',
            'nomeEquipe',
            'matriculaGestor',
            'nomeGestor',
            'matriculaEventual',
            'nomeEventual',
            'ativa',
            'created_at',
            'updated_at',
        ];
    
    public function gestaoEquipeEmpregados()
    {
        return $this->hasMany('App\Models\GestaoEquipesEmpregados', 'idEquipe', 'idEquipe');
    }

    public function GestaoEquipesAlocarEmpregado()
    {
        return $this->hasMany('App\Models\GestaoEquipesAlocarEmpregado', 'idEquipe', 'idEquipe');
    }
}
