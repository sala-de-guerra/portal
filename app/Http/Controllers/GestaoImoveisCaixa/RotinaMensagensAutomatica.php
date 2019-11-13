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
    public $existeAcaoJudicial;
    public $propostaMaiorQueTrintaSalariosMinimos;
    public $tipoDeVenda;
    
    public static function enviarMensageriasAutorizacaoContratacao()
    {
        /* IMÓVEIS PATRIMONIAIS */
        $contratosPatromoniais = self::mensagemAutorizacaoImoveisPatrimoniais();
        // dd($contratosPatromoniais);
        echo "<h1>Imóvel Patrimonial</h1>";
        foreach ($contratosPatromoniais as $contratos => $contrato) {
            // dd($value);
            echo "numero Bem: $contrato->numeroBem <br>";
            self::validarTipoDeVendaLeilaoOuVendaDireta($contrato);
        }
            
        /* IMOVEIS CAIXA */ 
        $contratosCaixaEmgea = self::mensagemAutorizacaoCaixaEngea(); 
        echo "<h1>Imóveis Caixa/EMGEA</h1>";
        foreach ($contratosCaixaEmgea as $contratos => $contrato) {
            echo "numero Bem: $contrato->numeroBem <br>";
            switch ($contrato->classificacao) {
                case 'CAIXA':
                    echo "Tipo Imóvel: $contrato->classificacao <br>";
                    self::validarTipoDeVendaLeilaoOuVendaDireta($contrato);
                case 'EMGEA':
                    echo "Tipo Imóvel: $contrato->classificacao <br>";
                    self::validarTipoDeVendaLeilaoOuVendaDireta($contrato);
            }
        }
    }

    public static function validarTipoDeVendaLeilaoOuVendaDireta($contrato)
    {
        switch ($contrato->tipoDeVenda) {
            // VENDAS DE LEILÃO
            case 'LEILAO':
                echo "Tipo Venda: Leilão <br>";
                // VALIDAR SE A PROPOSTA DE COMPRA É A VISTA, FINANCIADA OU COM USO DE FGTS
                self::validarTipoDeVendaAvistaOuFinanciadoOuComUsoDeFgts($contrato);
                break;
            // VENDAS DIRETA OU VENDA ONLINE DIRETA
            default:
                echo "Tipo Venda: VD ou VDO <br>";
                // VALIDAR SE A PROPOSTA DE COMPRA É A VISTA, FINANCIADA OU COM USO DE FGTS
                self::validarTipoDeVendaAvistaOuFinanciadoOuComUsoDeFgts($contrato);
                break;
            break;
        }
    }

    public static function validarTipoDeVendaAvistaOuFinanciadoOuComUsoDeFgts($contrato)
    {
        if ($contrato->tipoProposta == 'A VISTA') {
            // VENDA A VISTA
            echo "Tipo Proposta: à vista <br>";
            self::validarExistenciaDeAcaoJudicial($contrato);
        } else {
            // VENDA FINANCIADA OU COM USO DE FGTS
            echo "Tipo Proposta: financiado ou com uso de FGTS <hr>";
        }
    }

    public static function validarExistenciaDeAcaoJudicial($contrato)
    {
        if ($contrato->temAcaoJudial == 'NAO') {
            // SEM AÇÃO JUDICIAL
            $this->existeAcaoJudicial = 'NAO';
            echo "Ação Judicial: " . $this->existeAcaoJudicial . "<hr>";
        } else {
            // COM AÇÃO JUDICIAL
            $this->existeAcaoJudicial = 'SIM';
            echo "Com ação judicial <hr>";
        }
    }

    public static function definirMoDeAutorizacaoDaProposta()
    {
        
    }

    public static function mensagemAutorizacaoImoveisPatrimoniais()
    {
        $relacaoContratosPatrimoniais = DB::select("
            SELECT 
                'numeroBem' = [BEM_FORMATADO]
                ,'grupoClassificacao' = CASE 
                                            WHEN [CLASSIFICACAO] LIKE '%EMGEA%' THEN 'EMGEA'
                                            WHEN [CLASSIFICACAO] = 'PANAMERICANO' THEN 'PATRIMONIAL'
                                            WHEN [CLASSIFICACAO] = 'Patrimonial -Realização de Garantia' THEN 'PATRIMONIAL'
                                            ELSE 'CAIXA'
                                        END
                ,'tipoDeVenda' = CASE
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
                ,'temAcaoJudial' = CASE
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
                ,'maiorQueTrintaSalariosMinimos' = CASE
                                                        WHEN [VALOR_TOTAL_PROPOSTA] > (998*30) THEN 'SIM'
                                                        ELSE 'NAO'
                                                    END
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
                ,'tipoDeVenda'
                ,'tipoProposta'             
        "); 
        return (object) $relacaoContratosPatrimoniais;
    }

    public static function mensagemAutorizacaoCaixaEngea()
    {
        $relacaoContratosCaixaEmgea = DB::select("
            SELECT DISTINCT
                'numeroBem' = SIMOV.[BEM_FORMATADO]
                ,'classificacao' = CASE 
                                    WHEN VENDAS.[CLASSIFICACAO] = 'EMGEA' THEN 'EMGEA'
                                    WHEN VENDAS.[CLASSIFICACAO] = 'EMGEA- Alienação Fiduciária' THEN 'EMGEA'
                                    ELSE 'CAIXA'
                                END
                ,'tipoDeVenda' = CASE
                                    WHEN [NO_VENDA_TIPO] = '1º Leilão SFI' THEN 'LEILAO'
                                    WHEN [NO_VENDA_TIPO] = '2º Leilão SFI' THEN 'LEILAO'
                                    WHEN [NO_VENDA_TIPO] = 'Venda Direta Online' THEN 'VENDA ONLINE'
                                    WHEN [NO_VENDA_TIPO] = 'Venda Online' THEN 'VENDA ONLINE'
                                    ELSE 'OUTROS TIPOS'
                                END
                ,'enderecoImovel' = CONVERT(VARCHAR, SIMOV.[ENDERECO_IMOVEL])
                ,'dataProposta' = [DT_PROPOSTA] 
                ,'dataAlteracaoStatus' = [DT_STATUS_ALTERACAO]
                ,'valorRecursoProprioProposta' = CONVERT(DECIMAL(17, 2), [Valor])
                ,'valorFgtsProposta' = CONVERT(DECIMAL(17, 2), SIMOV.[VALOR_FGTS_PROPOSTA])
                ,'valorFinanciadoProposta' = CONVERT(DECIMAL(17, 2), SIMOV.[VALOR_FINANCIADO_PROPOSTA])
                ,'valorParceladoProposta' = CONVERT(DECIMAL(17, 2), SIMOV.[VALOR_PARCELADO_PROPOSTA])
                ,'valorTotalProposta' = CONVERT(DECIMAL(17, 2), [VALOR_TOTAL_PROPOSTA])
                ,'valorTotalContrato' = CONVERT(DECIMAL(17, 2), [VL_TOTAL_CONTRATO])
                ,'valorTotalRecebido' = CONVERT(DECIMAL(17, 2), [VL_TOTAL_RECEBIDO])
                ,'tipoProposta' = CASE
                                    WHEN [Valor] >= [VALOR_TOTAL_PROPOSTA] AND SIMOV.[VALOR_FGTS_PROPOSTA] = 0 AND SIMOV.[VALOR_FINANCIADO_PROPOSTA] = 0 THEN 'A VISTA'
                                    ELSE 'FINANCIADA OU COM FGTS'
                                END
                ,'temAcaoJudial' = CASE
                                        WHEN SIMOV.[DESCRICAO_ADIC_IMOVEL] LIKE '%JUDICIA%' THEN 'SIM'
                                        WHEN SIMOV.[DESCRICAO_ADIC_IMOVEL] LIKE '%AÇÕES%' THEN 'SIM'
                                        WHEN SIMOV.[DESCRICAO_ADIC_IMOVEL] LIKE '% AÇÃO %' THEN 'SIM'
                                        WHEN SIMOV.[DESCRICAO_ADIC_IMOVEL] LIKE '% ACAO %' THEN 'SIM'
                                        WHEN SIMOV.[DESCRICAO_ADIC_IMOVEL] LIKE '%ACOES%' THEN 'SIM'
                                        ELSE 'NAO'
                                    END
                ,'maiorQueTrintaSalariosMinimos' = CASE
                                                        WHEN [VALOR_TOTAL_PROPOSTA] > (998*30) THEN 'SIM'
                                                        ELSE 'NAO'
                                                    END
                --,'sinalPago' = CASE
                --					WHEN [Valor] >= [VL_TOTAL_RECEBIDO] THEN 'SIM'
                --					ELSE 'NAO'
                --				END
                ,'dataUltimoRecebimento' = [DT_Sinaf]
                ,'pvRecebimento' = [Orig]
                ,'nomeAgenciaContratacao' = AGENCIA.[nomeAgencia]
                ,'cpfCnpjProponente' = SIMOV.[CPF_CNPJ_PROPONENTE]
                ,'nomeProponente' = SIMOV.[NOME_PROPONENTE]
                ,'cpfCnpjCorretor' = SIMOV.[CPF_CORRETOR]
                ,'nomeCorretor' = SIMOV.[NO_CORRETOR]
                --,'vencimentoDoPp15' = CONVERT(VARCHAR(10), DATEADD(DAY, 7, [DT_PROPOSTA]), 103)
            FROM 
                [dbo].[ALITB075_VENDA_VL_OL37] AS VENDAS 
                LEFT JOIN [dbo].[ALITB001_Imovel_Completo] AS SIMOV ON VENDAS.[N_Concil] = SIMOV.[NU_BEM]
                LEFT JOIN [dbo].[TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL] AS AGENCIA ON VENDAS.[Orig] = AGENCIA.[codigoAgencia]
            WHERE 
                [GILIE] = 'GILIE/SP'
                AND [DE_Status_SIMOV] = 'Em Contratação'
                AND [NO_VENDA_TIPO] != 'Venda Direito de Preferência - Lei 9.514'
                AND [DT_Sinaf] >= DATEADD(DAY, -21, GETDATE())
                AND [Valor] >= [VL_TOTAL_RECEBIDO]
            ORDER BY 
                classificacao
                , tipoDeVenda
                , tipoProposta
        "); 

        return (object) $relacaoContratosCaixaEmgea;
    }

    public static function mensagemAutorizacaoCaixaEngeaCharles()
    {
        $relacaoContratosCaixaEmgea = DB::select("
            SELECT DISTINCT
                'numeroBem' = SIMOV.[BEM_FORMATADO]
                ,'classificacao' = CASE 
                                    WHEN VENDAS.[CLASSIFICACAO] = 'EMGEA' THEN 'EMGEA'
                                    WHEN VENDAS.[CLASSIFICACAO] = 'EMGEA- Alienação Fiduciária' THEN 'EMGEA'
                                    ELSE 'CAIXA'
                                END
                ,'tipoDeVenda' = CASE
                                    WHEN [NO_VENDA_TIPO] = '1º Leilão SFI' THEN 'LEILAO'
                                    WHEN [NO_VENDA_TIPO] = '2º Leilão SFI' THEN 'LEILAO'
                                    WHEN [NO_VENDA_TIPO] = 'Venda Direta Online' THEN 'VENDA ONLINE'
                                    WHEN [NO_VENDA_TIPO] = 'Venda Online' THEN 'VENDA ONLINE'
                                    ELSE 'OUTROS TIPOS'
                                END
                ,'enderecoImovel' = CONVERT(VARCHAR, SIMOV.[ENDERECO_IMOVEL])
                ,'dataProposta' = [DT_PROPOSTA] 
                ,'dataAlteracaoStatus' = [DT_STATUS_ALTERACAO]
                ,'valorRecursoProprioProposta' = CONVERT(DECIMAL(17, 2), [Valor])
                ,'valorFgtsProposta' = CONVERT(DECIMAL(17, 2), SIMOV.[VALOR_FGTS_PROPOSTA])
                ,'valorFinanciadoProposta' = CONVERT(DECIMAL(17, 2), SIMOV.[VALOR_FINANCIADO_PROPOSTA])
                ,'valorParceladoProposta' = CONVERT(DECIMAL(17, 2), SIMOV.[VALOR_PARCELADO_PROPOSTA])
                ,'valorTotalProposta' = CONVERT(DECIMAL(17, 2), [VL_PROPOSTA])
                ,'valorTotalContrato' = CONVERT(DECIMAL(17, 2), [VL_TOTAL_CONTRATO])
                ,'valorTotalRecebido' = CONVERT(DECIMAL(17, 2), [VL_TOTAL_RECEBIDO])
                ,'tipoProposta' = CASE
                                    WHEN [Valor] >= [VL_PROPOSTA] AND SIMOV.[VALOR_FGTS_PROPOSTA] = 0 AND SIMOV.[VALOR_FINANCIADO_PROPOSTA] = 0 THEN 'A VISTA'
                                    ELSE 'FINANCIADA OU COM FGTS'
                                END
                ,'temAcaoJudial' = CASE
                                        WHEN SIMOV.[DESCRICAO_ADIC_IMOVEL] LIKE '%JUDICIA%' THEN 'SIM'
                                        WHEN SIMOV.[DESCRICAO_ADIC_IMOVEL] LIKE '%AÇÕES%' THEN 'SIM'
                                        WHEN SIMOV.[DESCRICAO_ADIC_IMOVEL] LIKE '% AÇÃO %' THEN 'SIM'
                                        WHEN SIMOV.[DESCRICAO_ADIC_IMOVEL] LIKE '% ACAO %' THEN 'SIM'
                                        WHEN SIMOV.[DESCRICAO_ADIC_IMOVEL] LIKE '%ACOES%' THEN 'SIM'
                                        ELSE 'NAO'
                                    END
                ,'maiorQueTrintaSalariosMinimos' = CASE
                                                        WHEN [VL_PROPOSTA] > (998*30) THEN 'SIM'
                                                        ELSE 'NAO'
                                                    END
                --,'sinalPago' = CASE
                --					WHEN [Valor] >= [VL_TOTAL_RECEBIDO] THEN 'SIM'
                --					ELSE 'NAO'
                --				END
                ,'dataUltimoRecebimento' = [DT_Sinaf]
                ,'pvRecebimento' = [Orig]
                ,'nomeAgenciaContratacao' = AGENCIA.[nomeAgencia]
                ,'cpfCnpjProponente' = SIMOV.[CPF_CNPJ_PROPONENTE]
                ,'nomeProponente' = SIMOV.[NOME_PROPONENTE]
                ,'cpfCnpjCorretor' = SIMOV.[CPF_CORRETOR]
                ,'nomeCorretor' = SIMOV.[NO_CORRETOR]
                --,'vencimentoDoPp15' = CONVERT(VARCHAR(10), DATEADD(DAY, 7, [DT_PROPOSTA]), 103)
            FROM 
                [dbo].[ALITB075_VENDA_VL_OL37] AS VENDAS 
                LEFT JOIN [dbo].[ALITB001_Imovel_Completo] AS SIMOV ON VENDAS.[N_Concil] = SIMOV.[NU_BEM]
                LEFT JOIN [dbo].[TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL] AS AGENCIA ON VENDAS.[Orig] = AGENCIA.[codigoAgencia]
            WHERE 
                [GILIE] = 'GILIE/SP'
                AND [DE_Status_SIMOV] = 'Em Contratação'
                AND [NO_VENDA_TIPO] != 'Venda Direito de Preferência - Lei 9.514'
                AND [DT_Sinaf] >= DATEADD(DAY, -21, GETDATE())
                AND [Valor] >= [VL_TOTAL_RECEBIDO]
            ORDER BY 
                classificacao
                , tipoDeVenda
                , tipoProposta
        "); 

        return json_encode((object) $relacaoContratosCaixaEmgea);
    }
}