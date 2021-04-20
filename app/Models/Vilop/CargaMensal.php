<?php

namespace App\Models\Vilop;

use Illuminate\Database\Eloquent\Model;

class CargaMensal extends Model
{
    protected $table = 'produtividade.TB_CARGA_MENSAL';
    protected $primaryKey = 'ID_CARGA';
    public $timestamps = false;
    protected $fillable = [
         'ID_AG_MACRO_MICRO'
        ,'QTDE_PESSOAS_ALOCADAS'
        ,'VOLUME_TOTAL_DEMANDA'
        ,'VOLUME_TOTAL_TRATADA'
        ,'DIAS_UTEIS'
        ,'MEDIA_DIA'
        ,'TEMPO_EM_MINUTOS'
        ,'NIVEL_COMPLEXIDADE'
        ,'NIVEL_AUTOMACAO'
        ,'GRAU_CRITICIDADE'
        ,'GRAU_PADRONIZACAO'
        ,'GRAU_AUTONOMIA'
        ,'SISTEMA_ORIGEM_INFORMACAO'
        ];

    public function processoDaCarga()
    {
        return $this->hasMany('App\Models\Vilop\TabelaRelacionamento', 'ID_AG_MACRO_MICRO', 'ID_AG_MACRO_MICRO');
    }
}