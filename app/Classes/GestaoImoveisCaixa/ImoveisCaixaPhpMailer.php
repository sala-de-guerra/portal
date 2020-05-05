<?php

namespace App\Classes\GestaoImoveisCaixa;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\RelacaoAgSrComEmail;

class ImoveisCaixaPhpMailer
{

    /**
     * Store a newly created resource in storage.
     *
     */
    public static function enviarMensageria($request, $assunto, $modeloMensagem)
    {
        $mail = new PHPMailer(true);
        $objRelacaoEmailUnidades = self::validaUnidadeDemandanteEmail($request);
        self::carregarDadosEmail($request, $assunto, $modeloMensagem, $objRelacaoEmailUnidades, $mail);
        self::enviarEmail($mail);
    }

    public static function validaUnidadeDemandanteEmail($objEsteiraContratacao) 
    {
        // if ($objEsteiraContratacao->agResponsavel == null || $objEsteiraContratacao->agResponsavel === "NULL") {
        //     $objRelacaoEmailUnidades = RelacaoAgSrComEmail::where('nomeAgencia', $objEsteiraContratacao->srResponsavel)->first();
        //     $arrayDadosEmailUnidade = [
        //         'nomeSr' => $objRelacaoEmailUnidades->nomeSr,
        //         'emailSr' => $objRelacaoEmailUnidades->emailsr
        //     ];
        // } else {
            $objRelacaoEmailUnidades = RelacaoAgSrComEmail::where('codigoAgencia', $objEsteiraContratacao->codigoAgencia)->first();
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
    public static function carregarDadosEmail($request, $assunto, $modeloMensagem, $objRelacaoEmailUnidades, $mail)
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
        
        switch (env('APP_ENV')) {
            case 'DESENVOLVIMENTO':
                // $mail->addAddress('c111710@mail.caixa');
                $mail->addAddress('c098453@mail.caixa');
                break;
            case 'HOMOLOGACAO':
                if (isset($objRelacaoEmailUnidades->emailAgencia)) {
                    $mail->addAddress($objRelacaoEmailUnidades->emailAgencia);
                } else {
                    $mail->addAddress($objRelacaoEmailUnidades->emailSr);
                }
                if ($request->emailProponente) {
                    $mail->addCC($request->emailProponente);
                }
                if ($request->emailCorretor) {
                    $mail->addCC($request->emailCorretor);
                }
                $mail->addBCC('GILIESP09@caixa.gov.br');
                // $mail->addBCC('c111710@mail.caixa');
                $mail->addBCC('c098453@mail.caixa');
                $mail->addBCC('c141203@mail.caixa');
                $mail->addBCC('c079436@mail.caixa');
                break;
            case 'PRODUCAO':
                if ($modeloMensagem !== 'erroNoEnvioDeMensageria') {
                    if (isset($objRelacaoEmailUnidades->emailAgencia)) {
                        $mail->addAddress($objRelacaoEmailUnidades->emailAgencia);
                        // $mail->addCC($objRelacaoEmailUnidades->emailSr);
                    } else {
                        $mail->addAddress($objRelacaoEmailUnidades->emailSr);
                    }
                    if ($request->emailProponente) {
                        $mail->addCC($request->emailProponente);
                    }
                    if ($request->emailCorretor) {
                        $mail->addCC($request->emailCorretor);
                    }
                }
                $mail->addBCC('GILIESP09@caixa.gov.br');
                // $mail->addBCC('c111710@mail.caixa');
                $mail->addBCC('c098453@mail.caixa');
                $mail->addBCC('c141203@mail.caixa');
                $mail->addBCC('c079436@mail.caixa');
                $mail->addBCC(session('matricula') . '@mail.caixa');
                break;
        }

        /* DESTINATÁRIOS PILOTO */
        // if (session()->get('codigoLotacaoAdministrativa') == '7257' || session()->get('codigoLotacaoFisica') == '7257') {
            // $mail->addAddress('c111710@mail.caixa');   
            // $mail->addAddress('c098453@mail.caixa');
        // } else {
        //     $mail->addAddress(session()->get('matricula') . '@mail.caixa');
        // }
        // $mail->addBCC('c111710@mail.caixa'); 
        // $mail->addBCC('c142765@mail.caixa');
        // $mail->addBCC('c079436@mail.caixa');
        /* FIM DESTINATÁRIOS PILOTO */

        /* DESTINATÁRIOS PRODUÇÃO */
        
  
        // REALIZA O REPLACE DAS VARIAVEIS COM OS DADOS DO JSON
        $mail->Subject = $assunto;

        $mensagemAutomatica = file_get_contents(("MensagensAutorizacaoContratacao/{$modeloMensagem}.php"), dirname(__FILE__));

        $mensagemAutomatica = str_replace("%CONTRATO_BEM%", $request->contratoBem, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%NOME_AGENCIA%", $request->nomeAgencia, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%CODIGO_AGENCIA%", $request->codigoAgencia, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%NOME_PROPONENTE%", $request->nomeProponente, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%EMAIL_PROPONENTE%", $request->emailProponente, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%NOME_CORRETOR%", $request->nomeCorretor, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%EMAIL_CORRETOR%", $request->emailCorretor, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%ENDERECO_IMOVEL%", $request->enderecoImovel, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%MO_UTILIZADO%", $request->moUtilizado, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%EDITAL_LEILAO%", $request->editalLeilao, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%MN_UTILIZADO%", $request->normativoUtilizado, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%ORIGEM_MATRICULA%", $request->origemMatricula, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%QUADRO_EMPREGADOS_POR_ATIVIDADE%", env('LINK_ATIVIDADE_POR_EMPREGADO'), $mensagemAutomatica);
        

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

}