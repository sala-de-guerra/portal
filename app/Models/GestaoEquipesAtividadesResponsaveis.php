<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GestaoEquipesAtividadesResponsaveis extends Model
{
    protected $table = 'TBL_GESTAO_EQUIPES_ATIVIDADES_RESPONSAVEIS';
    protected $primaryKey = 'idResponsavelAtividade';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = 
        [
            'idAtividade',
            'matriculaResponsavelAtividade',
            'atuandoAtividade',
            'matriculaResponsavelDesignacao',
            'dataCadastro',
            'dataAtualizacao',
        ];
    
    public function GestaoEquipesAtividades()
    {
        return $this->belongsTo('App\Models\GestaoEquipesAtividades', 'idAtividade', 'idAtividade');
    }

    public function dadosEmpregadoLdap()
    {
        return $this->belongsTo('App\Models\Empregado', 'matricula', 'matriculaResponsavelAtividade');
    }
}
