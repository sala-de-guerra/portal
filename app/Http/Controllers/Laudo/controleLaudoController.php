<?php

namespace App\Http\Controllers\Laudo;

use App\Classes\DiasUteisClass;
use App\Classes\Ldap;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use App\Models\BaseSimov;
use App\Models\HistoricoPortalGilie;
use App\Models\Laudo\Laudo;
use Cmixin\BusinessDay;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class controleLaudoController extends Controller
{
        /**
     *
     * @return \Illuminate\Http\Response
     */
    public function controleLaudoIndex()
    {
        return view('portal.laudo.controle-laudos');
    }

    public function universoLaudo()
    {
    $universoLaudo = DB::table('TBL_CONTROLE_LAUDO')
        ->where('UNA', '=', 'GILIE/SP')
        ->where('quanto_falta', '<=', 70)
        ->where('quanto_falta', '>=', 0)
        ->where('STATUS_IMOVEL', '<>', 'Em Pendência')
        ->where('STATUS_IMOVEL', '<>', 'Em Reavaliação')
        ->orderBy('quanto_falta', 'asc')
         ->get();

         return json_encode($universoLaudo);
    }

    public function laudoVencido()
    {
    $universoLaudo = DB::table('TBL_CONTROLE_LAUDO')
        ->where('UNA', '=', 'GILIE/SP')
        ->where('quanto_falta', '<', 0)
        ->where('STATUS_IMOVEL', '<>', 'Em Pendência')
        ->where('STATUS_IMOVEL', '<>', 'Em Reavaliação')
         ->get();
         return json_encode($universoLaudo);
    }

    public function laudoEmReavaliacao()
    {
    $universoLaudo = DB::table('TBL_CONTROLE_LAUDO')
        ->where('UNA', '=', 'GILIE/SP')
        ->where('quanto_falta', '<', 70)
        ->where('STATUS_IMOVEL', '=', 'Em Reavaliação')
         ->get();
         return json_encode($universoLaudo);
    }

    public function laudoEmPendencia()
    {
    $universoLaudo = DB::table('TBL_CONTROLE_LAUDO')
        ->where('UNA', '=', 'GILIE/SP')
        ->where('quanto_falta', '<=', 0)
        ->where('STATUS_IMOVEL', '=', 'Em Pendência')
         ->get();
         return json_encode($universoLaudo);
    }

    public function cadastrarAlteracoes(Request $request, $id)
    {
        try {
        $novaOS = Laudo::find($id);
        if (isset($request->numeroOS)){
            $novaOS->numeroOS = $request->input('numeroOS');
            
            $historico = new HistoricoPortalGilie;
            $historico->matricula       = session('matricula');
            $historico->numeroContrato  = $request->contratoFormatado;
            $historico->tipo            = "CADASTRO";
            $historico->atividade       = "LAUDO";
            $historico->observacao      = "CADASTRO DE O.S: " . '<B>'. $request->input('numeroOS') . '</B>';
            $historico->created_at      = date("Y-m-d H:i:s", time());
            $historico->updated_at      = date("Y-m-d H:i:s", time());
            $historico->save();
        }
        if (isset($request->observacao)){
            $novaOS->observacao = $request->input('observacao');

            $historico = new HistoricoPortalGilie;
            $historico->matricula       = session('matricula');
            $historico->numeroContrato  = $request->contratoFormatado;
            $historico->tipo            = "CADASTRO";
            $historico->atividade       = "LAUDO";
            $historico->observacao      = $request->input('observacao');
            $historico->created_at      = date("Y-m-d H:i:s", time());
            $historico->updated_at      = date("Y-m-d H:i:s", time());
            $historico->save();

          }
        if (isset($request->statusSiopi)){
        $novaOS->statusSiopi = $request->input('statusSiopi');
        }
        $novaOS->save();
        $request->session()->flash('corMensagem', 'success');
        $request->session()->flash('tituloMensagem', "Controle de laudo atualizado");
        $request->session()->flash('corpoMensagem', "Alteração efetuada com sucesso");
    } catch (\Throwable $th) {
        // dd($th);
        AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
        DB::rollback();
        // RETORNA A FLASH MESSAGE
        $request->session()->flash('corMensagem', 'danger');
        $request->session()->flash('tituloMensagem', "O.S não registrado");
        $request->session()->flash('corpoMensagem', "Aconteceu um erro durante o registro da O.S, Tente novamente!");
    }
    return back();

    }

}
