<?php

namespace App\Models\Vilop;

use Illuminate\Database\Eloquent\Model;

class TabelaRelacionamento extends Model
{
    protected $table = 'produtividade.TB_RELACAO_CGC_MACRO_MICRO';
    protected $primaryKey = 'ID_AG_MACRO_MICRO';
    public $timestamps = false;
    protected $fillable = [
         'NU_CGC'
        ,'ID_MACRO'
        ,'ID_MICRO'
        ,'IC_ATIVO'
        ,'CO_RESPONSAVEL_ATULIZACAO'
        ,'DT_ATUALIZACAO'
        ];
    

        public function macroAtividades()
        {
            return $this->hasMany('App\Models\Vilop\MacroProcessoNovo', 'ID_MACRO', 'ID_MACRO');
        }
        public function microAtividades()
        {
            return $this->hasMany('App\Models\Vilop\MicroProcessoNovo', 'ID_MICRO', 'ID_MICRO');
        }
        public function cargaMensal()
        {
            return $this->hasMany('App\Models\Vilop\CargaMensal', 'ID_AG_MACRO_MICRO', 'ID_AG_MACRO_MICRO');
        }
}