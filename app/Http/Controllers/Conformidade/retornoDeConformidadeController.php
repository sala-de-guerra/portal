<?php

namespace App\Http\Controllers\Conformidade;

use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Models\HistoricoPortalGilie;
use App\Classes\Ldap;
use App\Http\Controllers\Controller;
use App\Models\GestaoImoveisCaixa\ConformidadeContratacao;
use App\Models\BaseSimov;
use Cmixin\BusinessDay;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use App\Models\Retorno\Retorno;

class retornoDeConformidadeController extends Controller
{
    public function gerarPropostaSiouvMail(Request $request, $numeroCHB)
    {
        $dadosContrato = DB::table('ALITB001_Imovel_Completo')
        ->leftjoin('TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.AGENCIA_CONTRATACAO_PROPOSTA)'), '=', DB::raw('CONVERT(VARCHAR, TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL.nomeAgencia)'))
        ->select(DB::raw("TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL.[emailAgencia],
        ALITB001_Imovel_Completo.[AGENCIA_CONTRATACAO_PROPOSTA],
        ALITB001_Imovel_Completo.[NOME_PROPONENTE],
        ALITB001_Imovel_Completo.[CPF_CNPJ_PROPONENTE],
        ALITB001_Imovel_Completo.[TIPO_VENDA],
        ALITB001_Imovel_Completo.[DATA_PROPOSTA],
        ALITB001_Imovel_Completo.[ENDERECO_IMOVEL]
        "))
        ->where('BEM_FORMATADO', $request->numeroCHB)->first();

        $mail = new PHPMailer(true);
        try {
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8'; 
        $mail->isHTML(true);                                         
        $mail->Host = 'sistemas.correiolivre.caixa';  
        $mail->SMTPAuth = false;                                  
        $mail->Port = 25;
        // $mail->SMTPDebug = 2;
        $mail->setFrom('GILIESP01@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
        $mail->addReplyTo('GILIESP01@caixa.gov.br');
        if (env('APP_ENV') == 'PRODUCAO'){
            $mail->addAddress($dadosContrato->emailAgencia);
            $mail->addCC('c098453@mail.caixa');
            $mail->addCC(session('matricula'). '@mail.caixa');
            $mail->addBCC('GILIESP09@caixa.gov.br');
        }else{
            $mail->addAddress('c098453@mail.caixa');
            // $mail->addAddress('c142639@mail.caixa');
            $mail->addCC(session('matricula'). '@mail.caixa');
        }
        
        $mail->Subject = 'Contratação de Imóvel Adjudicado – Fluxo de contratação Agência – Imóvel '. $request->numeroCHB ;
        $mensagemAutomatica = file_get_contents(("emailGerarPropostaSiopi.php"), dirname(__FILE__));
        $mensagemAutomatica = str_replace("%AGÊNCIA%", $dadosContrato->AGENCIA_CONTRATACAO_PROPOSTA, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%NUMEROIMOVEL%", $request->numeroCHB, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%NOMEPROPONENTE1%", $dadosContrato->NOME_PROPONENTE, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%CPFPROPONENTE1%", $dadosContrato->CPF_CNPJ_PROPONENTE, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%TIPODEVENDA%", $dadosContrato->TIPO_VENDA, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%DATAPROPOSTA%", Carbon::parse($dadosContrato->DATA_PROPOSTA)->format('d/m/Y'), $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%ENDERECOIMOVEL%", $dadosContrato->ENDERECO_IMOVEL, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%DATARETORNO%", Carbon::parse($request->prazoAtendimentoAgencia)->format('d/m/Y'), $mensagemAutomatica);
        $mail->Body = $mensagemAutomatica;

        $mail->send();

        $newcontent = strip_tags($mensagemAutomatica,'<br>');
        $newcontent = trim(preg_replace('/\s\s+/', ' ', $newcontent));
        $newcontent = preg_replace('#<br />(\s*<br />)+#', '<br />', $newcontent);
        $newcontent = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $newcontent);

        $historico = new HistoricoPortalGilie;
        $historico->matricula = session('matricula');
        $historico->numeroContrato = $request->numeroCHB;
        $historico->tipo = "EMAIL";
        $historico->atividade = "CONFORMIDADE";
        $historico->observacao = $newcontent;
        // dd(date("Y-m-d H:i:s", time()));
        $historico->created_at = date("Y-m-d H:i:s", time());
        $historico->updated_at = date("Y-m-d H:i:s", time());
        $historico->save();
        
        // $novoPrazo = new Retorno;
        // $novoPrazo->matriculaSolicitante = session('matricula');
        // $novoPrazo->nuBem = $request->numeroCHB;
        // $novoPrazo->dataRetorno = $request->prazoAtendimentoAgencia;
        // $novoPrazo->save();

        $novoPrazo = Retorno::updateOrCreate(
            ['nuBem' => $request->numeroCHB],
            [
                'matriculaSolicitante'         => session('matricula'),
                'dataRetorno'                 => $request->prazoAtendimentoAgencia
            ]
        );

        $request->session()->flash('corMensagem', 'success');
        $request->session()->flash('tituloMensagem', "Mensagem enviada!");
        $request->session()->flash('corpoMensagem', "Mensagem enviada com sucesso!!!.");

         }  catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Mensagem não enviada");
            $request->session()->flash('corpoMensagem', "Tente novamente mais tarde!!!!");
        }
        return back();
    }

    public function vincularPropostaMail(Request $request, $numeroCHB)
    {
        $dadosContrato = DB::table('ALITB001_Imovel_Completo')
        ->leftjoin('TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.AGENCIA_CONTRATACAO_PROPOSTA)'), '=', DB::raw('CONVERT(VARCHAR, TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL.nomeAgencia)'))
        ->select(DB::raw("TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL.[emailAgencia],
        ALITB001_Imovel_Completo.[AGENCIA_CONTRATACAO_PROPOSTA],
        ALITB001_Imovel_Completo.[NOME_PROPONENTE],
        ALITB001_Imovel_Completo.[CPF_CNPJ_PROPONENTE],
        ALITB001_Imovel_Completo.[TIPO_VENDA],
        ALITB001_Imovel_Completo.[DATA_PROPOSTA],
        ALITB001_Imovel_Completo.[ENDERECO_IMOVEL]
        "))
        ->where('BEM_FORMATADO', $request->numeroCHB)->first();

        $mail = new PHPMailer(true);
        try {
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8'; 
        $mail->isHTML(true);                                         
        $mail->Host = 'sistemas.correiolivre.caixa';  
        $mail->SMTPAuth = false;                                  
        $mail->Port = 25;
        // $mail->SMTPDebug = 2;
        $mail->setFrom('GILIESP01@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
        $mail->addReplyTo('GILIESP01@caixa.gov.br');
        if (env('APP_ENV') == 'PRODUCAO'){
            $mail->addAddress($dadosContrato->emailAgencia);
            $mail->addCC('c098453@mail.caixa');
            $mail->addCC(session('matricula'). '@mail.caixa');
            $mail->addBCC('GILIESP09@caixa.gov.br');
        }else{
            $mail->addAddress('c098453@mail.caixa');
            // $mail->addAddress('c142639@mail.caixa');
            $mail->addCC(session('matricula'). '@mail.caixa');
        }
        
        $mail->Subject = 'Contratação de Imóvel Adjudicado – Fluxo de contratação Agência – Imóvel '. $request->numeroCHB ;
        $mensagemAutomatica = file_get_contents(("emailVincularPropostaSiopi.php"), dirname(__FILE__));
        $mensagemAutomatica = str_replace("%AGÊNCIA%", $dadosContrato->AGENCIA_CONTRATACAO_PROPOSTA, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%NUMEROIMOVEL%", $request->numeroCHB, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%NOMEPROPONENTE1%", $dadosContrato->NOME_PROPONENTE, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%CPFPROPONENTE1%", $dadosContrato->CPF_CNPJ_PROPONENTE, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%TIPODEVENDA%", $dadosContrato->TIPO_VENDA, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%DATAPROPOSTA%", Carbon::parse($dadosContrato->DATA_PROPOSTA)->format('d/m/Y'), $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%ENDERECOIMOVEL%", $dadosContrato->ENDERECO_IMOVEL, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%DATARETORNO%", Carbon::parse($request->prazoAtendimentoAgencia)->format('d/m/Y'), $mensagemAutomatica);
        $mail->Body = $mensagemAutomatica;

        $mail->send();

        $newcontent = strip_tags($mensagemAutomatica,'<br>');
        $newcontent = trim(preg_replace('/\s\s+/', ' ', $newcontent));
        $newcontent = preg_replace('#<br />(\s*<br />)+#', '<br />', $newcontent);
        $newcontent = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $newcontent);

        $historico = new HistoricoPortalGilie;
        $historico->matricula = session('matricula');
        $historico->numeroContrato = $request->numeroCHB;
        $historico->tipo = "EMAIL";
        $historico->atividade = "CONFORMIDADE";
        $historico->observacao = $newcontent;
        // dd(date("Y-m-d H:i:s", time()));
        $historico->created_at = date("Y-m-d H:i:s", time());
        $historico->updated_at = date("Y-m-d H:i:s", time());
        $historico->save();

        // $novoPrazo = new Retorno;
        // $novoPrazo->matriculaSolicitante = session('matricula');
        // $novoPrazo->nuBem = $request->numeroCHB;
        // $novoPrazo->dataRetorno = $request->prazoAtendimentoAgencia;
        // $novoPrazo->save();

        $novoPrazo = Retorno::updateOrCreate(
            ['nuBem' => $request->numeroCHB],
            [
                'matriculaSolicitante'         => session('matricula'),
                'dataRetorno'                 => $request->prazoAtendimentoAgencia
            ]
        );
        
        $request->session()->flash('corMensagem', 'success');
        $request->session()->flash('tituloMensagem', "Mensagem enviada!");
        $request->session()->flash('corpoMensagem', "Mensagem enviada com sucesso!!!.");

         }  catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Mensagem não enviada");
            $request->session()->flash('corpoMensagem', "Tente novamente mais tarde!!!!");
        }
        return back();
    }

    public function efetivarAssinaturaMail(Request $request, $numeroCHB)
    {
        $dadosContrato = DB::table('ALITB001_Imovel_Completo')
        ->leftjoin('TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.AGENCIA_CONTRATACAO_PROPOSTA)'), '=', DB::raw('CONVERT(VARCHAR, TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL.nomeAgencia)'))
        ->select(DB::raw("TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL.[emailAgencia],
        ALITB001_Imovel_Completo.[AGENCIA_CONTRATACAO_PROPOSTA],
        ALITB001_Imovel_Completo.[NOME_PROPONENTE],
        ALITB001_Imovel_Completo.[CPF_CNPJ_PROPONENTE],
        ALITB001_Imovel_Completo.[TIPO_VENDA],
        ALITB001_Imovel_Completo.[DATA_PROPOSTA],
        ALITB001_Imovel_Completo.[ENDERECO_IMOVEL]
        "))
        ->where('BEM_FORMATADO', $request->numeroCHB)->first();

        $mail = new PHPMailer(true);
        try {
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8'; 
        $mail->isHTML(true);                                         
        $mail->Host = 'sistemas.correiolivre.caixa';  
        $mail->SMTPAuth = false;                                  
        $mail->Port = 25;
        // $mail->SMTPDebug = 2;
        $mail->setFrom('GILIESP01@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
        $mail->addReplyTo('GILIESP01@caixa.gov.br');
        if (env('APP_ENV') == 'PRODUCAO'){
            $mail->addAddress($dadosContrato->emailAgencia);
            $mail->addCC('c098453@mail.caixa');
            $mail->addCC(session('matricula'). '@mail.caixa');
            $mail->addBCC('GILIESP09@caixa.gov.br');
        }else{
            $mail->addAddress('c098453@mail.caixa');
            // $mail->addAddress('c142639@mail.caixa');
            $mail->addCC(session('matricula'). '@mail.caixa');
        }
        
        $mail->Subject = 'Contratação de Imóvel Adjudicado – Fluxo de contratação Agência – Imóvel '. $request->numeroCHB ;
        $mensagemAutomatica = file_get_contents(("emailEfetivarAssinatura.php"), dirname(__FILE__));
        $mensagemAutomatica = str_replace("%AGÊNCIA%", $dadosContrato->AGENCIA_CONTRATACAO_PROPOSTA, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%NUMEROIMOVEL%", $request->numeroCHB, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%NOMEPROPONENTE1%", $dadosContrato->NOME_PROPONENTE, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%CPFPROPONENTE1%", $dadosContrato->CPF_CNPJ_PROPONENTE, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%TIPODEVENDA%", $dadosContrato->TIPO_VENDA, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%DATAPROPOSTA%", Carbon::parse($dadosContrato->DATA_PROPOSTA)->format('d/m/Y'), $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%ENDERECOIMOVEL%", $dadosContrato->ENDERECO_IMOVEL, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%DATARETORNO%", Carbon::parse($request->prazoAtendimentoAgencia)->format('d/m/Y'), $mensagemAutomatica);
        $mail->Body = $mensagemAutomatica;

        $mail->send();

        $newcontent = strip_tags($mensagemAutomatica,'<br>');
        $newcontent = trim(preg_replace('/\s\s+/', ' ', $newcontent));
        $newcontent = preg_replace('#<br />(\s*<br />)+#', '<br />', $newcontent);
        $newcontent = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $newcontent);

        $historico = new HistoricoPortalGilie;
        $historico->matricula = session('matricula');
        $historico->numeroContrato = $request->numeroCHB;
        $historico->tipo = "EMAIL";
        $historico->atividade = "CONFORMIDADE";
        $historico->observacao = $newcontent;
        // dd(date("Y-m-d H:i:s", time()));
        $historico->created_at = date("Y-m-d H:i:s", time());
        $historico->updated_at = date("Y-m-d H:i:s", time());
        $historico->save();
        
        // $novoPrazo = new Retorno;
        // $novoPrazo->matriculaSolicitante = session('matricula');
        // $novoPrazo->nuBem = $request->numeroCHB;
        // $novoPrazo->dataRetorno = $request->prazoAtendimentoAgencia;
        // $novoPrazo->save();

        $novoPrazo = Retorno::updateOrCreate(
            ['nuBem' => $request->numeroCHB],
            [
                'matriculaSolicitante'         => session('matricula'),
                'dataRetorno'                 => $request->prazoAtendimentoAgencia
            ]
        );

        $request->session()->flash('corMensagem', 'success');
        $request->session()->flash('tituloMensagem', "Mensagem enviada!");
        $request->session()->flash('corpoMensagem', "Mensagem enviada com sucesso!!!.");

         }  catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Mensagem não enviada");
            $request->session()->flash('corpoMensagem', "Tente novamente mais tarde!!!!");
        }
        return back();
    }

    public function inconformeSIIACMail(Request $request, $numeroCHB)
    {
        $dadosContrato = DB::table('ALITB001_Imovel_Completo')
        ->leftjoin('TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.AGENCIA_CONTRATACAO_PROPOSTA)'), '=', DB::raw('CONVERT(VARCHAR, TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL.nomeAgencia)'))
        ->select(DB::raw("TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL.[emailAgencia],
        ALITB001_Imovel_Completo.[AGENCIA_CONTRATACAO_PROPOSTA],
        ALITB001_Imovel_Completo.[NOME_PROPONENTE],
        ALITB001_Imovel_Completo.[CPF_CNPJ_PROPONENTE],
        ALITB001_Imovel_Completo.[TIPO_VENDA],
        ALITB001_Imovel_Completo.[DATA_PROPOSTA],
        ALITB001_Imovel_Completo.[ENDERECO_IMOVEL]
        "))
        ->where('BEM_FORMATADO', $request->numeroCHB)->first();

        $mail = new PHPMailer(true);
        try {
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8'; 
        $mail->isHTML(true);                                         
        $mail->Host = 'sistemas.correiolivre.caixa';  
        $mail->SMTPAuth = false;                                  
        $mail->Port = 25;
        // $mail->SMTPDebug = 2;
        $mail->setFrom('GILIESP01@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
        $mail->addReplyTo('GILIESP01@caixa.gov.br');
        if (env('APP_ENV') == 'PRODUCAO'){
            $mail->addAddress($dadosContrato->emailAgencia);
            $mail->addCC('c098453@mail.caixa');
            $mail->addCC(session('matricula'). '@mail.caixa');
            $mail->addBCC('GILIESP09@caixa.gov.br');
        }else{
            $mail->addAddress('c098453@mail.caixa');
            // $mail->addAddress('c142639@mail.caixa');
            $mail->addCC(session('matricula'). '@mail.caixa');
        }

        if(isset($_FILES['attachment']['tmp_name']) && $_FILES['attachment']['tmp_name'] != "") {
            $mail->AddAttachment($_FILES['attachment']['tmp_name'],
            $_FILES['attachment']['name']);
          }
        
        $mail->Subject = 'Contratação de Imóvel Adjudicado – Fluxo de contratação Agência – Imóvel '. $request->numeroCHB ;
        $mensagemAutomatica = file_get_contents(("emailInconformeSiiac.php"), dirname(__FILE__));
        $mensagemAutomatica = str_replace("%AGÊNCIA%", $dadosContrato->AGENCIA_CONTRATACAO_PROPOSTA, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%NUMEROIMOVEL%", $request->numeroCHB, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%NOMEPROPONENTE1%", $dadosContrato->NOME_PROPONENTE, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%CPFPROPONENTE1%", $dadosContrato->CPF_CNPJ_PROPONENTE, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%TIPODEVENDA%", $dadosContrato->TIPO_VENDA, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%DATAPROPOSTA%", Carbon::parse($dadosContrato->DATA_PROPOSTA)->format('d/m/Y'), $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%ENDERECOIMOVEL%", $dadosContrato->ENDERECO_IMOVEL, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%DATARETORNO%", Carbon::parse($request->prazoAtendimentoAgencia)->format('d/m/Y'), $mensagemAutomatica);
        if (isset($request->obsInconformeSiiac)){
            $mensagemAutomatica = str_replace("%OBSERVAÇÕES%", " b. ". $request->obsInconformeSiiac, $mensagemAutomatica);
        }else{
            $mensagemAutomatica = str_replace("%OBSERVAÇÕES%", "", $mensagemAutomatica);
        }
        $mail->Body = $mensagemAutomatica;

        $mail->send();

        $newcontent = strip_tags($mensagemAutomatica,'<br>');
        $newcontent = trim(preg_replace('/\s\s+/', ' ', $newcontent));
        $newcontent = preg_replace('#<br />(\s*<br />)+#', '<br />', $newcontent);
        $newcontent = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $newcontent);

        $historico = new HistoricoPortalGilie;
        $historico->matricula = session('matricula');
        $historico->numeroContrato = $request->numeroCHB;
        $historico->tipo = "EMAIL";
        $historico->atividade = "CONFORMIDADE";
        $historico->observacao = $newcontent;
        // dd(date("Y-m-d H:i:s", time()));
        $historico->created_at = date("Y-m-d H:i:s", time());
        $historico->updated_at = date("Y-m-d H:i:s", time());
        $historico->save();
        
        // $novoPrazo = new Retorno;
        // $novoPrazo->matriculaSolicitante = session('matricula');
        // $novoPrazo->nuBem = $request->numeroCHB;
        // $novoPrazo->dataRetorno = $request->prazoAtendimentoAgencia;
        // $novoPrazo->save();

        $novoPrazo = Retorno::updateOrCreate(
            ['nuBem' => $request->numeroCHB],
            [
                'matriculaSolicitante'         => session('matricula'),
                'dataRetorno'                 => $request->prazoAtendimentoAgencia
            ]
        );

        $request->session()->flash('corMensagem', 'success');
        $request->session()->flash('tituloMensagem', "Mensagem enviada!");
        $request->session()->flash('corpoMensagem', "Mensagem enviada com sucesso!!!.");

         }  catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Mensagem não enviada");
            $request->session()->flash('corpoMensagem', "Tente novamente mais tarde!!!!");
        }
        return back();
    }

    public function dossieGilieMail(Request $request, $numeroCHB)
    {
        $dadosContrato = DB::table('ALITB001_Imovel_Completo')
        ->leftjoin('TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.AGENCIA_CONTRATACAO_PROPOSTA)'), '=', DB::raw('CONVERT(VARCHAR, TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL.nomeAgencia)'))
        ->select(DB::raw("TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL.[emailAgencia],
        ALITB001_Imovel_Completo.[AGENCIA_CONTRATACAO_PROPOSTA],
        ALITB001_Imovel_Completo.[NOME_PROPONENTE],
        ALITB001_Imovel_Completo.[CPF_CNPJ_PROPONENTE],
        ALITB001_Imovel_Completo.[TIPO_VENDA],
        ALITB001_Imovel_Completo.[DATA_PROPOSTA],
        ALITB001_Imovel_Completo.[ENDERECO_IMOVEL]
        "))
        ->where('BEM_FORMATADO', $request->numeroCHB)->first();

        $mail = new PHPMailer(true);
        try {
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8'; 
        $mail->isHTML(true);                                         
        $mail->Host = 'sistemas.correiolivre.caixa';  
        $mail->SMTPAuth = false;                                  
        $mail->Port = 25;
        // $mail->SMTPDebug = 2;
        $mail->setFrom('GILIESP01@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
        $mail->addReplyTo('GILIESP01@caixa.gov.br');
        if (env('APP_ENV') == 'PRODUCAO'){
            $mail->addAddress($dadosContrato->emailAgencia);
            $mail->addCC('c098453@mail.caixa');
            $mail->addCC(session('matricula'). '@mail.caixa');
            $mail->addBCC('GILIESP09@caixa.gov.br');
        }else{
            $mail->addAddress('c098453@mail.caixa');
            // $mail->addAddress('c142639@mail.caixa');
            $mail->addCC(session('matricula'). '@mail.caixa');
        }
        
        $mail->Subject = 'Contratação de Imóvel Adjudicado – Fluxo de contratação Agência – Imóvel '. $request->numeroCHB ;
        $mensagemAutomatica = file_get_contents(("emailDossieGilie.php"), dirname(__FILE__));
        $mensagemAutomatica = str_replace("%AGÊNCIA%", $dadosContrato->AGENCIA_CONTRATACAO_PROPOSTA, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%NUMEROIMOVEL%", $request->numeroCHB, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%NOMEPROPONENTE1%", $dadosContrato->NOME_PROPONENTE, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%CPFPROPONENTE1%", $dadosContrato->CPF_CNPJ_PROPONENTE, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%TIPODEVENDA%", $dadosContrato->TIPO_VENDA, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%DATAPROPOSTA%", Carbon::parse($dadosContrato->DATA_PROPOSTA)->format('d/m/Y'), $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%ENDERECOIMOVEL%", $dadosContrato->ENDERECO_IMOVEL, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%DATARETORNO%", Carbon::parse($request->prazoAtendimentoAgencia)->format('d/m/Y'), $mensagemAutomatica);

        if( $request->docIdent == 'docIdent'){
            $mensagemAutomatica = str_replace("%lista1%",  '<li>Documento de Identificação (RG/CNH/etc) <b style="color:red;"> *CO 020</b></li>', $mensagemAutomatica);
        }else{
            $mensagemAutomatica = str_replace("%lista1%", "", $mensagemAutomatica);
        }

        if( $request->compEndereco == 'compEndereco'){
            $mensagemAutomatica = str_replace("%lista2%",  '<li>Comprovante de Endereço <b style="color:red;"> *CO 020</b></li>', $mensagemAutomatica);
        }else{
            $mensagemAutomatica = str_replace("%lista2%", "", $mensagemAutomatica);
        }

        if( $request->compRenda == 'compRenda'){
            $mensagemAutomatica = str_replace("%lista3%",  '<li>Comprovante de Renda <b style="color:red;"> *CO 016</b></li>', $mensagemAutomatica);
        }else{
            $mensagemAutomatica = str_replace("%lista3%", "", $mensagemAutomatica);
        }

        if( $request->certNascCas == 'certNascCas'){
            $mensagemAutomatica = str_replace("%lista4%",  '<li>Certidão de Nascimento/Casamento </li>', $mensagemAutomatica);
        }else{
            $mensagemAutomatica = str_replace("%lista4%", "", $mensagemAutomatica);
        }

        if( $request->compPagto == 'compPagto'){
            $mensagemAutomatica = str_replace("%lista5%",  '<li>Comprovante de Pagamento de Entrada (PP15 ou boleto e respectivo comprovante)</li>', $mensagemAutomatica);
        }else{
            $mensagemAutomatica = str_replace("%lista5%", "", $mensagemAutomatica);
        }

        if( $request->impRenda == 'impRenda'){
            $mensagemAutomatica = str_replace("%lista6%",  '<li>Imposto de Renda Completo (Apenas recibo não basta) OU <b style="color:red;"> *MO29899</b></li>', $mensagemAutomatica);
        }else{
            $mensagemAutomatica = str_replace("%lista6%", "", $mensagemAutomatica);
        }

        if( $request->formEnc == 'formEnc'){
            $mensagemAutomatica = str_replace("%lista7%",  '<li>Formulário de Encaminhamento de Demanda <b style="color:red;"> *PF MO19601 PJ MO19602</b></li>', $mensagemAutomatica);
        }else{
            $mensagemAutomatica = str_replace("%lista7%", "", $mensagemAutomatica);
        }

        if( $request->propCompra == 'propCompra'){
            $mensagemAutomatica = str_replace("%lista8%",  '<li>Proposta de Compra / Termo de Arrematação <b style="color:red;"> *MO19570</b></li>', $mensagemAutomatica);
        }else{
            $mensagemAutomatica = str_replace("%lista8%", "", $mensagemAutomatica);
        }

        if( $request->termoDir == 'termoDir'){
            $mensagemAutomatica = str_replace("%lista9%",  '<li>Termo de Aquisição por Exercício de Direito de Preferência <b style="color:red;"> *MO28097</b></li>', $mensagemAutomatica);
        }else{
            $mensagemAutomatica = str_replace("%lista9%", "", $mensagemAutomatica);
        }

        if( $request->declNeg == 'declNeg'){
            $mensagemAutomatica = str_replace("%lista10%",  '<li>Declaração Negativa de Propriedade do Imóvel <b style="color:red;"> *MO29898</b></li>', $mensagemAutomatica);
        }else{
            $mensagemAutomatica = str_replace("%lista10%", "", $mensagemAutomatica);
        }

        if( $request->certIptu == 'certIptu'){
            $mensagemAutomatica = str_replace("%lista11%",  '<li>Certidão de IPTU na prefeitura demonstrando endereço atualizado</li>', $mensagemAutomatica);
        }else{
            $mensagemAutomatica = str_replace("%lista11%", "", $mensagemAutomatica);
        }

        if( $request->matrImov == 'matrImov'){
            $mensagemAutomatica = str_replace("%lista12%",  '<li>Matrícula do Imóvel - verificar se ao mandar é possível "puxar" matrícula e cartório</li>', $mensagemAutomatica);
        }else{
            $mensagemAutomatica = str_replace("%lista12%", "", $mensagemAutomatica);
        }



        $mail->Body = $mensagemAutomatica;

        $mail->send();

        $newcontent = strip_tags($mensagemAutomatica,'<br>');
        $newcontent = trim(preg_replace('/\s\s+/', ' ', $newcontent));
        $newcontent = preg_replace('#<br />(\s*<br />)+#', '<br />', $newcontent);
        $newcontent = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $newcontent);

        $historico = new HistoricoPortalGilie;
        $historico->matricula = session('matricula');
        $historico->numeroContrato = $request->numeroCHB;
        $historico->tipo = "EMAIL";
        $historico->atividade = "CONFORMIDADE";
        $historico->observacao = $newcontent;
        // dd(date("Y-m-d H:i:s", time()));
        $historico->created_at = date("Y-m-d H:i:s", time());
        $historico->updated_at = date("Y-m-d H:i:s", time());
        $historico->save();
        
        // $novoPrazo = new Retorno;
        // $novoPrazo->matriculaSolicitante = session('matricula');
        // $novoPrazo->nuBem = $request->numeroCHB;
        // $novoPrazo->dataRetorno = $request->prazoAtendimentoAgencia;
        // $novoPrazo->save();

        $novoPrazo = Retorno::updateOrCreate(
            ['nuBem' => $request->numeroCHB],
            [
                'matriculaSolicitante'         => session('matricula'),
                'dataRetorno'                 => $request->prazoAtendimentoAgencia
            ]
        );

        $request->session()->flash('corMensagem', 'success');
        $request->session()->flash('tituloMensagem', "Mensagem enviada!");
        $request->session()->flash('corpoMensagem', "Mensagem enviada com sucesso!!!.");

         }  catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Mensagem não enviada");
            $request->session()->flash('corpoMensagem', "Tente novamente mais tarde!!!!");
        }
        return back();
    }

    public function dossieAgenciaMail(Request $request, $numeroCHB)
    {
        $dadosContrato = DB::table('ALITB001_Imovel_Completo')
        ->leftjoin('TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.AGENCIA_CONTRATACAO_PROPOSTA)'), '=', DB::raw('CONVERT(VARCHAR, TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL.nomeAgencia)'))
        ->select(DB::raw("TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL.[emailAgencia],
        ALITB001_Imovel_Completo.[AGENCIA_CONTRATACAO_PROPOSTA],
        ALITB001_Imovel_Completo.[NOME_PROPONENTE],
        ALITB001_Imovel_Completo.[CPF_CNPJ_PROPONENTE],
        ALITB001_Imovel_Completo.[TIPO_VENDA],
        ALITB001_Imovel_Completo.[DATA_PROPOSTA],
        ALITB001_Imovel_Completo.[ENDERECO_IMOVEL]
        "))
        ->where('BEM_FORMATADO', $request->numeroCHB)->first();

        $mail = new PHPMailer(true);
        try {
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8'; 
        $mail->isHTML(true);                                         
        $mail->Host = 'sistemas.correiolivre.caixa';  
        $mail->SMTPAuth = false;                                  
        $mail->Port = 25;
        // $mail->SMTPDebug = 2;
        $mail->setFrom('GILIESP01@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
        $mail->addReplyTo('GILIESP01@caixa.gov.br');
        if (env('APP_ENV') == 'PRODUCAO'){
            $mail->addAddress($dadosContrato->emailAgencia);
            $mail->addCC('c098453@mail.caixa');
            $mail->addCC(session('matricula'). '@mail.caixa');
            $mail->addBCC('GILIESP09@caixa.gov.br');
        }else{
            $mail->addAddress('c098453@mail.caixa');
            // $mail->addAddress('c142639@mail.caixa');
            $mail->addCC(session('matricula'). '@mail.caixa');
        }
        
        $mail->Subject = 'Contratação de Imóvel Adjudicado – Fluxo de contratação Agência – Imóvel '. $request->numeroCHB ;
        $mensagemAutomatica = file_get_contents(("emailDossieAgencia.php"), dirname(__FILE__));
        $mensagemAutomatica = str_replace("%AGÊNCIA%", $dadosContrato->AGENCIA_CONTRATACAO_PROPOSTA, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%NUMEROIMOVEL%", $request->numeroCHB, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%NOMEPROPONENTE1%", $dadosContrato->NOME_PROPONENTE, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%CPFPROPONENTE1%", $dadosContrato->CPF_CNPJ_PROPONENTE, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%TIPODEVENDA%", $dadosContrato->TIPO_VENDA, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%DATAPROPOSTA%", Carbon::parse($dadosContrato->DATA_PROPOSTA)->format('d/m/Y'), $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%ENDERECOIMOVEL%", $dadosContrato->ENDERECO_IMOVEL, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%DATARETORNO%", Carbon::parse($request->prazoAtendimentoAgencia)->format('d/m/Y'), $mensagemAutomatica);

        $mail->Body = $mensagemAutomatica;

        $mail->send();

        $newcontent = strip_tags($mensagemAutomatica,'<br>');
        $newcontent = trim(preg_replace('/\s\s+/', ' ', $newcontent));
        $newcontent = preg_replace('#<br />(\s*<br />)+#', '<br />', $newcontent);
        $newcontent = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $newcontent);

        $historico = new HistoricoPortalGilie;
        $historico->matricula = session('matricula');
        $historico->numeroContrato = $request->numeroCHB;
        $historico->tipo = "EMAIL";
        $historico->atividade = "CONFORMIDADE";
        $historico->observacao = $newcontent;
        // dd(date("Y-m-d H:i:s", time()));
        $historico->created_at = date("Y-m-d H:i:s", time());
        $historico->updated_at = date("Y-m-d H:i:s", time());
        $historico->save();
        
        // $novoPrazo = new Retorno;
        // $novoPrazo->matriculaSolicitante = session('matricula');
        // $novoPrazo->nuBem = $request->numeroCHB;
        // $novoPrazo->dataRetorno = $request->prazoAtendimentoAgencia;
        // $novoPrazo->save();

        $novoPrazo = Retorno::updateOrCreate(
            ['nuBem' => $request->numeroCHB],
            [
                'matriculaSolicitante'         => session('matricula'),
                'dataRetorno'                 => $request->prazoAtendimentoAgencia
            ]
        );

        $request->session()->flash('corMensagem', 'success');
        $request->session()->flash('tituloMensagem', "Mensagem enviada!");
        $request->session()->flash('corpoMensagem', "Mensagem enviada com sucesso!!!.");

         }  catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Mensagem não enviada");
            $request->session()->flash('corpoMensagem', "Tente novamente mais tarde!!!!");
        }
        return back();
    }

    public function gerarOutrosMail(Request $request, $numeroCHB)
    {
        $dadosContrato = DB::table('ALITB001_Imovel_Completo')
        ->leftjoin('TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.AGENCIA_CONTRATACAO_PROPOSTA)'), '=', DB::raw('CONVERT(VARCHAR, TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL.nomeAgencia)'))
        ->select(DB::raw("TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL.[emailAgencia],
        ALITB001_Imovel_Completo.[AGENCIA_CONTRATACAO_PROPOSTA],
        ALITB001_Imovel_Completo.[NOME_PROPONENTE],
        ALITB001_Imovel_Completo.[CPF_CNPJ_PROPONENTE],
        ALITB001_Imovel_Completo.[TIPO_VENDA],
        ALITB001_Imovel_Completo.[DATA_PROPOSTA],
        ALITB001_Imovel_Completo.[ENDERECO_IMOVEL]
        "))
        ->where('BEM_FORMATADO', $request->numeroCHB)->first();

        $mail = new PHPMailer(true);
        try {
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8'; 
        $mail->isHTML(true);                                         
        $mail->Host = 'sistemas.correiolivre.caixa';  
        $mail->SMTPAuth = false;                                  
        $mail->Port = 25;
        // $mail->SMTPDebug = 2;
        $mail->setFrom('GILIESP01@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
        $mail->addReplyTo('GILIESP01@caixa.gov.br');
        if (env('APP_ENV') == 'PRODUCAO'){
            $mail->addAddress($dadosContrato->emailAgencia);
            $mail->addCC('c098453@mail.caixa');
            $mail->addCC(session('matricula'). '@mail.caixa');
            $mail->addBCC('GILIESP09@caixa.gov.br');
        }else{
            $mail->addAddress('c098453@mail.caixa');
            // $mail->addAddress('c142639@mail.caixa');
            $mail->addCC(session('matricula'). '@mail.caixa');
        }

        if(isset($_FILES['attachment']['tmp_name']) && $_FILES['attachment']['tmp_name'] != "") {
            $mail->AddAttachment($_FILES['attachment']['tmp_name'],
            $_FILES['attachment']['name']);
          }
        
        $mail->Subject = 'Contratação de Imóvel Adjudicado – Fluxo de contratação Agência – Imóvel '. $request->numeroCHB ;
        $mensagemAutomatica = file_get_contents(("emailOutros.php"), dirname(__FILE__));
        $mensagemAutomatica = str_replace("%AGÊNCIA%", $dadosContrato->AGENCIA_CONTRATACAO_PROPOSTA, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%NUMEROIMOVEL%", $request->numeroCHB, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%NOMEPROPONENTE1%", $dadosContrato->NOME_PROPONENTE, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%CPFPROPONENTE1%", $dadosContrato->CPF_CNPJ_PROPONENTE, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%TIPODEVENDA%", $dadosContrato->TIPO_VENDA, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%DATAPROPOSTA%", Carbon::parse($dadosContrato->DATA_PROPOSTA)->format('d/m/Y'), $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%ENDERECOIMOVEL%", $dadosContrato->ENDERECO_IMOVEL, $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%DATARETORNO%", Carbon::parse($request->prazoAtendimentoAgencia)->format('d/m/Y'), $mensagemAutomatica);
        $mensagemAutomatica = str_replace("%OBSERVAÇÕES%", $request->textoEmail, $mensagemAutomatica);
        $mail->Body = $mensagemAutomatica;

        $mail->send();

        $newcontent = strip_tags($mensagemAutomatica,'<br>');
        $newcontent = trim(preg_replace('/\s\s+/', ' ', $newcontent));
        $newcontent = preg_replace('#<br />(\s*<br />)+#', '<br />', $newcontent);
        $newcontent = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $newcontent);

        $historico = new HistoricoPortalGilie;
        $historico->matricula = session('matricula');
        $historico->numeroContrato = $request->numeroCHB;
        $historico->tipo = "EMAIL";
        $historico->atividade = "CONFORMIDADE";
        $historico->observacao = $newcontent;
        // dd(date("Y-m-d H:i:s", time()));
        $historico->created_at = date("Y-m-d H:i:s", time());
        $historico->updated_at = date("Y-m-d H:i:s", time());
        $historico->save();
        
        // $novoPrazo = new Retorno;
        // $novoPrazo->matriculaSolicitante = session('matricula');
        // $novoPrazo->nuBem = $request->numeroCHB;
        // $novoPrazo->dataRetorno = $request->prazoAtendimentoAgencia;
        // $novoPrazo->save();

        $novoPrazo = Retorno::updateOrCreate(
            ['nuBem' => $request->numeroCHB],
            [
                'matriculaSolicitante'         => session('matricula'),
                'dataRetorno'                 => $request->prazoAtendimentoAgencia
            ]
        );

        $request->session()->flash('corMensagem', 'success');
        $request->session()->flash('tituloMensagem', "Mensagem enviada!");
        $request->session()->flash('corpoMensagem', "Mensagem enviada com sucesso!!!.");

         }  catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Mensagem não enviada");
            $request->session()->flash('corpoMensagem', "Tente novamente mais tarde!!!!");
        }
        return back();
    }

}
