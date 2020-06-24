<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empregado;
use App\Models\Atende;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Models\HistoricoPortalGilie;
use Illuminate\Support\Facades\DB;

class GestaoAtendeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('portal.gerencial.gestao-atende');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
        return redirect("/atende/gestao-atende");
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
        return redirect("/atende/gestao-atende");
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

}
