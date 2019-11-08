<?php

namespace App\Classes\GestaoImoveisCaixa;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\RelacaoAgSrComEmail;
// use App\Classes\Comex\Contratacao\MensageriasFaseConformidadeDocumental;
// use App\Classes\Comex\Contratacao\MensageriasFaseLiquidacaoOperacao;
// use App\Classes\Comex\Contratacao\MensageriasFaseVerificacaoContrato;

class ImoveisCaixaPhpMailer
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public static function enviarMensageria(Request $request, $assunto, $modeloMensagem)
    {
        $mail = new PHPMailer(true);
        $objRelacaoEmailUnidades = ContratacaoPhpMailer::validaUnidadeDemandanteEmail($request->codigoAgencia);
        ContratacaoPhpMailer::carregarDadosEmail($request, $assunto, $modeloMensagem, $objRelacaoEmailUnidades, $mail);
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
    public static function carregarDadosEmail(Request $request, $assunto, $modeloMensagem, $objRelacaoEmailUnidades, $mail)
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
  
        // REALIZA O REPLACE DAS VARIAVEIS COM OS DADOS DO JSON

        $mail->Subject = "$assunto - $numeroBem | $nomeProponente";

        $mensagemAutomatica = file_get_contents((".Mensagens/{$modeloMensagem}.php"), dirname(__FILE__));

        $mensagemAutomatica = str_replace("%CONTRATO_BEM%", $request->numeroBem, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%NOME_AGENCIA%", $request->nomeAgencia, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%NOME_PROPONENTE%", $request->nomeProponente, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%EMAIL_PROPONENTE%", $request->email_Proponente, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%NOME_CORRETOR%", $request->nomeCorretor, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%EMAIL_CORRETOR%", $request->emailCorretor, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%ENDERECO_IMOVEL%", $request->enderecoImovel, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%MO_UTILIZADO%", $request->moUtilizado, $mensagemAutomatica);

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