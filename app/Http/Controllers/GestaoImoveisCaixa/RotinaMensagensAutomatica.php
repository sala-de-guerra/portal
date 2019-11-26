<?php 

namespace App\Http\Controllers\GestaoImoveisCaixa;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Exceptions\Handler;
// use App\Http\Controllers\Comex\Contratacao\Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use App\Classes\GestaoImoveisCaixa\ImoveisCaixaPhpMailer;
use App\RelacaoAgSrComEmail;
use App\Models\GestaoImoveisCaixa\ImagemCaixaCecom;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class RotinaMensagensAutomatica extends Controller
{
    private static $existeAcaoJudicial;
    private static $propostaMaiorQueTrintaSalariosMinimos;
    private static $tipoDeProposta;
    private static $tipoDeVenda;
    private static $classificacaoImovel;
    private static $origemMatricula;

    public static function getExisteAcaoJucicial()
    {
        return self::$existeAcaoJudicial;
    }
    public static function setExisteAcaoJucicial($value)
    {
        self::$existeAcaoJudicial = $value;
        return self::$existeAcaoJudicial;
    }

    public static function getPropostaMaiorQueTrintaSalariosMinimos()
    {
        return self::$propostaMaiorQueTrintaSalariosMinimos;
    }
    public static function setPropostaMaiorQueTrintaSalariosMinimos($value)
    {
        self::$propostaMaiorQueTrintaSalariosMinimos = $value;
        return self::$propostaMaiorQueTrintaSalariosMinimos;
    }

    public static function getTipoDeProposta()
    {
        return self::$tipoDeProposta;
    }
    public static function setTipoDeProposta($value)
    {
        self::$tipoDeProposta = $value;
        return self::$tipoDeProposta;
    }

    public static function getTipoDeVenda()
    {
        return self::$tipoDeVenda;
    }
    public static function setTipoDeVenda($value)
    {
        self::$tipoDeVenda = $value;
        return self::$tipoDeVenda;
    }

    public static function getClassificacaoImovel()
    {
        return self::$classificacaoImovel;
    }
    public static function setClassificacaoImovel($value)
    {
        self::$classificacaoImovel = $value;
        return self::$classificacaoImovel;
    }

    public static function getOrigemMatricula()
    {
        return self::$origemMatricula;
    }
    public static function setOrigemMatricula($value)
    {
        self::$origemMatricula = $value;
        return self::$origemMatricula;
    }
    
    public static function enviarMensageriasAutorizacaoContratacao()
    {
        /* IMÓVEIS PATRIMONIAIS */
        $contratosPatromoniais = self::mensagemAutorizacaoImoveisPatrimoniais();
        // dd($contratosPatromoniais);
        echo "<h1>Imóvel Patrimonial</h1>";
        foreach ($contratosPatromoniais as $contratos => $contrato) {
            self::setPropostaMaiorQueTrintaSalariosMinimos($contrato->maiorQueTrintaSalariosMinimos);
            // dd($value);
            echo "Número bem: $contrato->numeroBem <br>";
            echo "Proposta CCA: $contrato->existeCca <br>";
            self::validarTipoDeVendaLeilaoOuVendaDireta($contrato);
        }
            
        /* IMOVEIS CAIXA */ 
        $contratosCaixaEmgea = self::mensagemAutorizacaoCaixaEngea(); 
        echo "<h1>Imóveis Caixa/EMGEA</h1>";
        foreach ($contratosCaixaEmgea as $contratos => $contrato) {
            if ($contrato->grupoClassificacao == 'EMGEA') {
                self::setClassificacaoImovel('EMGEA');
                if ($contrato->origemMatricula == 'Emgea') {
                    self::setOrigemMatricula('EMGEA');
                } else {
                    self::setOrigemMatricula('CAIXA');
                }
            } else {
                self::setClassificacaoImovel('CAIXA');
            }
            
            self::setPropostaMaiorQueTrintaSalariosMinimos($contrato->maiorQueTrintaSalariosMinimos);
            echo "numero Bem: $contrato->numeroBem <br>";
            echo "Proposta CCA: $contrato->existeCca <br>";
            switch ($contrato->grupoClassificacao) {
                case 'CAIXA':
                    echo "Tipo imóvel: $contrato->grupoClassificacao <br>";
                    self::validarTipoDeVendaLeilaoOuVendaDireta($contrato);
                    break;
                case 'EMGEA':
                    echo "Tipo imóvel: $contrato->grupoClassificacao <br>";
                    self::validarTipoDeVendaLeilaoOuVendaDireta($contrato);
                    break;
            }
            self::defineTipoDeMensageria($contrato);
        }
    } 

    public static function defineTipoDeMensageria($contrato)
    {
        $dadosEmail = (object) array(
            'nomeAgencia' => isset($contrato->nomeAgencia) ? $contrato->nomeAgencia : null,
            'codigoAgencia' => isset($contrato->codigoAgencia) ? $contrato->codigoAgencia : null,
            'nomeProponente' => isset($contrato->nomeProponente) ? $contrato->nomeProponente : null,
            'emailProponente' => isset($contrato->emailPropontente) ? $contrato->emailPropontente : null,
            'nomeCorretor' => isset($contrato->nomeCorretor) ? $contrato->nomeCorretor : null,
            'emailCorretor' => isset($contrato->emailCorretor) ? $contrato->emailCorretor : null,
            'contratoBem' => isset($contrato->numeroBem) ? $contrato->numeroBem : null,
            'enderecoImovel' => isset($contrato->enderecoImovel) ? $contrato->enderecoImovel : null,
            'moUtilizado' => self::definirMoDeAutorizacaoDaProposta(),
            'editalLeilao' => isset($contrato->numeroLeilao) ? $contrato->numeroLeilao : null,
        );

        if($contrato->existeCca == 'SIM') { 
            $assunto = "Autorização para contratação Imóvel $contrato->grupoClassificacao - Proponente: $contrato->nomeProponente - Correspondente Caixa Aqui";
        } else {
            $assunto = "Autorização para contratação Imóvel $contrato->grupoClassificacao - Proponente: $contrato->nomeProponente";
        }

        
    }

    public static function validarTipoDeVendaLeilaoOuVendaDireta($contrato)
    {
        switch ($contrato->tipoDeVenda) {
            // VENDAS DE LEILÃO
            case 'LEILAO':
                self::setTipoDeVenda('LEILAO');
                echo "Tipo venda: Leilão<br>";
                // VALIDAR SE A PROPOSTA DE COMPRA É A VISTA, FINANCIADA OU COM USO DE FGTS
                self::validarTipoDeVendaAvistaOuFinanciadoOuComUsoDeFgts($contrato);
                break;
            // VENDAS DIRETA OU VENDA ONLINE DIRETA
            default:
                self::setTipoDeVenda('VDO_VD');
                echo "Tipo venda: Venda Direta ou Venda Direta Online<br>";
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
            self::setTipoDeProposta('À vista');
            echo "Tipo proposta: " . self::getTipoDeProposta() . "<br>";
            self::validarExistenciaDeAcaoJudicial($contrato);
        } else {
            // VENDA FINANCIADA OU COM USO DE FGTS
            self::setTipoDeProposta('Financiado ou com uso de FGTS');
            // echo "MO utilizado: " . self::definirMoDeAutorizacaoDaProposta() . '<br>';
            echo "Tipo proposta: " . self::getTipoDeProposta() . "<hr>";
        }
    }

    public static function validarExistenciaDeAcaoJudicial($contrato)
    {
        if ($contrato->temAcaoJudial == 'NAO') {
            // SEM AÇÃO JUDICIAL
            self::setExisteAcaoJucicial('SIM');
        } else {
            // COM AÇÃO JUDICIAL
            self::setExisteAcaoJucicial('NAO');
        }
        self::defineTipoDeMensageria($contrato);
        echo "MO utilizado: " . self::definirMoDeAutorizacaoDaProposta() . '<br>';
        echo "Existe ação judicial: " . self::getExisteAcaoJucicial() . "<hr>";
    }

    public static function definirMoDeAutorizacaoDaProposta()
    {
        if (self::getOrigemMatricula() == 'EMGEA') {
            if (self::getPropostaMaiorQueTrintaSalariosMinimos() == 'SIM') {
                if (self::getTipoDeVenda() == 'LEILAO') {
                    return 'MO 19.526';
                } else {
                    if (self::getExisteAcaoJucicial() == 'SIM') {
                        return 'MO 19.467';
                    } else {
                        return 'MO 19.319';
                    }
                }
            } else {
                if (self::getExisteAcaoJucicial() == 'SIM') {
                    return 'MO 19.466';
                } else {
                    return 'MO 19.526';
                }
            }
        } else {
            if (self::getPropostaMaiorQueTrintaSalariosMinimos() == 'SIM') {
                if (self::getTipoDeVenda() == 'LEILAO') {
                    if (self::getExisteAcaoJucicial() == 'SIM') {
                        return 'MO 19.130';
                    } else {
                        return 'MO 19.208';
                    }
                } else {
                    if (self::getExisteAcaoJucicial() == 'SIM') {
                        return 'MO 19.435';
                    } else {
                        return 'MO 19.096';
                    }
                } 
            } else {
                if (self::getExisteAcaoJucicial() == 'SIM') {
                    return 'MO 19.436';
                } else {
                    return 'MO 19.227';
                }
            }
        }
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
                ,'numeroLeilao' = SIMOV.[AGRUPAMENTO]
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
                ,'codigoAgencia' = AGENCIA.[codigoAgencia]
                ,'nomeAgencia' = [AGENCIA_CONTRATACAO_PROPOSTA]
                --,'nomeSr' = [EN]
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
                ,'existeCca' = CASE	
                                    WHEN [ACEITA_CCA] = 'SIM' THEN 'SIM'
                                    ELSE 'NAO'
                                END
            FROM 
                [ALITB001_Imovel_Completo] AS SIMOV
                LEFT JOIN [TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL] AS AGENCIA ON SIMOV.[AGENCIA_CONTRATACAO_PROPOSTA] = AGENCIA.[nomeAgencia]
                --LEFT JOIN [7257_1].[dbo].[ALITB048_CUB120000] AS CUB120000 ON SIMOV.[CPF_CNPJ_PROPONENTE] = CUB120000.[CPF/CNPJ PROPONENTE]
            WHERE 
                [UNA] = 'GILIE/SP'
                AND [STATUS_IMOVEL] = 'Em contratação'
                AND ([TIPO_VENDA] LIKE 'Venda Online' OR [TIPO_VENDA] like 'Venda Direta Online' OR [TIPO_VENDA] LIKE '1º Leilão SFI' OR [TIPO_VENDA] LIKE '2º Leilão SFI')
                AND [DATA_ALTERACAO_STATUS] >=  DATEADD(DAY, -60, GETDATE())
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
                ,'grupoClassificacao' = CASE 
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
                ,'numeroLeilao' = SIMOV.[AGRUPAMENTO]
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
                ,'dataUltimoRecebimento' = [DT_Sinaf]
                ,'codigoAgencia' = [Orig]
                ,'nomeAgencia' = AGENCIA.[nomeAgencia]
                ,'cpfCnpjProponente' = SIMOV.[CPF_CNPJ_PROPONENTE]
                ,'nomeProponente' = UPPER(SIMOV.[NOME_PROPONENTE])
                ,'cpfCnpjCorretor' = SIMOV.[CPF_CORRETOR]
                ,'nomeCorretor' = UPPER(SIMOV.[NO_CORRETOR])
                ,'existeCca' = CASE	
                                    WHEN SIMOV.[ACEITA_CCA] = 'SIM' THEN 'SIM'
                                    ELSE 'NAO'
                                END
                ,'origemMatricula' = SIMOV.[ORIGEM_MATRICULA]
            FROM 
                [dbo].[ALITB075_VENDA_VL_OL37] AS VENDAS 
                LEFT JOIN [dbo].[ALITB001_Imovel_Completo] AS SIMOV ON VENDAS.[N_Concil] = SIMOV.[NU_BEM]
                LEFT JOIN [dbo].[TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL] AS AGENCIA ON VENDAS.[Orig] = AGENCIA.[codigoAgencia]
            WHERE 
                [GILIE] = 'GILIE/SP'
                AND [DE_Status_SIMOV] = 'Em Contratação'
                AND [NO_VENDA_TIPO] != 'Venda Direito de Preferência - Lei 9.514'
                AND [DT_Sinaf] >= DATEADD(DAY, -60, GETDATE())
                AND [Valor] >= [VL_TOTAL_RECEBIDO]
            ORDER BY 
                grupoClassificacao
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