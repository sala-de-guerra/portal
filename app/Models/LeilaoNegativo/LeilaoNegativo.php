<?php

namespace App\Models\LeilaoNegativo;

use Illuminate\Database\Eloquent\Model;

class LeilaoNegativo extends Model
{
    protected $table = 'TBL_LEILOES_NEGATIVOS_CONTRATOS';
    protected $primaryKey = 'idContratoLeilaoNegativo';
    public $timestamps = false;
    protected $fillable = [
        'contratoFormatado',
        'numeroContrato',
        'numeroLeilao',
        'previsaoRecebimentoDocumentosLeiloeiro',
        'previsaoDisponibilizacaoDocumentosAoDespachante',
        'dataRetiradaDocumentosDespachante',
        'numeroOficioUnidade',
        'previsaoProtocoloCartorio',
        'numeroProtocoloCartorio',
        'codigoAcessoProtocoloCartorio',
        'dataPrevistaAnaliseCartorio',
        'dataRetiradaDocumentoCartorio',
        'dataEntregaAverbacaoExigenciaUnidade',
        'statusAverbacao',
        'existeExigencia',
        'unidadeResponsavel',
        'idLeiloeiro',
        'idDespachante',
        'dataCadastro',
        'dataAlteracao',
        ];
        public function getData2Attribute()
        {
            return date('d/m/Y', strtotime($this->attributes['dataSegundoLeilao']));
        }
   

}
