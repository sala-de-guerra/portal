<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empregado;
use App\Models\Atende;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Models\HistoricoPortalGilie;
use Illuminate\Support\Facades\DB;
use App\Classes\Ldap;

class GestaoAtendeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('portal.gerencial.gestao-atende-novo');
        
    }

    public function visaoDiasDeVencimento()
    {
        
        return view('portal.gerencial.gestao-atende');
        
    }

    public function listarEmpregados()
    {
        $listarEmpregados = Empregado::where('codigoLotacaoAdministrativa', session('codigoLotacaoAdministrativa'))
        ->orderBy('nomeCompleto', 'asc')
        ->get();

        return json_encode($listarEmpregados);
    }

    public function redirecionarAtendeGestor(Request $request, $idAtende)
    {
        try {
            DB::beginTransaction();
            // CAPTURAR DADOS DOS DEMAIS MODELS (CASO NECESSÁRIO)
            $redirecionarAtende = Atende::find($idAtende);

            // EDITAR DADOS DEMANDA
            $redirecionarAtende->statusAtende                   = 'REDIRECIONADO';
            $redirecionarAtende->motivoRedirecionamento         = $request->motivoRedirecionamento;
            $redirecionarAtende->matriculaResponsavelAtividade  = $request->matriculaResponsavelAtividade;
            $redirecionarAtende->dataAlteracao                  = date("Y-m-d H:i:s", time());

            // CADASTRA HISTÓRICO
            $historico = new HistoricoPortalGilie;
            $historico->matricula       = session('matricula');
            $historico->numeroContrato  = $redirecionarAtende->contratoFormatado;
            $historico->tipo            = "REDIRECIONADO";
            $historico->atividade       = "ATENDE";
            $historico->observacao      = "ATENDE #" . str_pad($redirecionarAtende->idAtende, 5, '0', STR_PAD_LEFT) . " " . $request->motivoRedirecionamento;
            $historico->created_at      = date("Y-m-d H:i:s", time());
            $historico->updated_at      = date("Y-m-d H:i:s", time());
            $historico->save();

            // PERSISTE OS DADOS DO DISTRATO SOMENTE NO FIM DO MÉTODO
            $redirecionarAtende->save();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Atende redirecionado!");
            $request->session()->flash('corpoMensagem', "O Atende foi redirecionado com sucesso.");

            DB::commit();
        } catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Atende não redirecionado");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante o redirecionado do Atende. Tente novamente");
        }
        return back();
    }
    public function responderAtendeGerencial(Request $request, $idAtende)
    {
        try {
            DB::beginTransaction();
            // CAPTURAR DADOS DOS DEMAIS MODELS (CASO NECESSÁRIO)
            $responderAtende = Atende::find($idAtende);

            // EDITAR DADOS DEMANDA
            $responderAtende->statusAtende      = 'FINALIZADO';
            $responderAtende->respostaAtende    = $request->respostaAtende;
            $responderAtende->dataAlteracao     = date("Y-m-d H:i:s", time());

            // CADASTRA HISTÓRICO
            $historico = new HistoricoPortalGilie;
            $historico->matricula       = session('matricula');
            $historico->numeroContrato  = $responderAtende->contratoFormatado;
            $historico->tipo            = "RESPOSTA";
            $historico->atividade       = "ATENDE";
            $historico->observacao      = "ATENDE #" . str_pad($responderAtende->idAtende, 5, '0', STR_PAD_LEFT) . " " . $request->respostaAtende;
            $historico->created_at      = date("Y-m-d H:i:s", time());
            $historico->updated_at      = date("Y-m-d H:i:s", time());
            $historico->save();

            // PERSISTE OS DADOS DO DISTRATO SOMENTE NO FIM DO MÉTODO
            $responderAtende->save();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Atende respondido!");
            $request->session()->flash('corpoMensagem', "O Atende foi respondido com sucesso.");

            DB::commit();
        } catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Resposta não registrada");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante registro da resposta do Atende. Tente novamente");
        }
        return back();
    }

    public function excluirAtendeGerencial(Request $request, $idAtende)
    {
        try {
            DB::beginTransaction();
            // CAPTURAR DADOS DOS DEMAIS MODELS (CASO NECESSÁRIO)
            $responderAtende = Atende::find($idAtende);

            // EDITAR DADOS DEMANDA
            $responderAtende->statusAtende      = 'FINALIZADO';
            $responderAtende->respostaAtende    = $request->respostaAtende;
            $responderAtende->dataAlteracao     = date("Y-m-d H:i:s", time());

            // CADASTRA HISTÓRICO
            $historico = new HistoricoPortalGilie;
            $historico->matricula       = session('matricula');
            $historico->numeroContrato  = $responderAtende->contratoFormatado;
            $historico->tipo            = "EXCLUIDO";
            $historico->atividade       = "ATENDE";
            $historico->observacao      = "ATENDE EXCLUIDO#" . str_pad($responderAtende->idAtende, 5, '0', STR_PAD_LEFT) . " " . $request->respostaAtende;
            $historico->created_at      = date("Y-m-d H:i:s", time());
            $historico->updated_at      = date("Y-m-d H:i:s", time());
            $historico->save();

            // PERSISTE OS DADOS DO DISTRATO SOMENTE NO FIM DO MÉTODO
            $responderAtende->save();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Atende excluido!");
            $request->session()->flash('corpoMensagem', "O Atende foi excluido com sucesso.");

            DB::commit();
        } catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Erro!");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante a exclusão do Atende. Tente novamente");
        }
        return back();
    }
    public function GerenciarDemandaGenerica()
    {
        return view('portal.gerencial.atividades-genericas');
    }
    public function listarUniverso()
    {
        // $unidadeUsuario = Ldap::defineUnidadeUsuarioSessao();
        // $dadosAtende = Atende::where('codigoUnidade', $unidadeUsuario)
        // ->where('statusAtende','<>','FINALIZADO')
        // ->get();

        // return json_encode($dadosAtende);
        $unidadeUsuario = Ldap::defineUnidadeUsuarioSessao();
        $dadosAtende = DB::table('TBL_ATENDE_DEMANDAS')
            ->join('TBL_GESTAO_EQUIPES_ATIVIDADES', DB::raw('CONVERT(VARCHAR, TBL_GESTAO_EQUIPES_ATIVIDADES.idAtividade)'), '=', DB::raw('CONVERT(VARCHAR, TBL_ATENDE_DEMANDAS.idAtividade)'))
            ->join('TBL_GESTAO_EQUIPES_CELULAS', DB::raw('CONVERT(VARCHAR, TBL_GESTAO_EQUIPES_CELULAS.idEquipe)'), '=', DB::raw('CONVERT(VARCHAR, TBL_ATENDE_DEMANDAS.idEquipe)'))
            ->join('TBL_EMPREGADOS', DB::raw('CONVERT(VARCHAR, TBL_EMPREGADOS.matricula)'), '=', DB::raw('CONVERT(VARCHAR, TBL_ATENDE_DEMANDAS.matriculaResponsavelAtividade)'))
            ->select(DB::raw('
                    TBL_ATENDE_DEMANDAS.[idAtende] as idAtende,
                    TBL_ATENDE_DEMANDAS.[contratoFormatado] as contratoFormatado,
                    TBL_ATENDE_DEMANDAS.[numeroContrato] as numeroContrato,
                    TBL_ATENDE_DEMANDAS.[idAtividade] as idAtividade,
                    TBL_EMPREGADOS.[nomeCompleto] as matriculaResponsavelAtividade,
                    TBL_ATENDE_DEMANDAS.[assuntoAtende] as assuntoAtende,
                    TBL_ATENDE_DEMANDAS.[descricaoAtende] as descricaoAtende,
                    TBL_ATENDE_DEMANDAS.[motivoRedirecionamento] as motivoRedirecionamento,
                    TBL_ATENDE_DEMANDAS.[respostaAtende] as respostaAtende,
                    TBL_ATENDE_DEMANDAS.[prazoAtendimentoAtende] as prazoAtendimentoAtende,
                    TBL_ATENDE_DEMANDAS.[statusAtende] as statusAtende,
                    TBL_ATENDE_DEMANDAS.[matriculaCriadorDemanda] as matriculaCriadorDemanda,
                    TBL_ATENDE_DEMANDAS.[emailContatoResposta] as emailContatoResposta,
                    TBL_ATENDE_DEMANDAS.[dataCadastro] as dataCadastro,
                    TBL_ATENDE_DEMANDAS.[dataAlteracao] as dataAlteracao,
                    TBL_ATENDE_DEMANDAS.[codigoUnidade] as codigoUnidade,
                    TBL_ATENDE_DEMANDAS.[emailContatoCopia] as emailContatoCopia,
                    TBL_ATENDE_DEMANDAS.[emailContatoNovaCopia] as emailContatoNovaCopia,
                    TBL_ATENDE_DEMANDAS.[idEquipe] as idEquipe,
                    TBL_GESTAO_EQUIPES_CELULAS.[nomeEquipe] as nomeEquipe,
                    TBL_GESTAO_EQUIPES_ATIVIDADES.[nomeAtividade] as nomeAtividade
            '))
             ->where('codigoUnidade', $unidadeUsuario)
             ->where('statusAtende','<>','FINALIZADO')
             ->orderBy('prazoAtendimentoAtende', 'asc')
             ->get();

             return json_encode($dadosAtende);
    }

    public function listarFinalizados()
    {
        // $unidadeUsuario = Ldap::defineUnidadeUsuarioSessao();
        // $dadosAtende = Atende::where('codigoUnidade', $unidadeUsuario)
        // ->where('statusAtende','<>','FINALIZADO')
        // ->get();

        // return json_encode($dadosAtende);
        $unidadeUsuario = Ldap::defineUnidadeUsuarioSessao();
        $dadosAtende = DB::table('TBL_ATENDE_DEMANDAS')
            ->join('TBL_GESTAO_EQUIPES_ATIVIDADES', DB::raw('CONVERT(VARCHAR, TBL_GESTAO_EQUIPES_ATIVIDADES.idAtividade)'), '=', DB::raw('CONVERT(VARCHAR, TBL_ATENDE_DEMANDAS.idAtividade)'))
            ->join('TBL_GESTAO_EQUIPES_CELULAS', DB::raw('CONVERT(VARCHAR, TBL_GESTAO_EQUIPES_CELULAS.idEquipe)'), '=', DB::raw('CONVERT(VARCHAR, TBL_ATENDE_DEMANDAS.idEquipe)'))
            ->join('TBL_EMPREGADOS', DB::raw('CONVERT(VARCHAR, TBL_EMPREGADOS.matricula)'), '=', DB::raw('CONVERT(VARCHAR, TBL_ATENDE_DEMANDAS.matriculaResponsavelAtividade)'))
            ->select(DB::raw('
                    TBL_ATENDE_DEMANDAS.[idAtende] as idAtende,
                    TBL_ATENDE_DEMANDAS.[contratoFormatado] as contratoFormatado,
                    TBL_ATENDE_DEMANDAS.[numeroContrato] as numeroContrato,
                    TBL_ATENDE_DEMANDAS.[idAtividade] as idAtividade,
                    TBL_EMPREGADOS.[nomeCompleto] as matriculaResponsavelAtividade,
                    TBL_ATENDE_DEMANDAS.[assuntoAtende] as assuntoAtende,
                    TBL_ATENDE_DEMANDAS.[descricaoAtende] as descricaoAtende,
                    TBL_ATENDE_DEMANDAS.[motivoRedirecionamento] as motivoRedirecionamento,
                    TBL_ATENDE_DEMANDAS.[respostaAtende] as respostaAtende,
                    TBL_ATENDE_DEMANDAS.[prazoAtendimentoAtende] as prazoAtendimentoAtende,
                    TBL_ATENDE_DEMANDAS.[statusAtende] as statusAtende,
                    TBL_ATENDE_DEMANDAS.[matriculaCriadorDemanda] as matriculaCriadorDemanda,
                    TBL_ATENDE_DEMANDAS.[emailContatoResposta] as emailContatoResposta,
                    TBL_ATENDE_DEMANDAS.[dataCadastro] as dataCadastro,
                    TBL_ATENDE_DEMANDAS.[dataAlteracao] as dataAlteracao,
                    TBL_ATENDE_DEMANDAS.[codigoUnidade] as codigoUnidade,
                    TBL_ATENDE_DEMANDAS.[emailContatoCopia] as emailContatoCopia,
                    TBL_ATENDE_DEMANDAS.[emailContatoNovaCopia] as emailContatoNovaCopia,
                    TBL_ATENDE_DEMANDAS.[idEquipe] as idEquipe,
                    TBL_GESTAO_EQUIPES_CELULAS.[nomeEquipe] as nomeEquipe,
                    TBL_GESTAO_EQUIPES_ATIVIDADES.[nomeAtividade] as nomeAtividade
            '))
             ->where('codigoUnidade', $unidadeUsuario)
             ->where('statusAtende','=','FINALIZADO')
             ->orderBy('idAtende', 'desc')
             ->take(250)
             ->get();

             return json_encode($dadosAtende);
    }

    public function alterarAtende(Request $request, $idAtende)
    {
        try {
            DB::beginTransaction();
            // CAPTURAR DADOS DOS DEMAIS MODELS (CASO NECESSÁRIO)
            $alterarAtende = Atende::find($idAtende);

            // EDITAR DADOS DEMANDA
            $alterarAtende->prazoAtendimentoAtende = $request->prazoAtendimentoAtende;
            $alterarAtende->dataAlteracao     = date("Y-m-d H:i:s", time());

            // CADASTRA HISTÓRICO
            $historico = new HistoricoPortalGilie;
            $historico->matricula       = session('matricula');
            $historico->numeroContrato  = $alterarAtende->contratoFormatado;
            $historico->tipo            = "ALTERAÇÃO";
            $historico->atividade       = "ATENDE";
            $historico->observacao      = "ATENDE #" . str_pad($alterarAtende->idAtende, 5, '0', STR_PAD_LEFT) . " Nova data de resposta " . $request->prazoAtendimentoAtende ;
            $historico->created_at      = date("Y-m-d H:i:s", time());
            $historico->updated_at      = date("Y-m-d H:i:s", time());
            $historico->save();

            // PERSISTE OS DADOS DO DISTRATO SOMENTE NO FIM DO MÉTODO
            $alterarAtende->save();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Atende alterado!");
            $request->session()->flash('corpoMensagem', "O Atende foi alterado com sucesso.");

            DB::commit();
        } catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Alteração não efetuada");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante a alteração do Atende. Tente novamente");
        }
        return back();
    }

}
