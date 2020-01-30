<?php

namespace App\Classes\GestaoImoveisCaixa;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class AvisoErroPortalPhpMailer
{

    /**
     * Store a newly created resource in storage.
     *
     */
    public static function enviarMensageria($request, $urlAcessada, $usuario)
    {
        $mail = new PHPMailer(true);
        self::carregarDadosEmail($request, $urlAcessada, $usuario, $mail);
        self::enviarEmail($mail);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public static function carregarDadosEmail($request, $urlAcessada, $usuario, $mail)
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

        switch (env('APP_ENV')) {
            case 'DESENVOLVIMENTO':
                $mail->addAddress('c111710@mail.caixa');
                $mail->addAddress('c142765@mail.caixa');
                break;
            case 'HOMOLOGACAO':
                $mail->addAddress('c111710@mail.caixa');
                $mail->addAddress('c142765@mail.caixa');
                break;
            case 'PRODUCAO':
                $mail->addAddress('c111710@mail.caixa');
                $mail->addAddress('c142765@mail.caixa');
                $mail->addAddress('c079436@mail.caixa');
                break;
        }
  
        $mail->Subject = "Falha Portal - Ambiente: " . env('APP_ENV') . " - Rota: $urlAcessada - Usuário: $usuario";       
        $mail->Body = $request;

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