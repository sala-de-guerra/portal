<?php

namespace App\Models\Cepat;

use Illuminate\Database\Eloquent\Model;

class AtividadeDaMicro extends Model
{
    protected $table = 'TBL_PRODUTIVIDADE_CEPAT_TBL_ATIVIDADES';
    protected $primaryKey = 'idAtividade';
    public $timestamps = false;
    protected $fillable = [
         'idMicro'
        ,'RESPONSAVEL_CADASTRO_ATIVIDADE'
        ,'NOME_ATIVIDADE'
        ];


    public function atividadeDaMicro()
    {
        return $this->belongsTo('App\Models\Cepat\MicroProcesso', 'idMicro', 'idMicro');
    }


}