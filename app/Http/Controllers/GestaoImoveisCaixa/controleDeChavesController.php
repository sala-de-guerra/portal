<?php

namespace App\Http\Controllers\GestaoImoveisCaixa;

use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Models\HistoricoPortalGilie;
use App\Classes\Ldap;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use App\Models\GestaoImoveisCaixa\ControleChave;

class controleDeChavesController extends Controller
{
    public static function index()
    {
        return view('portal.imoveis.consultar.consultar-chave');
    }

    public function listaUniversoChaves()
    {
        // $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        // $siglaGilie = Ldap::defineSiglaUnidadeUsuarioSessao($codigoUnidadeUsuarioSessao);
        $universoChave = DB::table('TBL_CONTROLE_CHAVES')
        ->leftjoin('ALITB001_Imovel_Completo', DB::raw('CONVERT(VARCHAR, TBL_CONTROLE_CHAVES.BEM_FORMATADO)'), '=', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.BEM_FORMATADO)'))
            ->select(DB::raw('
                    TBL_CONTROLE_CHAVES.[idChaves] as idChaves,
                    TBL_CONTROLE_CHAVES.[BEM_FORMATADO] as contratoFormatado,
                    TBL_CONTROLE_CHAVES.[NU_BEM] as contrato,
                    TBL_CONTROLE_CHAVES.[numeroChave] as chave,
                    TBL_CONTROLE_CHAVES.[quantidadeChave] as quantidadeChave,
                    TBL_CONTROLE_CHAVES.[quantidadeEmprestada] as quantidadeEmprestada,
                    TBL_CONTROLE_CHAVES.[numeroChave1] as numeroChave1,
                    TBL_CONTROLE_CHAVES.[numeroChave2] as numeroChave2,
                    TBL_CONTROLE_CHAVES.[numeroChave3] as numeroChave3,
                    TBL_CONTROLE_CHAVES.[numeroChave4] as numeroChave4,
                    TBL_CONTROLE_CHAVES.[numeroChave5] as numeroChave5,
                    TBL_CONTROLE_CHAVES.[numeroChave6] as numeroChave6,
                    TBL_CONTROLE_CHAVES.[statusChave1] as statusChave1,
                    TBL_CONTROLE_CHAVES.[statusChave2] as statusChave2,
                    TBL_CONTROLE_CHAVES.[statusChave3] as statusChave3,
                    TBL_CONTROLE_CHAVES.[statusChave4] as statusChave4,
                    TBL_CONTROLE_CHAVES.[statusChave5] as statusChave5,
                    TBL_CONTROLE_CHAVES.[statusChave6] as statusChave6,
                    ALITB001_Imovel_Completo.[ENDERECO_IMOVEL] as endereco,
                    ALITB001_Imovel_Completo.[ESTADO_OCUPACAO] as ocupacao,
                    ALITB001_Imovel_Completo.[UNA] as una
      
            '))
             ->get();
    
             return json_encode($universoChave);
        }

        public function listaChavesEmprestadas()
    {
        // $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        // $siglaGilie = Ldap::defineSiglaUnidadeUsuarioSessao($codigoUnidadeUsuarioSessao);
        $universoEmprestado = DB::table('TBL_CONTROLE_CHAVES')
        ->leftjoin('ALITB001_Imovel_Completo', DB::raw('CONVERT(VARCHAR, TBL_CONTROLE_CHAVES.BEM_FORMATADO)'), '=', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.BEM_FORMATADO)'))
            ->select(DB::raw('
                    TBL_CONTROLE_CHAVES.[idChaves] as idChaves,
                    TBL_CONTROLE_CHAVES.[BEM_FORMATADO] as contratoFormatado,
                    TBL_CONTROLE_CHAVES.[NU_BEM] as contrato,
                    TBL_CONTROLE_CHAVES.[numeroChave] as chave,
                    TBL_CONTROLE_CHAVES.[quantidadeChave] as quantidadeChave,
                    TBL_CONTROLE_CHAVES.[quantidadeEmprestada] as quantidadeEmprestada,
                    TBL_CONTROLE_CHAVES.[numeroChave1] as numeroChave1,
                    TBL_CONTROLE_CHAVES.[numeroChave2] as numeroChave2,
                    TBL_CONTROLE_CHAVES.[numeroChave3] as numeroChave3,
                    TBL_CONTROLE_CHAVES.[numeroChave4] as numeroChave4,
                    TBL_CONTROLE_CHAVES.[numeroChave5] as numeroChave5,
                    TBL_CONTROLE_CHAVES.[numeroChave6] as numeroChave6,
                    TBL_CONTROLE_CHAVES.[nomeProponente1] as nomeProponente1,
                    TBL_CONTROLE_CHAVES.[cpfProponente1] as cpfProponente1,
                    TBL_CONTROLE_CHAVES.[nomeProponente2] as nomeProponente2,
                    TBL_CONTROLE_CHAVES.[cpfProponente2] as cpfProponente2,
                    TBL_CONTROLE_CHAVES.[nomeProponente3] as nomeProponente3,
                    TBL_CONTROLE_CHAVES.[cpfProponente3] as cpfProponente3,
                    TBL_CONTROLE_CHAVES.[nomeProponente4] as nomeProponente4,
                    TBL_CONTROLE_CHAVES.[cpfProponente4] as cpfProponente4,
                    TBL_CONTROLE_CHAVES.[nomeProponente5] as nomeProponente5,
                    TBL_CONTROLE_CHAVES.[cpfProponente5] as cpfProponente5,
                    TBL_CONTROLE_CHAVES.[nomeProponente6] as nomeProponente6,
                    TBL_CONTROLE_CHAVES.[cpfProponente6] as cpfProponente6,
                    ALITB001_Imovel_Completo.[ENDERECO_IMOVEL] as endereco,
                    ALITB001_Imovel_Completo.[ESTADO_OCUPACAO] as ocupacao,
                    ALITB001_Imovel_Completo.[UNA] as una
      
            '))
            ->where('TBL_CONTROLE_CHAVES.quantidadeEmprestada', '>', 0)
            ->orderBy('TBL_CONTROLE_CHAVES.numeroChave', 'asc')
             ->get();
    
             return json_encode($universoEmprestado);
        }

        public function adicionarChaves(Request $request)
        {
            try {
                    DB::beginTransaction();
            $novaChave = new ControleChave;
                $novaChave->BEM_FORMATADO = $request->input('contratoFormatado');
                $novaChave->NU_BEM = $request->input('contratoSemFormatacao');
                $novaChave->numeroChave = $request->input('numeroChave');
                $novaChave->quantidadeChave = $request->input('quantidadeChave');
                $novaChave->quantidadeChave = $request->input('quantidadeChave');
                $novaChave->quantidadeEmprestada = 0;
                if ($request->input('quantidadeChave') == 1){
                $novaChave->numeroChave1 = $request->input('numeroChave') . "-1";
                $novaChave->statusChave1 = "DISPONIVEL";
                }elseif ($request->input('quantidadeChave') == 2){
                    $novaChave->numeroChave1 = $request->input('numeroChave') . "-1";
                    $novaChave->statusChave1 = "DISPONIVEL";
                    $novaChave->numeroChave2 = $request->input('numeroChave') . "-2";
                    $novaChave->statusChave2 = "DISPONIVEL";
                }elseif ($request->input('quantidadeChave') == 3){
                    $novaChave->numeroChave1 = $request->input('numeroChave') . "-1";
                    $novaChave->statusChave1 = "DISPONIVEL";
                    $novaChave->numeroChave2 = $request->input('numeroChave') . "-2";
                    $novaChave->statusChave2 = "DISPONIVEL";
                    $novaChave->numeroChave3 = $request->input('numeroChave') . "-3";
                    $novaChave->statusChave3 = "DISPONIVEL";
                }elseif ($request->input('quantidadeChave') == 4){
                    $novaChave->numeroChave1 = $request->input('numeroChave') . "-1";
                    $novaChave->statusChave1 = "DISPONIVEL";
                    $novaChave->numeroChave2 = $request->input('numeroChave') . "-2";
                    $novaChave->statusChave2 = "DISPONIVEL";
                    $novaChave->numeroChave3 = $request->input('numeroChave') . "-3";
                    $novaChave->statusChave3 = "DISPONIVEL";
                    $novaChave->numeroChave4 = $request->input('numeroChave') . "-4";
                    $novaChave->statusChave4 = "DISPONIVEL";
                }elseif ($request->input('quantidadeChave') == 5){
                    $novaChave->numeroChave1 = $request->input('numeroChave') . "-1";
                    $novaChave->statusChave1 = "DISPONIVEL";
                    $novaChave->numeroChave2 = $request->input('numeroChave') . "-2";
                    $novaChave->statusChave2 = "DISPONIVEL";
                    $novaChave->numeroChave3 = $request->input('numeroChave') . "-3";
                    $novaChave->statusChave3 = "DISPONIVEL";
                    $novaChave->numeroChave4 = $request->input('numeroChave') . "-4";
                    $novaChave->statusChave4 = "DISPONIVEL";
                    $novaChave->numeroChave5 = $request->input('numeroChave') . "-5";
                    $novaChave->statusChave5 = "DISPONIVEL";
                }else {
                    $novaChave->numeroChave1 = $request->input('numeroChave') . "-1";
                    $novaChave->statusChave1 = "DISPONIVEL";
                    $novaChave->numeroChave2 = $request->input('numeroChave') . "-2";
                    $novaChave->statusChave2 = "DISPONIVEL";
                    $novaChave->numeroChave3 = $request->input('numeroChave') . "-3";
                    $novaChave->statusChave3 = "DISPONIVEL";
                    $novaChave->numeroChave4 = $request->input('numeroChave') . "-4";
                    $novaChave->statusChave4 = "DISPONIVEL";
                    $novaChave->numeroChave5 = $request->input('numeroChave') . "-5";
                    $novaChave->statusChave5 = "DISPONIVEL";
                    $novaChave->numeroChave6 = $request->input('numeroChave') . "-6";
                    $novaChave->statusChave6 = "DISPONIVEL";
                }
                $novaChave->save();
                // RETORNA A FLASH MESSAGE
                $request->session()->flash('corMensagem', 'success');
                $request->session()->flash('tituloMensagem', "Chave(s) Cadastrada!");
                $request->session()->flash('corpoMensagem', "Cadastro de chaves efetuado com sucesso.");
    
                DB::commit();
            } catch (\Throwable $th) {
                if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                } else {
                    AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
                }
                DB::rollback();
                // RETORNA A FLASH MESSAGE
                $request->session()->flash('corMensagem', 'danger');
                $request->session()->flash('tituloMensagem', "Registro de chaves não efetuado");
                $request->session()->flash('corpoMensagem', "Aconteceu um erro durante o registro. Tente novamente");
            }
            return back();
        }
        public function emprestaChaves(Request $request, $idChaves)
        {
            try {
                DB::beginTransaction();
               
                $emprestarChave = ControleChave::find($idChaves);
                if (isset($request->nomeProponente1)){
                    $emprestarChave->nomeProponente1 = $request->nomeProponente1;
                    $emprestarChave->statusChave1 = "EMPRESTADO";
                    $emprestarChave->cpfProponente1 = $request->cpfProponente1;
                    $emprestarChave->RGProponente1 = $request->RGProponente1;
                    $emprestarChave->dataRetiradaChave1 = date("Y-m-d H:i:s", time());
                }
                if (isset($request->nomeProponente2)){
                    $emprestarChave->nomeProponente2 = $request->nomeProponente2;
                    $emprestarChave->statusChave2 = "EMPRESTADO";
                    $emprestarChave->cpfProponente2 = $request->cpfProponente2;
                    $emprestarChave->RGProponente2 = $request->RGProponente2;
                    $emprestarChave->dataRetiradaChave2 = date("Y-m-d H:i:s", time());
                }
                if (isset($request->nomeProponente3)){
                    $emprestarChave->nomeProponente3 = $request->nomeProponente3;
                    $emprestarChave->statusChave3 = "EMPRESTADO";
                    $emprestarChave->cpfProponente3 = $request->cpfProponente3;
                    $emprestarChave->RGProponente3 = $request->RGProponente3;
                    $emprestarChave->dataRetiradaChave3 = date("Y-m-d H:i:s", time());
                }
                if (isset($request->nomeProponente4)){
                    $emprestarChave->nomeProponente4 = $request->nomeProponente4;
                    $emprestarChave->statusChave4 = "EMPRESTADO";
                    $emprestarChave->cpfProponente4 = $request->cpfProponente4;
                    $emprestarChave->RGProponente4 = $request->RGProponente4;
                    $emprestarChave->dataRetiradaChave4 = date("Y-m-d H:i:s", time());
                }
                if (isset($request->nomeProponente5)){
                    $emprestarChave->nomeProponente5 = $request->nomeProponente5;
                    $emprestarChave->statusChave5 = "EMPRESTADO";
                    $emprestarChave->cpfProponente5 = $request->cpfProponente5;
                    $emprestarChave->RGProponente5 = $request->RGProponente5;
                    $emprestarChave->dataRetiradaChave5 = date("Y-m-d H:i:s", time());
                }
                if (isset($request->nomeProponente6)){
                    $emprestarChave->nomeProponente6 = $request->nomeProponente6;
                    $emprestarChave->statusChave6 = "EMPRESTADO";
                    $emprestarChave->cpfProponente6 = $request->cpfProponente6;
                    $emprestarChave->RGProponente6 = $request->RGProponente6;
                    $emprestarChave->dataRetiradaChave6 = date("Y-m-d H:i:s", time());
                }
                $emprestarChave->quantidadeEmprestada += 1;
                $emprestarChave->save();
    
                // RETORNA A FLASH MESSAGE
                $request->session()->flash('corMensagem', 'success');
                $request->session()->flash('tituloMensagem', "Emprestimo Efetuado!");
                $request->session()->flash('corpoMensagem', "Chave emprestada com sucesso.");
    
                DB::commit();
            } catch (\Throwable $th) {
                if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                } else {
                    AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
                }
                DB::rollback();
                // RETORNA A FLASH MESSAGE
                $request->session()->flash('corMensagem', 'danger');
                $request->session()->flash('tituloMensagem', "Registro de emprestimo não efetuado");
                $request->session()->flash('corpoMensagem', "Aconteceu um erro durante o registro. Tente novamente");
            }
            return back();
        }
}
