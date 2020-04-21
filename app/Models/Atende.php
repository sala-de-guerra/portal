<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atende extends Model
{
    protected $table = 'TBL_ATENDE_DEMANDAS';
    protected $primaryKey = 'idAtende';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = 
        [
            'idAtende',
            'contratoFormatado',
            'codigoUnidade',
            'numeroContrato',
            'idEquipe',
            'idAtividade',
            'matriculaResponsavelAtividade',
            'assuntoAtende',
            'descricaoAtende',
            'motivoRedirecionamento',
            'prazoAtendimentoAtende',
            'statusAtende',
            'matriculaCriadorDemanda',
            'emailContatoResposta',
            'dataCadastro',
            'dataAlteracao',
        ];
    
    public function gestaoEquipeCelulas()
    {
        return $this->hasOne('App\Models\GestaoEquipesCelulas', 'idEquipe', 'idEquipe');
    }

    public function gestaoEquipeEmpregados()
    {
        return $this->hasMany('App\Models\GestaoEquipesEmpregados', 'idEquipe', 'idEquipe');
    }

    public function gestaoEquipesAtividades()
    {
        return $this->hasOne('App\Models\GestaoEquipesAtividades', 'idAtividade', 'idAtividade');
    }

    public function gestaoEquipesAtividadesResponsaveis()
    {
        return $this->hasMany('App\Models\GestaoEquipesAtividadesResponsaveis', 'idAtividade', 'idAtividade');
    }
}
