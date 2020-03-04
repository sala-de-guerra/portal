<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\GestaoEquipesEmpregados;

class GestaoEquipesEmpregados extends Model
{
    protected $table = 'TBL_GESTAO_EQUIPES_EMPREGADOS';
    protected $primaryKey = 'matricula';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = 
        [
            'matricula',
            'codigoUnidadeLotacao',
            'idEquipe',
            'disponivel',
            'eventualEquipe',
            'created_at',
            'updated_at',
        ];
    public function gestaoEquipeCelulas()
    {
        return $this->belongsTo('App\Models\GestaoEquipesCelulas', 'idEquipe', 'idEquipe');
    }
    
    public function dadosEmpregadosLdap()
    {
        return $this->belongsTo('App\Models\Empregado', 'matricula', 'matricula');
    }
}
