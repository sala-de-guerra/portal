<?php

namespace App\Models\LeilaoNegativo;

use Illuminate\Database\Eloquent\Model;

class LeilaoNegativoExcel extends Model
{
    protected $table = 'TBL_LEILOES_NEGATIVOS_CONTRATOS';
    protected $primaryKey = 'idContratoLeilaoNegativo';
    public $timestamps = false;
    protected $appends = [
        'dataSegundoLeilao',
        'dataEntregaDocumentosLeiloeiro',
        'dataRetiradaDocumentosDespachante',
        'previsaoEntregaDocumentosCartorio',
        'dataPrevistaAnaliseCartorio',
        'dataRetiradaDocumentoCartorio',
        'dataEntregaAverbacaoExigenciaUnidade'
    ];
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
    public function getdataSegundoLeilaoAttribute()
    {
        return date('d/m/Y', strtotime($this->attributes['dataSegundoLeilao']));

    }
    public function getdataEntregaDocumentosLeiloeiroAttribute()
    {
        return date('d/m/Y', strtotime($this->attributes['dataEntregaDocumentosLeiloeiro']));

    }
    public function getdataRetiradaDocumentosDespachanteAttribute()
    {
        return date('d/m/Y', strtotime($this->attributes['dataRetiradaDocumentosDespachante']));

    }
    public function getprevisaoEntregaDocumentosCartorioAttribute()
    {  
        if ($this->attributes['previsaoEntregaDocumentosCartorio'] != null ){
        return date('d/m/Y', strtotime($this->attributes['previsaoEntregaDocumentosCartorio']));
        }
    }
    public function getdataPrevistaAnaliseCartorioAttribute()
    {
        
        $acertaDataNull = date('d/m/Y', strtotime($this->attributes['dataPrevistaAnaliseCartorio']));
        if ($acertaDataNull == 31/12/1969 || $acertaDataNull == '31/12/1969'){
            return "";
        }else{
            return date('d/m/Y', strtotime($this->attributes['dataPrevistaAnaliseCartorio']));
        }  
        
    }
    public function getdataRetiradaDocumentoCartorioAttribute()
    {
        $acertaDataNull = date('d/m/Y', strtotime($this->attributes['dataRetiradaDocumentoCartorio']));
        if ($acertaDataNull == 31/12/1969 || $acertaDataNull == '31/12/1969'){
            return "";
        }else{
            return date('d/m/Y', strtotime($this->attributes['dataRetiradaDocumentoCartorio']));
        }
    }
    public function getdataEntregaAverbacaoExigenciaUnidadeAttribute()
    {
        $acertaDataNull = date('d/m/Y', strtotime($this->attributes['dataEntregaAverbacaoExigenciaUnidade']));
        if ($acertaDataNull == 31/12/1969 || $acertaDataNull == '31/12/1969'){
            return "";
        }else{
            return date('d/m/Y', strtotime($this->attributes['dataEntregaAverbacaoExigenciaUnidade']));
        }
    }
    
    public function simov()
    {
        return $this->belongsTo('App\Models\BaseSimov', 'contratoFormatado', 'BEM_FORMATADO');
        
    }

    public function leiloeiro()
    {
        return $this->belongsTo('App\Models\Fornecedores\Leiloeiro', 'idLeiloeiro', 'idLeiloeiro');
        
    }

    public function historico()
    {
        return $this->belongsTo('App\Models\HistoricoPortalGilie', 'contratoFormatado', 'numeroContrato');
        
    }
}