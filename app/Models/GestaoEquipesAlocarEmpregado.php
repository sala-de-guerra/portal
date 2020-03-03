<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GestaoEquipesAlocarEmpregado extends Model
{
    protected $table = 'TBL_GESTAO_EQUIPES_ALOCAR_EMPREGADO';
    protected $primaryKey = 'matricula';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = 
        [
            'matricula',
            'idEquipe',
            'responsavelAlocacao',
            'created_at',
            'updated_at',
        ];
    public function gestaoEquipeCelulas()
    {
        return $this->belongsTo('App\Models\GestaoEquipesCelulas', 'idEquipe', 'idEquipe');
    }
}
