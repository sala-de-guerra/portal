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


class tmaVisaoUnificadaController extends Controller
{
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
    public function mediaVendaFinanciada()
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
            
                return json_encode($mediaComFinanciamento);
        }   
}