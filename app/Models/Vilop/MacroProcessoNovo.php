<?php

namespace App\Models\Vilop;

use Illuminate\Database\Eloquent\Model;

class MacroProcessoNovo extends Model
{
    protected $table = 'produtividade.TB_MACROPROCESSOS';
    protected $primaryKey = 'ID_MACRO';
    public $timestamps = false;
    protected $fillable = [
         'DE_MACRO'
        ,'CO_RESPONSAVEL_ATUALIZACAO'
        ,'DT_ATUALIZACAO'
        ];
    

        public function processoDaMacro()
    {
        return $this->belongsTo('App\Models\Vilop\TabelaRelacionamento', 'ID_MACRO', 'ID_MACRO');
    }
}