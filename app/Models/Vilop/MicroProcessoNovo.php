<?php

namespace App\Models\Vilop;

use Illuminate\Database\Eloquent\Model;

class MicroProcessoNovo extends Model
{
    protected $table = 'produtividade.TB_MICROPROCESSO';
    protected $primaryKey = 'ID_MICRO';
    public $timestamps = false;
    protected $fillable = [
         'DE_MICRO'
        ,'CO_RESPONSAVEL_ATUALIZACAO'
        ,'DT_ATUALIZACAO'
        ,'IC_MENSURAVEL'
        ];

        public function processoDaMicro()
    {
        return $this->belongsTo('App\Models\Vilop\TabelaRelacionamento', 'ID_MICRO', 'ID_MICRO');
    }

    public function cargaMicro()
    {
        return $this->hasMany('App\Models\Vilop\CargaMensal', 'ID_AG_MACRO_MICRO', 'ID_AG_MACRO_MICRO');
    }
}