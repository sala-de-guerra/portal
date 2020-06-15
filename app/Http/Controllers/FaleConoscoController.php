<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AtendeGenerico;
use App\Classes\DiasUteisClass;
use App\Models\FaleConosco;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Models\HistoricoPortalGilie;
use PHPMailer\PHPMailer\PHPMailer;

class FaleConoscoController extends Controller
{
    public function AtendeGenericoIndex()
    {
        return view ('portal.gerencial.fale-conosco');
        
    }

    public function cadastrarAtendeGenericoIndex()
    {
        return view ('portal.atende.fale-conosco');
        
    }

    public function cadastrarAtividadeGenerica(Request $request)
    {

        try {
            
            $demandaGenerica = new FaleConosco();
            $demandaGenerica->Responsavel_Atendimento = $request->input('responsavelAtendimento');
            $demandaGenerica->Responsavel_Designacao  = session('matricula');
            $demandaGenerica->Nome_Atividade          = $request->input('nomeAtividade');
            $demandaGenerica->Prazo_Atendimento       = $request->input('prazoAtendimento');
            $demandaGenerica->GILIE                   = session('codigoLotacaoAdministrativa');
            $demandaGenerica->Status                   = 0;
            $demandaGenerica->save();

            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Cadastro realizado!");
            $request->session()->flash('corpoMensagem', "Fale Conosco cadastrado com sucesso.");
            return redirect("/gerencial/gerenciar-fale-conosco");

       
        } catch (\Throwable $th) {

            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Cadastro não efetuado!");
            $request->session()->flash('corpoMensagem', "Tente novamente");
            return redirect("/gerencial/gerenciar-fale-conosco");

        } 

    }

    public function listademandasgenericas()
    {
       $demandaGenerica = FaleConosco::where('Status', 0)->get();
       return json_encode($demandaGenerica);
        
    }

    public function cadastrarNovaDemandaAtendeGenerica(Request $request)
    {
        try {
            $novaDemandaAtende = new FaleConosco;
            $novaDemandaAtende->Responsavel_Atendimento = $request->input('responsavelAtendimento');
            $novaDemandaAtende->Responsavel_Designacao  = $request->input('responsavelDesignacao');
            $novaDemandaAtende->Nome_Atividade          = $request->input('nomeAtividade');
            $novaDemandaAtende->Prazo_Atendimento       = $request->input('prazoAtendimento');
            $novaDemandaAtende->GILIE                   = $request->input('gilie');
            $novaDemandaAtende->Status                  = 1; 
            $novaDemandaAtende->Assunto                 = $request->Assunto;
            $novaDemandaAtende->Descricao               = $request->Descricao;
            $novaDemandaAtende->Data_atendimento         = DiasUteisClass::contadorDiasUteis(date("Y-m-d", time()), $novaDemandaAtende->Prazo_Atendimento);
            if ($request->has('emailContatoResposta')) {
                $novaDemandaAtende->Email_contato        = $request->emailContatoResposta;
            }
            $novaDemandaAtende->save();

            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Fale Conosco Registrado!");
            $request->session()->flash('corpoMensagem', "Em breve responderemos.");

            return redirect("/fale-conosco/abrir");
         } catch (\Throwable $th) {

            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Algo deu errado!");
            $request->session()->flash('corpoMensagem', "Tente novamente");

            return redirect("/fale-conosco/abrir");
        }
    }
    public function apagarAtividadeGenerica($id)
    {
        $novaDemandaAtende = FaleConosco::find($id);
        if (isset($novaDemandaAtende)){
            $novaDemandaAtende->delete();
        }    
    return redirect("/gerencial/gerenciar-fale-conosco");  
    }

    public function editarAtividadeGenerica(Request $request, $id)
    {
        $alteraDemandaAtende = FaleConosco::find($id);

            $alteraDemandaAtende->Responsavel_Atendimento = $request->input('responsavelAtendimento');
            $alteraDemandaAtende->Nome_Atividade          = $request->input('nomeAtividade');
            $alteraDemandaAtende->Prazo_Atendimento       = $request->input('prazoAtendimento');
            $alteraDemandaAtende->save();
           
    return redirect("/gerencial/gerenciar-fale-conosco");  
    }

    public function ListaFaleConoscoGerencial()
    {
    $demandaGenerica = FaleConosco::where('Status', 1)
    ->orderBy('Data_atendimento', 'desc')
    ->get();
    return json_encode($demandaGenerica);
        
    }

        /**
     *
     * @param  int  $idAtende
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function responderFaleConosco(Request $request, $id)
    {

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->CharSet = 'UTF-8'; 
            $mail->isHTML(true);                                         
            $mail->Host = 'sistemas.correiolivre.caixa';  
            $mail->SMTPAuth = false;                                  
            $mail->Port = 25;
            // $mail->SMTPDebug = 2;
            $mail->setFrom('GILIESP09@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
            $mail->addReplyTo('GILIESP01@caixa.gov.br');
            if ($request->emailContatoResposta == 'null' ){
            $mail->addAddress(($request->Responsavel). "@mail.caixa");
            }else {
            $mail->addAddress($request->emailContatoResposta);
            }

            $mail->Subject = 'Resposta Fale Conosco';
            $mail->Body = nl2br($request->respostaFaleConosco);
            $mail->send();

            // CAPTURAR DADOS DOS DEMAIS MODELS (CASO NECESSÁRIO)
            $responderAtende = FaleConosco::find($id);;
            // EDITAR DADOS DEMANDA
            $responderAtende->Status                  = 3; 
            $responderAtende->Resposta                = $request->respostaFaleConosco;
            $responderAtende->save();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Fale Conosco respondido!");
            $request->session()->flash('corpoMensagem', "O Fale Conosco foi respondido com sucesso.");


        } catch (\Throwable $th) {

            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Algo deu errado!");
            $request->session()->flash('corpoMensagem', "Tente novamente");

            return back();
        }
        return back();
    }

    public function apagarFaleConosco(Request $request, $id)
    {
        $alteraDemandaAtende = FaleConosco::find($id);

            $alteraDemandaAtende->Resposta                = $request->respostaFaleConosco;
            $alteraDemandaAtende->Responsavel_Atendimento = session('matricula');
            $alteraDemandaAtende->Status                  = 4; 
            $alteraDemandaAtende->save();

        $request->session()->flash('corMensagem', 'success');
        $request->session()->flash('tituloMensagem', "Fale Conosco excluido!");
        $request->session()->flash('corpoMensagem', "O Fale Conosco foi excluido com sucesso.");
           
    return back();
    }

    public function listaFaleConosco()
    {

       $demandaGenerica = FaleConosco::where('Status', 1)
       ->where('Responsavel_Atendimento', session('matricula'))
       ->orderBy('Data_atendimento', 'desc')
       ->get();
       return json_encode($demandaGenerica);
        
    }

}