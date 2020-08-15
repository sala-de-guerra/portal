<?php

namespace App\Models\GestaoImoveisCaixa;

use Illuminate\Database\Eloquent\Model;

class ControleChave extends Model
{
    protected $table = 'TBL_CONTROLE_CHAVES';
    protected $primaryKey = 'idChaves';
    public $timestamps = false;
    protected $fillable = [
        'BEM_FORMATADO'
        ,'NU_BEM'
        ,'numeroChave'
        ,'quantidadeChave'
        ,'quantidadeEmprestada'
        ,'observacao'
        ,'numeroChave1'
        ,'statusChave1'
        ,'nomeProponente1'
        ,'cpfProponente1'
        ,'RGProponente1'
        ,'dataRetiradaChave1'
        ,'numeroChave2'
        ,'statusChave2'
        ,'nomeProponente2'
        ,'cpfProponente2'
        ,'RGProponente2'
        ,'dataRetiradaChave2'
        ,'numeroChave3'
        ,'statusChave3'
        ,'nomeProponente3'
        ,'cpfProponente3'
        ,'RGProponente3'
        ,'dataRetiradaChave3'
        ,'numeroChave4'
        ,'statusChave4'
        ,'nomeProponente4'
        ,'cpfProponente4'
        ,'RGProponente4'
        ,'dataRetiradaChave4'
        ,'numeroChave5'
        ,'statusChave5'
        ,'nomeProponente5'
        ,'cpfProponente5'
        ,'RGProponente5'
        ,'dataRetiradaChave5'
        ,'numeroChave6'
        ,'statusChave6'
        ,'nomeProponente6'
        ,'cpfProponente6'
        ,'RGProponente6'
        ,'dataRetiradaChave6'
        ];

}
