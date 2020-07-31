<?php

namespace App\Http\Controllers\TMA;

use App\Classes\Ldap;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use App\Models\BaseSimov;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use App\Models\TMA\TMAaVista;
use App\Models\HistoricoPortalGilie;


class vendaAvistaController extends Controller
{
    // public function indexVendaAVista()
    // {
    //     return view('portal.tma.venda-a-vista');
    // }

    public function indexVendaAVista()
    {
        $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        $siglaGilie = Ldap::defineSiglaUnidadeUsuarioSessao($codigoUnidadeUsuarioSessao);
        $mediaAVista= DB::table('TBL_VENDA_AVISTA')
            ->select(DB::raw('
           
            avg([DIAS_DECORRIDOS]) as media
            '))
             ->where('TBL_VENDA_AVISTA.UNA', '=', $siglaGilie)
             ->where('TBL_VENDA_AVISTA.baixaEfetuada', '<>', 'sim')
             ->where('TBL_VENDA_AVISTA.baixaEfetuada', '<>', 'del')
             ->get();
            
            return view('portal.tma.venda-a-vista', compact('mediaAVista'));
        }

    public function universoVendaAVista()
    {
    $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
    $siglaGilie = Ldap::defineSiglaUnidadeUsuarioSessao($codigoUnidadeUsuarioSessao);
    $universoAVista= DB::table('TBL_VENDA_AVISTA')
    ->leftjoin('TBL_VENDA_AVISTA_DUPLICADA', DB::raw('CONVERT(VARCHAR, TBL_VENDA_AVISTA_DUPLICADA.NOME_PROPONENTE)'), '=', DB::raw('CONVERT(VARCHAR, TBL_VENDA_AVISTA.NOME_PROPONENTE)'))
        ->select(DB::raw('
            TBL_VENDA_AVISTA.[BEM_FORMATADO] as BEM_FORMATADO,
            TBL_VENDA_AVISTA.[NU_BEM] as NU_BEM,
            TBL_VENDA_AVISTA.[PAGAMENTO_BOLETO] as PAGAMENTO_BOLETO,
            TBL_VENDA_AVISTA.[UNA] as UNA,
            TBL_VENDA_AVISTA.[DIAS_DECORRIDOS] as DIAS_DECORRIDOS,
            TBL_VENDA_AVISTA.[CLASSIFICACAO] as CLASSIFICACAO,
            TBL_VENDA_AVISTA.[NOME_PROPONENTE] as NOME_PROPONENTE,
            TBL_VENDA_AVISTA.[CPF_CNPJ_PROPONENTE] as CPF_CNPJ_PROPONENTE,
            TBL_VENDA_AVISTA.[baixaEfetuada] as baixaEfetuada,
            TBL_VENDA_AVISTA_DUPLICADA.[repetido] as repetido


        '))
         ->where('TBL_VENDA_AVISTA.UNA', '=', $siglaGilie)
         ->get();

         return json_encode($universoAVista);
    }

    public function baixarVendaAVista(Request $request, $chb)
    {
        try {
            DB::beginTransaction();
           
            $historico = new HistoricoPortalGilie;
            $historico->matricula       = session('matricula');
            $historico->numeroContrato  = $chb;
            $historico->tipo            = "CADASTRO";
            $historico->atividade       = "BAIXA";
            $historico->observacao      = "Baixa da venda efetuada no SIMOV";
            $historico->created_at      = date("Y-m-d H:i:s", time());
            $historico->updated_at      = date("Y-m-d H:i:s", time());
            $historico->save();
            
            $baixarTMA = TMAaVista::find($chb);
            $baixarTMA->baixaEfetuada  = "sim";
            $baixarTMA->save();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Marcação efetuada!");
            $request->session()->flash('corpoMensagem', "Marcação de baixa efetuada com sucesso.");

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
            $request->session()->flash('tituloMensagem', "Marcação não registrada");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante registro. Tente novamente");
        }
        return back();
    }

    public function cancelarVendaAVista(Request $request, $chb)
    {
        try {
            DB::beginTransaction();
           
            $historico = new HistoricoPortalGilie;
            $historico->matricula       = session('matricula');
            $historico->numeroContrato  = $chb;
            $historico->tipo            = "CADASTRO";
            $historico->atividade       = "DISTRATO";
            $historico->observacao      = "venda cancelada - pagamento não identificado no SIMOV e SIACI - boleto baixado - cpf: " . $request->cpfNnpjProponente. "- nome: . $request->nomeProponente";
            $historico->created_at      = date("Y-m-d H:i:s", time());
            $historico->updated_at      = date("Y-m-d H:i:s", time());
            $historico->save();
            
            $baixarTMA = TMAaVista::find($chb);
            $baixarTMA->baixaEfetuada  = "del";
            $baixarTMA->save();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Marcação efetuada!");
            $request->session()->flash('corpoMensagem', "Marcação de distrato efetuado com sucesso.");

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
            $request->session()->flash('tituloMensagem', "Marcação não registrada");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante registro. Tente novamente");
        }
        return back();
    }

    public function aguardaVendaAVista(Request $request, $chb)
    {
        try {
            DB::beginTransaction();
           
            $historico = new HistoricoPortalGilie;
            $historico->matricula       = session('matricula');
            $historico->numeroContrato  = $chb;
            $historico->tipo            = "CADASTRO";
            $historico->atividade       = "CONTRATACAO";
            $historico->observacao      = strip_tags($request->observacaoAtendimento);
            $historico->created_at      = date("Y-m-d H:i:s", time());
            $historico->updated_at      = date("Y-m-d H:i:s", time());
            $historico->save();
            
            $baixarTMA = TMAaVista::find($chb);
            $baixarTMA->baixaEfetuada  = "pag";
            $baixarTMA->save();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Marcação efetuada!");
            $request->session()->flash('corpoMensagem', "Marcação de pagamento efetuado com sucesso.");

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
            $request->session()->flash('tituloMensagem', "Marcação não registrada");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante registro. Tente novamente");
        }
        return back();
    }
      
}