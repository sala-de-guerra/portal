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
use PHPMailer\PHPMailer\PHPMailer;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CriaExcelLaudo;


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
    public function baixaDeLaudo()
    {
        return view('portal.laudo.laudo-baixar');
    }

    public function cadastrarAlteracoes(Request $request, $id)
    {
    try 
        {

            $novaOS = Laudo::find($id);
            $novaOS->statusSiopi = $request->statusSiopi;
            $novaOS->numeroOS = $request->numeroOS;
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
        $request->session()->flash('tituloMensagem', "Alteração não efetuada");
        $request->session()->flash('corpoMensagem', "Aconteceu um erro durante o registro da O.S, Tente novamente!");
    }
    return back();

    }

    public function enviaMensagem(Request $request)
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
        if (env('APP_ENV') == 'PRODUCAO'){
            $mail->addAddress($request->emailContato);
            $mail->addCC('giliesp09@mail.caixa');
        }else{
            $mail->addAddress('c098453@mail.caixa');
        }
        $mail->Subject = 'Retorno de finalização de O.S '. $request->numeroOS;
        $mail->Body = nl2br($request->observacaoAtendimento);
        $historico = new HistoricoPortalGilie;
            $historico->matricula = session('matricula');
            $historico->numeroContrato = $request->bemFormatado;
            $historico->tipo = "ANALISE";
            $historico->atividade = "COBRANCA";
            $historico->observacao = strip_tags($request->observacaoAtendimento);
            // dd(date("Y-m-d H:i:s", time()));
            $historico->created_at = date("Y-m-d H:i:s", time());
            $historico->updated_at = date("Y-m-d H:i:s", time());
            $historico->save();
        $mail->send();
         } catch (Exception $e) {
             echo "Erro. Mensagem não foi enviada: {$mail->ErrorInfo}";
        }
         return back();
    }
    public function universoLaudo()
    {
    $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
    $siglaGilie = Ldap::defineSiglaUnidadeUsuarioSessao($codigoUnidadeUsuarioSessao);
    $universoLaudo = DB::table('ALITB001_Imovel_Completo')
        ->leftjoin('TBL_CONTROLE_LAUDO', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.BEM_FORMATADO)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CONTROLE_LAUDO.BEM_FORMATADO)'))
        ->select(DB::raw('
                TBL_CONTROLE_LAUDO.[id] as id,
                ALITB001_Imovel_Completo.[UNA] as UNA,
                ALITB001_Imovel_Completo.[BEM_FORMATADO] as BEM_FORMATADO,
                ALITB001_Imovel_Completo.[NU_BEM] as NU_BEM,
                ALITB001_Imovel_Completo.[STATUS_IMOVEL] as STATUS_IMOVEL,
                ALITB001_Imovel_Completo.[DATA_LAUDO] as DATA_LAUDO,
                ALITB001_Imovel_Completo.[DATA_VENCIMENTO_LAUDO] as DATA_VENCIMENTO_LAUDO,
                ALITB001_Imovel_Completo.[CLASSIFICACAO] as CLASSIFICACAO,
                TBL_CONTROLE_LAUDO.[observacao] as observacao,
                TBL_CONTROLE_LAUDO.[numeroOS] as numeroOS,
                TBL_CONTROLE_LAUDO.[statusSiopi] as statusSiopi,
                datediff(day,getdate(), ALITB001_Imovel_Completo.[DATA_VENCIMENTO_LAUDO]) as quanto_falta
              
        '))
         ->where('ALITB001_Imovel_Completo.UNA', '=', $siglaGilie)
         ->whereRaw('datediff(day,getdate(), ALITB001_Imovel_Completo.[DATA_VENCIMENTO_LAUDO]) <= ?', [70])
         ->whereRaw('datediff(day,getdate(), ALITB001_Imovel_Completo.[DATA_VENCIMENTO_LAUDO]) >= ?', [0])
         ->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', '<>', 'Em Pendência')
         ->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', '<>', 'Em Reavaliação')
         ->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', '<>', 'Vendido')
         ->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', '<>', 'devolvido')
         ->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', '<>', 'excluído')
         ->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', '<>', 'arrendado')
         ->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', '<>', 'em cadastramento')
         ->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', '<>', 'Indício de Fraude')
         ->where('ALITB001_Imovel_Completo.CLASSIFICACAO', '<>', 'EMGEA- Alienação Fiduciária')
         ->where('ALITB001_Imovel_Completo.CLASSIFICACAO', '<>', 'EMGEA - Realização de Garantia')
         ->where('ALITB001_Imovel_Completo.CLASSIFICACAO', '<>', 'EMGEA')
         ->where('ALITB001_Imovel_Completo.CLASSIFICACAO', '<>', 'De Terceiros')
         ->orderBy('ALITB001_Imovel_Completo.DATA_VENCIMENTO_LAUDO', 'asc')
         ->orderBy('ALITB001_Imovel_Completo.BEM_FORMATADO', 'asc')
         ->get();

         return json_encode($universoLaudo);
    }

    public function laudoEmReavaliacao()
    {
    $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
    $siglaGilie = Ldap::defineSiglaUnidadeUsuarioSessao($codigoUnidadeUsuarioSessao);
    $universoLaudo = DB::table('ALITB001_Imovel_Completo')
        ->leftjoin('TBL_CONTROLE_LAUDO', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.BEM_FORMATADO)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CONTROLE_LAUDO.BEM_FORMATADO)'))
        ->select(DB::raw('
                TBL_CONTROLE_LAUDO.[id] as id,
                ALITB001_Imovel_Completo.[UNA] as UNA,
                ALITB001_Imovel_Completo.[BEM_FORMATADO] as BEM_FORMATADO,
                ALITB001_Imovel_Completo.[NU_BEM] as NU_BEM,
                ALITB001_Imovel_Completo.[STATUS_IMOVEL] as STATUS_IMOVEL,
                ALITB001_Imovel_Completo.[DATA_LAUDO] as DATA_LAUDO,
                ALITB001_Imovel_Completo.[DATA_VENCIMENTO_LAUDO] as DATA_VENCIMENTO_LAUDO,
                ALITB001_Imovel_Completo.[CLASSIFICACAO] as CLASSIFICACAO,
                TBL_CONTROLE_LAUDO.[observacao] as observacao,
                TBL_CONTROLE_LAUDO.[numeroOS] as numeroOS,
                TBL_CONTROLE_LAUDO.[statusSiopi] as statusSiopi,
                datediff(day,getdate(), TBL_CONTROLE_LAUDO.[dataCadastroSiopi]) as laudoPedido
              
        '))
         ->where('ALITB001_Imovel_Completo.UNA', '=', $siglaGilie)
         ->whereRaw('datediff(day,getdate(), ALITB001_Imovel_Completo.[DATA_VENCIMENTO_LAUDO]) <= ?', [70])
         ->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', '=', 'Em Reavaliação')
         ->where('ALITB001_Imovel_Completo.CLASSIFICACAO', '<>', 'EMGEA- Alienação Fiduciária')
         ->where('ALITB001_Imovel_Completo.CLASSIFICACAO', '<>', 'EMGEA - Realização de Garantia')
         ->where('ALITB001_Imovel_Completo.CLASSIFICACAO', '<>', 'EMGEA')
         ->where('ALITB001_Imovel_Completo.CLASSIFICACAO', '<>', 'De Terceiros')
         ->orderBy('ALITB001_Imovel_Completo.DATA_VENCIMENTO_LAUDO', 'asc')
         ->orderBy('ALITB001_Imovel_Completo.BEM_FORMATADO', 'asc')
         ->get();

         return json_encode($universoLaudo);
    }

    public function laudoEmPendencia()
    {
    $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
    $siglaGilie = Ldap::defineSiglaUnidadeUsuarioSessao($codigoUnidadeUsuarioSessao);
    $universoLaudo = DB::table('ALITB001_Imovel_Completo')
        ->leftjoin('TBL_CONTROLE_LAUDO', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.BEM_FORMATADO)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CONTROLE_LAUDO.BEM_FORMATADO)'))
        ->select(DB::raw('
                TBL_CONTROLE_LAUDO.[id] as id,
                ALITB001_Imovel_Completo.[UNA] as UNA,
                ALITB001_Imovel_Completo.[BEM_FORMATADO] as BEM_FORMATADO,
                ALITB001_Imovel_Completo.[NU_BEM] as NU_BEM,
                ALITB001_Imovel_Completo.[STATUS_IMOVEL] as STATUS_IMOVEL,
                ALITB001_Imovel_Completo.[DATA_LAUDO] as DATA_LAUDO,
                ALITB001_Imovel_Completo.[DATA_VENCIMENTO_LAUDO] as DATA_VENCIMENTO_LAUDO,
                ALITB001_Imovel_Completo.[CLASSIFICACAO] as CLASSIFICACAO,
                TBL_CONTROLE_LAUDO.[observacao] as observacao,
                TBL_CONTROLE_LAUDO.[numeroOS] as numeroOS,
                TBL_CONTROLE_LAUDO.[statusSiopi] as statusSiopi,
                datediff(day,getdate(), ALITB001_Imovel_Completo.[DATA_VENCIMENTO_LAUDO]) as quanto_falta
              
        '))
         ->where('ALITB001_Imovel_Completo.UNA', '=', $siglaGilie)
         ->whereRaw('datediff(day,getdate(), ALITB001_Imovel_Completo.[DATA_VENCIMENTO_LAUDO]) <= ?', [0])
         ->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', '=', 'Em Pendência')
         ->where('ALITB001_Imovel_Completo.CLASSIFICACAO', '<>', 'EMGEA- Alienação Fiduciária')
         ->where('ALITB001_Imovel_Completo.CLASSIFICACAO', '<>', 'EMGEA - Realização de Garantia')
         ->where('ALITB001_Imovel_Completo.CLASSIFICACAO', '<>', 'EMGEA')
         ->where('ALITB001_Imovel_Completo.CLASSIFICACAO', '<>', 'De Terceiros')
         ->orderBy('ALITB001_Imovel_Completo.DATA_VENCIMENTO_LAUDO', 'asc')
         ->orderBy('ALITB001_Imovel_Completo.BEM_FORMATADO', 'asc')
         ->get();

         return json_encode($universoLaudo);
    }

    public function laudoVencido()
    {
    $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
    $siglaGilie = Ldap::defineSiglaUnidadeUsuarioSessao($codigoUnidadeUsuarioSessao);
    $universoLaudo = DB::table('ALITB001_Imovel_Completo')
        ->leftjoin('TBL_CONTROLE_LAUDO', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.BEM_FORMATADO)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CONTROLE_LAUDO.BEM_FORMATADO)'))
        ->select(DB::raw('
                TBL_CONTROLE_LAUDO.[id] as id,
                ALITB001_Imovel_Completo.[UNA] as UNA,
                ALITB001_Imovel_Completo.[BEM_FORMATADO] as BEM_FORMATADO,
                ALITB001_Imovel_Completo.[NU_BEM] as NU_BEM,
                ALITB001_Imovel_Completo.[STATUS_IMOVEL] as STATUS_IMOVEL,
                ALITB001_Imovel_Completo.[DATA_LAUDO] as DATA_LAUDO,
                ALITB001_Imovel_Completo.[DATA_VENCIMENTO_LAUDO] as DATA_VENCIMENTO_LAUDO,
                ALITB001_Imovel_Completo.[CLASSIFICACAO] as CLASSIFICACAO,
                TBL_CONTROLE_LAUDO.[observacao] as observacao,
                TBL_CONTROLE_LAUDO.[numeroOS] as numeroOS,
                TBL_CONTROLE_LAUDO.[statusSiopi] as statusSiopi,
                datediff(day,getdate(), ALITB001_Imovel_Completo.[DATA_VENCIMENTO_LAUDO]) as quanto_falta
              
        '))
         ->where('ALITB001_Imovel_Completo.UNA', '=', $siglaGilie)
         ->whereRaw('datediff(day,getdate(), ALITB001_Imovel_Completo.[DATA_VENCIMENTO_LAUDO]) < ?', [0])
         ->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', '<>', 'Em Pendência')
         ->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', '<>', 'Em Reavaliação')
         ->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', '<>', 'Vendido')
         ->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', '<>', 'devolvido')
         ->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', '<>', 'excluído')
         ->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', '<>', 'arrendado')
         ->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', '<>', 'em cadastramento')
         ->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', '<>', 'Indício de Fraude')
         ->where('ALITB001_Imovel_Completo.CLASSIFICACAO', '<>', 'EMGEA- Alienação Fiduciária')
         ->where('ALITB001_Imovel_Completo.CLASSIFICACAO', '<>', 'EMGEA - Realização de Garantia')
         ->where('ALITB001_Imovel_Completo.CLASSIFICACAO', '<>', 'EMGEA')
         ->where('ALITB001_Imovel_Completo.CLASSIFICACAO', '<>', 'De Terceiros')
         ->orderBy('ALITB001_Imovel_Completo.DATA_VENCIMENTO_LAUDO', 'asc')
         ->orderBy('ALITB001_Imovel_Completo.BEM_FORMATADO', 'asc')
         ->get();

         return json_encode($universoLaudo);
    }
    public function criaPlanilhaExcelLaudo()
    {

        return Excel::download(new CriaExcelLaudo, 'PlanilhaControleDeLaudo.xlsx');
    }
    public function cadastrarOS(Request $request)
    {

        $novaOS = new Laudo;
            $novaOS->numeroOS = $request->input('numeroOS');
            $novaOS->BEM_FORMATADO = $request->input('contratoFormatado');
            $novaOS->NU_BEM = $request->input('numBem');
            $novaOS->statusSiopi = $request->input('statusSiopi');
            $novaOS->save();

        $historico = new HistoricoPortalGilie;
            $historico->matricula       = session('matricula');
            $historico->numeroContrato  = $request->contratoFormatado;
            $historico->tipo            = "CADASTRO";
            $historico->atividade       = "LAUDO";
            $historico->observacao      = "Laudo solicitado - OS nº: " . $request->input('numeroOS');
            $historico->created_at      = date("Y-m-d H:i:s", time());
            $historico->updated_at      = date("Y-m-d H:i:s", time());
            $historico->save();


            
       
        return back();
    }
    public function cadastrarOBS(Request $request, $id)
    {

        $novaOBS =  Laudo::find($id);
            $novaOBS->observacao = $request->input('observacao');
            $novaOBS->save();

        $historico = new HistoricoPortalGilie;
            $historico->matricula       = session('matricula');
            $historico->numeroContrato  = $request->contratoFormatado;
            $historico->tipo            = "CADASTRO";
            $historico->atividade       = "LAUDO";
            $historico->observacao      = $request->input('observacao');
            $historico->created_at      = date("Y-m-d H:i:s", time());
            $historico->updated_at      = date("Y-m-d H:i:s", time());
            $historico->save();
       
        return back();
    }
  
}
