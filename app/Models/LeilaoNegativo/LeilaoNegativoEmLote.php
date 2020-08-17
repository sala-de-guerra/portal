<?php

namespace App\Models\LeilaoNegativo;

use Illuminate\Database\Eloquent\Model;

class LeilaoNegativoEmLote extends Model
{
    protected $table = 'TBL_LEILOES_NEGATIVOS_CONTRATOS';
    protected $primaryKey = 'contratoFormatado';
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
    
        public function CodigoCorreio()
        {
            return $this->hasMany('App\Models\Models\LeilaoNegativo\Codigo_correio_leilaoNegativo', 'contratoFormatado', 'contratoFormatado');
            
        }

}
