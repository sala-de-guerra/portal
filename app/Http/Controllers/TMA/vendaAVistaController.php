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
use App\Models\TMA\TBLTmaAuxiliar;
use App\Models\HistoricoPortalGilie;
use App\Models\Bloqueados;
use App\Exports\criaExcelPlanilhaTMAaVista;
use Maatwebsite\Excel\Facades\Excel;

class vendaAVistaController extends Controller
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
            
            return view('portal.tma.tma', compact('mediaAVista'));
        }

    public function universoVendaAVista()
    {
    $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
    $siglaGilie = Ldap::defineSiglaUnidadeUsuarioSessao($codigoUnidadeUsuarioSessao);
    $universoAVista= DB::table('TBL_VENDA_AVISTA')
    ->leftjoin('TBL_VENDA_AVISTA_DUPLICADA', DB::raw('CONVERT(VARCHAR, TBL_VENDA_AVISTA_DUPLICADA.NOME_PROPONENTE)'), '=', DB::raw('CONVERT(VARCHAR, TBL_VENDA_AVISTA.NOME_PROPONENTE)'))
    ->leftjoin('TBL_VENDA_AUXILIAR', DB::raw('CONVERT(VARCHAR, TBL_VENDA_AUXILIAR.BEM_FORMATADO)'), '=', DB::raw('CONVERT(VARCHAR, TBL_VENDA_AVISTA.BEM_FORMATADO)'))
    ->join('ALITB048_CUB120000', DB::raw('CONVERT(VARCHAR, ALITB048_CUB120000.NU_BEM)'), '=', DB::raw('CONVERT(VARCHAR, TBL_VENDA_AVISTA.NU_BEM)'))
        ->select(DB::raw('
            TBL_VENDA_AVISTA.[BEM_FORMATADO] as BEM_FORMATADO,
            TBL_VENDA_AVISTA.[NU_BEM] as NU_BEM,
            TBL_VENDA_AVISTA.[PAGAMENTO_BOLETO] as PAGAMENTO_BOLETO,
            TBL_VENDA_AVISTA.[UNA] as UNA,
            TBL_VENDA_AVISTA.[DIAS_DECORRIDOS] as DIAS_DECORRIDOS,
            TBL_VENDA_AVISTA.[CLASSIFICACAO] as CLASSIFICACAO,
            TBL_VENDA_AVISTA.[TIPO_VENDA] as tipoVenda,
            TBL_VENDA_AVISTA.[NOME_PROPONENTE] as NOME_PROPONENTE,
            TBL_VENDA_AVISTA.[CPF_CNPJ_PROPONENTE] as CPF_CNPJ_PROPONENTE,
            TBL_VENDA_AUXILIAR.[baixaEfetuada] as baixaEfetuada,
            TBL_VENDA_AVISTA_DUPLICADA.[repetido] as repetido,
            ALITB048_CUB120000.[E-MAIL PROPONENTE] as emailProponente,
            ALITB048_CUB120000.[UF_PROPONENTE] as ufProponente
            

        '))
         ->where('TBL_VENDA_AVISTA.UNA', '=', $siglaGilie)
         ->whereRaw('TBL_VENDA_AVISTA.NOME_PROPONENTE = ALITB048_CUB120000.[NOME PROPONENTE]')
         ->get();

        $retiraDuplicado = $universoAVista->unique('NU_BEM');

        return json_encode($retiraDuplicado);
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
            
            
            if ($baixarTMA = TBLTmaAuxiliar::find($chb)){
                $baixarTMA = TBLTmaAuxiliar::find($chb);
                $baixarTMA->baixaEfetuada  = "sim";
                $baixarTMA->save();
                }else{
                    $baixarTMA = new TBLTmaAuxiliar;
                    $baixarTMA->baixaEfetuada  = "sim";
                    $baixarTMA->BEM_FORMATADO  = $chb;
                    $baixarTMA->save();
                }

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
            $historico->observacao      = strip_tags($request->observacaoAtendimento);
            $historico->created_at      = date("Y-m-d H:i:s", time());
            $historico->updated_at      = date("Y-m-d H:i:s", time());
            $historico->save();
            
            if ($baixarTMA = TBLTmaAuxiliar::find($chb)){
                $baixarTMA = TBLTmaAuxiliar::find($chb);
                $baixarTMA->baixaEfetuada  = "del";
                $baixarTMA->save();
                }else{
                    $baixarTMA = new TBLTmaAuxiliar;
                    $baixarTMA->baixaEfetuada  = "del";
                    $baixarTMA->BEM_FORMATADO  = $chb;
                    $baixarTMA->save();
                }

            if ($request->bloquearProponente == 'sim'){
            $proponenteBloqueado = new Bloqueados;
            $proponenteBloqueado->nome  = $request->nomeProponente;
            $proponenteBloqueado->CPF_CNPJ  = str_replace(array(".", ",", "-", "/"), "", $request->cpfNnpjProponente);
            $proponenteBloqueado->UF  =  $request->ufProponente;
            $proponenteBloqueado->email  = $request->emailProponente;
            $proponenteBloqueado->CPF_CONJUGE = "";
            $proponenteBloqueado->NOME_CONJUGE = "";
            $proponenteBloqueado->save();
            }

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
            
            if ($baixarTMA = TBLTmaAuxiliar::find($chb)){
                $baixarTMA = TBLTmaAuxiliar::find($chb);
                $baixarTMA->baixaEfetuada  = "pag";
                $baixarTMA->save();
                }else{
                    $baixarTMA = new TBLTmaAuxiliar;
                    $baixarTMA->baixaEfetuada  = "pag";
                    $baixarTMA->BEM_FORMATADO  = $chb;
                    $baixarTMA->save();
                }

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

    public function criaPlanilhaControleTMA()
    {

        return Excel::download(new criaExcelPlanilhaTMAaVista, 'PlanilhaTMAaVista.xlsx');
    }

    public function indicadoresTMAaVista()
    {

        $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        $siglaGilie = Ldap::defineSiglaUnidadeUsuarioSessao($codigoUnidadeUsuarioSessao);
        $universoAvista= DB::table('ALITB001_Imovel_Completo')
            ->leftjoin('TBL_VENDA_AUXILIAR', DB::raw('CONVERT(VARCHAR, TBL_VENDA_AUXILIAR.BEM_FORMATADO)'), '=', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.BEM_FORMATADO)'))    
            ->join('TBL_VENDA_AVISTA', DB::raw('CONVERT(VARCHAR, TBL_VENDA_AVISTA.BEM_FORMATADO)'), '=', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.BEM_FORMATADO)'))
            ->select(DB::raw("
             SUM(ALITB001_Imovel_Completo.VALOR_TOTAL_PROPOSTA) AS VALOR_VENDIDO, 
             count(*) as quantidade_vendidos,
             TIPO = 'A Vista'
            
            "))
             ->where('TBL_VENDA_AUXILIAR.baixaEfetuada', '=', 'sim')
             ->where('TBL_VENDA_AVISTA.UNA', '=', $siglaGilie)
             ->get();
        return json_encode($universoAvista);
    }
      
}