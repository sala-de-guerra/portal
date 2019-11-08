<?php

namespace App\Classes\Sisadj;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\RelacaoAgSrComEmail;
// use App\Classes\Comex\Contratacao\MensageriasFaseConformidadeDocumental;
// use App\Classes\Comex\Contratacao\MensageriasFaseLiquidacaoOperacao;
// use App\Classes\Comex\Contratacao\MensageriasFaseVerificacaoContrato;

class BasePhpMailer
{
    protected static  $urlServidorPublico;

    public static function getUrlServidorPublico()
    {
        return static::$urlServidorPublico;
    }
    public static function setUrlServidorPublico($numeroBem)
    {
        static::$urlServidorPublico = env('SERVIDOR_PUBLICO') . $numeroBem;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public static function enviarMensageria(Request $request, $objEsteiraContratacao, $tipoEmail, $faseContratacao, $objDadosContrato = null){
        $mail = new PHPMailer(true);
        ContratacaoPhpMailer::setUrlServidorPublico($numeroBem);
        $objRelacaoEmailUnidades = ContratacaoPhpMailer::validaUnidadeDemandanteEmail($objEsteiraContratacao);
        ContratacaoPhpMailer::carregarDadosEmail($request, $objEsteiraContratacao, $objRelacaoEmailUnidades, $mail, $tipoEmail, $faseContratacao);
        ContratacaoPhpMailer::carregarConteudoEmail($objEsteiraContratacao, $objRelacaoEmailUnidades, $mail, $tipoEmail, $objDadosContrato = null);
        ContratacaoPhpMailer::enviarEmail($mail);
    }

    public static function validaUnidadeDemandanteEmail($objEsteiraContratacao) 
    {
        if ($objEsteiraContratacao->agResponsavel == null || $objEsteiraContratacao->agResponsavel === "NULL") {
            $objRelacaoEmailUnidades = RelacaoAgSrComEmail::where('nomeAgencia', $objEsteiraContratacao->srResponsavel)->first();
            $arrayDadosEmailUnidade = [
                'nomeSr' => $objRelacaoEmailUnidades->nomeSr,
                'emailSr' => $objRelacaoEmailUnidades->emailsr
            ];
        } else {
            $objRelacaoEmailUnidades = RelacaoAgSrComEmail::where('codigoAgencia', $objEsteiraContratacao->agResponsavel)->first();
            $arrayDadosEmailUnidade = [
                'nomeAgencia' => $objRelacaoEmailUnidades->nomeAgencia,
                'emailAgencia' => $objRelacaoEmailUnidades->emailAgencia,
                'nomeSr' => $objRelacaoEmailUnidades->nomeSr,
                'emailSr' => $objRelacaoEmailUnidades->emailsr
            ];
        }
        return json_decode(json_encode($arrayDadosEmailUnidade), FALSE);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public static function carregarDadosEmail(Request $request, $objEsteiraContratacao, $arrayDadosEmailUnidade, $mail, $tipoEmail, $faseContratacao)
    {
        //Server settings
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';                                          
        $mail->Host = 'sistemas.correiolivre.caixa';  
        $mail->SMTPAuth = false;                                  
        $mail->Port = 25;
        // $mail->SMTPDebug = 2;                                         

        // DESTINATÁRIOS
        $mail->setFrom('GILIESP09@mail.caixa', 'GILIESP - Rotinas Automáticas');
        $mail->addReplyTo('GILIESP@mail.caixa');
        
        /* DESTINATÁRIOS PILOTO */
        // if (session()->get('codigoLotacaoAdministrativa') == '7257' || session()->get('codigoLotacaoFisica') == '7257') {
            $mail->addAddress('c111710@mail.caixa');
        // } else {
        //     $mail->addAddress(session()->get('matricula') . '@mail.caixa');
        // }
        // $mail->addBCC('c111710@mail.caixa'); 
        // $mail->addBCC('c142765@mail.caixa');
        // $mail->addBCC('c079436@mail.caixa');
        /* FIM DESTINATÁRIOS PILOTO */

        /* DESTINATÁRIOS PRODUÇÃO */
        // if (isset($arrayDadosEmailUnidade->emailAgencia)) {
        //     $mail->addAddress($arrayDadosEmailUnidade->emailAgencia);
        //     $mail->addCC($arrayDadosEmailUnidade->emailSr);
        // } else {
        //     $mail->addAddress($arrayDadosEmailUnidade->emailSr);
        // }
        // if (session()->get('codigoLotacaoAdministrativa') == '5459' || session()->get('codigoLotacaoFisica') == '5459') {
        //     $mail->addCC($objEsteiraContratacao->responsavelAtual . '@mail.caixa');
        // } else {
        //     $mail->addCC(session()->get('matricula') . '@mail.caixa');
        // }
  
        switch ($faseContratacao) {
            case 'faseConformidadeDocumental': // DO CADASTRAMENTO ATÉ A FORMALIZAÇÃO NO SIEXC
            case 'faseConformidadeContrato': // CONFORMIDADE DO CONTRATO - FINAL DO WORKFLOW
                break;
            case 'faseLiquidacaoOperacao': // DO ENVIO DO CONTRATO ATÉ A LIQUIDAÇÃO NA CELIT
                $mail->addBCC('ceopa04@mail.caixa');
                $mail->addBCC('ceopa06@mail.caixa');
                $mail->addBCC('c084781@mail.caixa'); // Hiroko
                $mail->addBCC('c030563@mail.caixa'); // Joelice
                switch ($tipoEmail) {
                    case 'originalSemRetorno':
                    case 'alteracaoSemRetorno':
                    case 'cancelamento':
                    case 'alteracaoComRetornoProximoDiaUtil':
                    case 'originalComRetornoProximoDiaUtil':
                        break;
                    case 'originalComRetornoEmUmaHora':
                    case 'alteracaoComRetornoEmUmaHora':
                    case 'reiteracao':
                        $mail->addBCC('ceopa07@mail.caixa');
                        break;
                }
                break;
        }
        /* FIM DESTINATÁRIOS PRODUÇÃO */
        
        return $mail; 
    }

    public static function carregarConteudoEmail($objContratacaoDemanda, $arrayDadosEmailUnidade, $mail, $etapaDoProcesso, $objDadosContrato = null)
    {
        ContratacaoPhpMailer::conteudoPadraoMensageria($arrayDadosEmailUnidade, $mail);
        switch ($etapaDoProcesso) {
            // faseConformidadeDocumental
            case 'demandaCadastrada':
                return MensageriasFaseConformidadeDocumental::demandaCadastrada($objContratacaoDemanda, $arrayDadosEmailUnidade, $mail);
                break;
            case 'demandaInconforme':
                return MensageriasFaseConformidadeDocumental::demandaInconforme($objContratacaoDemanda, $arrayDadosEmailUnidade, $mail);
                break;
            // faseLiquidacaoOperacao
            case 'originalSemRetorno':
                return MensageriasFaseLiquidacaoOperacao::originalSemRetorno($objContratacaoDemanda, $arrayDadosEmailUnidade, $mail, $objDadosContrato);
                break;
            case 'originalComRetornoUmaHora':
                return MensageriasFaseLiquidacaoOperacao::originalComRetornoUmaHora($objContratacaoDemanda, $arrayDadosEmailUnidade, $mail, $objDadosContrato);
                break;
            case 'originalComRetornoProximoDiaUtil':
                return MensageriasFaseLiquidacaoOperacao::originalComRetornoProximoDiaUtil($objContratacaoDemanda, $arrayDadosEmailUnidade, $mail, $objDadosContrato);
                break;
            case 'alteracaoInferior':
                return MensageriasFaseLiquidacaoOperacao::alteracaoInferior($objContratacaoDemanda, $arrayDadosEmailUnidade, $mail, $objDadosContrato);
                break;
            case 'alteracaoSuperiorSemRetorno':
                return MensageriasFaseLiquidacaoOperacao::alteracaoSuperiorSemRetorno($objContratacaoDemanda, $arrayDadosEmailUnidade, $mail, $objDadosContrato);
                break;
            case 'alteracaoComRetornoEmUmaHora':
                return MensageriasFaseLiquidacaoOperacao::alteracaoComRetornoEmUmaHora($objContratacaoDemanda, $arrayDadosEmailUnidade, $mail, $objDadosContrato);
                break;
            case 'alteracaoComRetornoProximoDiaUtil':
                return MensageriasFaseLiquidacaoOperacao::alteracaoComRetornoProximoDiaUtil($objContratacaoDemanda, $arrayDadosEmailUnidade, $mail, $objDadosContrato);
                break;
            case 'cancelamentoInferior':
                return MensageriasFaseLiquidacaoOperacao::cancelamentoInferior($objContratacaoDemanda, $arrayDadosEmailUnidade, $mail, $objDadosContrato);
                break;
            case 'cancelamentoSuperior':
                return MensageriasFaseLiquidacaoOperacao::cancelamentoSuperior($objContratacaoDemanda, $arrayDadosEmailUnidade, $mail, $objDadosContrato);
                break;    
            case 'reiteracao':
                return MensageriasFaseLiquidacaoOperacao::reiteracao($objContratacaoDemanda, $arrayDadosEmailUnidade, $mail, $objDadosContrato);
                break;
            // faseVerificacaoContrato
            case 'contratoConforme':
                return MensageriasFaseVerificacaoContrato::contratoConforme($objContratacaoDemanda, $arrayDadosEmailUnidade, $mail, $objDadosContrato);
                break;
            case 'contratoInconforme':
                return MensageriasFaseVerificacaoContrato::contratoInconforme($objContratacaoDemanda, $arrayDadosEmailUnidade, $mail, $objDadosContrato);
                break;

        }
    }

    public static function enviarEmail($mail) 
    {
        try {
            $mail->send();
            // echo 'Mensagem enviada com sucesso';
        } catch (Exception $e) {
            // echo "Mensagem não pode ser enviada. Erro: {$mail->ErrorInfo}";
        }
    }

    public static function conteudoPadraoMensageria($arrayDadosEmailUnidade, $mail)
    {
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Body = "
            <head>
                <meta charset=\"UTF-8\">
                <style>
                    body {
                        font-family: arial,verdana,sans serif;
                    }
                    p {
                        line-height: 1.0;
                    }
                    ol {
                        counter-reset: item;
                    }
                    li {
                        display: block;
                        padding: 0 0 5px;
                    }
                    li:before {
                        content: counters(item, '.') ' ';
                        counter-increment: item
                    }
                    .referencia {
                        font-size: 15px;
                        font-weight: bold;
                    }
                      .head_msg{
                        font-weight: bold;
                        text-align: center;
                    }
                    .gray{
                        color: #808080;
                    }
                </style>
            </head>
            <p>À<br>";
            if (isset($arrayDadosEmailUnidade->nomeAgencia)) {
                $mail->Body .= "
                    AG $arrayDadosEmailUnidade->nomeAgencia<br/>
                    C/c<br>
                    SR $arrayDadosEmailUnidade->nomeSr</p>";
            } else {
                $mail->Body .= "
                SR $arrayDadosEmailUnidade->nomeSr</p>";
            }
    }
}