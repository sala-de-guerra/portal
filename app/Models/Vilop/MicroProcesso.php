<?php

namespace App\Models\Vilop;

use Illuminate\Database\Eloquent\Model;

class MicroProcesso extends Model
{
    protected $table = 'TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS';
    protected $primaryKey = 'idMicro';
    public $timestamps = false;
    protected $fillable = [
         'IdMacroProcesso'
        ,'NOME_MICROATIVIDADE'
        ,'MENSURAVEL'
        ,'VOLUME_TOTAL_DEMANDA'
        ,'VOLUME_TOTAL_TRATADA'
        ,'PERIODO_TRATADO_DE'
        ,'PERIODO_TRATADO_ATE'
        ,'MEDIA_DIA'
        ,'TEMPO_EM_MINUTOS'
        ,'NIVEL_COMPLEXIDADE'
        ,'NIVEL_AUTOMACAO'
        ,'GRAU_CRITICIDADE'
        ,'GRAU_PADRONIZACAO'
        ,'GRAU_AUTONOMIA'
        ,'SISTEMA_ORIGEM_INFORMACAO'
        ,'RESPONSAVEL_CADASTRO_MICROATIVIDADE'
        ,'EXCLUIDO_USUARIO'
        ,'MATRICULA_RESPONSAVEL_EXCLUSAO'
        ,'QTDE_PESSOAS_ALOCADAS'
        ];

        public function macroAtividades()
    {
        return $this->belongsTo('App\Models\Vilop\MacroProcesso', 'IdMacroProcesso', 'IdMacro');
    }
}