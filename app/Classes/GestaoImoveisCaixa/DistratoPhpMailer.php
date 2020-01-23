<?php

namespace App\Classes\GestaoImoveisCaixa;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\RelacaoAgSrComEmail;
use App\Models\BaseSimov;

class DistratoPhpMailer
{
    /**
     * Store a newly created resource in storage.
     *
     */
    public static function enviarMensageria($request, $modeloMensagem)
    {
        $mail = new PHPMailer(true);
        $objRelacaoEmailUnidades = self::validaUnidadeDemandanteEmail($request);
        self::carregarDadosEmail($request, $modeloMensagem, $objRelacaoEmailUnidades, $mail);
        self::enviarEmail($mail);
    }

    public static function validaUnidadeDemandanteEmail($objDistrato) 
    {
        // if ($objDistrato->agResponsavel == null || $objDistrato->agResponsavel === "NULL") {
        //     $objRelacaoEmailUnidades = RelacaoAgSrComEmail::where('nomeAgencia', $objDistrato->srResponsavel)->first();
        //     $arrayDadosEmailUnidade = [
        //         'nomeSr' => $objRelacaoEmailUnidades->nomeSr,
        //         'emailSr' => $objRelacaoEmailUnidades->emailsr
        //     ];
        // } else {
            $objRelacaoEmailUnidades = RelacaoAgSrComEmail::where('codigoAgencia', $objDistrato->codigoAgenciaContratacao)->first();
            $arrayDadosEmailUnidade = [
                'nomeAgencia' => $objRelacaoEmailUnidades->nomeAgencia,
                'emailAgencia' => $objRelacaoEmailUnidades->emailAgencia,
                'nomeSr' => $objRelacaoEmailUnidades->nomeSr,
                'emailSr' => $objRelacaoEmailUnidades->emailsr
            ];
        // }
        return json_decode(json_encode($arrayDadosEmailUnidade), FALSE);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public static function carregarDadosEmail($request, $modeloMensagem, $objRelacaoEmailUnidades, $mail)
    {
        //Server settings
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8'; 
        $mail->isHTML(true);                                         
        $mail->Host = 'sistemas.correiolivre.caixa';  
        $mail->SMTPAuth = false;                                  
        $mail->Port = 25;
        // $mail->SMTPDebug = 2;                                         

        // DESTINATÁRIOS
        $mail->setFrom('GILIESP09@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
        $mail->addReplyTo('GILIESP01@caixa.gov.br');
        
        /* DESTINATÁRIOS PILOTO */
        // if (session()->get('codigoLotacaoAdministrativa') == '7257' || session()->get('codigoLotacaoFisica') == '7257') {
            $mail->addAddress('c111710@mail.caixa');
            $mail->addAddress('c142765@mail.caixa');
            // $mail->addAddress('c098453@mail.caixa');
        // } else {
        //     $mail->addAddress(session()->get('matricula') . '@mail.caixa');
        // }
        // $mail->addBCC('c111710@mail.caixa'); 
        // $mail->addBCC('c142765@mail.caixa');
        // $mail->addBCC('c079436@mail.caixa');
        /* FIM DESTINATÁRIOS PILOTO */

        /* DESTINATÁRIOS PRODUÇÃO */
        // if (isset($objRelacaoEmailUnidades->emailAgencia)) {
        //     $mail->addAddress($objRelacaoEmailUnidades->emailAgencia);
        //     // $mail->addCC($objRelacaoEmailUnidades->emailSr);
        // } else {
        //     $mail->addAddress($objRelacaoEmailUnidades->emailSr);
        // }
        // if ($request->emailProponente) {
        //     $mail->addCC($request->emailProponente);
        // }
        // if ($request->emailCorretor) {
        //     $mail->addCC($request->emailCorretor);
        // }
        // $mail->addBCC('GILIESP09@caixa.gov.br');
        // $mail->addBCC('c111710@mail.caixa');
        // $mail->addBCC('c142765@mail.caixa');
        // $mail->addBCC('c141203@mail.caixa');
        // $mail->addBCC('c079436@mail.caixa');
  
        // CAPTURA OS DADOS DO CONTRATO
        $dadosContrato = BaseSimov::where('BEM_FORMATADO', $request->contratoFormatado)->first();

        // VALIDA CLASSIFICAÇÃO DO IMÓVEL
        switch ($dadosContrato->CLASSIFICACAO) {
            case 'Em Cadastramento EMGEA':
            case 'EMGEA':
            case 'EMGEA - Realização de Garantia':
            case 'EMGEA- Alienação Fiduciária': 
                $classificacao = 'EMGEA';
                break;
            case 'Oriundo do Crédito Imobiliário':
            case 'Oriundos SFI-Gar. Fiduciária':
            case 'SFI - Gar.Fid.Reg.Créd.Imob':
                $classificacao = 'CAIXA';
                break;
            case 'Patrimonial':
            case 'Patrimonial - Alienação Fiduciária':
            case 'Patrimonial -Realização de Garantia':
                $classificacao = 'PATRIMONIAL';
                break;
            default:
                $classificacao = $dadosContrato->CLASSIFICACAO;
                break;
        }
        
        $mensagemAutomatica = file_get_contents(("MensagensDistrato/{$modeloMensagem}.php"), dirname(__FILE__));

        // REALIZA O REPLACE DAS VARIAVEIS COM OS DADOS DO JSON
        switch ($modeloMensagem) {
            case 'notificacaoCadastroDistrato':
                // CONVERT A STRING DATA PROPOSTA EM DATETIME E ASSIM MUDAR O FORMATO DELA
                $dataConvertida = strtotime($request->dataProposta);
                $dataProposta = date('d/m/Y', $dataConvertida);

                $mail->Subject = "Notificação de cadastro de Distrato - Imóvel $request->contratoFormatado";
                $mensagemAutomatica = str_replace("%ID_DISTRATO%", $request->idDistrato, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%NOME_PROPONENTE_DISTRATO%", $request->nomeProponente, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%NOME_AGENCIA%", $objRelacaoEmailUnidades->nomeAgencia, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%CONTRATO_BEM%", $request->contratoFormatado, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%ENDERECO_IMOVEL%", $dadosContrato->ENDERECO_IMOVEL, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%DATA_PROPOSTA%", $dataProposta, $mensagemAutomatica);
                break;
            case 'notificacaoGestorParecerAnalista':
                $mail->Subject = "Notificação de Parecer do Analista de Distrato - Imóvel $request->contratoFormatado";

                //  CRIA A VARIAVEL DE ACESSO AO PORTAL GILIE CONCATENANDO A VARIAVEL ENV, ROTA WEB E CONTRATO FORMATADO
                $urlPortalGilie = env('APP_URL') . "/estoque-imoveis/distrato/tratar/" . $request->contratoFormatado;

                $mensagemAutomatica = str_replace("%URL_PORTAL_DEMANDA_DISTRATO%", $urlPortalGilie, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%ID_DISTRATO%", $request->idDistrato, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%CONTRATO_BEM%", $request->contratoFormatado, $mensagemAutomatica);
                break;
            case 'orientacaoClienteDistratoComMulta':
                $valorMulta = $request->valorTotalProposta * 0.05;

                $mail->Subject = "Orientações ao cliente para processo de distrato - Comprador $request->nomeProponente - CHB $request->contratoFormatado";
                $mensagemAutomatica = str_replace("%ID_DISTRATO%", $request->idDistrato, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%NOME_PROPONENTE_DISTRATO%", $request->nomeProponente, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%MODALIDADE_VENDA%", $classificacao, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%NOME_AGENCIA%", $objRelacaoEmailUnidades->nomeAgencia, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%CONTRATO_BEM%", $request->contratoFormatado, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%CPF_CNPJ_PROPONENTE%", $request->cpfCnpjProponente, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%VALOR_TOTAL_PROPOSTA_DISTRATO%", $request->valorTotalProposta, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%VALOR_MULTA_DISTRATO%", $valorMulta, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%MOTIVO_DISTRATO%", $request->motivoDistrato, $mensagemAutomatica);               
                break;
            case 'orientacaoClienteDistratoSemMulta':
                $mail->Subject = "Orientações ao cliente para processo de distrato - Comprador $request->nomeProponente - CHB $request->contratoFormatado";
                $mensagemAutomatica = str_replace("%ID_DISTRATO%", $request->idDistrato, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%NOME_PROPONENTE_DISTRATO%", $request->nomeProponente, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%MODALIDADE_VENDA%", $classificacao, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%NOME_AGENCIA%", $objRelacaoEmailUnidades->nomeAgencia, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%CONTRATO_BEM%", $request->contratoFormatado, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%CPF_CNPJ_PROPONENTE%", $request->cpfCnpjProponente, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%MOTIVO_DISTRATO%", $request->motivoDistrato, $mensagemAutomatica);
                break;
            case 'pedidoAutorizacaoEmgea':
                $mail->Subject = "Solicitação de autorização de distrato - Imóvel EMGEA - Comprador $request->nomeProponente - CHB $request->contratoFormatado";
                $mensagemAutomatica = str_replace("%ID_DISTRATO%", $request->idDistrato, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%CONTRATO_BEM%", $request->contratoFormatado, $mensagemAutomatica);
                break;
            case 'solicitacaoDocumentosReembolso':
                $mail->Subject = "Solicitação de documentos para processo de distrato - Comprador $request->nomeProponente - CHB $request->contratoFormatado";
                $mensagemAutomatica = str_replace("%ID_DISTRATO%", $request->idDistrato, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%CONTRATO_BEM%", $request->contratoFormatado, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%NOME_AGENCIA%", $objRelacaoEmailUnidades->nomeAgencia, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%MODALIDADE_VENDA%", $classificacao, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%NOME_PROPONENTE_DISTRATO%", $request->nomeProponente, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%CPF_CNPJ_PROPONENTE%", $request->cpfCnpjProponente, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%MOTIVO_DISTRATO%", $request->motivoDistrato, $mensagemAutomatica);
                break;
            case 'orientacaoAgenciaDistrato':
                $mail->Subject = "Orientação para contabilização de Distrato- Comprador $request->nomeProponente - CHB $request->contratoFormatado";

                $valorMulta = $request->valorTotalProposta * 0.05;

                //  CRIA A VARIAVEL DE ACESSO AO PORTAL GILIE CONCATENANDO A VARIAVEL ENV, ROTA WEB E CONTRATO FORMATADO
                $urlPortalGilie = env('APP_URL') . "/consulta-bem-imovel/" . $request->contratoFormatado;
                
                $mensagemAutomatica = str_replace("%URL_PORTAL_DEMANDA_DISTRATO%", $urlPortalGilie, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%ID_DISTRATO%", $request->idDistrato, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%CONTRATO_BEM%", $request->contratoFormatado, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%NOME_AGENCIA%", $objRelacaoEmailUnidades->nomeAgencia, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%MODALIDADE_VENDA%", $classificacao, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%NOME_PROPONENTE_DISTRATO%", $request->nomeProponente, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%CPF_CNPJ_PROPONENTE%", $request->cpfCnpjProponente, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%MOTIVO_DISTRATO%", $request->motivoDistrato, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%VALOR_TOTAL_PROPOSTA_DISTRATO%", $request->valorTotalProposta, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%VALOR_MULTA_DISTRATO%", $valorMulta, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%TELEFONE_PROPONENTE%", $request->telefoneProponente, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%EMAIL_PROPONENTE%", $request->emailProponente, $mensagemAutomatica);
                break;
        }       
        $mail->Body = $mensagemAutomatica;
        return $mail; 
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

    public static function montaOrientacoesAgencia($objDistrato)
    {
        // CAPTURA OS DADOS DO CONTRATO PARA VER A CLASSIFICAÇÃO DO IMÓVEL
        $dadosContrato = BaseSimov::where('BEM_FORMATADO', $objDistrato->contratoFormatado)->first();

        switch ($dadosContrato->CLASSIFICACAO) {
            // PATRIMONIAL
            case 'PANAMERICANO':
            case 'Patrimonial':
            case 'Patrimonial - Alienação Fiduciária':
            case 'Patrimonial -Realização de Garantia':
                $eventoDle = '28246-4';
                $situacaoLancamentoDle = '1';
                break;
            // EMGEA
            case 'EMGEA':
            case 'EMGEA - Realização de Garantia':
            case 'EMGEA- Alienação Fiduciária':
                $eventoDle = '1295-5';
                $situacaoLancamentoDle = '2';
                break;
            // CAIXA
            case 'Oriundo do Crédito Imobiliário':
            case 'Oriundos SFI-Gar. Fiduciária':
            case 'SFI - Gar.Fid.Reg.Créd.Imob':
                $eventoDle = '1295-5';
                $situacaoLancamentoDle = '2';
                break;
        }

    }

    public static function montaComponentePorDespesaOrientacoesAgencia($objDistrato)
    {
        // CAPTURA AS DESPESAS DA DEMANDA


        // PEGA O EVENTO E A SITUAÇÃO DE LANÇAMENTO


        // MONTA O COMPONENTE HTML COM AS VARIVÁVEIS


        // CONCATENA COM OS DEMAIS COMPONENTES (SE HOUVEREM)


        // RETORNA PARA O METODO DE MONTA

    }
}