<?php

namespace App\Models\GestaoImoveisCaixa;

use Illuminate\Database\Eloquent\Model;

class ControleExcelBoleto extends Model
{
    protected $table = 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE';
    
    protected $fillable = 
    [
          'GILIE'
         ,'NU_BEM'
        // ,'DATA_PROPOSTA'
        // ,'AG_CONTRATACAO'
        // ,'CCA'
        // ,'MODALIDADE_VENDA'
        // ,'AGRUPAMENTO'
        // ,'COMISSAO'
        // ,'ITEM'
        // ,'CONCESSAO'
        // ,'ENDERECO_IMOVEL'
        // ,'BAIRRO'
        // ,'REFERENCIA'
        // ,'EMPREENDIMENTO'
        // ,'CIDADE'
        // ,'UF'
        // ,'PROPONENTES'
         ,'PROPONENTE1'
        // ,'CPFCNPJ_PROPONENTE1'
        // ,'CELULAR_PROPONENTE1'
        // ,'EMAIL_PROPONENTE1'
        // ,'PROPONENTE2'
        // ,'CPFCNPJ_PROPONENTE2'
        // ,'CELULAR_PROPONENTE2'
        // ,'EMAIL_PROPONENTE2'
        // ,'PROPONENTE3'
        // ,'CPFCNPJ_PROPONENTE3'
        // ,'CELULAR_PROPONENTE3'
        // ,'EMAIL_PROPONENTE3'
        // ,'TOTAL_PROPOSTA'
        // ,'RECURSOS_PROPRIOS'
        // ,'FGTS'
        // ,'FINANCIAMENTO'
        // ,'CONSORCIO'
        // ,'PARCELAMENTO'
        // ,'PARCELAS'
        // ,'CORRETOR'
        // ,'CPF_CORRETOR'
        // ,'CRECI'
        // ,'CELULAR_CORRETOR'
        // ,'EMAIL_CORRETOR'
        // ,'SEQUENCIAL'
         ,'VENCIMENTO'
        // ,'VALIDADE'
          ,'VALOR BOLETO'
        // ,'EMISSAO'
        // ,'SOLICITANTE'
          ,'SITUAÇÃO'
         ,'PAGAMENTO'
        // ,'BANCO'
        // ,'AGENCIA'
        // ,'RECURSO'
          ,'PAGO'
        // ,'CIWEB_SIPGE'
        // ,'ORIGEM'
        // ,'PAGAMENTO MANUAL'
        // ,'MATRICULA MANUAL'
        // ,'CANCELAMENTO'
        // ,'MATRICULA CANCELAMENTO'
        // ,'MOTIVO'
    ];

}
