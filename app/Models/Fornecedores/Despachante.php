<?php

namespace App\Models\Fornecedores;

use Illuminate\Database\Eloquent\Model;

class Despachante extends Model
{
    protected $table = 'TBL_FORNECEDORES_DADOS_DESPACHANTE';
    protected $primaryKey = 'idDespachante';
    public $timestamps = false;
    protected $fillable = [
            'numeroContrato',
            'dataVencimentoContrato',
            'cnpjDespachante',
            'nomeDespachante',
            'telefoneDespachante',
            'emailDespachante',
            'nomePrimeiroResponsavelDespachante',
            'telefonePrimeiroResponsavelDespachante',
            'emailPrimeiroResponsavelDespachante',
            'nomeSegundoResponsavelDespachante',
            'telefoneSegundoResponsavelDespachante',
            'emailSegundoResponsavelDespachante',
            'nomeTerceiroResponsavelDespachante',
            'telefoneTerceiroResponsavelDespachante',
            'emailTerceiroResponsavelDespachante',
            'unidadeGestora',
            'despachanteAtivo',
            'dataCadastro',
            'dataAlteracao',
        ];
}
