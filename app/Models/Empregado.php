<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empregado extends Model
{
    protected $table = 'TBL_EMPREGADOS';
    protected $primaryKey = 'matricula';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = 
        [
            'nomeCompleto',
            'primeiroNome',
            'dataNascimento',
            'codigoFuncao',
            'nomeFuncao',
            'codigoLotacaoAdministrativa',
            'nomeLotacaoAdministrativa',
            'codigoLotacaoFisica',
            'nomeLotacaoFisica',
        ];
    public function acessaPortal()
    {
        return $this->hasOne('App\Models\AcessaPortal', 'matricula', 'matricula');
    }

    public function gestaoEquipeEmpregados()
    {
        return $this->hasOne('App\Models\GestaoEquipesEmpregados', 'matricula', 'matricula');
    }

    public function GestaoEquipesAtividadesResponsaveis()
    {
        return $this->belongsTo('App\Models\GestaoEquipesAtividadesResponsaveis', 'matriculaResponsavelAtividade', 'matricula');
    }
}