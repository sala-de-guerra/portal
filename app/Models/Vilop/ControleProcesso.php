<?php

namespace App\Models\Vilop;

use Illuminate\Database\Eloquent\Model;

class ControleProcesso extends Model
{
    protected $table = 'produtividade.TB_CONTROLE_PROCESSO';
    protected $primaryKey = 'ID_CARGA';
    public $timestamps = false;
    protected $fillable = [
         'DT_CADASTRO'
        ,'MM_REFERENCIA'
        ,'AA_REFERENCIA'
        ,'DT_ENVIO_DA_CARGA'
        ,'CO_MATRICULA_RESPONSAVEL_ENVIO'
        ,'DT_PROCESSAMENTO'
        ,'NU_CGC'
        ];

}

