<?php

namespace App\Models\TMA;

use Illuminate\Database\Eloquent\Model;

class TMAaVista extends Model
{
    protected $table = 'TBL_VENDA_AVISTA';
    protected $primaryKey = 'BEM_FORMATADO';
    public $timestamps = false;
    protected $fillable = [
        'BEM_FORMATADO'
        ,'NU_BEM'
        ,'PAGAMENTO_BOLETO'
        ,'UNA'
        ,'DIAS_DECORRIDOS'
        ,'CLASSIFICACAO'
        ,'NOME_PROPONENTE'
        ,'CPF_CNPJ_PROPONENTE'
        ,'baixaEfetuada'
        ];
}