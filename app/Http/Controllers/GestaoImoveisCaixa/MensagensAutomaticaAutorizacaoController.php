<?php 

namespace App\Http\Controllers\GestaoImoveisCaixa;

use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Classes\GestaoImoveisCaixa\ImoveisCaixaPhpMailer;
use App\Models\RelacaoAgSrComEmail;
use App\Models\HistoricoPortalGilie;
use App\Models\ControleMensageria;
use App\Http\Controllers\Controller;
use App\Exceptions\Handler;
use App\Models\GestaoImoveisCaixa\ImagemCaixaCecom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class MensagensAutomaticaAutorizacaoController extends Controller
{
    private static $existeAcaoJudicial;
    private static $propostaMaiorQueTrintaSalariosMinimos;
    private static $tipoDeProposta;
    private static $tipoDeVenda;
    private static $classificacaoImovel;
    private static $origemMatricula;
    private static $manualUtilizado;

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

    public static function getManualUtilizado()
    {
        return self::$manualUtilizado;
    }
    public static function setManualUtilizado($value)
    {
        self::$manualUtilizado = $value;
        return self::$manualUtilizado;
    }
    
    public static function enviarMensageriasAutorizacaoContratacao()
    {
        /* IMÓVEIS PATRIMONIAIS */
        $contratosPatromoniais = self::listagemContratosAutorizacaoImoveisPatrimoniais();
        echo "<h1>Imóveis Patrimoniais</h1>";
        $contagemAutorizacoesPatrimonial = 0;
        foreach ($contratosPatromoniais as $contratos => $contrato) {
            self::setPropostaMaiorQueTrintaSalariosMinimos($contrato->maiorQueTrintaSalariosMinimos);
            self::setClassificacaoImovel('PATRIMONIAL');
            self::setOrigemMatricula('CAIXA');
            echo "Número bem: $contrato->numeroBem <br>";
            self::validarTipoDeVendaLeilaoOuVendaDireta($contrato);
            self::defineTipoDeMensageria($contrato);
            $contagemAutorizacoesPatrimonial++;
        }
        echo "Quantidade de e-mail enviado: $contagemAutorizacoesPatrimonial<hr>";
            
        /* IMOVEIS CAIXA E EMGEA */ 
        $contratosCaixaEmgea = self::listagemContratosAutorizacaoCaixaEngea(); 
        echo "<h1>Imóveis Caixa/EMGEA</h1>";
        $contagemAutorizacoesCaixaEmgea = 0;
        foreach ($contratosCaixaEmgea as $contratos => $contrato) {
            if ($contrato->grupoClassificacao == 'EMGEA') {
                self::setClassificacaoImovel('EMGEA');
                if ($contrato->origemMatricula == 'Emgea') {
                    self::setOrigemMatricula('EMGEA/EMGEA');
                } else {
                    self::setOrigemMatricula('EMGEA/CAIXA');
                }
            } else {
                self::setOrigemMatricula('CAIXA');
                self::setClassificacaoImovel('CAIXA');
            }
            
            self::setPropostaMaiorQueTrintaSalariosMinimos($contrato->maiorQueTrintaSalariosMinimos);
            echo "numero Bem: $contrato->numeroBem <br>";
            switch ($contrato->grupoClassificacao) {
                case 'CAIXA':
                    self::validarTipoDeVendaLeilaoOuVendaDireta($contrato);
                    break;
                case 'EMGEA':
                    self::validarTipoDeVendaLeilaoOuVendaDireta($contrato);
                    break;
            }
            self::defineTipoDeMensageria($contrato);
            $contagemAutorizacoesCaixaEmgea++;
        }
        echo "Quantidade de e-mail enviado: $contagemAutorizacoesCaixaEmgea";
    } 

    public static function defineTipoDeMensageria($contrato)
    {
        $dadosEmail = (object) array(
            'nomeAgencia' => isset($contrato->nomeAgencia) ? $contrato->nomeAgencia : null,
            'codigoAgencia' => isset($contrato->codigoAgencia) ? $contrato->codigoAgencia : null,
            'nomeProponente' => isset($contrato->nomeProponente) ? $contrato->nomeProponente : null,
            'emailProponente' => isset($contrato->emailProponente) ? $contrato->emailProponente : null,
            'nomeCorretor' => isset($contrato->nomeCorretor) ? $contrato->nomeCorretor : null,
            'emailCorretor' => isset($contrato->emailCorretor) ? $contrato->emailCorretor : null,
            'contratoBem' => isset($contrato->numeroBem) ? $contrato->numeroBem : null,
            'enderecoImovel' => isset($contrato->enderecoImovel) ? $contrato->enderecoImovel : null,
            'editalLeilao' => isset($contrato->numeroLeilao) ? $contrato->numeroLeilao : null,
            'moUtilizado' => self::definirMoDeAutorizacaoDaProposta(),
            'origemMatricula' => self::getOrigemMatricula(),
            'normativoUtilizado' => self::getManualUtilizado(),
        );

        if ($dadosEmail->codigoAgencia != null) {
            if($contrato->existeCca == 'SIM') { 
                if (self::GetTipoDeProposta() == 'À vista') {
                    if (self::getExisteAcaoJucicial() == 'SIM') {
                        $assunto = "Autorização para contratação Imóvel - Correspondente Caixa Aqui - Proponente: $contrato->nomeProponente - Tipo Imóvel: $contrato->grupoClassificacao - Com ação Judicial";
                    } else {
                        $assunto = "Autorização para contratação Imóvel - Correspondente Caixa Aqui - Proponente: $contrato->nomeProponente - Tipo Imóvel: $contrato->grupoClassificacao - Sem ação Judicial";
                    }
                } else {
                    $assunto = "Autorização para contratação Imóvel - Correspondente Caixa Aqui - Proponente: $contrato->nomeProponente - Tipo Imóvel: $contrato->grupoClassificacao";
                }                
                ImoveisCaixaPhpMailer::enviarMensageria($dadosEmail, $assunto, 'autorizacaoVendaDiretaOuVendaDiretaOnlinecomCCA');
            } else {
                if (self::getTipoDeVenda() == 'LEILAO') {
                    if (self::getTipoDeProposta() == 'À vista') {
                        if (self::getExisteAcaoJucicial() == 'SIM') {
                            $assunto = "Autorização para contratação Imóvel - Proponente: $contrato->nomeProponente - Tipo Imóvel: $contrato->grupoClassificacao - Leilão à Vista - Com ação Judicial";
                            ImoveisCaixaPhpMailer::enviarMensageria($dadosEmail, $assunto, 'autorizacaoLeilaoAvistaComAcao');
                        } else {
                            $assunto = "Autorização para contratação Imóvel - Proponente: $contrato->nomeProponente - Tipo Imóvel: $contrato->grupoClassificacao - Leilão à Vista - Sem ação Judicial";
                            ImoveisCaixaPhpMailer::enviarMensageria($dadosEmail, $assunto, 'autorizacaoLeilaoAvistaSemAcao');
                        }
                    } else {
                        $assunto = "Autorização para contratação Imóvel - Proponente: $contrato->nomeProponente - Tipo Imóvel: $contrato->grupoClassificacao - Leilão Financiado ou com uso de FGTS";
                        ImoveisCaixaPhpMailer::enviarMensageria($dadosEmail, $assunto, 'autorizacaoLeilaoFinanciadoOuComUsoDeFgts');
                    }
                } else {
                    if (self::getTipoDeProposta() == 'À vista') {
                        if (self::getExisteAcaoJucicial() == 'SIM') {
                            $assunto = "Autorização para contratação Imóvel - Proponente: $contrato->nomeProponente - Tipo Imóvel: $contrato->grupoClassificacao - Venda Direta à Vista - Com ação Judicial";
                            ImoveisCaixaPhpMailer::enviarMensageria($dadosEmail, $assunto, 'autorizacaoVendaDiretaOuVendaDiretaOnlineAvistaComAcao');
                        } else {
                            $assunto = "Autorização para contratação Imóvel - Proponente: $contrato->nomeProponente - Tipo Imóvel: $contrato->grupoClassificacao - Venda Direta à Vista - Sem ação Judicial";

                            ImoveisCaixaPhpMailer::enviarMensageria($dadosEmail, $assunto, 'autorizacaoVendaDiretaOuVendaDiretaOnlineAvistaSemAcao');
                        }
                    } else {
                        $assunto = "Autorização para contratação Imóvel - Proponente: $contrato->nomeProponente - Tipo Imóvel: $contrato->grupoClassificacao - Venda Direta Financiado ou com uso de FGTS";
                        ImoveisCaixaPhpMailer::enviarMensageria($dadosEmail, $assunto, 'autorizacaoVendaDiretaOuVendaDiretaOnlineFinanciadoOuComUsoDeFgts');
                    }
                }
            }
             
            $historico = new HistoricoPortalGilie;
            $historico->matricula = session('matricula');
            $historico->numeroContrato = $dadosEmail->contratoBem;
            $historico->tipo = "MENSAGERIA";
            $historico->atividade = "CONTRATACAO";
            $historico->observacao = "ENVIO DE MENSAGERIA - CONTRATO: $dadosEmail->contratoBem - PROPONENTE: $dadosEmail->nomeProponente";
            $historico->created_at = date("Y-m-d H:i:s", time());
            $historico->updated_at = date("Y-m-d H:i:s", time());
            $historico->save();

            $controleMensageria = new ControleMensageria;
            $controleMensageria->tipoMensagem = 'AUTORIZAÇÃO DE CONTRATAÇÃO';
            $controleMensageria->numeroContrato = $dadosEmail->contratoBem;
            $controleMensageria->codigoAgencia = $dadosEmail->codigoAgencia;
            $controleMensageria->emailCorretor = $dadosEmail->emailCorretor;
            $controleMensageria->emailProponente = $dadosEmail->emailProponente;
            $controleMensageria->created_at = date("Y-m-d H:i:s", time());
            $controleMensageria->updated_at = date("Y-m-d H:i:s", time());
            $controleMensageria->save();
        } else {
            echo "ERRO DE ENVIO DE AUTORIZAÇÃO - CONTRATO: $dadosEmail->contratoBem - PROPONENTE: $dadosEmail->nomeProponente<br>";

            $assunto = "ERRO DE ENVIO DE AUTORIZAÇÃO - CONTRATO: $dadosEmail->contratoBem - PROPONENTE: $dadosEmail->nomeProponente";
            ImoveisCaixaPhpMailer::enviarMensageria($dadosEmail, $assunto, 'erroNoEnvioDeMensageria');

            $historico = new HistoricoPortalGilie;
            $historico->matricula = session('matricula');
            $historico->numeroContrato = $dadosEmail->contratoBem;
            $historico->tipo = "ERRO MENSAGERIA";
            $historico->atividade = "CONTRATACAO";
            $historico->observacao = "ERRO DE ENVIO DE AUTORIZAÇÃO - CONTRATO: $dadosEmail->contratoBem - PROPONENTE: $dadosEmail->nomeProponente";
            $historico->created_at = date("Y-m-d H:i:s", time());
            $historico->updated_at = date("Y-m-d H:i:s", time());
            $historico->save();
        }

        $dadosEmail = '';
        self::setExisteAcaoJucicial('');
        self::setPropostaMaiorQueTrintaSalariosMinimos('');
        self::setTipoDeProposta('');
        self::setTipoDeVenda('');
        self::setClassificacaoImovel('');
        self::setOrigemMatricula('');
        self::setManualUtilizado(''); 
    }

    public static function validarTipoDeVendaLeilaoOuVendaDireta($contrato)
    {
        switch ($contrato->tipoDeVenda) {
            case 'LEILAO':
                self::setTipoDeVenda('LEILAO');
                self::validarTipoDeVendaAvistaOuFinanciadoOuComUsoDeFgts($contrato);
                break;
            default:
                self::setTipoDeVenda('VDO_VD');
                self::validarTipoDeVendaAvistaOuFinanciadoOuComUsoDeFgts($contrato);
                break;
            break;
        }
    }

    public static function validarTipoDeVendaAvistaOuFinanciadoOuComUsoDeFgts($contrato)
    {
        if ($contrato->tipoProposta == 'A VISTA') {
            self::setTipoDeProposta('À vista');
            self::validarExistenciaDeAcaoJudicial($contrato);
        } else {
            self::setTipoDeProposta('Financiado ou com uso de FGTS');
        }
    }

    public static function validarExistenciaDeAcaoJudicial($contrato)
    {
        if ($contrato->temAcaoJudicial == 'NAO') {
            self::setExisteAcaoJucicial('NAO');
        } else {
            self::setExisteAcaoJucicial('SIM');
        }
    }

    public static function definirMoDeAutorizacaoDaProposta()
    {
        if (self::getOrigemMatricula() == 'EMGEA/EMGEA') {
            if (self::getPropostaMaiorQueTrintaSalariosMinimos() == 'SIM') {
                if (self::getTipoDeVenda() == 'LEILAO') {
                    self::setManualUtilizado('MN AD227');
                    return 'MO 19.526';
                } else {
                    self::setManualUtilizado('MN AD113');
                    if (self::getExisteAcaoJucicial() == 'SIM') {                       
                        return 'MO 19.467';
                    } else {
                        return 'MO 19.319';
                    }
                }
            } else {
                if (self::getExisteAcaoJucicial() == 'SIM') {
                    self::setManualUtilizado('MN AD084');
                    return 'MO 19.466';
                } else {
                    self::setManualUtilizado('MN AD084');
                    return 'MO 19.526';
                }
            }
        } else {
            if (self::getPropostaMaiorQueTrintaSalariosMinimos() == 'SIM') {
                if (self::getTipoDeVenda() == 'LEILAO') {
                    if (self::getExisteAcaoJucicial() == 'SIM') {
                        self::setManualUtilizado('MN AD057');
                        return 'MO 19.130';
                    } else {
                        self::setManualUtilizado('MN AD057');
                        return 'MO 19.208';
                    }
                } else {
                    if (self::getExisteAcaoJucicial() == 'SIM') {
                        self::setManualUtilizado('MN AD084');
                        return 'MO 19.435';
                    } else {
                        self::setManualUtilizado('MN AD084');
                        return 'MO 19.096';
                    }
                } 
            } else {
                if (self::getExisteAcaoJucicial() == 'SIM') {
                    self::setManualUtilizado('MN AD057 e AD084');
                    return 'MO 19.436';
                } else {
                    self::setManualUtilizado('MN AD057 e AD084');
                    return 'MO 19.227';
                }
            }
        }
    }

    public static function listagemContratosAutorizacaoImoveisPatrimoniais()
    {
        $relacaoContratosPatrimoniais = DB::select("
        WITH TABELA_EMAIL_PROPONENTES AS (
            SELECT DISTINCT
                [NOME PROPONENTE]
                ,[CPF/CNPJ PROPONENTE]
                ,[E-MAIL PROPONENTE]
            FROM 
                [dbo].[ALITB048_CUB120000]
            WHERE 
                [E-MAIL PROPONENTE] IS NOT NULL
                AND [GILIE] = 'GILIE/SP'
        )
        
        SELECT DISTINCT
            'numeroBem' = [BEM_FORMATADO]
            ,'grupoClassificacao' = CASE 
                                        WHEN [CLASSIFICACAO] LIKE '%EMGEA%' THEN 'EMGEA'
                                        WHEN [CLASSIFICACAO] = 'PANAMERICANO' THEN 'PATRIMONIAL'
                                        WHEN [CLASSIFICACAO] LIKE '%Patrimonial%' THEN 'PATRIMONIAL'
                                        --WHEN [CLASSIFICACAO] = 'Patrimonial - Alienação Fiduciária' THEN 'PATRIMONIAL'
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
            ,'temAcaoJudicial' = CASE
                                    WHEN SIMOV.[DESCRICAO_ADIC_IMOVEL] LIKE '%[ ]JUDICIA%' THEN 'SIM'
                                    WHEN SIMOV.[DESCRICAO_ADIC_IMOVEL] LIKE '%[ ]AÇÕES[ ]%' THEN 'SIM'
                                    WHEN SIMOV.[DESCRICAO_ADIC_IMOVEL] LIKE '%[ ]AÇÃO[ ]%' THEN 'SIM'
                                    WHEN SIMOV.[DESCRICAO_ADIC_IMOVEL] LIKE '%[ ]ACAO[ ]%' THEN 'SIM'
                                    WHEN SIMOV.[DESCRICAO_ADIC_IMOVEL] LIKE '%[ ]ACOES[ ]%' THEN 'SIM'
                                ELSE 'NAO'
                            END
            ,'codigoAgencia' = AGENCIA.[codigoAgencia]
            ,'nomeAgencia' = [AGENCIA_CONTRATACAO_PROPOSTA]
            ,'enderecoImovel' = [ENDERECO_IMOVEL]
            ,'dataAlteracaoStatus' = [DATA_ALTERACAO_STATUS]
            ,'maiorQueTrintaSalariosMinimos' = CASE
                                                    WHEN [VALOR_TOTAL_PROPOSTA] > (998*30) THEN 'SIM'
                                                    ELSE 'NAO'
                                                END
            ,'nomeProponente' = UPPER([NOME_PROPONENTE])
            ,'emailProponente' = EMAIL_CLIENTES.[E-MAIL PROPONENTE]
            ,'cpfProponente' = [CPF_CNPJ_PROPONENTE]
            ,'nomeCorretor' = UPPER([NO_CORRETOR])
            ,'emailCorretor' = [EMAIL_CORRETOR]
            ,'existeCca' = CASE	
                                WHEN [ACEITA_CCA] = 'SIM' THEN 'SIM'
                                ELSE 'NAO'
                            END
        FROM 
            [ALITB001_Imovel_Completo] AS SIMOV
            LEFT JOIN [TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL] AS AGENCIA ON SIMOV.[AGENCIA_CONTRATACAO_PROPOSTA] = AGENCIA.[nomeAgencia]
            LEFT JOIN [TABELA_EMAIL_PROPONENTES] AS EMAIL_CLIENTES ON SIMOV.[CPF_CNPJ_PROPONENTE] = EMAIL_CLIENTES.[CPF/CNPJ PROPONENTE]
            LEFT JOIN [TBL_CONTROLE_MENSAGENS_ENVIADAS] AS CONTROLE_EMAIL ON CONTROLE_EMAIL.[numeroContrato] = SIMOV.[BEM_FORMATADO]
        WHERE 
            [UNA] = 'GILIE/SP'
            AND [STATUS_IMOVEL] = 'Em contratação'
            AND ([TIPO_VENDA] LIKE '%Venda Online%' OR [TIPO_VENDA] like '%Venda Direta Online%' OR [TIPO_VENDA] LIKE '%1º Leilão SFI%' OR [TIPO_VENDA] LIKE '%2º Leilão SFI%')
            AND [DATA_ALTERACAO_STATUS] >=  DATEADD(DAY, -60 , GETDATE())
            AND ([CLASSIFICACAO] = 'PANAMERICANO' OR [CLASSIFICACAO] LIKE '%Patrimonial%')
            AND (CONTROLE_EMAIL.[numeroContrato] IS NULL OR CONTROLE_EMAIL.[emailProponente] != EMAIL_CLIENTES.[E-MAIL PROPONENTE] AND CONTROLE_EMAIL.[emailCorretor] != SIMOV.[EMAIL_CORRETOR])
            AND SIMOV.[BEM_FORMATADO] != '01.5555.1875119-2' -- CONTRATO RELACIONADO INDEVIDAMENTE
        ORDER BY
            'grupoClassificacao'
            ,'tipoDeVenda'
            ,'tipoProposta'              
        "); 
        return (object) $relacaoContratosPatrimoniais;
    }

    public static function listagemContratosAutorizacaoCaixaEngea()
    {
        $relacaoContratosCaixaEmgea = DB::select("
        WITH TABELA_EMAIL_PROPONETES AS (
            SELECT DISTINCT
                [NOME PROPONENTE]
                ,[CPF/CNPJ PROPONENTE]
                ,[E-MAIL PROPONENTE]
            FROM 
                [dbo].[ALITB048_CUB120000]
            WHERE 
                [E-MAIL PROPONENTE] IS NOT NULL
                AND [GILIE] = 'GILIE/SP'
        )
        
        SELECT DISTINCT
            'numeroBem' = SIMOV.[BEM_FORMATADO]
            ,'grupoClassificacao' = CASE 
                                WHEN VENDAS.[CLASSIFICACAO] like '%EMGEA%' THEN 'EMGEA'
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
            ,'enderecoImovel' = SIMOV.[ENDERECO_IMOVEL]
            ,'dataProposta' = [DT_PROPOSTA] 
            ,'dataAlteracaoStatus' = [DT_STATUS_ALTERACAO]
			,'numeroBemSemFormatacao' = SIMOV.[NU_BEM]
            ,'valorRecursoProprioProposta' = CONVERT(DECIMAL(17, 2), [Valor])
            ,'valorFgtsProposta' = CONVERT(DECIMAL(17, 2), SIMOV.[VALOR_FGTS_PROPOSTA])
            ,'valorFinanciadoProposta' = CONVERT(DECIMAL(17, 2), SIMOV.[VALOR_FINANCIADO_PROPOSTA])
            ,'valorParceladoProposta' = CONVERT(DECIMAL(17, 2), SIMOV.[VALOR_PARCELADO_PROPOSTA])
            ,'valorTotalProposta' = CONVERT(DECIMAL(17, 2), [VALOR_TOTAL_PROPOSTA])
            ,'valorTotalContrato' = CONVERT(DECIMAL(17, 2), [VL_TOTAL_CONTRATO])
            ,'valorTotalRecebido' = CONVERT(DECIMAL(17, 2), [VL_TOTAL_RECEBIDO])
            ,'tipoProposta' = CASE
                                WHEN SIMOV.[VALOR_FGTS_PROPOSTA] = 0 AND SIMOV.[VALOR_FINANCIADO_PROPOSTA] = 0 THEN 'A VISTA'
                                ELSE 'FINANCIADA OU COM FGTS'
                            END
            ,'temAcaoJudicial' = CASE
                                    WHEN SIMOV.[DESCRICAO_ADIC_IMOVEL] LIKE '%[ ]JUDICIA%' THEN 'SIM'
                                    WHEN SIMOV.[DESCRICAO_ADIC_IMOVEL] LIKE '%[ ]AÇÕES[ ]%' THEN 'SIM'
                                    WHEN SIMOV.[DESCRICAO_ADIC_IMOVEL] LIKE '%[ ]AÇÃO[ ]%' THEN 'SIM'
                                    WHEN SIMOV.[DESCRICAO_ADIC_IMOVEL] LIKE '%[ ]ACAO[ ]%' THEN 'SIM'
                                    WHEN SIMOV.[DESCRICAO_ADIC_IMOVEL] LIKE '%[ ]ACOES[ ]%' THEN 'SIM'
                                    ELSE 'NAO'
                                END
            ,'maiorQueTrintaSalariosMinimos' = CASE
                                                    WHEN [VALOR_TOTAL_PROPOSTA] > (998*30) THEN 'SIM'
                                                    ELSE 'NAO'
                                                END
            ,'dataUltimoRecebimento' = [DT_Sinaf]
            ,'codigoAgencia' = AGENCIA.[codigoAgencia]
            ,'nomeAgencia' = SIMOV.[AGENCIA_CONTRATACAO_PROPOSTA]
            ,'nomeProponente' = UPPER(SIMOV.[NOME_PROPONENTE])
            ,'emailProponente' = [E-MAIL PROPONENTE]
            ,'nomeCorretor' = UPPER(SIMOV.[NO_CORRETOR])
            ,'emailCorretor' = SIMOV.[EMAIL_CORRETOR]
            ,'existeCca' = CASE	
                                WHEN SIMOV.[ACEITA_CCA] = 'SIM' THEN 'SIM'
                                ELSE 'NAO'
                            END
            ,'origemMatricula' = SIMOV.[ORIGEM_MATRICULA]
        FROM 
            [dbo].[ALITB075_VENDA_VL_OL37] AS VENDAS 
            LEFT JOIN [dbo].[ALITB001_Imovel_Completo] AS SIMOV ON VENDAS.[N_Concil] = CONVERT(VARCHAR, SIMOV.[NU_BEM])
            LEFT JOIN [dbo].[TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL] AS AGENCIA ON SIMOV.[AGENCIA_CONTRATACAO_PROPOSTA] = AGENCIA.[nomeAgencia]
            LEFT JOIN [TABELA_EMAIL_PROPONETES] AS EMAIL_CLIENTES ON SIMOV.[CPF_CNPJ_PROPONENTE] = EMAIL_CLIENTES.[CPF/CNPJ PROPONENTE]
            LEFT JOIN [TBL_CONTROLE_MENSAGENS_ENVIADAS] AS CONTROLE_EMAIL ON CONTROLE_EMAIL.numeroContrato = SIMOV.[BEM_FORMATADO]
        WHERE 
            [GILIE] = 'GILIE/SP'
            AND [DE_Status_SIMOV] = 'Em Contratação'
            AND [NO_VENDA_TIPO] != 'Venda Direito de Preferência - Lei 9.514'
            AND [DT_Sinaf] >= DATEADD(DAY, -60, GETDATE())
            AND [Valor] >= [VL_TOTAL_RECEBIDO]
			AND [NO_VENDA_TIPO] != 'Venda Direta'
			AND SIMOV.[BEM_FORMATADO] != '07.1226.0015675-9' -- CONTRATO RELACIONADO INDEVIDAMENTE
			AND SIMOV.[BEM_FORMATADO] != '08.5555.2589920-3' -- CONTRATO RELACIONADO INDEVIDAMENTE
			AND SIMOV.[BEM_FORMATADO] != '08.4444.1018599-0' -- CONTRATO RELACIONADO INDEVIDAMENTE
            AND SIMOV.[BEM_FORMATADO] != '08.0238.0064322-7' -- CONTRATO RELACIONADO INDEVIDAMENTE
            AND SIMOV.[BEM_FORMATADO] != '01.5555.1875119-2' -- CONTRATO RELACIONADO INDEVIDAMENTE
			AND (CONTROLE_EMAIL.[numeroContrato] IS NULL OR CONTROLE_EMAIL.[emailProponente] != EMAIL_CLIENTES.[E-MAIL PROPONENTE] AND CONTROLE_EMAIL.[emailCorretor] != SIMOV.[EMAIL_CORRETOR])
        ORDER BY 
            grupoClassificacao
            , tipoDeVenda
            , tipoProposta
        "); 
        return (object) $relacaoContratosCaixaEmgea;
    }

    public static function envioManualDeAutorizacaoContratacao($numeroContratoFormatado)
    {
        $relacaoContratosCaixaEmgea = DB::select("
        WITH TABELA_EMAIL_PROPONETES AS (
            SELECT DISTINCT
                [NOME PROPONENTE]
                ,[CPF/CNPJ PROPONENTE]
                ,[E-MAIL PROPONENTE]
            FROM 
                [dbo].[ALITB048_CUB120000]
            WHERE 
                [E-MAIL PROPONENTE] IS NOT NULL
                AND [GILIE] = 'GILIE/SP'
        )
        
        SELECT TOP 1 
            'numeroBem' = SIMOV.[BEM_FORMATADO]
            ,'grupoClassificacao' = CASE 
                                WHEN SIMOV.[CLASSIFICACAO] like '%EMGEA%' THEN 'EMGEA'
                                ELSE 'CAIXA'
                            END
            ,'tipoDeVenda' = CASE
                                WHEN [TIPO_VENDA] = '1º Leilão SFI' THEN 'LEILAO'
                                WHEN [TIPO_VENDA]  = '2º Leilão SFI' THEN 'LEILAO'
                                WHEN [TIPO_VENDA]  = 'Venda Direta Online' THEN 'VENDA ONLINE'
                                WHEN [TIPO_VENDA]  = 'Venda Online' THEN 'VENDA ONLINE'
                                ELSE 'OUTROS TIPOS'
                            END
            ,'numeroLeilao' = SIMOV.[AGRUPAMENTO]
            ,'enderecoImovel' = SIMOV.[ENDERECO_IMOVEL]
            ,'dataProposta' = [DATA_PROPOSTA] 
            ,'dataAlteracaoStatus' = [DATA_ALTERACAO_STATUS]
            ,'valorRecursoProprioProposta' = CONVERT(DECIMAL(17, 2), [VALOR_REC_PROPRIOS_PROPOSTA])
            ,'valorFgtsProposta' = CONVERT(DECIMAL(17, 2), SIMOV.[VALOR_FGTS_PROPOSTA])
            ,'valorFinanciadoProposta' = CONVERT(DECIMAL(17, 2), SIMOV.[VALOR_FINANCIADO_PROPOSTA])
            ,'valorParceladoProposta' = CONVERT(DECIMAL(17, 2), SIMOV.[VALOR_PARCELADO_PROPOSTA])
            ,'valorTotalProposta' = CONVERT(DECIMAL(17, 2), [VALOR_TOTAL_PROPOSTA])
            ,'valorTotalContrato' = CONVERT(DECIMAL(17, 2), [VALOR_TOTAL_CONTRATO])
            ,'valorTotalRecebido' = CONVERT(DECIMAL(17, 2), [VL_TOTAL_RECEBIDO])
            ,'tipoProposta' = CASE
                                WHEN SIMOV.[VALOR_FGTS_PROPOSTA] = 0 AND SIMOV.[VALOR_FINANCIADO_PROPOSTA] = 0 THEN 'A VISTA'
                                ELSE 'FINANCIADA OU COM FGTS'
                            END
            ,'temAcaoJudicial' = CASE
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
            ,'codigoAgencia' = AGENCIA.[codigoAgencia]
            ,'nomeAgencia' = SIMOV.[AGENCIA_CONTRATACAO_PROPOSTA]
            ,'nomeProponente' = UPPER(SIMOV.[NOME_PROPONENTE])
            ,'emailProponente' = [E-MAIL PROPONENTE]
            ,'nomeCorretor' = UPPER(SIMOV.[NO_CORRETOR])
            ,'emailCorretor' = SIMOV.[EMAIL_CORRETOR]
            ,'existeCca' = CASE	
                                WHEN SIMOV.[ACEITA_CCA] = 'SIM' THEN 'SIM'
                                ELSE 'NAO'
                            END
            ,'origemMatricula' = SIMOV.[ORIGEM_MATRICULA]
        FROM 
			[dbo].[ALITB001_Imovel_Completo] AS SIMOV
            LEFT JOIN [dbo].[ALITB075_VENDA_VL_OL37] AS VENDAS ON VENDAS.[N_Concil] = CONVERT(VARCHAR, SIMOV.[NU_BEM])
            LEFT JOIN [dbo].[TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL] AS AGENCIA ON SIMOV.[AGENCIA_CONTRATACAO_PROPOSTA] = AGENCIA.[nomeAgencia]
            LEFT JOIN [TABELA_EMAIL_PROPONETES] AS EMAIL_CLIENTES ON SIMOV.[CPF_CNPJ_PROPONENTE] = EMAIL_CLIENTES.[CPF/CNPJ PROPONENTE]
        WHERE 
            SIMOV.[BEM_FORMATADO] = '$numeroContratoFormatado'
            AND SIMOV.[STATUS_PROPOSTA]='Classificada'
        ORDER BY 
            grupoClassificacao
            , tipoDeVenda
            , tipoProposta
        "); 
        return (object) $relacaoContratosCaixaEmgea;
    }

    public static function enviarAutorizacaoContratacaoViaPortal($contratoFormatado)
    {
        try {
            $contratoParaEnviarAutorizacao = self::envioManualDeAutorizacaoContratacao($contratoFormatado); 
            foreach ($contratoParaEnviarAutorizacao as $contratos => $contrato) {
                if ($contrato->grupoClassificacao == 'EMGEA') {
                    self::setClassificacaoImovel('EMGEA');
                    if ($contrato->origemMatricula == 'Emgea') {
                        self::setOrigemMatricula('EMGEA/EMGEA');
                    } else {
                        self::setOrigemMatricula('EMGEA/CAIXA');
                    }
                } else {
                    self::setOrigemMatricula('CAIXA');
                    self::setClassificacaoImovel('CAIXA');
                }
                
                self::setPropostaMaiorQueTrintaSalariosMinimos($contrato->maiorQueTrintaSalariosMinimos);
                switch ($contrato->grupoClassificacao) {
                    case 'CAIXA':
                        // echo "Tipo imóvel: $contrato->grupoClassificacao <br>";
                        self::validarTipoDeVendaLeilaoOuVendaDireta($contrato);
                        break;
                    case 'EMGEA':
                        // echo "Tipo imóvel: $contrato->grupoClassificacao <br>";
                        self::validarTipoDeVendaLeilaoOuVendaDireta($contrato);
                        break;
                }
                self::defineTipoDeMensageria($contrato);
            }
            // RETORNA A FLASH MESSAGE
            session()->flash('corMensagem', 'success');
            session()->flash('tituloMensagem', "Autorização enviada!");
            session()->flash('corpoMensagem', "O e-mail de orientações para prosseguimento da contratação foi enviado com sucesso.");
        } catch (\Throwable $th) {
            // dd($th);
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            // RETORNA A FLASH MESSAGE
            session()->flash('corMensagem', 'warning');
            session()->flash('tituloMensagem', "Autorização não enviada!");
            session()->flash('corpoMensagem', "Aconteceu algum erro ao tentar enviar o e-mail de autorização. Tente novamente mais tarde.");
        }
        return redirect("/consulta-bem-imovel/$contratoFormatado");
    }
}