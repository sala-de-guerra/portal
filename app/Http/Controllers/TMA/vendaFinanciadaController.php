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
use App\Models\TMA\TMAfinanciado;
use App\Models\HistoricoPortalGilie;


class vendaFinanciadaController extends Controller
{

    public function indexVendaFinanciada()
    {
        $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        $siglaGilie = Ldap::defineSiglaUnidadeUsuarioSessao($codigoUnidadeUsuarioSessao);
        $mediaComFinanciamento= DB::table('TBL_VENDA_FINANCIADO')
            ->select(DB::raw('
           
            avg([DIAS_DECORRIDOS]) as media
            '))
             ->where('TBL_VENDA_FINANCIADO.UNA', '=', $siglaGilie)
             ->where('TBL_VENDA_FINANCIADO.baixaEfetuada', '<>', 'sim')
             ->where('TBL_VENDA_FINANCIADO.baixaEfetuada', '<>', 'del')
             ->get();
            
            return view('portal.tma.venda-financiada', compact('mediaComFinanciamento'));
        }

    public function universoVendaFinanciada()
    {
    $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
    $siglaGilie = Ldap::defineSiglaUnidadeUsuarioSessao($codigoUnidadeUsuarioSessao);
    $universoFinanciado= DB::table('TBL_VENDA_FINANCIADO')
        ->select(DB::raw('
        TBL_VENDA_FINANCIADO.[BEM_FORMATADO] as BEM_FORMATADO,
        TBL_VENDA_FINANCIADO.[NU_BEM] as NU_BEM,
        TBL_VENDA_FINANCIADO.[PAGAMENTO_BOLETO] as PAGAMENTO_BOLETO,
        TBL_VENDA_FINANCIADO.[UNA] as UNA,
        TBL_VENDA_FINANCIADO.[DIAS_DECORRIDOS] as DIAS_DECORRIDOS,
        TBL_VENDA_FINANCIADO.[CLASSIFICACAO] as CLASSIFICACAO,
        TBL_VENDA_FINANCIADO.[NOME_PROPONENTE] as NOME_PROPONENTE,
        TBL_VENDA_FINANCIADO.[CPF_CNPJ_PROPONENTE] as CPF_CNPJ_PROPONENTE,
        TBL_VENDA_FINANCIADO.[baixaEfetuada] as baixaEfetuada


        '))
            ->where('TBL_VENDA_FINANCIADO.UNA', '=', $siglaGilie)
            ->get();

        return json_encode($universoFinanciado);
    }
    
    public function baixarVendaFinanciada(Request $request, $chb)
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
            
            $baixarTMA = TMAfinanciado::find($chb);
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

    public function cancelarVendaFinanciada(Request $request, $chb)
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
            
            $baixarTMA = TMAfinanciado::find($chb);
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

    public function aguardaVendaFinanciada(Request $request, $chb)
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
            
            $baixarTMA = TMAfinanciado::find($chb);
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