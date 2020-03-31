<?php

namespace App\Models\Fornecedores;

use Illuminate\Database\Eloquent\Model;

class Leiloeiro extends Model
{
    protected $table = 'TBL_FORNECEDORES_DADOS_LEILOEIRO';
    protected $primaryKey = 'idLeiloeiro';
    public $timestamps = false;
    protected $fillable = [
        'numeroContrato',
        'dataVencimentoContrato',
        'nomeLeiloeiro',
        'telefoneLeiloeiro',
        'emailLeiloeiro',
        'enderecoLeiloeiro',
        'nomeEmpresaAssessoraLeiloeiro',
        'telefoneEmpresaAssessoraLeiloeiro',
        'emailEmpresaAssessoraLeiloeiro',
        'siteEmpresaAssessoraLeiloeiro',
        'enderecoEmpresaAssessoraLeiloeiro',
        'enderecoRealizacaoLeilao',
        'unidadeGestora',
        'leiloeiroAtivo',
        'dataCadastro',
        'dataAlteracao',
    ];
}
