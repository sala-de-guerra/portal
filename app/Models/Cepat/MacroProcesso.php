<?php

namespace App\Models\Cepat;

use Illuminate\Database\Eloquent\Model;

class MacroProcesso extends Model
{
    protected $table = 'TBL_PRODUTIVIDADE_CEPAT_TBL_MACROPROCESSOS';
    protected $primaryKey = 'IdMacro';
    public $timestamps = false;
    protected $fillable = [
        'CGC_UNIDADE'
        ,'NOME_UNIDADE'
        ,'NOME_MACROATIVIDADE'
        ,'QTDE_PESSOAS_ALOCADAS'
        ,'MATRICULA_RESPONSAVEL_RESPOSTA'
        ,'DATA_RESPOSTA'
        ];
    

    public function microAtividades()
    {
        return $this->hasMany('App\Models\Cepat\MicroProcesso', 'IdMacroProcesso', 'IdMacro');
    }


}