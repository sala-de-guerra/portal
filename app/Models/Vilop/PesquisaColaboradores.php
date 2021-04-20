<?php

namespace App\Models\Vilop;

use Illuminate\Database\Eloquent\Model;

class PesquisaColaboradores extends Model
{
    protected $table = 'produtividade.TB_PESQUISA_COLABORADOR';
    protected $primaryKey = 'idPesquisaColaborador';
    public $timestamps = false;
    protected $fillable = [
         'matricula'
        ,'dataResposta'
        ,'codigoLotacaoAdministrativa'
        ,'codigoLotacaoFisica'
        ,'codigoUnidadeResposta'
        ,'idMicro'
        ,'tempoAtividadeMinutos'
        ];

}

