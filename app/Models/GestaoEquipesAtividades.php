<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GestaoEquipesAtividades extends Model
{
    protected $table = 'TBL_GESTAO_EQUIPES_ATIVIDADES';
    protected $primaryKey = 'idAtividade';
    public $incrementing = true;
    protected $fillable = 
        [
            'idEquipe',
            'nomeAtividade',
            'sinteseAtividade',
            'atividadeSubordinada',
            'idAtividadeSubordinante',
            'responsavelEdicao',
            'dataCriacaoAtividade',
            'dataAtualizacaoAtividade',
            'atividadeAtiva',
        ];
    
    public function GestaoEquipesAtividadesResponsaveis()
    {
        return $this->hasMany('App\Models\GestaoEquipesAtividadesResponsaveis', 'idAtividade', 'idAtividade');
    }

    public function GestaoEquipesCelulas()
    {
        return $this->belongsTo('App\Models\GestaoEquipesCelulas', 'idEquipe', 'idEquipe');
    }
}
