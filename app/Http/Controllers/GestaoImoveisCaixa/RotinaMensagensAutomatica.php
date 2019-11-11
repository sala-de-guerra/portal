<?php 

namespace App\Http\Controllers\GestaoImoveisCaixa;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Exceptions\Handler;
use App\Http\Controllers\Comex\Contratacao\Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use App\Classes\GestaoImoveisCaixa\ImoveisCaixaPhpMailer;
use App\RelacaoAgSrComEmail;
use App\Models\GestaoImoveisCaixa\ImagemCaixaCecom;

class RotinaMensagensAutomatica extends Controller
{
    public static function enviarMensageriasAutorizacaoContratacao()
    {
        $contratosPatromoniais = self::mensagemAutorizacaoImoveisPatrimoniais();
        // dd($contratosPatromoniais);
        $contratosCaixaEmgea = self::mensagemAutorizacaoCaixaEngea();
        dd($contratosCaixaEmgea);
    }


    public static function mensagemAutorizacaoImoveisPatrimoniais()
    {
        $relacaoContratosPatrimoniais = DB::select("SELECT 
                                                        'numeroBem' = [BEM_FORMATADO]
                                                        ,'grupoClassificacao' = CASE 
                                                                                    WHEN [CLASSIFICACAO] LIKE '%EMGEA%' THEN 'EMGEA'
                                                                                    WHEN [CLASSIFICACAO] = 'PANAMERICANO' THEN 'PATRIMONIAL'
                                                                                    WHEN [CLASSIFICACAO] = 'Patrimonial -Realização de Garantia' THEN 'PATRIMONIAL'
                                                                                    ELSE 'CAIXA'
                                                                                END
                                                        ,'tipoVenda' = CASE
                                                                            WHEN [TIPO_VENDA] LIKE 'Venda Online' THEN 'VENDA ONLINE'
                                                                            WHEN [TIPO_VENDA] LIKE 'Venda Direta Online' THEN 'VENDA ONLINE'
                                                                            WHEN [TIPO_VENDA] LIKE '%Leilão%' THEN 'LEILAO'
                                                                            WHEN [TIPO_VENDA] LIKE 'Venda Direta Online' THEN 'VENDA ONLINE'
                                                                            ELSE 'OUTROS TIPOS'
                                                                        END
                                                        ,'tipoProposta' = CASE 
                                                                            WHEN [VALOR_REC_PROPRIOS_PROPOSTA] = [VALOR_TOTAL_PROPOSTA] THEN 'A VISTA'
                                                                            ELSE 'FINANCIADO'
                                                                        END
                                                        ,'acaoJudial' = CASE
                                                                            WHEN [DESCRICAO_ADIC_IMOVEL] LIKE '%JUDICIA%' THEN 'SIM'
                                                                            WHEN [DESCRICAO_ADIC_IMOVEL] LIKE '%AÇÕES%' THEN 'SIM'
                                                                            WHEN [DESCRICAO_ADIC_IMOVEL] LIKE '% AÇÃO %' THEN 'SIM'
                                                                            WHEN [DESCRICAO_ADIC_IMOVEL] LIKE '% ACAO %' THEN 'SIM'
                                                                            WHEN [DESCRICAO_ADIC_IMOVEL] LIKE '%ACOES%' THEN 'SIM'
                                                                            ELSE 'NAO'
                                                                        END
                                                        ,'nomeAgencia' = [UNO]
                                                        ,'nomeSr' = [EN]
                                                        ,'enderecoImovel' = [ENDERECO_IMOVEL]
                                                        ,'dataAlteracaoStatus' = [DATA_ALTERACAO_STATUS]
                                                        --,[VALOR_TOTAL_PROPOSTA]
                                                        --,[VALOR_REC_PROPRIOS_PROPOSTA]
                                                        --,[VALOR_FGTS_PROPOSTA]
                                                        --,[VALOR_FINANCIADO_PROPOSTA]
                                                        ,'nomeProponente' = UPPER([NOME_PROPONENTE])
                                                        ,'cpfProponente' = [CPF_CNPJ_PROPONENTE]
                                                        --,[AGENCIA_CONTRATACAO_PROPOSTA]
                                                        ,'nomeCorretor' = UPPER([NO_CORRETOR])
                                                        ,'emailCorretor' = [EMAIL_CORRETOR]
                                                        --,[ACEITA_CCA]
                                                    FROM 
                                                        [ALITB001_Imovel_Completo] AS SIMOV
                                                        --LEFT JOIN [7257_1].[dbo].[ALITB048_CUB120000] AS CUB120000 ON SIMOV.[CPF_CNPJ_PROPONENTE] = CUB120000.[CPF/CNPJ PROPONENTE]
                                                    WHERE 
                                                        [UNA] = 'GILIE/SP'
                                                        AND [STATUS_IMOVEL] = 'Em contratação'
                                                        AND ([TIPO_VENDA] LIKE 'Venda Online' OR [TIPO_VENDA] like 'Venda Direta Online' OR [TIPO_VENDA] LIKE '1º Leilão SFI' OR [TIPO_VENDA] LIKE '2º Leilão SFI')
                                                        AND [DATA_ALTERACAO_STATUS] >=  DATEADD(DAY, -20, GETDATE())
                                                        AND ([CLASSIFICACAO] = 'PANAMERICANO' OR [CLASSIFICACAO] = 'Patrimonial -Realização de Garantia')
                                                    ORDER BY
                                                        'grupoClassificacao'
                                                        ,'tipoVenda'
                                                        ,'tipoProposta'"); 
        return $relacaoContratosPatrimoniais;
    }

    public static function mensagemAutorizacaoCaixaEngea()
    {
        $relacaoContratosCaixaEmgea = DB::select("SELECT DISTINCT
                                                    'numeroBem' = [N_Concil]
                                                    ,'classificacao' = VENDAS.[CLASSIFICACAO]
                                                    ,'dataAlteracaoStatus' = [DT_STATUS_ALTERACAO]
                                                    ,'tipoDeVenda' = [NO_VENDA_TIPO]
                                                    ,'dataProposta' = [DT_PROPOSTA]
                                                    ,'valorRecursoProprioProposta' = CONVERT(DECIMAL(17, 2), [Valor])
                                                    ,'valorFgtsProposta' = CONVERT(DECIMAL(17, 2), SIMOV.[VALOR_FGTS_PROPOSTA])
                                                    ,'valorFinanciadoProposta' = CONVERT(DECIMAL(17, 2), SIMOV.[VALOR_FINANCIADO_PROPOSTA])
                                                    ,'valorParceladoProposta' = CONVERT(DECIMAL(17, 2), SIMOV.[VALOR_PARCELADO_PROPOSTA])
                                                    ,'valorTotalProposta' = CONVERT(DECIMAL(17, 2), [VL_PROPOSTA])
                                                    ,'valorTotalContrato' = CONVERT(DECIMAL(17, 2), [VL_TOTAL_CONTRATO])
                                                    ,'valorTotalRecebido' = CONVERT(DECIMAL(17, 2), [VL_TOTAL_RECEBIDO])
                                                    ,'dataUltimoRecebimento' = [DT_Sinaf]
                                                    ,'pvRecebimento' = [Orig]
                                                    ,'nomeAgenciaContratacao' = AGENCIA.[nomeAgencia]
                                                    ,'vencimentoDoPp15' = CONVERT(VARCHAR(10), DATEADD(DAY, 7, [DT_PROPOSTA]), 103)
                                                FROM 
                                                    [dbo].[ALITB075_VENDA_VL_OL37] AS VENDAS 
                                                    LEFT JOIN [dbo].[ALITB001_Imovel_Completo] AS SIMOV ON VENDAS.[N_Concil] = SIMOV.[NU_BEM]
                                                    LEFT JOIN [dbo].[TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL] AS AGENCIA ON VENDAS.[Orig] = AGENCIA.[codigoAgencia]
                                                WHERE 
                                                    [GILIE] = 'GILIE/SP'
                                                    AND [DE_Status_SIMOV] = 'Em Contratação'
                                                    --AND [NO_VENDA_TIPO] != 'Venda Direito de Preferência - Lei 9.514'
                                                    AND [DT_Sinaf] >= DATEADD(DAY, -20, GETDATE())
                                                    AND [Valor] >= [VL_TOTAL_RECEBIDO]
                                                ORDER BY 
                                                    VENDAS.[CLASSIFICACAO]
                                                    , [NO_VENDA_TIPO]"); 

        return $relacaoContratosCaixaEmgea;
    }
}