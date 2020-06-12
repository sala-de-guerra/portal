<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AtendeGenerico;
use App\Classes\DiasUteisClass;
use App\Models\atende;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Models\HistoricoPortalGilie;

class atendeGenericoController extends Controller
{
    public function AtendeGenericoIndex()
    {
        return view ('portal.gerencial.atividades-genericas');
        
    }

    public function cadastrarAtendeGenericoIndex()
    {
        return view ('portal.atende.abrir-demanda');
        
    }

    public function cadastrarAtividadeGenerica(Request $request)
    {
        $demandaGenerica = new AtendeGenerico();
        $demandaGenerica->Responsavel_Atendimento = $request->input('responsavelAtendimento');
        $demandaGenerica->Responsavel_Designacao  = session('matricula');
        $demandaGenerica->Nome_Atividade          = $request->input('nomeAtividadeGenerica');
        $demandaGenerica->Prazo_Atendimento       = $request->input('prazoAtendimento');
        $demandaGenerica->save();
        return redirect("/gerencial/gerenciar-demanda-generica");
    }

    public function listademandasgenericas()
    {
       $demandaGenerica = AtendeGenerico::all();
       return json_encode($demandaGenerica);
        
    }

    public function cadastrarNovaDemandaAtendeGenerica(Request $request)
    {
        // try {
        //     DB::beginTransaction();
            // CAPTURAR DADOS DOS DEMAIS MODELS (CASO NECESSÁRIO)
            // $dadosSimov = BaseSimov::where('BEM_FORMATADO', $request->contratoFormatado)->first();
            // $dadosAtividade = GestaoEquipesAtividades::find($request->idAtividade);

            // CRIAR A DEMANDA
            $novaDemandaAtende = new Atende;
            $novaDemandaAtende->contratoFormatado               = '9999999999';
            $novaDemandaAtende->codigoUnidade                   = '7257';
            $novaDemandaAtende->idEquipe                        = $request->idEquipe;
            $novaDemandaAtende->idAtividade                     = $request->idAtividade;
            $novaDemandaAtende->numeroContrato                  = '9999999999';
            $novaDemandaAtende->assuntoAtende                   = $request->assuntoAtende;
            $novaDemandaAtende->descricaoAtende                 = $request->descricaoAtende;
            $novaDemandaAtende->statusAtende                    = 'CADASTRADO';
            $novaDemandaAtende->matriculaCriadorDemanda         = session('matricula');
            $novaDemandaAtende->prazoAtendimentoAtende          = DiasUteisClass::contadorDiasUteis(date("Y-m-d", time()), $novaDemandaAtende->prazoAtendimento);
            $novaDemandaAtende->matriculaResponsavelAtividade   = $request->responsavelAtividade;
            $novaDemandaAtende->dataCadastro                    = date("Y-m-d H:i:s", time());
            $novaDemandaAtende->dataAlteracao                   = date("Y-m-d H:i:s", time());
            if ($request->has('emailContatoResposta')) {
                $novaDemandaAtende->emailContatoResposta        = $request->emailContatoResposta;
            }
            if ($request->has('emailContatoCopia')) {
                $novaDemandaAtende->emailContatoCopia           = $request->emailContatoCopia;
            }
            if ($request->has('emailContatoResposta')) {
                $novaDemandaAtende->emailContatoNovaCopia        = $request->emailContatoNovaCopia;
            }

            // PERSISTE OS DADOS DO DISTRATO SOMENTE NO FIM DO MÉTODO
            $novaDemandaAtende->save();

            // CADASTRA HISTÓRICO
            $historico = new HistoricoPortalGilie;
            $historico->matricula       = session('matricula');
            $historico->numeroContrato  = $request->contratoFormatado;
            $historico->tipo            = "CADASTRO";
            $historico->atividade       = "ATENDE";
            $historico->observacao      = "CADASTRO DO ATENDE #" . str_pad($novaDemandaAtende->idAtende, 5, '0', STR_PAD_LEFT) . " - ATIVIDADE: " . $request->nomeAtividade;
            $historico->created_at      = date("Y-m-d H:i:s", time());
            $historico->updated_at      = date("Y-m-d H:i:s", time());
            $historico->save();

        //     // RETORNA A FLASH MESSAGE
        //     $request->session()->flash('corMensagem', 'success');
        //     $request->session()->flash('tituloMensagem', "Cadastro realizado!");
        //     $request->session()->flash('corpoMensagem', "O cadastro do Atende foi realizado com sucesso.");

        //     DB::commit();
        // } catch (\Throwable $th) {
        //     if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
        //         dd($th);
        //     } else {
        //         AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
        //     }
        //     DB::rollback();
        //     // RETORNA A FLASH MESSAGE
        //     $request->session()->flash('corMensagem', 'danger');
        //     $request->session()->flash('tituloMensagem', "Edição não efetuada");
        //     $request->session()->flash('corpoMensagem', "Aconteceu um erro durante a edição dos dados cadastrais do contrato. Tente novamente");
        // }
        return redirect("/consulta-bem-imovel/" . $request->contratoFormatado);
    }
    public function apagarAtividadeGenerica($id)
    {
        $novaDemandaAtende = AtendeGenerico::find($id);
        if (isset($novaDemandaAtende)){
            $novaDemandaAtende->delete();
        }    
    return redirect("/gerencial/gerenciar-demanda-generica");  
    }
}
